<?php
/**
 * @author shahadat hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.0
 */

namespace PDFEV;

defined('ABSPATH') || exit;
class Shortcode_Generator {
    public function __construct() {
        add_action('pdfev_settings_tabs',array($this,'tabs'),20,0);
        add_action('pdfev_settings_tabs_content',array($this,'tabs_content'));
        add_action('wp_ajax_pdfev_shortcode_generate', array($this,'shortcode_generate')); 
    }
    public function tabs(){
        ?>
        <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_shortcode">
            <span class="dashicons dashicons-editor-code" aria-hidden="true"></span>
            <?php echo esc_html__('Shortcode','pdf-embed-viewer'); ?>
        </button>
        <?php
    }
    public function tabs_content(){
        $categories = get_terms( array(
            'taxonomy'   => 'pdfev_category',
            'hide_empty' => false, // false রাখলে empty category গুলোও পাবে
        ) );

        ?>
        <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_shortcode">
            <div class="pdfev-shortcode-generaor">
                <div class="shortcode-sidebar">
                    <div class="pdfev-section-header">
                        <h2><?php echo esc_html__('Shortcode Generator','pdf-embed-viewer') ?></h2>
                        <p><?php echo esc_html__('Configure the options below and copy the generated shortcode.','pdf-embed-viewer') ?></p>
                    </div>
                    <div class="pdfev-section-body">

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="template"><?php echo esc_html__('Template','pdf-embed-viewer'); ?></label>
                            <select id="template">
                                <option value="list"><?php echo esc_html__('list','pdf-embed-viewer'); ?></option>
                                <option value="grid"><?php echo esc_html__('grid','pdf-embed-viewer'); ?></option>
                                <option value="ebook"><?php echo esc_html__('ebook','pdf-embed-viewer'); ?></option>
                                <option value="newsletter"><?php echo esc_html__('newsletter','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Layout style used to display the PDFs.','pdf-embed-viewer'); ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="category"><?php echo esc_html__('Category','pdf-embed-viewer'); ?></label>
                            <select id="category">
                                <option value=""><?php echo esc_html__('Select Category','pdf-embed-viewer'); ?></option>
                                <?php foreach ( $categories as $category ) : ?>
                                <option value="<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Only show PDFs from this category. Leave blank to show all.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="limit"><?php echo esc_html__('Limit','pdf-embed-viewer'); ?></label>
                            <input type="number" id="limit" value="10" min="1">
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Maximum number of PDFs to display.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="order"><?php echo esc_html__('Order','pdf-embed-viewer'); ?></label>
                            <select id="order">
                                <option value="dsc"><?php echo esc_html__('dsc','pdf-embed-viewer'); ?></option>
                                <option value="asc"><?php echo esc_html__('asc','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Sort PDFs newest first (dsc) or oldest first (asc).','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="read"><?php echo esc_html__('Read Button','pdf-embed-viewer'); ?></label>
                            <select id="read">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Show a button to open and read the PDF.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="download"><?php echo esc_html__('Download Button','pdf-embed-viewer'); ?></label>
                            <select id="download">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Show a button to download the PDF file.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_description"><?php echo esc_html__('Show Description','pdf-embed-viewer'); ?></label>
                            <select id="show_description">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the document description.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_author"><?php echo esc_html__('Show Author','pdf-embed-viewer'); ?></label>
                            <select id="show_author">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the assigned author.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_publisher"><?php echo esc_html__('Show Publisher','pdf-embed-viewer'); ?></label>
                            <select id="show_publisher">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the assigned publisher.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_year"><?php echo esc_html__('Show Published Year','pdf-embed-viewer'); ?></label>
                            <select id="show_year">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the year the document was published.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_edition"><?php echo esc_html__('Show Published Edition','pdf-embed-viewer'); ?></label>
                            <select id="show_edition">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the edition or version of the document.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="reading_count"><?php echo esc_html__('Reading Count','pdf-embed-viewer'); ?></label>
                            <select id="reading_count">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display how many times each PDF has been viewed.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="downloading_count"><?php echo esc_html__('Downloading Count','pdf-embed-viewer'); ?></label>
                            <select id="downloading_count">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display how many times each PDF has been downloaded.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_total_pages"><?php echo esc_html__('Show Total Pages','pdf-embed-viewer'); ?></label>
                            <select id="show_total_pages">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the total number of pages.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group-row">
                            <label for="show_filesize"><?php echo esc_html__('Show Filesize','pdf-embed-viewer'); ?></label>
                            <select id="show_filesize">
                                <option value="yes"><?php echo esc_html__('yes','pdf-embed-viewer'); ?></option>
                                <option value="no"><?php echo esc_html__('no','pdf-embed-viewer'); ?></option>
                            </select>
                        </div>
                        <span class="form-group-desc"><?php echo esc_html__('Display the file size of the PDF.','pdf-embed-viewer') ?></span>
                    </div>

                    <div class="pdfev-shortcode-actions">
                        <button id="pdfev-shortcode-generate" class="pdfev-btn pdfev-btn-primary"><?php echo esc_html__('Generate Shortcode','pdf-embed-viewer'); ?></button>
                        <button id="pdfev-shortcode-reset" type="button" class="pdfev-btn pdfev-btn-ghost"><?php echo esc_html__('Reset','pdf-embed-viewer'); ?></button>
                    </div>
                    </div>
                </div>
                <div class="shortcode-previewer">
                    <div class="pdfev-section-header">
                        <h2><?php echo esc_html__('Shortcode','pdf-embed-viewer'); ?></h2>
                        <p><?php echo esc_html__('Paste this into any post, page, or widget.','pdf-embed-viewer') ?></p>
                    </div>
                    <div class="pdfev-section-body">
                    <div id="pdfev-shortcode" class="pdfev-shortcode">[pdfev_viewer template="list" category="" limit="10" order="dsc" read="yes" download="yes" reading_count="yes" downloading_count="yes" show_description="yes" show_author="yes" show_publisher="yes" show_year="yes" show_edition="yes" show_total_pages="yes" show_filesize="yes"]</div>
                    <button id="pdfev-copy-shortcode" class="pdfev-btn pdfev-btn-secondary">
                        <span class="dashicons dashicons-clipboard" aria-hidden="true"></span>
                        <span class="pdfev-btn-label"><?php echo esc_html__('Copy','pdf-embed-viewer'); ?></span>
                    </button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
    }
    public function shortcode_generate(){
        check_ajax_referer('pdf_ajax_nonce', 'ajaxnonce');
        $template = isset($_POST['template']) ? sanitize_text_field($_POST['template']) : '';
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
        $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : '';
        $read = isset($_POST['read']) ? sanitize_text_field($_POST['read']) : '';
        $download = isset($_POST['download']) ? sanitize_text_field($_POST['download']) : '';
        $reading_count = isset($_POST['reading_count']) ? sanitize_text_field($_POST['reading_count']) : '';
        $downloading_count = isset($_POST['downloading_count']) ? sanitize_text_field($_POST['downloading_count']) : '';
        $show_description = isset($_POST['show_description']) ? sanitize_text_field($_POST['show_description']) : '';
        $show_author = isset($_POST['show_author']) ? sanitize_text_field($_POST['show_author']) : '';
        $show_publisher = isset($_POST['show_publisher']) ? sanitize_text_field($_POST['show_publisher']) : '';
        $show_year = isset($_POST['show_year']) ? sanitize_text_field($_POST['show_year']) : 'yes';
        $show_edition = isset($_POST['show_edition']) ? sanitize_text_field($_POST['show_edition']) : 'yes';
        $show_total_pages = isset($_POST['show_total_pages']) ? sanitize_text_field($_POST['show_total_pages']) : 'yes';
        $show_filesize = isset($_POST['show_filesize']) ? sanitize_text_field($_POST['show_filesize']) : 'yes';
        $shortcode = sprintf(
            '[pdfev_viewer template="%s" category="%s" limit="%d" order="%s" read="%s" download="%s" reading_count="%s" downloading_count="%s" show_description="%s" show_author="%s" show_publisher="%s" show_year="%s" show_edition="%s" show_total_pages="%s" show_filesize="%s"]',
            $template, $category, $limit, $order, $read, $download, $reading_count, $downloading_count, $show_description, $show_author, $show_publisher, $show_year, $show_edition, $show_total_pages, $show_filesize
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

new \PDFEV\Shortcode_Generator();
