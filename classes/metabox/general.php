<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */
namespace PDFEV;

defined('ABSPATH') || exit;

class Metabox_General{
    public function __construct()
    {
        add_action('pdfev_metabox_tabs',array($this,'tabs'));
        add_action('pdfev_metabox_tabs_content',array($this,'tabs_content'));
        add_action( 'save_post' , array( $this, 'save_post') );
        add_action( 'wp_ajax_pdfev_upload_pdf_file', array( $this, 'ajax_upload_pdf_file' ) );
        add_action( 'wp_ajax_pdfev_clone_remote_pdf', array( $this, 'ajax_clone_remote_pdf' ) );
    }

    /**
     * Handles a PDF dragged straight onto the metabox's dropzone — the
     * wp.media picker's own upload flow doesn't apply here since there's no
     * modal open to drop the file into, so this does the same thing
     * (media_handle_upload) directly from admin-ajax.php instead.
     */
    public function ajax_upload_pdf_file() {
        check_ajax_referer( 'pdf_ajax_nonce', 'ajaxnonce' );

        if ( ! current_user_can( 'upload_files' ) ) {
            wp_send_json_error( array( 'message' => __( 'You are not allowed to upload files.', 'pdf-embed-viewer' ) ) );
        }

        if ( empty( $_FILES['pdfev_pdf_file'] ) ) {
            wp_send_json_error( array( 'message' => __( 'No file was received.', 'pdf-embed-viewer' ) ) );
        }

        $file = $_FILES['pdfev_pdf_file'];
        $filetype = wp_check_filetype( $file['name'], array( 'pdf' => 'application/pdf' ) );

        if ( $filetype['ext'] !== 'pdf' || $filetype['type'] !== 'application/pdf' ) {
            wp_send_json_error( array( 'message' => __( 'Please choose a PDF file.', 'pdf-embed-viewer' ) ) );
        }

        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
        $attach_id = media_handle_upload( 'pdfev_pdf_file', $post_id );

        if ( is_wp_error( $attach_id ) ) {
            wp_send_json_error( array( 'message' => $attach_id->get_error_message() ) );
        }

        wp_send_json_success( array(
            'url'      => wp_get_attachment_url( $attach_id ),
            'filename' => basename( get_attached_file( $attach_id ) ),
        ) );
    }

