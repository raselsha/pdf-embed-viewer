
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


(function($) {
  // This is the click event for the download button counter. In Pro "Hide File
  // URL" mode, the button has no real href (data-protected="yes") — the actual
  // download link is minted fresh by this same AJAX call and only then
  // navigated to, instead of being a static link sitting in the page.
  $(document).on('click','.download-btn',function(e){
    var $button = $(this);
    var post_id = $button.data('post-id');
    var isProtected = $button.attr('data-protected') === 'yes';

    if (isProtected) {
      e.preventDefault();
    }

    $.ajax({
        url: pdfevFronend.ajaxurl,
        type: 'POST',
        data: {
          action: 'pdfev_count_manager_download',
          ajaxnonce: pdfevFronend.ajaxnonce,
          post_id: post_id,
        },
        success: function(response) {
          if (response.success) {
            $button.find('.pdfev-download-counter').html(response.data.download_count);
            if (isProtected && response.data.download_url) {
              window.location.href = response.data.download_url;
            }
          } else {
            $button.find('.pdfev-download-counter').html('Error: ' + response.data.download_count);
          }
      },
      error: function(xhr, status, error) {
          console.log('Error:', error);
      }
    });
  });
  // enable 3D flipbook===========
  $('.pdfev-show-flipbook').on('click', function (e) {
    e.preventDefault();

    var $parent = $(this).closest('.pdfev-display-switcher');
    
    $(this).addClass('active');
    $parent.find('.pdfev-show-traditional').removeClass('active');
    
    $parent.find('.pdfev-3dbook-container').show();
    $parent.find('.pdfev-traditional-container').hide();
    initializeFlipbook();
  });

  $('.pdfev-show-traditional').on('click', function (e) {
    e.preventDefault();
    var $parent = $(this).closest('.pdfev-display-switcher');
    $(this).addClass('active');
    $parent.find('.pdfev-show-flipbook').removeClass('active');
    
    $parent.find('.pdfev-traditional-container').show();
    $parent.find('.pdfev-3dbook-container').hide();
  });

  // ===initialize the flipbook===
  $(document).ready(function(){
    initializeFlipbook();
    initializeProtectedIframes();
  });

  // Pro "Hide File URL" mode: fetches the (stable, permanent) stream token
  // via ajax instead of it ever being printed into the page's own markup,
  // then fetches the actual PDF bytes itself and hands the viewer/iframe a
  // blob: URL instead of the real one. A blob: URL alone is NOT tab-locked —
  // as long as it hasn't been revoked and the creating tab is still open, it
  // stays resolvable from anywhere it's pasted, same-browser or not. The
  // actual protection is revoking it (see revokeBlobUrlSoon below) right
  // after the consuming element has grabbed the bytes it needs — a revoked
  // blob: URL fails everywhere, including the original tab, while an
  // already-loaded resource keeps working since it already has its own copy
  // of the data. Not proof against a deliberately scripted request replaying
  // a stolen Referer header directly against the token endpoint — this
  // raises the bar against casual copy/paste and "view source" link
  // sharing, nothing more.
  function revokeBlobUrlSoon(blobUrl) {
    // A fixed delay, not a load/ready event, because pdf.js's own paging
    // (inside 3dflipbook, a vendored/minified library we don't patch) can
    // re-request the same blob: URL well after the initial page renders —
    // e.g. a reader flipping deep into a long book minutes later — and
    // revoking too early would break that, not just block copy/paste.
    // Trade-off, on purpose: this closes the "stays copyable for as long as
    // the tab is open" gap, but a fast copy within this window still works,
    // and a document a reader takes longer than this to page through could
    // theoretically hit a revoked URL on a not-yet-loaded page. No revoke
    // at all (the previous behavior) is worse — indefinite exposure — so
    // this is the safer default until 3dflipbook exposes a real
    // "fully loaded" callback we can hook instead of a guessed delay.
    setTimeout(function () {
      URL.revokeObjectURL(blobUrl);
    }, 30000);
  }

  // Fetches the full PDF once and hands back both a blob: URL (for the
  // iframe — the browser's own native PDF viewer, unaffected by the bug
  // below) and the raw bytes (for the flipbook — see startFlipbook's use of
  // pdfOpenOptions.data). 3dflipbook's own bundled Utils.normalizeUrl() does
  // a naive split('/') same-host check that corrupts ANY blob: URL handed
  // to it (blob: URLs embed the page's own origin, which always trips that
  // check) — it strips the "blob:" scheme entirely, leaving a URL that
  // doesn't exist, hence 3dflipbook's own "Missing PDF" error. That's a bug
  // in the vendored library itself (not something we patch there — see
  // CLAUDE.md), so instead of relying on a URL at all for the flipbook path,
  // we pass pdf.js the already-fetched bytes directly via pdfOpenOptions.data
  // — pdf.js only sets up network/URL-based fetching when no data is given,
  // so this sidesteps the bug entirely.
  function fetchProtectedPdf(post_id, callback) {
    $.post(pdfevFronend.ajaxurl, {
      action: 'pdfev_get_stream_token',
      ajaxnonce: pdfevFronend.ajaxnonce,
      post_id: post_id,
    }).done(function (response) {
      if (!response.success || !response.data || !response.data.url) {
        callback(null);
        return;
      }
      fetch(response.data.url, { credentials: 'same-origin' })
        .then(function (res) {
          if (!res.ok) throw new Error('Protected PDF fetch failed');
          return res.arrayBuffer();
        })
        .then(function (arrayBuffer) {
          var blobUrl = URL.createObjectURL(new Blob([arrayBuffer], { type: 'application/pdf' }));
          callback({ blobUrl: blobUrl, arrayBuffer: arrayBuffer });
          revokeBlobUrlSoon(blobUrl);
        })
        .catch(function () {
          callback(null);
        });
    }).fail(function () {
      callback(null);
    });
  }

  function initializeProtectedIframes() {
    $('.pdf-viewer[data-pdfev-protected="yes"]').each(function () {
      let $iframe = $(this);
      let post_id = $iframe.data('id');
      fetchProtectedPdf(post_id, function (result) {
        if (result) $iframe.attr('src', result.blobUrl);
      });
    });
  }

  function initializeFlipbook() {
      $('.pdfev-3dbook-viewer').each(function () {
      let $viewer = $(this);
      let post_id = $viewer.data('id');
      let pdfURL = $viewer.data('pdfev-url');
      let isProtected = $viewer.data('pdfev-protected') === 'yes';
      let docRtl = $viewer.data('pdfev-rtl') === 'yes';

      if (!pdfURL && !isProtected) return;

      function startFlipbook(resolvedUrl, pdfBytes) {
        // Pro flipbook options — free/unlicensed installs never receive
        // pdfevFronend.flipbookOptions at all, so proOptions stays {} below,
        // leaving today's defaults untouched.
        let proOptions = pdfevFronend.flipbookOptions || {};
        let skinFile = proOptions.skinFile || "short-black-book-view.css";

        let options = {
          pdf: resolvedUrl,
          page: 1, // or customize per book
          // 3dflipbook's own top-level options only recognize a fixed set of
          // keys (pdf, page, bookStyle, controlsProps, propertiesCallback,
          // template, pdfOpenOptions, ...) — anything else (rtl, page mode,
          // autoplay speed, background color) is silently ignored unless
          // applied through propertiesCallback below, which is the one
          // place the library actually reads/merges custom overrides into
          // its computed book properties.
          bookStyle: proOptions.style || 'volume',
          controlsProps: proOptions.controlsProps,
          propertiesCallback: function (props) {
            // Per-document Reading Direction (metabox, free tier) always
            // wins over Pro's site-wide RTL toggle — a document's language
            // direction is a property of that document, not something one
            // global setting can get right for every book on a
            // multilingual site.
            props.rtl = docRtl;
            if (typeof proOptions.singlePageMode !== 'undefined') {
              props.singlePageMode = proOptions.singlePageMode;
            }
            if (typeof proOptions.autoPlayDuration !== 'undefined') {
              props.autoPlayDuration = proOptions.autoPlayDuration;
            }
            if (proOptions.backgroundColor) {
              props.backgroundColor = proOptions.backgroundColor;
            }
            return props;
          },
          template: function () {
            return {
              html: [
                {
                  url: pdfevFronend.pdfevurl + "vendor/3dflipbook/templates/default-book-view.html",
                  data: jsData.urls["templates/default-book-view.html"],
                },
              ],
              script: [
                {
                  url: pdfevFronend.pdfevurl + "vendor/3dflipbook/js/default-book-view.js",
                  data: jsData.urls["js/default-book-view.js"],
                },
              ],
              styles: [
                {
                  url: pdfevFronend.pdfevurl + "vendor/3dflipbook/css/font-awesome.min.css",
                  data: jsData.urls["css/font-awesome.min.css"],
                },
                {
                  url: pdfevFronend.pdfevurl + "vendor/3dflipbook/css/" + skinFile,
                  data: jsData.urls["css/" + skinFile],
                },
              ],
              sounds: {
                startFlip: pdfevFronend.pdfevurl + "vendor/3dflipbook/sounds/start-flip.mp3",
                endFlip: pdfevFronend.pdfevurl + "vendor/3dflipbook/sounds/end-flip.mp3",
              },
              init: undefined,
            };
          },
        };

        // Bypass 3dflipbook's own normalizeUrl() bug (see fetchProtectedPdf's
        // comment above) by giving pdf.js the already-fetched bytes directly
        // instead of relying on the (corrupted) blob: URL for loading.
        if (pdfBytes) {
          options.pdfOpenOptions = { data: new Uint8Array(pdfBytes) };
        }

        $viewer.FlipBook(options);
      }

      if (isProtected) {
        fetchProtectedPdf(post_id, function (result) {
          if (result) startFlipbook(result.blobUrl, result.arrayBuffer);
        });
      } else {
        startFlipbook(pdfURL);
      }
    });
  }


})(jQuery);

