<?php


	$batch_number = $_POST['batch_number'];

	include_once("../../config.php"); 

		$insert = "INSERT INTO batches(number)
					 VALUES ('$batch_number')";
	
		$result = mysql_query($insert);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

			$find_recent = "  SELECT batches.* 
									FROM batches 
								 	ORDER BY id DESC
								 	LIMIT 1 
								 	"; 
			
			$recent_result = mysql_query($find_recent);
			
			if (false === $recent_result) { 
			
				echo mysql_error();
					
					}			

			if (false !== $recent_result) { 		

				$recent_data = mysql_fetch_array($recent_result); 
				
				$recent_batch = array (
					'id'	=>	$recent_data['id'],
					'number'	=>	$recent_data['number']
				);
				
				echo json_encode($recent_batch);

			}

}