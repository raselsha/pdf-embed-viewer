<?php


if( ! class_exists('Newsletter_Publisher_Settings') ){
    class Newsletter_Publisher_Settings{
        public function __construct() {
            add_action( 'admin_menu', array($this,'create_admin_menu') );

        }

        public function create_admin_menu(){
            add_menu_page(
                __('Newsletter Settings',TEXTDOMAIN),
                __('Newsletter',TEXTDOMAIN),
                'manage_options',
                'newsletter-index',
                array($this,'newsletter_settings_page'),
                NEWSLETTER_PUB_URL.'assets/images/newsletter-icon.png',
                5
            );
            add_submenu_page(
                'newsletter-index',
                __('Dashboard',TEXTDOMAIN),
                __('Dashboard',TEXTDOMAIN),
                'manage_options',
                'newsletter-index',
                array($this,'newsletter_settings_page'),
            );
            add_submenu_page(
                'newsletter-index',
                __('All Newsletter',TEXTDOMAIN),
                __('All Newsletter',TEXTDOMAIN),
                'manage_options',
                'edit.php?post_type=newsletter',
                null,
            );
            add_submenu_page(
                'newsletter-index',
                __('Add Newsletter',TEXTDOMAIN),
                __('Add Newsletter',TEXTDOMAIN),
                'manage_options',
                'post-new.php?post_type=newsletter',
                null,
            );
            

        }

        public function newsletter_settings_page(){

        }
    }
}