$(document).ready(function() {


  function resizeTitle(){

    var outerWidth = $('.js-reimagine-title').width();
    var newSize = outerWidth / 10.5;

    $('.js-reimagine-title h1').css({
      fontSize: newSize
    });

  }


  $(window).on('resize', function() {

    if ( $(window).width() < 1200 )
      resizeTitle();
    });

resizeTitle();

});
