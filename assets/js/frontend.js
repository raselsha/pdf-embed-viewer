
// ============custom data tabs===========
// Scoped per .archive-newsletter-style block so several newsletter archives
// (e.g. one per category) can sit on the same page independently.
jQuery(document).ready(function ($) {
  $('.archive-newsletter-style').each(function () {
    var $box = $(this);
    $box.find('[data-tab-target]').removeClass('active').first().addClass('active');
    $box.find('[data-tab-content]').removeClass('active').first().addClass('active');
  });
  $(document).on('click', '.archive-newsletter-style [data-tab-target]', function () {
    var $box = $(this).closest('.archive-newsletter-style');
    $box.find('[data-tab-content]').removeClass('active');
    $box.find('[data-tab-target]').removeClass('active');
    $(this).addClass('active');
    $box.find($(this).data('tab-target')).addClass('active');
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
    initScrollReaders();
  });

  // ===initialize the flipbook===
  $(document).ready(function(){
    initializeFlipbook();
    initializeProtectedIframes();
    initScrollReaders();
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
  var protectedPdfCache = {};

  function preloaderHtml() {
    return '<div class="pdfev-preloader" role="status" aria-label="Loading">' +
      '<div class="book-frame"><div class="left-page"></div><div class="right-page"></div>' +
      '<div class="flipping-page page-1"></div><div class="flipping-page page-2"></div><div class="flipping-page page-3"></div></div></div>';
  }

  function unmaskBytes(arrayBuffer, keyB64) {
    var key = Uint8Array.from(atob(keyB64), function (c) { return c.charCodeAt(0); });
    var bytes = new Uint8Array(arrayBuffer);
    for (var i = 0, k = key.length; i < bytes.length; i++) {
      bytes[i] ^= key[i % k];
    }
    return arrayBuffer;
  }

  // One shared download per PDF per page view: the flipbook and the scroll
  // reader both get the same bytes instead of fetching the file twice.
  function fetchProtectedPdf(post_id, callback) {
    if (!protectedPdfCache[post_id]) {
      protectedPdfCache[post_id] = loadProtectedPdf(post_id);
    }
    protectedPdfCache[post_id].then(function (result) {
      // Hand each consumer its own copy — pdf.js may transfer (detach) the
      // buffer it is given to its worker.
      callback(result ? { blobUrl: result.blobUrl, arrayBuffer: result.arrayBuffer.slice(0) } : null);
    });
  }

  // A page served from a full-page cache can carry an expired nonce; on a
  // 403 fetch a fresh one once and retry.
  function refreshNonce() {
    return fetch(pdfevFronend.ajaxurl, {
      method: 'POST',
      body: new URLSearchParams({ action: 'pdfev_refresh_nonce' }),
      credentials: 'same-origin',
      cache: 'no-store'
    }).then(function (r) { return r.json(); }).then(function (j) {
      if (j && j.success && j.data && j.data.nonce) pdfevFronend.ajaxnonce = j.data.nonce;
    });
  }

  function loadProtectedPdf(post_id, retried) {
    // Request already started inline next to the viewer markup?
    var pre = !retried && window.__pdfevPrefetch && window.__pdfevPrefetch[post_id];
    if (pre) {
      delete window.__pdfevPrefetch[post_id];
      return pre.then(function (res) {
        return res ? handleProtectedResponse(res, post_id, false) : loadProtectedPdf(post_id, false, true);
      });
    }
    var body = new URLSearchParams({
      action: 'pdfev_get_stream_token',
      ajaxnonce: pdfevFronend.ajaxnonce,
      post_id: post_id,
      inline: '1'
    });
    return fetch(pdfevFronend.ajaxurl, { method: 'POST', body: body, credentials: 'same-origin', cache: 'no-store' })
      .then(function (res) { return handleProtectedResponse(res, post_id, retried); });
  }

  // The ebook shelf's page-2 preview (further down) uses the same protected
  // request. It reuses bytes the viewer already holds, otherwise loads them
  // uncached: it renders one page and lets the bytes go.
  window.pdfevLoadProtectedPdf = function (post_id) {
    if (protectedPdfCache[post_id]) {
      return protectedPdfCache[post_id].then(function (r) {
        return r ? { blobUrl: r.blobUrl, arrayBuffer: r.arrayBuffer.slice(0) } : null;
      });
    }
    return loadProtectedPdf(post_id);
  };

  function handleProtectedResponse(res, post_id, retried) {
    return Promise.resolve(res)
      .then(function (res) {
        if (res.status === 403 && !retried) {
          return refreshNonce().then(function () { return { retry: true }; });
        }
        if (!res.ok) throw new Error('Protected PDF request failed');
        return res;
      })
      .then(function (res) {
        if (res.retry) return loadProtectedPdf(post_id, true);
        var type = res.headers.get('Content-Type') || '';
        // Add-ons that answer with the bytes directly (Pro Lockdown): masked
        // payload, key in a header — no second request, no blob: URL.
        if (type.indexOf('application/octet-stream') === 0) {
          var key = res.headers.get('X-Pdfev-Key');
          return res.arrayBuffer().then(function (buf) {
            return { blobUrl: null, arrayBuffer: key ? unmaskBytes(buf, key) : buf };
          });
        }
        // Otherwise a JSON ticket with a URL to fetch (Hide File URL).
        return res.json().then(function (response) {
          if (!response.success || !response.data || !response.data.url) return null;
          return fetch(response.data.url, { credentials: 'same-origin', cache: 'no-store' })
            .then(function (r) {
              if (!r.ok) throw new Error('Protected PDF fetch failed');
              return r.arrayBuffer();
            })
            .then(function (buf) {
              if (response.data.key) unmaskBytes(buf, response.data.key);
              if (response.data.no_blob) return { blobUrl: null, arrayBuffer: buf };
              var blobUrl = URL.createObjectURL(new Blob([buf], { type: 'application/pdf' }));
              revokeBlobUrlSoon(blobUrl);
              return { blobUrl: blobUrl, arrayBuffer: buf };
            });
        });
      })
      .catch(function () { return null; });
  }

  function initializeProtectedIframes() {
    $('.pdf-viewer[data-pdfev-protected="yes"]').each(function () {
      let $iframe = $(this);
      let post_id = $iframe.data('id');
      fetchProtectedPdf(post_id, function (result) {
        if (result && result.blobUrl) $iframe.attr('src', result.blobUrl);
      });
    });
  }

  // ===Scroll reader (the "Traditional" view)===
  // pdf.js renders each page onto a canvas, lazily as it nears the viewport.
  // Same look and behaviour in every browser (phones included), and no
  // browser PDF viewer with its own Save/Print buttons. In Pro's protected
  // mode the bytes come from fetchProtectedPdf(), never from a printed URL.
  function initScrollReaders() {
    $('.pdfev-scroll-reader').each(function () {
      var $reader = $(this);
      if ($reader.data('pdfevScroll') || !$reader.is(':visible')) return;
      $reader.data('pdfevScroll', true);
      if (typeof pdfjsLib === 'undefined') return;
      if (!pdfjsLib.GlobalWorkerOptions.workerSrc) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = pdfevFronend.pdfevurl + 'vendor/pdf/pdf.worker.min.js';
      }
      var open = function (source) {
        pdfjsLib.getDocument(source).promise.then(function (pdf) {
          buildScrollReader($reader, pdf);
        }).catch(function () {
          $reader.find('.pdfev-scroll-loading').text(pdfevFronend.scroll_error_text || 'This PDF could not be loaded.');
        });
      };
      if ($reader.data('pdfev-protected') === 'yes') {
        fetchProtectedPdf($reader.data('id'), function (result) {
          if (result) open({ data: new Uint8Array(result.arrayBuffer) });
          else $reader.find('.pdfev-scroll-loading').text(pdfevFronend.load_error_text || 'This PDF could not be loaded. Please reload the page.');
        });
      } else {
        open({ url: $reader.data('pdfev-url') });
      }
    });
  }

  function buildScrollReader($reader, pdf) {
    var $pages = $reader.find('.pdfev-scroll-pages');
    var zoom = 1;
    var pageEls = [];
    var renderTokens = [];

    $reader.find('.pdfev-scroll-total').text(pdf.numPages);
    $pages.empty();

    for (var i = 1; i <= pdf.numPages; i++) {
      var el = document.createElement('div');
      el.className = 'pdfev-scroll-page';
      el.setAttribute('data-page', i);
      el.setAttribute('aria-label', 'Page ' + i);
      $pages[0].appendChild(el);
      pageEls.push(el);
    }

    // Page boxes are sized from page 1 so the scrollbar is right before any
    // page renders; each page corrects its own height once it is drawn.
    var ratio = 1.414;
    // Fit width = the scroll area minus its own side padding (read from CSS,
    // so the phone layout's tighter padding is used automatically).
    function width() {
      var cs = window.getComputedStyle($pages[0]);
      var inner = $pages[0].clientWidth - parseFloat(cs.paddingLeft) - parseFloat(cs.paddingRight);
      return Math.max(120, inner * zoom);
    }
    function sizeBoxes() {
      var w = width();
      pageEls.forEach(function (el) {
        el.style.width = w + 'px';
        el.style.height = (w * (el._ratio || ratio)) + 'px';
      });
      $reader.find('.pdfev-scroll-zoom').text(Math.round(zoom * 100) + '%');
    }

    function renderPage(el) {
      var n = parseInt(el.getAttribute('data-page'), 10);
      var token = (renderTokens[n] || 0) + 1;
      renderTokens[n] = token;
      pdf.getPage(n).then(function (page) {
        var base = page.getViewport({ scale: 1 });
        el._ratio = base.height / base.width;
        var w = width();
        el.style.height = (w * el._ratio) + 'px';
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var viewport = page.getViewport({ scale: (w / base.width) * dpr });
        var canvas = document.createElement('canvas');
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        return page.render({ canvasContext: canvas.getContext('2d'), viewport: viewport }).promise.then(function () {
          if (renderTokens[n] !== token) return; // a newer zoom level won
          el.innerHTML = '';
          el.appendChild(canvas);
          el.setAttribute('data-rendered', 'yes');
        });
      });
    }

    var lazy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && entry.target.getAttribute('data-rendered') !== 'yes') {
          renderPage(entry.target);
        }
      });
    }, { root: $pages[0], rootMargin: '800px 0px' });

    var visible = {};
    var tracker = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        visible[entry.target.getAttribute('data-page')] = entry.intersectionRatio;
      });
      var best = 1, bestRatio = -1;
      Object.keys(visible).forEach(function (k) {
        if (visible[k] > bestRatio) { bestRatio = visible[k]; best = k; }
      });
      $reader.find('.pdfev-scroll-current').text(best);
    }, { root: $pages[0], threshold: [0, 0.25, 0.5, 0.75, 1] });

    sizeBoxes();
    pageEls.forEach(function (el) { lazy.observe(el); tracker.observe(el); });

    function rerender() {
      sizeBoxes();
      pageEls.forEach(function (el) {
        if (el.getAttribute('data-rendered') === 'yes') {
          el.removeAttribute('data-rendered');
          renderPage(el);
        }
      });
    }

    $reader.on('click', '.pdfev-scroll-btn', function () {
      var action = $(this).data('action');
      if (action === 'zoom-in') zoom = Math.min(3, Math.round((zoom + 0.25) * 100) / 100);
      if (action === 'zoom-out') zoom = Math.max(0.5, Math.round((zoom - 0.25) * 100) / 100);
      if (action === 'fit') zoom = 1;
      if (action === 'fullscreen') {
        var node = $reader[0];
        if (document.fullscreenElement) { document.exitFullscreen(); }
        else if (node.requestFullscreen) { node.requestFullscreen(); }
        return;
      }
      rerender();
    });

    // Re-fit whenever the reader's own width changes (rotation, sidebar,
    // the reader being shown after it was built) — not just window resize.
    var resizeTimer, lastWidth = $pages[0].clientWidth;
    var refit = function () {
      if ($pages[0].clientWidth === lastWidth) return;
      lastWidth = $pages[0].clientWidth;
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(rerender, 150);
    };
    if (window.ResizeObserver) {
      new ResizeObserver(refit).observe($pages[0]);
    } else {
      $(window).on('resize', refit);
    }
    document.addEventListener('fullscreenchange', function () { setTimeout(rerender, 100); });

    // The pages are canvases already; this just stops the casual
    // right-click → "Save image as…" on a single page.
    $pages.on('contextmenu', 'canvas', function (e) { e.preventDefault(); });

    $reader.trigger('pdfev:scroll-reader-ready', [pdf]);
  }

  function initializeFlipbook() {
      $('.pdfev-3dbook-viewer').each(function () {
      let $viewer = $(this);
      let post_id = $viewer.data('id');
      let pdfURL = $viewer.data('pdfev-url');
      let isProtected = $viewer.data('pdfev-protected') === 'yes';
      let docRtl = $viewer.data('pdfev-rtl') === 'yes';

      if (!pdfURL && !isProtected) return;

      // Add-on flag (Pro): on narrow screens always open in single-page view.
      // The library's own "mobile" test is based on the stage's diagonal, which
      // a tall phone stage can exceed, so it is forced here by viewport width.
      function mobileControls(proOptions) {
        var controls = $.extend(true, {}, proOptions.controlsProps || {});
        if (proOptions.mobileSinglePage && window.matchMedia && window.matchMedia('(max-width: 767px)').matches) {
          controls.actions = controls.actions || {};
          controls.actions.cmdSinglePage = $.extend({}, controls.actions.cmdSinglePage, { active: true, activeForMobile: true });
        }
        return $.isEmptyObject(controls) ? undefined : controls;
      }

      function startFlipbook(resolvedUrl, pdfBytes, openOptions) {
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
          controlsProps: mobileControls(proOptions),
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
        if (openOptions) {
          options.pdfOpenOptions = openOptions;
        } else if (pdfBytes) {
          options.pdfOpenOptions = { data: new Uint8Array(pdfBytes) };
        } else {
          // 3dflipbook's default pdf.js config leaves HTTP Range requests
          // enabled (disableRange: false) so it can lazily fetch pages on
          // demand. Some hosts/CDNs (seen on Pantheon, and others that
          // gzip-compress or otherwise mangle Range responses for PDF
          // files) advertise Range support but return bytes that don't
          // match what pdf.js's xref table expects, which surfaces as a
          // "Bad end offset" parse error and a blank viewer. Forcing a
          // single plain full-file fetch sidesteps that whole class of
          // host/CDN Range bugs at the cost of not lazily streaming very
          // large PDFs.
          options.pdfOpenOptions = { disableRange: true, disableStream: true };
        }

        $viewer.FlipBook(options);
      }

      var pdfSize = parseInt($viewer.attr('data-pdfev-size'), 10) || 0;
      if (isProtected && pdfSize > 0 && typeof pdfjsLib !== 'undefined' && pdfjsLib.PDFDataRangeTransport) {
        // Start the flipbook right away (full stage, toolbar and its own
        // "PDF is Loading" state) and feed pdf.js the protected bytes through
        // a range transport the moment they arrive.
        var transport = new pdfjsLib.PDFDataRangeTransport(pdfSize, null);
        var fullBytes = null, pendingRanges = [];
        transport.requestDataRange = function (begin, end) {
          if (fullBytes) transport.onDataRange(begin, fullBytes.subarray(begin, end));
          else pendingRanges.push([begin, end]);
        };
        startFlipbook('protected.pdf', null, { range: transport, length: pdfSize, disableAutoFetch: false, disableStream: true });
        fetchProtectedPdf(post_id, function (result) {
          if (!result) {
            $viewer.html('<div class="pdfev-load-error">' + (pdfevFronend.load_error_text || 'This PDF could not be loaded. Please reload the page.') + '</div>');
            return;
          }
          fullBytes = new Uint8Array(result.arrayBuffer);
          transport.onDataProgress(fullBytes.length, fullBytes.length);
          transport.onDataProgressiveRead(fullBytes);
          transport.onDataProgressiveDone();
          pendingRanges.forEach(function (r) { transport.onDataRange(r[0], fullBytes.subarray(r[0], r[1])); });
          pendingRanges = [];
        });
      } else if (isProtected) {
        // No size known: the bytes are fetched before the flipbook starts,
        // so show a loader in the meantime.
        $viewer.html(preloaderHtml());
        fetchProtectedPdf(post_id, function (result) {
          if (result) {
            $viewer.empty();
            startFlipbook(result.blobUrl || 'protected.pdf', result.arrayBuffer);
          } else {
            $viewer.html('<div class="pdfev-load-error">' + (pdfevFronend.load_error_text || 'This PDF could not be loaded. Please reload the page.') + '</div>');
          }
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
          $(document).trigger('pdfev:items-added');
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

// ============ebook grid: real page-2 preview on hover===========
// Page 2 is rendered ahead of time: books near the viewport are queued and
// rendered in the background (two at a time), so the page is already there
// when the cover swings open. Hovering a book that isn't done yet starts it
// right away. On Data Saver / 2G connections nothing is preloaded; a book
// renders only when hovered, as before.
(function ($) {
  var SEL = '.archive-ebook-style .grid-item .image';
  var MAX_BUSY = 2;
  var conn = navigator.connection || {};
  var preload = 'IntersectionObserver' in window && !conn.saveData && !/(^|-)2g$/.test(conn.effectiveType || '');
  var workerConfigured = false;
  var hoverTimers = new WeakMap();
  var queue = [];
  var busy = 0;
  var observer = null;

  function ensureWorker() {
    if (workerConfigured || typeof pdfjsLib === 'undefined') return;
    // The archive/ebook grid never instantiates 3dflipbook (that only
    // happens on the single-view page), so nothing else has pointed pdf.js
    // at a worker script yet — without this it silently falls back to a
    // slower in-thread "fake worker".
    pdfjsLib.GlobalWorkerOptions.workerSrc = pdfevFronend.pdfevurl + 'vendor/pdf/pdf.worker.min.js';
    workerConfigured = true;
  }

  // What to hand pdf.js for this book, or null.
  function pdfSource($image) {
    // Protected files (an add-on's Hide File URL / Lockdown): no URL in the
    // markup — the bytes come from the same on-demand request the viewer uses.
    if ($image.attr('data-pdfev-protected') === 'yes') {
      if (typeof window.pdfevLoadProtectedPdf !== 'function') return Promise.resolve(null);
      return window.pdfevLoadProtectedPdf($image.attr('data-pdfev-id')).then(function (r) {
        return r ? { data: new Uint8Array(r.arrayBuffer) } : null;
      });
    }
    var url = $image.attr('data-pdfev-src');
    if (!url) return Promise.resolve(null);
    // Range requests: pdf.js fetches the cross-reference table and what page
    // 2 needs instead of the whole file. Servers without Range support just
    // send the whole file, as before.
    return Promise.resolve({ url: url, disableAutoFetch: true, disableStream: true });
  }

  // Open the PDF, render page 2 (page 1 for a single-page file) to a canvas,
  // and free pdf.js's copy of the document either way.
  function renderToCanvas(params, $image) {
    var task = pdfjsLib.getDocument(params);
    return task.promise.then(function (pdf) {
      return pdf.getPage(pdf.numPages > 1 ? 2 : 1);
    }).then(function (page) {
      var containerWidth = $image.width() || 170;
      var baseViewport = page.getViewport({ scale: 1 });
      var scale = (containerWidth / baseViewport.width) * 2; // 2x for retina sharpness

      var viewport = page.getViewport({ scale: scale });
      var canvas = document.createElement('canvas');
      canvas.width = Math.ceil(viewport.width);
      canvas.height = Math.ceil(viewport.height);

      return page.render({ canvasContext: canvas.getContext('2d'), viewport: viewport }).promise.then(function () {
        return canvas;
      });
    }).then(function (canvas) {
      task.destroy();
      return canvas;
    }, function (err) {
      task.destroy();
      throw err;
    });
  }

  function renderPagePeek($image) {
    if ($image.data('pdfevPeekState') || typeof pdfjsLib === 'undefined') return Promise.resolve();
    $image.data('pdfevPeekState', 'loading'); // rendering, done, or failed once
    ensureWorker();

    var $pages = $image.find('.pages');

    return pdfSource($image).then(function (params) {
      if (!params) throw new Error('No PDF source');
      return renderToCanvas(params, $image).catch(function (err) {
        // Some hosts/CDNs mangle Range responses ("Bad end offset", the
        // reason the viewer itself loads whole files): retry once that way.
        if (!params.url) throw err;
        return renderToCanvas({ url: params.url, disableRange: true, disableStream: true }, $image);
      });
    }).then(function (canvas) {
      $pages.empty().append(canvas).addClass('pdfev-pages-rendered');
      $image.data('pdfevPeekState', 'done');
    }).catch(function () {
      // A blocked host, corrupt file or failed request shouldn't leave a
      // spinner turning forever: the panel settles to a plain page.
      $pages.addClass('pdfev-pages-failed');
      $image.data('pdfevPeekState', 'failed');
    });
  }

  function pump() {
    while (busy < MAX_BUSY && queue.length) {
      var $image = queue.shift();
      if ($image.data('pdfevPeekState')) continue;
      busy++;
      renderPagePeek($image).then(function () { busy--; pump(); });
    }
  }

  function observe() {
    if (!preload) return;
    if (!observer) {
      observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          observer.unobserve(entry.target);
          queue.push($(entry.target));
        });
        pump();
      }, { rootMargin: '300px 0px' });
    }
    $(SEL).each(function () {
      if (!$(this).data('pdfevPeekState')) observer.observe(this);
    });
  }

  $(document).on('mouseenter', SEL, function () {
    var el = this;
    var $image = $(el);
    if ($image.data('pdfevPeekState')) return;
    // Without preloading, a short delay so quickly scanning across the
    // shelf doesn't fetch and render every cover the mouse passes over.
    var timer = setTimeout(function () {
      renderPagePeek($image);
    }, preload ? 0 : 220);
    hoverTimers.set(el, timer);
  });

  $(document).on('mouseleave', SEL, function () {
    var timer = hoverTimers.get(this);
    if (timer) clearTimeout(timer);
  });

  // Start once the page itself has finished loading, so previews never
  // compete with the page's own images and scripts; Load More adds more.
  if (document.readyState === 'complete') {
    observe();
  } else {
    $(window).on('load', observe);
  }
  $(document).on('pdfev:items-added', observe);
})(jQuery);

// ============metabox scripts========
