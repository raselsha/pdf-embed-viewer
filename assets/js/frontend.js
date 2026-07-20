
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
  });
  
  function initializeFlipbook() {
      $('.pdfev-3dbook-viewer').each(function () {
      let $viewer = $(this);
      let post_id = $viewer.data('id');
      let pdfURL = $viewer.data('pdfev-url');

      if (!pdfURL) return;

      // Pro flipbook options — free/unlicensed installs never receive
      // pdfevFronend.flipbookOptions at all, so proOptions stays {} and the
      // $.extend below is a no-op, leaving today's defaults untouched.
      let proOptions = pdfevFronend.flipbookOptions || {};
      let skinFile = proOptions.skinFile || "short-black-book-view.css";

      let options = {
        pdf: pdfURL,
        page: 1, // or customize per book
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

      // Deep-merge Pro options on top of the defaults above. proOptions has no
      // "template" key so the function above is left untouched; skinFile isn't
      // a real FlipBook() option (only used to pick the styles[] entry above),
      // so it's stripped back off before handing the object to FlipBook().
      $.extend(true, options, proOptions);
      delete options.skinFile;

      $viewer.FlipBook(options);
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
