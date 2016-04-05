<?php

function getBatchParts($batch_part_id) {
	
	$query = "SELECT batch_parts.* 
				 FROM batch_parts 
				 WHERE id = $batch_part_id
				 "; 
	
	$result = mysql_query($query);
	
	if (false === $result) { echo mysql_error(); }			
	
	if (false !== $result) { 
			
		$data = mysql_fetch_array($result);

		$return_data = array (
		
			'name'						=>		$data['name'],	
			'ingredient_array'		=>		$data['ingredient_array'],
			'farm_array'				=>		$data['farm_array'],
			'production_array'		=>		$data['production_array'],
			'packaging_array'			=>		$data['packaging_array'],
			'featured_ingredients'	=>		$data['featured_ingredients'],
			'featured_farms'			=>		$data['featured_farms'],
			'featured_packaging'		=>		$data['featured_packaging'],
			'featured_production'	=>		$data['featured_production']

			);
			
		return $return_data;
		
	}		
}



function showFlavorSelect($selected_flavor) {

				$return_string = '<select id="select_flavor">';
				$return_string .=	'<option name = "" >Select a flavor</option>';

	// show all ingredient suppliers
			
				$query = "SELECT flavors.*
							 FROM flavors
							 "; 
												 
				$result = mysql_query($query);
				
				if (false === $result) { echo 'query failed';}			
				
				while($data = mysql_fetch_array($result)) {

					$selected = '';
					
					if ($selected_flavor == $data['id'] ) {
						$selected = 'selected="selected"';	
					}
					
					$return_string .=	'<option ' . $selected . ' name = "' . $data['id'] .  '" >' . $data['name'] . '</option>';
					
					}

				$return_string .= '</select>';

			return $return_string;

}


function translate_flavors($code) {
	
	
	$query = "SELECT flavors.*
				 FROM flavors
				 WHERE id = $code
				 LIMIT 1
							 "; 
												 
	$result = mysql_query($query);
	
	if (false === $result) { echo 'query failed';}			
	
	$data = mysql_fetch_array($result);
	
	return $data['name'];
}


function showSupplierSelect($type, $batch_id) {
	
	$return_string = null;
	$table = 'supplier_'.$type;
	
	$query = "SELECT $table.* 
				 FROM $table 
				 ORDER BY supply
				 "; 
	
	$result = mysql_query($query);
	
	if (false === $result) { echo mysql_error(); }			

	if (false !== $result) { 
	
		$return_string .= '<li class="supplier-select"><select class="supplier-list"><option>Select Supplier</option>';
			
		while($data = mysql_fetch_array($result)){ 
		
			$supplier_id = $data['id'];
			$supplier_name = $data['name'];
			$supplier_supply = $data['supply'];
			
			$return_string .= '<option value="' . $supplier_id . '">' . $supplier_name . ' (' . $supplier_supply . ')</option>';
		} 

		$return_string .= '</select>';
	}

	$return_string .= '<button class="batch-add-supplier short-button" batch_id="' . $batch_id . '" supplier_type="supplier_' . $type . '">Add Supplier</button><div class="clearboth"></div></li>';

	echo $return_string; 

}

function showFarmSelect($supplier_id, $batch_part_id) {
	
	$return_string = null;
	$BatchParts = getBatchParts($batch_part_id);
	$farm_array = 	$array = explode(',', $BatchParts['farm_array']);
	$selected = 'checked="true"';
		
		$query = "SELECT farms.* 
					 FROM farms 
					 WHERE supplier_id = $supplier_id
					 "; 
		
		$result = mysql_query($query);
		
		if (false === $result) { echo mysql_error(); }			
	
		if (false !== $result) { 
		
			$return_string .= '<ul class="select_farm">';
				
			while($data = mysql_fetch_array($result)){ 
			
				$farm_id = $data['id'];
				$farm_name = $data['name'];
				
				$return_string .= '<li><input type="checkbox" class="farm" ';

				foreach($farm_array as $val) {
					if ($val == $farm_id) {
						$return_string .= $selected;
					}
				}				
				
				$return_string .= ' farm_id="' . $farm_id . '"> ' . $farm_name . '</input></li>';
				
			} 
	
			$return_string .= '</ul>';

		if (isset($farm_id))
			{ return $return_string; }
		else {
			
		} 
	
	}

	
}

function showBatchSuppliers($type, $content, $batch_part_id, $featured_parts) {
	
	if ($content != '' ) {
	
		$array = explode(',', $content);
		$featured_array = explode(',', $featured_parts);
		$tablename = 'supplier_'.$type;
		$string = null;
		$supplier_id = null;
		$featuredClass = null;
		
			foreach($array as $val) {

				$val = intval($val);
				$featuredClass='';

				$query = "SELECT $tablename.* 
							 FROM $tablename 
							 WHERE id = $val
						 	 LIMIT 1 
						 	 "; 
				
				$result = mysql_query($query);
				
				if (false === $result) { echo mysql_error(); }			
				
				if (false !== $result) { 

					$data = mysql_fetch_array($result); 
					$string .= '<li class="supplier" supplier_id="' . $data['id'] . '">';
					$string .= $data['name'] . ' - ' . $data['supply'] . '  ';
					$supplier_id = $data['id'];
	
				}
	
				if (in_array($supplier_id, $featured_array)) {
					$featuredClass = 'featured';
					$pagelink = ' <button class="featured-pagelink"></button>';
				}else {$featuredClass = ''; $pagelink = '';}

		
				$string .= ' <div class="remove-batch-supplier">remove</div>';
				$string .= ' <button class="featured-supplier ' . $featuredClass . '"></button>';

	
				if ($type == 'ingredients') {
	
					$string .= showFarmSelect($supplier_id, $batch_part_id);
	
				}

				$string .= '</li>';
			
			}	
		
		echo $string;
	
	}	

}

function getInfoLink($name) {

		$slug = strtolower(str_replace(" ", "-", $name));
		$link = "/suppliers/" . $slug;
	
	return $link;
}


?>