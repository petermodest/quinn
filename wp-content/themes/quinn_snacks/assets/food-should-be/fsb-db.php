<?

$host    = 'mysql.quinnpopcorn.com';
$name    = 'quinn_foodshouldbe';
$user    = 'quinn_fsb';
$password = '193DDDDd94zxvNCdsd96ddjFfd1rh';

// Make a MySQL Connection
$connection = @mysql_connect($host, $user, $password) or die(mysql_error());
$db = @mysql_select_db($name,$connection) or die(mysql_error());

?>
