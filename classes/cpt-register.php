<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDF_Emd_Vwr_CPT') ){

    class PDF_Emd_Vwr_CPT{
       
        public function __construct() {
            add_action( 'init', array($this,'create_post_type') );
            add_filter( 'archive_template', array($this,'archive_template') ) ;
            add_filter( 'single_template', array($this,'single_template') ) ;
            add_filter( 'manage_pdf-embed-viewer_posts_columns', array($this,'posts_columns') ) ;
            add_action( 'manage_pdf-embed-viewer_posts_custom_column', array($this,'custom_column'),10,2 ) ;
            add_filter( 'manage_edit-pdf-embed-viewer_sortable_columns', array($this,'sortable_columns') ) ;
        }        

        public function posts_columns($columns){
            $columns['pdf_emd_vwr_file_url']=esc_html__('File Url','pdf-embed-viewer');
            return $columns;
        }

        public function custom_column($columns, $post_id){

            switch($columns){
                case 'pdf_emd_vwr_file_url':
                     echo esc_url(get_post_meta($post_id,'pdf_emd_vwr_file_url',true));
                break;
            }
        }

        public function sortable_columns($columns){

            $columns['pdf_emd_vwr_file_url']='pdf_emd_vwr_file_url';
            return $columns;
        }


        public function create_post_type(){
            $labels = [
                "name" => __( "PDF Embed Viewer", 'pdf-embed-viewer' ),
                "singular_name" => __( "PDF Embed", 'pdf-embed-viewer' ),
                "menu_name" => __( "PDF Embed", 'pdf-embed-viewer' ),
                "all_items" => __( "All PDF", 'pdf-embed-viewer' ),
                "add_new" => __( "New PDF Embed", 'pdf-embed-viewer' ),
                "add_new_item" => __("New PDF Embed", 'pdf-embed-viewer' ), 
            ];

            $args = [
                "label" => __( "PDF Embed", 'pdf-embed-viewer' ),
                "description" => __( "PDF Embed", 'pdf-embed-viewer' ),
                "labels" => $labels, 
                "public" => true,
                "supports" => [ "title",], // post support ui elements
                "hierarchical" => true, //parent child relation post type
                "show_ui" => true, // post type show ui to add, edit
                "show_in_menu" => true, // show menu into admin sidebar
                "menu_position" => 5, // menu position into admin sidebar
                "show_in_admin_bar" => true, // show into admin bar
                "show_in_nav_menus" => true, // show in nav menu
                "can_export" => true, // can export
                "has_archive" => true, // show into archive page template
                "exclude_from_search" => false, // exclude from search 
                "publicly_queryable" => true, // query custom post into page
                "show_in_rest" => false, // show into API

                "rest_base" => "", // API base endpoint
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "delete_with_user" => true,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "rewrite" => [ "slug" => "pdf-embed-viewer", "with_front" => true ],
                "query_var" => true,
                "menu_icon" => PDF_Emd_Vwr_URL.'assets/images/pdf-embed-viewer-icon.png',
                "show_in_graphql" => false,
                //"register_metabox_cb" => array($this,'add_meta_boxes'),
            ];

            register_post_type( "pdf-embed-viewer", $args );
            
        }
        

        public function archive_template( $archive_template ) {
            $template = get_option('pdf_emd_vwr_opt_archive_template'); 
            $opt_templates = get_option('pdf_emd_vwr_opt_template_lists'); 

            foreach($opt_templates as $key => $value){
                if($template == $key){
                    $inc_template = $key.'.php';
                }
            }

            if ( is_post_type_archive ( 'pdf-embed-viewer' ) ) {                
                $archive_template = get_template_directory().'/template/'. $inc_template;
                if( ! file_exists($archive_template)){
                    $archive_template = get_template_directory().'/template/list.php';
                    if( ! file_exists($archive_template)){
                        $archive_template = PDF_Emd_Vwr . 'template/'. $inc_template;
                        if( ! file_exists($archive_template)){
                            $archive_template = PDF_Emd_Vwr . 'template/list.php';
                        }
                    }
                }
                
            }

            return $archive_template;
        }

        public function single_template($single_template) {
            global $wp_query, $post;
            if ($post->post_type == 'pdf-embed-viewer'){   
                $single_template = get_template_directory().'/template/single.php';
                if( ! file_exists($single_template)){
                    $single_template = PDF_Emd_Vwr . 'template/single.php';
                }
            }
            return $single_template;
        }

        public static function get_posts_years_array($post_type) {
                        
            $terms_year = array(
                'post_type'         => $post_type,
            );
            $years = array();
            $query_year = new WP_Query( $terms_year );
            if ( $query_year->have_posts() ) :
                while ( $query_year->have_posts() ) : $query_year->the_post();
                    $year = get_the_date('Y');
                    if(!in_array($year, $years)){
                        $years[] = $year;
                    }
                endwhile;
                wp_reset_postdata();
            endif;
            return $years;
        }

        public static function insert_demo_content() {
            // Create an array of demo post data
            $demo_posts = array(
                array(
                    'post_title'    => 'Demo Post 1',
                    'post_content'  => 'This is the content of demo post 1.',
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'pdf-embed-viewer'
                ),
                array(
                    'post_title'    => 'Demo Post 2',
                    'post_content'  => 'This is the content of demo post 2.',
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'post'
                ),
                array(
                    'post_title'    => 'Demo Post 3',
                    'post_content'  => 'This is the content of demo post 1.',
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'pdf-embed-viewer'
                ),
                array(
                    'post_title'    => 'Demo Post 4',
                    'post_content'  => 'This is the content of demo post 4.',
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'pdf-embed-viewer'
                ),
                array(
                    'post_title'    => 'Demo Post 5',
                    'post_content'  => 'This is the content of demo post 5.',
                    'post_status'   => 'publish',
                    'post_author'   => 1, // Change this to the author ID you want
                    'post_type'     => 'pdf-embed-viewer'
                ),
                // Add more demo posts as needed
            );
            foreach ( $demo_posts as $key => $post_data ) {
                wp_insert_post( $post_data );
                
            }
        }
    }

    $PDF_Emd_Vwr_CPT = new PDF_Emd_Vwr_CPT();

    
}