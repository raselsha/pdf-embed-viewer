<?php  
$meta = get_post_meta($post->ID,'pdfdownload_file',true);
?>

<table  cellspacing="5">
	<input type="hidden" name="pdfdownload_nonce" value="<?php echo wp_create_nonce("pdfdownload_nonce"); ?>">
	<tr>
		<th>
			<label for="pdfdownload_file"><?php _e( 'Add PDF URL', 'pdf-download' )?></label>
		</th>
		<td>
			<input type="url" class="form-control border" name="pdfdownload_file" id="pdfdownload_file" value="<?php echo ( isset($meta) ) ? esc_url($meta) : '' ;  ?>" required>
			<button type="button" class="button" id="events_video_upload_btn" data-media-uploader-target="#pdfdownload_file"><?php _e( 'Upload', 'pdf-download' )?></button>
		</td>
	</tr>
</table>
