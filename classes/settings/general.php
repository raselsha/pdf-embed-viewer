<?php
/**
 * @author shahadat hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.0
 */

namespace PDFEV;

defined('ABSPATH') || exit;

class General_Settings{
    public function __construct() {
        add_action( 'init', array($this,'save_options_data') );
        add_action('pdfev_settings_tabs',array($this,'tabs'),10,0);
        add_action('pdfev_settings_tabs_content',array($this,'tabs_content'));
    
    }
    
    public function tabs(){
        ?>
        <button class="nav-tab active" data-tab-target="pdfev_emd_vwr_admin_tabs_settings">
            <span class="dashicons dashicons-admin-generic" aria-hidden="true"></span>
            <?php echo esc_html__('General Settings','pdf-embed-viewer'); ?>
        </button>
        <?php
    }
    public function tabs_content(){
        ?>
        <div class="pdfev-tab-content active" data-tab="pdfev_emd_vwr_admin_tabs_settings">
            <form action="" method="post" class="pdfev-settings-form">
                <?php wp_nonce_field( 'pdfev_emd_vwr_options_nonce', 'pdfev_emd_vwr_options_nonce' ); ?>
                <?php $this->options_fields(); ?>
                <div class="pdfev-form-footer">
                    <?php submit_button( __( 'Save Changes', 'pdf-embed-viewer' ), 'primary', 'submit', false ); ?>
                </div>
            </form>
        </div>
        <?php
    }

    public function get_all_pages(){
        $pages = get_pages();
        $page_array = [];
        foreach ( $pages as $page ) {
            $page_array[] = [
                'ID' => $page->ID,
                'title' => $page->post_title,
                'slug' => $page->post_name,
                'url' => get_permalink( $page->ID ),
            ];
        }
        return $page_array;
    }
    
