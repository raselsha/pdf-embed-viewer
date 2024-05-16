
// ============custom data tabs===========
jQuery(document).ready(function($){
  $('[data-tab-target]').click(function(){
    var target = $(this).data('tab-target');
    $('.tab-content').removeClass('active');
    $('.tab').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active');
  });
});

// =================media upload========

jQuery('.upload').click(function () {
    wp.media.editor.send.attachment = function(props, attachment) {
    // let attachment_id = attachment.id;
    let attachment_url = attachment.url;
    jQuery('.sh_pdf_embed_file').val(attachment_url);
    }
    wp.media.editor.open(jQuery(this));
    return false;
});


// ============admin scripts===========

jQuery(document).ready(function($){
  $('.color-field').wpColorPicker();
});

