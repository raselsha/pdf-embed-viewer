<?php if ( wp_is_block_theme() ) {  ?>
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
<?php $pdf_emd_vwr_file_url = get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true ); ?>
<div class="pdf-embed-viewer">
	<h1><?php the_title();?></h1>
	<p><a href="<?php esc_attr_e($pdf_emd_vwr_file_url); ?>" class="download-btn" download><?php the_time('F'); ?> | <?php the_time('Y'); ?> <img src="<?php esc_attr_e(PDF_Emd_Vwr_URL.'assets/images/download.svg'); ?>" alt="<?php _e('download-icon','pdf-embed-viewer'); ?>"></a></p>
	<iframe class="pdf-viewer" src="<?php esc_attr_e($pdf_emd_vwr_file_url); ?>" frameborder="0"></iframe>
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

