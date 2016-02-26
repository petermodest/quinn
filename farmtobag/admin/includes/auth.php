<?php 

ob_start();

if(!isset($_SESSION)){ 
	session_start();
 }

if(!isset($_SESSION['login_username']) || !isset($_SESSION['login_hash']) || $_SESSION['login_hash']!=sha1($_SESSION['login_username']."FOX") || $_SESSION['login_access_level']!= 1 ){
	header("Location: ../login.php?AdminPermissionError");	
}

ob_flush();

?>
