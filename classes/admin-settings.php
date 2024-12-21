<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Admin_Settings') ){
    class PDFEV_Admin_Settings{
        
        public function __construct() {
            
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'init', array($this,'save_options_data') ); 
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
            ?>
            <div class="wrap admin-wrap pdfev-embed-viewer">
                <h2><?php get_admin_page_title(); ?></h2>
                <h2 class="nav-tab-wrapper">
                    <?php do_action('pdfev_settings_tabs'); ?>                
                </h2>
                <form action="" method="post">
                    <?php wp_nonce_field( 'pdfev_emd_vwr_options_nonce', 'pdfev_emd_vwr_options_nonce' ); ?>
                    <?php do_action('pdfev_settings_tabs_content'); ?>
                </form>
            </div>
            <?php
        }

        private function options_array_sanitize($data){

            foreach ( $data as $key => $value ) {
                $data[ $key ] = sanitize_text_field( $value );
            }
            return $data;
        }

        public function save_options_data() {
            if( isset( $_POST['pdfev_emd_vwr_options_nonce'] ) ){
                if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_options_nonce'] ) ) , 'pdfev_emd_vwr_options_nonce' ) ){
                    return;
                }
                
                $archive_title      = isset( $_POST['pdfev_archive_title'] ) ? sanitize_text_field($_POST['pdfev_archive_title']): 'Pdf Embed Viewer';
                $archive_slug       = isset( $_POST['pdfev_archive_slug'] ) ? sanitize_text_field(sanitize_title($_POST['pdfev_archive_slug'])): 'pdf-embed-viewer';
                $archive_template   = isset( $_POST['pdfev_archive_template'] ) ? sanitize_text_field($_POST['pdfev_archive_template']): 'list';
                $archive_read       = isset( $_POST['pdfev_archive_read'] ) ? sanitize_text_field($_POST['pdfev_archive_read']): 'no';
                $archive_download   = isset( $_POST['pdfev_archive_download'] ) ? sanitize_text_field($_POST['pdfev_archive_download']): 'no';
                $primary            = isset( $_POST['pdfev_css_colors']['primary'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['primary']) : '';
                $secondary          = isset( $_POST['pdfev_css_colors']['secondary'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['secondary']) : '';
                $dark               = isset( $_POST['pdfev_css_colors']['dark'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['dark'])  : '';
                $light              = isset( $_POST['pdfev_css_colors']['light'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['light'])    :'';

                $colors = [
                    'primary'   => $primary,
                    'secondary' => $secondary,
                    'dark'      => $dark,
                    'light'     => $light,
                ];
                update_option('pdfev_archive_title',$archive_title);
                update_option('pdfev_archive_slug',$archive_slug);
                update_option('pdfev_archive_template',$archive_template);
                update_option('pdfev_archive_read',$archive_read);
                update_option('pdfev_archive_download',$archive_download);
                update_option('pdfev_css_colors',$colors );                
            }
        }
    }
    
    $PDFEV_Admin_Settings = new PDFEV_Admin_Settings();
}