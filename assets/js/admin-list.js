(function ($) {
  $(function () {
    $(document).on('click', '.pdfev-copy-btn', function (e) {
      e.preventDefault();
      var $btn = $(this);
      var text = $btn.data('copy');

      var done = function () {
        $btn.addClass('is-copied');
        var $icon = $btn.find('.dashicons').removeClass('dashicons-clipboard').addClass('dashicons-yes');
        setTimeout(function () {
          $btn.removeClass('is-copied');
          $icon.removeClass('dashicons-yes').addClass('dashicons-clipboard');
        }, 1200);
      };

      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(done);
        return;
      }

      // Fallback for non-HTTPS admin (common on local dev sites): a hidden,
      // off-screen textarea plus the older execCommand copy path.
      var $tmp = $('<textarea readonly></textarea>')
        .css({ position: 'fixed', top: '-1000px', left: '-1000px' })
        .val(text)
        .appendTo('body');
      $tmp[0].select();
      try {
        document.execCommand('copy');
        done();
      } catch (err) {
        // Silently ignore — the shortcode text is still visible to select by hand.
      }
      $tmp.remove();
    });
  });
})(jQuery);
