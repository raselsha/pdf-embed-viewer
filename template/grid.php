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

<div class="pdfev-embed-viewer">
	<?php
		$archive_title = get_option('pdfev_emd_vwr_opt_archive_title');
		$check_download_archive  =  get_option('pdfev_emd_vwr_opt_archive_download');
		$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdfev_emd_vwr_file_url', true );
	?>
	<h2><?php echo isset($archive_title) ? esc_html($archive_title) : esc_html(the_archive_title()); ?></h2>
	<div class="archive-grid-style">

		<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
			'post_type'=>'pdfev_embed_viewer',
			'order' => 'DSC',
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
							<?php if($check_download_archive == 'yes' and  isset($pdf_emd_vwr_file_url)): ?>
								<a href="<?php echo esc_attr($pdf_emd_vwr_file_ur); ?>" class="download-btn" download><?php echo esc_html('Download','pdf-embed-viewer'); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
	</div>
	<div class="pagination">
		<?php PDFEV_Embed_Viewer_CPT::pagination_bar( $WpQuery ); ?>
	</div>
</div>

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