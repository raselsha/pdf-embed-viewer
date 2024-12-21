(function($){

  $('.color-field').wpColorPicker();

  // ===========metabox tab=================
  $(document).on('click','[data-tab-target]',function(){
    $('[data-tab-target]').removeClass('active');
    $(this).addClass('active');
    var target = $(this).data('tab-target');
    $('.pdfev-tab-content').removeClass('active');
    $('[data-tab="' + target + '"]').addClass('active'); 
  });

  // ============toggle switch=======
  $('.switch .slider').click(function() {
      var checkbox = $(this).prev('input[type="checkbox"]');
      if (checkbox.val() === 'yes') {
          checkbox.val('no');
      } else {
          checkbox.val('yes');
      }
  });

  // =================media upload======== 
  $('.pdfev-emd-vwr-upload').click(function(e) {
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
          $('.pdfev-emd-vwr-file').val(attachment.url);
        } else {
          alert('Please select a PDF file only.');
          $('.pdfev-emd-vwr-file').val('');
        }
      });
      mediaUploader.open();
  });
  
  // =================Import Demo Content========
  $('#import-demo-content').click(function (e) {
    e.preventDefault();
    $.ajax({
        url: pdfevAjax.ajaxurl,
        type: 'POST',
        data: {
            action: 'pdfev_import_demo_data',
            ajaxnonce: pdfevAjax.ajaxnonce,
            import_status: 'yes',
        },
        success: function(response) {
            
            if (response.success) {
                $('#response-container').html(response.message); 
            } else {
                $('#response-container').html('Error: ' + response.message); 
            }
        },
        error: function(xhr, status, error) {
            $('#response-container').html('An error occurred: ' + error);
            console.log('Error:', error);
        }
    });
  });
  
})(jQuery);
