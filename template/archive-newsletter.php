<?php
/**
 * The template for displaying archive pages.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<main id="content" class="site-main" role="main">

	<div class="page-content">
		<article class="post">
		    
			<div class="row my-4">
				<div class="col-12 offset-md-1">
					<h2 class="archive-title">Newsletter</h2>
				</div>
				<div class="col-12 col-md-1 nav-tabs px-0">
					<div class="nav d-block" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					    <?php $years = ['2023','2022','2021','2020'];//get_posts_years_array('news-letter');//['2022','2021','2020'];
					        
							for($i=0;$i<count($years);$i++):

								if($years[$i]==$years[0]):?>
									<h5 class=" active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#year-<?=$years[$i];?>" type="" role="tab"  aria-selected="true"><?=$years[$i];?></h5>
								<?php else: ?>
									<h5 class="" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#year-<?=$years[$i];?>" type="" role="tab"  aria-selected="true"><?=$years[$i];?></h5>
					    		<?php endif; ?>
					    <?php endfor; ?>
					</div>

				</div>
				<div class="col-12 col-md-11">
					
					<div class="tab-content" id="v-pills-tabContent">
                      	<?php for($i=0;$i<count($years);$i++): ?>
                      		<?php if($years[$i]==$years[0]): ?>
                      			<div class="tab-pane fade show active table-responsive" id="year-<?= $years[$i]; ?>" role="tabpanel" aria-labelledby="v-pills-home-tab"> 
                      		<?php else: ?>
                      			<div class="tab-pane fade show table-responsive" id="year-<?= $years[$i]; ?>" role="tabpanel" aria-labelledby="v-pills-home-tab"> 
                      		<?php endif; ?>
                      				<table class="table table-striped" width="100%">
										<tr>         					    			
											<th  width="15%">Month</th>
											<th  width="80%">Title</th>
											<th  width="5%" class="text-center">Download</th>
										</tr>
										<?php
											$args = array(
											'post_type'=>'news-letter',
											'order' => 'ASC',
											'posts_per_page'=> get_option( 'posts_per_page' ),
										  	'date_query' => array(
										      array(
										          'year'  => $years[$i],
										      ),
										  	),
										);

										$WpQuery = new WP_Query($args);    
											while ( $WpQuery->have_posts() ) {
												$WpQuery->the_post();
												$post_link = get_permalink();
												?>

												<tr>
													
													<td width="80" class="news-title"><?php the_time('F'); ?></td>
													<td><a class="news-title" href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
													<td class="text-center">
														<?php if (get_field('download_pdf')) :?>
															<a href="<?php the_field('download_pdf')?>" class="btn btn-primary btn-sm" download>Download</a>
														<?php endif; ?>
													</td>
												</tr>
											<?php } ?>
										</table>
                        			</div>
                      			<?php endfor; ?>	
                        	</div>
                      	</div>
				</div>
			</div>
		</article>
	</div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<div class="col-12">
				<div class="pagination">
			
					<?php /* Translators: HTML arrow */ ?>
					<div class="nav-next me-auto"><?php// previous_posts_link( sprintf( __( '%s Previous', 'hello-elementor' ), '<span class="meta-nav">&#8592;</span>' ) ); ?></div>
					<?php /* Translators: HTML arrow */ ?>
					<div class="nav-previous ms-auto"><?php// next_posts_link( sprintf( __( 'Next %s', 'hello-elementor' ), '<span class="meta-nav">&#8594;</span>' ) ); ?></div>
			</div>
			
		</div>
	<?php endif; ?>
</main>
<?php 
get_footer();
?>