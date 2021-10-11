<?php
	session_start();
	include 'database.php';
	$bc=$_POST['bowler'];
	$c=$_SESSION['matchid'];
	$f=mysqli_query($database,"update overs set bowler='$bc' where matchid='$c'");
	if($f)
	{
		header('location:adminpanel.php');
	}
	else
	{
		header('location:overchange.php');
	}
?>