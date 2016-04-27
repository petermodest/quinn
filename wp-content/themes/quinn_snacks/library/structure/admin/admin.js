jQuery(function( $ ){
	var supply_types = [ 'ingredients', 'packagers', 'producers' ];
	
	function limit_supply_tax(){
		$('#certificationdiv, #ingredientdiv, #production_typediv, #packaging_typediv').hide();
		if( $('#supplier_type-32 input').is(':checked') ) $('#certificationdiv, #ingredientdiv').show();
		if( $('#supplier_type-33 input').is(':checked') ) $('#packaging_typediv').show();
		if( $('#supplier_type-34 input').is(':checked') ) $('#production_typediv').show();
	}
	
	$(document).ready(function(){			

		if( $('body').is('.post-type-supplier') ) {
			limit_supply_tax();
			$('#supplier_typechecklist input').on('change', function(){
				limit_supply_tax();
			})
		}
		
		$('[data-name="snacks"] > .acf-input > .acf-repeater > .acf-table > tbody > .acf-row').each(function(){
			$(this).find('td[data-name="ingredient"] select, td[data-name="packager"] select, td[data-name="producer"] select').each(function(){
				console.log( $(this).closest('td').attr('data-name') + 's' );
				limit_fields( $(this), ( $(this).closest('td').attr('data-name') + 's' ) );
			})
		})

		$(document).on('change', 'td[data-name="ingredient"] select, td[data-name="packager"] select, td[data-name="producer"] select', function(){
			limit_fields( $(this), ( $(this).closest('td').attr('data-name') + 's' ), 1 );
		})		

	})
	
	
	function limit_fields( $elem, supply_type, show ) {
		var selected_ingredient = $elem.val();
		var $check_wrap = $elem.closest('td').siblings('[data-name="supplier"]');
		var $input = $('input[name="' + $check_wrap.find('input:eq(0)').attr('name') + '"]');

		$check_wrap.find('li input').each(function(){
			var $input_option = $(this);
			var selected_value = $input_option.val();

			if( in_array( selected_ingredient, suppliers[supply_type][selected_value] ) )
				$input_option.closest('li').show();
			else
				$input_option.prop('checked', false).closest('li').hide();
		})
		if( show && $check_wrap.find('li:visible').length == 1 ) 
			$check_wrap.find('li:visible input').prop('checked', true)		
	}

	$(document).on('select2-selecting', '[data-name="snack"]', function(e){
		var $wrap = {};
		var $add_button = {};
		
		$.each( supply_types, function( key, supply_type ){
			
			$wrap[supply_type] = $(e.target).closest('[data-name="snack"]').siblings('[data-name="' + supply_type + '"]');
			$add_button[supply_type] = $wrap[supply_type].find('.button[data-event="add-row"]');
			
			$wrap[supply_type].find('.acf-table .acf-row').each(function(){
				if( ! $(this).is('.acf-clone') ) {
					$(this).find('[data-event="remove-row"]').trigger('click');
				}
			})
			
			$.each(snack_supply[supply_type][e.val], function(key, value){
				$add_button[supply_type].trigger('click');
				var $wrap_row = $wrap[supply_type].find('.acf-row:eq(' + key + ')');
				$wrap_row.find('select').val(value).trigger('change');
			})
		})
	})

})

function in_array( needle, haystack ) {
    for( var i = 0; i < haystack.length; i++ ) if( haystack[i] == needle ) return true;
    return false;
}