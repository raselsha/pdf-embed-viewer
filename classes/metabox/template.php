<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDF_Emd_Vwr_Template') ){
    class PDF_Emd_Vwr_Template{
        public function __construct()
        {
            add_action('nav_tabs',array($this,'tabs'));
            add_action('tabs_content',array($this,'tabs_content'));
            add_action( 'save_post' , array( $this, 'save_post') );
        }

        public function tabs($post_id){
            ?>
                <li class="pdf-emd-vwr-tab" data-tab-target="#pdf-emd-vwr-tabs2"><i class="fas fa-money-check"></i><?php echo esc_html('Template','pdf-embed-viewer'); ?></li>
            <?php
        }

        public function tabs_content($post_id){
            ?>
            <div class="pdf-emd-vwr-tab-content" id="pdf-emd-vwr-tabs2">
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html( 'Single Page Download', 'pdf-embed-viewer' )?></p>
                            <span><?php echo esc_html('Show/Hide download Button in single page.','pdf-embed-viewer') ?></span>

                        </div>
                        <select name="pdf_emd_vwr_template">
                            <option value="">Yearly</option>
                            <option value="">List</option>
                            <option value="">Grid</option>
                        </select>
                    </label>
                </section>
            </div>
            <?php
        }

        public function save_post($post_id){

                if( isset( $_POST['pdf_emd_vwr_metabox_nonce'] ) ){
                    if( ! wp_verify_nonce( $_POST['pdf_emd_vwr_metabox_nonce'], 'pdf_emd_vwr_metabox_nonce' ) ){
                        return;
                    }
                }

                if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                    return;
                }

                if( isset($_POST['post_type']) && $_POST['post_type'] === 'pdf-embed-viewer' ){
                    if( ! current_user_can('edit_page',$post_id) ){
                        return;
                    }
                    elseif( ! current_user_can('edit_post',$post_id) ){
                        return;
                    }
                }   

                if( isset($_POST['action']) and $_POST['action']=='editpost' ){                    

                    $template  = isset( $_POST['pdf_emd_vwr_template'] ) ? $_POST['pdf_emd_vwr_template'] : '';
					update_post_meta( $post_id, 'pdf_emd_vwr_template', sanitize_url($template) );

                }
            }
    }
    $PDF_Emd_Vwr_Template = new PDF_Emd_Vwr_Template();
}