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

<div class="pdf-download">
	<?php $options = get_option('pdf_download_option'); ?>
	<h2><?php isset($options['archive_title']) ? esc_html_e($options['archive_title']) : the_archive_title(); ?></h2>
	<div class="archive">
		<ul class="tabs">
			<?php $years =  PDF_Download_CPT::get_posts_years_array('pdfdownload');//['2022','2021','2020'];
				for($i=0;$i<count($years);$i++): ?>
					<li class="tab <?php echo ($i==0)?'active':''; ?>" data-tab-target="#year-<?=$years[$i];?>" type="" role="tab"  aria-selected="true"><?=$years[$i];?></li>
			<?php endfor; ?>
		</ul>
		<div class="tabs-content" >
			<?php for($i=0;$i<count($years);$i++): ?>
				<table  class="<?php echo ($i==0)?'active':''; ?>" data-tab-content  id="year-<?= $years[$i]; ?>">
					<tr>         					    			
						<th>Month</th>
						<th>Title</th>
						<th>Download</th>
					</tr>
					<?php
						$args = array(
						'post_type'=>'pdfdownload',
						'order' => 'ASC',
						'posts_per_page'=> get_option( 'posts_per_page' ),
							'date_query' => array(
								array(
									'year'  => $years[$i],
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
								<td width="10%"><a href="<?php esc_attr_e(get_post_meta( get_the_ID(), 'pdfdownload_file', true ))?>" class="download-btn" download><?php esc_html_e('Download','pdf-download'); ?> <img src="<?php esc_attr_e(PDF_DOWNLOAD_URL.'assets/images/download.svg'); ?>" alt="Download icon"> </a></td>
							</tr>
					<?php endwhile; ?>
					
				</table>
			<?php endfor; ?>	
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
				<div class="nav-next me-auto"><?php// previous_posts_link( sprintf( __( '%s Previous', 'hello-elementor' ), '<span class="meta-nav">&#8592;</span>' ) ); ?></div>
				<?php /* Translators: HTML arrow */ ?>
				<div class="nav-previous ms-auto"><?php// next_posts_link( sprintf( __( 'Next %s', 'hello-elementor' ), '<span class="meta-nav">&#8594;</span>' ) ); ?></div>
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