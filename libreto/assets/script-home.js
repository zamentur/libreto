$(document ).ready( function() {

  var $url = $('.url');

  $('#custom_instance').change(function() {
    if($(this).is(":checked")) {
      $url.addClass('custom_instance');
      return;
    }
    $url.removeClass('custom_instance');
  });
  $('#custom_instance').change();

});
