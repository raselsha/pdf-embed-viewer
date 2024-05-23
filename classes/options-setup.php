<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ){die('Don\'t access derectly');}

if( ! class_exists('PDF_Emd_Vwr_Options_Setup') ){

    class PDF_Emd_Vwr_Options_Setup{

        public function __construct(){
            add_action('init',[$this,'set_options_value']);
        }

        public function set_options_value(){
            $template = [
                'grid'      => __('Grid Template','pdf-embed-viewer'),
                'list'      => __('List Template','pdf-embed-viewer'),
                'newsletter'=> __('Newsletter Template','pdf-embed-viewer'),
                'ebook'     => __('Ebook Template','pdf-embed-viewer'),                
            ];
            update_option('pdf_emd_vwr_opt_templates',$template);
        }
    }
    
    $PDF_Emd_Vwr_Options_Setup = new PDF_Emd_Vwr_Options_Setup();
}