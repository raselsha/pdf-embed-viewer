<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template grid
 * To customize archive page template; you can copy this /template/grid.php file to your theme directory. 
 * If you used child theme, put into parent direcotory first.
 */

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

<div class="pdf-embed-viewer">
	<?php
		$archive_title = get_option('pdf_emd_vwr_opt_archive_title');
		$check_download_archive  =  get_option('pdf_emd_vwr_opt_archive_download');
		$years =  PDF_Emd_Vwr_CPT::get_posts_years_array('pdf-embed-viewer');
		if($years):
	?>
	<h2><?php echo isset($archive_title) ? esc_html($archive_title) : esc_html(the_archive_title()); ?></h2>
	<div class="archive">
		<ul class="tabs">
			<?php 
				foreach($years as $year): ?>
					<li class="tab <?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-target="#year-<?php echo esc_attr($year);?>" ><?php echo esc_attr($year);?></li>
			<?php endforeach; ?>
		</ul>
		<div class="tabs-content" >
			<?php foreach($years as $year): ?>
				<table  class="<?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-content  id="year-<?php echo esc_attr($year);?>">
					<tr>         					    			
						<th><?php echo esc_html('Month','pdf-embed-viewer') ?></th>
						<th><?php echo esc_html('Title','pdf-embed-viewer') ?></th>
						<?php if($check_download_archive == 'yes'): ?>
						<th><?php echo esc_html('Download','pdf-embed-viewer') ?></th>
						<?php endif; ?>
					</tr>
					<?php
						$args = array(
						'post_type'=>'pdf-embed-viewer',
						'order' => 'ASC',
						'posts_per_page'=> get_option( 'posts_per_page' ),
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
								<td width="10%"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
								<?php if($check_download_archive == 'yes'): ?>
									<td width="10%">
										<?php
											$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true );
											if(isset($pdf_emd_vwr_file_url)):
										?>
										<a href="<?php echo esc_attr(get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true ))?>" class="download-btn" download><?php echo esc_html('Download','pdf-embed-viewer'); ?> <img src="<?php echo esc_attr(PDF_Emd_Vwr_URL.'assets/images/download.svg'); ?>" alt="<?php echo esc_html('Download icon','pdf-embed-viewer'); ?>"> </a>
										<?php endif; ?>
									</td>
								<?php endif; ?>

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

<?php wp_link_pages(); ?>
<?php
global $wp_query;
if ( $wp_query->max_num_pages > 1 ) :
	?>
	<div class="col-12">
		<div class="pagination">
				<?php /* Translators: HTML arrow */ ?>
				<div class="nav-next me-auto"><?php // previous_posts_link( sprintf( __( '%s Previous', 'hello-elementor' ), '<span class="meta-nav">&#8592;</span>' ) ); ?></div>
				<?php /* Translators: HTML arrow */ ?>
				<div class="nav-previous ms-auto"><?php // next_posts_link( sprintf( __( 'Next %s', 'hello-elementor' ), '<span class="meta-nav">&#8594;</span>' ) ); ?></div>
		</div>
	</div>
<?php endif; ?>

<?php if ( wp_is_block_theme() ) : ?>
	<footer class="wp-block-template-part">
		<?php block_footer_area(); ?>
	</footer>
	<?php wp_footer(); ?>
</body>  

<?php
	else:
		get_footer();
	endif;
?>