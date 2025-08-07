<?php

/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.0
 */
namespace PDFEV;

defined('ABSPATH') || exit;

class Metabox_Categories{
    public function __construct()
    {
        add_action('pdfev_metabox_tabs',array($this,'tabs'));
        add_action('pdfev_metabox_tabs_content',array($this,'tabs_content'));
        add_action( 'save_post' , array( $this, 'save_post') );
    }

    public function tabs($post_id){
        ?>
            <li class="pdfev-tab" data-tab-target="pdfev-tabs-categories"> <i class="fas fa-list"></i> <?php esc_html_e('Categories','pdf-embed-viewer'); ?></li>
        <?php
    }

    public function tabs_content($post_id){
        $categories = get_post_meta($post_id, 'pdfev_meta_categories', true);
        $categories = is_array($categories) ? $categories : ( $categories ? (array)$categories : [] );
        $all_categories = get_terms( array(
            'taxonomy'   => 'pdfev_category',
            'hide_empty' => false,
        ) );
        ?>
        <div class="pdfev-tab-content" data-tab="pdfev-tabs-categories">
            <h2 class="title"><?php _e('Category Settings','pdf-embed-viewer'); ?></h2>
            <p><?php _e('Here you can set categories','pdf-embed-viewer'); ?></p>
            <section>
                <div id="pdfev-meta-categories">
                    <?php foreach ( $all_categories as $cats ) : ?>
                        <label>
                            <input type="checkbox" name="pdfev_meta_categories[]" value="<?php echo esc_attr( $cats->term_id ); ?>" <?php checked( in_array( $cats->term_id, $categories ) ); ?>>
                            <?php echo esc_html( $cats->name ); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
        <?php
    }

    public function save_post($post_id){
        // Check for autosave, permissions, etc. as needed
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
        if ( ! isset( $_POST['pdfev_meta_categories'] ) ) {
            delete_post_meta( $post_id, 'pdfev_meta_categories' );
            return;
        }
        $categories = array_map( 'intval', (array) $_POST['pdfev_meta_categories'] );
        update_post_meta( $post_id, 'pdfev_meta_categories', $categories );
    }
}

new \PDFEV\Metabox_Categories();