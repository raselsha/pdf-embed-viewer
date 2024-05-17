
// ============custom data tabs===========
jQuery(document).ready(function($){
    $('[data-tab-target]').click(function () {
        console.log('est');
    var target = $(this).data('tab-target');
    $('[data-tab-content]').removeClass('active');
    $('.tab').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active');
    
  });
});


// ============admin scripts===========


// ============metabox scripts========
