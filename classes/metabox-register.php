<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.5
 */
namespace PDFEV;

defined('ABSPATH') || exit;
class Metabox{
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
                    <?php do_action('pdfev_metabox_tabs',$post_id); ?>
                </ul>
            </aside>
            <div class="content">
                <?php do_action('pdfev_metabox_tabs_content',$post_id); ?>
            </div>
        </main>
    <?php
    }           
}
new \PDFEV\Metabox();
    