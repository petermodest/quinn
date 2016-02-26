<?php


	$supplier_id = $_POST['supplier_id'];
	$supplier_type = $_POST['supplier_type'];
	$tablename = 'supplier_'.$supplier_type;

	include_once("../../config.php"); 



	$update = "DELETE FROM $tablename
				 WHERE id = $supplier_id
				 ";

	
		$result = mysql_query($update);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		}

