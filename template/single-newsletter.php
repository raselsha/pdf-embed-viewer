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

<div class="container" >
	<h4><?php the_title();?></h4>
	<p><a href="<?php esc_html_e(get_post_meta( get_the_ID(), 'newsletter_file', true )); ?>" class="btn btn-primary btn-sm" download><?php the_time('F'); ?> | <?php the_time('Y'); ?> <img src="<?php esc_html_e(NEWSLETTER_PUB_URL.'assets/images/download.svg'); ?>" alt=""></a></p>
	<div class="row ">
		<div class="col-12 h-100">
			<div id='viewer' height="100%" style="width:100%;height:800px;max-height:1000px;margin:0 auto"></div>
		</div>
	</div>

	<div class="pagination my-2">
		<div class="nav-previous me-auto">
			<?php previous_post_link('%link','&#8592; Previous Month' ); ?>
		</div>
		<div class="nav-next ms-auto">
			
			<?php next_post_link('%link','Next Month &#8594;' ); ?>
		</div>
	</div>
</div>

<script>
	function view_pdf(){
		// pdfjs express
		var initialDoc = '<?php echo get_post_meta( get_the_ID(), 'newsletter_file', true ); ?>';
		var path 	   = '<?php echo NEWSLETTER_PUB_URL."assets/js/pdfjs/lib/"?>';
		console.log(path);
		WebViewer({
		path: path, // path to the PDF.js Express'lib' folder on your server
		licenseKey: 'Insert commercial license key here after purchase',
		initialDoc: initialDoc,
		// initialDoc: '/path/to/my/file.pdf',  // You can also use documents on your server
	}, document.getElementById('viewer'))
	.then(instance => {
		//const docViewer = instance.docViewer;
	// const annotManager = instance.annotManager;
		// call methods from instance, docViewer and annotManager as needed

		// you can also access major namespaces from the instance as follows:
		const Tools = instance.Tools;
		// const Annotations = instance.Annotations;

		docViewer.on('documentLoaded', () => {
		// call methods relating to the loaded document
		});
	});
	}
</script>
<?php if ( wp_is_block_theme() ) : ?>
	<footer class="wp-block-template-part">
		<?php block_footer_area(); ?>
	</footer>
	<?php wp_footer(); ?>
	<script>view_pdf();</script>
</body>  


<?php else: ?>
	<?php get_footer(); ?>
	<script>view_pdf()</script>
<?php endif; ?>


