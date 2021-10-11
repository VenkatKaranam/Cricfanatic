<?php
	session_start();
	include 'database.php';
	$a=$_POST['striker'];
	$c=$_SESSION['matchid'];

	$eking=mysqli_query($database,"select * from overs where matchid='$c'");
	$feking=mysqli_fetch_assoc($eking);
	if($feking['striker']=='haha')
		mysqli_query($database,"update overs set striker='$a' where matchid='$c'");
	else
		mysqli_query($database,"update overs set nonstriker='$a' where matchid='$c'");

	$g=mysqli_query($database,"update players set outornot='bat' where matchid='$c' and playername='$a'");
	if($g)
	{
		header('location:adminpanel.php');
	}
	else
	{
		header('location:select.php');
	}
?>