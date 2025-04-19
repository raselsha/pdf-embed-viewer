<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.2
 * @since 1.0.3
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Functions') ){
    class PDFEV_Functions{
        
        public function __construct() {
            add_action( 'plugins_loaded', ['PDFEV_Functions','load_plugin_textdomain'] );  
            add_action( 'plugins_loaded', ['PDFEV_Functions','appsero_init_tracker'] );          
        }

        public static function load_plugin_textdomain() {
            load_plugin_textdomain( 'pdf-embed-viewer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public static function appsero_init_tracker() {

            if ( ! class_exists( 'Appsero\Client' ) ) {
            require_once PDFEV_Const_Path . '/vendor/appsero/src/Client.php';
            }
            $client = new Appsero\Client( 'efdff7cb-2ab8-4e9a-a19f-9ca95f4a5b42', 'PDF Embed Viewer', __FILE__ );
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
            $link = get_post_meta($post_id, 'pdfev_meta_pdf_url', true );
            ?>
            <div class="pdfev-embed-viewer-shortcode">
                <?php  PDFEV_Functions::download_button_page_view($post_id); ?>
                <iframe class="pdf-viewer" src="<?php echo esc_attr($link); ?>" frameborder="0"></iframe>
            </div>
            <?php
        }
        public static function get_cpt_name(){
            return 'pdfev_embed_viewer';
        }

        public static function get_post_order(){
            return 'DSC';
        }
        
        public static function get_pdf_link(){
            $link = get_post_meta( get_the_ID(), 'pdfev_meta_pdf_url', true );
            $link = $link??'';
            return $link;
        }

        public static function pdf_link(){
            $link = self::get_pdf_link();
            echo esc_attr($link);
        }

        public static function archive_title(){
            $archive_title = get_option('pdfev_archive_title');
            if ( is_post_type_archive( 'pdfev_embed_viewer' ) ) {
                echo isset($archive_title) ? esc_html($archive_title) : '';
            }
        }

        public static function get_read_button(){
            $reading_counter  =  get_option('pdfev_reading_counter');
            ?>
            <a href="<?php the_permalink(); ?>" class="button btn read-btn"><i class="fas fa-eye"></i> <?php echo esc_html__('Read','pdf-embed-viewer');?> <?php  echo  $reading_counter=='yes'? "(".self::get_post_view().")" : '' ;?></a>
            <?php
        }

        public static function read_button(){
            $check_read_archive  =  get_option('pdfev_archive_read');
            if($check_read_archive == 'yes'): 
                self::get_read_button();
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

        public static function get_download_button(){
            $download_counter  =  get_option('pdfev_download_counter');
        ?>
            <a class="button btn download-btn" href="<?php PDFEV_Functions::pdf_link(); ?>" data-post-id="<?php echo get_the_ID(); ?>" download="<?php echo sanitize_title(get_the_title()); ?>"> 
                <i class="fas fa-cloud-download-alt"></i> 
                <?php echo esc_html__('Download','pdf-embed-viewer'); ?>
                <?php if($download_counter=='yes'): ?>
                <span><?php esc_html_e('('); ?><span class="pdfev-download-counter"><?php echo self::get_download_count(get_the_ID());?></span><?php esc_html_e(')'); ?></span>
                <?php endif; ?>
            </a>
        <?php
        }
        public static function download_button(){
            
            $check_download_archive  =  get_option('pdfev_archive_download');
            if($check_download_archive == 'yes'): 
                self::get_download_button();
            endif;
        }

        public static function download_button_page_view($post_id){
            $check_download  = get_post_meta( $post_id, 'pdfev_meta_download', true );
            if($check_download == 'yes'):
                self::get_download_button();
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

        public static function generate_pdf_thumbnail( $pdf_path, $output_path) {
            if ( ! class_exists( 'Imagick' ) ) {
                error_log( 'Imagick not installed' );
                return false;
            }
        
            if ( ! file_exists( $pdf_path ) ) {
                error_log( 'PDF file not found: ' . $pdf_path );
                return false;
            }
        
            if ( ! is_writable( dirname( $output_path ) ) ) {
                error_log( 'Output directory not writable: ' . dirname( $output_path ) );
                return false;
            }
            try {
                $imagick = new Imagick();
                $imagick->setResolution(150, 150);
                $imagick->readImage($pdf_path);
                $imagick->setIteratorIndex(0); // First page
                $imagick->setImageFormat('png');
                $imagick->setImageCompressionQuality(90);
                $imagick->writeImage($output_path);
                $imagick->clear();
                $imagick->destroy();
                return $output_path;
            } catch (Exception $e) {
                error_log( 'PDF thumbnail error: ' . $e->getMessage() );
                return false;
            }
        }        
        
    }
    
    new PDFEV_Functions();
}
