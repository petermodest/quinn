<?php


	$flavor = $_POST['flavor'];

	include_once("../../config.php"); 

		$insert = "INSERT INTO flavors(name)
					 VALUES ('$flavor')";
	
		$result = mysql_query($insert);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

			$find_recent = "  SELECT flavors.* 
									FROM flavors 
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
					'name'	=>	$recent_data['name']
				);
				
				echo json_encode($recent_batch);

			}

}