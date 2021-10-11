<?php
	session_start();
	$_SESSION['playmatch']=$_REQUEST['match'];
	header('location:livescores.php');
?>