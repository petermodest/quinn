<?php

function getBatchParts($batch_id){

	$return_array = array();

	$query_batchparts = "SELECT batch_parts.*
								FROM batch_parts
								WHERE batch_id = $batch_id
								"; 
														 
		$result_batchparts = mysql_query($query_batchparts);
		if (false === $result_batchparts) { echo mysql_error();}			
		if (false !== $result_batchparts) { 							

		while($data_batchparts = mysql_fetch_array($result_batchparts)) {

			$return_array[] = array(
				'id'							=>	$data_batchparts['id'],
				'name'						=>	$data_batchparts['name'],
				'ingredients_array'		=>	explode(',', $data_batchparts['ingredient_array']),
				'farm_array'				=>	explode(',', $data_batchparts['farm_array']),
				'production_array'		=>	explode(',', $data_batchparts['production_array']),
				'packaging_array'			=>	explode(',', $data_batchparts['packaging_array']),
				'featured_ingredients'	=>	explode(',', $data_batchparts['featured_ingredients']),
				'featured_farms'			=>	explode(',', $data_batchparts['featured_farms']),
				'featured_production'	=>	explode(',', $data_batchparts['featured_production']),
				'featured_packaging'		=>	explode(',', $data_batchparts['featured_packaging']),
					);
				}
			}
			
	return $return_array;
}


function get_featured_batch_no(){
	
		$query = "SELECT batches.*
				 FROM batches
				 WHERE featured = 1
				 LIMIT 1"; 
												 
	$result = mysql_query($query);
	
	if (false === $result) { echo 'query failed';}			
	
	$data = mysql_fetch_array($result);
	
	return $data['number'];

}

function get_recent_batch_no(){
	
		$query = "SELECT batches.*
				 FROM batches
				 ORDER BY id DESC
				 LIMIT 1"; 
												 
	$result = mysql_query($query);
	
	if (false === $result) { echo 'query failed';}			
	
	$data = mysql_fetch_array($result);
	
	return $data['number'];

}

function getFeaturedStates($val, $type){

	$statelist = array();

	switch($type) {
	
		case 'all':
		
				$types = array("ingredients", "production", "packaging");
				$statelist = array();

				foreach($types as $t) {

					foreach($val['featured_'.$t] as $featured_id) {
					
						if ($featured_id != '') {

							$tablename = 'supplier_' . $t;
							
							$query = "SELECT $tablename.*
										 FROM $tablename
										 WHERE id = $featured_id
										 LIMIT 1
										 "; 
																			 
							$result = mysql_query($query);
							
							if (false === $result) { echo mysql_error();}			
							if (false !== $result) { 							
						
								$data = mysql_fetch_array($result);
								array_push($statelist, locationJSONExtractStates($data['locations']) );
								
								}
							}
						}
					}
			break;
		
		default:
		
			echo 'default';
			break;
		
		}
		
		return $statelist;
		
	}
	
	
