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
  // ==============shortcode generate============
  function pdfevGenerateShortcode() {
      const template = document.getElementById("template").value;
      const limit = document.getElementById("limit").value;
      const order = document.getElementById("order").value;
      const read = document.getElementById("read").value;
      const download = document.getElementById("download").value;
      const reading_count = document.getElementById("reading_count").value;
      const downloading_count = document.getElementById("downloading_count").value;

      const shortcode = `[pdfev_viewer template="${template}" limit="${limit}" order="${order}" read="${read}" download="${download}" reading_count="${reading_count}" downloading_count="${downloading_count}"]`;

      $.ajax({
          url: pdfevAjax.ajaxurl,
          type: 'POST',
          data: {
              action: 'pdfev_shortcode_generate',
              ajaxnonce: pdfevAjax.ajaxnonce,
              template: template,
              limit: limit,
              order: order,
              read: read,
              download: download,
              reading_count: reading_count,
              downloading_count: downloading_count
          },
          beforeSend: function () {
              // $('#shortcode-previewer').html('<div class="pdfev-loading">Generating preview...</div>');
              $('#pdfev-shortcode').html('Generating shortcode...');
          },
          success: function (response) {
              $('#pdfev-shortcode').html(response.data.shortcode);
              $('#pdfev-shortcode').addClass('pdfev-shortcode');
              // $('#shortcode-previewer').html(response.data.html);
          },
          error: function (xhr, status, error) {
              $('#shortcode-previewer').html('An error occurred: ' + error);
              console.log('Error:', error);
          }
      });
  }

  // === Generate Button Handler ===
  $(document).on('click', '#pdfev-shortcode-generate', function (e) {
      e.preventDefault();
      pdfevGenerateShortcode();
  });

  // === Reset Button Handler + Generate default shortcode ===
  $(document).on('click', '#pdfev-shortcode-reset', function (e) {
      e.preventDefault();
      $('#template').val('list');
      $('#limit').val(10);
      $('#order').val('dsc');
      $('#read').val('yes');
      $('#download').val('yes');
      $('#reading_count').val('yes');
      $('#downloading_count').val('yes');

      pdfevGenerateShortcode(); // Trigger generation with default values
  });

  //  ====copy shortcode====
  $(document).on('click','#pdfev-copy-shortcode',function (e) {
    e.preventDefault();
    const range = document.createRange();
    const selection = window.getSelection();
    const element = document.getElementById('pdfev-shortcode');

    range.selectNodeContents(element);
    selection.removeAllRanges();
    selection.addRange(range);

    try {
        const successful = document.execCommand('copy');
        if (successful) {
            $(this).text('Copied!');
            setTimeout(() => {
                $(this).text('Copy');
            }, 1500);
        } else {
            $(this).text('Failed!');
        }
    } catch (err) {
        console.error('Copy failed', err);
        $(this).text('Error!');
    }

    selection.removeAllRanges();
  });
  

})(jQuery);
