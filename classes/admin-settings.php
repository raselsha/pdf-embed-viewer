<?php


if( ! class_exists('PDF_Emd_Vwr_Admin_Settings') ){
    class PDF_Emd_Vwr_Admin_Settings{
        
        public function __construct() {
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'admin_init', array($this,'save_options_data') );            
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

        public function settings_index_page(){
            if( ! current_user_can('manage_options')){
                return;
            }
            if( isset($_GET['settings-updated']) ){
                add_settings_error('pdf_emd_vwr_options','','Settings Saved!','success');
            }
            settings_errors('pdf_emd_vwr_options');
            
            $this->settings_html_layout();
        }

        public function settings_html_layout(){
            ?>
            <div class="wrap">
                <h2><?php esc_html_e(get_admin_page_title()); ?></h2>
                <h2 class="nav-tab-wrapper">
                    <?php
                        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'settings' ;
                    ?>
                    <a href="?post_type=pdf-embed-viewer&page=index&tab=settings" class="nav-tab <?php esc_attr_e(($active_tab=='settings') ? 'nav-tab-active' : '' ); ?>"> <?php _e('Settings','pdf-embed-viewer'); ?> </a>
                    <a href="?post_type=pdf-embed-viewer&page=index&tab=support" class="nav-tab <?php esc_attr_e(($active_tab=='support') ? 'nav-tab-active' : '' ); ?>"> <?php _e('Support','pdf-embed-viewer'); ?> </a>
                </h2>
                <form action="" method="post">
                    <?php wp_nonce_field( 'pdf_emd_vwr_options_nonce', 'pdf_emd_vwr_options_nonce' ); ?>
                    <?php if($active_tab=='settings'): ?>
                        <?php $this->options_fields(); ?>
                        <?php submit_button('Save'); ?>
                    <?php else: ?> 
                        <?php echo 'test'; ?>                        
                    <?php endif; ?>    
                    
                </form>
            </div>

            <?php
        }

        public function options_fields(){
            $options =  get_option('pdf_emd_vwr_options');         
            $archive_title  = isset($options['archive_title']) ? $options['archive_title']:'Newsletter';
            $primary        = isset($options['colors']['primary'] ) ? $options['colors']['primary']:'#c79f62';
            $secondary      = isset($options['colors']['secondary'] )? $options['colors']['secondary']:'#666';
            $dark           = isset($options['colors']['dark'] ) ? $options['colors']['dark']:'#333';
            $light          = isset($options['colors']['light'] ) ? $options['colors']['light']:'#e5e5e5';
            
            ?>
                <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><?php _e('Archive Title','pdf-embed-viewer') ?></th>
                        <td>
                            
                            <input type="text" name="pdf_emd_vwr_options[archive_title]" placeholder="Newsletter" value="<?php echo esc_attr($archive_title); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Primary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text" name="pdf_emd_vwr_options[colors][primary]" value="<?php echo esc_attr($primary); ?>">     
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Secondary Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input class="color-field" type="text"  name="pdf_emd_vwr_options[colors][secondary]"  value="<?php echo esc_attr($secondary); ?>">         
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Dark Color','pdf-embed-viewer') ?></th>
                        <td>
                            <input  class="color-field" type="text"  name="pdf_emd_vwr_options[colors][dark]" value="<?php echo esc_attr($dark); ?>">
                                
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Light Color','pdf-embed-viewer') ?></th>
                        <td> <input class="color-field" type="text"  name="pdf_emd_vwr_options[colors][light]" value="<?php echo esc_attr($light); ?>"></td>
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
                
    
                $archive_title = isset($_POST['pdf_emd_vwr_options']['archive_title']) ? $_POST['pdf_emd_vwr_options']['archive_title']: 'Newsletter';
                $primary = $_POST['pdf_emd_vwr_options']['colors']['primary'] ? $_POST['pdf_emd_vwr_options']['colors']['primary'] : '#c79f62' ;
                $secondary = $_POST['pdf_emd_vwr_options']['colors']['secondary']? $_POST['pdf_emd_vwr_options']['colors']['secondary']:'#666';
                $dark = $_POST['pdf_emd_vwr_options']['colors']['dark'] ? $_POST['pdf_emd_vwr_options']['colors']['dark']:'#333';
                $light = $_POST['pdf_emd_vwr_options']['colors']['light'] ? $_POST['pdf_emd_vwr_options']['colors']['light']:'#e5e5e5';


                update_option('pdf_emd_vwr_options',[
                    'archive_title'=>sanitize_text_field($archive_title),
                    'colors'=>[
                        'primary'=>sanitize_text_field( $primary ),
                        'secondary'=>sanitize_text_field( $secondary ),
                        'dark'=>sanitize_text_field( $dark ),
                        'light'=>sanitize_text_field( $light ),
                    ],    
                ]);
              
            }
                   
        }
    }
    
    $PDF_Emd_Vwr_Admin_Settings = new PDF_Emd_Vwr_Admin_Settings();
}