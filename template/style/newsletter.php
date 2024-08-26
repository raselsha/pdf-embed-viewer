<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template newsletter
 * To customize archive page template; you can copy this /template/newsletter.php file to your theme directory. 
 * If you used child theme, put into parent direcotory first.
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }?>
<div class="pdfev-embed-viewer">
	<?php
		$archive_title = get_option('pdfev_archive_title');
		$check_download_archive  =  get_option('pdfev_archive_download');
		$years =  PDFEV_CPT::get_posts_years_array();
		
		if($years):
	?>
	<h2><?php echo isset($archive_title) ? esc_html($archive_title) : the_archive_title(); ?></h2>
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
						'post_type'=>'pdfev_embed_viewer',
						'order' => 'DSC',
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
								<td width="20%" style="text-align: right;">
									<a href="<?php the_permalink(); ?>" class="download-btn"><i class="far fa-address-book"></i> <?php echo esc_html__('Read','pdf-embed-viewer');?></a>
									<?php if($check_download_archive == 'yes'): ?>
											<?php
												$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdfev_meta_pdf_url', true );
												if(isset($pdf_emd_vwr_file_url)):
											?>
											<a href="<?php echo esc_attr(get_post_meta( get_the_ID(), 'pdfev_meta_pdf_url', true ))?>" class="download-btn" download><?php echo esc_html__('Download','pdf-embed-viewer'); ?> <img src="<?php echo esc_attr(PDFEV_Const_URL.'assets/images/download.svg'); ?>" alt="<?php echo esc_html__('Download icon','pdf-embed-viewer'); ?>"> </a>
											<?php endif; ?>
										
									<?php endif; ?>
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
