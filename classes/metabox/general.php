<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Metabox_General') ){
    class PDFEV_Metabox_General{
        public function __construct()
        {
            add_action('pdfev_metabox_tabs',array($this,'tabs'));
            add_action('pdfev_metabox_tabs_content',array($this,'tabs_content'));
            add_action( 'save_post' , array( $this, 'save_post') );
            add_action( 'wp_ajax_pdfev_save_featured_image' , array( $this, 'save_featured_image') );
        }
        public function tabs($post_id){
            ?>
                <li class="pdfev-tab active" data-tab-target="pdfev-tabs-general"> <i class="fas fa-tools"></i> <?php esc_html_e('General','pdf-embed-viewer'); ?></li>
            <?php
        }
        public function tabs_content($post_id){
            $embed_file = get_post_meta($post_id,'pdfev_meta_pdf_url',true);
            $embed_file =  $embed_file ? $embed_file :'';
            
            $check_download  = get_post_meta( $post_id, 'pdfev_meta_download', true );
            $check_download  = $check_download ? $check_download : 'yes';
            ?>
            <div class="pdfev-tab-content active" data-tab="pdfev-tabs-general">
                <?php wp_nonce_field( 'pdfev_emd_vwr_metabox_nonce', 'pdfev_emd_vwr_metabox_nonce' ); ?>
                <h2 class="title"><?php _e('General Settings','pdf-embed-viewer'); ?></h2>
                <p><?php _e('Here you can add basic settings for your document.','pdf-embed-viewer'); ?></p>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Shortcode', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Add this shortcode to any page or post to view pdf','pdf-embed-viewer') ?></span>
                        </div>
                        <div style="width: 50%; text-align:right;">
                            <code>
                                <?php echo esc_html('[pdfev_embed_viewer id="'.get_the_ID().'"]') ?>
                            </code>
                        </div>
                    </label>
                </section>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Add PDF URL', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Add pdf file by upload button','pdf-embed-viewer') ?></span>
                        </div>
                        <div style="width: 50%;">
                            <input type="url" class="pdfev-emd-vwr-file" name="pdfev_meta_pdf_url" value="<?php echo $embed_file ? esc_attr($embed_file) : '' ;  ?>" placeholder="<?php echo esc_attr('https://example.com/filename.pdf'); ?>" required>
                            <button class='button pdfev-emd-vwr-upload'>
                                <i class="fa fa-paperclip" aria-hidden="true"></i> <?php esc_html_e('Upload','pdf-embed-viewer');?>
                            </button>
                        </div>
                    </label>
                </section>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Download Button', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Show/Hide download Button in single page.','pdf-embed-viewer') ?></span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="pdfev_meta_download" value="<?php echo esc_attr($check_download); ?>" <?php echo esc_attr(($check_download=='yes')?'checked':''); ?>>
                            <span class="slider"></span>
                        </label>
                    </label>
                </section>
                <section id="pdfev-featured-image-area">
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Preview Featured Image', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Show/Hide download Button in single page.','pdf-embed-viewer') ?></span>
                        </div>
                        <input type="hidden" id="pdfev-featured-image-data" name="pdfev_featured_image">
                        <img id="pdfev-featured-image-preview" src="" style="max-width: 200px; display:none;">
                        <button id="pdfev-upload-save" class="btn button">Set Fetured Image</button>
                    </label>
                </section>
                <section id="pdfev-preview">
                </section>
            </div>

            <?php
        }

        public function save_featured_image(){
            if (!current_user_can('edit_posts')) {
                wp_send_json_error('Permission denied');
            }

            $image_data = $_POST['image_data'] ?? '';
            $post_id = intval($_POST['post_id'] ?? 0);

            if (!$image_data || !$post_id) {
                wp_send_json_error('Missing data');
            }

            // Parse the base64 image
            if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
                $image_data = substr($image_data, strpos($image_data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    wp_send_json_error('Invalid image type');
                }

                $image_data = base64_decode($image_data);
                if ($image_data === false) {
                    wp_send_json_error('Base64 decode failed');
                }
            } else {
                wp_send_json_error('Invalid image data format');
            }

            // Save image to WordPress uploads folder
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

            wp_send_json_success(['attachment_id' => $attach_id]);
        }
        public function save_post($post_id){

                if( isset( $_POST['pdfev_emd_vwr_metabox_nonce'] ) ){
                    if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['pdfev_emd_vwr_metabox_nonce'] ) ) , 'pdfev_emd_vwr_metabox_nonce' ) ){
                        return;
                    }
                }

                if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                    return;
                }

                if( isset($_POST['post_type']) && $_POST['post_type'] === 'pdfev_embed_viewer' ){
                    if( ! current_user_can('edit_page',$post_id) ){
                        return;
                    }
                    elseif( ! current_user_can('edit_post',$post_id) ){
                        return;
                    }
                }   

                if( isset($_POST['action']) and $_POST['action']=='editpost' ){                    

                    $file_url  = isset( $_POST['pdfev_meta_pdf_url'] ) ? sanitize_url($_POST['pdfev_meta_pdf_url']) : '';
					update_post_meta( $post_id, 'pdfev_meta_pdf_url', $file_url );
                    
                    $check_download  = isset( $_POST['pdfev_meta_download'] ) ? sanitize_text_field($_POST['pdfev_meta_download']) : 'no';
					update_post_meta( $post_id, 'pdfev_meta_download', $check_download );
                }
            }
    }
    
    $PDFEV_Metabox_General = new PDFEV_Metabox_General();
}