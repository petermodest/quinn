/*
	JS for Reimagine Snacks Camapign
*/

$(document).ready(function($) {

var reimagine = {


	init: function(){
		var t = this;
		t.bindEvents();

		// hack while we figure out how
		$('#header-centering').removeClass('mainmenu-black').addClass('mainmenu-white');

		$('.reimagine-1 h1').bigtext();


	},

	bindEvents: function(){

		$(document).on('click', $('.js-playvideo').selector, function(event){
			$(this).closest('.section-inner').addClass('show-vid');
			$(".video-intro").hide();
			$(".video-container").fadeIn();
				$('video').get(0).play();

		});
	}
};

reimagine.init();

});