    public function options_fields(){
        $archive_title  = get_option('pdfev_archive_title'); 
        $archive_slug  = get_option('pdfev_archive_slug')??'pdf-embed-viewer'; 
            
        $template = get_option('pdfev_archive_template');
        $template_lists =  get_option('pdfev_archive_template_lists');
        $shortcode_page_url  = get_option('pdfev_shortcode_page_url');
        $shortcode_page_url  = $shortcode_page_url?$shortcode_page_url:'';
        $page_lists = $this->get_all_pages();
        
        $flipbook =  get_option('pdfev_flipbook_status');
        $flipbook = $flipbook ? $flipbook : 'yes';

        $archive_read =  get_option('pdfev_archive_read');
        $archive_read = $archive_read ? $archive_read : 'no';

        $reading_counter =  get_option('pdfev_reading_counter');
        $reading_counter = $reading_counter ? $reading_counter : 'no';
        
        $archive_download =  get_option('pdfev_archive_download');
        $archive_download = $archive_download ? $archive_download : 'no';

        $download_counter =  get_option('pdfev_download_counter');
        $download_counter = $download_counter ? $download_counter : 'no';

        $show_description = get_option('pdfev_show_description');
        $show_description = $show_description ? $show_description : 'no';

        $show_author = get_option('pdfev_show_author');
        $show_author = $show_author ? $show_author : 'no';

        $show_publisher = get_option('pdfev_show_publisher');
        $show_publisher = $show_publisher ? $show_publisher : 'no';

        $show_year = get_option('pdfev_show_year');
        $show_year = $show_year ? $show_year : 'no';

        $show_edition = get_option('pdfev_show_edition');
        $show_edition = $show_edition ? $show_edition : 'no';

        $show_total_pages = get_option('pdfev_show_total_pages');
        $show_total_pages = $show_total_pages ? $show_total_pages : 'no';
        
        $show_filesize = get_option('pdfev_show_filesize');
        $show_filesize = $show_filesize ? $show_filesize : 'no';

        $colors         = get_option('pdfev_css_colors');         
        $primary        = $colors['primary'] ? $colors['primary']:'#c79f62';
        $secondary      = $colors['secondary']?$colors['secondary']:'#666666';
        $dark           = $colors['dark']?$colors['dark']:'#333333';
        $light          = $colors['light']?$colors['light']:'#e5e5e5';

        $sections = [
            'archive'  => ['icon' => 'admin-links',     'label' => __('Archive Page', 'pdf-embed-viewer')],
            'display'  => ['icon' => 'visibility',       'label' => __('Display & Behavior', 'pdf-embed-viewer')],
            'metadata' => ['icon' => 'info',             'label' => __('Book Metadata', 'pdf-embed-viewer')],
            'colors'   => ['icon' => 'admin-appearance', 'label' => __('Brand Colors', 'pdf-embed-viewer')],
            'demo'     => ['icon' => 'database-import',  'label' => __('Demo Content', 'pdf-embed-viewer')],
        ];
        ?>
        <div class="pdfev-settings-shell">
            <aside class="pdfev-settings-sidebar">
                <?php foreach ($sections as $section_key => $section): ?>
                <button type="button" class="pdfev-section-nav<?php echo ($section_key === 'archive') ? ' active' : ''; ?>" data-section-target="<?php echo esc_attr($section_key); ?>">
                    <span class="dashicons dashicons-<?php echo esc_attr($section['icon']); ?>" aria-hidden="true"></span>
                    <?php echo esc_html($section['label']); ?>
                </button>
                <?php endforeach; ?>
            </aside>

            <div class="pdfev-settings-panel">
                <div class="pdfev-settings-section active" data-section="archive">
                    <div class="pdfev-section-header">
                        <h2><?php esc_html_e('Archive Page', 'pdf-embed-viewer'); ?></h2>
                        <p><?php esc_html_e('Where and how your PDF archive is displayed.', 'pdf-embed-viewer'); ?></p>
                    </div>
                    <div class="pdfev-section-body">
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label for="pdfev_archive_title"><?php esc_html_e('Archive Title', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('The heading shown at the top of your PDF archive page.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control">
                                <input type="text" id="pdfev_archive_title" name="pdfev_archive_title" placeholder="Pdf Embed Viewer" value="<?php echo esc_attr($archive_title); ?>">
                            </div>
                        </div>
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label for="pdfev_archive_slug"><?php esc_html_e('Archive Slug', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('The URL path used for the archive page, e.g. /pdf-embed-viewer/.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control">
                                <input type="text" id="pdfev_archive_slug" name="pdfev_archive_slug" placeholder="pdf-embed-viewer" value="<?php echo esc_attr($archive_slug); ?>">
                            </div>
                        </div>
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label for="pdfev_shortcode_page_url"><?php esc_html_e('Back to Overview Page', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('Page to link back to from a single PDF view.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control">
                                <select id="pdfev_shortcode_page_url" name="pdfev_shortcode_page_url">
                                    <option value=""><?php echo esc_html__('Select Page','pdf-embed-viewer'); ?></option>
                                    <?php foreach($page_lists as $value): ?>
                                    <option value="<?php echo esc_attr($value['slug']); ?>" <?php selected($value['slug'], $shortcode_page_url); ?>><?php echo esc_html($value['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label for="pdfev_archive_template"><?php esc_html_e('Archive Template', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('Layout style used to display PDFs on the archive page.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control">
                                <select id="pdfev_archive_template" name="pdfev_archive_template">
                                    <?php foreach($template_lists as $key => $value): ?>
                                    <option value="<?php echo esc_attr($key); ?>" <?php echo $key==$template? esc_attr('selected'):'' ?>><?php echo esc_attr($value); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pdfev-settings-section" data-section="display">
                    <div class="pdfev-section-header">
                        <h2><?php esc_html_e('Display & Behavior', 'pdf-embed-viewer'); ?></h2>
                        <p><?php esc_html_e('Toggle the viewer, buttons, and counters shown on the frontend.', 'pdf-embed-viewer'); ?></p>
                    </div>
                    <div class="pdfev-section-body pdfev-toggle-grid">
                        <?php
                        $this->toggle_row('pdfev_flipbook_status', __('Default View: 3D Flipbook', 'pdf-embed-viewer'), $flipbook, __('Open PDFs in the interactive 3D flipbook viewer instead of a plain iframe.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_archive_read', __('Show Read Button', 'pdf-embed-viewer'), $archive_read, __('Display a Read button on each PDF card in the archive.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_reading_counter', __('Show Reading Counter', 'pdf-embed-viewer'), $reading_counter, __('Track and display how many times each PDF has been viewed.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_archive_download', __('Show Download Button', 'pdf-embed-viewer'), $archive_download, __('Display a Download button on each PDF card in the archive.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_download_counter', __('Show Download Counter', 'pdf-embed-viewer'), $download_counter, __('Track and display how many times each PDF has been downloaded.', 'pdf-embed-viewer'));
                        ?>
                    </div>
                </div>

                <div class="pdfev-settings-section" data-section="metadata">
                    <div class="pdfev-section-header">
                        <h2><?php esc_html_e('Book Metadata Display', 'pdf-embed-viewer'); ?></h2>
                        <p><?php esc_html_e('Choose which book details appear alongside each PDF.', 'pdf-embed-viewer'); ?></p>
                    </div>
                    <div class="pdfev-section-body pdfev-toggle-grid pdfev-toggle-grid--compact">
                        <?php
                        $this->toggle_row('pdfev_show_description', __('Show Description', 'pdf-embed-viewer'), $show_description, __('Display the document description on archive and single views.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_author', __('Show Author', 'pdf-embed-viewer'), $show_author, __('Display the assigned author.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_publisher', __('Show Publisher', 'pdf-embed-viewer'), $show_publisher, __('Display the assigned publisher.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_year', __('Show Published Year', 'pdf-embed-viewer'), $show_year, __('Display the year the document was published.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_edition', __('Show Published Edition', 'pdf-embed-viewer'), $show_edition, __('Display the edition or version of the document.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_total_pages', __('Show Total Pages', 'pdf-embed-viewer'), $show_total_pages, __('Display the total number of pages in the document.', 'pdf-embed-viewer'));
                        $this->toggle_row('pdfev_show_filesize', __('Show Filesize', 'pdf-embed-viewer'), $show_filesize, __('Display the file size of the PDF.', 'pdf-embed-viewer'));
                        ?>
                    </div>
                </div>

                <div class="pdfev-settings-section" data-section="colors">
                    <div class="pdfev-section-header">
                        <h2><?php esc_html_e('Brand Colors', 'pdf-embed-viewer'); ?></h2>
                        <p><?php esc_html_e('These colors are used across the frontend viewer and buttons.', 'pdf-embed-viewer'); ?></p>
                    </div>
                    <div class="pdfev-section-body pdfev-color-grid">
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_primary"><?php esc_html_e('Primary', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Main accent color used for buttons and highlights.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_primary" class="pdfev-color-field" type="text" name="pdfev_css_colors[primary]" value="<?php echo esc_attr($primary); ?>">
                        </div>
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_secondary"><?php esc_html_e('Secondary', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Supporting color used for secondary text and elements.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_secondary" class="pdfev-color-field" type="text" name="pdfev_css_colors[secondary]" value="<?php echo esc_attr($secondary); ?>">
                        </div>
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_dark"><?php esc_html_e('Dark', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Used for headings and high-contrast text.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_dark" class="pdfev-color-field" type="text" name="pdfev_css_colors[dark]" value="<?php echo esc_attr($dark); ?>">
                        </div>
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_light"><?php esc_html_e('Light', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Used for backgrounds and subtle borders.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_light" class="pdfev-color-field" type="text" name="pdfev_css_colors[light]" value="<?php echo esc_attr($light); ?>">
                        </div>
                    </div>
                </div>

                <div class="pdfev-settings-section" data-section="demo">
                    <div class="pdfev-section-header">
                        <h2><?php esc_html_e('Demo Content', 'pdf-embed-viewer'); ?></h2>
                        <p><?php esc_html_e('Populate the plugin with sample books to preview templates.', 'pdf-embed-viewer'); ?></p>
                    </div>
                    <div class="pdfev-section-body">
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label><?php esc_html_e('Import Demo Content', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('Adds sample PDFs, categories, and metadata so you can preview the archive templates.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control pdfev-demo-import">
                                <input type="button" class="button-primary pdfev-import-demo-content" value="<?php echo esc_attr__('Import Demo', 'pdf-embed-viewer'); ?>">
                                <span class="demo-import-success"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function toggle_row($name, $label, $value, $description = ''){
        ?>
        <div class="pdfev-toggle-row">
            <div class="pdfev-toggle-row-label">
                <span class="pdfev-toggle-row-title"><?php echo esc_html($label); ?></span>
                <?php if ($description) : ?>
                <span class="pdfev-toggle-row-desc"><?php echo esc_html($description); ?></span>
                <?php endif; ?>
            </div>
            <label class="switch">
                <input type="checkbox" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" <?php echo esc_attr(($value == 'yes') ? 'checked' : ''); ?>>
                <span class="slider"></span>
            </label>
        </div>
        <?php
    }

    public function save_options_data() {
        if( isset( $_POST['pdfev_emd_vwr_options_nonce'] ) ){
            if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_options_nonce'] ) ) , 'pdfev_emd_vwr_options_nonce' ) ){
                return;
            }
            
            $archive_title      = isset( $_POST['pdfev_archive_title'] ) ? sanitize_text_field($_POST['pdfev_archive_title']): 'Pdf Embed Viewer';
            $archive_slug       = isset( $_POST['pdfev_archive_slug'] ) ? sanitize_text_field(sanitize_title($_POST['pdfev_archive_slug'])): 'pdf-embed-viewer';
            $shortcode_page_url = isset( $_POST['pdfev_shortcode_page_url'] ) ? sanitize_text_field($_POST['pdfev_shortcode_page_url']): '';
            $archive_template   = isset( $_POST['pdfev_archive_template'] ) ? sanitize_text_field($_POST['pdfev_archive_template']): 'list';
            $flipbook           = isset( $_POST['pdfev_flipbook_status'] ) ? sanitize_text_field($_POST['pdfev_flipbook_status']): 'no';
            $archive_read       = isset( $_POST['pdfev_archive_read'] ) ? sanitize_text_field($_POST['pdfev_archive_read']): 'no';
            $reading_counter    = isset( $_POST['pdfev_reading_counter'] ) ? sanitize_text_field($_POST['pdfev_reading_counter']): 'no';
            $archive_download   = isset( $_POST['pdfev_archive_download'] ) ? sanitize_text_field($_POST['pdfev_archive_download']): 'no';
            $download_counter   = isset( $_POST['pdfev_download_counter'] ) ? sanitize_text_field($_POST['pdfev_download_counter']): 'no';
            $show_description   = isset( $_POST['pdfev_show_description'] ) ? sanitize_text_field($_POST['pdfev_show_description']): 'no';
            $show_author        = isset( $_POST['pdfev_show_author'] ) ? sanitize_text_field($_POST['pdfev_show_author']): 'no';
            $show_publisher     = isset( $_POST['pdfev_show_publisher'] ) ? sanitize_text_field($_POST['pdfev_show_publisher']): 'no';
            $show_year          = isset($_POST['pdfev_show_year']) ? sanitize_text_field($_POST['pdfev_show_year']) : 'no';
            $show_edition       = isset($_POST['pdfev_show_edition']) ? sanitize_text_field($_POST['pdfev_show_edition']) : 'no';
            $show_total_pages   = isset($_POST['pdfev_show_total_pages']) ? sanitize_text_field($_POST['pdfev_show_total_pages']) : 'no';
            $show_filesize      = isset($_POST['pdfev_show_filesize']) ? sanitize_text_field($_POST['pdfev_show_filesize']) : 'no';

            $primary            = isset( $_POST['pdfev_css_colors']['primary'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['primary']) : '';
            $secondary          = isset( $_POST['pdfev_css_colors']['secondary'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['secondary']) : '';
            $dark               = isset( $_POST['pdfev_css_colors']['dark'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['dark'])  : '';
            $light              = isset( $_POST['pdfev_css_colors']['light'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['light'])    :'';
            
            $colors = [
                'primary'   => $primary,
                'secondary' => $secondary,
                'dark'      => $dark,
                'light'     => $light,
            ];
            update_option('pdfev_archive_title',$archive_title);
            update_option('pdfev_archive_slug',$archive_slug);
            update_option('pdfev_shortcode_page_url',$shortcode_page_url);
            update_option('pdfev_archive_template',$archive_template);
            update_option('pdfev_flipbook_status',$flipbook);
            update_option('pdfev_archive_read',$archive_read);
            update_option('pdfev_reading_counter',$reading_counter);
            update_option('pdfev_archive_download',$archive_download);
            update_option('pdfev_download_counter',$download_counter);
            update_option('pdfev_show_description',$show_description);
            update_option('pdfev_show_author',$show_author);
            update_option('pdfev_show_publisher',$show_publisher);
            update_option('pdfev_show_year', $show_year);
            update_option('pdfev_show_edition', $show_edition);
            update_option('pdfev_show_total_pages', $show_total_pages);
            update_option('pdfev_show_filesize', $show_filesize);
            update_option('pdfev_css_colors',$colors );                
        }
    }
}

new \PDFEV\General_Settings();
