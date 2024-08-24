<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Enque_Style') ){
    class PDFEV_Enque_Style{
        public function __construct()
        {
            add_action('admin_enqueue_scripts',[$this,'backend_style']);
            add_action('wp_enqueue_scripts',[$this,'frontend_style']);
        }

        public function backend_style(){
            wp_enqueue_style('main',PDFEV_Const_URL.'assets/css/admin.css',['wp-color-picker'],PDFEV_Const_VERSION,'all');
            wp_enqueue_media();       
            wp_enqueue_script( 'pdf-embed-viewer', PDFEV_Const_URL.'assets/js/admin.js', ['jquery','wp-color-picker','jquery-ui-core'], PDFEV_Const_VERSION, true );
        }

        public function frontend_style(){

            if(is_singular( 'pdfev_embed_viewer') || is_post_type_archive( 'pdfev_embed_viewer') || shortcode_exists('pdfev_viewer') ){
                wp_enqueue_style('pdf-frontend-style',PDFEV_Const_URL.'assets/css/frontend.css',[],PDFEV_Const_VERSION,'all');
                
                wp_enqueue_script( 'pdf-frontend-script', PDFEV_Const_URL.'assets/js/frontend.js',['jquery'],PDFEV_Const_VERSION,true);

                $colors         = get_option('pdfev_css_colors');         
                $primary        = esc_html($colors['primary'] ? $colors['primary'] : '#c79f62');
                $secondary      = esc_html($colors['secondary'] ? $colors['secondary'] : '#666');
                $dark           = esc_html($colors['dark'] ? $colors['dark'] : '#333');
                $light          = esc_html($colors['light'] ? $colors['light'] : '#e5e5e5');
                $inline_css = ":root{
                        --pdfev-primary:{$primary };        
                        --pdfev-secondary:{$secondary};
                        --pdfev-dark:{$dark}; 
                        --pdfev-light:{$light};     
                    ";
                wp_add_inline_style('pdf-frontend-style', $inline_css);
            }
            
        }

    }
    
    $PDFEV_Enque_Style = new PDFEV_Enque_Style();
}