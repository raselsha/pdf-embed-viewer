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
	<div class="sample-container-box">
		<div class="sample-container"></div>
	</div>
	<?php do_action('pdfev_template_book_reader'); ?>

	<?php do_action('pdfev_template_single_footer'); ?>
	<script type="text/javascript">
jQuery(function($){
    let options = {
        pdf: "http://localhost:3000/wp-content/uploads/2025/04/book-1-20.pdf",
        page: 3,
        template: function () {
            return {
                html: [
                    {
                        url: "<?php echo PDFEV_Const_URL; ?>assets/templates/default-book-view.html",
                        data: jsData.urls["templates/default-book-view.html"],
                    },
                ],
                script: [
                    {
                        url: "<?php echo PDFEV_Const_URL; ?>assets/js/default-book-view.js",
                        data: jsData.urls["js/default-book-view.js"],
                    },
                ],
                styles: [
                    {
                        url: "css/font-awesome.min.css",
                        data: jsData.urls["css/font-awesome.min.css"],
                    },
                    {
                        url: "<?php echo PDFEV_Const_URL; ?>assets/css/short-black-book-view.css",
                        data: jsData.urls["css/short-black-book-view.css"],
                    },
                ],
                sounds: {
                    startFlip: "<?php echo PDFEV_Const_URL; ?>assets/sounds/start-flip.mp3",
                    endFlip: "<?php echo PDFEV_Const_URL; ?>assets/sounds/end-flip.mp3",
                },
                init: undefined,
            };
        },
    };
    $(".sample-container").FlipBook(options);
});
</script>

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

