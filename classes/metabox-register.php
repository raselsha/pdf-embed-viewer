<?php


if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('PDF_Emd_Vwr_Metabox')){
        class PDF_Emd_Vwr_Metabox{
            public function __construct(){
                add_action('admin_init',[$this,'metabox']);
            }

            public function metabox(){

                add_meta_box('pdf-embed-viewer',__('PDF Embed Settings', 'pdf-embed-viewer' ),[$this,'meta_box_layout'],'pdf-embed-viewer','normal','high');
            }

            public function meta_box_layout($post){
                $post_id = $post->ID;
            ?>
                <main class="pdf-embed-viewer" id="pdf-embed-metabox-tabs">
                    <aside>
                        <ul>
                            <?php do_action('nav_tabs',$post_id); ?>
                        </ul>
                    </aside>
                    <div class="content">
                        <?php do_action('tabs_content',$post_id); ?>
                    </div>
                </main>
            <?php
            }           
        }
        $PDF_Emd_Vwr_Metabox = new PDF_Emd_Vwr_Metabox();
    }