<?
/*
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
*/

include_once("fsb-db.php");

$queryData = array();

	$query = "SELECT terms.term, COUNT(*) AS count
						FROM terms
						GROUP BY term
						";

	$result = mysql_query($query);

	if (false === $result)
	{

		echo mysql_error();

	}

	while( $data = mysql_fetch_array($result) )
	{

		$queryData[] = array(
			'text'    =>    $data['term'],
			'weight'    =>    $data['count']
			);
	}

	$return_data = $queryData;

echo json_encode($return_data);

?>
