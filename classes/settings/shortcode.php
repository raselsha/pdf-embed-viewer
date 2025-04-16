<?php
/**
 * @author shahadat hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.0
 */
if(! defined('ABSPATH') )die;

if( ! class_exists('PDFEV_Settings_Shortcode') ){
    class PDFEV_Settings_Shortcode{
        public function __construct() {
            add_action('pdfev_settings_tabs',array($this,'tabs'));
            add_action('pdfev_settings_tabs_content',array($this,'tabs_content'));
        }
        public function tabs(){
            ?>
            <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_shortcode"> <?php echo esc_html__('Shortcode','pdf-embed-viewer'); ?> </button>
            <?php
        }
        public function tabs_content(){
            ?>
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
            <?php
        }
    }
    new PDFEV_Settings_Shortcode();
}