    /**
     * "Download to Media Library" — fetches a remote PDF server-side and
     * saves it as a local attachment, same end result as if the admin had
     * uploaded it directly. Reuses is_allowed_proxy_url() for the same
     * SSRF-prevention whitelist the ?pdfev_proxy= endpoint already enforces
     * (http/https, path ending in .pdf, non-private/non-reserved IP) — this
     * handler does its own outbound fetch too, so the same rules apply.
     *
     * Note: hosts that gate downloads behind a JS-executing anti-bot
     * challenge (some free hosting providers) will fail here the same way
     * they fail the ?pdfev_proxy= endpoint — wp_remote_get() can't run
     * JavaScript any more than curl can, so there's no way around that
     * short of the file being served without such a challenge.
     */
    public function ajax_clone_remote_pdf() {
        check_ajax_referer( 'pdf_ajax_nonce', 'ajaxnonce' );

        if ( ! current_user_can( 'upload_files' ) ) {
            wp_send_json_error( array( 'message' => __( 'You are not allowed to upload files.', 'pdf-embed-viewer' ) ) );
        }

        $url = isset( $_POST['url'] ) ? esc_url_raw( wp_unslash( $_POST['url'] ) ) : '';

        if ( empty( $url ) || ! \PDFEV_Functions::is_allowed_proxy_url( $url ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter a valid PDF URL first.', 'pdf-embed-viewer' ) ) );
        }

        $response = wp_remote_get( $url, array( 'timeout' => 60 ) );

        if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
            wp_send_json_error( array( 'message' => __( 'Could not download that URL. The host may be blocking automated requests.', 'pdf-embed-viewer' ) ) );
        }

        $content_type = wp_remote_retrieve_header( $response, 'content-type' );
        if ( stripos( (string) $content_type, 'pdf' ) === false ) {
            wp_send_json_error( array( 'message' => __( 'That URL did not return a PDF file.', 'pdf-embed-viewer' ) ) );
        }

        $body = wp_remote_retrieve_body( $response );
        if ( empty( $body ) ) {
            wp_send_json_error( array( 'message' => __( 'The downloaded file was empty.', 'pdf-embed-viewer' ) ) );
        }

        $filename = sanitize_file_name( basename( (string) wp_parse_url( $url, PHP_URL_PATH ) ) );
        if ( empty( $filename ) || ! preg_match( '/\.pdf$/i', $filename ) ) {
            $filename = 'remote-pdf-' . time() . '.pdf';
        }

        $upload_dir = wp_upload_dir();
        $filename   = wp_unique_filename( $upload_dir['path'], $filename );
        $file_path  = $upload_dir['path'] . '/' . $filename;

        if ( false === file_put_contents( $file_path, $body ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not save the downloaded file.', 'pdf-embed-viewer' ) ) );
        }

        require_once ABSPATH . 'wp-admin/includes/image.php';

        $post_id    = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
        $attach_id  = wp_insert_attachment(
            array(
                'post_mime_type' => 'application/pdf',
                'post_title'     => sanitize_file_name( $filename ),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ),
            $file_path,
            $post_id
        );

        if ( is_wp_error( $attach_id ) ) {
            wp_send_json_error( array( 'message' => $attach_id->get_error_message() ) );
        }

        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        wp_send_json_success( array(
            'url'      => wp_get_attachment_url( $attach_id ),
            'filename' => $filename,
        ) );
    }

    public function tabs($post_id){
        ?>
            <li class="pdfev-tab active" data-tab-target="pdfev-tabs-general">
                <span class="dashicons dashicons-admin-generic" aria-hidden="true"></span>
                <?php esc_html_e('General','pdf-embed-viewer'); ?>
            </li>
        <?php
    }
    public function tabs_content($post_id){
        $embed_file = \PDFEV_Functions::get_pdf_link();
        $embed_file =  $embed_file ? $embed_file :'';

        // Same-site check on the *raw* stored URL (not $embed_file, which get_pdf_link()
        // may have already rewritten into a same-site proxy URL for remote files — that
        // rewrite exists so the thumbnail/filesize preview's own fetch() below doesn't hit
        // CORS, not to decide which tab this field should default to).
        $raw_url = get_post_meta( $post_id, 'pdfev_meta_pdf_url', true );
        $site_host = wp_parse_url( home_url(), PHP_URL_HOST );
        $file_host = $raw_url ? wp_parse_url( $raw_url, PHP_URL_HOST ) : null;
        $is_remote_source = $file_host && $site_host !== $file_host;
        $uploaded_filename = ( ! $is_remote_source && $embed_file ) ? basename( (string) wp_parse_url( $embed_file, PHP_URL_PATH ) ) : '';

        $check_download  = get_post_meta( $post_id, 'pdfev_meta_download', true );
        $check_download  = $check_download ? $check_download : 'yes';

        $rtl = get_post_meta( $post_id, 'pdfev_meta_rtl', true );
        $rtl = $rtl ? $rtl : 'no';

        $filesize = get_post_meta( $post_id, 'pdfev_meta_filesize', true );
        $total_pages = get_post_meta( $post_id, 'pdfev_meta_total_pages', true );


        if ( has_post_thumbnail( $post_id ) ) {
            $thumbnail_url = get_the_post_thumbnail_url($post_id);
        }
        ?>
        <div class="pdfev-tab-content active" data-tab="pdfev-tabs-general">
            <?php wp_nonce_field( 'pdfev_emd_vwr_metabox_nonce', 'pdfev_emd_vwr_metabox_nonce' ); ?>
            <div class="pdfev-metabox-section-header">
                <h2><?php _e('General Settings','pdf-embed-viewer'); ?></h2>
                <p><?php _e('Here you can add basic settings for your document.','pdf-embed-viewer'); ?></p>
            </div>
            <div class="pdfev-metabox-section-body">

                    <div class="pdfev-metabox-group-body">
                        <?php
                        // $raw_url, not $embed_file — get_pdf_link() rewrites remote
                        // sources into a same-site ?pdfev_proxy=... URL (so the JS
                        // preview fetch below avoids CORS), but this hidden field is
                        // what actually gets saved back into pdfev_meta_pdf_url on
                        // Update. Using $embed_file here would silently overwrite the
                        // original remote URL with the local proxy link on every save
                        // where the admin doesn't happen to retype it.
                        ?>
                        <input type="hidden" class="pdfev-emd-vwr-file" name="pdfev_meta_pdf_url" value="<?php echo esc_attr($raw_url); ?>">

                        <div class="pdfev-preview-wrap">
                            <?php
                            // Survives the thumbnail renderer's container.html('') resets (it
                            // lives outside #pdfev-document-preview, not inside it) so the
                            // "current source" row stays available once a file/URL is set.
                            // One bar, two mutually-exclusive rows inside it — Remote URL's
                            // input lives right here instead of a separate floating panel,
                            // so switching source type doesn't move it somewhere else.
                            ?>
                            <div class="pdfev-replace-bar" style="display:<?php echo ( $is_remote_source || ( ! $is_remote_source && $embed_file ) ) ? 'block' : 'none'; ?>;">
                                <div class="pdfev-replace-bar-row pdfev-replace-bar-upload" style="display:<?php echo ( ! $is_remote_source && $embed_file ) ? 'flex' : 'none'; ?>;">
                                    <span class="dashicons dashicons-media-document" aria-hidden="true"></span>
                                    <span class="pdfev-source-filename"><?php echo esc_html($uploaded_filename); ?></span>
                                    <button type="button" class="pdfev-clear-file" aria-label="<?php echo esc_attr__('Remove file', 'pdf-embed-viewer'); ?>">
                                        <span class="dashicons dashicons-no-alt" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="button pdfev-emd-vwr-upload pdfev-replace-btn">
                                        <?php esc_html_e('Replace File', 'pdf-embed-viewer'); ?>
                                    </button>
                                </div>
                                <div class="pdfev-replace-bar-row pdfev-replace-bar-remote" style="display:<?php echo $is_remote_source ? 'flex' : 'none'; ?>;">
                                    <span class="dashicons dashicons-admin-links" aria-hidden="true"></span>
                                    <input type="url" id="pdfev-remote-url-input" value="<?php echo $is_remote_source ? esc_attr($raw_url) : ''; ?>" placeholder="<?php echo esc_attr('https://example.com/filename.pdf'); ?>">
                                    <button type="button" class="pdfev-clear-file" aria-label="<?php echo esc_attr__('Remove URL', 'pdf-embed-viewer'); ?>">
                                        <span class="dashicons dashicons-no-alt" aria-hidden="true"></span>
                                    </button>
                                    <?php
                                    // Fetches the URL server-side and saves it as a local
                                    // attachment — for hosts that don't already work fine as
                                    // a live remote link (slow, unreliable, or the file host
                                    // might disappear later), without needing to manually
                                    // download-then-reupload through the Choose File flow.
                                    ?>
                                    <button type="button" class="button pdfev-replace-btn pdfev-clone-remote-btn">
                                        <span class="dashicons dashicons-download" aria-hidden="true"></span>
                                        <span class="pdfev-btn-label"><?php esc_html_e('Download to Media Library', 'pdf-embed-viewer'); ?></span>
                                    </button>
                                    <button type="button" class="pdfev-source-link" data-source-target="upload">
                                        <span class="dashicons dashicons-arrow-left-alt2" aria-hidden="true"></span>
                                        <span class="pdfev-source-link-text"><?php esc_html_e('Back to upload', 'pdf-embed-viewer'); ?></span>
                                    </button>
                                </div>
                            </div>

                            <div class="pdfev-metabox-preview-area">
                                <div class="pdfev-featured-image-area">
                                    <div class="pdfev-metabox-field-label">
                                        <p><?php echo esc_html__( 'Book Cover', 'pdf-embed-viewer' )?></p>
                                        <span><?php echo esc_html__('Select any image to set as thumbnail from right.','pdf-embed-viewer') ?></span>
                                    </div>
                                    <div id="pdfev-featured-image" data-status="<?php echo isset($thumbnail_url)?'yes':'no';?>" data-url="<?php echo isset($thumbnail_url)?$thumbnail_url:'';?>">
                                        <input type="hidden" id="pdfev-featured-image-data" name="pdfev_featured_image">
                                        <input type="hidden" name="pdfev_meta_filesize" id="pdfev_meta_filesize" value="<?php echo esc_attr($filesize); ?>">
                                        <input type="hidden" name="pdfev_meta_total_pages" id="pdfev_meta_total_pages" value="<?php echo esc_attr($total_pages); ?>">

                                        <div class="pdfev-featured-image-cover">
                                            <img id="pdfev-featured-image-preview" style="display:<?php echo isset($thumbnail_url) ? 'block' : 'none'; ?>;" src="<?php echo esc_attr(isset($thumbnail_url)?$thumbnail_url:'');?>">
                                            <div class="pdfev-featured-image-placeholder" style="display:<?php echo isset($thumbnail_url) ? 'none' : 'flex'; ?>;">
                                                <span class="dashicons dashicons-format-image" aria-hidden="true"></span>
                                                <p><?php esc_html_e('No cover yet', 'pdf-embed-viewer'); ?></p>
                                            </div>
                                        </div>

                                        <div class="pdfev-featured-image-meta">
                                            <div class="pdfev-featured-image-meta-row">
                                                <span><?php esc_html_e('Document size', 'pdf-embed-viewer'); ?></span>
                                                <strong class="pdfev-filesize"></strong>
                                            </div>
                                            <div class="pdfev-featured-image-meta-row">
                                                <span><?php esc_html_e('Total Pages', 'pdf-embed-viewer'); ?></span>
                                                <strong class="pdfev-totalpage"></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                // .pdfev-upload-overlay is a sibling of #pdfev-document-preview
                                // (not nested inside it) for the same reason as the replace bar
                                // above — position:absolute over .pdfev-preview-stage instead.
                                ?>
                                <div class="pdfev-preview-stage">
                                    <div id="pdfev-document-preview" class="<?php echo ( ! $is_remote_source && ! $embed_file ) ? 'pdfev-dropzone' : ''; ?>">
                                        <div class="pdfev-loader-wrapper" style="display:none;">
                                            <div class="pdfev-progress-ring">
                                                <svg viewBox="0 0 56 56" aria-hidden="true">
                                                    <circle class="pdfev-progress-ring-track" cx="28" cy="28" r="24"></circle>
                                                    <circle class="pdfev-progress-ring-fill" cx="28" cy="28" r="24"></circle>
                                                </svg>
                                                <span class="pdfev-loader-percent">0%</span>
                                            </div>
                                            <p><?php echo __('Loading preview...','pdf-embed-viewer') ?></p>
                                        </div>
                                        <p class="warning" style="display:none;"><?php echo __('Failed to load preview. Please Upload a PDF.','pdf-embed-viewer') ?></p>
                                    </div>
                                    <div class="pdfev-upload-overlay" style="display:<?php echo ( ! $is_remote_source && ! $embed_file ) ? 'flex' : 'none'; ?>;">
                                        <span class="dashicons dashicons-upload" aria-hidden="true"></span>
                                        <button type="button" class="button button-primary pdfev-emd-vwr-upload">
                                            <?php esc_html_e('Choose File', 'pdf-embed-viewer'); ?>
                                        </button>
                                        <p><?php esc_html_e('or drag and drop your PDF here', 'pdf-embed-viewer'); ?></p>
                                        <button type="button" class="pdfev-source-link" data-source-target="remote">
                                            <span class="dashicons dashicons-admin-links" aria-hidden="true"></span>
                                            <span class="pdfev-source-link-text"><?php esc_html_e('Or use a Remote URL instead', 'pdf-embed-viewer'); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pdfev-metabox-group-body pdfev-metabox-fields-panel">
                        <div class="pdfev-metabox-field">
                            <div class="pdfev-metabox-field-label">
                                <p><?php echo esc_html__( 'Shortcode', 'pdf-embed-viewer' )?></p>
                                <span><?php echo esc_html__('Add this shortcode to any page or post to view pdf','pdf-embed-viewer') ?></span>
                            </div>
                            <div class="pdfev-metabox-field-control pdfev-metabox-field-control--inline">
                                <code id="pdfev-single-shortcode"><?php echo esc_html('[pdfev_embed_viewer id="' . get_the_ID() . '"]') ?></code>
                                <button type="button" id="pdfev-copy-single-shortcode" class="button pdfev-emd-vwr-copy">
                                    <svg class="pdfev-icon-copy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                    <span class="pdfev-btn-label"><?php echo esc_html__('Copy', 'pdf-embed-viewer'); ?></span>
                                </button>
                            </div>
                        </div>

                        <div class="pdfev-metabox-field">
                            <div class="pdfev-metabox-field-label">
                                <p><?php echo esc_html__( 'Download Button', 'pdf-embed-viewer' )?></p>
                                <span><?php echo esc_html__('Show/Hide download Button in single page.','pdf-embed-viewer') ?></span>
                            </div>
                            <div class="pdfev-metabox-field-control">
                                <label class="switch">
                                    <input type="checkbox" name="pdfev_meta_download" value="<?php echo esc_attr($check_download); ?>" <?php echo esc_attr(($check_download=='yes')?'checked':''); ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="pdfev-metabox-field">
                            <div class="pdfev-metabox-field-label">
                                <p><?php echo esc_html__( 'Right-to-Left Reading', 'pdf-embed-viewer' )?></p>
                                <span><?php echo esc_html__('Turn on for RTL-language documents (Arabic, Hebrew, etc.) so pages flip right-to-left.','pdf-embed-viewer') ?></span>
                            </div>
                            <div class="pdfev-metabox-field-control">
                                <label class="switch">
                                    <input type="checkbox" name="pdfev_meta_rtl" value="<?php echo esc_attr($rtl); ?>" <?php echo esc_attr(($rtl=='yes')?'checked':''); ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

        <?php
    }

    public function save_featured_image($post_id,$image_data){
        if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
                $image_data = substr($image_data, strpos($image_data, ',') + 1);
                $type = strtolower($type[1]);

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) return;

                $image_data = base64_decode($image_data);
                if ($image_data === false) return;

                // Verify the decoded bytes are actually an image, not just a declared type.
                if (@getimagesizefromstring($image_data) === false) return;

                // Save to uploads folder
                $upload_dir = wp_upload_dir();
                $filename = 'pdfev-featured-' . time() . '.' . $type;
                $file_path = $upload_dir['path'] . '/' . $filename;

                file_put_contents($file_path, $image_data);

                // Create attachment
                $attachment = [
                    'post_mime_type' => 'image/' . $type,
                    'post_title'     => sanitize_file_name($filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ];

                $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                wp_update_attachment_metadata($attach_id, $attach_data);

                // Set as featured image
                set_post_thumbnail($post_id, $attach_id);
            }
    }

