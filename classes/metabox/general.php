<?php

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDF_Emd_Vwr_General') ){
    class PDF_Emd_Vwr_General{
        public function __construct()
        {
            add_action('nav_tabs',array($this,'tabs'));
            add_action('tabs_content',array($this,'tabs_content'));
            add_action( 'save_post' , array( $this, 'save_post') );
        }
        public function tabs($post_id){
            ?>
                <li class="tab active" data-tab-target="#pdf_emd_vwr_tabs1"> <i class="fas fa-home"></i> Home</li>
            <?php
        }
        public function tabs_content($post_id){
            $embed_file = get_post_meta($post_id,'pdf_emd_vwr_file_url',true);
            $check_download = get_post_meta($post_id,'pdf_emd_vwr_check_download',true);
            $embed_file =  $embed_file ? $embed_file :'';
            $check_download =  $check_download ? $check_download :'yes';
            ?>
            <div class="tab-content active" id="#pdf_emd_vwr_tabs1">
                <?php wp_nonce_field( 'pdf_emd_vwr_metabox_nonce', 'pdf_emd_vwr_metabox_nonce' ); ?>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html( 'Add PDF URL', 'pdf-embed-viewer' )?></p>
                            <span>info text</span>
                        </div>
                        <div style="width: 50%;">
                            <input type="url" class="pdf_emd_vwr_file" name="pdf_emd_vwr_file_url" value="<?php echo esc_attr( $embed_file ) ? esc_attr($embed_file) : '' ;  ?>" placeholder="https://example.com/filename.pdf" required>
                            <button class='button upload'>
                                <i class="fa fa-paperclip" aria-hidden="true"></i> <?php esc_attr_e('Upload','pdf-embed-viewer');?>
                            </button>
                        </div>
                    </label>
                </section>
                <section>
                    <label class="label">
                        <div>
                            <p><?php echo esc_html( 'Show/Hide Download button', 'pdf-embed-viewer' )?></p>
                            <span>Info</span>
                        </div>
                        <label class="switch"  >
                            <input type="checkbox" name="pdf_emd_vwr_check_download" value="<?php echo esc_attr($check_download); ?>" <?php echo esc_attr(($check_download=='yes')?'checked':''); ?>>
                            <span class="slider"></span>
                        </label>
                    </label>
                </section>
                <script>
                    function toggleButton(input){        
                        var status = jQuery(this).find('input[type="checkbox"]').attr('name');           
                         jQuery('input[name=pdf_emd_vwr_check_download]').click(function(){
                            var status = jQuery(this).val();
                            if(status == 'yes') {
                                jQuery(this).val('no');
                            }  
                            if(status == 'no') {
                                jQuery(this).val('yes');
                            }
                        });
                    }
			</script>
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
                    $old_data = get_post_meta($post_id,'pdf_emd_vwr_file_url',true);
                    $new_data = $_POST['pdf_emd_vwr_file_url'];

                    update_post_meta($post_id,'pdf_emd_vwr_file_url',sanitize_url($new_data), $old_data);
                }
            }
    }
    
    $AB_Enque = new PDF_Emd_Vwr_General();
}