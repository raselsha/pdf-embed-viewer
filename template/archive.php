<?php
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template single page
 * To customize single page tempalale; you can copy this template folder to your theme directory.
 * If you used child theme, put into parent direcotory first.
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

// Classic (non-block) themes only — CPT::archive_template() in
// classes/cpt-register.php only routes here when wp_is_block_theme() is
// false, so plain get_header()/get_footer() is the theme's real, native
// header/footer here, not a compatibility shim.
get_header();

// Same Theme Builder hand-off as template/single.php, for "Archive" templates.
if ( ! ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'archive' ) ) ) {
    do_action( 'pdfev_template_archive_view' );
}

get_footer();
