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
                        <p><?php echo esc_html__( 'Add PDF URL', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add pdf fle by upload button (Remote file url can be used if permitted)','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control pdfev-metabox-field-control--inline">
                        <input type="url" class="pdfev-emd-vwr-file" name="pdfev_meta_pdf_url" value="<?php echo $embed_file ? esc_attr($embed_file) : '' ;  ?>" placeholder="<?php echo esc_attr('https://example.com/filename.pdf'); ?>" required>
                        <button class='button pdfev-emd-vwr-upload'>
                            <span class="dashicons dashicons-paperclip" aria-hidden="true"></span> <?php esc_html_e('Upload','pdf-embed-viewer');?>
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

                <div class="pdfev-metabox-preview-area">
                    <div class="pdfev-featured-image-area">
                        <div class="pdfev-metabox-field-label">
                            <p><?php echo esc_html__( 'Preview Featured Image', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Select any image to set as thumbnail from right.','pdf-embed-viewer') ?></span>
                        </div>
                        <div id="pdfev-featured-image" data-status="<?php echo isset($thumbnail_url)?'yes':'no';?>" data-url="<?php echo isset($thumbnail_url)?$thumbnail_url:'';?>">
                            <input type="hidden" id="pdfev-featured-image-data" name="pdfev_featured_image">
                            <input type="hidden" name="pdfev_meta_filesize" id="pdfev_meta_filesize" value="<?php echo esc_attr($filesize); ?>">
                            <input type="hidden" name="pdfev_meta_total_pages" id="pdfev_meta_total_pages" value="<?php echo esc_attr($total_pages); ?>">
                            <img id="pdfev-featured-image-preview" src="<?php echo esc_attr(isset($thumbnail_url)?$thumbnail_url:'');?>">
                            <div><?php _e('Document size: ','pdf-embed-viewer'); ?><strong class="pdfev-filesize"></strong></div>
                            <div><?php _e('Total Pages: ','pdf-embed-viewer'); ?><strong class="pdfev-totalpage"></strong></div>
                        </div>
                    </div>
                    <div id="pdfev-document-preview">
                        <div class="pdfev-loader-wrapper">
                            <div class="pdfev-spinner"></div>
                            <p><?php echo __('Loading preview...','pdf-embed-viewer') ?></p>
                        </div>
                        <p class="warning"><?php echo __('Failed to load preview. Please Upload a PDF.','pdf-embed-viewer') ?></p>
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
