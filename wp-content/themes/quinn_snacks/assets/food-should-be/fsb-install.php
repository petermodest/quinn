<?

include_once("fsb-db.php");

// Loop through and delete all tables

$sql = "SHOW TABLES FROM $name";
if($result = mysql_query($sql)){

  // add table name to array

  while($row = mysql_fetch_row($result)){
    $found_tables[]=$row[0];
  }
}
else{
  die("Error, could not list tables. MySQL Error: " . mysql_error());
}

/* loop through and drop each table */
foreach($found_tables as $table_name){
  $sql = "DROP TABLE $database_name.$table_name";
  if($result = mysql_query($sql)){
    echo "Success - table $table_name deleted. <br />";
  }
  else{
    echo "Error deleting $table_name. MySQL Error: " . mysql_error() . "";
  }
}

mysql_query("CREATE TABLE terms(
id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  term TEXT
  )")
 or die(mysql_error());


echo "<br />The thing is done, FSB installed.";



echo "<br /><br /> &rarr;   Ok! Ready to <a href='../login.php'>login</a>";


?>
