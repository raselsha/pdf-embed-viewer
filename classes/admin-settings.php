<?php


if( ! class_exists('SH_PDF_Embed_Viewer_Admin_Settings') ){
    class SH_PDF_Embed_Viewer_Admin_Settings{
        public static $options;
        public function __construct() {
            self::$options = get_option('sh_pdf_embed_options');
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'admin_init', array($this,'create_sttings_form') );
            
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
                <form action="options.php" method="post">
                    <?php settings_fields('sh_pdf_embed_opt_group'); ?>
                    <?php if($active_tab=='settings'): ?>
                        <input type="text">
                        <?php do_settings_sections('page1'); ?>
                        <?php submit_button('Save'); ?>
                    <?php else: ?> 
                        <?php do_settings_sections('page2'); ?>  
                        
                    <?php endif; ?>    
                    
                </form>
            </div>

            <?php
        }
        public function create_sttings_form(){
            
            register_setting('sh_pdf_embed_opt_group','sh_pdf_embed_options',[$this,'sanitize']);

            
// ============tab 1 here======
            add_settings_section(
                'page1_main_section',
                __('Title Settings','pdf-embed-viewer'),
                [$this,'page1_main_section'],
                'page1'
            );

            add_settings_field(
                'archive_title',
                __('Title','pdf-embed-viewer'),
                [$this,'add_archive_title'],
                'page1',
                'page1_main_section'
            );

            add_settings_section(
                'page1_second_section',
                __('Color Settings','pdf-embed-viewer'),
                array($this,'page1_second_section'),
                'page1'
            );

            add_settings_field(
                'primary_color',
                __('Primary Color','pdf-embed-viewer'),
                array($this,'add_primary_color'),
                'page1',
                'page1_second_section'
            );
            add_settings_field(
                'secondary_color',
                __('Secondary Color','pdf-embed-viewer'),
                array($this,'add_secondary_color'),
                'page1',
                'page1_second_section'
            );

            add_settings_field(
                'light_color',
                __('Light Color','pdf-embed-viewer'),
                array($this,'add_light_color'),
                'page1',
                'page1_second_section'
            );

            add_settings_field(
                'dark_color',
                __('Dark Color','pdf-embed-viewer'),
                array($this,'add_dark_color'),
                'page1',
                'page1_second_section'
            );
// ==============tab 2==============

            add_settings_section(
                'page2_main_section',
                __('Support','pdf-embed-viewer'),
                array($this,'page2_main_section'),
                'page2'
            );

        }
        public function page1_main_section(){
            ?>
            <p><?php _e('You can modify <b>Archive Title</b> here. It will display top of your archive page.','pdf-embed-viewer'); ?></p>
            <?php
        }
        public function page1_second_section(){
            ?>
            <p><?php _e('You can modify <b> Color</b> from here to adjust color with your theme.','pdf-embed-viewer'); ?></p>
            <?php
        }
        public function page2_main_section(){
            ?>
            <p><?php _e('For contact support send email to <a href="mailto:raselsha@gmail.com">raselsha@gmail.com</a>','pdf-embed-viewer'); ?></p>
            <?php
        }
        public function add_archive_title(){
            ?>
            <input 
            type="text" 
            name="sh_pdf_embed_options[archive_title]" 
            placeholder="Newsletter"
            value="<?php echo esc_attr(self::$options['archive_title'] ? self::$options['archive_title'] : ''); ?>">
            <?php
        }
        public function add_primary_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="sh_pdf_embed_options['colors']['primary']" 
            value="<?php echo esc_attr(self::$options['colors']['primary'] ? self::$options['colors']['primary'] : '#c79f62'); ?>">
            <?php
        }
        public function add_secondary_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="sh_pdf_embed_options['colors']['secondary']" 
            value="<?php echo esc_attr(self::$options['colors']['secondary']? self::$options['colors']['secondary'] :'#666'); ?>">
            <?php
        }
        
        public function add_dark_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="sh_pdf_embed_options['colors']['dark']" 
            value="<?php echo esc_attr(self::$options['colors']['dark'] ? self::$options['colors']['dark'] : '#333'); ?>">
            <?php
        }

        public function add_light_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="sh_pdf_embed_options['colors']['light']" 
            value="<?php echo esc_attr(self::$options['colors']['light'] ? self::$options['colors']['light']: '#e5e5e5'); ?>">
            <?php
        }

        public function sanitize( $input ) {
            $new_input['colors'] = array();
            $input= $input['colors'];
            foreach($input as $key => $value){
                $new_input['colors'][$key] = sanitize_text_field($value);
            }
            return $new_input;
        
        }
    }
    
    $SH_PDF_Embed_Viewer_Admin_Settings = new SH_PDF_Embed_Viewer_Admin_Settings();
}