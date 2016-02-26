<?php 
$host    = 'mysql.quinnpopcorn.com'; 
$name    = 'quinn_farmtobag';  
$user    = 'quinn_farmtobag';  
$password = 'C331C6DT4FpjpthR26r64A9Ns5L';  

// Make a MySQL Connection
$connection = @mysql_connect($host, $user, $password) or die(mysql_error()); 
$db = @mysql_select_db($name,$connection) or die(mysql_error()); 

/*

Login : admin
pass : 8aGt0f@arm

*/


?>