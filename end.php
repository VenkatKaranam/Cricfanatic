<?php
	session_start();
	include 'database.php';
	$matchid=$_SESSION['matchid'];
	$a=mysqli_query($database,"select * from matches where matchid='$matchid'");
	$b=mysqli_fetch_assoc($a);


	$team1=$b['team1'];
	$team2=$b['team2'];


	$s=mysqli_query($database,"select sum(runs) as `runs` from players where matchid='$matchid' and team='$team1'");
	$fs=mysqli_fetch_assoc($s);


	$s1=mysqli_query($database,"select sum(runs) as `runs` from players where matchid='$matchid' and team='$team2'");
	$fs1=mysqli_fetch_assoc($s1);

	$sc=mysqli_query($database,"select * from extras where matchid='$matchid'");
	$fsc=mysqli_fetch_assoc($sc);

	$score1=$fs['runs']+$fsc['team2'];
	$score2=$fs1['runs']+$fsc['team1'];


	echo 'score1='.$score1;
	echo '<br>score2='.$score2;

	$cw=mysqli_query($database,"select count(*) as `wkts` from players where matchid='$matchid' and team='$team1' and outornot='out' and ineleven='yes'");
	$fcw=mysqli_fetch_assoc($cw);

	$towkts1=11-$fcw['wkts'];

	$cw1=mysqli_query($database,"select count(*) as `wkts` from players where matchid='$matchid' and team='$team2' and outornot='out' and ineleven='yes'");
	$fcw1=mysqli_fetch_assoc($cw1);

	$towkts2=11-$fcw1['wkts'];


	$sdif1=$score1-$score2;
	$sdif2=$score2-$score1;

	if($score1==$score2)
	{
		$result='match tied';
	}
	else
	{
	
	if($b['toss']==$b['team1'] && $b['tossresult']=='Ball')
	{
		if($score1>$score2)
		{
			$result=$b['team1'].' won by '.$towkts1.' wickets';
		}
		else
		{
			$result=$b['team2'].' won by '.$sdif2.' runs';
		}
	}
	
	if($b['toss']==$b['team1'] && $b['tossresult']=='Bat')
	{
		if($score1>$score2)
		{
			$result=$b['team1'].' won by '.$sdif1.' runs';
		}
		else
		{
			$result=$b['team2'].' won by '.$towkts2.' wickets';
		}
	}

	if($b['toss']==$b['team2'] && $b['tossresult']=='Ball')
	{
		if($score2>$score1)
		{
			$result=$b['team2'].' won by '.$towkts2.' wickets';
		}
		else
		{
			$result=$b['team1'].' won by '.$sdif1.' runs';
		}
	}
	
	if($b['toss']==$b['team2'] && $b['tossresult']=='Bat')
	{
		if($score2>$score1)
		{
			$result=$b['team2'].' won by '.$sdif2.' runs';
		}
		else
		{
			$result= $b['team1'].' won by '.$towkts1.' wickets';
		}
	}
}

mysqli_query($database,"update matches set win='$result' where matchid='$matchid'");
mysqli_query($database,"update matches set schedule='ended' where matchid='$matchid'");
unset($_SESSION['matchid']);
unset($_SESSION['team1']);
unset($_SESSION['team2']);
header('location:matches.php');



?>