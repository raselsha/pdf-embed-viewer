<?php
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template single page
 * To customize the archive page template, simply copy the /template/single.php file into your theme directory.
 */
if ( ! defined('ABSPATH') ) {
    die( "Don't access directly" );
}

// Classic (non-block) themes only — CPT::single_template() in
// classes/cpt-register.php only routes here when wp_is_block_theme() is
// false, so plain get_header()/get_footer() is the theme's real, native
// header/footer here, not a compatibility shim.
get_header();

// An Elementor-built layout (Theme Builder "Single" template, or the template
// picked in Settings → General) takes over the content area; the plugin's own
// layout only renders when there is none. See render_elementor_single().
if ( ! PDFEV_Functions::render_elementor_single() ) :
    ?>
<div class="pdfev-embed-viewer">
    <?php do_action('pdfev_template_single_header'); ?>
    <?php echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]'); ?>
    <?php do_action('pdfev_template_single_footer'); ?>
</div>
    <?php
endif;

get_footer();
