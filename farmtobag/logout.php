<?php 
ob_start();
session_start();
foreach($_SESSION as $key=>$val){
unset($_SESSION[$key]);
}
header("Location: login.php?LoggedOut");
ob_flush();
?>
 