function showMap($states, $id) {

	$stylestring = '<style type="text/css">';
	$stylestring .= '#'.$id.'{color: #cecece;}';

	foreach($states as $st) {
	
		$stylestring .=  '#' . $id . ' .' . strtolower($st) . ',';
	
	}
	
	$stylestring = substr_replace($stylestring , '', -1, 1);
	$stylestring .= '{color: #00b5db;}';
	$stylestring .= '</style>';

	$returnstring = $stylestring;
	
	$returnstring .= '<ul class="stately" id="'.$id.'"> 
		<li data-state="al" class="al">A</li>
		<li data-state="ak" class="ak">B</li>
		<li data-state="ar" class="ar">C</li>						
		<li data-state="az" class="az">D</li>
		<li data-state="ca" class="ca">E</li>
		<li data-state="co" class="co">F</li>
		<li data-state="ct" class="ct">G</li>
		<li data-state="de" class="de">H</li>
		<li data-state="dc" class="dc">I</li>
		<li data-state="fl" class="fl">J</li>
		<li data-state="ga" class="ga">K</li>
		<li data-state="hi" class="hi">L</li>
		<li data-state="id" class="id">M</li>
		<li data-state="il" class="il">N</li>
		<li data-state="in" class="in">O</li>
		<li data-state="ia" class="ia">P</li>
		<li data-state="ks" class="ks">Q</li>
		<li data-state="ky" class="ky">R</li>
		<li data-state="la" class="la">S</li>
		<li data-state="me" class="me">T</li>
		<li data-state="md" class="md">U</li>
		<li data-state="ma" class="ma">V</li>
		<li data-state="mi" class="mi">W</li>
		<li data-state="mn" class="mn">X</li>
		<li data-state="ms" class="ms">Y</li>
		<li data-state="mo" class="mo">Z</li>
		<li data-state="mt" class="mt">a</li>
		<li data-state="ne" class="ne">b</li>
		<li data-state="nv" class="nv">c</li>
		<li data-state="nh" class="nh">d</li>
		<li data-state="nj" class="nj">e</li>
		<li data-state="nm" class="nm">f</li>
		<li data-state="ny" class="ny">g</li>
		<li data-state="nc" class="nc">h</li>
		<li data-state="nd" class="nd">i</li>
		<li data-state="oh" class="oh">j</li>			
		<li data-state="ok" class="ok">k</li>
		<li data-state="or" class="or">l</li>
		<li data-state="pa" class="pa">m</li>
		<li data-state="ri" class="ri">n</li>
		<li data-state="sc" class="sc">o</li>
		<li data-state="sd" class="sd">p</li>
		<li data-state="tn" class="tn">q</li>
		<li data-state="tx" class="tx">r</li>
		<li data-state="ut" class="ut">s</li>
		<li data-state="va" class="va">t</li>
		<li data-state="vt" class="vt">u</li>			
		<li data-state="wa" class="wa">v</li>
		<li data-state="wv" class="wv">w</li>
		<li data-state="wi" class="wi">x</li>
		<li data-state="wy" class="wy">y</li>	
	</ul>';
	
	return $returnstring;

}

function showFarms($supplier_id, $farm_array) {
	
	$return_string = null;
	
	$query = "SELECT farms.* 
				 FROM farms 
				 WHERE supplier_id = $supplier_id
				 "; 
	
	$result = mysql_query($query);
	
	if (false === $result) { echo mysql_error(); }			

	if (false !== $result) { 
	
			$return_string .= '<ul class="farm-list">';
			
		while($data = mysql_fetch_array($result)){ 
		
			$farm_id = $data['id'];
			$farm_name = $data['name'];
			$farm_locations = $data['locations'];
		
			foreach($farm_array as $val) {

				if ($farm_id == $val) {
					$return_string .= '<li farm_id="' . $farm_id . '">' . $farm_name . ' - ' . locationJSONtoString($farm_locations) . ' </li>';
				}
			}
		} 

			$return_string .= '</ul>';


	if (isset($farm_id)) { 
		
		return $return_string; 
		
		} else {} 
	
	}

}

function farmStateArray($supplier_id) {
	
	$states = array();
	
	$query = "SELECT farms.* 
				 FROM farms 
				 WHERE supplier_id = $supplier_id
				 "; 
	
	$result = mysql_query($query);
	
	if (false === $result) { echo mysql_error(); }			

	if (false !== $result) { 
			
		while($data = mysql_fetch_array($result)){ 

			array_push($states, locationJSONExtractStates($data['locations']));
		}
	
		return $states; 

	}

}


