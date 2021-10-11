<?php
	include 'database.php';
	session_start();
	$a=$_SESSION['asadmin'];
	$b=$_REQUEST['adminid'];
	$ch=mysqli_query($database,"select * from displayid where matchid='$a' and adminid='$b'");
	if(mysqli_num_rows($ch)==0)
	{
		$_SESSION['warning']="adminid not matched";
		header('location:create.php');
	}
	else
	{
		$chu=mysqli_query($database,"select * from matches where matchid='$a'");
		$fe=mysqli_fetch_assoc($chu);
		$_SESSION['team1']=$fe['team1'];
		$_SESSION['team2']=$fe['team2'];
		if($fe['toss']==NULL)
		{
			$_SESSION['matchid']=$a;
			header('location:toss.php');
		}
		else{
			$_SESSION['matchid']=$a;
			header('location:select.php');
		}
	}
?>