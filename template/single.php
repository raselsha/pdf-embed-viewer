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
<?php $pdf_emd_vwr_file_url = get_post_meta( get_the_ID(), 'pdfev_meta_pdf_url', true ); ?>
<div class="pdfev-embed-viewer">
	<h1><?php the_title();?></h1>
	<?php
		$check_download  = get_post_meta( get_the_ID(), 'pdfev_meta_download', true );
		if($check_download == 'yes'):
	?>
	<p><a href="<?php echo esc_attr($pdf_emd_vwr_file_url); ?>" class="download-btn" download><?php the_time('F'); ?> | <?php the_time('Y'); ?> <img src="<?php echo esc_attr(PDFEV_Const_URL.'assets/images/download.svg'); ?>" alt="<?php echo esc_attr('download-icon','pdf-embed-viewer'); ?>"></a></p>
	<?php endif; ?>
	<iframe class="pdf-viewer" src="<?php echo esc_attr($pdf_emd_vwr_file_url); ?>" frameborder="0"></iframe>
	<div class="pagination">
		<?php previous_post_link('%link','&#8592;'.__('Previous','pdf-embed-viewer') ); ?>
		<?php next_post_link('%link',__('Next','pdf-embed-viewer').'&#8594;' ); ?>
	</div>
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

