<?php
// Make a MySQL Connection
include_once("../config.php"); 


 //This code runs if the form has been submitted
 if (isset($_POST['submit'])) { 
 
 //This makes sure they did not leave any fields blank
 if (!$_POST['users_username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
 		die('You did not complete all of the required fields');
 	}
 
 // checks if the users_username is in use
 	if (!get_magic_quotes_gpc()) {
 		$_POST['users_username'] = addslashes($_POST['users_username']);
 	}
 $usercheck = $_POST['users_username'];
 $check = mysql_query("SELECT users.username FROM users WHERE users.username = '$usercheck'") 
 or die(mysql_error());
 $check2 = mysql_num_rows($check);
 
 //if the name exists it gives an error
 if ($check2 != 0) {
 		die('Sorry, the users_username '.$_POST['users_username'].' is already in use.');
 				}
 // this makes sure both users_passwords entered match
 	if ($_POST['pass'] != $_POST['pass2']) {
 		die('Your users_passwords did not match. ');
 	}
 
 	// here we encrypt the users_password and add slashes if needed\
 	$_POST['pass'] = md5($_POST['pass']);
 	if (!get_magic_quotes_gpc()) {
 		$_POST['pass'] = addslashes($_POST['pass']);
 		$_POST['users_username'] = addslashes($_POST['users_username']);
 			}
 
 // insert it into the database
 	$insert = "INSERT INTO users (users.username, users.password, users.access_level)
 			VALUES ('".$_POST['users_username']."', '".$_POST['pass']."', 1)";
 	$add_member = mysql_query($insert);
 	
 	
 	?>
 
 
 <h1>Registered</h1>
 <p>Thank you, you have registered - you may now  <a href="login.php">Login</a>.</p>

<?php } 
 else {	 ?>
 
  <h1>Admin Register</h1>

 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <table border="0">
 <tr><td>users_username:</td><td>
 <input type="text" name="users_username" maxlength="60">
 </td></tr>
 <tr><td>users_password:</td><td>
 <input type="password" name="pass" maxlength="10">
 </td></tr>
 <tr><td>Confirm users_password:</td><td>
 <input type="password" name="pass2" maxlength="10">
 </td></tr>
 <tr><th colspan=2><input type="submit" name="submit" 
value="Register"></th></tr> </table>
 </form>
 <?php
 } ?> 



