<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

include_once("../config.php"); 

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
  $sql = "DROP TABLE $name.$table_name";
  if($result = mysql_query($sql)){
    echo "Success - table $table_name deleted. <br />";
  }
  else{
    echo "Error deleting $table_name. MySQL Error: " . mysql_error() . "";
  }
}

mysql_query("CREATE TABLE batches(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	number INT(5),
	key_suppliers INT(5),
	id_range VARCHAR(200)
	)")
 or die(mysql_error());  

mysql_query("CREATE TABLE flavors(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	name TEXT
	)")
 or die(mysql_error());  

mysql_query("CREATE TABLE batch_parts (
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	batch_id INT(5),
	name TEXT,
	ingredient_array VARCHAR(200),
	farm_array VARCHAR(200),
	production_array VARCHAR(200),
	packaging_array VARCHAR(200),
	featured_ingredients VARCHAR(200),
	featured_farms VARCHAR(200),
	featured_packaging VARCHAR(200),
	featured_production VARCHAR(200)
	)")
 or die(mysql_error());  
 

mysql_query("CREATE TABLE supplier_ingredients(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	category_id INT(5),
	supply TEXT,
	name TEXT,
	description TEXT,
	city TEXT,
	state TEXT,
	certifications TEXT,
	website TEXT,
	extra_links TEXT,
	media TEXT,
	images TEXT,
	layers_deep INT(5),
	featured INT(2)
	)")
 or die(mysql_error());  


mysql_query("CREATE TABLE supplier_packaging(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	supply TEXT,
	name TEXT,
	description TEXT,
	city TEXT,
	state TEXT,
	images TEXT,
	featured INT(2)
	)")
 or die(mysql_error());  

mysql_query("CREATE TABLE supplier_production(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	supply TEXT,
	name TEXT,
	description TEXT,
	city TEXT,
	state TEXT,
	images TEXT,
	featured INT(2)
	)")
 or die(mysql_error());  

mysql_query("CREATE TABLE farms(
id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	supplier_id INT(5),
	name TEXT,
	description TEXT,
	city TEXT,
	state TEXT,
	images TEXT,
	media TEXT,
	featured INT(2)
	)")
 or die(mysql_error());  

mysql_query("CREATE TABLE users(
userid INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(userid),
	username VARCHAR(60), 
	email VARCHAR(60), 
	password VARCHAR(60), 
	access_level INT(3)
	)")
 or die(mysql_error());  



echo "<br /><br />The thing is done. You are clean.";

?>




