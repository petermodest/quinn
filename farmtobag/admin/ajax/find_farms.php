<?php

ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
//$supplier_id = 1;

$supplier_id = $_POST['supplier_id'];

	include_once("../../config.php"); 

	
	$find_farm = " SELECT farms.* 
						FROM farms 
						WHERE supplier_id = $supplier_id
						 	"; 
	
	$farm_result = mysql_query($find_farm);
	
	if (false === $farm_result) { 
	
		echo mysql_error();
			
			}			

	if (false !== $farm_result) { 		

		while($farm_data = mysql_fetch_array($farm_result)) { 
		
		$farm_batch[] = array (
			'id'	=>	$farm_data['id'],
			'name'	=>	$farm_data['name']
		);
	}

	if (!empty($farm_batch)) {
	
		echo json_encode($farm_batch);
	
	} else {
		echo 'none';
	}
}

?>