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
            <li class="pdfev-tab" data-tab-target="pdfev-tabs-template"> <i class="fas fa-book-open"></i> <?php esc_html_e('Template','pdf-embed-viewer'); ?></li>
        <?php
    }
    public function tabs_content($post_id){
        
        ?>
        <div class="pdfev-tab-content" data-tab="pdfev-tabs-template">
            <h2 class="title"><?php _e('Template Settings','pdf-embed-viewer'); ?></h2>
            <p><?php _e('Here you can set tempate for the document in single view','pdf-embed-viewer'); ?></p>
            
            <section>
                <label class="label">
                    <div>
                        <p><?php echo esc_html__( 'Template', 'pdf-embed-viewer' )?></p>
                        <span><?php echo esc_html__('Select Tempate','pdf-embed-viewer') ?></span>
                    </div>
                    <div style="width: 50%; text-align:right;">
                        <select name="pdfev_meta_template" id="">
                            <option value="flipbook"><?php echo esc_html('Flipbook') ?></option>
                            <!-- <option value="traditional"><?php echo esc_html('Traditional') ?></option> -->
                        </select>
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

                $file_url  = isset( $_POST['pdfev_meta_pdf_url'] ) ? sanitize_url($_POST['pdfev_meta_pdf_url']) : '';
                update_post_meta( $post_id, 'pdfev_meta_pdf_url', $file_url );
                
                $check_download  = isset( $_POST['pdfev_meta_download'] ) ? sanitize_text_field($_POST['pdfev_meta_download']) : 'no';
                update_post_meta( $post_id, 'pdfev_meta_download', $check_download );
            }
        }
}

new \PDFEV\Metabox_Template();
