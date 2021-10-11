<?php
	include 'database.php';
	session_start();
	$match=$_SESSION['matchid'];
	$toss=$_POST['team1'];
	$choose=$_POST['batbal'];
	$b=mysqli_query($database,"update matches set toss='$toss' where matchid='$match'");
	$c=mysqli_query($database,"update matches set tossresult='$choose' where matchid='$match'");
	if($b && $c)
	{
		header('location:disid.php');
	}
	else
	{
		$_SESSION['warning']="some problem please try again";
		header('location:toss.php');
	}
?>