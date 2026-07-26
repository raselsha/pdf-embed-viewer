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

if ( wp_is_block_theme() ) :
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wp-site-blocks">
    <?php echo do_blocks('<!-- wp:template-part {"slug":"header","tagName":"header"} /-->'); ?>

    <main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60)">
        <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
            <div class="pdfev-embed-viewer">
                <?php do_action('pdfev_template_single_header'); ?>
                <?php echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]'); ?>
                <?php do_action('pdfev_template_single_footer'); ?>
            </div>
        </div>
    </main>

    <?php echo do_blocks('<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->'); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>

<?php else : ?>

<?php get_header(); ?>

<div class="pdfev-embed-viewer">
    <?php do_action('pdfev_template_single_header'); ?>
    <?php echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]'); ?>
    <?php do_action('pdfev_template_single_footer'); ?>
</div>

<?php get_footer(); ?>
<?php endif; ?>
