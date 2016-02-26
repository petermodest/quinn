<?php
ob_start();

if(!isset($_SESSION)){ 
	session_start();

 }


$msg = '';

include_once("config.php"); 


if (isset($_GET['PermissionError'])) {
		$message = "";	
	}
	
if (isset($_GET['WrongPass'])) {
		$message = "Hm, nope. Try again?";	
	}

// -------- end ---------//

if ((isset($_POST["username"]) && $_POST["pass"]>'')) {

   $username=strtolower(trim($_POST['username']));
   $password=md5($_POST['pass']);


	  $check = mysql_query("SELECT * FROM users WHERE users.username = '$username' AND users.password='$password' LIMIT 1")or die(mysql_error());
   if(mysql_num_rows($check)==1){
			$row=mysql_fetch_array($check);

				$_SESSION['login_username']=$row['username'];
				$_SESSION['login_userid']=$row['id'];
				$_SESSION['login_hash']=sha1($row['username']."FOX");
				
				$_SESSION['login_access_level']=$row['access_level'];

					if ($_SESSION['login_access_level'] == 1) {
			        header("Location: admin/index.php");
					}

					else {
			        header("Location: index.php");
					}


   }else{
   
		header("Location: login.php?WrongPass");	
   
   }
}
ob_flush();


$thisSection="Login";


?>

<html>
<head>

	<title>Farm to Bag</title>
	
	<link rel="stylesheet" type="text/css" href="admin/includes/styles-admin.css">

	
</head>

<body id="login-screen">
<div id="login-screen-wrapper">

<div id="login-wrapper">
<form action="" method="post">

	<input type="text" name="username" placeholder="Username" maxlength="20" /> 
	<br />
	<input type="password" name="pass" placeholder="Password" maxlength="20" />
	<br />
	<input type="submit" name="submit" class="big-button" value="Login" />

</form>

<p id="form-msg"><?php echo $message ?></p>


</div><!-- login-wrapper -->
</div><!-- login-screen-wrapper -->



</body>
</html>
