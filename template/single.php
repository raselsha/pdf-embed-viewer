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

get_header();
?>

<div class="pdfev-embed-viewer">
    <?php do_action('pdfev_template_single_header'); ?>
    <?php echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]'); ?>
    <?php do_action('pdfev_template_single_footer'); ?>
</div>

<?php
get_footer();
