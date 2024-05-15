<?php

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('SH_PDF_Embed_Viewer_General') ){
    class SH_PDF_Embed_Viewer_General{
        public function __construct()
        {
            add_action('nav_tabs',array($this,'tabs'));
            add_action('tabs_content',array($this,'tabs_content'));
            add_action( 'save_post' , array( $this, 'save_post') );
        }
        public function tabs($post_id){
            ?>
                <li ><a href="#tabs-1">Link</a></li>
                <li ><a href="#tabs-2">Link</a></li>
            <?php
        }
        public function tabs_content($post_id){
            $embed_file = get_post_meta($post_id,'sh_pdf_embed_file',true);
            $embed_file =  $embed_file ? $embed_file :'';
            ?>
            <div id="tabs-1">
                <table  cellspacing="5">
                    <input type="hidden" name="sh_pdf_embed_nonce" value="<?php echo wp_create_nonce("sh_pdf_embed_nonce"); ?>">
                    <tr>
                        <td>
                            <label >
                                <?php _e( 'Add PDF URL', 'pdf-embed-viewer' )?>
                                <span><input type="url" class="form-control border" name="sh_pdf_embed_file" value="<?php echo esc_attr( $embed_file ) ? esc_url($embed_file) : '#' ;  ?>" placeholder="https://example.com/file-name.pdf" required></span>
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-2">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum possimus laudantium tempore suscipit. Accusamus voluptatem, nam distinctio voluptate deleniti perspiciatis, ratione maiores quidem eligendi enim, vitae architecto tenetur delectus fuga.
            </div>
            <?php
        }

        public function save_post($post_id){

                if( isset( $_POST['sh_pdf_embed_nonce'] ) ){
                    if( ! wp_verify_nonce( $_POST['sh_pdf_embed_nonce'], 'sh_pdf_embed_nonce' ) ){
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
                    $old_data = get_post_meta($post_id,'sh_pdf_embed_file',true);
                    $new_data = $_POST['sh_pdf_embed_file'];

                    update_post_meta($post_id,'sh_pdf_embed_file',sanitize_url($new_data), $old_data);
                }
            }
    }
    
    $AB_Enque = new SH_PDF_Embed_Viewer_General();
}