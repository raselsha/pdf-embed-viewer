/* Dismiss the "Pro is here" announcement for this admin (classes/pro-announcement.php). */
(function () {
  document.addEventListener('click', function (e) {
    var btn = e.target.closest ? e.target.closest('.pdfev-pro-notice__close') : null;
    if (!btn || typeof pdfevNotice === 'undefined') return;
    var box = btn.closest('.pdfev-pro-notice');
    if (!box) return;

    var body = new URLSearchParams();
    body.append('action', 'pdfev_dismiss_notice');
    body.append('nonce', pdfevNotice.nonce);
    body.append('notice', box.getAttribute('data-notice') || '');
    fetch(pdfevNotice.ajaxurl, { method: 'POST', credentials: 'same-origin', body: body });

    box.classList.add('is-leaving');
    setTimeout(function () { box.parentNode && box.parentNode.removeChild(box); }, 200);
  });
})();
