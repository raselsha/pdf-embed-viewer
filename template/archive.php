<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template single page
 * To customize single page tempalale; you can copy this template folder to your theme directory. 
 * If you used child theme, put into parent direcotory first.
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
    <?php
        $template = get_option('pdfev_archive_template'); 
        $load_template = $template.'.php';
        require PDFEV_Functions::load_template($load_template);  
    ?>
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

