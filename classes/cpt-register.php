<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 */
namespace PDFEV;

defined('ABSPATH') || exit;

class CPT{
    
    public function __construct() {
        add_action( 'init', array($this,'create_post_type') );
        add_action( 'init', array($this,'create_post_category') );
        add_filter( 'manage_pdfev_embed_viewer_posts_columns', array($this,'posts_columns') ) ;
        add_action( 'manage_pdfev_embed_viewer_posts_custom_column', array($this,'custom_column'),10,2 ) ;
        add_filter( 'manage_edit-pdfev_embed_viewer_sortable_columns', array($this,'sortable_columns') ) ;
        add_filter( 'archive_template', array($this,'archive_template') ) ;
        add_filter( 'single_template', array($this,'single_template') ) ;
    }        

    public function posts_columns($columns){
        unset($columns['date']);
        $columns['pdfev_meta_download'] = esc_html__('Download Enable','pdf-embed-viewer');
        $columns['pdfev_meta_views_count'] = esc_html__('Views','pdf-embed-viewer');
        $columns['pdfev_meta_downloads_count'] = esc_html__('Downloads','pdf-embed-viewer');
        $columns['shortcode_column'] = esc_html__('Shortcode','pdf-embed-viewer');
        $columns['pdfev_meta_pdf_url'] = esc_html__('File Url','pdf-embed-viewer');
        $columns['Author'] = esc_html__('Author','pdf-embed-viewer');
        $columns['date'] = esc_html__('Date','pdf-embed-viewer');
        return $columns;
    }

    public function custom_column($columns, $post_id){

        switch($columns){
            case 'pdfev_meta_pdf_url':
                echo esc_url(get_post_meta($post_id,'pdfev_meta_pdf_url',true));
            break;
            case 'pdfev_meta_download':
                echo esc_html(get_post_meta($post_id,'pdfev_meta_download',true));
            break;
            case 'pdfev_meta_downloads_count':
                $downloads = get_post_meta($post_id,'pdfev_meta_downloads_count',true);
                $downloads = $downloads?$downloads:0;
                echo esc_html($downloads);
            break;
            case 'pdfev_meta_views_count':
                $views = get_post_meta($post_id,'pdfev_meta_views_count',true);
                $views = $views?$views:0;
                echo esc_html($views);
            break;
            case 'shortcode_column':
                echo esc_html('[pdfev_embed_viewer id="'.get_the_ID().'"]');
            break;
        }
    }

    public function sortable_columns($columns){
        $columns['pdfev_meta_download']='pdfev_meta_download';
        $columns['pdfev_meta_pdf_url']='pdfev_meta_pdf_url';
        $columns['pdfev_meta_downloads_count']='pdfev_meta_downloads_count';
        $columns['pdfev_meta_views_count']='pdfev_meta_views_count';
        $columns['shortcode_column']='ID';
        return $columns;
    }


