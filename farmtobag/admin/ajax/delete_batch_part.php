<?php


	$batch_id = $_POST['batch_part_id'];

	include_once("../../config.php"); 



	$update = "DELETE FROM batch_parts
				  WHERE id = $batch_id
				 ";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		}

