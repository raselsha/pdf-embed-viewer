<?php  
$meta = get_post_meta($post->ID,'newsletter_file',true);
?>

<table  cellspacing="5">
	<input type="hidden" name="newsletter_nonce" value="<?php echo wp_create_nonce("newsletter_nonce"); ?>">
	<tr>
		<th>
			<label for="newsletter_file"><?php _e( 'Add Newsletter URL', TEXTDOMAIN )?></label>
		</th>
		<td>
			<input type="url" class="form-control border" name="newsletter_file" id="newsletter_file" value="<?php echo ( isset($meta) ) ? esc_url($meta) : '' ;  ?>" required>
			<button type="button" class="button" id="events_video_upload_btn" data-media-uploader-target="#newsletter_file"><?php _e( 'Upload', TEXTDOMAIN )?></button>
		</td>
	</tr>
</table>
