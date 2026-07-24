<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

namespace PDFEV;
defined('ABSPATH') || exit;
class Metabox_Template{
    public function __construct()
    {
        add_action('pdfev_metabox_tabs',array($this,'tabs'));
        add_action('pdfev_metabox_tabs_content',array($this,'tabs_content'));
        add_action( 'save_post' , array( $this, 'save_post') );
    }
    public function tabs($post_id){
        ?>
            <li class="pdfev-tab" data-tab-target="pdfev-tabs-template">
                <span class="dashicons dashicons-art" aria-hidden="true"></span>
                <?php esc_html_e('Template','pdf-embed-viewer'); ?>
            </li>
        <?php
    }
    public function tabs_content($post_id){

        ?>
        <div class="pdfev-tab-content" data-tab="pdfev-tabs-template">
            <div class="pdfev-metabox-section-header">
                <h2><?php _e('Template Settings','pdf-embed-viewer'); ?></h2>
                <p><?php _e('Here you can set tempate for the document in single view','pdf-embed-viewer'); ?></p>
            </div>
            <div class="pdfev-metabox-section-body">
                <div class="pdfev-metabox-group-body pdfev-metabox-fields-panel">
                    <div class="pdfev-metabox-field">
                        <div class="pdfev-metabox-field-label">
                            <p><?php echo esc_html__( 'Template', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Select Tempate','pdf-embed-viewer') ?></span>
                        </div>
                        <div class="pdfev-metabox-field-control">
                            <?php
                            $this->render_custom_select(
                                'pdfev_meta_template',
                                'pdfev_meta_template',
                                array( 'flipbook' => __( 'Flipbook', 'pdf-embed-viewer' ) ),
                                'flipbook'
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    /**
     * Same visually-hidden-native-<select>-plus-styled-listbox pattern as
     * General_Settings::render_custom_select() / Metabox_Book_Info's own
     * copy — kept separate per-class rather than shared, same reasoning as
     * that one: each screen defines its own local design tokens, and the
     * open/close/select JS behavior is already delegated globally in
     * admin.js, so no per-class JS is needed either.
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

                $file_url  = isset( $_POST['pdfev_meta_pdf_url'] ) ? sanitize_url($_POST['pdfev_meta_pdf_url']) : '';
                update_post_meta( $post_id, 'pdfev_meta_pdf_url', $file_url );
                
                $check_download  = isset( $_POST['pdfev_meta_download'] ) ? sanitize_text_field($_POST['pdfev_meta_download']) : 'no';
                update_post_meta( $post_id, 'pdfev_meta_download', $check_download );
            }
        }
}

new \PDFEV\Metabox_Template();
