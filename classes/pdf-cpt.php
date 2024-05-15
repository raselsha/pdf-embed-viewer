<?php

if( ! class_exists('PDF_Download_CPT') ){

    class PDF_Download_CPT{
       
        public function __construct() {
            add_action( 'init', array($this,'create_post_type') );
            add_filter( 'archive_template', array($this,'pdfdownload_archive_template') ) ;
            add_filter( 'single_template', array($this,'pdfdownload_single_template') ) ;

           require_once SH_PDF_EMBED_VIEWER . 'classes/pdf-download-metabox.php';
           $pdf_download_metabox = new PDF_Download_Metabox();
        }

        public function create_post_type(){
            $labels = [
                "name" => __( "All PDF", 'pdf-download' ),
                "singular_name" => __( "PDF", 'pdf-download' ),
                "menu_name" => __( "PDF Download", 'pdf-download' ),
            ];

            $args = [
                "label" => __( "PDF Download", 'pdf-download' ),
                "description" => __( "PDF Download", 'pdf-download' ),
                "labels" => $labels, 
                "public" => true,
                "supports" => [ "title", "thumbnail" ], // post support ui elements
                "hierarchical" => false, //parent chile relation post type
                "show_ui" => true, // post type show ui to add, edit
                "show_in_menu" => false, // show menu into admin sidebar
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
                "rewrite" => [ "slug" => "pdfdownload", "with_front" => true ],
                "query_var" => true,
                "menu_icon" => SH_PDF_EMBED_VIEWER_URL.'assets/images/pdf-download-icon.png',
                "show_in_graphql" => false,
                //"register_metabox_cb" => array($this,'add_meta_boxes'),
            ];

            register_post_type( "pdfdownload", $args );
        }
        

        public function pdfdownload_archive_template( $archive_template ) {
            global $post;

            if ( is_post_type_archive ( 'pdfdownload' ) ) {
                $archive_template = SH_PDF_EMBED_VIEWER . '/template/archive-pdfdownload.php';
            }
            return $archive_template;
            
        }

        public function pdfdownload_single_template($single_template) {
            global $wp_query, $post;
            if ($post->post_type == 'pdfdownload'){   
                $single_template = SH_PDF_EMBED_VIEWER . '/template/single-pdfdownload.php';
            }
            return $single_template;
        }

        public static function get_posts_years_array($post_type) {
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

    $pdf_download_cpt = new PDF_Download_CPT();

    
}