var wwdith, wheight, headerheight, section_heights;
var ajax_url = '/wp-content/themes/quinn_snacks/library/ajax/ajax.php';
$(document).ready(function(){
	resize_sections();
	
	// RECIPE CARDS
	$('.flip').flip({ trigger: 'hover' });
	
	// CLICK EVENTS FOR FLAVORS
	$('.flavor-list li').on('click', function(){
		$('.flavor-list, .flavor-switch').find('li').removeClass('active').filter('[data-flavor="' + $(this).attr('data-flavor') + '"]').addClass('active');
	})
	
	// CHANGE URL DYNAMICALLY
	$('[data-update-url]').on('click', function(){
		window.history.pushState( $(this).attr('data-update-url'), $(this).find('h2').text(), $(this).attr('data-update-url') );
	})
	
	// SMOOTH SCROLLING TO ELEMENTS
	$('.scroll-to-elem').on('click', function(e){
		if( ! ( e.target.nodeName.toLowerCase() == 'a' && e.target.className.indexOf('scroll-to-elem') == -1  ) ) {
			e.preventDefault();	
			$('html, body').animate({
				scrollTop	: $( $(this).attr('data-scroll-to') ).offset().top
			}, 1000)
		}
	})
	
	// DYNAMIC BEHAVIOR FOR TOP LINKS
	$(window).bind('scroll', function(e){
		// SHOW / HIDE LINKS
		if( document.body.scrollTop > headerheight ) $('.top-links').addClass('active');
		else $('.top-links').removeClass('active');
		
		// CHANGE TOP LINKS COLOR
		for( var i = 0; i < section_heights.length; i++ ) if( ( document.body.scrollTop + 28 ) >= section_heights[i] ) target = i;
		color = $('#snack-scroll section:eq(' + target + ')').is('.flavor-switch') ? $('#snack-scroll section:eq(' + target + ') li.active').attr('data-top-link-color') : $('#snack-scroll section:eq(' + target + ')').attr('data-top-link-color');
		$('.top-links a').css('color', color);
	})
	
	// MODAL WINDOWS FOR POPPING INSTRUCTIONS AND 
	$('.modal').fancybox({
		helpers: {
			overlay: {
				locked: true
			}
		}
	});
	
	// TRIGGER NUTRITION MODAL
	$('.nutrition-open').on('click', function(e){
		e.preventDefault();
		$('[rel="nutrition"]:eq(0)').trigger('click');
	})

})

$(window).load(function(){
	resize_sections();
})

$(window).bind('resize', function(){
	resize_sections();
})

function resize_sections() {
	wwdith = $(window).width();
	wheight = $(window).height();
	headerheight = $('.header-wrapper:visible').height();
	section_heights = [];
	$('#snack-scroll section').each(function(){
		$(this).css( 'min-height', wheight ).find('.inner-height').css( 'min-height', wheight ) ;
		section_heights.push( $(this).offset().top );
	})
}