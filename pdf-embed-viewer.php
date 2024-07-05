<?php
/**
 * Plugin Name: PDF Embed Viewer
 * Plugin URI: https://wordpress.org/plugins/pdf-embed-viewer
 * Description: The "PDF Embed Viewer" plugin is designed to view and download PDF files in your wordpress website. Its allowing easy access to Documents, Newsletter, Ebook directly within web pages. With its user-friendly interface and customizable features, this plugin offers a hassle-free solution for displaying PDFs in webpage.
 * Version: 1.0.1
 * Stable Tag: 1.0.1
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

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists( 'PDFEV_Embed_Viewer' ) ){
    class PDFEV_Embed_Viewer{

        public function __construct() {
            $this->define_contstants();
            $this->include_plugin_files();
            add_action( 'plugins_loaded', [$this,'load_plugin_textdomain'] );  
            add_action( 'init', [$this,'appsero_init_tracker_pdf_embed_viewer'] );          
        }

        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'pdf-embed-viewer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public function define_contstants(){
            define( 'PDFEV_Embed_Viewer_Path', plugin_dir_path(__FILE__) );
            define( 'PDFEV_Embed_Viewer_URL', plugin_dir_url(__FILE__) );
            define( 'PDFEV_Embed_Viewer_VERSION', '1.0.0' );
        }

        public static function include_plugin_files() {
            require_once PDFEV_Embed_Viewer_Path . 'classes/cpt-register.php';
            require_once PDFEV_Embed_Viewer_Path . 'classes/options-setup.php';
            require_once PDFEV_Embed_Viewer_Path . 'classes/admin-settings.php';
            require_once PDFEV_Embed_Viewer_Path . 'classes/enque-style-script.php';
            require_once PDFEV_Embed_Viewer_Path . 'classes/metabox-register.php';
            require_once PDFEV_Embed_Viewer_Path . 'classes/metabox/general.php';
            
        }

        public static function activate(){
            // update the option table that permalink didn't need reload
            update_option('rewrite_rules','');
            // PDFEV_Embed_Viewer_CPT::insert_demo_post();
        }

        public static function deactivate(){
            flush_rewrite_rules();
        }

        public static function uninstall(){
            unregister_post_type('pdfev_embed_viewer');
            delete_option('pdfev_emd_vwr_opt_template_lists');
            delete_option('pdfev_emd_vwr_opt_archive_title');
            delete_option('pdfev_emd_vwr_opt_archive_template');
            delete_option('pdfev_emd_vwr_opt_archive_download');
            delete_option('pdfev_emd_vwr_opt_colors');
        }

        public function appsero_init_tracker_pdf_embed_viewer() {

            if ( ! class_exists( 'Appsero\Client' ) ) {
            require_once __DIR__ . '/vendor/appsero/src/Client.php';
            }

            $client = new Appsero\Client( 'efdff7cb-2ab8-4e9a-a19f-9ca95f4a5b42', 'PDF Embed Viewer', __FILE__ );

            // Active insights
            $client->insights()->init();

        }

    }

}

if( class_exists( 'PDFEV_Embed_Viewer' ) ){
    register_activation_hook( __FILE__, array( 'PDFEV_Embed_Viewer','activate' ) );
    register_deactivation_hook( __FILE__, array( 'PDFEV_Embed_Viewer','deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'PDFEV_Embed_Viewer','uninstall' ) );
    $PDFEV_Embed_Viewer = new PDFEV_Embed_Viewer();
}