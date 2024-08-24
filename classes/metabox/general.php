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
            add_action('pdfev_emd_vwr_actn_nav_tabs',array($this,'tabs'));
            add_action('pdfev_emd_vwr_actn_tabs_content',array($this,'tabs_content'));
            add_action( 'save_post' , array( $this, 'save_post') );
        }
        public function tabs($post_id){
            ?>
                <li class="pdfev-emd-vwr-tab active" data-tab-target="#pdfev-emd-vwr-tabs-general"> <i class="fas fa-tools"></i> <?php esc_html_e('General','pdf-embed-viewer'); ?></li>
            <?php
        }
        public function tabs_content($post_id){
            $embed_file = get_post_meta($post_id,'pdfev_emd_vwr_file_url',true);
            $embed_file =  $embed_file ? $embed_file :'';
            
            $check_download  = get_post_meta( $post_id, 'pdfev_emd_vwr_check_download', true );
            $check_download  = $check_download ? $check_download : 'yes';
            ?>
            <div class="pdfev-emd-vwr-tab-content" id="pdfev-emd-vwr-tabs-general">
                <?php wp_nonce_field( 'pdfev_emd_vwr_metabox_nonce', 'pdfev_emd_vwr_metabox_nonce' ); ?>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html__( 'Add PDF URL', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html__('Add pdf file by upload button','pdf-embed-viewer') ?></span>
                        </div>
                        <div style="width: 50%;">
                            <input type="url" class="pdfev-emd-vwr-file" name="pdfev_emd_vwr_file_url" value="<?php echo $embed_file ? esc_attr($embed_file) : '' ;  ?>" placeholder="<?php echo esc_attr('https://example.com/filename.pdf'); ?>" required>
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
                            <input type="checkbox" name="pdfev_emd_vwr_check_download" value="<?php echo esc_attr($check_download); ?>" <?php echo esc_attr(($check_download=='yes')?'checked':''); ?>>
                            <span class="slider"></span>
                        </label>
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

                    $file_url  = isset( $_POST['pdfev_emd_vwr_file_url'] ) ? sanitize_url($_POST['pdfev_emd_vwr_file_url']) : '';
					update_post_meta( $post_id, 'pdfev_emd_vwr_file_url', $file_url );
                    
                    $check_download  = isset( $_POST['pdfev_emd_vwr_check_download'] ) ? sanitize_text_field($_POST['pdfev_emd_vwr_check_download']) : 'no';
					update_post_meta( $post_id, 'pdfev_emd_vwr_check_download', $check_download );
                }
            }
    }
    
    $PDFEV_Metabox_General = new PDFEV_Metabox_General();
}