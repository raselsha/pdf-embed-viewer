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

<div class="newsletter_publisher">
	<h2><?php the_archive_title(); ?></h2>
	<div class="archive">
		<ul class="tabs">
			<?php $years =  Newsletter_Publisher_CPT::get_posts_years_array('newsletter');//['2022','2021','2020'];
				for($i=0;$i<count($years);$i++): ?>
					<li class="tab <?php echo ($i==0)?'active':''; ?>" data-tab-target="#year-<?=$years[$i];?>" type="" role="tab"  aria-selected="true"><?=$years[$i];?></li>
			<?php endfor; ?>
		</ul>
		<div class="tabs-content" >
			<?php for($i=0;$i<count($years);$i++): ?>
				<table  class="<?php echo ($i==0)?'active':''; ?>" data-tab-content  id="year-<?= $years[$i]; ?>">
					<tr>         					    			
						<th width="15%">Month</th>
						<th width="80%">Title</th>
						<th width="5%" class="text-center">Download</th>
					</tr>
					<?php
						$args = array(
						'post_type'=>'newsletter',
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
							?>
							<tr>
								<td><?php the_time('F'); ?></td>
								<td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
								<td><a href="<?php esc_attr_e(get_post_meta( get_the_ID(), 'newsletter_file', true ))?>" class="file_download" download>Download</a></td>
							</tr>
					<?php } ?>
					
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