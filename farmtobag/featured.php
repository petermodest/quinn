<?php

include('includes/header.php'); 

if (isset($_GET['id']) && isset($_GET['type'])) {

$type = $_GET['type'];
$id = $_GET['id'];
$filename =  $type . '_'  . $id . '.html';
	
include('content/featured/' . $filename); 


}// if batch ID is set
else {
	echo '<p class="errormessage">Hmm ... No batch ID matches that number. <a href="index.php">Try again</a>?</p>';
}

include('includes/footer.php'); 


?>