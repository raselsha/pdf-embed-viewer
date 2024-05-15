<?php


if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('SH_PDF_Embed_Viewer_Metabox')){
        class SH_PDF_Embed_Viewer_Metabox{
            public function __construct(){
                add_action('admin_init',[$this,'metabox']);
            }

            public function metabox(){
                add_meta_box( 'cmb_meta', 'title', [$this, 'create_metabox'], 'post' );
                add_meta_box('pdf-embed-viewer',__('PDF Embed Settings', 'pdf-embed-viewer' ),[$this,'meta_box_layout'],'pdf-embed-viewer','normal','high');
            }

            public function meta_box_layout($post){
                $post_id = $post->ID;
            ?>
                <main class="metabox">
                    <div id="tabs">
                        <aside>
                            <ul>
                                <?php do_action('nav_tabs',$post_id); ?>
                            </ul>
                        </aside>
                        <div>
                            <?php do_action('tabs_content',$post_id); ?>
                        </div>
                    </div>
                </main>
                <script>
                   jQuery (document).ready(function($){
                        $( "#tabs" ).tabs({ orientation: "vertical" });
                    });
                </script>
            <?php
            }           
        }
        $SH_PDF_Embed_Viewer_Metabox = new SH_PDF_Embed_Viewer_Metabox();
    }