<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template newsletter
 * To customize the archive page template, simply copy the /template/newsletter.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }?>
<div class="pdfev-embed-viewer">
	<?php
		$years =  PDFEV_CPT::get_posts_years_array();
		if($years):
	?>
	<h2><?php PDFEV_Functions::archive_title(); ?></h2>
	<div class="archive-newsletter-style">
		<ul class="tabs">
			<?php 
				foreach($years as $year): ?>
					<li class="tab <?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-target="#year-<?php echo esc_attr($year);?>" ><?php echo esc_attr($year);?></li>
			<?php endforeach; ?>
		</ul>
		<div class="tabs-content" >
			<?php foreach($years as $year): ?>
				<table  class="<?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-content  id="year-<?php echo esc_attr($year);?>">
					<thead>
						<tr>         					    			
							<th><?php echo esc_html__('Month','pdf-embed-viewer') ?></th>
							<th><?php echo esc_html__('Title','pdf-embed-viewer') ?></th>
							<th style="text-align: right;"><?php echo esc_html__('Read/Download','pdf-embed-viewer') ?></th>
						</tr>
					</thead>
					<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
						'post_type'=>PDFEV_Functions::get_cpt_name(),
						'order' => PDFEV_Functions::get_post_order(),
						'post_status' => 'publish',
						'posts_per_page'=> -1,
						'paged' => $paged,
						'date_query' => array(
							array(
								'year'  => $year,
							),
						),
					);
					$WpQuery = new WP_Query($args);    
						while ( $WpQuery->have_posts() ) :
							$WpQuery->the_post();
							?>
							<tr>
								<td width="10%"><?php the_time('F'); ?></td>
								<td width="60%"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
								<td width="24%" style="text-align: right;">
									<?php PDFEV_Functions::read_button(); ?>
									<?php PDFEV_Functions::download_button(); ?>
								</td>

							</tr>
					<?php endwhile; ?>
					
				</table>
				
			<?php endforeach; ?>
				
		</div>
		
	</div>
	<?php else: ?>
		<h2><?php echo esc_html('No data found','pdf-embed-viewer'); ?></h2>
	<?php endif; ?>
</div>
