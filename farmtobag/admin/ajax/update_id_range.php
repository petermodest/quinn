<?php


	$id_range = $_POST['id_range'];
	$batch_id = $_POST['batch_id'];

	$id_range = str_replace(' ','', $id_range);

		
	include_once("../../config.php"); 

	$update = "UPDATE batches 
				  SET id_range = '$id_range'
				  WHERE id = $batch_id";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

			echo json_encode(array ('id_range' => $id_range));

		}

