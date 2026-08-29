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
        add_action( 'admin_enqueue_scripts', array($this,'enqueue_list_screen_assets') ) ;
        add_action( 'wp_ajax_pdfev_save_order', array($this,'ajax_save_order') ) ;
        add_filter( 'archive_template', array($this,'archive_template') ) ;
        add_filter( 'single_template', array($this,'single_template') ) ;
        // Block themes, singular view ONLY (not the archive — see the long
        // comment in archive_template() below for why archives can't use this
        // same mechanism): let the theme's own single.html block template
        // render completely natively (header, footer, wrapper markup, global
        // styles — all exactly as every other page gets them) and only swap
        // out the inner Post Content block. A full template override (single_
        // template() below) is correct for classic themes, but on a block
        // theme it requires hand-reconstructing the theme's entire <html>/
        // <head>/<body> skeleton (site-wide wrapper classes, global-styles
        // CSS custom properties, etc.) — easy to get subtly wrong, which is
        // exactly what made the single view's header/footer render smaller/
        // plainer than every other page. This filter never fires on a classic
        // theme (which has no core/post-content block to render in the first
        // place), so it and single_template()'s wp_is_block_theme() guard
        // never both fire for the same request.
        add_filter( 'render_block_core/post-content', array($this,'render_post_content'), 10, 2 ) ;
        // Suppresses the theme's own duplicate title above the plugin's
        // content block — same is_singular guard as render_post_content().
        add_filter( 'render_block_core/post-title', array($this,'suppress_singular_block'), 10, 2 ) ;
        // The theme's own featured-image block above the title — this CPT's
        // book cover is already shown inside the plugin's own reader/archive
        // views, so this was just a second, redundant large image at the top
        // of the single page.
        add_filter( 'render_block_core/post-featured-image', array($this,'suppress_singular_block'), 10, 2 ) ;
        // Best-effort: many block themes ship a "byline"/"post navigation"/
        // "more posts" pattern on their single template (rendered as a
        // core/pattern block), which for this CPT either shows blank (no
        // matching author/category display) or duplicates what the plugin's
        // own header/footer already show. Not exhaustive across every theme's
        // naming, but catches the common cases via a slug keyword match.
        add_filter( 'render_block_core/pattern', array($this,'suppress_redundant_patterns'), 10, 2 ) ;
        // Collapses any core/group block that renders down to empty content
        // (e.g. the theme's post-terms wrapper, when this CPT has no terms)
        // — see suppress_empty_group()'s own comment for why.
        add_filter( 'render_block_core/group', array($this,'suppress_empty_group'), 10, 2 ) ;
    }

    public function posts_columns($columns){
        unset($columns['date']);

        // Insert the drag-reorder handle right after the checkbox column, before
        // Title — array_merge would lose the 'cb' position, so rebuild in place.
        $with_handle = [];
        foreach ( $columns as $key => $label ) {
            $with_handle[ $key ] = $label;
            if ( 'cb' === $key ) {
                $with_handle['pdfev_reorder'] = '';
            }
        }
        $columns = $with_handle;

        $columns['pdfev_meta_download'] = esc_html__('Download','pdf-embed-viewer');
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
            case 'pdfev_reorder':
                echo '<span class="pdfev-drag-handle" title="' . esc_attr__( 'Drag to reorder', 'pdf-embed-viewer' ) . '">'
                    . '<svg width="10" height="16" viewBox="0 0 10 16" fill="currentColor" aria-hidden="true">'
                    . '<circle cx="2.5" cy="2.5" r="1.5"/><circle cx="7.5" cy="2.5" r="1.5"/>'
                    . '<circle cx="2.5" cy="8" r="1.5"/><circle cx="7.5" cy="8" r="1.5"/>'
                    . '<circle cx="2.5" cy="13.5" r="1.5"/><circle cx="7.5" cy="13.5" r="1.5"/>'
                    . '</svg>'
                    . '</span>';
            break;
            case 'pdfev_meta_pdf_url':
                $url = get_post_meta($post_id,'pdfev_meta_pdf_url',true);
                if ( $url ) {
                    echo '<a href="' . esc_url($url) . '" class="pdfev-file-url" target="_blank" rel="noopener noreferrer" title="' . esc_attr($url) . '">' . esc_html($url) . '</a>';
                }
            break;
            case 'pdfev_meta_download':
                $enabled = get_post_meta($post_id,'pdfev_meta_download',true) === 'yes';
                echo '<span class="pdfev-badge ' . ( $enabled ? 'pdfev-badge--on' : 'pdfev-badge--off' ) . '">' . ( $enabled ? esc_html__('Enabled','pdf-embed-viewer') : esc_html__('Disabled','pdf-embed-viewer') ) . '</span>';
            break;
            case 'pdfev_meta_downloads_count':
                $downloads = get_post_meta($post_id,'pdfev_meta_downloads_count',true);
                $downloads = $downloads?$downloads:0;
                echo '<span class="pdfev-stat">' . esc_html($downloads) . '</span>';
            break;
            case 'pdfev_meta_views_count':
                $views = get_post_meta($post_id,'pdfev_meta_views_count',true);
                $views = $views?$views:0;
                echo '<span class="pdfev-stat">' . esc_html($views) . '</span>';
            break;
            case 'shortcode_column':
                $shortcode = '[pdfev_embed_viewer id="'.get_the_ID().'"]';
                echo '<span class="pdfev-shortcode-cell">';
                echo '<code class="pdfev-shortcode-chip" title="' . esc_attr($shortcode) . '">' . esc_html($shortcode) . '</code>';
                echo '<button type="button" class="pdfev-copy-btn" data-copy="' . esc_attr($shortcode) . '" title="' . esc_attr__('Copy shortcode','pdf-embed-viewer') . '"><span class="dashicons dashicons-clipboard"></span></button>';
                echo '</span>';
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

    /**
     * Loads the drag-to-reorder handle only on this CPT's own list screen, and
     * only when the list is showing its natural, unfiltered order — dragging
     * while searching, filtering by taxonomy, or sorted by a column (Views,
     * Downloads, ...) would silently reorder a subset that doesn't match what
     * a plain "PDF Embed" visit shows, which is confusing rather than useful.
     */
    public function enqueue_list_screen_assets( $hook ) {
        if ( 'edit.php' !== $hook || ! isset( $_GET['post_type'] ) || 'pdfev_embed_viewer' !== $_GET['post_type'] ) {
            return;
        }

        $is_filtered = ! empty( $_GET['s'] )
            || ! empty( $_GET['orderby'] )
            || ! empty( $_GET['pdfev_category'] )
            || ! empty( $_GET['pdfev_author'] )
            || ! empty( $_GET['pdfev_publisher'] )
            || ( isset( $_GET['post_status'] ) && 'publish' !== $_GET['post_status'] && '' !== $_GET['post_status'] );

        $per_page = (int) get_user_option( 'edit_pdfev_embed_viewer_per_page' );
        $per_page = $per_page > 0 ? $per_page : 20; // WP_List_Table's own built-in default.
        $paged    = isset( $_GET['paged'] ) ? max( 1, absint( $_GET['paged'] ) ) : 1;

        // Visual refresh of the native WP_List_Table markup — colors, spacing,
        // badges, chips — no structural HTML changes, so bulk actions, quick
        // edit, screen options and search/filter all keep working untouched.
        $list_css_path = PDFEV_Const_Path . 'assets/css/admin-list.css';
        $list_css_ver  = file_exists( $list_css_path ) ? filemtime( $list_css_path ) : PDFEV_Const_VERSION;
        wp_enqueue_style( 'pdfev-admin-list', PDFEV_Const_URL . 'assets/css/admin-list.css', [], $list_css_ver );

        $list_js_path = PDFEV_Const_Path . 'assets/js/admin-list.js';
        $list_js_ver  = file_exists( $list_js_path ) ? filemtime( $list_js_path ) : PDFEV_Const_VERSION;
        wp_enqueue_script( 'pdfev-admin-list', PDFEV_Const_URL . 'assets/js/admin-list.js', [ 'jquery' ], $list_js_ver, true );

        wp_enqueue_style( 'pdfev-admin-reorder', PDFEV_Const_URL . 'assets/css/admin-reorder.css', [ 'pdfev-admin-list' ], PDFEV_Const_VERSION );

        $reorder_js_path = PDFEV_Const_Path . 'assets/js/admin-reorder.js';
        $reorder_js_ver  = file_exists( $reorder_js_path ) ? filemtime( $reorder_js_path ) : PDFEV_Const_VERSION;
        wp_enqueue_script( 'pdfev-admin-reorder', PDFEV_Const_URL . 'assets/js/admin-reorder.js', [ 'jquery', 'jquery-ui-sortable' ], $reorder_js_ver, true );

        wp_localize_script( 'pdfev-admin-reorder', 'pdfevReorder', [
            'ajaxurl'    => admin_url( 'admin-ajax.php' ),
            'ajaxnonce'  => wp_create_nonce( 'pdf_ajax_nonce' ),
            'canReorder' => ! $is_filtered,
            'pageOffset' => ( $paged - 1 ) * $per_page,
        ] );
    }

    /**
     * Persists a drag-and-drop reorder from the admin list screen. `order` is
     * the dragged row IDs in their new top-to-bottom sequence; `pdfev_reorder.php`'s
     * client adds the current page's offset before sending, so page 2+ doesn't
     * collide with page 1's menu_order values. Every ID is verified to actually
     * be this CPT before touching it — this endpoint must never become a way to
     * reorder (or, via a crafted ID, expose the existence of) unrelated posts.
     */
    public function ajax_save_order() {
        check_ajax_referer( 'pdf_ajax_nonce', 'ajaxnonce' );

        if ( ! current_user_can( 'edit_others_posts' ) ) {
            wp_send_json_error( [ 'message' => __( 'Permission denied.', 'pdf-embed-viewer' ) ] );
        }

        $offset = isset( $_POST['offset'] ) ? absint( $_POST['offset'] ) : 0;
        $order  = isset( $_POST['order'] ) && is_array( $_POST['order'] ) ? array_map( 'absint', wp_unslash( $_POST['order'] ) ) : [];

        if ( empty( $order ) ) {
            wp_send_json_error( [ 'message' => __( 'Nothing to reorder.', 'pdf-embed-viewer' ) ] );
        }

        foreach ( $order as $position => $post_id ) {
            if ( 'pdfev_embed_viewer' !== get_post_type( $post_id ) ) {
                continue;
            }
            wp_update_post( [ 'ID' => $post_id, 'menu_order' => $offset + $position ] );
        }

        wp_send_json_success();
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
            "supports" => [ "title",'thumbnail','page-attributes'], // post support ui elements — page-attributes adds the "Order" field and (this CPT is already hierarchical) native drag-and-drop reordering on the admin list screen
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
        // Unconditional (unlike single_template() below): a block theme's
        // archive.html typically loops posts via a Query Loop pattern, which
        // renders its own inner core/post-content block once PER POST in the
        // loop — there is no single, page-level "the archive's content block"
        // to swap out the way single.html has exactly one for the current
        // post. Filtering render_block_core/post-content was tried here and
        // caused the plugin's own full post list to render once per looped
        // post (a combinatorial, massively duplicated page) — a full template
        // override sidesteps the query loop entirely instead of fighting it.
        if ( is_post_type_archive ( 'pdfev_embed_viewer' ) ) {
            $archive_template = PDFEV_Const_Path . 'template/archive.php';
        }

        return $archive_template;
    }

    public function single_template( $single_template ) {
        global $post;
        // Classic themes only — see render_post_content() below for the
        // block-theme path.
        if ( $post && $post->post_type === 'pdfev_embed_viewer' && ! wp_is_block_theme() ) {
            $single_template = get_template_directory() . '/template/single.php';
            if ( ! file_exists( $single_template ) ) {
                $single_template = PDFEV_Const_Path . 'template/single.php';
            }
        }
        return $single_template;
    }

    public function render_post_content( $block_content, $block ) {
        // Singular only — see archive_template() above for why the archive
        // view can't use this same per-block-instance filtering mechanism.
        if ( is_singular( 'pdfev_embed_viewer' ) ) {
            ob_start();
            // The wrapping div matters, not just for cosmetics: every width/
            // spacing rule for .header/.navigation is written as descendant
            // selectors off .pdfev-embed-viewer (assets/css/frontend.css).
            // Without this wrapper, do_action('pdfev_template_single_header')/
            // _footer() print .header/.navigation as siblings of the
            // shortcode's own .pdfev-embed-viewer div instead of descendants
            // of it — none of that CSS would match, and the theme's own
            // constrained-width wrapper (a different, narrower content width
            // than the plugin's own 1300px) would size them instead, which is
            // exactly why they rendered narrower than the flipbook below
            // them. template/single.php (the classic-theme path) already
            // wraps all three the same way — this just matches it.
            ?>
            <div class="pdfev-embed-viewer">
                <?php
                do_action( 'pdfev_template_single_header' );
                echo do_shortcode( '[pdfev_embed_viewer id="' . get_the_ID() . '"]' );
                do_action( 'pdfev_template_single_footer' );
                ?>
            </div>
            <?php
            return ob_get_clean();
        }

        return $block_content;
    }

    public function suppress_singular_block( $block_content, $block ) {
        if ( is_singular( 'pdfev_embed_viewer' ) ) {
            return '';
        }
        return $block_content;
    }

    public function suppress_redundant_patterns( $block_content, $block ) {
        // Singular only — the archive view is a full template override (see
        // archive_template() above), which never runs the theme's own
        // archive.html through the block-rendering pipeline in the first
        // place, so this filter has nothing to do there.
        if ( ! is_singular( 'pdfev_embed_viewer' ) ) {
            return $block_content;
        }
        $slug = $block['attrs']['slug'] ?? '';
        $redundant_keywords = [ 'written-by', 'byline', 'post-navigation', 'more-posts', 'comments' ];
        foreach ( $redundant_keywords as $keyword ) {
            if ( strpos( $slug, $keyword ) !== false ) {
                return '';
            }
        }
        return $block_content;
    }

    public function suppress_empty_group( $block_content, $block ) {
        // Singular only, same reasoning as the two filters above. The theme
        // wraps core/post-terms in its own padded group — this CPT has no
        // post_tag terms, so post-terms itself renders nothing, but the
        // wrapping group's own top/bottom padding (from theme.json spacing
        // presets) still rendered, leaving a large empty gap between the
        // plugin's content and the site footer. A group that renders down to
        // no visible content (whitespace/comments only) serves no purpose —
        // hiding it removes that dead padding along with it. Scoped to empty
        // *groups* specifically (not just any empty block) so it can't
        // accidentally swallow a legitimately content-less block that's
        // supposed to render its own visible chrome.
        if ( is_singular( 'pdfev_embed_viewer' ) && trim( wp_strip_all_tags( $block_content ) ) === '' ) {
            return '';
        }
        return $block_content;
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