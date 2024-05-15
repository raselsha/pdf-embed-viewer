<?php

if( ! class_exists('PDF_Download_Metabox') ){
    
    class PDF_Download_Metabox{
        
        public function __construct() {
            add_action( 'add_meta_boxes' , array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post' , array( $this, 'save_post') );
            add_action( 'admin_enqueue_scripts', array( $this,'load_admin_scripts'),10,1);
        }

        public function add_meta_boxes(){
            add_meta_box(
                'pdfdownload-metabox',
                __('PDF Upload', 'pdf-download' ),
                array($this,'meta_box_inner'),
                'pdfdownload',
                'normal',
                'high',
            );
        }

        public function meta_box_inner($post){

            require_once SH_PDF_EMBED_VIEWER . 'views/pdf-download-metabox.php';
        }

        
        public function load_admin_scripts( $hook ) {
            global $typenow;
            if( $typenow == 'pdfdownload' ) {
                wp_enqueue_media();
                wp_register_script('meta-box-image',SH_PDF_EMBED_VIEWER_URL.'assets/js/media.js',array( 'jquery' ),time(),true);
                wp_localize_script( 'meta-box-image', 'meta_image',
                    array(
                        'title' => __( 'Choose or Upload', 'pdf-download' ),
                        'button' => __( 'Use this file', 'pdf-download' ),
                    )
                );
                wp_enqueue_script( 'meta-box-image' );
            }
        }

        public function save_post($post_id){

            if( isset( $_POST['pdfdownload_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['pdfdownload_nonce'], 'pdfdownload_nonce' ) ){
                    return;
                }
            }

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( isset($_POST['post_type']) && $_POST['post_type'] === 'pdfdownload' ){
                if( ! current_user_can('edit_page',$post_id) ){
                    return;
                }
                elseif( ! current_user_can('edit_post',$post_id) ){
                    return;
                }
            }   

            if( isset($_POST['action']) and $_POST['action']=='editpost' ){
                $old_data = get_post_meta($post_id,'pdfdownload_file',true);
                $new_data = $_POST['pdfdownload_file'];

                update_post_meta($post_id,'pdfdownload_file',sanitize_url($new_data), $old_data);
            }
        }
        
    }
    $pdf_download_metabox = new PDF_Download_Metabox();
}