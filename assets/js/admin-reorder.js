(function ($) {
  $(function () {
    if (typeof pdfevReorder === 'undefined') {
      return;
    }

    if (!pdfevReorder.canReorder) {
      // Search, a taxonomy filter, or a column sort all change which posts
      // show and in what order, so dragging here wouldn't reorder what a
      // plain visit to this screen actually shows. Mark the handles as
      // disabled (admin-list.css greys them out) instead of leaving them
      // looking clickable but silently doing nothing.
      $('.pdfev-drag-handle')
        .addClass('is-disabled')
        .attr('title', 'Clear search, filters and column sorting to drag-reorder');
      return;
    }

    var $list = $('#the-list');
    if (!$list.length) {
      return;
    }

    $list.sortable({
      items: 'tr',
      handle: '.pdfev-drag-handle',
      axis: 'y',
      cursor: 'move',
      opacity: 0.65,
      placeholder: 'pdfev-reorder-placeholder',
      forcePlaceholderSize: true,
      helper: function (e, $tr) {
        // A dragged <tr> collapses to its content width once jQuery UI takes
        // it out of table flow — lock each cell to its current width first so
        // the row keeps its normal column widths while it's being dragged.
        var $cells = $tr.children();
        var $helper = $tr.clone();
        $helper.children().each(function (index) {
          $(this).width($cells.eq(index).width());
        });
        return $helper;
      },
      update: function () {
        var order = $list
          .find('tr')
          .map(function () {
            var id = (this.id || '').replace('post-', '');
            return parseInt(id, 10);
          })
          .get()
          .filter(function (id) {
            return !isNaN(id);
          });

        if (!order.length) {
          return;
        }

        $.post(pdfevReorder.ajaxurl, {
          action: 'pdfev_save_order',
          ajaxnonce: pdfevReorder.ajaxnonce,
          offset: pdfevReorder.pageOffset,
          order: order,
        });
      },
    });
  });
})(jQuery);
