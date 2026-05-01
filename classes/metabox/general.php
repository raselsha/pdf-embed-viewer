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
            <li class="pdfev-tab active" data-tab-target="pdfev-tabs-general"> <i class="fas fa-tools"></i> <?php esc_html_e('General','pdf-embed-viewer'); ?></li>
        <?php
    }
    public function tabs_content($post_id){
        $embed_file = \PDFEV_Functions::get_pdf_link();
        $embed_file =  $embed_file ? $embed_file :'';
        
        $check_download  = get_post_meta( $post_id, 'pdfev_meta_download', true );
        $check_download  = $check_download ? $check_download : 'yes';
        $description = get_post_meta( $post_id, 'pdfev_meta_description', true );
        $published_year = get_post_meta( $post_id, 'pdfev_meta_published_year', true );
        $version = get_post_meta( $post_id, 'pdfev_meta_version', true );
        $filesize = get_post_meta( $post_id, 'pdfev_meta_filesize', true );
        $total_pages = get_post_meta( $post_id, 'pdfev_meta_total_pages', true );

        $selected_author = 0;
        $author_terms = wp_get_post_terms( $post_id, 'pdfev_author', array( 'fields' => 'ids' ) );
        if ( ! empty( $author_terms ) ) {
            $selected_author = absint( $author_terms[0] );
        }

        $selected_publisher = 0;
        $publisher_terms = wp_get_post_terms( $post_id, 'pdfev_publisher', array( 'fields' => 'ids' ) );
        if ( ! empty( $publisher_terms ) ) {
            $selected_publisher = absint( $publisher_terms[0] );
        }

        $authors = get_terms( array( 'taxonomy' => 'pdfev_author', 'hide_empty' => false ) );
        $publishers = get_terms( array( 'taxonomy' => 'pdfev_publisher', 'hide_empty' => false ) );

        if ( has_post_thumbnail( $post_id ) ) {
            $thumbnail_url = get_the_post_thumbnail_url($post_id);
        }
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
                    <div class="pdfev-field-actions">
                        <code>
                            <?php echo esc_html('[pdfev_embed_viewer id="' . get_the_ID() . '"]') ?>
                        </code>
                    </div>
                </label>
            </section>
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Add PDF URL', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add pdf fle by upload button (Remote file url can be used if permitted)','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-field-control">
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
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Document Description', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add a description for this PDF document similar to the default editor.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-field-control pdfev-full-width">
                        <?php
                        wp_editor(
                            $description,
                            'pdfev_meta_description',
                            array(
                                'textarea_name' => 'pdfev_meta_description',
                                'textarea_rows' => 8,
                                'media_buttons' => false,
                                'teeny' => true,
                                'dfw' => false,
                            )
                        );
                        ?>
                    </div>
                </label>
            </section>
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Author', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Select an author. Author bio is stored as the author taxonomy term description.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-field-control">
                        <select name="pdfev_meta_author" id="pdfev_meta_author" class="pdfev-full-width">
                            <option value=""><?php esc_html_e('Select Author','pdf-embed-viewer'); ?></option>
                            <?php if ( ! is_wp_error( $authors ) && ! empty( $authors ) ) : foreach ( $authors as $author ) : ?>
                                <option value="<?php echo absint( $author->term_id ); ?>" <?php selected( $selected_author, $author->term_id ); ?>><?php echo esc_html( $author->name ); ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                </label>
            </section>
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Publisher', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Select a publisher for this PDF.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-field-control">
                        <select name="pdfev_meta_publisher" id="pdfev_meta_publisher" class="pdfev-full-width">
                            <option value=""><?php esc_html_e('Select Publisher','pdf-embed-viewer'); ?></option>
                            <?php if ( ! is_wp_error( $publishers ) && ! empty( $publishers ) ) : foreach ( $publishers as $publisher ) : ?>
                                <option value="<?php echo absint( $publisher->term_id ); ?>" <?php selected( $selected_publisher, $publisher->term_id ); ?>><?php echo esc_html( $publisher->name ); ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                </label>
            </section>
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Published Year + Version', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add the published year and version for the PDF file.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-field-control pdfev-inline-fields">
                        <input type="number" min="1900" max="2100" name="pdfev_meta_published_year" value="<?php echo esc_attr($published_year); ?>" placeholder="<?php echo esc_attr('2026'); ?>" class="pdfev-half-width">
                        <input type="text" name="pdfev_meta_version" value="<?php echo esc_attr($version); ?>" placeholder="<?php echo esc_attr('1.0'); ?>" class="pdfev-half-width">
                    </div>
                </label>
            </section>
            <section class="pdfev-preview-area">
                
                <div class="pdfev-featured-image-area">
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Preview Featured Image', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Select any image to set as thumbnail from right.','pdf-embed-viewer') ?></span>
                        </div>
                    </label>
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
            </section>
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
            
            if ( ! empty( $_POST['pdfev_featured_image'] ) ) {
                $image_data = $_POST['pdfev_featured_image'];
                $this->save_featured_image( $post_id, $image_data );
            }
            
            if( isset($_POST['action']) and $_POST['action']=='editpost' ){                    

                $file_url  = isset( $_POST['pdfev_meta_pdf_url'] ) ? sanitize_url($_POST['pdfev_meta_pdf_url']) : '';
                update_post_meta( $post_id, 'pdfev_meta_pdf_url', $file_url );
                
                $check_download  = isset( $_POST['pdfev_meta_download'] ) ? sanitize_text_field($_POST['pdfev_meta_download']) : 'no';
                update_post_meta( $post_id, 'pdfev_meta_download', $check_download );

                $description = isset( $_POST['pdfev_meta_description'] ) ? wp_kses_post( wp_unslash( $_POST['pdfev_meta_description'] ) ) : '';
                update_post_meta( $post_id, 'pdfev_meta_description', $description );

                $published_year = isset( $_POST['pdfev_meta_published_year'] ) ? sanitize_text_field($_POST['pdfev_meta_published_year']) : '';
                update_post_meta( $post_id, 'pdfev_meta_published_year', $published_year );

                $version = isset( $_POST['pdfev_meta_version'] ) ? sanitize_text_field($_POST['pdfev_meta_version']) : '';
                update_post_meta( $post_id, 'pdfev_meta_version', $version );

                $filesize = isset( $_POST['pdfev_meta_filesize'] ) ? sanitize_text_field($_POST['pdfev_meta_filesize']) : '';
                update_post_meta( $post_id, 'pdfev_meta_filesize', $filesize );

                $total_pages = isset( $_POST['pdfev_meta_total_pages'] ) ? sanitize_text_field($_POST['pdfev_meta_total_pages']) : '';
                update_post_meta( $post_id, 'pdfev_meta_total_pages', $total_pages );

                $author_term = isset( $_POST['pdfev_meta_author'] ) ? absint( $_POST['pdfev_meta_author'] ) : 0;
                if ( $author_term ) {
                    wp_set_object_terms( $post_id, $author_term, 'pdfev_author' );
                } else {
                    wp_set_object_terms( $post_id, array(), 'pdfev_author' );
                }

                $publisher_term = isset( $_POST['pdfev_meta_publisher'] ) ? absint( $_POST['pdfev_meta_publisher'] ) : 0;
                if ( $publisher_term ) {
                    wp_set_object_terms( $post_id, $publisher_term, 'pdfev_publisher' );
                } else {
                    wp_set_object_terms( $post_id, array(), 'pdfev_publisher' );
                }
            }
        }
}

new \PDFEV\Metabox_General();
