<?php
	include 'database.php';
	session_start();
	date_default_timezone_set("Asia/Kolkata"); 
	$a=$_POST['venue'];
	$b=$_POST['creator'];
	$c=$_POST['overs'];
	$d=$_POST['team1'];
	$e=$_POST['team2'];
	$l=$_POST['date'];
	$m=$_POST['time'];
	if(strlen($a)==0 || strlen($b)==0 || strlen($c)==0 || strlen($d)==0 || strlen($e)==0 || strlen($l)==0 || strlen($m)==0)
	{
		$_SESSION['warning']="some error please try oops";
		header('location:match_details.php');
	}
	else
	{
		$g=uniqid();
		$h=$d.' vs '.$e;
		$o=$l.' '.$m.':00';
		$u=date('Y/n/j H:i:s');
		$sec=strtotime($o)-strtotime($u);
		$min=abs(round($sec/60));
		echo $min;
		$x=mysqli_query($database,"insert into matches(matchid,matchname,creator,venue,date,overs,schedule,team1,team2) values('$g','$h','$b','$a','$o','$c','scheduled','$d','$e')");
		$oo=uniqid();
		$y=mysqli_query($database,"create event `$oo` on schedule at current_timestamp + interval $min minute on completion not preserve enable do update matches set schedule='live' where matchid='$g'");
		
		if($x || $y)
		{
			$_SESSION['matchid']=$g;
			$_SESSION['team1']=$d;
			$_SESSION['team2']=$e;
			header('location:add.php');
		}
		else
		{
			$_SESSION['warning']="some error please try again";
			header('location:match_details.php');
		}
	}
?>