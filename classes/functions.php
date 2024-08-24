<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 * @since 1.0.3
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Functions') ){
    class PDFEV_Functions{
        
        public function __construct() {
            add_action( 'plugins_loaded', ['PDFEV_Functions','load_plugin_textdomain'] );  
            add_action( 'plugins_loaded', ['PDFEV_Functions','appsero_init_tracker'] );   
            add_action( 'init', ['PDFEV_Functions','insert_demo_post'] );   
            add_action( 'init', ['PDFEV_Functions','insert_media'] );   
        }

        public static function load_plugin_textdomain() {
            load_plugin_textdomain( 'pdf-embed-viewer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public static function appsero_init_tracker() {

            if ( ! class_exists( 'Appsero\Client' ) ) {
            require_once PDFEV_Embed_Viewer_Path . '/vendor/appsero/src/Client.php';
            }
            $client = new Appsero\Client( 'efdff7cb-2ab8-4e9a-a19f-9ca95f4a5b42', 'PDF Embed Viewer', __FILE__ );
            $client->insights()->init();

        }


        public static function insert_demo_post() {
            
            
            // Create an array of demo post data
            for($i=1; $i<6;$i++){
                $post_data = array(
                    'post_title'    => 'Demo Pdf '.$i,
                    'post_content'  => 'This is the content of demo post '.$i,
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'pdfev_embed_viewer',
                    'post_name'    => 'demo-pdf-'.$i
                );
                
                if ( ! get_page_by_path( 'demo-pdf-'.$i, OBJECT, 'pdfev_embed_viewer' ) ) {
                    $post_id = wp_insert_post( $post_data );
                    if (!is_wp_error($post_id)) {
                        
                        $meta_data = array(
                            'pdfev_emd_vwr_file_url' => PDFEV_Embed_Viewer_URL.'assets/images/sample.pdf',
                            'pdfev_emd_vwr_check_download' => 'yes',
                        );

                        foreach ($meta_data as $meta_key => $meta_value) {
                            update_post_meta($post_id, $meta_key, $meta_value);
                        }

                        require_once(ABSPATH . "wp-admin" . '/includes/image.php');

                        //set_post_thumbnail( $post_id, $attachment_id );

                    } else {
                        echo 'Error inserting post: ' . $post_id->get_error_message();
                    }
                }
            }
        }

        public static function insert_media() {
            $temp_file = PDFEV_Embed_Viewer_Path.'assets/images/pdf-book.png';
            // Download the file to a temporary location
            // $temp_file = download_url($file_url);
            // if (is_wp_error($temp_file)) {
            //     return 'File download failed: ' . $temp_file->get_error_message();
            // }

            // Load necessary WordPress files
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            // Prepare the file
            $file = array(
                'name'     => basename($temp_file),
                'type'     => mime_content_type($temp_file),
                'tmp_name' => $temp_file,
                'error'    => 0,
                'size'     => filesize($temp_file),
            );

            // Handle file upload
            $upload = wp_handle_sideload($file, array('test_form' => false));
            if (isset($upload['error'])) {
                return 'File upload failed: ' . $upload['error'];
            }

            // Add the file to the media library
            $attachment = array(
                'post_mime_type' => $upload['type'],
                'post_title'     => sanitize_file_name($upload['file']),
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

            // Clean up temporary file
            @unlink($temp_file);

            return array(
                'attachment_id' => $attachment_id,
                'attachment_url' => wp_get_attachment_url($attachment_id),
            );
        }
    }
    
    new PDFEV_Functions();
}