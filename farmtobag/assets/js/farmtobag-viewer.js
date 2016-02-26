
$(document).ready(function (){


	var Model = {
		
		url: { 
			add_batch : 'ajax/add_batch.php',
			},
			
		post : function(address, data) { 
					 return $.ajax({
								type: "POST",
								data: data,
								url: address,
								cache: false,
								dataType: "json",
								async: false								
							}); 			
			},
			
	},

	Controller = {
	
		init: function() {
				
			this.cacheElements();
			this.bindEvents();

			},
		
		cacheElements: function() {

			this.$batch_part = $('.batch-part');
			
			},

		bindEvents: function() {

			var batch_part = this.$batch_part.selector;



			batch_part.accordion();


			$(document).on('click', section_header, function(event){ 

				console.log('hi');

					});

		},
		
	},


	Utils = {

		isNumber : function (n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
		}
		
	};


	Controller.init();

});
