<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Options_Setup') ){

    class PDFEV_Options_Setup{

        public function __construct(){
            add_action('init',[$this,'set_options_value']);
        }

        private function options_array_sanitize($data){
            
            foreach ( $data as $key => $value ) {
                $data[ $key ] = sanitize_text_field( $value );
            }
            return $data;
        }

        public function set_options_value(){
            $template_list = [
                'list'      => __('List Template','pdf-embed-viewer'),
                'grid'      => __('Grid Template','pdf-embed-viewer'),
                'newsletter'=> __('Newsletter Template','pdf-embed-viewer'),
                'ebook'     => __('Ebook Template','pdf-embed-viewer'),                
            ];

            $colors = [];
            $colors['primary']   = sanitize_hex_color('#c79f62');
            $colors['secondary'] = sanitize_hex_color('#666666');
            $colors['dark']      = sanitize_hex_color('#333333');
            $colors['light']     = sanitize_hex_color('#e5e5e5');
            
            $archive_title       = sanitize_text_field(__('Pdf Embed Viewer','pdf-embed-viewer'));
            $template            = sanitize_text_field('list');
            
            $archive_download_button  = sanitize_text_field('yes');
            $template_list  = $this->options_array_sanitize($template_list);
            
            
            add_option('pdfev_archive_title',$archive_title);
            add_option('pdfev_archive_template',$template);
            add_option('pdfev_archive_template_lists',$template_list);
            add_option('pdfev_archive_download',$archive_download_button);
            add_option('pdfev_css_colors',$colors);
        }
    }
    
    $PDFEV_Options_Setup = new PDFEV_Options_Setup();
}