function showBatchSuppliers($content, $type) {

		echo '<h2 class="supplier-type">' . $type . '</h2>';

		$array = $content[$type . '_array'];
		$tablename = 'supplier_'.$type;
		$batch_part_id = $content['id'];
		$string = null;


			foreach($array as $val) {
	
				$string = null;

				$val = intval($val);
	
				$query = "SELECT $tablename.* 
							 FROM $tablename 
							 WHERE id = $val
						 	 LIMIT 1 
						 	 "; 
				
				$result = mysql_query($query);
				
				if (false === $result) { echo mysql_error(); }			
				
				if (false !== $result) { 
						
					$data = mysql_fetch_array($result); 

					$states = array(locationJSONExtractStates($data['locations']));
					$farmstates = farmStateArray($val);
					
					if (isset($farmstates[0])) {
						$allstates = array_merge($states[0], $farmstates[0]);
					}
					
					else {
						$allstates = $states[0];
					}
					
					$string .= '<div class="supplier" supplier_id="' . $data['id'] . '">';			
					$string .= '<h3 class="supplier-supply">' . $data['supply'] . '</h3>';
					$string .= '<div class="accordion-container">';
					
					$string .= showMap($allstates, 'map_'.$tablename.'_'.$data['id']);
					
					if ($type == 'ingredients') {
						$string .= '<h3 class="supplier-layers-deep">' . $data['layers_deep'] . '</h3><p class="layers-deep-label">Layers Deep (<a href="#">what\'s this?</a>)';
						};
					
					$string .= '<p class="supplier-name-label label">Name</p>';
					$string .= '<p class="supplier-name">' . $data['name'] . '</p>';
					$string .= '<p class="supplier-description-label label">Description</p>';
					$string .= '<p class="supplier-description">' . $data['description'] . '</p>';
					$string .= '<p class="supplier-location-label label">Location</p>';
					$string .= '<p class="supplier-location">' . locationJSONtoString($data['locations']) .' </p>';

	
				if ($type == 'ingredients') {

					$string .= '<p class="supplier-certifications-label label">Certifications</p>';
					$string .= '<p class="supplier-certifications">' . $data['certifications'] . '</p>';
					$string .= '<p class="supplier-website-label label">Website</p>';
					$string .= '<p class="supplier-website"><a href="' . $data['website'] . '" target="_blank">' . $data['website'] . '</a></p>';

					if ($data['extra_links'] != '') {
						$string .= '<p class="supplier-extralinks-label label">Extra Links</p>';
						$string .= '<p class="supplier-extra_links">' . $data['extra_links'] . '</p>';
					}

					if ($data['media'] != '') {
						$string .= '<p class="supplier-media-label label">Media</p>';
						$string .= '<p class="supplier-media">' . $data['media'] . '</p>';
						}

					if (showFarms($data['id'], $content['farm_array']) != null) {

						$string .= '<p class="supplier-farms-label label">Farms</p>';
						$string .= '<p class="supplier-farms">' . showFarms($data['id'], $content['farm_array']) . '</p>';
						// if farms states can be spit out here then they can be added to state array
						
					
					}

					} 		
					
					if ($data['images'] != '') {
						
						$image_array = explode(',', $data['images']);

						$string .= '<p class="supplier-images-label label">Images</p>';
						$string .= '<ul class="supplier-images">';

						foreach($image_array as $image){
						
						$string .= '<li><img src="content/images/' . str_replace(' ', '',  $image) . '"></li>';
						
						}

						$string .= '</ul>';

						
					}
				}

		$string .= '</div><div class="clearboth"></div></div>';
	
		
		echo $string;
	
	}	

}

