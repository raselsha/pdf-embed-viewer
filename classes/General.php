<?php

if( ! defined('ABSPATH') ) { die( "don't access directly" ); }

if( ! class_exists('SH_PDF_Embed_Viewer_General') ){
    class SH_PDF_Embed_Viewer_General{
        public function __construct()
        {
            add_action('nav_tabs',array($this,'tabs'));
            add_action('tabs_content',array($this,'tabs_content'));
        }
        public function tabs($post_id){
            ?>
                <li ><a href="#tabs-1">Link</a></li>
            <?php
        }
        public function tabs_content($post_id){
            ?>
            <div id="tabs-1">
                One Contents
            </div>
            <?php
        }
    }
    
    $AB_Enque = new SH_PDF_Embed_Viewer_General();
}