<?php


	$farm_id = $_POST['farm_id'];

	include_once("../../config.php"); 

	$update = "DELETE FROM farms
				 WHERE id = $farm_id
				 ";
	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		}

