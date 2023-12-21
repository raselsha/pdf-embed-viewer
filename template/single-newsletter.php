<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">
	<article class="post">
		<?php //if (get_field('download_pdf')) :?>
			<!-- get file url -->
			<h4><?php the_title();?></h4>
			<p><a href="<?php the_field('download_pdf')?>" class="btn btn-primary btn-sm" download><?php the_time('F'); ?> | <?php the_time('Y'); ?> <i class="fas fa-cloud-download-alt"></i></a></p>
		    <div class="row pdf-body">
            	<div class="col-12">
            	    <?= do_shortcode('[pdf-embedder url="'.get_field('download_pdf').'"]'); ?>
				</div>
			</div>
			<?php // endif; ?>
			<div class="pagination my-2">
				<div class="nav-previous me-auto">
					<?php previous_post_link('%link','&#8592; Previous Month' ); ?>
				</div>
				<div class="nav-next ms-auto">
					
					<?php next_post_link('%link','Next Month &#8594;' ); ?>
				</div>
			</div>
	</article>
</main>
	<?php
endwhile;
get_footer();
?>