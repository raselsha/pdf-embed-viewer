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
            wp_enqueue_style('pdfev-font-awesome',PDFEV_Const_URL.'vendor/font-awesome/font-awesome.min.css',[],PDFEV_Const_VERSION,'all');
            
            wp_enqueue_style('main',PDFEV_Const_URL.'assets/css/admin.css',['wp-color-picker'],PDFEV_Const_VERSION,'all');
            wp_enqueue_media(); 
            
            wp_enqueue_script( 'pdfjs', PDFEV_Const_URL.'vendor/pdf/pdf.min.js', [], PDFEV_Const_VERSION, true );
            wp_enqueue_script( 'pdfjs-worker', PDFEV_Const_URL.'vendor/pdf/pdf.worker.min.js', [], PDFEV_Const_VERSION, true );

            wp_enqueue_script( 'pdf-embed-viewer', PDFEV_Const_URL.'assets/js/admin.js', ['jquery','wp-color-picker','jquery-ui-core'], PDFEV_Const_VERSION, false );
            wp_localize_script('pdf-embed-viewer', 'pdfevAjax', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'ajaxnonce'=> wp_create_nonce('pdf_ajax_nonce'),
                'pdfevurl' => PDFEV_Const_URL,
                'pdfworker' => PDFEV_Const_URL.'vendor/pdf/pdf.worker.min.js'
            ));
        }

        public function frontend_style(){

            if(is_singular( 'pdfev_embed_viewer') || is_post_type_archive( 'pdfev_embed_viewer') || shortcode_exists('pdfev_viewer') ){
                // css ===
                wp_enqueue_style('pdfev-font-awesome',PDFEV_Const_URL.'vendor/font-awesome/font-awesome.min.css',[],PDFEV_Const_VERSION,'all');
                wp_enqueue_style('pdfev-frontend-style',PDFEV_Const_URL.'assets/css/frontend.css',[],PDFEV_Const_VERSION,'all');
                // javascript ===
                wp_enqueue_script( 'pdf-frontend-script', PDFEV_Const_URL.'assets/js/frontend.js',['jquery'],PDFEV_Const_VERSION,true);
                wp_enqueue_script( 'pdf-three.min', PDFEV_Const_URL.'vendor/3dflipbook/js/three.min.js',['jquery'],PDFEV_Const_VERSION,true);
                wp_enqueue_script( 'pdf-min', PDFEV_Const_URL.'vendor/3dflipbook/js/pdf.min.js',['jquery'],PDFEV_Const_VERSION,true);
                wp_enqueue_script( 'pdf-3dflipbook', PDFEV_Const_URL.'vendor/3dflipbook/js/3dflipbook.min.js',[],PDFEV_Const_VERSION,true);
                wp_enqueue_script( 'pdf-simple-jquery-pdf', PDFEV_Const_URL.'vendor/3dflipbook/js/simple-jquery-pdf.js',[],PDFEV_Const_VERSION,true);
                
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
                wp_add_inline_style('pdfev-frontend-style', $inline_css);
                wp_add_inline_script('pdf-3dflipbook', 'window.$ = window.jQuery;', 'before');
                wp_add_inline_script('pdf-3dflipbook', '
                    window.PDFJS_LOCALE = {
                        pdfJsWorker: "' . esc_url(PDFEV_Const_URL . 'vendor/3dflipbook/js/pdf.worker.js') . '",
                        pdfJsCMapUrl: "cmaps"
                    };
                ', 'before');
            }

            wp_localize_script('pdf-frontend-script', 'pdfevFronend', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'ajaxnonce'   => wp_create_nonce('pdf_ajax_nonce'),
                'pdfevurl' => esc_url(PDFEV_Const_URL),
                'post_id' => get_the_ID(),
            ));
            
        }

    }
    
    $PDFEV_Enque_Style = new PDFEV_Enque_Style();
}