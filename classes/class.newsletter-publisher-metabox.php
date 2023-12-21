<?php

if( ! class_exists('Newsletter_Publisher_Metabox') ){
    
    class Newsletter_Publisher_Metabox{
        
        public function __construct() {
            add_action( 'add_meta_boxes' , array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post' , array( $this, 'save_post') );
            add_action( 'admin_enqueue_scripts', array( $this,'load_admin_scripts'),10,1);
        }

        public function add_meta_boxes(){
            add_meta_box(
                'newsletter-meta-box',
                'Newsletter Options',
                array($this,'meta_box_inner'),
                'newsletter',
                'normal',
                'high',
            );
        }

        public function meta_box_inner($post){

            require_once NEWSLETTER_PUB_PATH . 'views/view.metabox.php';
        }

        
        public function load_admin_scripts( $hook ) {
            global $typenow;
            if( $typenow == 'newsletter' ) {
                wp_enqueue_media();
                wp_enqueue_script('meta-box-image',NEWSLETTER_PUB_URL.'assets/js/media.js',array( 'jquery' ),time(),true);
                wp_localize_script( 'meta-box-image', 'meta_image',
                    array(
                        'title' => __( 'Choose or Upload Media', 'newsletter-publisher' ),
                        'button' => __( 'Use this media', 'newsletter-publisher' ),
                    )
                );
                wp_enqueue_script( 'meta-box-image' );
            }
        }

        public function save_post($post_id){
            if( isset($_POST['action']) and $_POST['action']=='editpost' ){
                $old_data = get_post_meta($post_id,'newsletter_file',true);
                $new_data = $_POST['newsletter_file'];

                update_post_meta($post_id,'newsletter_file',sanitize_url($new_data), $old_data);
            }
        }
        
    }

}