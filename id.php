<?php
	include 'database.php';
	session_start();
	$a=$_SESSION['matchid'];
	$e=mysqli_query($database,"select * from displayid where matchid='$a'");
	$f=mysqli_fetch_assoc($e);
	echo $f['adminid'];
?>