<?php


if( ! class_exists('SH_PDF_Embed_Viewer_Admin_Settings') ){
    class SH_PDF_Embed_Viewer_Admin_Settings{
        
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
            //     SH_PDF_EMBED_VIEWER_URL.'assets/images/pdf-embed-viewer-icon.png',
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
                add_settings_error('sh_pdf_embed_options','','Settings Saved!','success');
            }
            settings_errors('sh_pdf_embed_options');
            
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
                    <?php wp_nonce_field( 'sh_pdf_embed_options_nonce', 'sh_pdf_embed_options_nonce' ); ?>
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
            $options =  get_option('sh_pdf_embed_options');
           print_r( $options);

           
            $archive_title = isset($options['archive_title']) ? $options['archive_title']:'';
            $primary = $options['colors']['primary'] ? $options['colors']['primary']:'#333';
            $secondary = $options['colors']['secondary'] ? $options['colors']['secondary']:'#666666';
            $dark = $options['colors']['dark'] ? $options['colors']['dark']:'#333';
            $light = $options['colors']['light'] ? $options['colors']['light']:'#e5e5e5';
            
            ?>
                <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">Archive Title</th>
                        <td>
                            
                            <input type="text" name="sh_pdf_embed_options[archive_title]" placeholder="Newsletter" value="<?php echo esc_attr($archive_title); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Primary Color</th>
                        <td>
                            <input class="color-field" type="text" name="sh_pdf_embed_options['colors']['primary']" value="<?php echo esc_attr($primary); ?>">     
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Secondary Color</th>
                        <td>
                            <input class="color-field" type="text"  name="sh_pdf_embed_options['colors']['secondary']"  value="<?php echo esc_attr($secondary); ?>">         
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Dark Color</th>
                        <td>
                            <input  class="color-field" type="text"  name="sh_pdf_embed_options['colors']['dark']" value="<?php echo esc_attr($dark); ?>">
                                
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Light Color</th>
                        <td> <input class="color-field" type="text"  name="sh_pdf_embed_options['colors']['light']" value="<?php echo esc_attr($light); ?>"></td>
                    </tr>
                </tbody>
                </table>

            <?php
        }


        public function save_options_data() {


            if( isset( $_POST['sh_pdf_embed_options_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['sh_pdf_embed_options_nonce'], 'sh_pdf_embed_options_nonce' ) ){
                    return;
                }
                
                $options =  get_option('sh_pdf_embed_options');
                $archive_title = isset($_POST['sh_pdf_embed_options']['archive_title']) ? $_POST['sh_pdf_embed_options']['archive_title']: $options['archive_title'];
                // $primary = $_POST['sh_pdf_embed_options']['colors']['primary'] ? $_POST['sh_pdf_embed_options']['colors']['primary'] : $options['colors']['primary'] ;
                // $secondary = $_POST['sh_pdf_embed_options']['colors']['secondary']? $_POST['sh_pdf_embed_options']['colors']['secondary']:$options['colors']['secondary'];
                // $dark = $_POST['sh_pdf_embed_options']['colors']['dark'] ? $_POST['sh_pdf_embed_options']['colors']['dark']:$options['colors']['dark'];
                // $light = $_POST['sh_pdf_embed_options']['colors']['light'] ? $_POST['sh_pdf_embed_options']['colors']['light']:$options['colors']['light'];


                update_option('sh_pdf_embed_options',[
                    'archive_title'=>'otoe',
                    // 'colors'=>[
                    //     'primary'=>sanitize_text_field( $primary ),
                    //     'secondary'=>sanitize_text_field( $secondary ),
                    //     'light'=>sanitize_text_field( $dark ),
                    //     'dark'=>sanitize_text_field( $light ),
                    // ],
                    
                ]);
              
            }
                   
        }
    }
    
    $SH_PDF_Embed_Viewer_Admin_Settings = new SH_PDF_Embed_Viewer_Admin_Settings();
}