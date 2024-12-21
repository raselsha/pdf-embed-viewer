(function($){
  // ===========color picker=================
  $(document).ready(function() {
    $('.pdfev-color-field').wpColorPicker();
  });
  // ===========tab=================
  $(document).on('click','[data-tab-target]',function(){
    $('[data-tab-target]').removeClass('active');
    $(this).addClass('active');
    var target = $(this).data('tab-target');
    $('.pdfev-tab-content').removeClass('active');
    $('[data-tab="' + target + '"]').addClass('active'); 
  });

  // ============toggle switch=======
  $(document).on('click','.switch .slider',function() {
      var checkbox = $(this).prev('input[type="checkbox"]');
      if (checkbox.val() === 'yes') {
          checkbox.val('no');
      } else {
          checkbox.val('yes');
      }
  });

  // =================media upload======== 
  $(document).on('click','.pdfev-emd-vwr-upload',function(e) {
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
  $(document).on('click','#pdfev-import-demo-content',function (e) {
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
