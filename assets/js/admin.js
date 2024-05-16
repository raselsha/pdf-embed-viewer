
// ============custom data tabs===========
jQuery(document).ready(function($){
  $('[data-tab-target]').click(function(){
    var target = $(this).data('tab-target');
    $('.tab-content').removeClass('active');
    $('.tab').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active');
  });
});

// ============admin scripts===========

jQuery(document).ready(function($){
  $('.color-field').wpColorPicker();
});

