<?php
/**
 * Plugin Name: PDF Embed Viewer - WordPress PDF Viewer plugin 
 * Plugin URI: https://wordpress.org/plugins/pdf-embed-viewer
 * Description: Embaded your PDF files with ease with PDF Embaded, you will enjoy the simples and fastest adding of PDF files to your website. Let users view files and download theme seamlessly. For your convenience, there are three ways of integrating files: by uploading, by files URLs. .
 * Version: 1.0.0
 * Requires at least: 3.0
 * Requires PHP:      7.4
 * Author: Shahadat Hossain
 * Author URI: https://shahadat.com.bd
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pdf-embed-viewer
 * Domain Path: /languages
 */

/*
PDF Embed Viewer is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

PDF Embed Viewer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with PDF Embed Viewer. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists( 'SH_PDF_Embed_Viewer' ) ){
    class SH_PDF_Embed_Viewer{

        function __construct() {
            $this->define_contstants();
            $this->include_plugin_files();            
        }

        public function define_contstants(){
            define( 'SH_PDF_EMBED_VIEWER', plugin_dir_path(__FILE__) );
            define( 'SH_PDF_EMBED_VIEWER_URL', plugin_dir_url(__FILE__) );
            define( 'SH_PDF_EMBED_VIEWER_VERSION', '1.0.0' );
        }

        public static function include_plugin_files() {
            require_once SH_PDF_EMBED_VIEWER . 'classes/cpt-register.php';
            require_once SH_PDF_EMBED_VIEWER . 'classes/enque-style-script.php';
            require_once SH_PDF_EMBED_VIEWER . 'classes/metabox-register.php';
            require_once SH_PDF_EMBED_VIEWER . 'classes/metabox/general.php';
            require_once SH_PDF_EMBED_VIEWER . 'classes/admin-settings.php';

        }

        public static function activate(){
            // update the option table that permalink didn't need reload
            update_option('rewrite_rules','');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type('pdf-embed-viewer');
        }

        public static function uninstall(){
            
        }
    }

}

if( class_exists( 'SH_PDF_Embed_Viewer' ) ){
    register_activation_hook( __FILE__, array( 'SH_PDF_Embed_Viewer','activate' ) );
    register_deactivation_hook( __FILE__, array( 'SH_PDF_Embed_Viewer','deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'SH_PDF_Embed_Viewer','uninstall' ) );
    $pdf_download = new SH_PDF_Embed_Viewer();
}