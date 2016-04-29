//v2

$(document).ready(function (){

	var Model = {

		root: '../wp-content/themes/quinn_snacks/library/food-should-be/',

		url: {
			add_term : 'fsb-add-term.php',
			get_words : 'fsb-get-words.php'
			},

		post : function(address, data, feedback, relayTrigger) {

	      console.log(relayTrigger);

	       $.ajax({
	            type: "POST",
	            data: data,
	            url: Model.root + address,
	            cache: false,
	            dataType: "json"
	            }).done(function(ajax_data) {
	              Model.relayData(relayTrigger, ajax_data)
	            });
	     },

			relayData: function(relay, data) {

				switch(relay) {
					case 'sending_term' :
						window.location.replace('/campaigns/food-should-be/?term=' + data);

						break;

					case 'getting_words' :
						FoodShouldBe.createJumble(data);
						break;
				};
			},
	},


	FoodShouldBe = {

		init: function() {

			this.cacheElements();
			this.bindEvents();

			if ($('body').hasClass('home')) { }

			if ($('body').hasClass('page-template-template-foodshouldbe')) {
				this.getWords();
				this.includeTweets();
				this.includeInstagrams();
			}

			$("#fsb-input").focus();


		},

		getWords: function() {

			Model.post(Model.url.get_words, {'null': 0}, 'Getting Terms', 'getting_words');


			},

		includeTweets: function(){

			$.get( "http://www.quinnsnacks.com/wp-content/themes/quinn_snacks/library/food-should-be/vendor/140dev-twitter_display/twitter_display.php", function( data ) {
				$( "#fsb-tweets" ).html( data );
			});

		},

		includeInstagrams: function(){

			$.get( "http://www.quinnsnacks.com/wp-content/themes/quinn_snacks/library/food-should-be/fsb-instagram.php", function( data ) {
				$( "#fsb-instagram-stream" ).html( data );
			});



		},

		sendTweet: function(tweet){

			tweet = encodeURIComponent(tweet);
			var link = 'http://twitter.com/home?status=' + tweet;
			NewWindow(link,'name','700','400','yes');
			return false

		},

		sendFBupdate: function(update) {

			var id = 917357828308007,
					link =  encodeURIComponent('http://www.quinnsnacks.com/campaigns/food-should-be'),
					caption = encodeURIComponent(update);

			var FBlink = 'https://www.facebook.com/dialog/feed? app_id='+id+' &display=popup&caption='+caption+'&link='+link+'&redirect_uri=' + link;

				NewWindow(FBlink,'name','700','400','yes');
				return false

		},

		createJumble: function(wordList){


			$('#fsb-jumble-inner').jQCloud(wordList, {
				removeOverflowing: false
			});

		},

		sendTermtoDB: function(term) {

			var request_data = { 'term' : term };
			Model.post(Model.url.add_term, request_data, 'Sending Term', 'sending_term');

		},

		cacheElements: function() {

			this.$frontpage_fsb_submit = $('#fsb-submit');
			this.$fsb_twitter = $('.fsb-submit-twitter');
			this.$fsb_facebook = $('.fsb-submit-facebook');

			},

		bindEvents: function() {

			var frontpage_fsb_submit = this.$frontpage_fsb_submit.selector;
			var fsb_twitter = this.$fsb_twitter.selector;
			var fsb_facebook = this.$fsb_facebook.selector;

			$(document).on('click', frontpage_fsb_submit, function(event){

				event.preventDefault();
				var term = $(this).siblings('input').val();

				if (term != '') {
					$(this).addClass('thinking');
					FoodShouldBe.sendTermtoDB(term);
				}
				else {
					alert('Enter a word that describes what you think food should be!')
				}

			});

			$(document).on('click', fsb_twitter, function(event){

				event.preventDefault();
				var tweet = $('#fsb-twitter textarea').val();
				var hashtags = $('#fsb-twitter h3').text();
				FoodShouldBe.sendTweet(tweet + ' ' + hashtags);

			});

			$(document).on('click', fsb_facebook, function(event){

				event.preventDefault();
				var tweet = $('#fsb-facebook textarea').val();
				var hashtags = $('#fsb-facebook h3').text();
				FoodShouldBe.sendFBupdate(tweet + ' ' + hashtags);

			});

		},

	},


	Utils = {

		usedbyManyViews : function(html){
			return something;
		},

	};


	if(window.location.hash == '#direct'){

	}

	FoodShouldBe.init();

});


(function($) {
    $(document).bind('FBSDKLoaded', function() {
    });

})(jQuery);
