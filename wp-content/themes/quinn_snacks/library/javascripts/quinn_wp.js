jQuery(document).ready(function() {

/*
	MAIN MENU MOBILE TRIGGER
*/

	$(document).on('click', $("#header-mobile #mobile-menu-trigger").selector, function(){

		$('#mainmenu-mobile').toggle();
		$(this).toggleClass('mobile-trigger-active');

	});


/*
	FULL SCREEN WIDTH IMAGES (In 'Cleaning Up Food' etc.)
*/

	var count = 1;
	var padding = 0;
	var firstclass = '';

	$('.fullscreenwidth').each(function() {

		var img_src = $(this).attr('src');

		if (count == 1) {
			padding = 380;
			firstclass = ' fullscreenwidth-first';
			}
		else {
			padding = 490;
			firstclass = '';
			}

		count ++;

		$(this).after('<div class="fullscreenwidth_js'+firstclass+'" style="background-image : url(' + img_src + '); background-size: cover;"></div><div class="fullscreenwidth_js_spacer" style="height:'+ padding +'px"></div>');

		$(this).remove();
	});



	function setCookie( c_name, value, exdays ) {
		var exdate = new Date();
		exdate.setDate( exdate.getDate() + exdays );
		var c_value = escape( value ) + ( ( exdays == null ) ? '' : '; expires=' + exdate.toUTCString() );
		document.cookie = c_name + "=" + c_value;
	}

	function getCookie( cookiename ) {
		var cookies = document.cookie.split('; ');
		for( i = 0; i < cookies.length; i++ ) {
			var cookie = cookies[i].split('=');
			if( cookie[0] == cookiename ) return cookie[1];
		}
		return false;
	}

	function checkCookie() {
		var hide_ad = getCookie( 'hide_ad' );
		if( ! hide_ad ) {
			setTimeout(function(){
				
				$('.discount-popup').removeClass('hide');
			}, 4000);
		}
	}

	checkCookie();

	$('.close').on('click', function(){
		$('.discount-popup').addClass('hide');
		setCookie( 'hide_ad', 'hidden', 1 );
	})



/*
	BLOCK IMAGE FULL SCREEN SCALING
*/

	function resizeBlocks()
	{

		var winWidth = $(window).width();
		var boxSize = (winWidth/4 - 8);
		var boxCount = 0;

/*
			$('.block-view-post').each(function() {

				$(this).css({
					'width'	:	boxSize,
					'height'	:	boxSize,
					'opacity': 	1
				});

				$(this).find('.block-info-state').css({
					'width'	:	boxSize - 41,
					'height'	:	boxSize - 40
				});

				$(this).find('.block-category').css({
					'margin-top'	:	boxSize - 35,
				});

				boxCount++;

			});

			$('#sidebar-blockview').css({
				'width'	:	boxSize - 40,
				'height'	:	boxSize - 42,
				'opacity':	1
			});

			shimHeight = $('#blog-block-view').height();

			if (!shimHeight) {
				shimHeight = $('#link-block-view').height();
			}

			$('#block-view-shim').css({'height': shimHeight});
*/

	}

	resizeBlocks();

	$(window).on('resize', function(){
		resizeBlocks();
	});


});
