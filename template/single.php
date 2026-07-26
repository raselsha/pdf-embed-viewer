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
echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]');
get_footer();
