<?php
	include 'database.php';
	session_start();
	if(!isset($_SESSION['matchid']))
	{
		header('location:liveorschedule.php');
	}
	$a=$_SESSION['team1'];
	$b=$_SESSION['team2'];
	$match=$_SESSION['matchid'];
	$c=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$a'");
	$d=mysqli_fetch_assoc($c);
	if($d['count']<11)
	{
		echo 'ADD PLAYERS FOR '.$a;
	}
	elseif($d['count']>10 && $d['count']<15)
	{
		echo 'ADD SUBSTITUTES for '.$a;
	}
	elseif($d['count']>14)
	{
		$z=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$b'");
		$zq=mysqli_fetch_assoc($z);
		if($zq['count']<11)
		{
			echo 'ADD PLAYERS FOR '.$b;
		}
		elseif ($zq['count']>10 && $zq['count']<15) {
			echo 'ADD SUBSTITUTES for '.$b;
		}
		elseif($zq['count']==15)
		{
			echo 'Proceed To Toss';
		}
	}

?>