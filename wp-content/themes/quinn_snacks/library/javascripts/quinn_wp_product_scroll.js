$(document).ready(function() {

	var ProductScroll = {
	
		init: function() {
	
			this.cacheElements();
			this.bindEvents();
			this.drawTitles();
			this.selectInitial();
			this.stickyNav();
	
			$(window).on('resize', function() {
				ProductScroll.scrollShim();
			});
		},
	
		currentPane: 0,
	
		paneTotal: 0,
	
		paneMeasurements: {},
	
		productData : productData,
	
		scrollType: $('#product-scroll').attr('data-scrolltype'),
	
		cacheElements: function() {
			this.$product_title = $("#product-scroll-titles ul li");
		},
		
		selectInitial: function() {
			console.log(this.productData);
			for( var i = 0; i < this.productData.length; i++ ) {
				console.log(i);
				if( productData[i].selected ) {
					this.selectFlavor( productData[i].ID );
					break;
				}
			}
		},
	
		bindEvents: function() {
	
			var t = this,
			 	 product_title = this.$product_title.selector;
	
			$(document).on('mouseover', product_title, function(){
	
				var color = $(this).attr('data-hover-color');
				$(this).css({'background-color':  color, 'border-color' : color});
	
			});
	
			$(document).on('mouseout', product_title, function(){
	
				if ( $(this).hasClass("active_product") ) {
	
				} else {
					$(this).css({
						'background-color':  'transparent',
						'border-color' : 'white'
					});
				}
			});
	
			$(document).on('click', product_title, function(){
	
				$('.active_product')
					.css({
						'background-color':  'transparent',
						'border-color' : 'white'
					})
					.removeClass('active_product');
	
					t.selectFlavor($(this).attr('data-slug'));
	
					SectionScroll.init();
	
					$('html, body').animate({
						scrollTop: $("#product-callout").offset().top
					}, 1000);
	
			});
		},
	
		drawTitles: function(){
	
			$('#product-scroll-titles').css({
				'min-height' : $(window).height()
			});
	
			var string = '';
			var noun = $('#product-scroll').attr('data-noun');
			var t = this;
			_.each(this.productData, function(product) {
	
				var blackwhite = '';
	
				if (product.text_color === '#ffffff') {
					blackwhite = 'text_white';
				}
	
				if (product.text_color === '#000000') {
					blackwhite = 'text_black';
				}
		
				string += '<li class="' + blackwhite +  '" data-slug="' + product.ID + '" data-hover-color="' + product.color + '">';
				string += '<h2>' + product.title +  '</h2>';
				string += '<div class="title-buttons">';
				string += '<a href="http://store.quinnpopcorn.com">BUY A ' + noun + '</a>';
				string += '<a href="#" class="clickformore">CHECK IT OUT!</a>';
				string += '<a class="product-downarrow" style="background-color:' + product.color +  '"></a>';
				string += '<a href="#" class="back-to-top js-scrollToTop">BACK TO LIST</a>';
				string += '</div>';
				string += '</li>';
	
			});
	
			$('#product-scroll-titles ul').append(string);
	
		},
	
		selectFlavor: function(flavorSlug){
	
			var titleBar = $('#product-scroll-titles li[data-slug = "' + flavorSlug + '"]');
			var color = titleBar.attr('data-hover-color');
	
			titleBar.css({'background-color':  color, 'border-color' : color}).addClass('active_product');
	
			var flavorString = titleBar.find('h2').html();
			var result = _.findWhere(this.productData, {title: flavorString});
	
			_.templateSettings.variable = "product";
	
			var template = _.template(
				$( "#product-template" ).html()
			);
	
			$( "#product-content" ).empty().append(
				template( result )
			);
	
		},
	
		convertToSlug: function(Text){
			return Text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-')
			;
		},
	
		stickyNav: function() {
	
			var stickyNavTop = $('.active_product').offset().top;
	
			var sticky = function(){
	
				var scrollTop = $(window).scrollTop();
	
				if (scrollTop > stickyNavTop) {
					$('.active_product').addClass('sticky');
				} else {
					$('.sticky').removeClass('sticky');
					}
			};
	
				sticky();
	
			$(window).scroll(function() {
				sticky();
			});
	
	
	
		}
	};
	
	ProductScroll.init();

});
