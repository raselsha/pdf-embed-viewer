<?php
/**
 * Plugin Name: PDF Download
 * Plugin URI: https://wordpress.org/plugins/pdf-download
 * Description: It helps you to view and download PDF Document, Newsletter, Report, for your visitor.
 * Version: 1.0.0
 * Requires at least: 3.0
 * Requires PHP:      7.4
 * Author: Shahadat Hossain
 * Author URI: https://shahadat.com.bd
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pdf-download
 * Domain Path: /languages
 */

/*
PDF Download is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

PDF Download is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with PDF Download. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists( 'PDF_Download' ) ){
    class PDF_Download{

        function __construct() {
            $this->define_contstants();
            add_action('wp_enqueue_scripts',array($this,'frontend_style'));
            add_action('admin_enqueue_scripts',array($this,'backend_style'));
            require_once PDF_DOWNLOAD_PATH . 'classes/pdf-download-cpt.php';
            require_once PDF_DOWNLOAD_PATH . 'classes/pdf-download-settings.php';
            $pdf_download_cpt = new PDF_Download_CPT();
            $pdf_download_settings = new PDF_Download_Settings();
            
        }

        public function define_contstants(){
            define( 'TEXTDOMAIN', 'pdf-download' );
            define( 'PDF_DOWNLOAD_PATH', plugin_dir_path(__FILE__) );
            define( 'PDF_DOWNLOAD_URL', plugin_dir_url(__FILE__) );
            define( 'PDF_DOWNLOAD_VERSION', '1.0.0' );
        }

        public function frontend_style(){
            wp_register_style('pdf-download',PDF_DOWNLOAD_URL.'assets/css/style.css',[],time(),'all');
            wp_register_script( 'pdf-download', PDF_DOWNLOAD_URL.'assets/js/script.js','',time(),true);
            
            wp_enqueue_style('pdf-download');
            wp_enqueue_script('pdf-download');

            $options = get_option('pdf_download_option');
            
            if($options['primary_color']!=''){
                $primary_color = $options['primary_color'];
                $secondary_color = $options['secondary_color'];
                $light_color = $options['light_color'];
                $dark_color = $options['dark_color'];
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
            wp_enqueue_style( 'wp-color-picker' ); 
            wp_enqueue_script( 'pdf-download', PDF_DOWNLOAD_URL.'assets/js/script.js', array( 'wp-color-picker' ), false, true ); 
        }

        public static function activate(){
            // update the option table that permalink didn't need reload
            update_option('rewrite_rules','');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type('pdfdownload');
        }

        public static function uninstall(){
            
        }
    }

}

if( class_exists( 'PDF_Download' ) ){
    register_activation_hook( __FILE__, array( 'PDF_Download','activate' ) );
    register_deactivation_hook( __FILE__, array( 'PDF_Download','deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'PDF_Download','uninstall' ) );
    $pdf_download = new PDF_Download();
}