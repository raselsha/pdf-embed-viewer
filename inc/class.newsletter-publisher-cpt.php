<?php

if( ! class_exists('Newsletter_Publisher_CPT') ){

    class Newsletter_Publisher_CPT{
       
        public function __construct(Type $var = null) {
            add_action( 'init', array($this,'create_post_type') );
            add_filter( 'archive_template', array($this,'newsletter_archive_template') ) ;
            add_filter( 'single_template', array($this,'newsletter_single_template') ) ;

            require_once NEWSLETTER_PUB_PATH . 'inc/class.newsletter-publisher-metabox.php';
            $newsletter_publisher_metabox = new Newsletter_Publisher_Metabox();
        }

        public function create_post_type(){
            $labels = [
                "name" => __( "Newsletters", "newsletter-publisher" ),
                "singular_name" => __( "Newsletter", "newsletter-publisher" ),
                "menu_name" => __( "Newsletters", "newsletter-publisher" ),
                "all_items" => __( "All Newsletters", "newsletter-publisher" ),
                "new_items" => __( "All Newsletters", "newsletter-publisher" ),
            ];

            $args = [
                "label" => __( "Newsletter", "newsletter-publisher" ),
                "description" => __( "Newsletters", "newsletter-publisher" ),
                "labels" => $labels, 
                "public" => true,
                "supports" => [ "title", "editor", "thumbnail" ], // post support ui elements
                "hierarchical" => false, //parent chile relation post type
                "show_ui" => true, // post type show ui to add, edit
                "show_in_menu" => true, // show menu into admin sidebar
                "menu_position" => 5, // menu position into admin sidebar
                "show_in_admin_bar" => true, // show into admin bar
                "show_in_nav_menus" => true, // show in nav menu
                "can_export" => true, // can export
                "has_archive" => true, // show into archive page template
                "exclude_from_search" => false, // exclude from search 
                "publicly_queryable" => true, // query custom post into page
                "show_in_rest" => true, // show into API

                "rest_base" => "", // API base endpoint
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "delete_with_user" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "rewrite" => [ "slug" => "newsletter", "with_front" => true ],
                "query_var" => true,
                "menu_icon" => NEWSLETTER_PUB_URL.'assets/images/newsletter-icon.png',
                "show_in_graphql" => false,
                //"register_metabox_cb" => array($this,'add_meta_boxes'),
            ];

            register_post_type( "newsletter", $args );
        }
        

        public function newsletter_archive_template( $archive_template ) {
            global $post;
       
            if ( is_post_type_archive ( 'newsletter' ) ) {
                 $archive_template = NEWSLETTER_PUB_URL . '/template/archive-newsletter.php';
            }
            return $archive_template;
            
       }
       
       public function newsletter_single_template($single_template) {
            global $wp_query, $post;
            if ($post->post_type == 'newsletter'){   // Change 'medust_events' with your CPT
                $single_template = NEWSLETTER_PUB_URL . '/template/single-newsletter.php';
            }
            return $single_template;
        }

        public function get_posts_years_array($post_type) {
            global $wpdb;
            $result = array();
            $years = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT YEAR(post_date) FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_type = %s GROUP BY YEAR(post_date) DESC",$post_type
                ),
                ARRAY_N
            );
            if ( is_array( $years ) && count( $years ) > 0 ) {
                foreach ( $years as $year ) {
                    $result[] = $year[0];
                }
            }
            return $result;
        }
    }
    
}