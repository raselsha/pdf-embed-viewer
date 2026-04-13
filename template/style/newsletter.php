<?php 
/**
 * @package pdv-embed-viewer
 * @version 1.0.3
 * @template newsletter
 * To customize the archive page template, simply copy the /template/newsletter.php file into your theme directory. 
 */
if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }?>
<div class="pdfev-embed-viewer">
	
	<?php do_action('pdfev_template_archive_title'); ?>

	<?php do_action('pdfev_template_archive_newsletter'); ?>
</div>
