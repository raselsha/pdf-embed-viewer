<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.0.3
 */

 if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Embed_Viewer_Shortcode') ){
    
    class PDFEV_Embed_Viewer_Shortcode{
        public function __construct() {
            add_action('init', [$this,'register_shortcode']);
        } 

        public function register_shortcode() {
            add_shortcode('pdfev_viewer', [$this,'pdfev_viewer_shortcode'] );
        }

        public function pdfev_viewer_shortcode($atts) {
            // Set default attributes and merge with user-provided attributes
            $atts = shortcode_atts(
                array(
                    'template' => 'list', // Default option
                ),
                $atts,
                'pdfev_viewer'
            );
        
            // Extract the attribute
            $template = sanitize_text_field($atts['template']);
            ob_start();
            // Switch based on the option
            switch ($template) {
                case 'list':
                    $load_template = $template.'.php';
                    break;
        
                case 'grid':
                    $load_template = $template.'.php';
                    break;
        
                case 'newsletter':
                    $load_template = $template.'.php';
                    break;
        
                case 'ebook':
                    $load_template = $template.'.php';
                    break;
        
                default:
                    $load_template = $template.'.php';
                    break;
            }
            $archive_template = PDFEV_Functions::load_template($load_template);
            require $archive_template;
            return ob_get_clean();
        }
        
    }
    new PDFEV_Embed_Viewer_Shortcode();
}