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
<?php $pdfdownload_file = get_post_meta( get_the_ID(), 'pdfdownload_file', true ); ?>
<div class="pdf-download">
	<h1><?php the_title();?></h1>
	<p><a href="<?php esc_attr_e($pdfdownload_file); ?>" class="download-btn" download><?php the_time('F'); ?> | <?php the_time('Y'); ?> <img src="<?php esc_attr_e(PDF_DOWNLOAD_URL.'assets/images/download.svg'); ?>" alt="download-icon"></a></p>
	
	<iframe class="pdf-viewer" src="<?php esc_attr_e($pdfdownload_file); ?>" frameborder="0"></iframe>

	<div class="pagination">
		<?php previous_post_link('%link','&#8592; Previous Month' ); ?>
		<?php next_post_link('%link','Next Month &#8594;' ); ?>
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

