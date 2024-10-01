
// ============custom data tabs===========
jQuery(document).ready(function ($) {
    $('[data-tab-target]:first').addClass('active');
    $('[data-tab-content]:first').addClass('active');
    $('[data-tab-target]').click(function () {
    var target = $(this).data('tab-target');
    $('[data-tab-content]').removeClass('active');
    $('.tab').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active');
    
  });
});


// ============admin scripts===========
jQuery(document).ready(function ($) {
  $('.download-btn').click(function(e){
    e.preventDefault();
    var post_id = $(this).data('post-id');
    var $button = $(this);
    var downloadUrl = $button.attr('href');
    $.ajax({
        url: pdfevAjax.ajaxurl,
        type: 'POST',
        data: {
          action: 'pdfev_count_manager_download',
          ajaxnonce: pdfevAjax.ajaxnonce,
          post_id: post_id,
        },
        success: function(response) {
          if (response.success) {
            $button.find('.pdfev-download-counter').html(response.data.download_count); 
             // Create a temporary link element
              var downloadUrl = $button.attr('href'); // Replace with the actual URL
              var $tempLink = $('<a>').attr('href', downloadUrl).attr('download', '').css('display', 'none');
              
              // Append to body, trigger click and remove
              $('body').append($tempLink);
              $tempLink[0].click();
              $tempLink.remove();
          } else {
            $button.find('.pdfev-download-counter').html('Error: ' + response.data.download_count); 
          }
      },
      error: function(xhr, status, error) {
          console.log('Error:', error);
      }
    });
  });
});

// ============metabox scripts========
