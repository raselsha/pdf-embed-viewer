/* Dismiss the Pro notices for this admin (classes/pro-announcement.php, classes/pro-offer.php),
   or snooze the offer for 30 days ("Remind me later"). */
(function () {
  document.addEventListener('click', function (e) {
    var later = e.target.closest ? e.target.closest('.pdfev-pro-notice__later') : null;
    var btn = later || (e.target.closest ? e.target.closest('.pdfev-pro-notice__close') : null);
    if (!btn || typeof pdfevNotice === 'undefined') return;
    var box = btn.closest('.pdfev-pro-notice');
    if (!box) return;

    var body = new URLSearchParams();
    body.append('action', later ? 'pdfev_snooze_notice' : 'pdfev_dismiss_notice');
    body.append('nonce', pdfevNotice.nonce);
    body.append('notice', box.getAttribute('data-notice') || '');
    fetch(pdfevNotice.ajaxurl, { method: 'POST', credentials: 'same-origin', body: body });

    box.classList.add('is-leaving');
    setTimeout(function () { box.parentNode && box.parentNode.removeChild(box); }, 200);
  });
})();
