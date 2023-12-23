<?php


if( ! class_exists('Newsletter_Publisher_Settings') ){
    class Newsletter_Publisher_Settings{
        public static $options;
        public function __construct() {
            self::$options = get_option('newsletter_publisher_option');
            add_action( 'admin_menu', array($this,'create_admin_menu') );
            add_action( 'admin_init', array($this,'admin_init') );
            
        }

        public function create_admin_menu(){
            add_menu_page(
                __('Newsletter Settings',TEXTDOMAIN),
                __('Newsletter',TEXTDOMAIN),
                'manage_options',
                'newsletter-index',
                array($this,'newsletter_settings_page'),
                NEWSLETTER_PUB_URL.'assets/images/newsletter-icon.png',
                5
            );
            add_submenu_page(
                'newsletter-index',
                __('Newsletter Settings',TEXTDOMAIN),
                __('Dashboard',TEXTDOMAIN),
                'manage_options',
                'newsletter-index',
                array($this,'newsletter_settings_page'),
            );
            add_submenu_page(
                'newsletter-index',
                __('All Newsletter',TEXTDOMAIN),
                __('All Newsletter',TEXTDOMAIN),
                'manage_options',
                'edit.php?post_type=newsletter',
                null,
            );
            add_submenu_page(
                'newsletter-index',
                __('Add Newsletter',TEXTDOMAIN),
                __('Add Newsletter',TEXTDOMAIN),
                'manage_options',
                'post-new.php?post_type=newsletter',
                null,
            );
            

        }

        public function newsletter_settings_page(){
            require_once NEWSLETTER_PUB_PATH . '/views/view.settings-page.php';
        }

        public function admin_init(){
            
            register_setting('newsletter_publisher_group','newsletter_publisher_option',array($this,'sanitize'));

            add_settings_section(
                'main_secton',
                __('Basic Instruction',TEXTDOMAIN),
                array($this,'main_secton'),
                'page1'
            );

            add_settings_section(
                'main_secton',
                __('Color Settings',TEXTDOMAIN),
                null,
                'page2'
            );

            add_settings_field(
                'primary_color',
                __('Primary Color',TEXTDOMAIN),
                array($this,'add_primary_color'),
                'page2',
                'main_secton'
            );

            add_settings_field(
                'secondary_color',
                __('Secondary Color',TEXTDOMAIN),
                array($this,'add_secondary_color'),
                'page2',
                'main_secton'
            );

            add_settings_field(
                'light_color',
                __('Light Color',TEXTDOMAIN),
                array($this,'add_light_color'),
                'page2',
                'main_secton'
            );

            add_settings_field(
                'dark_color',
                __('Dark Color',TEXTDOMAIN),
                array($this,'add_dark_color'),
                'page2',
                'main_secton'
            );
        }
        public function main_secton(){
            ?>
            <p><?php _e('You can adjust color with your theme by adding hexa decimal value in <b>color settings</b> section.',TEXTDOMAIN); ?></p>
            <?php
        }
        public function add_primary_color(){
            ?>
            <input 
            type="text" 
            name="newsletter_publisher_option[primary_color]" 
            value="<?php echo (isset(self::$options['primary_color']) and self::$options['primary_color']!='')  ? esc_attr(self::$options['primary_color']) : esc_attr('#c79f62'); ?>">
            <?php
        }
        public function add_secondary_color(){
            ?>
            <input 
            type="text" 
            name="newsletter_publisher_option[secondary_color]" 
            value="<?php echo (isset(self::$options['secondary_color']) and self::$options['secondary_color']!='') ? esc_attr(self::$options['secondary_color']) : esc_attr('#666'); ?>">
            <?php
        }
        public function add_light_color(){
            ?>
            <input 
            type="text" 
            name="newsletter_publisher_option[light_color]" 
            value="<?php echo (isset(self::$options['light_color']) and self::$options['light_color']!='') ? esc_attr(self::$options['light_color']) : esc_attr('#e5e5e5'); ?>">
            <?php
        }
        public function add_dark_color(){
            ?>
            <input 
            type="text" 
            name="newsletter_publisher_option[dark_color]" 
            value="<?php echo (isset(self::$options['dark_color']) and self::$options['dark_color']!='') ? esc_attr(self::$options['dark_color']) : esc_attr('#333'); ?>">
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