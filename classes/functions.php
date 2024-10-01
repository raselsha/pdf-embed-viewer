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


        public static function insert_demo_post() {
            $image = PDFEV_Const_Path.'assets/images/book-image.png';
            $pdf = PDFEV_Const_Path.'assets/images/pdf-book-sample.pdf';
            $image_attached = PDFEV_Functions::insert_media($image);
            $pdf_attached = PDFEV_Functions::insert_media($pdf);
            $months = ["", "January", "February", "March", "April", "May", "June"];
            // Create an array of demo post data
            for($i=1; $i<7;$i++){
                $post_data = array(
                    'post_title'    => 'Newsletter '.$months[$i],
                    'post_content'  => 'This is the content of demo post '.$i,
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_date'     => '2024-'.$i.'-24 12:00:00',
                    'post_type'     => PDFEV_Functions::get_cpt_name(),
                );
                
                if ( ! get_page_by_path( 'demo-pdf-'.$i, OBJECT, PDFEV_Functions::get_cpt_name() ) ) {
                    $post_id = wp_insert_post( $post_data );
                    if (!is_wp_error($post_id)) {
                        
                        $meta_data = array(
                            'pdfev_meta_pdf_url' => $pdf_attached['url']??'',
                            'pdfev_meta_download' => 'yes',
                        );

                        foreach ($meta_data as $meta_key => $meta_value) {
                            update_post_meta($post_id, $meta_key, $meta_value);
                        }

                        require_once(ABSPATH . "wp-admin" . '/includes/image.php');

                        set_post_thumbnail( $post_id, $image_attached['id']??'' );

                    } else {
                        echo 'Error inserting post: ' . $post_id->get_error_message();
                    }
                }
            }
            return true;
        }

        public static function insert_media($file_path) {

            $attachment = PDFEV_Functions::does_attachment_exist(basename($file_path));
            
            if( empty($attachment) ){
                // Load necessary WordPress files
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');

                // Prepare the file
                $file = array(
                    'name'     => basename($file_path),
                    'type'     => mime_content_type($file_path),
                    'tmp_name' => $file_path,
                    'error'    => 0,
                    'size'     => filesize($file_path),
                );

                // Handle file upload
                $upload = wp_handle_sideload($file, array('test_form' => false));
                if (isset($upload['error'])) {
                    return 'File upload failed: ' . $upload['error'];
                }

                // Add the file to the media library
                $attachment = array(
                    'post_mime_type' => $upload['type'],
                    'post_title'     => sanitize_file_name(pathinfo($file_path, PATHINFO_FILENAME)),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $attachment_id = wp_insert_attachment($attachment, $upload['file']);
                if (is_wp_error($attachment_id)) {
                    return 'Attachment insert failed: ' . $attachment_id->get_error_message();
                }

                // Generate metadata and update attachment
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                wp_update_attachment_metadata($attachment_id, $attachment_data);

                $attachment = array(
                    'id' => $attachment_id,
                    'url' => wp_get_attachment_url($attachment_id),
                );

                return $attachment;
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
            echo isset($archive_title) ? esc_html($archive_title) : '';
        }

        public static function read_button(){
            ?>
            <a href="<?php the_permalink(); ?>" class="read-btn"><i class="far fa-address-book"></i> <?php echo esc_html__('Read','pdf-embed-viewer');?> <?php echo self::get_post_view();?></a>
            <?php
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
        ?>
            <a href="<?php PDFEV_Functions::pdf_link(); ?>" class="download-btn" data-post-id="<?php echo get_the_ID(); ?>" download><?php echo esc_html__('Download','pdf-embed-viewer'); ?><img src="<?php echo esc_attr(PDFEV_Const_URL.'assets/images/download.svg'); ?>" alt="<?php echo esc_html__('Download icon','pdf-embed-viewer'); ?>"> <span class="pdfev-download-counter"><?php echo esc_html(self::get_download_count(get_the_ID()));?></span> </a>
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
            ?>
                <a href="<?php echo esc_url(get_post_type_archive_link(PDFEV_Functions::get_cpt_name())); ?>" class="back-button"><i class="fas fa-arrow-left"></i> <?php _e('Back to overview','pdf-embed-viewer') ?></a>
            <?php
        }
    }
    
    new PDFEV_Functions();
}