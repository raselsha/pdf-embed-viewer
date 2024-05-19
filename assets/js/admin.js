
// ============custom metabox data tabs===========
// jQuery(document).ready(function($){
//   $('.tab').click(function () {
//     var target = $(this).data('tab-target');
//     $('.tab-content').removeClass('active');
//     $('.tab').removeClass('active');
//     $(this).addClass('active');
//     $(target).addClass('active');
//   });
// });

// ============admin tabs===========
jQuery(document).ready(function($){
  $('.nav-tab').click(function () {
    var target = $(this).data('tab-target');
    $('.tab-content').removeClass('active');
    $('.nav-tab').removeClass('nav-tab-active');
    $(this).addClass('nav-tab-active');
    $(target).addClass('active');
  });
});
// ============admin data tab=======


// =================media upload========

jQuery(document).ready(function($) {
    $('.upload').click(function(e) {
        e.preventDefault();
        var mediaUploader = wp.media({
            title: 'Upload PDF',
            button: {
                text: 'Embed PDF'
          },
          library: {
                type: 'application/pdf'
            },
            multiple: false
        });
      mediaUploader.on('select', function () {
          var attachment = mediaUploader.state().get('selection').first().toJSON();
          // Check if the selected file is a PDF
          if (attachment.mime === 'application/pdf') {
              $('.pdf_emd_vwr_file').val(attachment.url);
          } else {
            alert('Please select a PDF file only.');
            $('.pdf_emd_vwr_file').val('');
          }
        });
        mediaUploader.open();
    });
});


// ============admin scripts===========

jQuery(document).ready(function($){
  $('.color-field').wpColorPicker();
});

