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
            add_action('wp_ajax_pdfev_shortcode_generate', array($this,'shortcode_generate')); 
        }
        public function tabs(){
            ?>
            <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_shortcode"> <?php echo esc_html__('Shortcode','pdf-embed-viewer'); ?> </button>
            <?php
        }
        public function tabs_content(){
            ?>
            <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_shortcode">
                <div class="pdfev-shortcode-generaor">
                    <div class="shortcode-sidebar">
                        <h2><?php echo esc_html__('Shortcode Generator','pdf-embed-viewer') ?></h2>

                        <div class="form-group">
                            <label for="template">Template</label>
                            <select id="template">
                                <option value="list">list</option>
                                <option value="grid">grid</option>
                                <option value="ebook">ebook</option>
                                <option value="newsletter">newsletter</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="limit">Limit</label>
                            <input type="number" id="limit" value="10" min="1">
                        </div>

                        <div class="form-group">
                            <label for="order">Order</label>
                            <select id="order">
                                <option value="dsc">dsc</option>
                                <option value="asc">asc</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="read">Read Button</label>
                            <select id="read">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="download">Download Button</label>
                            <select id="download">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reading_count">Reading Count</label>
                            <select id="reading_count">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="downloading_count">Downloading Count</label>
                            <select id="downloading_count">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        <button id="pdfev-shortcode-generate"><?php echo esc_html__('Generate Shortcode','pdf-embed-viewer'); ?></button>
                        <button id="pdfev-shortcode-reset" type="button"><?php echo esc_html__('Reset','pdf-embed-viewer'); ?></button>
                        
                    </div>
                    <div class="shortcode-previewer">
                        <h2><?php echo esc_html__('ShortCode','pdf-embed-viewer'); ?></h2>
                        <div id="pdfev-shortcode" class="pdfev-shortcode">[pdfev_viewer template="list" limit="10" order="dsc" read="yes" download="yes" reading_count="yes" downloading_count="yes"]</div>
                        <!-- <div id="shortcode-previewer"></div> -->
                        <button id="pdfev-copy-shortcode"><?php echo esc_html__('Copy','pdf-embed-viewer'); ?></button>
                    </div>
                </div>
            </div> 
            <?php
        }
        public function shortcode_generate(){
            check_ajax_referer('pdf_ajax_nonce', 'ajaxnonce');
            $template = isset($_POST['template']) ? sanitize_text_field($_POST['template']) : '';
            $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
            $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : '';
            $read = isset($_POST['read']) ? sanitize_text_field($_POST['read']) : '';
            $download = isset($_POST['download']) ? sanitize_text_field($_POST['download']) : '';
            $reading_count = isset($_POST['reading_count']) ? sanitize_text_field($_POST['reading_count']) : '';
            $downloading_count = isset($_POST['downloading_count']) ? sanitize_text_field($_POST['downloading_count']) : '';

            $shortcode = sprintf(
                '[pdfev_viewer template="%s" limit="%d" order="%s" read="%s" download="%s" reading_count="%s" downloading_count="%s"]',
                $template, $limit, $order, $read, $download, $reading_count, $downloading_count
            );
            
            
            ob_start();
            // echo $shortcode;
            $html = ob_get_clean();
            
            wp_send_json_success([
                'html' => $html,
                'shortcode' => $shortcode,
            ]);
            wp_die();
        }
    }
    new PDFEV_Settings_Shortcode();
}