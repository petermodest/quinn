
$(document).ready(function (){


	var Model = {
		
		url: { 
			add_batch : 'ajax/add_batch.php',
			add_flavor : 'ajax/add_flavor.php',
			update_flavor : 'ajax/update_flavor.php',
			find_farms : 'ajax/find_farms.php',
			update_batch_number : 'ajax/update_batch_number.php',
			delete_batch_part : 'ajax/delete_batch_part.php',
			delete_batch : 'ajax/delete_batch.php',
			clone_batch : 'ajax/clone_batch.php',
			delete_supplier : 'ajax/delete_supplier.php',
			delete_farm : 'ajax/delete_farm.php',
			update_frontpage_featured : 'ajax/update_frontpage_featured.php',
			update_id_range : 'ajax/update_id_range.php',
			update_featured_batch : 'ajax/update_featured_batch.php'

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
			
		getSection : function(section, data) { 
			switch (section)
				{
				  case 'dashboard': 

				  		return sectionData = Model.post(Model.url.ajax_url, data);
				  		
					break;
											
				  }
			},
	},

	Controller = {
	
		init: function() {
				
			this.cacheElements();
			this.bindEvents();
			this.locationParse(); // parse JSON location data and create copies of location div for editor.
			},
		
		cacheElements: function() {

			this.$add_batch = $('#add-batch');
			this.$batch_add_supplier = $('.batch-add-supplier');
			this.$add_flavor = $('.add-flavor');
			this.$edit_flavor_name = $('.edit-flavor-name');
			this.$remove_batch_supplier = $('.remove-batch-supplier');
			this.$select_farm =  $(".select_farm input[type=checkbox]");
			this.$change_batch_number =  $(".change_batch_number");
			this.$delete_batch_part =  $(".delete_batch_part");
			this.$delete_batch =  $(".delete_batch");
			this.$clone_batch =  $(".clone_batch");
			this.$delete_supplier =  $(".delete-supplier");
			this.$delete_farm =  $(".delete-farm");
			this.$featured_supplier =  $(".featured-supplier");
			this.$frontpage_featured = $('.frontpage-featured');
			this.$id_range = $('.id_range input');
			this.$location_city = $('.location input');
			this.$location_state = $('.location select');
			this.$location_add = $('.location .add-location');
			this.$location_remove = $('.location .remove-location');
			this.$batch_number = $('#batch-list .batchnumber');
			
			},

		bindEvents: function() {
			var t = this;
			var add_batch = this.$add_batch.selector;
			var batch_add_supplier = this.$batch_add_supplier.selector;
			var add_flavor = this.$add_flavor.selector;
			var edit_flavor_name = this.$edit_flavor_name.selector;
			var remove_batch_supplier = this.$remove_batch_supplier.selector;
			var select_farm = this.$select_farm.selector;
			var change_batch_number = this.$change_batch_number.selector;
			var delete_batch_part = this.$delete_batch_part.selector;
			var delete_batch = this.$delete_batch.selector;
			var clone_batch = this.$clone_batch.selector;
			var delete_supplier = this.$delete_supplier.selector;
			var delete_farm = this.$delete_farm.selector;
			var featured_supplier = this.$featured_supplier.selector;
			var frontpage_featured = this.$frontpage_featured.selector;
			var id_range = this.$id_range.selector;
			var location_city = this.$location_city.selector;
			var location_state = this.$location_state;
			var location_add = this.$location_add.selector;
			var location_remove = this.$location_remove.selector;
			var batch_number = this.$batch_number.selector;


			$(document).on('click', batch_number, function(event){ 

				var batch_id = $(this).text();
				
				var ajax = Model.post(Model.url.update_featured_batch, {'new_featured': batch_id});
		
				if (ajax.statusText == 'OK') {
				
					var entryData = $.parseJSON(ajax.responseText);
					
					console.log(entryData.new_featured);
					
					$('#featured-batch').attr('id', '');					 
					$(this).attr('id', 'featured-batch');							 
				
				} 
				
					
			});

			$(document).on('click', change_batch_number, function(event){ 

			  var new_batch_number = prompt("Please enter batch number:","Batch #");
			  var batch_id = $(this).attr('batch_id');
			  
			  if (Utils.isNumber(new_batch_number)) {
						
					var ajax = Model.post(Model.url.update_batch_number, {'new_batch_number': new_batch_number, 'batch_id' : batch_id});
		
		
					if (ajax.statusText == 'OK') {
					
						var entryData = $.parseJSON(ajax.responseText);

					console.log(entryData.newnumber);


						$(this).parents('.whitesection').find('.batchnumber').html(entryData.newnumber);							 

						} 
					
					} else {
						alert('Batch number must be a number');
					}
					
					});

			$(document).on('blur', id_range, function(event){ 

			  var new_id_range = $(this).val();
			  var batch_id = $(this).attr('batch_id');
			  
					var ajax = Model.post(Model.url.update_id_range, {'id_range': new_id_range, 'batch_id' : batch_id});
		
		
					if (ajax.statusText == 'OK') {
					
						var entryData = $.parseJSON(ajax.responseText);

					console.log(entryData.newnumber);


						$(this).parents('.whitesection').find('.batchnumber').html(entryData.newnumber);							 

						} 

					});

			$(document).on('click', delete_batch_part, function(event){ 

			   event.preventDefault();
	
			   if (confirm("Are you sure you want to delete this flavor?")) {

	
					var batch_part_id = $(this).attr('batch_part_id');
	
					var ajax = Model.post(Model.url.delete_batch_part, {'batch_part_id' : batch_part_id});
		
					if (ajax.statusText == 'OK') {
	
						$(this).parents('.batch_part').fadeOut();							 
	
						} 
				}
				
				});

			$(document).on('click', delete_batch, function(event){ 
			   
			   if (confirm("Are you sure you want to delete this batch?")) {
			   
					var batch_id = $(this).attr('batch_id');
	
					var ajax = Model.post(Model.url.delete_batch, {'batch_id' : batch_id});
		
					if (ajax.statusText == 'OK') {
	
						$(this).parents('.whitesection').fadeOut();							 
	
						} 
				}
			});

			$(document).on('click', clone_batch, function(event){ 
			   
			   if (confirm("Are you sure you want to clone this batch?")) {
			   
					var batch_id = $(this).attr('batch_id');
	
					var ajax = Model.post(Model.url.clone_batch, {'batch_id' : batch_id});
		
					if (ajax.statusText == 'OK') {
	
						window.location.href = window.location.href;

						console.log('that worked');
	
						} 
					else {
						console.log('error');
					}
				}
			});

			$(document).on('click', delete_supplier, function(event){ 
			   
 			   event.preventDefault();

			   
			   if (confirm("Are you sure you want to delete this supplier?")) {
			   
					var supplier_id = $(this).attr('supplier_id');
					var supplier_type = $(this).attr('supplier_type');
	
					var ajax = Model.post(Model.url.delete_supplier, {'supplier_id' : supplier_id, 'supplier_type' : supplier_type });
		
					console.log(ajax);
		
					if (ajax.statusText == 'OK') {
	
						$(this).parents('.whitesection').empty().html('<h2>Supplier ID ' + supplier_id + ' has been deleted.</h2>');							 
	
						} 
				}
			});

			$(document).on('click', delete_farm, function(event){ 
			   
 			   event.preventDefault();

			   
			   if (confirm("Are you sure you want to delete this farm?")) {
			   
					var farm_id = $(this).attr('farm_id');
	
					var ajax = Model.post(Model.url.delete_farm, {'farm_id' : farm_id});
		
					console.log(ajax);
		
					if (ajax.statusText == 'OK') {
	
						$(this).parents('.whitesection').empty().html('<h2>Farm ID ' + farm_id + ' has been deleted.</h2>');							 
	
						} 
				}
			});

			$(document).on('click', add_batch, function(event){ 

			  var batch_number = prompt("Please enter batch number:","Batch #");
			  
			  if (Utils.isNumber(batch_number)) {

						
					var ajax = Model.post(Model.url.add_batch, {'batch_number': batch_number});
		
					if (ajax.statusText == 'OK') {
					
						var entryData = $.parseJSON(ajax.responseText);

							 var html_string = '<a href="add_batch_part.php?batch_id=' + entryData.id + '" class="short-button">Add Flavor</a><div class="batchnumber">' + entryData.number + '</div><button batch_id="3" class="delete_batch btn-smallgray">delete batch</button><button batch_id="3" class="change_batch_number btn-smallgray">change number</button>';
							 
							 $('<li/>', {class: 'whitesection', batch_id: entryData.id, html: html_string }).prependTo('#batch-list');

						} 
					
					} else {
						alert('Batch number must be a number');
					}
					
					});

			 $("#select_flavor").change(function(){
	 				Controller.batchPartSummary();
			    });

			$(document).on('click', select_farm, function(event){ 

				Controller.batchPartSummary();

			});

			$(document).on('click', batch_add_supplier, function(event){ 

			 var  supplier_id = $(this).parent().find('select :selected').attr('value'),
			 		supplier_name = $(this).parent().find('select :selected').html(),
			 		batch_id = $(this).attr('batch_id'),
			 		supplier_type = $(this).attr('supplier_type'),
			 		html_string = '<span>' + supplier_name + '</span><span class="list"></span><button class="remove-batch-supplier">remove</button>';

				 $('<li/>', { class: 'supplier', supplier_id: supplier_id, html: html_string }).appendTo('#' + supplier_type + '_list');


			if (supplier_type == 'supplier_ingredients') {
			 		
			 		var ajax = Model.post(Model.url.find_farms, {'supplier_id': supplier_id});
		
					if ((ajax.statusText == 'OK') && (ajax.responseText != 'none')) {
											
							var entryData = $.parseJSON(ajax.responseText);

							var farm_list = [];
			
							$.each(entryData, function(i, val) {	
	
								html_string = '<li><input type="checkbox" class="farm" farm_id="' + val.id + '">' + val.name + '</input></li>';
								farm_list.push(html_string);
	
								});

						 $('<ul/>', {class: 'select_farm', html: farm_list.join('') }).appendTo('#' + supplier_type + '_list .supplier[supplier_id="' + supplier_id + '"] .list');

					 }
				}

				else {}

				Controller.batchPartSummary();



			});
			
			$(document).on('click', remove_batch_supplier, function(event){ 
				
				$(this).parent().remove();

				Controller.batchPartSummary();

			});

			$(document).on('click', featured_supplier, function(event){ 
				
				$(this).toggleClass('featured');
				Controller.batchPartSummary();
				
			});

			$(document).on('click', frontpage_featured, function(event){ 

				var type = $(this).attr('supplier_type');
				var id = $(this).attr('supplier_id');
				var oldvalue = $(this).attr('featured_state');

				if (oldvalue == 1) {
					var newvalue = 0;
				} else {
					var newvalue = 1;
				}		

				
				var ajax = Model.post(Model.url.update_frontpage_featured, {'type': type, 'id' : id, 'value' : newvalue});
		
		
					if (ajax.statusText == 'OK') {

						$(this).attr('featured_state', newvalue).toggleClass('featured');
					 

						} 
					
					
					});

			$(document).on('click', add_flavor, function(event){ 

			  var flavor = prompt("Please enter flavor:", "Jelly Bean");
			  
			  if (flavor != '') {
						
					var ajax = Model.post(Model.url.add_flavor, {'flavor': flavor});
		
					if (ajax.statusText == 'OK') {
					
						var entryData = $.parseJSON(ajax.responseText);

							 var html_string = '<li flavor_id="' + entryData.id + '"><span class="flavor-name">' + entryData.name + '</span><button class="edit-flavor-name btn-smallgray">change flavor name</button</li>';
							 
							 $('<li/>', {flavor_id: entryData.id, html: html_string }).prependTo('#flavor-list');

						} 
					
					} else {
						alert('Error : Required field');
					}


				
			});

			$(document).on('click', edit_flavor_name, function(event){ 
			
				var id = $(this).parents('li').attr('flavor_id'),
				 	 oldname = $(this).parents('li').find('.flavor-name').html();

			  var flavor = prompt("Please enter new flavor name :", oldname);
			  
			  if ((flavor != '') && (flavor != oldname)) {
						
					var ajax = Model.post(Model.url.update_flavor, {'flavor': flavor, 'id': id});
		
					if (ajax.statusText == 'OK') {
					
						var entryData = $.parseJSON(ajax.responseText);

						console.log(id);
							$('#flavor-list li[flavor_id="' + id + '"] .flavor-name').html(entryData.name);

						} 
					
					} else {
						alert('No changes made.');
					}


				
			});

			$(document).on('blur', location_city, function(event){ 
 			   event.preventDefault();
 			   t.locationSummary();
			});

			$(document).on('change', location_state, function(event){ 
 			   event.preventDefault();
 			   t.locationSummary();
			});

			$(document).on('click', location_remove, function(event){ 
			
				/* remove location after checking to make sure it isn't the last location */

			   event.preventDefault();
	
				if ($(".location").length >= 2) {

				   if (confirm("Are you sure you want to delete this location?")) {
						
						$(this).parent().remove();
		 			   t.locationSummary();
					
						};

					} else {

						confirm("You cannot delete the last location value.")

					}
				
			});

			$(document).on('click', location_add, function(event){ 
			
				/* add a location */

				event.preventDefault();
				
				var new_location = $('.location-template').clone(true);
				new_location.toggleClass('location-template location'); 
				new_location.insertBefore($('.location-tally'));
	
			
			});

		},

		locationSummary : function(){
		
			/*  cycles through each copy of .location, grabs info from
				 location_state and location_city and sends that info to 
				 the .taly input which can then be sent to the db. */
			
 			var locations = [];

 			$('.location')
				.each( function(e) {	
					locations.push({city: $(this).find('input').val(), state: $(this).find('select').val() });
					});
															
			$('.location-tally').val('').val(JSON.stringify(locations));

		},

		locationParse : function(){

			/* reads JSON string created by locationSummary in .location-tally and uses it 
			   to recreate the saved data for the editor. */

				 
				if ( $('.location-tally').val() != '') {

					var locations = $.parseJSON($('.location-tally').val());

					$.each( locations, function( key, value ) {
					
						if (this.state != 'NONE') {

							var new_location = $('.location-template').clone(true);
							new_location.toggleClass('location-template location'); 
							new_location.find('input').val(this.city); 
							new_location.find('select option[value='+this.state+']').attr('selected','selected'); 
							new_location.insertBefore($('.location-tally'));

						}
					});
				
				} else {

						var new_location = $('.location-template').clone(true);
						new_location.toggleClass('location-template location'); 
						new_location.insertBefore($('.location-tally'));
					
				}
				
		},		
		batchPartSummary : function(){
		
			/* cycles through all suppliers and farms that have been selected
			   and lists their id #s in a series of hidden fields at the bottom
			   of the page that are then sent to the batch_part table. */
			
			var ingredients = [];
			var farms = [];
			var packaging = [];
			var production = [];

			var featured_ingredients = [];
			var featured_farms = [];
			var featured_packaging = [];
			var featured_production = [];


			var flavor = $('#select_flavor :selected').attr('name');
			$('#batchpart_form #bp_name').val('').val(flavor);

			$('#supplier_ingredients_list')
				.find('.supplier')
				.each( function(e) {	
					id = $(this).attr('supplier_id');
					ingredients.push(id);
					});
			$('#batchpart_form #bp_ingredients').val('').val(ingredients);

			$('#supplier_ingredients_list')
				.find('.farm:checked')
				.each( function(e) {	
					id = $(this).attr('farm_id');
					farms.push(id);
					});
			$('#batchpart_form #bp_farms').val('').val(farms);

			$('#supplier_packaging_list')
				.find('.supplier')
				.each( function(e) {	
					id = $(this).attr('supplier_id');
					packaging.push(id);
					});
			$('#batchpart_form #bp_packaging').val('').val(packaging);

			$('#supplier_production_list')
				.find('.supplier')
				.each( function(e) {	
					id = $(this).attr('supplier_id');
					production.push(id);
					});
					
			$('#batchpart_form #bp_production').val('').val(production);


// featured

			$('#supplier_ingredients_list')
				.find('.featured')
				.each( function(e) {	
					id = $(this).parent().attr('supplier_id');
					featured_ingredients.push(id);
					});

			$('#batchpart_form #bp_featured_ingredients').val('').val(featured_ingredients);

			$('#supplier_ingredients_list')
				.find('.featured').parents('.supplier').find('.farm:checked')
				.each( function(e) {	
					id = $(this).attr('farm_id');
					featured_farms.push(id);
					});
					
			$('#batchpart_form #bp_featured_farms').val('').val(featured_farms);

			$('#supplier_packaging_list')
				.find('.featured')
				.each( function(e) {	
					id = $(this).parent().attr('supplier_id');
					featured_packaging.push(id);
					});
					
			$('#batchpart_form #bp_featured_packaging').val('').val(featured_packaging);

			$('#supplier_production_list')
				.find('.featured')
				.each( function(e) {	
					id = $(this).parent().attr('supplier_id');
					featured_production.push(id);
					});
					
			$('#batchpart_form #bp_featured_production').val('').val(featured_production);

		},

		notify : function(message) { 	 
		
		},

	},
	

	Utils = {

		isNumber : function (n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
		}
		
	};


	if(window.location.hash == '#direct'){

	} 

	Controller.init();

});
