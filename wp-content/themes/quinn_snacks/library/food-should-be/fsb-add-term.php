<?
/*
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
*/

include_once("fsb-db.php");

$return_data = null;

$term = $_POST['term'];

if (isset($term)) {

	$insert = "INSERT INTO terms (`term`)
					VALUES ('$term')";

	$add = mysql_query($insert);

	if (false === $add)
	{
		echo mysql_error();
	}
	else
	{
		$return_data = $term;

	}
}

else {
	$return_data = 'No term set.';
}



echo json_encode($return_data);


?>
