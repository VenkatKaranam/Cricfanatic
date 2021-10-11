<?php
	session_start();
	include 'database.php';
	$a=$_POST['striker'];
	$b=$_POST['nonstriker'];
	$bc=$_POST['bowler'];
	$c=$_SESSION['matchid'];
	//echo $a.' ,'.$b.' ,'.$bc.' ,'.$c;
	$d=mysqli_query($database,"update overs set striker='$a' where matchid='$c'");
	$e=mysqli_query($database,"update overs set nonstriker='$b' where matchid='$c'");
	$f=mysqli_query($database,"update overs set bowler='$bc' where matchid='$c'");
	$g=mysqli_query($database,"update players set outornot='bat' where matchid='$c' and playername='$a'");
	$h=mysqli_query($database,"update players set outornot='bat' where matchid='$c' and playername='$b'");
	if($d  && $e && $f && $g && $h)
	{
		header('location:adminpanel.php');
	}
	else
	{
		header('location:select.php');
	}
?>