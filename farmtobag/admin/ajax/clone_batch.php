<?php


$batch_id = $_POST['batch_id'];
$nextbatch = intval($_POST['batch_id']) + 1; 

	include_once("../../config.php"); 

	$update = "INSERT INTO batches
				 (number, key_suppliers, id_range)
				 SELECT '$nextbatch', key_suppliers, ''
				 FROM batches
				 WHERE id = $batch_id";

		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}
/* get the new batch id */

		if (false !== $result) {
		
			$query = "SELECT batches.*
						 FROM batches
						 ORDER BY id DESC
						 LIMIT 1"; 
												 
				$result = mysql_query($query);
				
				if (false === $result) { echo 'query failed';}			
				
				if (false !== $result) {

					$data = mysql_fetch_array($result);
					$new_batch_id = $data['id'];

/* create new batch_part tables */

					$update = "INSERT INTO batch_parts
								 (batch_id, name, ingredient_array, farm_array, production_array, packaging_array, featured_ingredients, featured_farms, featured_packaging, featured_production)
								 SELECT 	'$new_batch_id', name, ingredient_array, farm_array, production_array, packaging_array, featured_ingredients, featured_farms, featured_packaging, featured_production 
								 FROM batch_parts
								 WHERE batch_id = $batch_id";
					
							$result = mysql_query($update);
						
					
							if (false === $result) {
								echo mysql_error();
							}
					
							if (false !== $result) {
					
					
					
		
		

						echo json_encode($new_batch_id);
				
				}	
			}
		}

