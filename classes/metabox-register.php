<?php


if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDFEV_Embed_Viewer_Metabox')){
        class PDFEV_Embed_Viewer_Metabox{
            public function __construct(){
                add_action('admin_init',[$this,'metabox']);
            }

            public function metabox(){

                add_meta_box('pdfev-embed-viewer',__('PDF Embed Settings', 'pdf-embed-viewer' ),[$this,'meta_box_layout'],'PDFEV_Embed_Viewer','normal','high');
            }

            public function meta_box_layout($post){
                $post_id = $post->ID;
            ?>
                <main class="pdfev-embed-viewer" id="pdfev-embed-metabox-tabs">
                    <aside>
                        <ul>
                            <?php do_action('pdfev_emd_vwr_actn_nav_tabs',$post_id); ?>
                        </ul>
                    </aside>
                    <div class="content">
                        <?php do_action('pdfev_emd_vwr_actn_tabs_content',$post_id); ?>
                    </div>
                </main>
            <?php
            }           
        }
        $PDFEV_Embed_Viewer_Metabox = new PDFEV_Embed_Viewer_Metabox();
    }