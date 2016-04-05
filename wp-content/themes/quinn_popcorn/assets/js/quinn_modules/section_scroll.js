/*
	MODULE : Section Scroll
*/


$(document).ready(function() {

  SectionScroll = {

    init: function() {

      console.log('Section Scroll Module Loaded');


      var t = this;

      t.prepareDom();

      t.cacheElements();
      t.bindEvents();
      t.addArrows();
      t.resizeSections();

      $(window).on('resize', function() {
          t.resizeSections();
        });

    },

    prepareDom: function(){

      $('#wrapper').css({
          margin: 0,
          width: '100%',
          overflow: 'hidden'
      });

      $('.header-wrapper').css({
          position: 'absolute'
      });
    },

    resizeSections: function () {

  		var windowH = $(window).height();
  		var windowW = $(window).width();
  		var backgroundSize = 'cover';

  		// $(".reimagine-shim").css({ height : windowH });

      $(".SectionScroll-matchHeight").each(function() {
        $(this).css({ height : windowH });
      });

  		$(".SectionScroll").each(function() {

  			var section = $(this);
  			var innerH = $(this).find('.SectionScroll-inner').outerHeight();
        
        var innerPad = (windowH - innerH) / 2;

  			// Resize section to window height
  			section
  			.css({ height : windowH })
  			.find('.SectionScroll-matchHeight')
  			.css({ height : windowH });

  			// Center section content
  			section
  			.find('.SectionScroll-inner')
  			.css({ paddingTop : innerPad });


  		});
  	},

    addArrows: function(){

      $(".SectionScroll").each(function() {

        var arrowColor = $(this).data('arrow-color');

        $('<div/>', {
            title: 'Next Section',
            class: 'arrow-icon js-nextSection arrow-' + arrowColor,
        }).prependTo(this);

      });

      $(".SectionScroll")
      .last()
      .find('.arrow-icon')
      .removeClass('js-nextSection')
      .addClass('js-scrollToTop arrow-up');


    },

    cacheElements: function(){
      this.$next_section = $('.js-nextSection');
      this.$scroll_to_top = $('.js-scrollToTop');

    },

    bindEvents: function(){

      var next_section = this.$next_section;
      var scroll_to_top = this.$scroll_to_top;

  		$(document).on('click', next_section.selector, function(event){

  			var toTarget = $(this)
  									.parents('.SectionScroll')
  									.nextAll('.SectionScroll')
  									.offset().top;

  			$("html, body").animate({ scrollTop: toTarget}, 1000);

  		});

  		$(document).on('click', scroll_to_top.selector, function(event){
  			$("html, body").animate({ scrollTop: 0}, 1000);
  		});

    },

  };

  SectionScroll.init();

  window.SectionScroll = SectionScroll;


});