// ============load more for archive===========
(function($) {
  $(document).on('click', '.pdfev-load-more-button', function(e) {
    e.preventDefault();
    var $button = $(this);
    var template = $button.data('template');
    var nextPage = parseInt($button.data('next-page')) || 2;
    var category = $button.data('category') || '';
    var limit = $button.data('limit') || '';
    var order = $button.data('order') || '';
    var read = $button.data('read') || '';
    var download = $button.data('download') || '';
    var showDescription = $button.data('show-description') || '';
    var showAuthor = $button.data('show-author') || '';
    var showPublisher = $button.data('show-publisher') || '';
    var showYear = $button.data('show-year') || '';
    var showEdition = $button.data('show-edition') || '';
    var year = $button.data('year') || '';
    $button.prop('disabled', true).text(pdfevFronend.load_more_loading_text || 'Loading...');

    $.ajax({
      url: pdfevFronend.ajaxurl,
      type: 'POST',
      dataType: 'json',
      data: {
        action: 'pdfev_load_more_archive',
        ajaxnonce: pdfevFronend.ajaxnonce,
        template: template,
        page: nextPage,
        category: category,
        limit: limit,
        order: order,
        read: read,
        download: download,
        show_description: showDescription,
        show_author: showAuthor,
        show_publisher: showPublisher,
        show_year: showYear,
        show_edition: showEdition,
      },
      success: function(response) {
        if (response.success) {
          var html = response.data.html || '';
          if (template === 'list') {
            $button.closest('.archive-list-style').find('.pdfev-load-more-items').append(html);
          } else if (template === 'grid') {
            $button.closest('.archive-grid-style').find('.pdfev-load-more-items').append(html);
          } else if (template === 'ebook') {
            $button.closest('.archive-ebook-style').find('.pdfev-load-more-items').append(html);
          } else if (template === 'newsletter') {
            var target = $('#year-' + year).find('tbody');
            if (target.length === 0) {
              target = $('#year-' + year);
            }
            target.append(html);
          }
          if (response.data.has_more) {
            $button.data('current-page', response.data.next_page);
            $button.data('next-page', response.data.next_page + 1);
            $button.prop('disabled', false).text(pdfevFronend.load_more_text || 'Load More');
          } else {
            $button.hide();
          }
        } else {
          $button.prop('disabled', false).text(pdfevFronend.load_more_text || 'Load More');
          console.log(response.data || response);
        }
      },
      error: function() {
        $button.prop('disabled', false).text(pdfevFronend.load_more_text || 'Load More');
      }
    });
  });
})(jQuery);

// ============metabox scripts========
