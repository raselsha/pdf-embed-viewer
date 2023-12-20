<?php 

$meta = get_post_meta($post->ID,'newsletter_file',true);

?>
<table  cellspacing="5">
  <tr>
    <th>
      <label for="newsletter_file">Input text</label>
    </th>
    <td>
      <input type="text" name="newsletter_file" value="<?php esc_html_e($meta);  ?>" id="newsletter_file" class="form-control border" required>
    </td>
  </tr>
</table>