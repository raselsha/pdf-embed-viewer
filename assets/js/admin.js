
// ============custom metabox data tabs===========
jQuery(document).ready(function ($) {
  
 
});


jQuery(document).ready(function ($) {
  pdfev_emd_vwr_toggle();
  pdfev_emd_vwr_tab();
  pdfev_emd_vwr_settings_tab();
  pdfev_emd_vwr_upload();
  $('.color-field').wpColorPicker();

// ============admin tabs===========

  function pdfev_emd_vwr_settings_tab(){
    $('.nav-tab').click(function () {
      var target = $(this).data('tab-target');
      $('.tab-content').removeClass('active');
      $('.nav-tab').removeClass('nav-tab-active');
      $(this).addClass('nav-tab-active');
      $(target).addClass('active');
    });
  }

  function pdfev_emd_vwr_tab() {
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
  
  function pdfev_emd_vwr_toggle() {
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
  function pdfev_emd_vwr_upload() {
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
            console.log(attachment.url);
          } else {
            alert('Please select a PDF file only.');
            $('.pdfev-emd-vwr-file').val('');
          }
        });
        mediaUploader.open();
    });
  }
  
});


