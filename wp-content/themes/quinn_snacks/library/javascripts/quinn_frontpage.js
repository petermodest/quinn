$(document).ready(function() {
		
	$(window).on('resize', function() {
		resizeTitle();
	});
	
});

$(window).load(function(){
	resizeTitle();
})

function resizeTitle(){
	var $section = $('#fp-main');
	var $titleOuter = $section.find('.fp-reimagine-inner');
	var $title = $titleOuter.find('h1');
	
	var outerWidth = $titleOuter.width();
	var sectionHeight = $section.height();
	var titleHeight = $title.height()

	$titleOuter.css({
		paddingTop: ( ( sectionHeight - titleHeight ) / 2 )
	})
	
	$('.load-hidden').removeClass('load-hidden');
	
}
