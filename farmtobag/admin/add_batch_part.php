<?php 

include_once("../config.php"); 

if (isset($_GET['batch_id'])) {

		$batch_id = $_GET['batch_id'];
		
		$insert = "INSERT INTO batch_parts(batch_id)
					 VALUES ('$batch_id')";
	
		$result = mysql_query($insert);
	
		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {	

			$find_recent = " SELECT batch_parts.* 
									FROM batch_parts 
								 	ORDER BY id DESC
								 	LIMIT 1 
												 	"; 
			
			$recent_result = mysql_query($find_recent);
			
			if (false === $recent_result) { 
			
				echo mysql_error();
					
					}			

			if (false !== $recent_result) { 		

				$recent_data = mysql_fetch_array($recent_result); 
				$batch_part_id	=	$recent_data['id'];

			}
		}
			
	} else {
		
				$batch_part_id	 = $_GET['batch_part_id'];	
		}


   header( 'Location: edit_batch_part.php?batch_id='  . $batch_id . '&batch_part_id='.$batch_part_id ) ;



 ?>


