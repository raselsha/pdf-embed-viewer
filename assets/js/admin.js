
// ============custom metabox data tabs===========
jQuery(document).ready(function ($) {
  
 
});


jQuery(document).ready(function ($) {
  pdf_emd_vwr_toggle();
  pdf_emd_vwr_tab();
  pdf_emd_vwr_settings_tab();
  pdf_emd_vwr_upload();
  $('.color-field').wpColorPicker();

// ============admin tabs===========

  function pdf_emd_vwr_settings_tab(){
    $('.nav-tab').click(function () {
      var target = $(this).data('tab-target');
      $('.tab-content').removeClass('active');
      $('.nav-tab').removeClass('nav-tab-active');
      $(this).addClass('nav-tab-active');
      $(target).addClass('active');
    });
  }

  function pdf_emd_vwr_tab() {
      $('.pdf-emd-vwr-tab-content:first').addClass('active');
      $('.pdf-emd-vwr-tab:first').addClass('active');
      
      $('.pdf-emd-vwr-tab').click(function () {
        var abc = $(this).data('tab-target');
        $('.pdf-emd-vwr-tab-content').removeClass('active');
        $('.pdf-emd-vwr-tab').removeClass('active');
        $(this).addClass('active');
        $(abc).addClass('active');
      });
  }

  // ============toggle switch=======
  
  function pdf_emd_vwr_toggle() {
    $('.switch .slider').click(function() {
        var checkbox = $(this).prev('input[type="checkbox"]');
        if (checkbox.val() === 'yes') {
            checkbox.val('no');
        } else {
            checkbox.val('yes');
        }
    });
  }


  // =================media upload======== 
  function pdf_emd_vwr_upload() {
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
  }
  
});


