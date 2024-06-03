<?php


if( ! class_exists('PDF_Emd_Vwr_Admin_Settings') ){
    class PDF_Emd_Vwr_Admin_Settings{
        
        public function __construct() {
            
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'admin_init', array($this,'save_options_data') ); 
            add_filter( 'plugin_action_links_pdf-embed-viewer/pdf-embed-viewer.php',[$this,'add_settings_link']);
        }

        public function create_admin_menu(){
            // add_menu_page(
            //     __('PDF Embed - Viewer','pdf-embed-viewer'),
            //     __('PDF Embed','pdf-embed-viewer'),
            //     'manage_options',
            //     'pdf-embed-viewer-index',
            //     array($this,'settings_index_page'),
            //     PDF_Emd_Vwr_URL.'assets/images/pdf-embed-viewer-icon.png',
            //     5
            // );
            add_submenu_page(
                'edit.php?post_type=pdf-embed-viewer',
                __('PDF Embed - Viewer','pdf-embed-viewer'),
                __('Settings','pdf-embed-viewer'),
                'manage_options',
                'index', // page url 
                array($this,'settings_index_page'),
            ); 
        }

        public function add_settings_link($links){
            $url = esc_url( add_query_arg( array( 'post_type' => 'pdf-embed-viewer', 'page' => 'index', ), get_admin_url() . 'edit.php' ) );
            
            $settings_link = "<a href='$url'>" . __( 'Settings','pdf-embed-viewer') . '</a>';
            // Adds the link to the end of the array.
            array_push(
                $links,
                $settings_link
            );
            return $links;
        }
        public function settings_index_page(){
            if( isset( $_POST['pdf_emd_vwr_options_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['pdf_emd_vwr_options_nonce'], 'pdf_emd_vwr_options_nonce' ) ){
                    return;
                }
                if( ! current_user_can('manage_options')){
                    return;
                }
                add_settings_error('pdf_emd_vwr_options_nonce','89',__('Settings Saved!'),'success');
                settings_errors('pdf_emd_vwr_options_nonce');
                
            }
            $this->settings_html_layout();
        
        }

        public function settings_html_layout(){
            ?>
            <div class="wrap admin-wrap pdf-embed-viewer">
                <h2><?php get_admin_page_title(); ?></h2>
                <h2 class="nav-tab-wrapper">
                    <button class="nav-tab nav-tab-active" data-tab-target="#pdf_emd_vwr_admin_tabs1"> <?php echo esc_html__('Settings','pdf-embed-viewer'); ?> </a>
                    <button class="nav-tab" data-tab-target="#pdf_emd_vwr_admin_tabs2"> <?php echo esc_html__('Support','pdf-embed-viewer'); ?> </a>
                </h2>
                <form action="" method="post">
                    <?php wp_nonce_field( 'pdf_emd_vwr_options_nonce', 'pdf_emd_vwr_options_nonce' ); ?>
                    <div class="tab-content active" id="pdf_emd_vwr_admin_tabs1">
                        <?php $this->options_fields(); ?>
                        <?php submit_button('Save'); ?>
                    </div> 
                    <div class="tab-content" id="pdf_emd_vwr_admin_tabs2">
                        <p><?php esc_html_e('For Support send email to','pdf-embed-viewer'); ?> <a href="mailto:raselsha@gmail.com"><?php esc_html_e('raselsha@gmail.com'); ?></a> </p>    
                    </div> 
                    
                </form>
            </div>

            <?php
        }

        public function options_fields(){
            $archive_title  = get_option('pdf_emd_vwr_opt_archive_title'); 
            
            $template = get_option('pdf_emd_vwr_opt_archive_template');
            $template = $template ? $template : 'list';
            $options_template =  get_option('pdf_emd_vwr_opt_template_lists');

            $archive_download =  get_option('pdf_emd_vwr_opt_archive_download');
            $archive_download = $archive_download ? $archive_download : 'no';

            $colors         = get_option('pdf_emd_vwr_opt_colors');         
            $primary        = $colors['primary'] ? $colors['primary'] : '#c79f62';
            $secondary      = $colors['secondary'] ? $colors['secondary'] : '#666';
            $dark           = $colors['dark'] ? $colors['dark'] : '#333';
            $light          = $colors['light'] ? $colors['light'] : '#e5e5e5';

            ?>
                <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Archive Title','pdf-embed-viewer') ?></th>
                        <td>
                            
                            <input type="text" name="pdf_emd_vwr_opt_archive_title" placeholder="Pdf Embed Viewer" value="<?php echo esc_attr($archive_title); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Archive Template', 'pdf-embed-viewer' )?></th>
                        <td>
                            <select name="pdf_emd_vwr_opt_archive_template">
                                <?php foreach($options_template as $key => $value): ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo $key==$template? esc_attr('selected'):'' ?>><?php echo esc_attr($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html__( 'Download Button', 'pdf-embed-viewer' )?></th>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="pdf_emd_vwr_opt_archive_download" value="<?php echo esc_attr($archive_download); ?>" <?php echo esc_attr(($archive_download=='yes')?'checked':''); ?>>
                                <span class="slider"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text" name="pdf_emd_vwr_opt_colors[primary]" value="<?php echo esc_attr($primary); ?>">     
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Secondary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text"  name="pdf_emd_vwr_opt_colors[secondary]"  value="<?php echo esc_attr($secondary); ?>">         
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Dark Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input  class="color-field" type="text"  name="pdf_emd_vwr_opt_colors[dark]" value="<?php echo esc_attr($dark); ?>">
                                
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Light Color','pdf-embed-viewer') ?></th>
                        <td> <input class="color-field" type="text"  name="pdf_emd_vwr_opt_colors[light]" value="<?php echo esc_attr($light); ?>"></td>
                    </tr>
                </tbody>
                </table>

            <?php
        }


        public function save_options_data() {


            if( isset( $_POST['pdf_emd_vwr_options_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['pdf_emd_vwr_options_nonce'], 'pdf_emd_vwr_options_nonce' ) ){
                    return;
                }
                
                $archive_title      = isset( $_POST['pdf_emd_vwr_opt_archive_title'] ) ? $_POST['pdf_emd_vwr_opt_archive_title']: 'Pdf Embed Viewer';
                $archive_template   = isset( $_POST['pdf_emd_vwr_opt_archive_template'] ) ? $_POST['pdf_emd_vwr_opt_archive_template']: 'list';
                $archive_download   = isset( $_POST['pdf_emd_vwr_opt_archive_download'] ) ? $_POST['pdf_emd_vwr_opt_archive_download']: 'no';
                $primary            = isset( $_POST['pdf_emd_vwr_opt_colors']['primary'] ) ? $_POST['pdf_emd_vwr_opt_colors']['primary'] : '#c79f62' ;
                $secondary          = isset( $_POST['pdf_emd_vwr_opt_colors']['secondary'] )? $_POST['pdf_emd_vwr_opt_colors']['secondary']: '#666';
                $dark               = isset( $_POST['pdf_emd_vwr_opt_colors']['dark'] ) ? $_POST['pdf_emd_vwr_opt_colors']['dark']: '#333';
                $light              = isset( $_POST['pdf_emd_vwr_opt_colors']['light'] ) ? $_POST['pdf_emd_vwr_opt_colors']['light']: '#e5e5e5';

                $colors = [
                    'primary'   => sanitize_text_field( $primary ),
                    'secondary' => sanitize_text_field( $secondary ),
                    'dark'      => sanitize_text_field( $dark ),
                    'light'     => sanitize_text_field( $light ),
                ];

                update_option('pdf_emd_vwr_opt_archive_title',sanitize_text_field($archive_title));
                update_option('pdf_emd_vwr_opt_archive_template',sanitize_text_field($archive_template));
                update_option('pdf_emd_vwr_opt_archive_download',sanitize_text_field($archive_download));
                update_option('pdf_emd_vwr_opt_colors',$colors );

            }
        }
    }
    
    $PDF_Emd_Vwr_Admin_Settings = new PDF_Emd_Vwr_Admin_Settings();
}