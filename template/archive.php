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

<div class="pdf-embed-viewer">
	<?php $options = get_option('pdf_emd_vwr_options'); ?>
	<h2><?php isset($options['archive_title']) ? esc_html_e($options['archive_title']) : the_archive_title(); ?></h2>

	<div class="archive">
		<ul class="tabs">
			<?php $years =  PDF_Emd_Vwr_CPT::get_posts_years_array('pdf-embed-viewer');
				foreach($years as $year): ?>
					<li class="tab <?php esc_attr_e($year==date('Y')?'active':''); ?>" data-tab-target="#year-<?php esc_attr_e($year);?>" ><?php esc_attr_e($year);?></li>
			<?php endforeach; ?>
		</ul>
		<div class="tabs-content" >
			<?php foreach($years as $year): ?>
				<table  class="<?php esc_attr_e($year==date('Y')?'active':''); ?>" data-tab-content  id="year-<?php esc_attr_e($year);?>">
					<tr>         					    			
						<th><?php _e('Month','pdf-embed-viewer') ?></th>
						<th><?php _e('Title','pdf-embed-viewer') ?></th>
						<th><?php _e('Download','pdf-embed-viewer') ?></th>
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
								<td width="10%">
									<?php
										$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true );
										if(isset($pdf_emd_vwr_file_url)):
									?>
									<a href="<?php esc_attr_e(get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true ))?>" class="download-btn" download><?php _e('Download','pdf-embed-viewer'); ?> <img src="<?php esc_attr_e(PDF_Emd_Vwr_URL.'assets/images/download.svg'); ?>" alt="<?php _e('Download icon','pdf-embed-viewer'); ?>"> </a>
									<?php endif; ?>
								</td>
							</tr>
					<?php endwhile; ?>
					
				</table>
			<?php endforeach; ?>	
		</div>
	</div>
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