<?php


	$batch_number = $_POST['new_batch_number'];
	$batch_id = $_POST['batch_id'];

	include_once("../../config.php"); 

	$update = "UPDATE batches 
				  SET number = '$batch_number'
				  WHERE id = $batch_id";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

			echo json_encode(array ('newnumber' => $batch_number));

		}

