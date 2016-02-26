<?php


	$flavor = $_POST['flavor'];
	$id = $_POST['id'];

	include_once("../../config.php"); 

	$update = "UPDATE flavors 
				  SET name = '$flavor'
				  WHERE id = $id";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

			echo json_encode(array ('name' => $flavor));

		}

