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
            // ajux import demoe data
            add_action('wp_ajax_pdfev_import_demo_data', array($this,'import_demo_data')); // For logged-in users
            add_action('wp_ajax_nopriv_pdfev_import_demo_data', array($this,'import_demo_data'));
        }

        public function custom_rewrite_flush(){
            flush_rewrite_rules();
        }

        public function import_demo_data(){
            
            if( isset( $_POST['ajaxnonce'] ) ){
                if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['ajaxnonce'] ) ) , 'pdf_ajax_nonce' ) ){
                    wp_send_json_error('Invalid nonce');
                    return;
                }
            }

            $success = PDFEV_Functions::insert_demo_post();

            // Prepare the response
            $response = array(
                'success' => $success, // This should be true or false based on the function result
                'message' => $success ? __('Demo Data imported successfully!', 'pdf-embed-viewer') : __('Failed to import data.', 'pdf-embed-viewer')
            );
            wp_send_json($response);
            wp_die(); // End AJAX request

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
                    <button class="nav-tab active" data-tab-target="pdfev_emd_vwr_admin_tabs_settings"> <?php echo esc_html__('Settings','pdf-embed-viewer'); ?> </a>
                    <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_shortcode"> <?php echo esc_html__('Shortcode','pdf-embed-viewer'); ?> </a>
                    <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_support"> <?php echo esc_html__('Support','pdf-embed-viewer'); ?> </a>
                </h2>
                <form action="" method="post">
                    <?php wp_nonce_field( 'pdfev_emd_vwr_options_nonce', 'pdfev_emd_vwr_options_nonce' ); ?>
                    <div class="pdfev-tab-content active" data-tab="pdfev_emd_vwr_admin_tabs_settings">
                        <?php $this->options_fields(); ?>
                        <?php submit_button(); ?>
                    </div> 
                    <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_shortcode">
                        <table class="form-table" role="presentation">
                            <tbody>
                                <tr>
                                    <td>
                                        <h3><?php echo esc_html('[pdfev_viewer template="list"]') ?></h3>
                                        <img src="<?php echo PDFEV_Const_URL.'assets/images/template-list.png'; ?>" width="600">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><?php echo esc_html('[pdfev_viewer template="grid"]') ?></h3>
                                        <img src="<?php echo PDFEV_Const_URL.'assets/images/template-grid.png'; ?>" width="600">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><?php echo esc_html('[pdfev_viewer template="ebook"]') ?></h3>
                                        <img src="<?php echo PDFEV_Const_URL.'assets/images/template-ebook.png'; ?>" width="600">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><?php echo esc_html('[pdfev_viewer template="newsletter"]') ?></h3>
                                        <img src="<?php echo PDFEV_Const_URL.'assets/images/template-newsletter.png'; ?>" width="600">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_support">
                        <h2><?php esc_html_e('Give a review for your feedback','pdf-embed-viewer'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/pdf-embed-viewer/reviews/'); ?>"><?php esc_html_e('Add Review','pdf-embed-viewer'); ?></a> </h2>    
                        <h2><?php esc_html_e('Create a support ticket','pdf-embed-viewer'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/pdf-embed-viewer/'); ?>"><?php esc_html_e('support','pdf-embed-viewer'); ?></a> </h2>    
                        <h2><?php esc_html_e('Send email','pdf-embed-viewer'); ?> <a href="<?php echo esc_url('mailto:raselsha@gmail.com'); ?>"><?php esc_html_e('raselsha@gmail.com','pdf-embed-viewer'); ?></a> </h2>    
                    </div> 
                    
                </form>
            </div>

            <?php
        }

        public function options_fields(){
            $archive_title  = get_option('pdfev_archive_title'); 
            $archive_slug  = get_option('pdfev_archive_slug')??'pdf-embed-viewer'; 
            $template = get_option('pdfev_archive_template');
            $template_lists =  get_option('pdfev_archive_template_lists');

            $archive_read =  get_option('pdfev_archive_read');
            $archive_read = $archive_read ? $archive_read : 'no';
            
            $archive_download =  get_option('pdfev_archive_download');
            $archive_download = $archive_download ? $archive_download : 'no';

            $colors         = get_option('pdfev_css_colors');         
            $primary        = $colors['primary'] ? $colors['primary']:'#c79f62';
            $secondary      = $colors['secondary']?$colors['secondary']:'#666666';
            $dark           = $colors['dark']?$colors['dark']:'#333333';
            $light          = $colors['light']?$colors['light']:'#e5e5e5';

            ?>
                <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Archive Title','pdf-embed-viewer') ?></th>
                        <td>
                            <input type="text" name="pdfev_archive_title" placeholder="Pdf Embed Viewer" value="<?php echo esc_attr($archive_title); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Archive Slug', 'pdf-embed-viewer' )?></th>
                        <td>
                            <input type="text" name="pdfev_archive_slug" placeholder="pdf-embed-viewer" value="<?php echo esc_attr($archive_slug); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Archive Template', 'pdf-embed-viewer' )?></th>
                        <td>
                            <select name="pdfev_archive_template">
                                <?php foreach($template_lists as $key => $value): ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo $key==$template? esc_attr('selected'):'' ?>><?php echo esc_attr($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Show Read Button', 'pdf-embed-viewer' )?></th>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="pdfev_archive_read" value="<?php echo esc_attr($archive_read); ?>" <?php echo esc_attr(($archive_read=='yes')?'checked':''); ?>>
                                <span class="slider"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Show Download Button', 'pdf-embed-viewer' )?></th>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="pdfev_archive_download" value="<?php echo esc_attr($archive_download); ?>" <?php echo esc_attr(($archive_download=='yes')?'checked':''); ?>>
                                <span class="slider"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text" name="pdfev_css_colors[primary]" value="<?php echo esc_attr($primary); ?>">     
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Secondary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text"  name="pdfev_css_colors[secondary]"  value="<?php echo esc_attr($secondary); ?>">         
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Dark Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input  class="color-field" type="text"  name="pdfev_css_colors[dark]" value="<?php echo esc_attr($dark); ?>">
                                
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Light Color','pdf-embed-viewer') ?></th>
                        <td> <input class="color-field" type="text"  name="pdfev_css_colors[light]" value="<?php echo esc_attr($light); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Import Demo Content','pdf-embed-viewer') ?></th>
                        <td> 
                            <input type="button" class="button-primary"  id="import-demo-content" value="<?php _e('Import Demo','pdf-embed-viewer') ?>">
                            
                        </td>
                    </tr>
                    <tr>
                        <td id="response-container" colspan="2" style="color: green;"></td>
                    </tr>
                </tbody>
                </table>

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