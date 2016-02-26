<?php


	$type = $_POST['type'];
	$id = $_POST['id'];
	$value = $_POST['value'];
	
	$tablename = 'supplier_' . $type;
	

	include_once("../../config.php"); 

	$update = "UPDATE $tablename 
				  SET featured = '$value'
				  WHERE id = $id";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		//	echo json_encode(array ('newnumber' => $batch_number));

		}

