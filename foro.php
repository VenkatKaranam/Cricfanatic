<?php
	session_start();
	include 'database.php';
	$match=$_SESSION['matchid'];
	$team1=$_SESSION['team1'];
	$team2=$_SESSION['team2'];
	$a=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$team1'");
	$b=mysqli_fetch_assoc($a);
	$c=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$team2'");
	$d=mysqli_fetch_assoc($c);
	if($b['count']!=15 || $d['count']!=15)
	{
		echo '<input type="submit" class="btn" name="search" value="search">';
	}
?>