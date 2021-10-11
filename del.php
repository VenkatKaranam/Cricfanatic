<?php
	include 'database.php';
	session_start();
	$x=$_REQUEST['name'];
	$y=$_SESSION['matchid'];
	$m=mysqli_query($database,"delete from players where matchid='$y' and playername='$x'");
	if($m)
	{
		header('location:add.php');
	}

?>