<?php

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('SH_PDF_Embed_Viewer_Enque') ){
    class SH_PDF_Embed_Viewer_Enque{
        public function __construct()
        {
            add_action('admin_enqueue_scripts',[$this,'backend_style']);
            add_action('wp_enqueue_scripts',[$this,'frontend_style']);
        }

        public function frontend_style(){
            wp_register_style('pdf-download',SH_PDF_EMBED_VIEWER.'assets/css/style.css',[],'1.0.0','all');
            wp_register_script( 'pdf-download', SH_PDF_EMBED_VIEWER.'assets/js/script.js',[],'1.0.0',true);
            
            wp_enqueue_style('pdf-download');
            wp_enqueue_script('pdf-download');

            $options = get_option('pdf_download_option');

            if( isset($options['primary_color'])){
                $primary_color = esc_attr($options['primary_color']);
                $secondary_color = esc_attr($options['secondary_color']);
                $light_color = esc_attr($options['light_color']);
                $dark_color =esc_attr( $options['dark_color']);
                $css = "
                    :root{
                        --pdfd-primary-color:{$primary_color};        
                        --pdfd-secondary-color:{$secondary_color}; 
                        --pdfd-light-color:{$light_color};       
                        --pdfd-dark-color:{$dark_color};     
                    ";
                wp_add_inline_style('pdf-download', $css);
            }
            
        }

        public function backend_style(){

            wp_register_style('main',SH_PDF_EMBED_VIEWER.'assets/css/style.css',[],'','all');
            wp_enqueue_style('main');

            wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', []);
            wp_enqueue_script( 'jquery-ui' );
            wp_enqueue_style( 'wp-color-picker' ); 

            wp_register_script( 'pdf-embed-viewer', SH_PDF_EMBED_VIEWER_URL.'assets/js/script.js', ['wp-color-picker'], false, true );
            wp_enqueue_script( 'pdf-embed-viewer' );

        }
    }
    
    $SH_PDF_Embed_Viewer_Enque = new SH_PDF_Embed_Viewer_Enque();
}