    public function save_post($post_id){

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( ! isset($_POST['post_type']) || $_POST['post_type'] !== 'pdfev_embed_viewer' ){
                return;
            }

            if( ! isset( $_POST['pdfev_emd_vwr_metabox_nonce'] )
                || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_metabox_nonce'] ) ) , 'pdfev_emd_vwr_metabox_nonce' )
            ){
                return;
            }

            if( ! current_user_can('edit_page',$post_id) || ! current_user_can('edit_post',$post_id) ){
                return;
            }

            if ( ! empty( $_POST['pdfev_featured_image'] ) ) {
                $image_data = $_POST['pdfev_featured_image'];
                $this->save_featured_image( $post_id, $image_data );
            }

            if( isset($_POST['action']) and $_POST['action']=='editpost' ){

                $file_url  = isset( $_POST['pdfev_meta_pdf_url'] ) ? sanitize_url($_POST['pdfev_meta_pdf_url']) : '';
                update_post_meta( $post_id, 'pdfev_meta_pdf_url', $file_url );

                $check_download  = isset( $_POST['pdfev_meta_download'] ) ? sanitize_text_field($_POST['pdfev_meta_download']) : 'no';
                update_post_meta( $post_id, 'pdfev_meta_download', $check_download );

                $rtl = isset( $_POST['pdfev_meta_rtl'] ) ? sanitize_text_field($_POST['pdfev_meta_rtl']) : 'no';
                update_post_meta( $post_id, 'pdfev_meta_rtl', $rtl );

                $filesize = isset( $_POST['pdfev_meta_filesize'] ) ? sanitize_text_field($_POST['pdfev_meta_filesize']) : '';
                update_post_meta( $post_id, 'pdfev_meta_filesize', $filesize );

                $total_pages = isset( $_POST['pdfev_meta_total_pages'] ) ? sanitize_text_field($_POST['pdfev_meta_total_pages']) : '';
                update_post_meta( $post_id, 'pdfev_meta_total_pages', $total_pages );

            }
        }
}

new \PDFEV\Metabox_General();