function getFeaturedInfo($batch_parts) {
	
	$types = array('ingredients', 'farms', 'production', 'packaging');
	$featured_info = array();

	foreach($batch_parts as $batch_part) {

		foreach($types as $type) {
			
			$featured_ids = $batch_part['featured_' . $type];
			
			foreach($featured_ids as $id) {
			
				if ($id != '') {
			
					if ($type != 'farms') {
					
						$tablename = 'supplier_' . $type;
					
					}
					
					else {$tablename = $type;}
					
					$query = "SELECT $tablename.*
								 FROM $tablename
								 WHERE id = $id
								 "; 
																	 
					$result = mysql_query($query);
					
					if (false === $result) { echo mysql_error();}			
					if (false !== $result) { 							
				
						$data = mysql_fetch_array($result);
						
						$featured_info[] = array(
							'id'				=>			$data['id'],
							'type'			=>			$type,
							'name'			=>			$data['name'],
							'description'	=>			$data['description'],
							'locations'		=>			$data['locations'],
							'images'			=>			explode(',', $data['images'])
							);
						}
					}
			}
		}
	}

	return $featured_info;

}

function showFeaturedMap($featured_suppliers){

	/* convert JSON info from 'location' in to an array
	   of usable state codes, then send to map function */

	$statelist = array();

	foreach($featured_suppliers as $supplier) {

		$statelist = array_merge($statelist, locationJSONExtractStates($supplier['locations']) );

	}

	echo showMap($statelist, 'featured');

}

function locationJSONExtractStates($JSON) {

	$statelist = array();
	$location_array = json_decode($JSON, true);
	
		foreach($location_array as $location) {
		
			array_push($statelist, $location['state'] );
		
		}
	return $statelist;
	
}

function locationJSONtoString($JSON) {

	/* convert JSON location info in to readable string */

	$string = '';
	
	$locationJSON = json_decode($JSON, true);
		
		foreach($locationJSON as $location) {
		
			$string .=	$location['city'] . ', ' . $location['state'] . '<span class="location-divide">/</span>';
		
		}
	
	return $string;
	
	
}

function showFeaturedList($featured_suppliers) {

	$string = '';
	$oldtitle = '';

	 foreach($featured_suppliers as $supplier) { 

		if ($supplier['type'] != 'farms') {

			$string .= '<div class="featured-supplier">';

				if ($supplier['type'] != $oldtitle) {
					$string .= '<h3>' . $supplier['type'] . '</h3>';
				}
				
				$oldtitle = $supplier['type'];

				$learnlink = '<a href="' . getInfoLink($supplier['name']) . '">Learn more ...</a>';
							
				$string .= '<p><strong>' . $supplier['name'] . '</strong> - ' . locationJSONtoString($supplier['locations']) . ' - ' . $learnlink . '</p>';

					if ($supplier['images'][0] != null) {

						$string .= '<ul class="supplier-images">';
						
						foreach($supplier['images'] as $image) {

							$string .= '<li><img src="content/images/' . str_replace(' ', '',  $image) . '"></li>';

						}

						$string .= '</ul>';
				}
		
			$string .= '</div><!-- featured-supplier -->';

		}
	}
			
			return $string;
	
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


function getFrontpageFeatured() {
	
	$string = '<ul>';
	$types = array('ingredients', 'production', 'packaging');
	$featured_info = array();

	foreach($types as $type) {

			$tablename = 'supplier_' . $type;
			
			$query = "SELECT $tablename.*
						 FROM $tablename
						 WHERE featured = 1
						 "; 
															 
			$result = mysql_query($query);
			
			if (false === $result) { echo mysql_error();}			
			if (false !== $result) { 							
		
		while($supplier = mysql_fetch_array($result)) {
				
				if ($supplier['id'] != null){
				

					$string .= '<li><a href="' . getInfoLink($supplier['name']) . '">';
	
					if ($supplier['images'] != null) {
	
						$image_array = explode(',', $supplier['images']);
	
						$string .= '<img src="content/images/' . str_replace(' ', '',  $image_array[0]) . '">';
	
						$string .= '<p>' . $supplier['name'] . '</p>';
					}
	
					$string .= '</a></li>';
				}
			}	
		}
}
			$string .= '</ul>';
	
	
	
	return $string;
}


function getInfoLink($name) {

		$slug = strtolower(str_replace(" ", "-", $name));
		$link = "/suppliers/" . $slug;
	
	return $link;
}


?>