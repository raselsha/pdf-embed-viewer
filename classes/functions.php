<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.2
 * @since 1.0.3
 */

use function ElementorProDeps\DI\get;

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Functions') ){
    class PDFEV_Functions{
        
        public function __construct() {
            add_action( 'plugins_loaded', ['PDFEV_Functions','load_plugin_textdomain'] );  
            add_action( 'plugins_loaded', ['PDFEV_Functions','appsero_init_tracker'] ); 
            add_action( 'init', [$this,'pdfev_proxy']);
            add_action( 'init', [$this,'stream_pdf']);
            add_action( 'wp_ajax_pdfev_load_more_archive', ['PDFEV_Functions','load_more_archive'] );
            add_action( 'wp_ajax_nopriv_pdfev_load_more_archive', ['PDFEV_Functions','load_more_archive'] );
        }

        function dummy_import(){
            settings_errors('my_plugin_notice');
        }

        function my_plugin_notice(){
            if ( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $screen = get_current_screen();
            if ( isset( $screen->id ) && $screen->id !== 'plugins' ) {
                return;
            }
            ?>
            <div class="notice notice-info is-dismissible">
                <p><?php echo sprintf( __( 'Thank you for activating PDF Embed Viewer! To get started, please visit the <a href="%s">settings page</a>.', 'pdf-embed-viewer' ), admin_url( 'edit.php?post_type=pdfev_embed_viewer&page=pdfev_settings' ) ); ?></p>
            </div>
            <?php
        }


        public function pdfev_proxy() {
            if (isset($_GET['pdfev_proxy'])) {
                $url = esc_url_raw(wp_unslash($_GET['pdfev_proxy']));

                if (! self::is_allowed_proxy_url($url)) {
                    status_header(403);
                    echo 'Invalid file type.';
                    exit;
                }

                $response = wp_remote_get($url, ['timeout' => 60]);

                if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
                    status_header(404);
                    echo 'PDF could not be loaded.';
                    exit;
                }

                $content_type = wp_remote_retrieve_header($response, 'content-type');
                if (stripos((string) $content_type, 'pdf') === false) {
                    status_header(415);
                    echo 'Remote file is not a PDF.';
                    exit;
                }

                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="proxy.pdf"');
                header('Accept-Ranges: bytes');
                echo wp_remote_retrieve_body($response);
                exit;
            }
        }

        /**
         * Only allow proxying http(s) URLs that end in .pdf (path, not query
         * string) and that don't resolve to a private/reserved/loopback IP,
         * to prevent the proxy from being used for SSRF against internal
         * services or cloud metadata endpoints.
         */
        public static function is_allowed_proxy_url($url) {
            $scheme = wp_parse_url($url, PHP_URL_SCHEME);
            $host   = wp_parse_url($url, PHP_URL_HOST);
            $path   = wp_parse_url($url, PHP_URL_PATH);

            if (empty($host) || ! in_array($scheme, ['http', 'https'], true)) {
                return false;
            }

            if (empty($path) || ! preg_match('/\.pdf$/i', $path)) {
                return false;
            }

            $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);

            if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return false;
            }

            return true;
        }

        /**
         * Get (or lazily generate) the secret used to sign local-file stream tokens.
         * Idempotent — safe to call from activation and as a lazy fallback for
         * installs upgrading from a version that predates this feature.
         *
         * @return string
         */
        public static function get_stream_secret() {
            $secret = get_option( 'pdfev_stream_secret' );
            if ( empty( $secret ) ) {
                $secret = wp_generate_password( 64, false );
                update_option( 'pdfev_stream_secret', $secret, false );
            }
            return $secret;
        }

        /**
         * Stable (non-expiring) token identifying a post's PDF for the stream
         * endpoint, so the real file path never has to appear in page HTML.
         * Intentionally non-expiring (unlike a download token would be): it gets
         * baked into cacheable page HTML via data-pdfev-url, so an expiring token
         * would break the viewer for anyone served from a page cache after expiry.
         * Functionally as permanent/public as the existing pdfev_proxy endpoint —
         * it just never reveals the real path.
         *
         * @param int $post_id
         * @return string
         */
        public static function get_stream_token( $post_id ) {
            return hash_hmac( 'sha256', (string) $post_id, self::get_stream_secret() );
        }

        /**
         * Resolve a same-host PDF URL to a real filesystem path, but only if it
         * safely resolves within the uploads directory. pdfev_meta_pdf_url is a
         * free-text field (not guaranteed to be an actual media-library upload),
         * so this must not allow arbitrary local file reads — mirrors the
         * whitelist mindset of is_allowed_proxy_url() above, for local paths.
         *
         * @param string $url
         * @return string|false Real filesystem path, or false if not safely resolvable.
         */
        public static function resolve_local_pdf_path( $url ) {
            $upload_dir = wp_upload_dir();
            if ( ! empty( $upload_dir['error'] ) || empty( $url ) ) {
                return false;
            }

            $base_url = $upload_dir['baseurl'];
            $base_dir = $upload_dir['basedir'];

            if ( strpos( $url, $base_url ) !== 0 ) {
                return false;
            }

            $relative_path = substr( $url, strlen( $base_url ) );
            $candidate     = $base_dir . $relative_path;

            $real_base = realpath( $base_dir );
            $real_path = realpath( $candidate );

            if ( ! $real_base || ! $real_path || strpos( $real_path, $real_base ) !== 0 ) {
                return false;
            }

            if ( ! preg_match( '/\.pdf$/i', $real_path ) ) {
                return false;
            }

            return $real_path;
        }

        /**
         * Stream a local PDF file to the browser, with basic single-range HTTP
         * Range support (pdf.js never sends multi-range requests, so that's all
         * that's needed) — without it, protected-mode PDFs would be noticeably
         * slower to open than today's direct-URL serving (which the webserver
         * itself serves with full Range support). Exits when done.
         *
         * @param string $path        Real filesystem path (already validated by the caller).
         * @param string $disposition 'inline' or 'attachment'.
         * @param string $filename    Filename suggested to the browser.
         */
        public static function send_pdf_file( $path, $disposition = 'inline', $filename = 'document.pdf' ) {
            $size  = filesize( $path );
            $start = 0;
            $end   = $size - 1;
            $status = 200;

            $range_header = isset( $_SERVER['HTTP_RANGE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_RANGE'] ) ) : '';

            if ( $range_header && preg_match( '/bytes=(\d*)-(\d*)/', $range_header, $matches ) ) {
                $start = ( '' === $matches[1] ) ? 0 : (int) $matches[1];
                $end   = ( '' === $matches[2] ) ? $size - 1 : (int) $matches[2];
                $end   = min( $end, $size - 1 );

                if ( $start > $end || $start >= $size ) {
                    status_header( 416 );
                    header( 'Content-Range: bytes */' . $size );
                    exit;
                }

                $status = 206;
            }

            $length = $end - $start + 1;

            status_header( $status );
            header( 'Content-Type: application/pdf' );
            header( 'Content-Disposition: ' . $disposition . '; filename="' . sanitize_file_name( $filename ) . '"' );
            header( 'Accept-Ranges: bytes' );
            header( 'Content-Length: ' . $length );

            if ( 206 === $status ) {
                header( 'Content-Range: bytes ' . $start . '-' . $end . '/' . $size );
            }

            $handle = fopen( $path, 'rb' );
            if ( ! $handle ) {
                status_header( 500 );
                exit;
            }

            fseek( $handle, $start );
            $bytes_left = $length;

            while ( $bytes_left > 0 && ! feof( $handle ) ) {
                $read = min( 8192, $bytes_left );
                echo fread( $handle, $read );
                $bytes_left -= $read;
                flush();
            }

            fclose( $handle );
            exit;
        }

        /**
         * Serves a local PDF through a token-gated URL instead of its real path,
         * when Pro "Hide File URL" protection mode is active. See get_pdf_link().
         */
        public function stream_pdf() {
            if ( ! isset( $_GET['pdfev_stream'] ) ) {
                return;
            }

            $mode = ( isset( $_GET['mode'] ) && 'download' === $_GET['mode'] ) ? 'download' : 'view';

            if ( 'download' === $mode ) {
                $this->stream_pdf_download();
                return;
            }

            $this->stream_pdf_view();
        }

        /**
         * Extra deterrent layer on top of the token/transient checks: reject
         * requests without a same-site Referer, so a URL copied straight into a
         * new tab/address bar (browsers never send a Referer for that kind of
         * navigation) is blocked, while pdf.js's own in-page fetch of the same
         * URL — and this plugin's own JS-driven download navigation — both carry
         * the current page as Referer and keep working. Not foolproof against a
         * deliberately crafted Referer header (e.g. via curl); it raises the bar
         * against casual copy/paste and link sharing, nothing more.
         *
         * @return bool
         */
        public static function has_same_site_referer() {
            $referer = isset( $_SERVER['HTTP_REFERER'] ) ? esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : '';
            if ( empty( $referer ) ) {
                return false;
            }

            $referer_host = wp_parse_url( $referer, PHP_URL_HOST );
            $site_host    = wp_parse_url( home_url(), PHP_URL_HOST );

            return $referer_host && $site_host && $referer_host === $site_host;
        }

        /**
         * Serves a local PDF inline through the permanent, cache-safe view token.
         * See get_pdf_link() / get_stream_token().
         */
        protected function stream_pdf_view() {
            $post_id = isset( $_GET['id'] ) ? absint( $_GET['id'] ) : 0;
            $token   = isset( $_GET['token'] ) ? sanitize_text_field( wp_unslash( $_GET['token'] ) ) : '';

            if ( ! $post_id || ! $token || ! hash_equals( self::get_stream_token( $post_id ), $token ) ) {
                status_header( 403 );
                echo 'Invalid request.';
                exit;
            }

            if ( ! self::has_same_site_referer() ) {
                status_header( 403 );
                echo 'Direct access to this link is not allowed.';
                exit;
            }

            // Re-check live, not just whatever was true when the token was minted —
            // a lapsed license must stop serving immediately.
            if ( ! self::is_pro() || get_option( 'pdfev_pro_protection_mode' ) !== 'stream' ) {
                status_header( 403 );
                echo 'Protected delivery is not enabled.';
                exit;
            }

            $meta_url = get_post_meta( $post_id, 'pdfev_meta_pdf_url', true );
            $path     = $meta_url ? self::resolve_local_pdf_path( $meta_url ) : false;

            if ( ! $path ) {
                status_header( 404 );
                echo 'PDF could not be located.';
                exit;
            }

            self::send_pdf_file( $path, 'inline', 'document.pdf' );
        }

        /**
         * Serves a local PDF as an attachment download, gated by a single-use,
         * short-lived transient token minted on-demand by
         * Count_Manager::track_dowload_counts() — see get_protected_download_url().
         * Unlike the view token, this one is deliberately expiring/one-time since
         * it's requested via admin-ajax.php at click-time (always live PHP, never
         * cached), not baked into cacheable page HTML.
         */
        protected function stream_pdf_download() {
            $token   = isset( $_GET['token'] ) ? sanitize_text_field( wp_unslash( $_GET['token'] ) ) : '';
            $post_id = $token ? get_transient( 'pdfev_dl_' . $token ) : false;

            if ( ! $post_id ) {
                status_header( 403 );
                echo 'This download link has expired or already been used.';
                exit;
            }

            delete_transient( 'pdfev_dl_' . $token ); // single-use

            if ( ! self::has_same_site_referer() ) {
                status_header( 403 );
                echo 'Direct access to this link is not allowed.';
                exit;
            }

            // Re-check live, same reasoning as stream_pdf_view().
            if ( ! self::is_pro() || get_option( 'pdfev_pro_protection_mode' ) !== 'stream' ) {
                status_header( 403 );
                echo 'Protected delivery is not enabled.';
                exit;
            }

            $meta_url = get_post_meta( $post_id, 'pdfev_meta_pdf_url', true );
            $path     = $meta_url ? self::resolve_local_pdf_path( $meta_url ) : false;

            if ( ! $path ) {
                status_header( 404 );
                echo 'PDF could not be located.';
                exit;
            }

            $filename = sanitize_title( get_the_title( $post_id ) );
            $filename = $filename ? $filename . '.pdf' : 'document.pdf';

            self::send_pdf_file( $path, 'attachment', $filename );
        }

        /**
         * Mint a fresh, single-use, short-lived (60s) download token for a
         * post's PDF, when Pro "Hide File URL" protection is active. Returns
         * null when not applicable (free tier, protection off, or the file
         * doesn't resolve to a safe local path) — callers fall back to a normal
         * direct download in that case.
         *
         * @param int $post_id
         * @return string|null
         */
        public static function get_protected_download_url( $post_id ) {
            if ( ! self::is_pro() || get_option( 'pdfev_pro_protection_mode' ) !== 'stream' ) {
                return null;
            }

            $meta_url = get_post_meta( $post_id, 'pdfev_meta_pdf_url', true );
            if ( ! $meta_url || ! self::resolve_local_pdf_path( $meta_url ) ) {
                return null;
            }

            $token = wp_generate_password( 32, false );
            set_transient( 'pdfev_dl_' . $token, $post_id, 60 );

            return add_query_arg(
                [
                    'pdfev_stream' => 1,
                    'mode'         => 'download',
                    'token'        => $token,
                ],
                home_url( '/' )
            );
        }

        public static function load_plugin_textdomain() {
            $plugin_dir = basename( dirname( __DIR__ ) ) . "/languages/";
			load_plugin_textdomain( 'pdf-embed-viewer', false, $plugin_dir );
        }

        /**
         * Cached Appsero\Client instance, so license()/insights() (and the hooks their
         * constructors register) aren't re-created on every is_pro() call.
         *
         * @var \Appsero\Client|null
         */
        private static $appsero_client = null;

        /**
         * Get the shared Appsero client instance (memoized).
         *
         * @return \Appsero\Client
         */
        public static function get_appsero_client() {
            if ( self::$appsero_client ) {
                return self::$appsero_client;
            }

            if ( ! class_exists( 'Appsero\Client' ) ) {
                require_once PDFEV_Const_Path . 'vendor/appsero/src/Client.php';
            }

            // Pass the main plugin file (not __FILE__/this file) so Appsero's slug,
            // version lookup, and activation-hook registration resolve correctly.
            self::$appsero_client = new Appsero\Client( 'efdff7cb-2ab8-4e9a-a19f-9ca95f4a5b42', '3D Flipbook PDF Viewer & Embedder Plugin Activated!', PDFEV_Const_Path . 'pdf-embed-viewer.php' );

            return self::$appsero_client;
        }

        /**
         * Whether this install has a valid, active Pro license.
         *
         * @return bool
         */
        public static function is_pro() {
            return (bool) self::get_appsero_client()->license()->is_valid();
        }

        /**
         * Default values for the Pro flipbook display options (pdfev_flipbook_pro_options).
         * Chosen to match today's hardcoded behavior in assets/js/frontend.js, so
         * enabling Pro alone (without touching these settings) doesn't change the
         * frontend experience until an admin actually adjusts something.
         *
         * @return array
         */
        public static function get_flipbook_pro_defaults() {
            return [
                'sound'             => 'yes',
                'autoplay'          => 'no',
                'autoplay_duration' => 5000,
                'page_mode'         => 'full',
                'rtl'               => 'no',
                'background_color'  => '',
                'style'             => 'volume',
                'skin'              => 'black-short',
                'show_print'        => 'yes',
                'show_fullscreen'   => 'yes',
                'show_toc'          => 'yes',
                'show_share'        => 'yes',
                'zoom_default'      => 1,
                'zoom_min'          => 0.5,
                'zoom_max'          => 3,
            ];
        }

        /**
         * Maps the "skin" setting to the actual vendor CSS filename under
         * vendor/3dflipbook/css/. Single source of truth reused by the settings
         * dropdown (general.php) and the CSS-content injection (enque-style-script.php).
         *
         * @return array
         */
        public static function get_flipbook_skin_map() {
            return [
                'black-short' => 'short-black-book-view.css',
                'black-full'  => 'black-book-view.css',
                'white-short' => 'short-white-book-view.css',
                'white-full'  => 'white-book-view.css',
            ];
        }

        public static function appsero_init_tracker() {
            $client = self::get_appsero_client();
            $client->insights()->init();

            $client->license()->add_settings_page( [
                'type'        => 'submenu',
                'page_title'  => __( 'Manage License', 'pdf-embed-viewer' ),
                'menu_title'  => __( 'Manage License', 'pdf-embed-viewer' ),
                'capability'  => 'manage_options',
                'parent_slug' => 'edit.php?post_type=' . self::get_cpt_name(),
            ] );
        }

        public static function insert_media($file_path) {
            $attachment = PDFEV_Functions::does_attachment_exist(basename($file_path));
        
            if (empty($attachment)) {
                // Load required files
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');
        
                // Read file content
                $filename = basename($file_path);
                $file_content = file_get_contents($file_path);
        
                if ($file_content === false) {
                    return 'Failed to read file content.';
                }
        
                // Upload a copy to WordPress uploads dir
                $upload = wp_upload_bits($filename, null, $file_content);
        
                if ($upload['error']) {
                    return 'Upload error: ' . $upload['error'];
                }
        
                // Create attachment
                $attachment = array(
                    'post_mime_type' => mime_content_type($upload['file']),
                    'post_title'     => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
        
                $attachment_id = wp_insert_attachment($attachment, $upload['file']);
                if (is_wp_error($attachment_id)) {
                    return 'Attachment insert failed: ' . $attachment_id->get_error_message();
                }
        
                // Generate and update metadata
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
        
                return [
                    'id'  => $attachment_id,
                    'url' => wp_get_attachment_url($attachment_id),
                    'filesize' => file_exists($file_path) ? filesize($file_path) : 0,
                ];
            }
        
            return $attachment;
        }
        
        public static function does_attachment_exist($filename) {
            global $wpdb;

            // Sanitize the filename
            $filename = sanitize_text_field($filename);

            // Query to find attachments based on the filename in the post meta
            $query = $wpdb->prepare(
                "SELECT p.ID 
                FROM $wpdb->posts p
                JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
                WHERE p.post_type = 'attachment'
                AND pm.meta_key = '_wp_attached_file'
                AND pm.meta_value LIKE %s",
                '%' . $wpdb->esc_like($filename) . '%'
            );

            // Get the attachment ID
            $attachment_id = $wpdb->get_var($query);

            // If attachment ID is found, check if the file exists
            if ($attachment_id) {
                $attachment = array(
                    'id' => $attachment_id,
                    'url' => wp_get_attachment_url($attachment_id),
                );
                return $attachment;
            }
            return false;
        }

        public static function load_template($template_file){
            $archive_template = get_template_directory().'/template/style/'. $template_file;
            if( ! file_exists($archive_template)){
                $archive_template = get_template_directory().'/template/style/list.php';
                if( ! file_exists($archive_template)){
                    $archive_template = PDFEV_Const_Path . 'template/style/'. $template_file;
                    if( ! file_exists($archive_template)){
                        $archive_template = PDFEV_Const_Path . 'template/style/list.php';
                    }
                }
            }
            return $archive_template;
        }

        public static function shortcode_view($post_id, $atts = []){
            $link = \PDFEV_Functions::get_pdf_link($post_id);
            $flipbook = get_option('pdfev_flipbook_status');
            $flipbook = $flipbook ? $flipbook : 'yes';
            ?>
            <div class="pdfev-embed-viewer">
                <?php if ( ! is_singular( PDFEV_Functions::get_cpt_name() ) ) : ?>
                    <?php do_action('pdfev_template_single_meta', $atts); ?>
                <?php endif; ?>
                <div class="pdfev-display-switcher">
                    <div class="toggle-button">
                        <a class="button btn pdfev-show-flipbook <?php echo esc_attr($flipbook=='yes'?'active':''); ?>"><i class="fas fa-book-open"></i> <?php _e('Flipbook','pdf-embed-viewer'); ?></a>
                        <a class="button btn pdfev-show-traditional <?php echo esc_attr($flipbook=='yes'?'':'active'); ?>"><i class="fas fa-book"></i> <?php _e('Traditional','pdf-embed-viewer'); ?></a>
                        <?php 
                        if(!is_singular(PDFEV_Functions::get_cpt_name())):
                            PDFEV_Functions::download_button_single_page_view($post_id); 
                        endif;
                        ?>
                    </div>
                    <div class="pdfev-3dbook-container" style="display: <?php echo esc_attr($flipbook=='yes'?'block':'none'); ?>;">
                        <div class="pdfev-3dbook-viewer" id="pdfev-3dbook-<?php echo esc_attr($post_id); ?>" data-id="<?php echo esc_attr($post_id); ?>" data-pdfev-url="<?php echo esc_attr($link); ?>"></div>                
                    </div>
                    <div class="pdfev-traditional-container" style="display: <?php echo esc_attr($flipbook=='yes'?'none':'block'); ?>;">
                        <iframe class="pdf-viewer" src="<?php echo esc_attr($link); ?>" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <?php
        }

        public static function get_cpt_name(){
            return 'pdfev_embed_viewer';
        }

        public static function get_post_order(){
            return 'DSC';
        }
        /**
         * get_pdf_link() will return the pdf link using pdf ID
         *
         * @param [int] $post_id
         * @return string
         * @example http://pdf.local/wp-content/uploads/2025/10/example.pdf
         */
        public static function get_pdf_link($post_id=null) {
            $post_id= $post_id??get_the_ID();
            $link = get_post_meta($post_id, 'pdfev_meta_pdf_url', true);
            $link = $link ?? '';

            if (empty($link)) return '';

            $site_host  = parse_url(home_url(), PHP_URL_HOST);
            $pdf_host   = parse_url($link, PHP_URL_HOST);

            // Remote → proxy it
            if ($pdf_host && $site_host !== $pdf_host) {
                return add_query_arg('pdfev_proxy', rawurlencode($link), home_url('/'));
            }

            // Local, Pro "Hide File URL" mode → serve through a token-gated URL
            // instead of the real path. Falls through to the direct URL below for
            // free installs, non-local files, or files outside the uploads dir.
            if (self::is_pro() && get_option('pdfev_pro_protection_mode') === 'stream' && self::resolve_local_pdf_path($link)) {
                return add_query_arg(
                    [
                        'pdfev_stream' => 1,
                        'id'           => $post_id,
                        'token'        => self::get_stream_token($post_id),
                    ],
                    home_url('/')
                );
            }

            // Local → return directly
            return esc_url_raw($link);
        }

        /**
         * pdf_link() will print the pdf link using pdf ID
         *
         * @param [int] $post_id
         * @return string
         * @example http://pdf.local/wp-content/uploads/2025/10/example.pdf
         */
        public static function pdf_link($post_id=null){
            $post_id= $post_id??get_the_ID();
            $link = self::get_pdf_link($post_id);
            echo esc_attr($link);
        }

        public static function archive_title(){
            $archive_title = get_option('pdfev_archive_title');
            if ( is_post_type_archive( 'pdfev_embed_viewer' ) ) {
                echo isset($archive_title) ? esc_html($archive_title) : '';
            }
        }

        public static function load_more_archive(){
            check_ajax_referer( 'pdf_ajax_nonce', 'ajaxnonce', true );

            $template = isset($_POST['template']) ? sanitize_text_field(wp_unslash($_POST['template'])) : 'list';
            $paged = isset($_POST['page']) ? absint($_POST['page']) : 1;
            $category = isset($_POST['category']) ? sanitize_text_field(wp_unslash($_POST['category'])) : '';
            $limit = isset($_POST['limit']) ? absint($_POST['limit']) : '';
            $order = isset($_POST['order']) ? sanitize_text_field(wp_unslash($_POST['order'])) : '';
            $read = isset($_POST['read']) ? sanitize_text_field(wp_unslash($_POST['read'])) : '';
            $download = isset($_POST['download']) ? sanitize_text_field(wp_unslash($_POST['download'])) : '';
            $show_description = isset($_POST['show_description']) ? sanitize_text_field(wp_unslash($_POST['show_description'])) : '';
            $show_author = isset($_POST['show_author']) ? sanitize_text_field(wp_unslash($_POST['show_author'])) : '';
            $show_publisher = isset($_POST['show_publisher']) ? sanitize_text_field(wp_unslash($_POST['show_publisher'])) : '';
            $show_year = isset($_POST['show_year']) ? sanitize_text_field(wp_unslash($_POST['show_year'])) : '';
            $show_edition = isset($_POST['show_edition']) ? sanitize_text_field(wp_unslash($_POST['show_edition'])) : '';
            $show_total_pages = isset($_POST['show_total_pages']) ? sanitize_text_field(wp_unslash($_POST['show_total_pages'])) : '';
            $show_filesize = isset($_POST['show_filesize']) ? sanitize_text_field(wp_unslash($_POST['show_filesize'])) : '';

            $atts = array(
                'category' => $category,
                'limit' => $limit,
                'order' => $order,
                'read' => $read,
                'download' => $download,
                'show_description' => $show_description,
                'show_author' => $show_author,
                'show_publisher' => $show_publisher,
                'show_year' => $show_year,
                'show_edition' => $show_edition,
                'show_total_pages' => $show_total_pages,
                'show_filesize' => $show_filesize,
            );

            $args = array(
                'post_type' => self::get_cpt_name(),
                'post_status' => 'publish',
                'order' => $order ? $order : self::get_post_order(),
                'posts_per_page' => $limit ? $limit : get_option( 'posts_per_page' ),
                'paged' => $paged,
            );

            if ( ! empty( $category ) ) {
                $field = 'slug';
                if ( is_numeric( $category ) ) {
                    $field = 'term_id';
                } elseif ( strpos( $category, ' ' ) !== false ) {
                    $field = 'name';
                }

                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'pdfev_category',
                        'field' => $field,
                        'terms' => $category,
                    ),
                );
            }

            if ( ! empty( $year ) ) {
                $args['date_query'] = array(
                    array(
                        'year' => absint($year),
                    ),
                );
            }

            $query = new \WP_Query( $args );
            ob_start();

            switch ( $template ) {
                case 'list':
                    \PDFEV\Template::render_archive_list_items( $query, $atts );
                    break;
                case 'grid':
                    \PDFEV\Template::render_archive_grid_items( $query, $atts );
                    break;
                case 'ebook':
                    \PDFEV\Template::render_archive_ebook_items( $query, $atts );
                    break;
                case 'newsletter':
                    \PDFEV\Template::render_archive_newsletter_items( $query, $atts );
                    break;
                default:
                    \PDFEV\Template::render_archive_list_items( $query, $atts );
                    break;
            }

            $html = ob_get_clean();
            $has_more = $query->max_num_pages > $paged;
            wp_send_json_success(array(
                'html' => $html,
                'has_more' => $has_more,
                'next_page' => $paged,
            ));
        }

        public static function get_read_button($atts=[]){
            $reading_counter = isset($atts['reading_count']) && $atts['reading_count']!='' ? $atts['reading_count'] :  get_option('pdfev_reading_counter');
            ?>
            <a href="<?php the_permalink(); ?>" class="button btn read-btn"><i class="fas fa-eye"></i> <?php echo esc_html__('Read','pdf-embed-viewer');?> <?php  echo  $reading_counter=='yes'? "(".PDFEV_Functions::get_post_view().")" : '' ;?></a>
            <?php
        }

        public static function read_button($atts=[]){
            $check_read_archive  =  isset($atts['read']) && $atts['read'] != ''? $atts['read'] : get_option('pdfev_archive_read');
            if($check_read_archive == 'yes'): 
                self::get_read_button($atts);
            endif;
        }

        public static function get_post_view() {
            $meta_key = 'pdfev_meta_views_count';
            $count = get_post_meta(get_the_ID(), $meta_key, true);
            return $count ? $count : 0;
        }

        public static function get_download_count() {
            $count_key = 'pdfev_meta_downloads_count';
            $count = get_post_meta(get_the_ID(), $count_key, true);
            return $count ? $count : 0;
        }

        public static function get_download_button($atts=[]){
            $download_counter = isset($atts['downloading_count']) && $atts['downloading_count']!='' ? $atts['downloading_count'] : get_option('pdfev_download_counter');
            $post_id = isset($atts['post_id']) ? $atts['post_id'] : get_the_ID();

            // In Pro "Hide File URL" mode, the download link is generated fresh
            // (single-use, short-lived) on click via AJAX instead of being a
            // static href in the page — see get_protected_download_url() and
            // the .download-btn click handler in assets/js/frontend.js.
            $protected = self::is_pro() && get_option('pdfev_pro_protection_mode') === 'stream';
        ?>
            <a class="button btn download-btn" href="<?php echo $protected ? '#' : esc_url(self::get_pdf_link($post_id)); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" <?php echo $protected ? 'data-protected="yes"' : 'download="' . esc_attr(sanitize_title(get_the_title($post_id))) . '"'; ?>>
                <i class="fas fa-cloud-download-alt"></i>
                <?php echo esc_html__('Download','pdf-embed-viewer'); ?>
                <?php if($download_counter=='yes'): ?>
                <span><?php esc_html_e('('); ?><span class="pdfev-download-counter"><?php echo self::get_download_count($post_id);?></span><?php esc_html_e(')'); ?></span>
                <?php endif; ?>
            </a>
        <?php
        }
        public static function download_button($atts=[]){
            $check_download_archive  =  isset($atts['download']) && $atts['download'] != ''? $atts['download'] : get_option('pdfev_archive_download');
            if($check_download_archive == 'yes'): 
                self::get_download_button($atts);
            endif;
        }

        public static function download_button_single_page_view($post_id){
            $check_download  = get_post_meta( $post_id, 'pdfev_meta_download', true );
            $atts['post_id'] = $post_id;
            if($check_download == 'yes'):
                self::get_download_button($atts);
            endif;
        }

        public static function archive_item_meta($atts = []){
           
            $show_description = isset($atts['show_description']) && $atts['show_description'] !== '' 
                ? $atts['show_description'] 
                : get_option('pdfev_show_description');

            $show_author = isset($atts['show_author']) && $atts['show_author'] !== '' 
                ? $atts['show_author'] 
                : get_option('pdfev_show_author');
            
            $show_total_pages = isset($atts['show_total_pages']) && $atts['show_total_pages'] !== '' 
                ? $atts['show_total_pages'] 
                : get_option('pdfev_show_total_pages');

            $show_filesize = isset($atts['show_filesize']) && $atts['show_filesize'] !== '' 
                ? $atts['show_filesize'] 
                : get_option('pdfev_show_filesize');

            $show_publisher = isset($atts['show_publisher']) && $atts['show_publisher'] !== '' 
                ? $atts['show_publisher'] 
                : get_option('pdfev_show_publisher');

            // ✅ NEW (split করা)
            $show_year = isset($atts['show_year']) && $atts['show_year'] !== '' 
                ? $atts['show_year'] 
                : get_option('pdfev_show_year');

            $show_edition = isset($atts['show_edition']) && $atts['show_edition'] !== '' 
                ? $atts['show_edition'] 
                : get_option('pdfev_show_edition');


            $author_html = [];
            $meta_parts = [];

            // ✅ Author
            if ($show_author === 'yes') {
                $author_terms = wp_get_post_terms(get_the_ID(), 'pdfev_author', ['fields' => 'names']);
                if (!empty($author_terms)) {
                    $author_html[] = sprintf(
                        '<span class="pdfev-meta-author">%s %s</span>',
                        esc_html__('by', 'pdf-embed-viewer'),
                        esc_html(implode(', ', $author_terms))
                    );
                }
                
                
            }

            if ($show_total_pages === 'yes') {
                $total_pages = get_post_meta(get_the_ID(), 'pdfev_meta_total_pages', true);
                if (!empty($total_pages)) {
                    $total_pages = $total_pages . ' ' . esc_html__('Pages', 'pdf-embed-viewer');
                } else {
                    $total_pages = '';
                }
                if (!empty($total_pages)) {
                    $author_html[] = sprintf(
                        '<span class="pdfev-meta-total-pages">%s</span>',
                        esc_html($total_pages)
                    );
                }
            }

            if ($show_filesize === 'yes') {
                $pdfev_size = get_post_meta(get_the_ID(), 'pdfev_meta_filesize', true);
                if (!empty($pdfev_size)) {
                    $pdfev_size = PDFEV_Functions::convert_file_size($pdfev_size);
                } else {
                    $pdfev_size = '';
                }
                if (!empty($pdfev_size)) {
                    $author_html[] = sprintf(
                        '<span class="pdfev-meta-filesize">%s</span>',
                        esc_html($pdfev_size)
                    );
                }
            }

            // ✅ Publisher
            if ($show_publisher === 'yes') {
                $publisher_terms = wp_get_post_terms(get_the_ID(), 'pdfev_publisher', ['fields' => 'names']);
                if (!empty($publisher_terms)) {
                    $meta_parts[] = sprintf(
                        '<span class="pdfev-meta-publisher">%s</span>',
                        esc_html(implode(', ', $publisher_terms))
                    );
                }
            }

            // ✅ NEW: Year
            if ($show_year === 'yes') {
                $year = get_post_meta(get_the_ID(), 'pdfev_meta_published_year', true);
                if (!empty($year)) {
                    $meta_parts[] = sprintf(
                        '<span class="pdfev-meta-year">%s</span>',
                        esc_html($year)
                    );
                }
            }

            // ✅ NEW: Edition
            if ($show_edition === 'yes') {
                $edition = get_post_meta(get_the_ID(), 'pdfev_meta_edition', true);
                if (!empty($edition)) {
                    $meta_parts[] = sprintf(
                        '<span class="pdfev-meta-edition">%s</span>',
                        esc_html($edition)
                    );
                }
            }

            // ✅ Output

            if (!empty($author_html)) {
                echo '<div class="pdfev-archive-meta">' . implode(' • ', $author_html) . '</div>';
            }

            if ($show_description === 'yes') {
                $description = get_post_meta(get_the_ID(), 'pdfev_meta_description', true);
                if (!empty($description)) {
                    echo '<div class="pdfev-archive-description">' . wp_kses_post(wpautop($description)) . '</div>';
                }
            }

            if (!empty($meta_parts)) {
                echo '<div class="pdfev-archive-meta">' . implode(' • ', $meta_parts) . '</div>';
            }
        }

        
        public static function back_to_archive(){
            $shortcode_page_url  = get_option('pdfev_shortcode_page_url');
            $archive_link = get_post_type_archive_link(PDFEV_Functions::get_cpt_name());
            $back_link = $shortcode_page_url=='' ? $archive_link : home_url( '/' . $shortcode_page_url );
            ?>
                
                <a href="<?php echo esc_attr($back_link); ?>" class="back-button"><i class="fas fa-reply"></i> <?php _e('Back to overview','pdf-embed-viewer') ?></a>
               
            <?php
        }
        public static function convert_file_size($bytes){
            $bytes = (float) $bytes;
            if ($bytes <= 0) {
                return '0 KB';
            }
            if ($bytes >= 1024 * 1024) {
                return number_format($bytes / (1024 * 1024), 2) . ' MB';
            }
            return number_format($bytes / 1024, 2) . ' KB';
        }
    }
    
    new PDFEV_Functions();
}
