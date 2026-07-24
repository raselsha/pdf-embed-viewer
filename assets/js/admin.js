(function($){
  // ===========color picker=================
  $(document).ready(function() {
    // wpColorPicker() builds its own clickable swatch button in front of the
    // original input — disabling the input alone doesn't disable that button,
    // so locked/Pro fields must be excluded here rather than left clickable.
    $('.pdfev-color-field:not(:disabled)').wpColorPicker();
  });

  // ===========sync with WordPress's native Featured Image box=================
  // This CPT isn't REST-enabled, so it uses the classic #postimagediv meta
  // box (wp-includes/js/media-editor.js), not the block editor's own
  // featured-image panel. WP core funnels both "set" and "remove" through
  // wp.media.featuredImage.set(id) (id === -1 for remove) — there's no
  // change event to listen for, so this wraps that single choke point
  // instead, letting the original run first and then mirroring whatever it
  // did into the Book Cover panel, without needing a page reload.
  if (window.wp && wp.media && wp.media.featuredImage) {
    var pdfevOriginalSetFeaturedImage = wp.media.featuredImage.set;
    wp.media.featuredImage.set = function (id) {
      pdfevOriginalSetFeaturedImage.apply(this, arguments);

      if (!id || id === -1 || id === '-1') {
        $('#pdfev-featured-image-preview').attr('src', '').hide();
        $('.pdfev-featured-image-placeholder').css('display', 'flex');
        $('#pdfev-featured-image-data').val('');
        $('#pdfev-featured-image').data('status', 'no').data('url', '');
        return;
      }

      wp.media.attachment(id).fetch().done(function () {
        var url = wp.media.attachment(id).get('url');
        $('#pdfev-featured-image-preview').attr('src', url).css('display', 'block');
        $('.pdfev-featured-image-placeholder').css('display', 'none');
        $('#pdfev-featured-image-data').val(url);
        $('#pdfev-featured-image').data('status', 'yes').data('url', url);
      });
    };
  }

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
  // Both the top-level settings-page tabs (.nav-tab) and the post-edit
  // metabox tabs (li.pdfev-tab) share this same [data-tab-target] click
  // handler, but persist under their OWN separate storage keys — using one
  // shared key would mean clicking a metabox tab clobbers the remembered
  // settings-page tab (or vice versa), since the two screens don't share a
  // DOM (only one of .nav-tab/.pdfev-tab ever exists on a given page, so
  // there's never a collision between the two restores below either).
  var pdfevTabStorageKey = 'pdfevActiveTab';
  var pdfevMetaboxTabStorageKey = 'pdfevActiveMetaboxTab';
  $(document).on('click','[data-tab-target]',function(){
    $('[data-tab-target]').removeClass('active');
    $(this).addClass('active');
    var target = $(this).data('tab-target');
    $('.pdfev-tab-content').removeClass('active');
    $('[data-tab="' + target + '"]').addClass('active');
    if ($(this).hasClass('nav-tab')) {
      try { localStorage.setItem(pdfevTabStorageKey, target); } catch (e) {}
    } else if ($(this).hasClass('pdfev-tab')) {
      try { localStorage.setItem(pdfevMetaboxTabStorageKey, target); } catch (e) {}
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
      var savedMetaboxTab = localStorage.getItem(pdfevMetaboxTabStorageKey);
      if (savedMetaboxTab) {
        var $metaboxTabBtn = $('.pdfev-tab[data-tab-target="' + savedMetaboxTab + '"]');
        if ($metaboxTabBtn.length) { $metaboxTabBtn.trigger('click'); }
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
    // the Remote URL row it switches to (inline in .pdfev-replace-bar, not
    // a separate floating panel — same spot either way).
    $(document).on('click', '.pdfev-source-link', function (e) {
        e.preventDefault();
        var showRemote = $(this).data('source-target') === 'remote';

        // Switching source type abandons whatever was pending for the other
        // type — simpler/more predictable than trying to remember and
        // restore two different pending sources across switches.
        $('.pdfev-emd-vwr-file').val('');
        $('.pdfev-source-filename').text('');
        $('#pdfev-remote-url-input').val('');
        $('#pdfev_meta_filesize').val('');
        $('#pdfev_meta_total_pages').val('');
        $('.pdfev-filesize').text('');
        $('.pdfev-totalpage').text('');

        $('.pdfev-replace-bar-upload').css('display', 'none');
        $('.pdfev-replace-bar-remote').css('display', showRemote ? 'flex' : 'none');
        $('.pdfev-replace-bar').css('display', showRemote ? 'block' : 'none');

        renderPDFThumbnails('');

        if (showRemote) {
            $('#pdfev-remote-url-input').trigger('focus');
        }
    });

    // A direct fetch() of a cross-origin PDF almost always gets blocked by
    // CORS (most hosts don't send Access-Control-Allow-Origin for arbitrary
    // files) — route it through this site's own pdfev_proxy endpoint instead,
    // exactly like PDFEV_Functions::get_pdf_link() already does server-side
    // for a saved remote URL. Used for every preview fetch (initial page
    // load included), never for .pdfev-emd-vwr-file itself — that hidden
    // field (what actually gets saved) always keeps the raw URL.
    function pdfevResolvePreviewUrl(url) {
        if (!url) return url;
        try {
            var parsed = new URL(url, window.location.href);
            if (parsed.host !== window.location.host) {
                return window.location.origin + '/?pdfev_proxy=' + encodeURIComponent(url);
            }
        } catch (err) {
            return url;
        }
        return url;
    }

    // The remote URL box has no name attribute on purpose (only one field,
    // the hidden .pdfev-emd-vwr-file, should ever get submitted) — this
    // keeps that hidden field's value in sync as the admin types, and
    // debounces a preview reload so it doesn't fetch on every keystroke,
    // just once typing pauses. Enter/blur trigger it immediately too.
    let pdfevRemoteUrlTimer = null;

    function pdfevMaybeLoadRemoteUrl(url) {
        clearTimeout(pdfevRemoteUrlTimer);
        if (url.indexOf('://') === -1) return;
        renderPDFThumbnails(pdfevResolvePreviewUrl(url));
    }

    $(document).on('input', '#pdfev-remote-url-input', function () {
        var url = $(this).val();
        $('.pdfev-emd-vwr-file').val(url);

        clearTimeout(pdfevRemoteUrlTimer);
        pdfevRemoteUrlTimer = setTimeout(function () {
            pdfevMaybeLoadRemoteUrl(url);
        }, 700);
    });

    $(document).on('blur', '#pdfev-remote-url-input', function () {
        pdfevMaybeLoadRemoteUrl($(this).val());
    });

    $(document).on('keydown', '#pdfev-remote-url-input', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            pdfevMaybeLoadRemoteUrl($(this).val());
        }
    });

    // ======clear the currently chosen file/URL=========
    // Shared by both rows' clear buttons — .pdfev-replace-bar-upload's
    // (clears a locally uploaded file) and .pdfev-replace-bar-remote's
    // (clears a remote URL). Which one fires just depends on which row the
    // click happened in; the reset itself is identical either way.
    $(document).on('click', '.pdfev-clear-file', function (e) {
        e.preventDefault();
        var wasRemote = $(this).closest('.pdfev-replace-bar-remote').length > 0;

        $('.pdfev-emd-vwr-file').val('');
        $('.pdfev-source-filename').text('');
        $('#pdfev-remote-url-input').val('');
        $('#pdfev_meta_filesize').val('');
        $('#pdfev_meta_total_pages').val('');
        $('.pdfev-filesize').text('');
        $('.pdfev-totalpage').text('');
        $('#pdfev-featured-image-data').val('');
        $('#pdfev-featured-image-preview').attr('src', '').hide();
        // .css('display', 'flex'), not .show() — same reasoning as
        // .pdfev-upload-overlay: this class's own default rule is
        // display:none, so jQuery's show() would restore the browser's
        // plain <div> default (block) instead of the flex layout its
        // icon+text need to stay centered.
        $('.pdfev-featured-image-placeholder').css('display', 'flex');
        $('#pdfev-featured-image').data('status', 'no').data('url', '');

        // Stay in whichever mode was just cleared — clearing a remote URL
        // should leave the (now empty) URL row in place, ready to type a
        // new one, not silently fall back to the upload dropzone.
        $('.pdfev-replace-bar-upload').css('display', 'none');
        $('.pdfev-replace-bar-remote').css('display', wasRemote ? 'flex' : 'none');
        $('.pdfev-replace-bar').css('display', wasRemote ? 'block' : 'none');

        renderPDFThumbnails('');
    });

    // ======"Download to Media Library" for a remote URL=========
    // Fetches the URL server-side and saves it as a local attachment, then
    // switches the UI to upload mode pointed at that new local file — same
    // end state as if it had been chosen via Choose File. Note: a host that
    // gates its files behind a JS-executing anti-bot challenge (some free
    // hosting providers) will fail here too — the server can't run that
    // JS any more than the browser's own fetch could bypass CORS for it.
    $(document).on('click', '.pdfev-clone-remote-btn', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var url = $('#pdfev-remote-url-input').val();

        if (!url) {
            alert('Please enter a URL first.');
            return;
        }

        var $label = $btn.find('.pdfev-btn-label');
        var originalLabel = $label.text();
        $btn.prop('disabled', true);
        $label.text('Downloading…');

        $.ajax({
            url: pdfevAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'pdfev_clone_remote_pdf',
                ajaxnonce: pdfevAjax.ajaxnonce,
                post_id: pdfevAjax.post_id,
                url: url,
            },
        }).done(function (response) {
            if (response.success) {
                $('.pdfev-emd-vwr-file').val(response.data.url);
                $('.pdfev-source-filename').text(response.data.filename);
                $('#pdfev-remote-url-input').val('');

                $('.pdfev-replace-bar-remote').css('display', 'none');
                $('.pdfev-replace-bar-upload').css('display', 'flex');
                $('.pdfev-replace-bar').css('display', 'block');

                renderPDFThumbnails(response.data.url);
            } else {
                alert((response.data && response.data.message) || 'Could not download that URL.');
            }
        }).fail(function () {
            alert('Could not download that URL.');
        }).always(function () {
            $btn.prop('disabled', false);
            $label.text(originalLabel);
        });
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
    // Matches the SVG circle's r=24 in the loader markup (2 * PI * 24) — kept
    // as one constant so the ring's CSS and this JS never drift out of sync.
    const PDFEV_RING_CIRCUMFERENCE = 150.8;

    // The grid of page thumbnails only ever displays at ~103px wide, so it's
    // rendered small (fast, light on memory even across a 100+ page doc).
    // The Book Cover panel shows much bigger (up to 70% of its own panel),
    // so reusing that same low-res canvas for it looked blurry/upscaled —
    // whichever page becomes the cover gets re-rendered at this higher scale
    // instead, on demand (auto-select, click, or drag-drop), not for all pages.
    const PDFEV_COVER_SCALE = 1.2;

    // Kept in sync with whichever renderPDFThumbnails() call is currently
    // "live" (matches the generation-counter pattern) so the drag-and-drop-
    // onto-Featured-Image handler below — registered once, outside this
    // function's closure — can re-render a specific page at cover quality
    // without needing the low-res dataURL threaded through dataTransfer.
    let pdfevCurrentPdfDoc = null;

    async function pdfevRenderPageDataUrl(page, scale) {
        const viewport = page.getViewport({ scale });
        const canvas = document.createElement('canvas');
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
        return canvas.toDataURL('image/jpeg', 0.92);
    }

    async function renderPDFThumbnails(pdfUrl) {
        const myGeneration = ++pdfevRenderGeneration;
        const container = $('#pdfev-document-preview');
        // No "Upload File" toggle exists anymore — drag-and-drop/Choose File
        // is the implicit default whenever the Remote URL row isn't shown.
        const isUploadMode = !$('.pdfev-replace-bar-remote').is(':visible');

        container.show();
        container.find('.pdfev-loader-wrapper').hide();
        container.removeClass('pdfev-loading');
        container.find('.warning').hide();
        container.removeClass('pdfev-dropzone');
        // .css('display', ...), not .hide()/.show() — this element is a flex
        // container (centers its content via align-items/justify-content).
        // jQuery's show()/hide() don't know that: show() restores a plain
        // <div>'s browser-default display, which is "block", silently
        // dropping back to top-anchored content instead of centered.
        $('.pdfev-upload-overlay').css('display', 'none');

        if(!pdfUrl) {
            // A previous file's rendered page thumbnails otherwise stay sitting
            // in the DOM underneath the dropzone overlay/warning — clearing or
            // swapping the file doesn't mean this container was ever emptied.
            container.find('.preview-thumbnail').remove();
            if (isUploadMode) {
                // No file chosen yet, in Upload mode — show the dropzone-styled
                // "Choose File" overlay instead of the plain text warning below,
                // which is reserved for Remote URL mode (nothing to drag/click there).
                // The bar itself (a locally-uploaded file's row) has nothing to
                // show here, so it stays hidden too.
                $('.pdfev-replace-bar').css('display', 'none');
                container.addClass('pdfev-dropzone');
                $('.pdfev-upload-overlay').css('display', 'flex');
            } else {
                // Remote mode, nothing loaded yet — the bar (with its now-empty
                // URL input) stays visible; that input IS the entry point here,
                // there's no separate dropzone to fall back to.
                $('.pdfev-replace-bar').css('display', 'block');
                container.find('.warning').show();
            }
            return;
        }

        $('.pdfev-replace-bar').css('display', 'block');
        $('.pdfev-replace-bar-upload').css('display', isUploadMode ? 'flex' : 'none');
        $('.pdfev-replace-bar-remote').css('display', isUploadMode ? 'none' : 'flex');
        container.find('.pdfev-loader-wrapper').show();
        container.addClass('pdfev-loading');
        $('.pdfev-loader-percent').text('0%');
        $('.pdfev-progress-ring-fill').css('stroke-dashoffset', PDFEV_RING_CIRCUMFERENCE);
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
            pdfevCurrentPdfDoc = pdf;

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

                const loadPercent = Math.round((pageNum / totalPages) * 100);
                $('.pdfev-loader-percent').text(loadPercent + '%');
                $('.pdfev-progress-ring-fill').css('stroke-dashoffset', PDFEV_RING_CIRCUMFERENCE * (1 - loadPercent / 100));

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
                    $('#pdfev-featured-image-preview').attr('src', featured_image).css('display', 'block');
                    $('.pdfev-featured-image-placeholder').hide();
                    $('#pdfev-featured-image-data').val(featured_image);
                }

                if (!firstImageSet) {
                    // Re-rendered at cover quality — imageData here is the
                    // low-res ~103px-wide grid thumbnail, too soft once
                    // stretched to the Book Cover panel's size.
                    firstImageSet = true;
                    const coverImageData = await pdfevRenderPageDataUrl(page, PDFEV_COVER_SCALE);
                    if (myGeneration !== pdfevRenderGeneration) return;
                    $('#pdfev-featured-image').show();
                    $('#pdfev-featured-image-preview').attr('src', coverImageData).css('display', 'block');
                    $('.pdfev-featured-image-placeholder').hide();
                    $('#pdfev-featured-image-data').val(coverImageData);
                }

                const wrapper = document.createElement('div');
                wrapper.classList.add('preview-thumbnail');
                wrapper.appendChild(canvas);

                const label = document.createElement('div');
                label.classList.add('page-number');
                label.innerText = `Page ${pageNum}`;
                wrapper.appendChild(label);

                wrapper.addEventListener('click', async function () {
                    // Re-render this page at cover quality rather than reusing
                    // the low-res grid thumbnail — see PDFEV_COVER_SCALE above.
                    const coverImageData = await pdfevRenderPageDataUrl(page, PDFEV_COVER_SCALE);
                    $('#pdfev-featured-image').show();
                    $('#pdfev-featured-image-preview').attr('src', coverImageData).css('display', 'block');
                    $('.pdfev-featured-image-placeholder').hide();
                    $('#pdfev-featured-image-data').val(coverImageData);
                });

                // Drag this page onto the Featured Image box as an alternative to
                // clicking it — see the dragover/drop handlers on #pdfev-featured-image
                // further down, registered once (not per-thumbnail). Only the page
                // number crosses dataTransfer, not image data, so the drop handler
                // can re-render at cover quality (pdfevCurrentPdfDoc) instead of
                // reusing this low-res grid thumbnail.
                wrapper.setAttribute('draggable', 'true');
                wrapper.addEventListener('dragstart', function (e) {
                    e.dataTransfer.setData('text/plain', String(pageNum));
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
            container.removeClass('pdfev-loading');
        } catch (error) {
            //console.error('Error loading PDF:', error);
            if (myGeneration !== pdfevRenderGeneration) return;
            container.find('.pdfev-loader-wrapper').hide();
            container.removeClass('pdfev-loading');
            container.find('.warning').show();
        }
    }

    // on ready show preview pdf
    $(document).ready(function(){
        renderPDFThumbnails(pdfevResolvePreviewUrl($('.pdfev-emd-vwr-file').val()));
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
    $(document).on('drop', '#pdfev-featured-image', async function (e) {
        e.preventDefault();
        $(this).removeClass('pdfev-drop-active');
        var pageNum = parseInt(e.originalEvent.dataTransfer.getData('text/plain'), 10);
        if (!pageNum || !pdfevCurrentPdfDoc) return;
        // Re-render at cover quality rather than the low-res grid thumbnail
        // dragstart only hands over a page number for exactly this reason.
        var page = await pdfevCurrentPdfDoc.getPage(pageNum);
        var coverImageData = await pdfevRenderPageDataUrl(page, PDFEV_COVER_SCALE);
        $('#pdfev-featured-image').show();
        $('#pdfev-featured-image-preview').attr('src', coverImageData).css('display', 'block');
        $('.pdfev-featured-image-placeholder').hide();
        $('#pdfev-featured-image-data').val(coverImageData);
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
