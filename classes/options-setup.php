<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Embed_Viewer_Options_Setup') ){

    class PDFEV_Embed_Viewer_Options_Setup{

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
            $template = [
                'list'      => __('List Template','pdf-embed-viewer'),
                'grid'      => __('Grid Template','pdf-embed-viewer'),
                'newsletter'=> __('Newsletter Template','pdf-embed-viewer'),
                'ebook'     => __('Ebook Template','pdf-embed-viewer'),                
            ];

            $colors = [
                'primary'   => '#c79f62',
                'secondary' => '#666',
                'dark'      => '#333',
                'light'     => '#e5e5e5',                
            ];
            
            $template       = $this->options_array_sanitize($template);
            $archive_title  = sanitize_text_field('Pdf Embed Viewer');
            $archive_download_button  = sanitize_text_field('yes');
            $colors         = $this->options_array_sanitize($colors);
            
            add_option('pdfev_emd_vwr_opt_archive_title',$archive_title);
            add_option('pdfev_emd_vwr_opt_template_lists',$template);
            add_option('pdfev_emd_vwr_opt_archive_download',$archive_download_button);
            add_option('pdfev_emd_vwr_opt_colors',$colors);
        }
    }
    
    $PDFEV_Embed_Viewer_Options_Setup = new PDFEV_Embed_Viewer_Options_Setup();
}