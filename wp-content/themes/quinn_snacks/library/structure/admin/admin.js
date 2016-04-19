jQuery(function( $ ){
	$(document).ready(function(){			

		$('[data-name="snacks"] > .acf-input > .acf-repeater > .acf-table > tbody > .acf-row').each(function(){
			$(this).find('td[data-name="ingredient"] select').each(function(){
				limit_ingredients( $(this) );
			})
		})

		$(document).on('change', '[data-name="ingredient"] select', function(){
			limit_ingredients( $(this), 1 )
		})		

		$(document).on('change', '#acf-field_5706e6eff1866-570c6b79b0835-field_5706e771f1867', function(){
			console.log('change');
		})

	})
	
	function limit_ingredients( $elem, show ) {
		var selected_ingredient = $elem.val();
		var $check_wrap = $elem.closest('td').siblings('[data-name="supplier"]');
		var $input = $('input[name="' + $check_wrap.find('input:eq(0)').attr('name') + '"]');

		$check_wrap.find('li input').each(function(){
			var $input_option = $(this);
			var selected_value = $input_option.val();

			if( in_array( selected_ingredient, supplier_ingredients[selected_value] ) )
				$input_option.closest('li').show();
			else
				$input_option.prop('checked', false).closest('li').hide();
		})
		if( show && $check_wrap.find('li:visible').length == 1 ) 
			$check_wrap.find('li:visible input').prop('checked', true)		
	}
	
	$(document).on('select2-selecting', '[data-name="snack"]', function(e){

		var $ingredients_wrap = $(e.target).closest('[data-name="snack"]').siblings('[data-name="ingredients"]');
		var $add_button = $ingredients_wrap.find('.button[data-event="add-row"]');
		
		$ingredients_wrap.find('.acf-table .acf-row').each(function(){
			if( ! $(this).is('.acf-clone') ) {
				$(this).find('[data-event="remove-row"]').trigger('click');
			}
		})
		
		$.each(snack_ingredients[e.val], function(key, value){
			$add_button.trigger('click');
			var $ingredient_wrap = $ingredients_wrap.find('.acf-row:eq(' + key + ')');
			$ingredient_wrap.find('select').val(value).trigger('change');
		})
	})
})

function in_array( needle, haystack ) {
    for( var i = 0; i < haystack.length; i++ ) if( haystack[i] == needle ) return true;
    return false;
}