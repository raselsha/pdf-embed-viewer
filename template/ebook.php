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
		$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdf_emd_vwr_file_url', true );
	?>
	<h2><?php echo isset($archive_title) ? esc_html($archive_title) : esc_html(the_archive_title()); ?></h2>
	<div class="archive-ebook-style">

		<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
			'post_type'=>'pdf-embed-viewer',
			'order' => 'DSC',
			'posts_per_page'=> get_option( 'posts_per_page' ),
			'paged' => $paged
		);
		$WpQuery = new WP_Query($args);    
			while ( $WpQuery->have_posts() ) :
				$WpQuery->the_post();
				?>
				<div class="grid-item">
					<div class="image"><img src="https://dummyimage.com/640x4:3" alt=""></div>					
					<div class="content">
						<h2><?php echo mb_strimwidth(get_the_title(), 0, 50, '...');?></h2>
						<div class="action">
							<?php if($check_download_archive == 'yes' and  isset($pdf_emd_vwr_file_url)): ?>
								<a href="<?php echo esc_attr($pdf_emd_vwr_file_ur); ?>" download><?php echo esc_html('Download','pdf-embed-viewer'); ?> <span class="download-icon" style="background-image: url(<?php echo esc_attr(PDF_Emd_Vwr_URL.'assets/images/download.svg'); ?>);"></span> </a>
							<?php endif; ?>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
	</div>
	<div class="pagination">
		<?php PDF_Emd_Vwr_CPT::pagination_bar( $WpQuery ); ?>
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