    public function create_post_category(){
        $args = [
            'hierarchical' => true,
            'labels' => [
                'name'              => _x( 'Categories', 'taxonomy general name', 'pdf-embed-viewer' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name', 'pdf-embed-viewer' ),
                'search_items'      => __( 'Search Categories', 'pdf-embed-viewer' ),
                'all_items'         => __( 'All Categories', 'pdf-embed-viewer' ),
                'parent_item'       => __( 'Parent Category', 'pdf-embed-viewer' ),
                'parent_item_colon' => __( 'Parent Category:', 'pdf-embed-viewer' ),
                'edit_item'         => __( 'Edit Category', 'pdf-embed-viewer' ),
                'update_item'       => __( 'Update Category', 'pdf-embed-viewer' ),
                'add_new_item'      => __( 'Add New Category', 'pdf-embed-viewer' ),
                'new_item_name'     => __( 'New Category Name', 'pdf-embed-viewer' ),
                'menu_name'         => __( 'Categories', 'pdf-embed-viewer' ),
            ],
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => [ 'slug' => 'pdfev_category' ],
        ];
        register_taxonomy('pdfev_category', ['pdfev_embed_viewer'], $args);

        $author_args = [
            'hierarchical' => false,
            'labels' => [
                'name' => _x( 'Authors', 'taxonomy general name', 'pdf-embed-viewer' ),
                'singular_name' => _x( 'Author', 'taxonomy singular name', 'pdf-embed-viewer' ),
                'search_items' => __( 'Search Authors', 'pdf-embed-viewer' ),
                'all_items' => __( 'All Authors', 'pdf-embed-viewer' ),
                'edit_item' => __( 'Edit Author', 'pdf-embed-viewer' ),
                'update_item' => __( 'Update Author', 'pdf-embed-viewer' ),
                'add_new_item' => __( 'Add New Author', 'pdf-embed-viewer' ),
                'new_item_name' => __( 'New Author Name', 'pdf-embed-viewer' ),
                'menu_name' => __( 'Authors', 'pdf-embed-viewer' ),
            ],
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => [ 'slug' => 'pdfev_author' ],
        ];
        register_taxonomy('pdfev_author', ['pdfev_embed_viewer'], $author_args);

        $publisher_args = [
            'hierarchical' => false,
            'labels' => [
                'name' => _x( 'Publishers', 'taxonomy general name', 'pdf-embed-viewer' ),
                'singular_name' => _x( 'Publisher', 'taxonomy singular name', 'pdf-embed-viewer' ),
                'search_items' => __( 'Search Publishers', 'pdf-embed-viewer' ),
                'all_items' => __( 'All Publishers', 'pdf-embed-viewer' ),
                'edit_item' => __( 'Edit Publisher', 'pdf-embed-viewer' ),
                'update_item' => __( 'Update Publisher', 'pdf-embed-viewer' ),
                'add_new_item' => __( 'Add New Publisher', 'pdf-embed-viewer' ),
                'new_item_name' => __( 'New Publisher Name', 'pdf-embed-viewer' ),
                'menu_name' => __( 'Publishers', 'pdf-embed-viewer' ),
            ],
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => [ 'slug' => 'pdfev_publisher' ],
        ];
        register_taxonomy('pdfev_publisher', ['pdfev_embed_viewer'], $publisher_args);
    }
    public function create_post_type(){
        $labels = [
            "name" => __( "PDF Embed Viewer", 'pdf-embed-viewer' ),
            "singular_name" => __( "PDF Embed", 'pdf-embed-viewer' ),
            "menu_name" => __( "PDF Embed", 'pdf-embed-viewer' ),
            "all_items" => __( "All PDF", 'pdf-embed-viewer' ),
            "add_new" => __( "New PDF", 'pdf-embed-viewer' ),
            "add_new_item" => __("New PDF", 'pdf-embed-viewer' ),
        ];

        $args = [
            "label" => __( "PDF Embed", 'pdf-embed-viewer' ),
            "description" => __( "PDF Embed", 'pdf-embed-viewer' ),
            "labels" => $labels, 
            "public" => true,
            "supports" => [ "title",'thumbnail'], // post support ui elements
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
            "rewrite" => [ "slug" => get_option('pdfev_archive_slug'), "with_front" => true ],
            "query_var" => true,
            "menu_icon" => PDFEV_Const_URL.'assets/images/pdf-embed-viewer-icon.png',
            "show_in_graphql" => false,
            //"register_metabox_cb" => array($this,'add_meta_boxes'),
        ];

        register_post_type( "pdfev_embed_viewer", $args );
        
    }
    

    public function archive_template( $archive_template ) {
        
        
        if ( is_post_type_archive ( 'pdfev_embed_viewer' ) ) {                
            $archive_template = PDFEV_Const_Path . 'template/archive.php';
        }

        return $archive_template;
    }

    public function single_template($single_template) {
        global $post;
        if ($post->post_type == 'pdfev_embed_viewer'){  
                
            $single_template = get_template_directory().'/template/single.php';
            if( ! file_exists($single_template)){
                $single_template = PDFEV_Const_Path . 'template/single.php';
            }
        }
        return $single_template;
    }

    public static function get_posts_years_array() {
                    
        $terms_year = array(
            'post_type'         => 'pdfev_embed_viewer',
            'posts_per_page'    => -1,
        );
        $years = array();
        $query_year = new \WP_Query( $terms_year );
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
}

new \PDFEV\CPT();