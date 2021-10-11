<?php
	session_start();
	include 'database.php';
	$b=$_SESSION['matchid'];

	$e=mysqli_query($database,"select * from displayid where matchid='$b'");
	$f=mysqli_fetch_assoc($e);
	echo 'REMEMBER THIS CODE<br>TO UPDATE LIVE SCORES YOU NEED THIS ID<br>ADMIN ID: '.$f['adminid'];
?>