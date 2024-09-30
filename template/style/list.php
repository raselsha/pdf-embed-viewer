<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template list
 * To customize the archive page template, simply copy the /template/list.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }
?>
<div class="pdfev-embed-viewer">
	<h2><?php PDFEV_Functions::archive_title(); ?></h2>
	<div class="archive-list-style">
		<table>
			<tr>
				<th><?php echo esc_html__('Title','pdf-embed-viewer') ?></th>
				<th><?php echo esc_html__('Month','pdf-embed-viewer') ?></th>
				<th><?php echo esc_html__('Read/Download','pdf-embed-viewer') ?></th>
			</tr>
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				'post_type'=>PDFEV_Functions::get_cpt_name(),
				'post_status' => 'publish',
				'order' => PDFEV_Functions::get_post_order(),
				'posts_per_page'=> get_option( 'posts_per_page' ),
				'paged' => $paged
			);
			$WpQuery = new WP_Query($args);    
				while ( $WpQuery->have_posts() ) :
					$WpQuery->the_post();
					?>
					<tr>
						<td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
						<td><?php the_time('d-M-Y'); ?></td>
						<td>
							<?php PDFEV_Functions::read_button(); ?>
							<?php PDFEV_Functions::download_button(); ?>
						</td>
					</tr>
			<?php endwhile; ?>
		</table>
	</div>

	<div class="pagination">
		<?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
	</div>
</div>


