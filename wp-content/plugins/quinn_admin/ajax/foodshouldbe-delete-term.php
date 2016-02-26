<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

$host    = 'mysql.quinnpopcorn.com';
$name    = 'quinn_foodshouldbe';
$user    = 'quinn_fsb';
$password = '193DDDDd94zxvNCdsd96ddjFfd1rh';

// Make a MySQL Connection
$connection = @mysql_connect($host, $user, $password) or die(mysql_error());
$db = @mysql_select_db($name,$connection) or die(mysql_error());


$return_data = null;

$term = $_POST['term'];

if (isset($term)) {

	$insert = "DELETE FROM terms WHERE term = '$term'";

	$add = mysql_query($insert);

	if (false === $add)
	{
		echo mysql_error();
	}
	else
	{
		$return_data = 'success';

	}
}

else {
	$return_data = 'fail';
}



echo json_encode($return_data);

mysql_close($connection);

?>
