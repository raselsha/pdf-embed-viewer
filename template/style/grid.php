<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template grid
 * To customize archive page template; you can copy this /template/grid.php file to your theme directory. 
 * If you used child theme, put into parent direcotory first.
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }
?>

<div class="pdfev-embed-viewer">
	<h2><?php PDFEV_Functions::archive_title(); ?></h2>
	<div class="archive-grid-style">

		<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
			'post_type'=>PDFEV_Functions::get_cpt_name(),
			'order' => PDFEV_Functions::get_post_order(),
			'post_status' => 'publish',
			'posts_per_page'=> get_option( 'posts_per_page' ),
			'paged' => $paged
		);
		$WpQuery = new WP_Query($args);    
			while ( $WpQuery->have_posts() ) :
				$WpQuery->the_post();
				?>
				<div class="grid-item">
					<div class="image">
						<?php the_post_thumbnail() ?>
					</div>
					<span class="date"><?php the_time('d-m-Y'); ?></span>
					
					<div class="content">
						<h2><a href="<?php the_permalink(); ?>"> <?php the_title();?></a></h2>
						<div class="action">
							<?php PDFEV_Functions::read_button(); ?>
							<?php PDFEV_Functions::download_button(); ?>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
	</div>
	<div class="pagination">
		<?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
	</div>
</div>