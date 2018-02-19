$(document ).ready( function() {

  $(".menu .pad_button a").click(function(){
    $(this).parent().addClass('active').siblings().removeClass('active');
    var name = $(this).attr('data-name-encoded');
    var currentUrl = window.location.href.split('://')[1].split('/');
    if (use_subdomain) {
      var newUrl = '/' + name;
    } else {
      var newUrl = '/' + currentUrl[1] + '/' + name;;
    }
    window.history.pushState("", "", newUrl);
    $('article').addClass('loading');
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
