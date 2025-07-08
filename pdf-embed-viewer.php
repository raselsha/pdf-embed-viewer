<?php
/**
 * Plugin Name: 3D Flipbook PDF Viewer & Embedder – E-Books, Manuals, Newsletters, Reports
 * Plugin URI: https://wordpress.org/plugins/pdf-embed-viewer
 * Description: Display PDFs as interactive 3D flipbooks or traditional viewers for E-Books, Manuals, Newsletters, and Reports.
 * Version: 1.3.1
 * Stable Tag: trunk
 * Requires at least: 3.0
 * Requires PHP:      7.0
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

defined('ABSPATH') || exit;

if( ! class_exists( 'PDFEV_Embed_Viewer' ) ){
    class PDFEV_Embed_Viewer{

        public function __construct() {
            $this->define_contstants();
            $this->include_plugin_files();        
        }

        public function define_contstants(){
            define( 'PDFEV_Const_Path', plugin_dir_path(__FILE__) );
            define( 'PDFEV_Const_URL', plugin_dir_url(__FILE__) );
            define( 'PDFEV_Const_VERSION', '1.3.1' );
        }

        public static function include_plugin_files() {
            require_once PDFEV_Const_Path . 'classes/cpt-register.php';
            require_once PDFEV_Const_Path . 'classes/functions.php';
            require_once PDFEV_Const_Path . 'classes/options-setup.php';
            require_once PDFEV_Const_Path . 'classes/admin-settings.php';
            require_once PDFEV_Const_Path . 'classes/settings/general.php';
            require_once PDFEV_Const_Path . 'classes/settings/shortcode.php';
            require_once PDFEV_Const_Path . 'classes/settings/support.php';
            require_once PDFEV_Const_Path . 'classes/enque-style-script.php';
            require_once PDFEV_Const_Path . 'classes/metabox-register.php';
            require_once PDFEV_Const_Path . 'classes/metabox/general.php';
            require_once PDFEV_Const_Path . 'classes/metabox/template.php';
            require_once PDFEV_Const_Path . 'classes/shortcode.php';
            require_once PDFEV_Const_Path . 'classes/count-manager.php';
            require_once PDFEV_Const_Path . 'classes/template.php';
            require_once PDFEV_Const_Path . 'classes/insert-demo.php';
            require_once PDFEV_Const_Path . 'classes/elementor/elementor.php';
            
        }

        public static function activate(){
            update_option('rewrite_rules','');
        }

        public static function deactivate(){
            flush_rewrite_rules();
        }

        public static function uninstall(){
            unregister_post_type('pdfev_embed_viewer');
            delete_option('pdfev_archive_template_lists');
            delete_option('pdfev_archive_title');
            delete_option('pdfev_archive_slug');
            delete_option('pdfev_archive_template');
            delete_option('pdfev_archive_download');
            delete_option('pdfev_css_colors');
        }

    }

}

if( class_exists( 'PDFEV_Embed_Viewer' ) ){
    register_activation_hook( __FILE__, array( 'PDFEV_Embed_Viewer','activate' ) );
    register_deactivation_hook( __FILE__, array( 'PDFEV_Embed_Viewer','deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'PDFEV_Embed_Viewer','uninstall' ) );
    new PDFEV_Embed_Viewer();
}