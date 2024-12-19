<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template grid
 * To customize the archive page template, simply copy the /template/grid.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }
?>

<div class="pdfev-embed-viewer">
	<?php do_action('pdfev_template_archive_title'); ?>
	<?php do_action('pdfev_template_archive_grid'); ?>
	
	<div class="pagination">
		<?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
	</div>
</div>