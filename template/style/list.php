<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template list
 * To customize the archive page template, simply copy the /template/list.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }
?>
<div class="pdfev-embed-viewer">
	<?php do_action('pdfev_template_archive_title'); ?>
	<div class="archive-list-style">
		<?php do_action('pdfev_template_archive_list'); ?>
	</div>

	<div class="pagination">
		<?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
	</div>
</div>


