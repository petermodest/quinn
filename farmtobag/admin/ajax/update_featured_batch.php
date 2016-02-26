<?php

	$new_featured = $_POST['new_featured'];

	include_once("../../config.php"); 

	$update = "UPDATE batches
			   SET featured = replace(featured, 1, 0)
			   ";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		$update2 = "UPDATE batches 
				  SET featured = 1
				  WHERE number = $new_featured";
			
			$result = mysql_query($update2);
		
	
			if (false === $result) {
				echo mysql_error();
			}
	
			if (false !== $result) {
	
				echo json_encode(array ('new_featured' => $new_featured));
	
			}

		}

?>