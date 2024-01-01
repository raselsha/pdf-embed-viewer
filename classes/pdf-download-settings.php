<?php


if( ! class_exists('PDF_Download_Settings') ){
    class PDF_Download_Settings{
        public static $options;
        public function __construct() {
            self::$options = get_option('pdf_download_option');
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'admin_init', array($this,'create_sttings_form') );
            
        }

        public function create_admin_menu(){
            add_menu_page(
                __('PDF Download Settings',TEXTDOMAIN),
                __('PDF Download',TEXTDOMAIN),
                'manage_options',
                'pdfdownload-index',
                array($this,'pdfdownload_settings_page'),
                PDF_DOWNLOAD_URL.'assets/images/pdf-download-icon.png',
                5
            );
            add_submenu_page(
                'pdfdownload-index',
                __('PDF Download Settings',TEXTDOMAIN),
                __('Dashboard',TEXTDOMAIN),
                'manage_options',
                'pdfdownload-index',
                array($this,'pdfdownload_settings_page'),
            );
            add_submenu_page(
                'pdfdownload-index',
                __('All PDF',TEXTDOMAIN),
                __('All PDF',TEXTDOMAIN),
                'manage_options',
                'edit.php?post_type=pdfdownload',
                null,
            );
            add_submenu_page(
                'pdfdownload-index',
                __('New PDF',TEXTDOMAIN),
                __('New PDF',TEXTDOMAIN),
                'manage_options',
                'post-new.php?post_type=pdfdownload',
                null,
            );
            

        }

        public function pdfdownload_settings_page(){
            if( ! current_user_can('manage_options')){
                return;
            }
            if( isset($_GET['settings-updated']) ){
                add_settings_error('pdf_download_option','','Settings Saved!','success');
            }
            settings_errors('pdf_download_option');
            require_once PDF_DOWNLOAD_PATH . '/views/pdf-download-settings.php';
        }

        public function create_sttings_form(){
            
            register_setting('pdfdownload_group','pdf_download_option',array($this,'sanitize'));

            
// ============tab 1 here======
            add_settings_section(
                'page1_main_section',
                __('Title Settings',TEXTDOMAIN),
                array($this,'page1_main_section'),
                'page1'
            );

            add_settings_field(
                'archive_title',
                __('Title',TEXTDOMAIN),
                array($this,'add_archive_title'),
                'page1',
                'page1_main_section'
            );

            add_settings_section(
                'page1_second_section',
                __('Color Settings',TEXTDOMAIN),
                array($this,'page1_second_section'),
                'page1'
            );

            add_settings_field(
                'primary_color',
                __('Primary Color',TEXTDOMAIN),
                array($this,'add_primary_color'),
                'page1',
                'page1_second_section'
            );
            add_settings_field(
                'secondary_color',
                __('Secondary Color',TEXTDOMAIN),
                array($this,'add_secondary_color'),
                'page1',
                'page1_second_section'
            );

            add_settings_field(
                'light_color',
                __('Light Color',TEXTDOMAIN),
                array($this,'add_light_color'),
                'page1',
                'page1_second_section'
            );

            add_settings_field(
                'dark_color',
                __('Dark Color',TEXTDOMAIN),
                array($this,'add_dark_color'),
                'page1',
                'page1_second_section'
            );
// ==============tab 2==============

            add_settings_section(
                'page2_main_section',
                __('Support',TEXTDOMAIN),
                array($this,'page2_main_section'),
                'page2'
            );

        }
        public function page1_main_section(){
            ?>
            <p><?php _e('You can modify <b>Archive Title</b> here. It will display top of your archive page.',TEXTDOMAIN); ?></p>
            <?php
        }
        public function page1_second_section(){
            ?>
            <p><?php _e('You can modify <b> Color</b> from here to adjust color with your theme.',TEXTDOMAIN); ?></p>
            <?php
        }
        public function page2_main_section(){
            ?>
            <p><?php _e('For contact support send email to <a href="mailto:raselsha@gmail.com">raselsha@gmail.com</a>',TEXTDOMAIN); ?></p>
            <?php
        }
        public function add_archive_title(){
            ?>
            <input 
            type="text" 
            name="pdf_download_option[archive_title]" 
            placeholder="Newsletter"
            value="<?php echo (isset(self::$options['archive_title']) and self::$options['archive_title']!='' ) ? esc_attr(self::$options['archive_title']) : ''; ?>">
            <?php
        }
        public function add_primary_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="pdf_download_option[primary_color]" 
            value="<?php echo (isset(self::$options['primary_color']) and self::$options['primary_color']!='')  ? esc_attr(self::$options['primary_color']) : esc_attr('#c79f62'); ?>">
            <?php
        }
        public function add_secondary_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="pdf_download_option[secondary_color]" 
            value="<?php echo (isset(self::$options['secondary_color']) and self::$options['secondary_color']!='') ? esc_attr(self::$options['secondary_color']) : esc_attr('#666'); ?>">
            <?php
        }
        
        public function add_dark_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="pdf_download_option[dark_color]" 
            value="<?php echo (isset(self::$options['dark_color']) and self::$options['dark_color']!='') ? esc_attr(self::$options['dark_color']) : esc_attr('#333'); ?>">
            <?php
        }

        public function add_light_color(){
            ?>
            <input 
            class="color-field"
            type="text" 
            name="pdf_download_option[light_color]" 
            value="<?php echo (isset(self::$options['light_color']) and self::$options['light_color']!='') ? esc_attr(self::$options['light_color']) : esc_attr('#e5e5e5'); ?>">
            <?php
        }

        public function sanitize( $input ) {
            $new_input = array();
            foreach($input as $key => $value){
                $new_input[$key] = sanitize_text_field($value);
            }
            return $new_input;
        
        }
    }
}