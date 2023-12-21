<?php
/**
 * Plugin Name: News Letter Publisher
 * Plugin URI: https://shahadat.com.bd
 * Description:  News Letter Publisher Plugin
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author: Shahadat Hossain
 * Author URI: https://shahadat.com.bd
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: newsletter-publisher
 * Domain Path: /languages
 */

/*
News letter publisher is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

News letter publisher is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with News letter publisher. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
// newsletter-publisher
if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists( 'Newsletter_Publisher' ) ){
    class Newsletter_Publisher{

        function __construct() {
            $this->define_contstants();
            add_action('wp_enqueue_scripts',array($this,'frontend_style'));
            // add_action('admin_enqueue_scripts',array($this,'backend_style'));
            require_once NEWSLETTER_PUB_PATH . 'classes/class.newsletter-publisher-cpt.php';
            $newsletter_publisher_cpt = new Newsletter_Publisher_CPT();
        }

        public function define_contstants(){
            define( 'TEXTDOMAIN', 'newsletter-publisher' );
            define( 'NEWSLETTER_PUB_PATH', plugin_dir_path(__FILE__) );
            define( 'NEWSLETTER_PUB_URL', plugin_dir_url(__FILE__) );
            define( 'NEWSLETTER_PUB_VERSION', '1.0.0' );
        }

        public function frontend_style(){
            wp_enqueue_style('newsletter-frontend',NEWSLETTER_PUB_URL.'assets/css/style.css',[],time(),'all');
            wp_register_script( 'newsletter-frontend', NEWSLETTER_PUB_URL.'assets/js/bootstrap.bundle.min.js','',time() );
            wp_enqueue_script('newsletter-frontend');
        }

        public static function activate(){
            // update the option table that permalink didn't need reload
            update_option('rewrite_rules','');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type('newsletter');
        }

        public static function uninstall(){
            
        }
    }

}

if( class_exists( 'Newsletter_Publisher' ) ){
    register_activation_hook( __FILE__, array( 'Newsletter_Publisher','activate' ) );
    register_deactivation_hook( __FILE__, array( 'Newsletter_Publisher','deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'Newsletter_Publisher','uninstall' ) );
    $newsletter_publisher = new Newsletter_Publisher();
}