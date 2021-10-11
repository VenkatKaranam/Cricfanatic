<?php
	session_start();
	include 'database.php';
	$matchid=$_SESSION['matchid'];
	$a=mysqli_query($database,"update matchdetails set innings=2 where matchid='$matchid'");
	if($a)
	{
		header('location:select.php');
	}
	else
	{
		header('location:adminpanel.php');
	}
?>