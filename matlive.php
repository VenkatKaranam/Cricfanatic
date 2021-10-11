<?php
	include 'database.php';
	session_start();
	$a=$_POST['venue'];
	$b=$_POST['creator'];
	$c=$_POST['overs'];
	$d=$_POST['team1'];
	$e=$_POST['team2'];
	if(strlen($a)==0 || strlen($b)==0 || strlen($c)==0 || strlen($d)==0 || strlen($e)==0)
	{
		$_SESSION['warning']="some error please try oops";
		header('location:matchlive.php');
	}
	else
	{
		$g=uniqid();
		$h=$d.' vs '.$e;
		date_default_timezone_set("Asia/Kolkata"); 
		$dat=date('Y/n/j H:i:s');
		$x=mysqli_query($database,"insert into matches(matchid,matchname,creator,venue,date,overs,schedule,team1,team2) values('$g','$h','$b','$a','$dat','$c','live','$d','$e')");
		
		if($x)
		{
			$_SESSION['matchid']=$g;
			$_SESSION['team1']=$d;
			$_SESSION['team2']=$e;
			header('location:add.php');
		}
		else
		{
			$_SESSION['warning']="some error please try haha again";
			header('location:matchlive.php');
		}
	}
?>