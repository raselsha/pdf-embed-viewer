<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 */
if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDF_Emd_Vwr_Enque') ){
    class PDF_Emd_Vwr_Enque{
        public function __construct()
        {
            add_action('admin_enqueue_scripts',[$this,'backend_style']);
            add_action('wp_enqueue_scripts',[$this,'frontend_style']);
           
        }

        public function backend_style(){
            wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
            wp_register_style('main',PDF_Emd_Vwr_URL.'assets/css/admin.css',['wp-color-picker','font-awesome'],'','all');
            wp_enqueue_style('main');
                        
            wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.13.3/jquery-ui.min.js');
            
            wp_register_script( 'pdf-embed-viewer', PDF_Emd_Vwr_URL.'assets/js/admin.js', ['wp-color-picker','jquery-ui'], false, true );
            wp_enqueue_script( 'pdf-embed-viewer' );        
            
        }

        public function frontend_style(){
            wp_register_style('pdf-frontend-style',PDF_Emd_Vwr_URL.'assets/css/frontend.css',[],);
            wp_register_script( 'pdf-frontend-script', PDF_Emd_Vwr_URL.'assets/js/frontend.js',['jQuery'],'',true);
                        
            wp_enqueue_style('pdf-frontend-style');
            wp_enqueue_script('pdf-frontend-script');
            $options = get_option('sh_pdf_embed_options');
            $colors = $options['colors'];
            $primary        = isset($colors['primary'] ) ? $colors['primary']:'#c79f62';
            $secondary      = isset($colors['secondary'] )? $colors['secondary']:'#666666';
            $dark           = isset($colors['dark'] ) ? $colors['dark']:'#333';
            $light          = isset($colors['light'] ) ? $colors['light']:'#e5e5e5';
            $inline_css = ":root{
                    --pdf-emd-vwr-primary:{$primary };        
                    --pdf-emd-vwr-secondary:{$secondary}; 
                    --pdf-emd-vwr-light:{$dark};       
                    --pdf-emd-vwr-dark:{$light};     
                ";
            wp_add_inline_style('pdf-frontend-style', $inline_css);
            
        }

    }
    
    $PDF_Emd_Vwr_Enque = new PDF_Emd_Vwr_Enque();
}