
// ============custom data tabs===========
jQuery(document).ready(function($){
    $('[data-tab-target]').click(function () {
    var target = $(this).data('tab-target');
    $('[data-tab-content]').removeClass('active').fadeOut();
    $('.tab').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active').fadeIn();
    
  });
});


// ============admin scripts===========


// ============metabox scripts========
