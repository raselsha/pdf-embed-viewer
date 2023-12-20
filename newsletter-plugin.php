<?php
/**
 * Plugin Name: News Letter
 * Plugin URI: https://shahadat.com.bd
 * Description: plugin news letter
 * Version: 1.0.0
 * Require at least: 5.3
 * Requires PHP: 5.4
 * Author: Shahadat Hossain
 * Author URI: https://shahadat.com.bd
 * Lisense: GPL v2 or later
 * Lisense URI: https://gpl.org/public/lisense/v2.html
 * Text Domain:news-letter
 * Domain Path: /language/
 */

if( ! defined('APSPATH') ) die;

if( ! class_exists( 'News_Letter' ) ){
    class News_Letter{

        public function __construct() {
            add_action( 'init', 'cptui_register_my_cpts' );
            add_action( 'init', 'cptui_register_my_cpts_news_letter' );
        }

        public function cptui_register_my_cpts() {

            /**
             * Post Type: Newsletter.
             */
        
            $labels = [
                "name" => __( "Newsletter", "hello-elementor-child" ),
                "singular_name" => __( "Newsletter", "hello-elementor-child" ),
                "menu_name" => __( "Newsletter", "hello-elementor-child" ),
                "all_items" => __( "All Newsletter", "hello-elementor-child" ),
            ];
        
            $args = [
                "label" => __( "Newsletter", "hello-elementor-child" ),
                "labels" => $labels,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "has_archive" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "rewrite" => [ "slug" => "news-letter", "with_front" => true ],
                "query_var" => true,
                "menu_position" => 5,
                "menu_icon" => "https://www.bluecreekasset.com/wp-content/uploads/2022/02/newsletter-e1644371281834.png",
                "supports" => [ "title", "editor", "thumbnail" ],
                "show_in_graphql" => false,
            ];
        
            register_post_type( "news-letter", $args );
        }
        function cptui_register_my_cpts_news_letter() {

            /**
             * Post Type: Newsletter.
             */
        
            $labels = [
                "name" => __( "Newsletter", "hello-elementor-child" ),
                "singular_name" => __( "Newsletter", "hello-elementor-child" ),
                "menu_name" => __( "Newsletter", "hello-elementor-child" ),
                "all_items" => __( "All Newsletter", "hello-elementor-child" ),
            ];
        
            $args = [
                "label" => __( "Newsletter", "hello-elementor-child" ),
                "labels" => $labels,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "has_archive" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "rewrite" => [ "slug" => "news-letter", "with_front" => true ],
                "query_var" => true,
                "menu_position" => 5,
                "menu_icon" => "https://www.bluecreekasset.com/wp-content/uploads/2022/02/newsletter-e1644371281834.png",
                "supports" => [ "title", "editor", "thumbnail" ],
                "show_in_graphql" => false,
            ];
        
            register_post_type( "news-letter", $args );
        }
    }

}

if( class_exists( 'News_Letter' ) ){

    $news_letter = new News_Letter();
}