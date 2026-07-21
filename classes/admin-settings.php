<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.1
 */

namespace PDFEV;

defined('ABSPATH')  || exit;

class Admin_Settings{
    
    public function __construct() {
        
        add_action( 'admin_menu', array($this,'create_admin_menu') ); 
        add_action( 'init', array($this,'custom_rewrite_flush') ); 
        add_filter( 'plugin_action_links_pdf-embed-viewer/pdf-embed-viewer.php',[$this,'add_settings_link']);
    }   

    public function custom_rewrite_flush(){
        flush_rewrite_rules();
    }

    public function create_admin_menu(){
        add_submenu_page(
            'edit.php?post_type=pdfev_embed_viewer',
            __('PDF Embed - Viewer','pdf-embed-viewer'),
            __('Settings','pdf-embed-viewer'),
            'manage_options',
            'index', // page url 
            array($this,'settings_index_page'),
        ); 
    }

    public function add_settings_link($links){
        $url = esc_url( add_query_arg( array( 'post_type' => 'pdfev_embed_viewer', 'page' => 'index', ), get_admin_url() . 'edit.php' ) );
        
        $settings_link = "<a href='$url'>" . __( 'Settings','pdf-embed-viewer') . '</a>';
        // Adds the link to the end of the array.
        array_push(
            $links,
            $settings_link
        );
        return $links;
    }
    public function settings_index_page(){
        if( isset( $_POST['pdfev_emd_vwr_options_nonce'] ) ){
            if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_options_nonce'] ) ) , 'pdfev_emd_vwr_options_nonce' ) ){
                return;
            }
            if( ! current_user_can('manage_options')){
                return;
            }
            add_settings_error('pdfev_emd_vwr_options_nonce','save-data',__('Settings Saved!','pdf-embed-viewer'),'success');
            settings_errors('pdfev_emd_vwr_options_nonce');
            
        }
        $this->settings_html_layout();
    
    }

    public function settings_html_layout(){
        /*
         * WP core's admin JS (common.js) relocates any .notice/.updated/.error to right after
         * the first h1/h2 it finds inside .wrap when no .wp-header-end marker exists. Our own
         * <h1> lives nested inside .pdfev-header, so without this marker, notices (e.g. the
         * Appsero opt-in) would get injected inside that card instead. Placed as a sibling
         * before .wrap (not inside it) so relocated notices render outside our padded/centered
         * container, at native WP admin width, instead of squeezed into it.
         */
        ?>
        <span class="wp-header-end"></span>
        <div class="wrap pdfev-embed-viewer pdfev-settings-page">
            <div class="pdfev-header">
                <span class="pdfev-header-icon dashicons dashicons-media-document" aria-hidden="true"></span>
                <div class="pdfev-header-text">
                    <h1><?php echo esc_html__('PDF Embed Viewer', 'pdf-embed-viewer'); ?></h1>
                    <p><?php echo esc_html__('Configure your flipbook viewer, shortcodes, and display options.', 'pdf-embed-viewer'); ?></p>
                </div>
                <div class="pdfev-header-actions">
                    <span class="pdfev-header-version">v<?php echo esc_html(defined('PDFEV_Const_VERSION') ? PDFEV_Const_VERSION : ''); ?></span>
                    <?php
                    /*
                     * Submits the General Settings tab's form (#pdfev-settings-form) via the
                     * HTML5 form="" attribute, without needing this shared page header to live
                     * inside that tab-specific <form> itself. Harmless on other tabs too — it
                     * just submits the same settings form regardless of which tab is showing.
                     */
                    ?>
                    <button type="submit" form="pdfev-settings-form" class="pdfev-btn pdfev-btn-primary pdfev-header-save">
                        <span class="dashicons dashicons-yes" aria-hidden="true"></span>
                        <?php esc_html_e('Save Changes', 'pdf-embed-viewer'); ?>
                    </button>
                </div>
            </div>
            <div class="pdfev-tabs" role="tablist">
                <?php do_action('pdfev_settings_tabs'); ?>
            </div>
            <div class="pdfev-tab-panels">
                <?php do_action('pdfev_settings_tabs_content'); ?>
            </div>
        </div>
        <?php
    }
}
    
new \PDFEV\Admin_Settings();
