<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.2
 * @since 1.0.3
 */

 if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Shortcode') ){
    
    class PDFEV_Shortcode{
        public function __construct() {
            add_action('init', [$this,'register_shortcode']);
        } 

        public function register_shortcode() {
            add_shortcode('pdfev_viewer', [$this,'archive_pdf_shortcode'] );
            add_shortcode('pdfev_embed_viewer', [$this,'single_pdf_shortcode'] );
        }

        public function single_pdf_shortcode($atts) {
            $atts = shortcode_atts(
                array(
                    'id' => '',
                ),
                $atts,
                'pdfev_embed_viewer'
            );
            $post_id = intval($atts['id']);
            if(isset($post_id)){
                if ($post_id <= 0) {
                    return;
                }
                else{
                    ob_start();
                    PDFEV_Functions::shortcode_view($post_id);
                    return ob_get_clean();
                }
            }
        }
        public function archive_pdf_shortcode($atts) {
            // Set default attributes and merge with user-provided attributes
            $atts = shortcode_atts(
                array(
                    'template' => 'list',
                    'limit' => '',
                    'order' => '',
                    'read' => '',
                    'download' => '',
                    'reading_count' => '',
                    'downloading_count' => '',
                ),
                $atts,
                'pdfev_viewer'
            );
            // Extract the attribute
            
            $template = sanitize_text_field($atts['template']);

            if(!empty($template)){
                ob_start();
                // Switch based on the option
                switch ($template) {
                    case 'list':
                        do_action('pdfev_template_archive_list',$atts);
                        break;
            
                    case 'grid':
                        do_action('pdfev_template_archive_grid',$atts);
                        break;
            
                    case 'newsletter':
                        do_action('pdfev_template_archive_newsletter',$atts);
                        break;
            
                    case 'ebook':
                        do_action('pdfev_template_archive_ebook',$atts);
                        break;
            
                    default:
                        do_action('pdfev_template_archive_view',$atts);
                        break;
                }
                return ob_get_clean();
            }
            
        }
        
    }
    new PDFEV_Shortcode();
}