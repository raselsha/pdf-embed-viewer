<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @edition 1.0.0
 */
namespace PDFEV;
defined('ABSPATH') || exit;
class Metabox_Book_Info{
    public function __construct()
    {
        add_action('pdfev_metabox_tabs',array($this,'tabs'));
        add_action('pdfev_metabox_tabs_content',array($this,'tabs_content'));
        add_action( 'save_post' , array( $this, 'save_post') );
    }
     public function tabs($post_id){
        ?>
            <li class="pdfev-tab " data-tab-target="pdfev-tabs-book-info"> <i class="fas fa-book-open"></i> <?php esc_html_e('Book Info','pdf-embed-viewer'); ?></li>
        <?php
    }
    public function tabs_content($post_id){
        $description = get_post_meta( $post_id, 'pdfev_meta_description', true );
        $published_year = get_post_meta( $post_id, 'pdfev_meta_published_year', true );
        $edition = get_post_meta( $post_id, 'pdfev_meta_edition', true );

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

        ?>
        <div class="pdfev-tab-content" data-tab="pdfev-tabs-book-info">
            <?php wp_nonce_field( 'pdfev_emd_vwr_metabox_nonce', 'pdfev_emd_vwr_metabox_nonce' ); ?>
            <h2 class="title"><?php _e('General Settings','pdf-embed-viewer'); ?></h2>
            <p><?php _e('Here you can add basic settings for your document.','pdf-embed-viewer'); ?></p>

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
                    <div class="">
                        <select name="pdfev_meta_author" id="pdfev_meta_author" class="">
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
                    <div class="">
                        <select name="pdfev_meta_publisher" id="pdfev_meta_publisher" class="">
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
                        <p><?php echo esc_html__( 'Published Year', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add the published year and edition for the PDF file.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="">
                        <input type="number" min="1000" max="2100" name="pdfev_meta_published_year" value="<?php echo esc_attr($published_year); ?>" placeholder="<?php echo esc_attr('2026'); ?>" class="pdfev-half-width">
                    </div>
                </label>
            </section>
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Published Edition', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add the published year and edition for the PDF file.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="">
                        <input type="text" name="pdfev_meta_edition" value="<?php echo esc_attr($edition); ?>" placeholder="<?php echo esc_attr('1.0'); ?>" class="pdfev-half-width">
                    </div>
                </label>
            </section>
        </div>

        <?php
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

            $description = isset( $_POST['pdfev_meta_description'] ) ? wp_kses_post( wp_unslash( $_POST['pdfev_meta_description'] ) ) : '';
            update_post_meta( $post_id, 'pdfev_meta_description', $description );

            $published_year = isset( $_POST['pdfev_meta_published_year'] ) ? sanitize_text_field($_POST['pdfev_meta_published_year']) : '';
            update_post_meta( $post_id, 'pdfev_meta_published_year', $published_year );

            $edition = isset( $_POST['pdfev_meta_edition'] ) ? sanitize_text_field($_POST['pdfev_meta_edition']) : '';
            update_post_meta( $post_id, 'pdfev_meta_edition', $edition );

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

new \PDFEV\Metabox_Book_Info();