<?php
/**
 * Insert demo class
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'PDFEV_Insert_Demo' ) ) {

    class PDFEV_Insert_Demo {

        public function __construct() {
            add_action('wp_ajax_pdfev_import_demo_data', array($this,'import_demo_data')); 
        }

        public function import_demo_data(){
            
            if( isset( $_POST['ajaxnonce'] ) ){
                if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['ajaxnonce'] ) ) , 'pdf_ajax_nonce' ) ){
                    wp_send_json_error('Invalid nonce');
                    return;
                }
            }

            $success = $this->insert_demo_post_xml();

            // Prepare the response
            $response = array(
                'success' => $success, // This should be true or false based on the function result
                'message' => $success ? __('Demo Data imported successfully!', 'pdf-embed-viewer') : __('Failed to import data.', 'pdf-embed-viewer')
            );
            wp_send_json($response);
            wp_die(); // End AJAX request

        }

        public function insert_demo_post_xml(){
            $dummy = $this->dummy_data();
            foreach ($dummy as $key => $dummy_data) {
                $pdf_attached = PDFEV_Functions::insert_media($dummy_data['pdf_file']);
                $image_attached = PDFEV_Functions::insert_media(($dummy_data['image_file']));
                $dummy_data['meta_data']['pdfev_meta_pdf_url'] = $pdf_attached['url'];
                $post_id = wp_insert_post([
                    'post_title' => $dummy_data['title'],
                    'post_status' => 'publish',
                    'post_type' => PDFEV_Functions::get_cpt_name(),
                ]);
                if (array_key_exists('meta_data', $dummy_data)) {
                    foreach ($dummy_data['meta_data'] as $meta_key => $data) {
                        update_post_meta($post_id, $meta_key, $data);
                    }
                }
                set_post_thumbnail( $post_id, $image_attached['id']??'' );
                
            }
            $this->create_demo_pages();
            return true;
        }

        public function dummy_data(){
            return [
                [
                    'title' => 'Pdf books',
                    'pdf_file' => PDFEV_Const_Path.'assets/demo/book-1.pdf',
                    'image_file' => PDFEV_Const_Path.'assets/demo/book-1.png',
                    'meta_data' => [
                        'pdfev_meta_pdf_url' => '',
                        'pdfev_meta_download' => 'yes',
                    ],
                    
                ],
                [
                    'title' => 'Pdf books',
                    'pdf_file' => PDFEV_Const_Path.'assets/demo/book-2.pdf',
                    'image_file' => PDFEV_Const_Path.'assets/demo/book-2.png',
                    'meta_data' => [
                        'pdfev_meta_pdf_url' => '',
                        'pdfev_meta_download' => 'yes',
                    ],
                    
                ],
            ];
        }

        public function insert_demo_post() {
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

        public function create_demo_pages() {
            $pages = [
                'Pdf Library List view'    =>  '[pdfev_viewer template="list"]',
                'Pdf Library Grid view'    =>  '[pdfev_viewer template="grid"]',
                'Pdf Library Newsletter view'    =>  '[pdfev_viewer template="newsletter"]',
                'Pdf Library Ebook view'    =>  '[pdfev_viewer template="ebook"]',
            ];
        
            foreach ( $pages as $title => $content ) {
                if ( null == get_page_by_title( $title ) ) {
                    wp_insert_post([
                        'post_title'   => $title,
                        'post_content' => $content,
                        'post_status'  => 'publish',
                        'post_type'    => 'page',
                    ]);
                }
            }
        }        
    }
    new PDFEV_Insert_Demo();
}