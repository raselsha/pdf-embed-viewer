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
            <li class="pdfev-tab" data-tab-target="pdfev-tabs-book-info">
                <span class="dashicons dashicons-book" aria-hidden="true"></span>
                <?php esc_html_e('E-Book Info','pdf-embed-viewer'); ?>
            </li>
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
            <div class="pdfev-metabox-section-header">
                <h2><?php _e('Book Information Settings','pdf-embed-viewer'); ?></h2>
                <p><?php _e('Here you can add book\'s author, publisher and other information.','pdf-embed-viewer'); ?></p>
            </div>
            <div class="pdfev-metabox-section-body">
                <div class="pdfev-metabox-field pdfev-metabox-field--stacked">
                    <div class="pdfev-metabox-field-label">
                        <p><?php echo esc_html__( 'Document Description', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add a description for this PDF document similar to the default editor.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control">
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
                </div>
                <div class="pdfev-metabox-field">
                    <div class="pdfev-metabox-field-label">
                        <p><?php echo esc_html__( 'Author', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Select an author. Author bio is stored as the author taxonomy term description.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control">
                        <?php
                        $author_options = array();
                        if ( ! is_wp_error( $authors ) && ! empty( $authors ) ) {
                            foreach ( $authors as $author ) {
                                $author_options[ $author->term_id ] = $author->name;
                            }
                        }
                        $this->render_custom_select( 'pdfev_meta_author', 'pdfev_meta_author', $author_options, $selected_author ?: '', __( 'Select Author', 'pdf-embed-viewer' ) );
                        ?>
                    </div>
                </div>
                <div class="pdfev-metabox-field">
                    <div class="pdfev-metabox-field-label">
                        <p><?php echo esc_html__( 'Publisher', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Select a publisher for this PDF.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control">
                        <?php
                        $publisher_options = array();
                        if ( ! is_wp_error( $publishers ) && ! empty( $publishers ) ) {
                            foreach ( $publishers as $publisher ) {
                                $publisher_options[ $publisher->term_id ] = $publisher->name;
                            }
                        }
                        $this->render_custom_select( 'pdfev_meta_publisher', 'pdfev_meta_publisher', $publisher_options, $selected_publisher ?: '', __( 'Select Publisher', 'pdf-embed-viewer' ) );
                        ?>
                    </div>
                </div>
                <div class="pdfev-metabox-field">
                    <div class="pdfev-metabox-field-label">
                        <p><?php echo esc_html__( 'Published Year', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add the published year and edition for the PDF file.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control">
                        <input type="number" min="1000" max="2100" name="pdfev_meta_published_year" value="<?php echo esc_attr($published_year); ?>" placeholder="<?php echo esc_attr('2026'); ?>">
                    </div>
                </div>
                <div class="pdfev-metabox-field">
                    <div class="pdfev-metabox-field-label">
                        <p><?php echo esc_html__( 'Published Edition', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Add the published year and edition for the PDF file.','pdf-embed-viewer') ?></span>
                    </div>
                    <div class="pdfev-metabox-field-control">
                        <input type="text" name="pdfev_meta_edition" value="<?php echo esc_attr($edition); ?>" placeholder="<?php echo esc_attr('1.0'); ?>">
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    /**
     * Same visually-hidden-native-<select>-plus-styled-listbox pattern as
     * General_Settings::render_custom_select() on the settings page — kept
     * as its own copy here (not shared across those two classes) since the
     * metabox and settings page already each define their own local design
     * tokens (--pdfev-mb- vs --pdfev-admin- prefixed custom properties)
     * rather than sharing one scope, and the open/close/select JS behavior
     * is already delegated globally in admin.js, so no metabox-specific JS
     * is needed either.
     */
    private function render_custom_select( $id, $name, $options, $selected = '', $placeholder = '' ) {
        $selected_label = $placeholder;
        foreach ( $options as $value => $label ) {
            if ( (string) $value === (string) $selected ) {
                $selected_label = $label;
                break;
            }
        }
        ?>
        <div class="pdfev-select">
            <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" class="pdfev-select-native">
                <?php if ( $placeholder !== '' ) : ?>
                <option value=""><?php echo esc_html( $placeholder ); ?></option>
                <?php endif; ?>
                <?php foreach ( $options as $value => $label ) : ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( (string) $value, (string) $selected ); ?>><?php echo esc_html( $label ); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="pdfev-select-trigger" aria-haspopup="listbox" aria-expanded="false">
                <span class="pdfev-select-value"><?php echo esc_html( $selected_label ); ?></span>
                <span class="dashicons dashicons-arrow-down-alt2" aria-hidden="true"></span>
            </button>
            <ul class="pdfev-select-options" role="listbox" hidden>
                <?php if ( $placeholder !== '' ) : ?>
                <li role="option" data-value="" <?php echo ( (string) $selected === '' ) ? 'aria-selected="true"' : ''; ?>><?php echo esc_html( $placeholder ); ?></li>
                <?php endif; ?>
                <?php foreach ( $options as $value => $label ) : ?>
                <li role="option" data-value="<?php echo esc_attr( $value ); ?>" <?php echo ( (string) $value === (string) $selected ) ? 'aria-selected="true"' : ''; ?>><?php echo esc_html( $label ); ?></li>
                <?php endforeach; ?>
            </ul>
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