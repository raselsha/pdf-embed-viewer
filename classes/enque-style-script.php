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

        if(is_singular( 'pdfev_embed_viewer') || is_post_type_archive( 'pdfev_embed_viewer') || shortcode_exists('pdfev_viewer') ){
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

            // Pro flipbook display options — never built/localized for a
            // de-licensed install, so a lapsed license's frontend JS never even
            // receives this config (belt-and-suspenders alongside the PHP
            // is_pro() rechecks elsewhere).
            if (\PDFEV_Functions::is_pro()) {
                $flipbook_pro = wp_parse_args(get_option('pdfev_flipbook_pro_options', []), \PDFEV_Functions::get_flipbook_pro_defaults());
                $skin_map     = \PDFEV_Functions::get_flipbook_skin_map();
                $skin_file    = isset($skin_map[$flipbook_pro['skin']]) ? $skin_map[$flipbook_pro['skin']] : $skin_map['black-short'];

                $flipbook_pro_js = [
                    'rtl'              => $flipbook_pro['rtl'] === 'yes',
                    'style'            => $flipbook_pro['style'],
                    'singlePageMode'   => $flipbook_pro['page_mode'],
                    'autoPlayDuration' => (int) $flipbook_pro['autoplay_duration'],
                    'skinFile'         => $skin_file,
                    'controlsProps'    => [
                        'scale' => [
                            'default' => (float) $flipbook_pro['zoom_default'],
                            'min'     => (float) $flipbook_pro['zoom_min'],
                            'max'     => (float) $flipbook_pro['zoom_max'],
                        ],
                        'actions' => [
                            'cmdSounds'     => ['active' => $flipbook_pro['sound'] === 'yes'],
                            'cmdAutoPlay'   => ['active' => $flipbook_pro['autoplay'] === 'yes'],
                            'cmdPrint'      => ['active' => $flipbook_pro['show_print'] === 'yes'],
                            'cmdFullScreen' => ['active' => $flipbook_pro['show_fullscreen'] === 'yes'],
                            'cmdToc'        => ['active' => $flipbook_pro['show_toc'] === 'yes'],
                            'cmdShare'      => ['active' => $flipbook_pro['show_share'] === 'yes'],
                        ],
                    ],
                ];

                if (!empty($flipbook_pro['background_color'])) {
                    $flipbook_pro_js['backgroundColor'] = $flipbook_pro['background_color'];
                }

                // Only the default skin's CSS ships in the vendor's static jsData
                // blob (vendor/3dflipbook/js/simple-jquery-pdf.js) — inject the
                // other variants' actual file contents at runtime when a
                // different skin is selected.
                if ($skin_file !== $skin_map['black-short']) {
                    $skin_path = PDFEV_Const_Path . 'vendor/3dflipbook/css/' . $skin_file;
                    if (file_exists($skin_path)) {
                        $skin_css = file_get_contents($skin_path);
                        $inline   = 'window.jsData = window.jsData || {urls: {}}; window.jsData.urls[' . wp_json_encode('css/' . $skin_file) . '] = ' . wp_json_encode($skin_css) . ';';
                        wp_add_inline_script('pdf-simple-jquery-pdf', $inline, 'after');
                    }
                }
            }
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
