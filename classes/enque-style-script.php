<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 */
namespace PDFEV;

defined('ABSPATH') || exit;

class Enque_Style{
    public function __construct()
    {
        add_action('admin_enqueue_scripts',[$this,'backend_style']);
        add_action('wp_enqueue_scripts',[$this,'frontend_style']);
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
        wp_enqueue_script( 'pdf-embed-viewer', PDFEV_Const_URL.'assets/js/admin.js', ['jquery','wp-color-picker','jquery-ui-core'], $admin_js_ver, false );
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
            // css ===
            wp_enqueue_style('pdfev-font-awesome',PDFEV_Const_URL.'vendor/font-awesome/font-awesome.min.css',[],PDFEV_Const_VERSION,'all');
            wp_enqueue_style('pdfev-frontend-style',PDFEV_Const_URL.'assets/css/frontend.css',[],PDFEV_Const_VERSION,'all');
            // javascript ===
            $frontend_js_path = PDFEV_Const_Path.'assets/js/frontend.js';
            $frontend_js_ver = file_exists($frontend_js_path) ? filemtime($frontend_js_path) : PDFEV_Const_VERSION;
            wp_enqueue_script( 'pdf-frontend-script', PDFEV_Const_URL.'assets/js/frontend.js',['jquery'],$frontend_js_ver,true);
            wp_enqueue_script( 'pdf-three.min', PDFEV_Const_URL.'vendor/3dflipbook/js/three.min.js',['jquery'],PDFEV_Const_VERSION,true);
            wp_enqueue_script( 'pdf-min', PDFEV_Const_URL.'vendor/pdf/pdf.js',['jquery'],PDFEV_Const_VERSION,true);
            wp_enqueue_script( 'pdf-3dflipbook', PDFEV_Const_URL.'vendor/3dflipbook/js/3dflipbook.min.js',[],PDFEV_Const_VERSION,true);
            // wp_enqueue_script( 'pdf-3dflipbook', PDFEV_Const_URL.'vendor/3dflipbook/js/3dflipbook.js',[],PDFEV_Const_VERSION,true);
            wp_enqueue_script( 'pdf-simple-jquery-pdf', PDFEV_Const_URL.'vendor/3dflipbook/js/simple-jquery-pdf.js',[],PDFEV_Const_VERSION,true);
            
            $colors         = get_option('pdfev_css_colors');         
            $primary        = esc_html($colors['primary'] ? $colors['primary'] : '#c79f62');
            $secondary      = esc_html($colors['secondary'] ? $colors['secondary'] : '#666');
            $dark           = esc_html($colors['dark'] ? $colors['dark'] : '#333');
            $light          = esc_html($colors['light'] ? $colors['light'] : '#e5e5e5');
            $inline_css = ":root{
                    --pdfev-primary:{$primary };        
                    --pdfev-secondary:{$secondary};
                    --pdfev-dark:{$dark}; 
                    --pdfev-light:{$light};
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
            $flipbook_pro_js = apply_filters('pdfev_frontend_localize_data', $flipbook_pro_js);
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

}

new \PDFEV\Enque_Style();
