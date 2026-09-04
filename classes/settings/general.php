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
            <form action="" method="post" id="pdfev-settings-form" class="pdfev-settings-form">
                <?php wp_nonce_field( 'pdfev_emd_vwr_options_nonce', 'pdfev_emd_vwr_options_nonce' ); ?>
                <?php $this->options_fields(); ?>
                <div class="pdfev-form-footer">
                    <?php
                    /*
                     * form="pdfev-settings-form" on purpose, not just relying on this button
                     * sitting inside the <form> above: an add-on's own settings section
                     * (e.g. pdf-embed-viewer-pro's "Manage License", via Appsero's
                     * menu_output()) can render its own nested <form>, which HTML doesn't
                     * allow — the browser's parser closes OUR form early the moment it hits
                     * that nested form's closing tag, silently pushing everything after it
                     * (including this button) outside any form in the real DOM. Targeting
                     * the form by id sidesteps that regardless of where this button ends up.
                     */
                    ?>
                    <button type="submit" name="submit" id="submit" form="pdfev-settings-form" class="pdfev-btn pdfev-btn-primary pdfev-header-save">
                        <span class="dashicons dashicons-yes" aria-hidden="true"></span>
                        <?php esc_html_e('Save Changes', 'pdf-embed-viewer'); ?>
                    </button>
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
        $container_border = $colors['container_border'] ?? '';
        $container_bg      = $colors['container_bg'] ?? '';
        $container_max_width = get_option('pdfev_container_max_width');

        // Lets an add-on (e.g. pdf-embed-viewer-pro) insert its own sidebar nav
        // entries (typically before 'demo', so "Demo Content" stays last).
        $sections = apply_filters('pdfev_settings_sections', [
            'archive'  => ['icon' => 'admin-links',     'label' => __('Archive Page', 'pdf-embed-viewer')],
            'display'  => ['icon' => 'visibility',       'label' => __('Display & Behavior', 'pdf-embed-viewer')],
            'metadata' => ['icon' => 'book',             'label' => __('Book Details', 'pdf-embed-viewer')],
            'colors'   => ['icon' => 'admin-appearance', 'label' => __('Brand Colors', 'pdf-embed-viewer')],
            'demo'     => ['icon' => 'database-import',  'label' => __('Demo Content', 'pdf-embed-viewer')],
        ]);
        ?>
        <div class="pdfev-settings-shell">
            <aside class="pdfev-settings-sidebar">
                <?php foreach ($sections as $section_key => $section): ?>
                <button type="button" class="pdfev-section-nav<?php echo ($section_key === 'archive') ? ' active' : ''; ?>" data-section-target="<?php echo esc_attr($section_key); ?>">
                    <span class="dashicons dashicons-<?php echo esc_attr($section['icon']); ?>" aria-hidden="true"></span>
                    <?php echo esc_html($section['label']); ?>
                    <?php if (!empty($section['badge'])) : ?>
                    <span class="pdfev-pro-badge"><?php echo esc_html($section['badge']); ?></span>
                    <?php endif; ?>
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
                                <?php
                                $page_options = [];
                                foreach ($page_lists as $value) {
                                    $page_options[$value['slug']] = $value['title'];
                                }
                                $this->render_custom_select('pdfev_shortcode_page_url', 'pdfev_shortcode_page_url', $page_options, $shortcode_page_url, __('Select Page', 'pdf-embed-viewer'));
                                ?>
                            </div>
                        </div>
                        <div class="pdfev-field-row">
                            <div class="pdfev-field-label">
                                <label for="pdfev_archive_template"><?php esc_html_e('Archive Template', 'pdf-embed-viewer'); ?></label>
                                <span><?php esc_html_e('Layout style used to display PDFs on the archive page.', 'pdf-embed-viewer'); ?></span>
                            </div>
                            <div class="pdfev-field-control">
                                <?php $this->render_custom_select('pdfev_archive_template', 'pdfev_archive_template', $template_lists, $template); ?>
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
                        <h2><?php esc_html_e('Book Details', 'pdf-embed-viewer'); ?></h2>
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
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_container_border"><?php esc_html_e('Book Container Border', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Border around the book/viewer container. Leave blank for no border.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_container_border" class="pdfev-color-field" type="text" name="pdfev_css_colors[container_border]" value="<?php echo esc_attr($container_border); ?>" data-default-color="">
                        </div>
                        <div class="pdfev-color-item">
                            <label for="pdfev_color_container_bg"><?php esc_html_e('Book Container Background', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Background behind the book/viewer container. Leave blank for transparent.', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_color_container_bg" class="pdfev-color-field" type="text" name="pdfev_css_colors[container_bg]" value="<?php echo esc_attr($container_bg); ?>" data-default-color="">
                        </div>
                        <div class="pdfev-color-item">
                            <label for="pdfev_container_max_width"><?php esc_html_e('Container Max Width', 'pdf-embed-viewer'); ?></label>
                            <span><?php esc_html_e('Widest the whole viewer (book + toolbar) is allowed to grow, in pixels. Leave blank for the default (1300px).', 'pdf-embed-viewer'); ?></span>
                            <input id="pdfev_container_max_width" type="number" min="200" step="10" name="pdfev_container_max_width" value="<?php echo esc_attr($container_max_width); ?>" placeholder="1300">
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

                <?php
                // Lets an add-on (e.g. pdf-embed-viewer-pro) render its own extra
                // settings section(s) here, using this class's own toggle_row() /
                // render_custom_select() / render_pro_badge() / render_pro_upsell_banner()
                // helpers — same visual language, no markup/CSS duplication. Has
                // WordPress-core precedent: WP_Widget::form() passes $this through
                // do_action_ref_array('in_widget_form', ...) for the same reason.
                do_action('pdfev_settings_extra_sections', $this);
                ?>
            </div>
        </div>
        <?php
    }

    public function render_custom_select($id, $name, $options, $selected = '', $placeholder = '', $locked = false){
        $selected_label = $placeholder;
        foreach ($options as $value => $label) {
            if ((string) $value === (string) $selected) {
                $selected_label = $label;
                break;
            }
        }
        ?>
        <div class="pdfev-select<?php echo $locked ? ' pdfev-locked' : ''; ?>">
            <select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" class="pdfev-select-native" <?php disabled($locked); ?>>
                <?php if ($placeholder !== '') : ?>
                <option value=""><?php echo esc_html($placeholder); ?></option>
                <?php endif; ?>
                <?php foreach ($options as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected((string) $value, (string) $selected); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="pdfev-select-trigger" aria-haspopup="listbox" aria-expanded="false" <?php disabled($locked); ?>>
                <span class="pdfev-select-value"><?php echo esc_html($selected_label); ?></span>
                <span class="dashicons dashicons-arrow-down-alt2" aria-hidden="true"></span>
            </button>
            <ul class="pdfev-select-options" role="listbox" hidden>
                <?php if ($placeholder !== '') : ?>
                <li role="option" data-value="" <?php echo ((string) $selected === '') ? 'aria-selected="true"' : ''; ?>><?php echo esc_html($placeholder); ?></li>
                <?php endif; ?>
                <?php foreach ($options as $value => $label) : ?>
                <li role="option" data-value="<?php echo esc_attr($value); ?>" <?php echo ((string) $value === (string) $selected) ? 'aria-selected="true"' : ''; ?>><?php echo esc_html($label); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    public function toggle_row($name, $label, $value, $description = '', $locked = false){
        ?>
        <div class="pdfev-toggle-row<?php echo $locked ? ' pdfev-locked' : ''; ?>">
            <div class="pdfev-toggle-row-label">
                <span class="pdfev-toggle-row-title"><?php echo esc_html($label); ?><?php $this->render_pro_badge($locked); ?></span>
                <?php if ($description) : ?>
                <span class="pdfev-toggle-row-desc"><?php echo esc_html($description); ?></span>
                <?php endif; ?>
            </div>
            <label class="switch">
                <input type="checkbox" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" <?php echo esc_attr(($value == 'yes') ? 'checked' : ''); ?> <?php disabled($locked); ?>>
                <span class="slider"></span>
            </label>
        </div>
        <?php
    }

    /**
     * Small "PRO" badge appended next to a field's label when it's locked
     * (i.e. the current install isn't licensed). Purely cosmetic — the real
     * enforcement is server-side in save_options_data() and, for these
     * specific Pro features, again at render/endpoint time in functions.php.
     */
    public function render_pro_badge($locked){
        if ($locked) {
            echo ' <span class="pdfev-pro-badge">' . esc_html__('PRO', 'pdf-embed-viewer') . '</span>';
        }
    }

    /**
     * Small upsell banner an add-on can show at the top of its own Pro-gated
     * section when unlicensed. This class has no licensing/Appsero knowledge
     * of its own — the caller (e.g. pdf-embed-viewer-pro) supplies its own
     * "Manage License" URL and, optionally, a custom message.
     *
     * @param string $license_url URL to the add-on's license-activation page.
     * @param string $message     Optional custom message; falls back to a generic one.
     */
    public function render_pro_upsell_banner($license_url, $message = ''){
        $message = $message !== '' ? $message : __('These settings require an active Pro license.', 'pdf-embed-viewer');
        ?>
        <div class="pdfev-pro-upsell">
            <span class="dashicons dashicons-lock" aria-hidden="true"></span>
            <span><?php echo esc_html($message); ?></span>
            <a href="<?php echo esc_url($license_url); ?>"><?php esc_html_e('Activate License', 'pdf-embed-viewer'); ?></a>
        </div>
        <?php
    }

    public function save_options_data() {
        if( isset( $_POST['pdfev_emd_vwr_options_nonce'] ) ){
            if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_options_nonce'] ) ) , 'pdfev_emd_vwr_options_nonce' ) ){
                return;
            }

            if( ! current_user_can( 'manage_options' ) ){
                return;
            }

            // Lets an add-on (e.g. pdf-embed-viewer-pro) save its own settings in
            // this same request. Nonce + capability are already verified above,
            // so the add-on's callback doesn't need to re-check either.
            do_action('pdfev_save_extra_options', $_POST);

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
            $container_border  = isset( $_POST['pdfev_css_colors']['container_border'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['container_border']) : '';
            $container_bg      = isset( $_POST['pdfev_css_colors']['container_bg'] ) ? sanitize_hex_color($_POST['pdfev_css_colors']['container_bg']) : '';

            $colors = [
                'primary'          => $primary,
                'secondary'        => $secondary,
                'dark'             => $dark,
                'light'            => $light,
                'container_border' => $container_border,
                'container_bg'     => $container_bg,
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

            $container_max_width = isset( $_POST['pdfev_container_max_width'] ) && $_POST['pdfev_container_max_width'] !== '' ? absint( $_POST['pdfev_container_max_width'] ) : '';
            update_option('pdfev_container_max_width', $container_max_width);
        }
    }
}

new \PDFEV\General_Settings();
