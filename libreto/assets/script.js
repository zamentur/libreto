$(document ).ready( function() {

  $(".menu .pad_button a").click(function(e){
    e.preventDefault();
    $this = $(this);
    $this.parent().addClass('active').siblings().removeClass('active');
    var name = $(this).attr('data-name-encoded');
    var currentUrl = window.location.href.split('://')[1].split('/');
    var newUrl = '/' + currentUrl[1] + '/' + name;
    window.history.pushState("", "", newUrl);
    $('article').addClass('loading');

    // fill iframe
    var $frame = $('article iframe');
    var href = $(this).attr('href');
    $frame.attr('src',href);

    // if iframe is a libreto, add class "libreto"
    if($this.parent().hasClass('libreto')) {
      $frame.addClass('libreto');
    } else {
      $frame.removeClass('libreto');
    }

  });

  $('#framepad').on("load", function() {
    $('article').removeClass('loading');
});

  $(".refresh").click(function(e){
    e.preventDefault();
    location.reload(true);
  });

  $("header .full .switch").click(function(){
    $("header").removeClass('open').addClass('close');
    $.post("/assets/ajax.php", {"action": "headerVisibility", "visibility": "close"});
  });

  $("header .reduced .switch").click(function(){
    $("header").removeClass('close').addClass('open');
    $.post("/assets/ajax.php", {"action": "headerVisibility", "visibility": "open"});
  });

});
