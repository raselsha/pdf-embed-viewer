<?php
/**
 * @author shahadat hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.0
 */
if(! defined('ABSPATH') )die;

if( ! class_exists('PDFEV_Settings_Support') ){
    class PDFEV_Settings_Support{
        public function __construct() {
            add_action('pdfev_settings_tabs',array($this,'tabs'));
            add_action('pdfev_settings_tabs_content',array($this,'tabs_content'));
        }
        public function tabs(){
        ?>
            <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_support"> <?php echo esc_html__('Support','pdf-embed-viewer'); ?> </button>
        <?php
        }
        public function tabs_content(){
        ?>
            <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_support">
                <h2><?php esc_html_e('Give a review for your feedback','pdf-embed-viewer'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/pdf-embed-viewer/reviews/'); ?>"><?php esc_html_e('Add Review','pdf-embed-viewer'); ?></a> </h2>    
                <h2><?php esc_html_e('Create a support ticket','pdf-embed-viewer'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/pdf-embed-viewer/'); ?>"><?php esc_html_e('support','pdf-embed-viewer'); ?></a> </h2>    
                <h2><?php esc_html_e('Send email','pdf-embed-viewer'); ?> <a href="<?php echo esc_url('mailto:raselsha@gmail.com'); ?>"><?php esc_html_e('raselsha@gmail.com','pdf-embed-viewer'); ?></a> </h2>    
            </div> 
        <?php
        }
    }
    new PDFEV_Settings_Support();
}