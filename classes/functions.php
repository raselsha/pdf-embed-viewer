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

        public static function load_plugin_textdomain() {
            $plugin_dir = basename( dirname( __DIR__ ) ) . "/languages/";
			load_plugin_textdomain( 'pdf-embed-viewer', false, $plugin_dir );
        }

        /**
         * Cached Appsero\Client instance, so insights() isn't re-created on every call.
         * Used only for this plugin's own opt-in telemetry — licensing is handled
         * entirely by the separate pdf-embed-viewer-pro add-on's own Appsero project.
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

        public static function appsero_init_tracker() {
            $client = self::get_appsero_client();
            $client->insights()->init();
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
            // Let an add-on (e.g. pdf-embed-viewer-pro) say "don't print a
            // working URL into this page's markup at all" — its JS then fetches
            // one on demand instead, so nothing in view-source/DOM inspection
            // is a link a copy/paste can reuse elsewhere.
            $is_protected = apply_filters('pdfev_pdf_is_protected', false, $post_id);
            $display_link = $is_protected ? '' : $link;
            $rtl = get_post_meta($post_id, 'pdfev_meta_rtl', true) === 'yes';
            $flipbook = get_option('pdfev_flipbook_status');
            $flipbook = $flipbook ? $flipbook : 'yes';
            ?>
            <div class="pdfev-embed-viewer">
                <?php if ( ! is_singular( PDFEV_Functions::get_cpt_name() ) ) : ?>
                    <?php do_action('pdfev_template_single_meta', $atts); ?>
                <?php endif; ?>
                <div class="pdfev-display-switcher">
                    <div class="toggle-button">
                        <?php
                        $show_view_switcher = get_option('pdfev_show_view_switcher');
                        $show_view_switcher = $show_view_switcher ? $show_view_switcher : 'yes';
                        if ( $show_view_switcher === 'yes' ) :
                        ?>
                        <a class="button btn pdfev-show-flipbook <?php echo esc_attr($flipbook=='yes'?'active':''); ?>"><i class="fas fa-book-open"></i> <?php _e('Flipbook','pdf-embed-viewer'); ?></a>
                        <a class="button btn pdfev-show-traditional <?php echo esc_attr($flipbook=='yes'?'':'active'); ?>"><i class="fas fa-book"></i> <?php _e('Traditional','pdf-embed-viewer'); ?></a>
                        <?php endif; ?>
                        <?php
                        if(!is_singular(PDFEV_Functions::get_cpt_name())):
                            PDFEV_Functions::download_button_single_page_view($post_id, $atts);
                        endif;
                        ?>
                    </div>
                    <div class="pdfev-3dbook-container" style="display: <?php echo esc_attr($flipbook=='yes'?'block':'none'); ?>;">
                        <div class="pdfev-3dbook-viewer" id="pdfev-3dbook-<?php echo esc_attr($post_id); ?>" data-id="<?php echo esc_attr($post_id); ?>" data-pdfev-url="<?php echo esc_attr($display_link); ?>" data-pdfev-rtl="<?php echo $rtl ? 'yes' : 'no'; ?>" <?php echo $is_protected ? 'data-pdfev-protected="yes"' : ''; ?>></div>
                    </div>
                    <div class="pdfev-traditional-container" style="display: <?php echo esc_attr($flipbook=='yes'?'none':'block'); ?>;">
                        <iframe class="pdf-viewer" data-id="<?php echo esc_attr($post_id); ?>" src="<?php echo esc_attr($display_link); ?>" <?php echo $is_protected ? 'data-pdfev-protected="yes"' : ''; ?> frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <?php
        }

        public static function get_cpt_name(){
            return 'pdfev_embed_viewer';
        }

        public static function get_post_order(){
            return 'DESC';
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

            // Let an add-on (e.g. pdf-embed-viewer-pro) replace the direct local URL
            // with a protected one (falls back to the direct URL below when no
            // add-on hooks in, or when it returns false for this post/file).
            $protected_link = apply_filters('pdfev_local_pdf_link', false, $post_id, $link);
            if ($protected_link) {
                return $protected_link;
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

            $order = $order ? strtoupper( $order ) : self::get_post_order();
            $order = in_array( $order, [ 'ASC', 'DESC' ], true ) ? $order : 'DESC';

            $args = array(
                'post_type' => self::get_cpt_name(),
                'post_status' => 'publish',
                // Mirror get_archive_query()'s ordering exactly (menu_order first,
                // date as the tiebreaker) so "Load More" pagination never re-sorts
                // items relative to the page that loaded first. The newsletter
                // template paginates by year tab instead of this AJAX handler, so
                // it never reaches this branch.
                'orderby' => [ 'menu_order' => 'ASC', 'date' => $order ],
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

            // Default (free-tier) attributes: a direct link with the browser
            // `download` attribute. An add-on (e.g. pdf-embed-viewer-pro) can
            // override this via filter to render a protected, on-demand-generated
            // download link instead — see the .download-btn click handler in
            // assets/js/frontend.js, which already reacts generically to
            // data-protected/response.download_url without knowing why.
            $attrs = apply_filters('pdfev_download_button_attrs', [
                'href'           => esc_url(self::get_pdf_link($post_id)),
                'download'       => sanitize_title(get_the_title($post_id)),
                'data_protected' => false,
            ], $post_id);
        ?>
            <a class="button btn download-btn" href="<?php echo !empty($attrs['data_protected']) ? '#' : esc_url($attrs['href']); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" <?php echo !empty($attrs['data_protected']) ? 'data-protected="yes"' : (!empty($attrs['download']) ? 'download="' . esc_attr($attrs['download']) . '"' : ''); ?>>
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

        /**
         * $shortcode_atts['show_download'], if explicitly passed (e.g.
         * [pdfev_embed_viewer id="215" show_download="no"]), overrides this
         * post's own pdfev_meta_download metabox setting for just this one
         * embed — the same override-the-post-default pattern every other
         * show_* shortcode attribute already follows (see archive_item_meta
         * above). Falls back to the post meta when not passed, so existing
         * embeds with no show_download attribute keep behaving exactly as
         * before.
         */
        public static function download_button_single_page_view($post_id, $shortcode_atts = []){
            $show_download = isset($shortcode_atts['show_download']) && $shortcode_atts['show_download'] !== ''
                ? $shortcode_atts['show_download']
                : get_post_meta( $post_id, 'pdfev_meta_download', true );
            $atts['post_id'] = $post_id;
            if($show_download == 'yes'):
                self::get_download_button($atts);
            endif;
        }

        /**
         * $parts controls which pieces this prints — 'all' (default,
         * preserves every existing call site's behavior: author/pages/
         * filesize, then description, then publisher/year/edition, in that
         * fixed order) or 'description'/'meta' (meta = everything except
         * description) individually, so a template that wants description
         * positioned somewhere other than between the two meta blocks (e.g.
         * the grid template's title → description → cover → meta order) can
         * call this twice instead of fighting the combined block's fixed
         * internal order.
         */
        public static function archive_item_meta($atts = [], $parts = 'all'){
           
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


            // Each entry carries both a pre-joined 'bullet' string (the
            // original "value1 • value2" line every non-grid caller still
            // gets) and a plain 'label'/'value' pair (grid's own row
            // layout, see the $parts === 'meta' branch below) — built once
            // per field so switching layouts doesn't mean two separate
            // passes over post terms/meta.
            $group1 = []; // author, pages, filesize
            $group2 = []; // publisher, year, edition

            // ✅ Author
            if ($show_author === 'yes') {
                $author_terms = wp_get_post_terms(get_the_ID(), 'pdfev_author', ['fields' => 'names']);
                if (!empty($author_terms)) {
                    $author_value = esc_html(implode(', ', $author_terms));
                    $group1[] = [
                        'label'  => esc_html__('Author', 'pdf-embed-viewer'),
                        'value'  => $author_value,
                        'bullet' => sprintf(
                            '<span class="pdfev-meta-author">%s %s</span>',
                            esc_html__('by', 'pdf-embed-viewer'),
                            $author_value
                        ),
                    ];
                }
            }

            if ($show_total_pages === 'yes') {
                $total_pages = get_post_meta(get_the_ID(), 'pdfev_meta_total_pages', true);
                if (!empty($total_pages)) {
                    $group1[] = [
                        'label'  => esc_html__('Pages', 'pdf-embed-viewer'),
                        'value'  => esc_html($total_pages),
                        'bullet' => sprintf(
                            '<span class="pdfev-meta-total-pages">%s</span>',
                            esc_html($total_pages . ' ' . esc_html__('Pages', 'pdf-embed-viewer'))
                        ),
                    ];
                }
            }

            if ($show_filesize === 'yes') {
                $pdfev_size = get_post_meta(get_the_ID(), 'pdfev_meta_filesize', true);
                if (!empty($pdfev_size)) {
                    $pdfev_size = esc_html(PDFEV_Functions::convert_file_size($pdfev_size));
                    $group1[] = [
                        'label'  => esc_html__('File size', 'pdf-embed-viewer'),
                        'value'  => $pdfev_size,
                        'bullet' => sprintf('<span class="pdfev-meta-filesize">%s</span>', $pdfev_size),
                    ];
                }
            }

            // ✅ Publisher
            if ($show_publisher === 'yes') {
                $publisher_terms = wp_get_post_terms(get_the_ID(), 'pdfev_publisher', ['fields' => 'names']);
                if (!empty($publisher_terms)) {
                    $publisher_value = esc_html(implode(', ', $publisher_terms));
                    $group2[] = [
                        'label'  => esc_html__('Publisher', 'pdf-embed-viewer'),
                        'value'  => $publisher_value,
                        'bullet' => sprintf('<span class="pdfev-meta-publisher">%s</span>', $publisher_value),
                    ];
                }
            }

            // ✅ NEW: Year
            if ($show_year === 'yes') {
                $year = get_post_meta(get_the_ID(), 'pdfev_meta_published_year', true);
                if (!empty($year)) {
                    $year = esc_html($year);
                    $group2[] = [
                        'label'  => esc_html__('Year', 'pdf-embed-viewer'),
                        'value'  => $year,
                        'bullet' => sprintf('<span class="pdfev-meta-year">%s</span>', $year),
                    ];
                }
            }

            // ✅ NEW: Edition
            if ($show_edition === 'yes') {
                $edition = get_post_meta(get_the_ID(), 'pdfev_meta_edition', true);
                if (!empty($edition)) {
                    $edition = esc_html($edition);
                    $group2[] = [
                        'label'  => esc_html__('Edition', 'pdf-embed-viewer'),
                        'value'  => $edition,
                        'bullet' => sprintf('<span class="pdfev-meta-edition">%s</span>', $edition),
                    ];
                }
            }

            // ✅ Output
            //
            // 'meta' is only ever passed by the grid template — every other
            // caller (list/newsletter/ebook/single-page) passes 'all' and
            // keeps the original bullet-joined line untouched, so this row
            // layout is grid-only.
            if ($parts === 'meta') {
                $rows = array_merge($group1, $group2);
                if (!empty($rows)) {
                    echo '<div class="pdfev-archive-meta pdfev-archive-meta-rows">';
                    foreach ($rows as $row) {
                        echo '<div class="pdfev-meta-row"><span class="pdfev-meta-label">' . $row['label'] . '</span><span class="pdfev-meta-value">' . $row['value'] . '</span></div>';
                    }
                    echo '</div>';
                }
                return;
            }

            if ($parts !== 'description' && !empty($group1)) {
                echo '<div class="pdfev-archive-meta">' . implode(' • ', array_column($group1, 'bullet')) . '</div>';
            }

            if ($parts !== 'meta' && $show_description === 'yes') {
                $description = get_post_meta(get_the_ID(), 'pdfev_meta_description', true);
                if (!empty($description)) {
                    echo '<div class="pdfev-archive-description">' . wp_kses_post(wpautop($description)) . '</div>';
                }
            }

            if ($parts !== 'description' && !empty($group2)) {
                echo '<div class="pdfev-archive-meta">' . implode(' • ', array_column($group2, 'bullet')) . '</div>';
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
