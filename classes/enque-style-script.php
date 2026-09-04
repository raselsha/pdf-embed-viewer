<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 */
namespace PDFEV;

defined('ABSPATH') || exit;

class Enque_Style{
    // Flipped on by Shortcode::single_pdf_shortcode()/archive_pdf_shortcode()
    // when either shortcode actually runs — the only reliable signal for
    // shortcodes invoked from PHP (do_shortcode() in a theme template, e.g.
    // flipbook-theme's front-page.php hero demo) rather than from a post's
    // saved post_content, which frontend_style()'s own has_shortcode() check
    // below has no way to see ahead of time.
    public static $shortcode_used = false;

    public function __construct()
    {
        add_action('admin_enqueue_scripts',[$this,'backend_style']);
        add_action('wp_enqueue_scripts',[$this,'frontend_style']);
        // Runs after the template body (and so after any do_shortcode() call
        // in it) but before WordPress prints the footer scripts queue, to
        // catch exactly the case frontend_style() (hooked on
        // wp_enqueue_scripts, which fires before the template body at all)
        // structurally cannot: a shortcode used outside post_content.
        add_action('wp_footer',[$this,'late_frontend_style'],1);
    }

    public function backend_style(){
        wp_enqueue_style('pdfev-font-awesome',PDFEV_Const_URL.'vendor/font-awesome/font-awesome.min.css',[],PDFEV_Const_VERSION,'all');

        $admin_css_path = PDFEV_Const_Path.'assets/css/admin.css';
        $admin_css_ver = file_exists($admin_css_path) ? filemtime($admin_css_path) : PDFEV_Const_VERSION;
        wp_enqueue_style('main',PDFEV_Const_URL.'assets/css/admin.css',['wp-color-picker'],$admin_css_ver,'all');
        wp_enqueue_media();

        wp_enqueue_script( 'pdfjs', PDFEV_Const_URL.'vendor/pdf/pdf.min.js', [], PDFEV_Const_VERSION, true );
        wp_enqueue_script( 'pdfjs-worker', PDFEV_Const_URL.'vendor/pdf/pdf.worker.min.js', [], PDFEV_Const_VERSION, true );

        $admin_js_path = PDFEV_Const_Path.'assets/js/admin.js';
        $admin_js_ver = file_exists($admin_js_path) ? filemtime($admin_js_path) : PDFEV_Const_VERSION;
        // 'media-editor' isn't just for wp.media() (already used elsewhere in this
        // file without declaring it, since browsers execute deferred/footer
        // scripts in document order regardless of declared deps for THAT usage) —
        // it's required here specifically because admin.js wraps
        // wp.media.featuredImage.set at parse time (top-level, not inside a
        // click handler), so media-editor.js must have already run by then.
        // Without this dependency, WP has no reason to print it before admin.js.
        wp_enqueue_script( 'pdf-embed-viewer', PDFEV_Const_URL.'assets/js/admin.js', ['jquery','wp-color-picker','jquery-ui-core','media-editor'], $admin_js_ver, false );
        wp_localize_script('pdf-embed-viewer', 'pdfevAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajaxnonce'=> wp_create_nonce('pdf_ajax_nonce'),
            'pdfevurl' => PDFEV_Const_URL,
            'pdfworker' => PDFEV_Const_URL.'vendor/pdf/pdf.worker.min.js',
            'post_id' => get_the_ID(),
        ));
    }

    public function frontend_style(){

        $flipbook_pro_js = [];

        $is_pdf_page = is_singular('pdfev_embed_viewer') || is_post_type_archive('pdfev_embed_viewer');

        // shortcode_exists() only tells us the tag is registered, not that this
        // page actually uses it (it's always registered) — check the current
        // post for real usage instead, so assets don't load site-wide.
        if( ! $is_pdf_page && is_singular() ){
            $post = get_post();
            if( $post && ( has_shortcode($post->post_content, 'pdfev_viewer') || has_shortcode($post->post_content, 'pdfev_embed_viewer') ) ){
                $is_pdf_page = true;
            } else if( $post ){
                $elementor_data = get_post_meta($post->ID, '_elementor_data', true);
                if( $elementor_data && ( strpos($elementor_data, 'pdfev-single-view') !== false || strpos($elementor_data, 'pdfev-archive-view') !== false ) ){
                    $is_pdf_page = true;
                }
            }
        }

        if( $is_pdf_page ){
            $flipbook_pro_js = $this->enqueue_frontend_assets();
        }

        $pdfev_frontend_data = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajaxnonce'   => wp_create_nonce('pdf_ajax_nonce'),
            'pdfevurl' => esc_url(PDFEV_Const_URL),
            'post_id' => get_the_ID(),
        );

        if (!empty($flipbook_pro_js)) {
            $pdfev_frontend_data['flipbookOptions'] = $flipbook_pro_js;
        }

        wp_localize_script('pdf-frontend-script', 'pdfevFronend', $pdfev_frontend_data);

    }

    /**
     * The actual css/js enqueues, split out of frontend_style() so
     * late_frontend_style() below can call the exact same thing once a
     * shortcode used outside post_content has flagged itself. Returns
     * whatever pdfev_frontend_localize_data collected, for the caller to
     * fold into pdfevFronend's localized data.
     */
    private function enqueue_frontend_assets(){
        // css ===
        wp_enqueue_style('pdfev-font-awesome',PDFEV_Const_URL.'vendor/font-awesome/font-awesome.min.css',[],PDFEV_Const_VERSION,'all');
        $frontend_css_path = PDFEV_Const_Path.'assets/css/frontend.css';
        $frontend_css_ver = file_exists($frontend_css_path) ? filemtime($frontend_css_path) : PDFEV_Const_VERSION;
        wp_enqueue_style('pdfev-frontend-style',PDFEV_Const_URL.'assets/css/frontend.css',[],$frontend_css_ver,'all');
        // javascript ===
        $frontend_js_path = PDFEV_Const_Path.'assets/js/frontend.js';
        $frontend_js_ver = file_exists($frontend_js_path) ? filemtime($frontend_js_path) : PDFEV_Const_VERSION;
        wp_enqueue_script( 'pdf-frontend-script', PDFEV_Const_URL.'assets/js/frontend.js',['jquery'],$frontend_js_ver,true);
        wp_enqueue_script( 'pdf-three.min', PDFEV_Const_URL.'vendor/3dflipbook/js/three.min.js',['jquery'],PDFEV_Const_VERSION,true);
        wp_enqueue_script( 'pdf-min', PDFEV_Const_URL.'vendor/pdf/pdf.js',['jquery'],PDFEV_Const_VERSION,true);
        wp_enqueue_script( 'pdf-3dflipbook', PDFEV_Const_URL.'vendor/3dflipbook/js/3dflipbook.min.js',[],PDFEV_Const_VERSION,true);
        wp_enqueue_script( 'pdf-simple-jquery-pdf', PDFEV_Const_URL.'vendor/3dflipbook/js/simple-jquery-pdf.js',[],PDFEV_Const_VERSION,true);

        $colors         = get_option('pdfev_css_colors');
        $primary        = esc_html($colors['primary'] ? $colors['primary'] : '#c79f62');
        $secondary      = esc_html($colors['secondary'] ? $colors['secondary'] : '#666');
        $dark           = esc_html($colors['dark'] ? $colors['dark'] : '#333');
        $light          = esc_html($colors['light'] ? $colors['light'] : '#e5e5e5');
        // Both left unset by default (no border, transparent background) —
        // .pdfev-3dbook-container's own CSS falls back to `none`/`transparent`
        // via var(--x, fallback) when these are empty.
        $container_border = ! empty($colors['container_border']) ? esc_html($colors['container_border']) : '';
        $container_bg      = ! empty($colors['container_bg']) ? esc_html($colors['container_bg']) : '';
        $inline_css = ":root{
                --pdfev-primary:{$primary };
                --pdfev-secondary:{$secondary};
                --pdfev-dark:{$dark};
                --pdfev-light:{$light};
                " . ( $container_border !== '' ? "--pdfev-container-border:1px solid {$container_border};" : '' ) . "
                " . ( $container_bg !== '' ? "--pdfev-container-bg:{$container_bg};" : '' ) . "
                }
            ";
        wp_add_inline_style('pdfev-frontend-style', $inline_css);
        wp_add_inline_script('pdf-3dflipbook', 'window.$ = window.jQuery;', 'before');
        wp_add_inline_script('pdf-3dflipbook', '
            window.PDFJS_LOCALE = {
                pdfJsWorker: "' . esc_url(PDFEV_Const_URL . 'vendor/pdf/pdf.worker.js') . '",
                pdfJsCMapUrl: "cmaps"
            };
        ', 'before');

        // Lets an add-on (e.g. pdf-embed-viewer-pro) contribute extra data to
        // merge into the localized frontend script object (e.g.
        // flipbookOptions) and enqueue any inline scripts it needs (e.g.
        // injecting an alternate skin's CSS into the 3dflipbook vendor
        // library's jsData blob — see pdf-embed-viewer-pro's own hook).
        // Deliberately called *inside* this guard, not after it, so an
        // add-on's own license check only ever runs on PDF-relevant pages,
        // not site-wide — this is exactly where the old Pro-only code sat.
        return apply_filters('pdfev_frontend_localize_data', []);
    }

    /**
     * Catches shortcode usage frontend_style() structurally cannot see ahead
     * of time: pdfev_viewer/pdfev_embed_viewer called via do_shortcode() in
     * a theme template (e.g. flipbook-theme's front-page.php hero demo)
     * rather than sitting in a post's saved post_content. Without this, the
     * shortcode's own markup still renders fine (the shortcode callback runs
     * regardless), but none of its CSS/JS ever loads, so the viewer sits
     * inert — visible container, nothing inside it ever initializes.
     *
     * Hooked at wp_footer priority 1, i.e. after the template body (so
     * Shortcode::$shortcode_used is already set if it's going to be) but
     * before WordPress's own wp_print_footer_scripts (default priority 10)
     * prints the footer script queue — enqueuing here still lets those
     * scripts go out normally. Styles don't get that same automatic late
     * print, so they're echoed directly.
     */
    public function late_frontend_style(){
        if ( ! Shortcode::$shortcode_used ) {
            return;
        }
        if ( wp_style_is('pdfev-frontend-style', 'enqueued') || wp_style_is('pdfev-frontend-style', 'done') ) {
            // frontend_style() already found and handled this page normally.
            return;
        }

        $flipbook_pro_js = $this->enqueue_frontend_assets();

        $pdfev_frontend_data = array(
            'ajaxurl'  => admin_url('admin-ajax.php'),
            'ajaxnonce'=> wp_create_nonce('pdf_ajax_nonce'),
            'pdfevurl' => esc_url(PDFEV_Const_URL),
            'post_id'  => get_the_ID(),
        );
        if (!empty($flipbook_pro_js)) {
            $pdfev_frontend_data['flipbookOptions'] = $flipbook_pro_js;
        }
        wp_localize_script('pdf-frontend-script', 'pdfevFronend', $pdfev_frontend_data);

        wp_print_styles(['pdfev-font-awesome', 'pdfev-frontend-style']);
    }

}

new \PDFEV\Enque_Style();
