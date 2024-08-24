<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.0
 * @template list
 * To customize archive page template; you can copy this /template/list.php file to your theme directory. 
 * If you used child theme, put into parent direcotory first.
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

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
		$archive_title = get_option('pdfev_archive_title');
		$check_download_archive  =  get_option('pdfev_archive_download');
	?>
	<h2><?php echo isset($archive_title) ? esc_html($archive_title) : esc_html(the_archive_title()); ?></h2>
	<div class="archive-list-style">
		<table>
			<tr>
				<th><?php echo esc_html('Title','pdf-embed-viewer') ?></th>
				<th><?php echo esc_html('Month','pdf-embed-viewer') ?></th>
				<th><?php echo esc_html('Action','pdf-embed-viewer') ?></th>
			</tr>
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				'post_type'=>'pdfev_embed_viewer',
				'post_status' => 'publish',
				'order' => 'DSC',
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
							<a href="<?php the_permalink(); ?>" class="download-btn"><i class="far fa-address-book"></i> <?php echo esc_html('Read','pdf-embed-viewer');?></a>
						<?php if($check_download_archive == 'yes'): ?>
								<?php
									$pdf_emd_vwr_file_url=get_post_meta( get_the_ID(), 'pdfev_emd_vwr_file_url', true );
									if(isset($pdf_emd_vwr_file_url)):
								?>
								<a href="<?php echo esc_attr(get_post_meta( get_the_ID(), 'pdfev_emd_vwr_file_url', true ))?>" class="download-btn" download><?php echo esc_html('Download','pdf-embed-viewer'); ?> <img src="<?php echo esc_attr(PDFEV_Embed_Viewer_URL.'assets/images/download.svg'); ?>" alt="<?php echo esc_html('Download icon','pdf-embed-viewer'); ?>"> </a>
								<?php endif; ?>
							
						<?php endif; ?>
						</td>

					</tr>
			<?php endwhile; ?>
			
		</table>
</div>

<div class="pagination">
	<?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
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