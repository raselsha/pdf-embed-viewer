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
                $url = esc_url_raw($_GET['pdfev_proxy']);

                if (preg_match('/\.pdf$/i', $url)) {
                    $response = wp_remote_get($url, ['timeout' => 60]);

                    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                        
                        echo wp_remote_retrieve_body($response);
                        header('Content-Type: application/pdf');
                        header('Content-Disposition: inline; filename="proxy.pdf"');
                        header('Accept-Ranges: bytes');
                    } else {
                        status_header(404);
                        echo 'PDF could not be loaded.';
                    }
                } else {
                    status_header(403);
                    echo 'Invalid file type.';
                }
                exit;
            }
        }

        public static function load_plugin_textdomain() {
            $plugin_dir = basename( dirname( __DIR__ ) ) . "/languages/";
			load_plugin_textdomain( 'pdf-embed-viewer', false, $plugin_dir );
        }

        public static function appsero_init_tracker() {

            if ( ! class_exists( 'Appsero\Client' ) ) {
            require_once PDFEV_Const_Path . '/vendor/appsero/src/Client.php';
            }
            $client = new Appsero\Client( 'efdff7cb-2ab8-4e9a-a19f-9ca95f4a5b42', '3D Flipbook PDF Viewer & Embedder Plugin Activated!', __FILE__ );
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

        public static function shortcode_view($post_id){
            $link = \PDFEV_Functions::get_pdf_link($post_id);
            $flipbook = get_option('pdfev_flipbook_status');
            $flipbook = $flipbook ? $flipbook : 'yes';
            ?>
            <div class="pdfev-embed-viewer">
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
        ?>
            <a class="button btn download-btn" href="<?php PDFEV_Functions::pdf_link($post_id); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" download="<?php echo sanitize_title(get_the_title($post_id)); ?>"> 
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

        public static function back_to_archive(){
            $shortcode_page_url  = get_option('pdfev_shortcode_page_url');
            $archive_link = get_post_type_archive_link(PDFEV_Functions::get_cpt_name());
            $back_link = $shortcode_page_url=='' ? $archive_link : home_url( '/' . $shortcode_page_url );
            ?>
                
                <a href="<?php echo esc_attr($back_link); ?>" class="back-button"><i class="fas fa-reply"></i> <?php _e('Back to overview','pdf-embed-viewer') ?></a>
               
            <?php
        }

    }
    
    new PDFEV_Functions();
}
