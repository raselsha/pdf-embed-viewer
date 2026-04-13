<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template single page
 * To customize the archive page template, simply copy the /template/single.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if ( wp_is_block_theme() ) {  ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	$block_content = do_blocks( '
		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
		<!-- wp:post-content /-->
		</div>
		<!-- /wp:group -->'
 	);
    wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wp-site-blocks">
<header class="wp-block-template-part site-header">
    <?php block_header_area(); ?>
</header>
</div>
<?php
} else {
    get_header();	
}
?>

<div class="pdfev-embed-viewer">

	<?php do_action('pdfev_template_single_header'); ?>
	<?php echo do_shortcode('[pdfev_embed_viewer id="' . get_the_ID() . '"]'); ?>
	<?php do_action('pdfev_template_single_footer'); ?>
	
</div>

<?php if ( wp_is_block_theme() ) : ?>
	<footer class="wp-block-template-part">
		<?php block_footer_area(); ?>
	</footer>
	<?php wp_footer(); ?>
</body>  

<?php else: ?>
	<?php get_footer(); ?>
<?php endif; ?>

