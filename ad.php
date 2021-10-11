<?php
	session_start();
	if(!isset($_REQUEST['name']) || !isset($_SESSION['matchid']))
	{
		header('location:liveorschedule.php');
	}
	include 'database.php';
	$matchid=$_SESSION['matchid'];
	$team1=$_SESSION['team1'];
	$team2=$_SESSION['team2'];
	$player=$_REQUEST['name'];
	$val=mysqli_query($database,"select count(*) as `count` from players where matchid='$matchid' and team='$team1'");
	$cou=mysqli_fetch_assoc($val);
	if($cou['count']==15)
	{
		$team=$team2;
	}
	else
	{
		$team=$team1;
	}
	$pla=mysqli_query($database,"select count(*) as `count` from players where matchid='$matchid' and team='$team' and ineleven='yes'");
	$cu=mysqli_fetch_assoc($pla);
	if($cu['count']>10)
	{
		$inel='no';
	}
	else
	{
		$inel='yes';
	}
	$s=mysqli_query($database,"insert into players(matchid,playername,team,ineleven) values('$matchid','$player','$team','$inel')");
	if($s)
	{
		header('location:add.php');
	}
	

?>