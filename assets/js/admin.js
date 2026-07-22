(function($){
  // ===========color picker=================
  $(document).ready(function() {
    // wpColorPicker() builds its own clickable swatch button in front of the
    // original input — disabling the input alone doesn't disable that button,
    // so locked/Pro fields must be excluded here rather than left clickable.
    $('.pdfev-color-field:not(:disabled)').wpColorPicker();
  });

  // ===========custom select dropdown=================
  // Drives a styled listbox off a visually-hidden native <select> (kept for form submission).
  function pdfevCloseSelects() {
    $('.pdfev-select-options').prop('hidden', true);
    $('.pdfev-select-trigger').removeClass('pdfev-select-open').attr('aria-expanded', 'false');
  }

  $(document).on('click', '.pdfev-select-trigger', function (e) {
    e.preventDefault();
    var $trigger = $(this);
    var $wrap = $trigger.closest('.pdfev-select');
    var $list = $wrap.find('.pdfev-select-options');
    var isOpen = !$list.prop('hidden');

    pdfevCloseSelects();

    if (!isOpen) {
      $list.prop('hidden', false);
      $trigger.addClass('pdfev-select-open').attr('aria-expanded', 'true');
    }
  });

  $(document).on('click', '.pdfev-select-options li', function () {
    var $li = $(this);
    var $wrap = $li.closest('.pdfev-select');
    var value = $li.attr('data-value');

    $wrap.find('.pdfev-select-options li').removeAttr('aria-selected');
    $li.attr('aria-selected', 'true');
    $wrap.find('.pdfev-select-value').text($li.text());
    $wrap.find('.pdfev-select-native').val(value).trigger('change');

    pdfevCloseSelects();
  });

  $(document).on('click', function (e) {
    if (!$(e.target).closest('.pdfev-select').length) {
      pdfevCloseSelects();
    }
  });

  $(document).on('keydown', function (e) {
    if (e.key === 'Escape') {
      pdfevCloseSelects();
    }
  });
  // ===========tab (persists across reload via localStorage)=================
  // Only the top-level settings-page tabs (.nav-tab) persist — the post-edit metabox
  // reuses the same [data-tab-target] convention (li.pdfev-tab) but shouldn't share the
  // same storage key, or clicking a metabox tab would clobber the remembered settings tab.
  var pdfevTabStorageKey = 'pdfevActiveTab';
  $(document).on('click','[data-tab-target]',function(){
    $('[data-tab-target]').removeClass('active');
    $(this).addClass('active');
    var target = $(this).data('tab-target');
    $('.pdfev-tab-content').removeClass('active');
    $('[data-tab="' + target + '"]').addClass('active');
    if ($(this).hasClass('nav-tab')) {
      try { localStorage.setItem(pdfevTabStorageKey, target); } catch (e) {}
    }
  });

  // ===========settings sidebar sections (persists across reload)=================
  var pdfevSectionStorageKey = 'pdfevActiveSection';
  $(document).on('click','[data-section-target]',function(){
    $('[data-section-target]').removeClass('active');
    $(this).addClass('active');
    var target = $(this).data('section-target');
    $('.pdfev-settings-section').removeClass('active');
    $('[data-section="' + target + '"]').addClass('active');
    try { localStorage.setItem(pdfevSectionStorageKey, target); } catch (e) {}
  });

  // restore last active tab/section on page load, if any was saved
  $(document).ready(function(){
    try {
      var savedTab = localStorage.getItem(pdfevTabStorageKey);
      if (savedTab) {
        var $tabBtn = $('.nav-tab[data-tab-target="' + savedTab + '"]');
        if ($tabBtn.length) { $tabBtn.trigger('click'); }
      }
      var savedSection = localStorage.getItem(pdfevSectionStorageKey);
      if (savedSection) {
        var $sectionBtn = $('[data-section-target="' + savedSection + '"]');
        if ($sectionBtn.length) { $sectionBtn.trigger('click'); }
      }
    } catch (e) {}
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

  // =================PDF source: Remote URL / Back to upload links========
    // Drag-and-drop / Choose File is the implicit default (no separate
    // "Upload File" toggle exists anymore) — "Or use a Remote URL instead"
    // lives inside the dropzone itself, and "Back to upload" lives inside
    // the Remote URL panel it switches to, rather than a floating tab pair.
    $(document).on('click', '.pdfev-source-link', function (e) {
        e.preventDefault();
        var showRemote = $(this).data('source-target') === 'remote';
        $('.pdfev-source-panel[data-source="remote"]').css('display', showRemote ? 'block' : 'none');
        renderPDFThumbnails($('.pdfev-emd-vwr-file').val());
    });

    // The remote URL box has no name attribute on purpose (only one field,
    // the hidden .pdfev-emd-vwr-file, should ever get submitted) — it just
    // keeps that hidden field's value in sync as the admin types.
    $(document).on('input', '#pdfev-remote-url-input', function () {
        $('.pdfev-emd-vwr-file').val($(this).val());
    });

    // ======clear the currently chosen file=========
    $(document).on('click', '.pdfev-clear-file', function (e) {
        e.preventDefault();
        $('.pdfev-emd-vwr-file').val('');
        $('.pdfev-source-filename').text('');
        $('#pdfev_meta_filesize').val('');
        $('#pdfev_meta_total_pages').val('');
        $('.pdfev-filesize').text('');
        $('.pdfev-totalpage').text('');
        $('#pdfev-featured-image-data').val('');
        $('#pdfev-featured-image-preview').attr('src', '').hide();
        $('#pdfev-featured-image').data('status', 'no').data('url', '');
        renderPDFThumbnails('');
    });

    // ======drag an actual OS file onto the dropzone to upload it=========
    // Delegated at the document level (not just #pdfev-document-preview)
    // so the dangerous browser default — navigating away to open the
    // dropped file — gets prevented even if the drag ends slightly off
    // target, not just inside the dropzone itself.
    //
    // .closest('.pdfev-preview-stage'), not '#pdfev-document-preview': the
    // "Choose File" overlay sits on top as an absolutely-positioned SIBLING,
    // not a child, of #pdfev-document-preview — exactly in the empty-dropzone
    // state this is meant to handle, the actual drop target is the overlay
    // (or its button/text), which .closest('#pdfev-document-preview') would
    // never match.
    $(document).on('dragover', function (e) {
        var dt = e.originalEvent.dataTransfer;
        if (!dt || !dt.types || dt.types.indexOf('Files') === -1) return;
        e.preventDefault();
        var overDropzone = $(e.target).closest('.pdfev-preview-stage').length > 0;
        $('#pdfev-document-preview').toggleClass('pdfev-drag-hover', overDropzone);
    });

    $(document).on('dragleave', function (e) {
        if (!$(e.target).closest('.pdfev-preview-stage').length) return;
        $('#pdfev-document-preview').removeClass('pdfev-drag-hover');
    });

    $(document).on('drop', function (e) {
        var dt = e.originalEvent.dataTransfer;
        if (!dt || !dt.types || dt.types.indexOf('Files') === -1) return;
        e.preventDefault();
        $('#pdfev-document-preview').removeClass('pdfev-drag-hover');

        if (!$(e.target).closest('.pdfev-preview-stage').length) return;

        var file = dt.files && dt.files[0];
        if (!file) return;
        if (file.type !== 'application/pdf') {
            alert('Please drop a PDF file only.');
            return;
        }

        var formData = new FormData();
        formData.append('action', 'pdfev_upload_pdf_file');
        formData.append('ajaxnonce', pdfevAjax.ajaxnonce);
        formData.append('post_id', pdfevAjax.post_id);
        formData.append('pdfev_pdf_file', file);

        var $overlayText = $('.pdfev-upload-overlay p');
        var originalText = $overlayText.text();
        $overlayText.text('Uploading…');

        $.ajax({
            url: pdfevAjax.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (response) {
            if (response.success) {
                $('.pdfev-emd-vwr-file').val(response.data.url);
                $('.pdfev-source-filename').text(response.data.filename);
                renderPDFThumbnails(response.data.url);
            } else {
                alert((response.data && response.data.message) || 'Upload failed.');
            }
        }).fail(function () {
            alert('Upload failed.');
        }).always(function () {
            $overlayText.text(originalText);
        });
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
            $('.pdfev-source-filename').text(attachment.filename || attachment.url.split('/').pop());
            //   $('#pdfev-preview').html(attachment.url);
            renderPDFThumbnails(attachment.url);
            } else {
            alert('Please select a PDF file only.');
            $('.pdfev-emd-vwr-file').val('');
            }
        });
        mediaUploader.open();
    });
    // ======pdf thumbnail generate=========
    // Bumped on every call and captured per-call below — if the file gets
    // cleared/replaced (or the source tab switched) while an older call is
    // still mid-render, that older call notices it's been superseded and
    // stops appending thumbnails instead of racing the newer one and
    // silently re-populating a container the user just cleared.
    let pdfevRenderGeneration = 0;

    async function renderPDFThumbnails(pdfUrl) {
        const myGeneration = ++pdfevRenderGeneration;
        const container = $('#pdfev-document-preview');
        // No "Upload File" toggle exists anymore — drag-and-drop/Choose File
        // is the implicit default whenever the Remote URL panel isn't shown.
        const isUploadMode = !$('.pdfev-source-panel[data-source="remote"]').is(':visible');

        container.show();
        container.find('.pdfev-loader-wrapper').hide();
        container.find('.warning').hide();
        container.removeClass('pdfev-dropzone');
        $('.pdfev-upload-overlay').hide();

        if(!pdfUrl) {
            // A previous file's rendered page thumbnails otherwise stay sitting
            // in the DOM underneath the dropzone overlay/warning — clearing or
            // swapping the file doesn't mean this container was ever emptied.
            container.find('.preview-thumbnail').remove();
            $('.pdfev-replace-bar').hide();
            if (isUploadMode) {
                // No file chosen yet, in Upload mode — show the dropzone-styled
                // "Choose File" overlay instead of the plain text warning below,
                // which is reserved for Remote URL mode (nothing to drag/click there).
                container.addClass('pdfev-dropzone');
                $('.pdfev-upload-overlay').show();
            } else {
                container.find('.warning').show();
            }
            return;
        }

        $('.pdfev-replace-bar').css('display', isUploadMode ? 'flex' : 'none');
        container.find('.pdfev-loader-wrapper').show();
        $('.pdfev-loader-percent').text('');
        pdfjsLib.GlobalWorkerOptions.workerSrc = pdfevAjax.pdfevurl + 'vendor/pdf/pdf.worker.min.js';
        try {
            const response = await fetch(pdfUrl);
            const arrayBuffer = await response.arrayBuffer();
            const fileSizeBytes = arrayBuffer.byteLength;
            console.log("response");
            // Decide between MB and KB
            let fileSizeDisplay = '';
            if (fileSizeBytes < 1024 * 1024) {
                const fileSizeKB = (fileSizeBytes / 1024).toFixed(2);
                fileSizeDisplay = fileSizeKB + ' KB';
            } else {
                const fileSizeMB = (fileSizeBytes / (1024 * 1024)).toFixed(2);
                fileSizeDisplay = fileSizeMB + ' MB';
            }

            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            const totalPages = pdf.numPages;

            if (myGeneration !== pdfevRenderGeneration) return;

            $('.pdfev-filesize').html(fileSizeDisplay);
            $('.pdfev-totalpage').html(totalPages + ' Pages');

            $('#pdfev_meta_filesize').val(fileSizeBytes);
            $('#pdfev_meta_total_pages').val(totalPages);

            // Only the previous file's own thumbnails, not the whole container —
            // wiping everything here would also permanently destroy the (translated)
            // .pdfev-loader-wrapper/.warning markup, which then could never show
            // again for the rest of the page's life once a single file had loaded.
            container.find('.preview-thumbnail').remove();
            let firstImageSet = false;

            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                // A newer call (Clear, Replace, a fresh drag-drop, a tab switch)
                // has taken over since this one started — stop appending pages
                // into a container that isn't "ours" to fill anymore.
                if (myGeneration !== pdfevRenderGeneration) return;

                $('.pdfev-loader-percent').text(Math.round((pageNum / totalPages) * 100) + '%');

                const page = await pdf.getPage(pageNum);
                const scale = 0.2;
                const viewport = page.getViewport({ scale });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                canvas.style.width = "103px";
                canvas.style.height = "auto";
                
                await page.render({ canvasContext: context, viewport }).promise;

                // Convert canvas to image data URL
                const imageData = canvas.toDataURL('image/jpeg');
                var featured_status = $('#pdfev-featured-image').data('status');
                var featured_image = $('#pdfev-featured-image').data('url');
                if(featured_status==='yes'){
                    firstImageSet = true;
                    $('#pdfev-featured-image-preview').attr('src', featured_image).show();
                    $('#pdfev-featured-image-data').val(featured_image);
                }
                
                if (!firstImageSet) {
                    $('#pdfev-featured-image').show();
                    $('#pdfev-featured-image-preview').attr('src', imageData).show();
                    $('#pdfev-featured-image-data').val(imageData);
                    
                    firstImageSet = true;
                }

                const wrapper = document.createElement('div');
                wrapper.classList.add('preview-thumbnail');
                wrapper.appendChild(canvas);

                const label = document.createElement('div');
                label.classList.add('page-number');
                label.innerText = `Page ${pageNum}`;
                wrapper.appendChild(label);

                wrapper.addEventListener('click', function () {
                    $('#pdfev-featured-image').show();
                    $('#pdfev-featured-image-preview').attr('src', imageData).show();
                    $('#pdfev-featured-image-data').val(imageData);
                });

                // Drag this page onto the Featured Image box as an alternative to
                // clicking it — see the dragover/drop handlers on #pdfev-featured-image
                // further down, registered once (not per-thumbnail).
                wrapper.setAttribute('draggable', 'true');
                wrapper.addEventListener('dragstart', function (e) {
                    e.dataTransfer.setData('text/plain', imageData);
                    e.dataTransfer.effectAllowed = 'copy';
                    wrapper.classList.add('dragging');
                });
                wrapper.addEventListener('dragend', function () {
                    wrapper.classList.remove('dragging');
                });

                container.append(wrapper);
            }

            if (myGeneration !== pdfevRenderGeneration) return;
            container.find('.pdfev-loader-wrapper').hide();
        } catch (error) {
            //console.error('Error loading PDF:', error);
            if (myGeneration !== pdfevRenderGeneration) return;
            container.find('.pdfev-loader-wrapper').hide();
            container.find('.warning').show();
        }
    }

    // on ready show preview pdf
    $(document).ready(function(){
        renderPDFThumbnails($('.pdfev-emd-vwr-file').val());
    });

    // ======drag a page thumbnail onto Featured Image to set it as cover=========
    // Delegated + registered once here rather than per-thumbnail in the render
    // loop above, since #pdfev-featured-image itself never gets recreated.
    $(document).on('dragover', '#pdfev-featured-image', function (e) {
        e.preventDefault();
        $(this).addClass('pdfev-drop-active');
    });
    $(document).on('dragleave', '#pdfev-featured-image', function () {
        $(this).removeClass('pdfev-drop-active');
    });
    $(document).on('drop', '#pdfev-featured-image', function (e) {
        e.preventDefault();
        $(this).removeClass('pdfev-drop-active');
        var imageData = e.originalEvent.dataTransfer.getData('text/plain');
        if (!imageData) return;
        $('#pdfev-featured-image').show();
        $('#pdfev-featured-image-preview').attr('src', imageData).show();
        $('#pdfev-featured-image-data').val(imageData);
    });


  // =================Import Demo Content========
  $(document).on('click','.pdfev-import-demo-content',function (e) {
    e.preventDefault();
    $.ajax({
        url: pdfevAjax.ajaxurl,
        type: 'POST',
        data: {
            action: 'pdfev_import_demo_data',
            ajaxnonce: pdfevAjax.ajaxnonce,
            import_status: 'yes',
        },
        beforeSend: function() {
            $('.demo-import-success').html('<span class="pdfev-loader" aria-hidden="true"></span>');
        },
        success: function(response) {
            
            if (response.success) {
                $('.demo-import-success').html(response.message); 
            } else {
                $('.demo-import-success').html('Error: ' + response.message); 
            }
        },
        error: function(xhr, status, error) {
            $('.demo-import-success').html('An error occurred: ' + error);
            console.log('Error:', error);
        }
    });
  });
  // ==============shortcode generate============
  function pdfevGenerateShortcode() {
      const template = document.getElementById("template").value;
      const category = document.getElementById("category").value;
      const limit = document.getElementById("limit").value;
      const order = document.getElementById("order").value;
      const read = document.getElementById("read").value;
      const download = document.getElementById("download").value;
      const show_description = document.getElementById("show_description").value;
      const show_author = document.getElementById("show_author").value;
      const show_publisher = document.getElementById("show_publisher").value;
      const show_year = document.getElementById("show_year").value;
      const show_edition = document.getElementById("show_edition").value;
      const reading_count = document.getElementById("reading_count").value;
      const downloading_count = document.getElementById("downloading_count").value;
      const show_total_pages = document.getElementById("show_total_pages").value;
      const show_filesize = document.getElementById("show_filesize").value;

      const shortcode = `[pdfev_viewer template="${template}" category="${category}" limit="${limit}" order="${order}" read="${read}" download="${download}" reading_count="${reading_count}" downloading_count="${downloading_count}" show_description="${show_description}" show_author="${show_author}" show_publisher="${show_publisher}" show_year="${show_year}" show_edition="${show_edition}" show_total_pages="${show_total_pages}" show_filesize="${show_filesize}"]`;

      $.ajax({
          url: pdfevAjax.ajaxurl,
          type: 'POST',
          data: {
              action: 'pdfev_shortcode_generate',
              ajaxnonce: pdfevAjax.ajaxnonce,
              template: template,
              category: category,
              limit: limit,
              order: order,
              read: read,
              download: download,
              show_description: show_description,
              show_author: show_author,
              show_publisher: show_publisher,
              show_year:show_year,
              show_edition:show_edition,
              reading_count: reading_count,
              downloading_count: downloading_count,
              show_total_pages: show_total_pages,
              show_filesize: show_filesize
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
      $('#show_description').val('yes');
      $('#show_author').val('yes');
      $('#show_publisher').val('yes');
      $('#show_year').val('yes');
      $('#show_edition').val('yes');
      $('#reading_count').val('yes');
      $('#downloading_count').val('yes');
      $('#show_total_pages').val('yes');
      $('#show_filesize').val('yes');

      pdfevGenerateShortcode(); // Trigger generation with default values
  });

  //  ====copy shortcode====
  function pdfevCopyElementText($button, targetElementId) {
    const range = document.createRange();
    const selection = window.getSelection();
    const element = document.getElementById(targetElementId);
    if (!element) return;

    range.selectNodeContents(element);
    selection.removeAllRanges();
    selection.addRange(range);

    var label = $button.find('.pdfev-btn-label');
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            label.text('Copied!');
            setTimeout(() => {
                label.text('Copy');
            }, 1500);
        } else {
            label.text('Failed!');
        }
    } catch (err) {
        console.error('Copy failed', err);
        label.text('Error!');
    }

    selection.removeAllRanges();
  }

  $(document).on('click','#pdfev-copy-shortcode',function (e) {
    e.preventDefault();
    pdfevCopyElementText($(this), 'pdfev-shortcode');
  });

  $(document).on('click','#pdfev-copy-single-shortcode',function (e) {
    e.preventDefault();
    pdfevCopyElementText($(this), 'pdfev-single-shortcode');
  });


})(jQuery);
