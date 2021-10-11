<?php
	session_start();
	include 'database.php';
	$match=$_SESSION['matchid'];
	$team1=$_SESSION['team1'];
	$team2=$_SESSION['team2'];
	$a=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$team1'");
	$b=mysqli_fetch_assoc($a);
	$d=mysqli_query($database,"select count(*) as `count` from players where matchid='$match' and team='$team2'");
	$e=mysqli_fetch_assoc($d);
	if($b['count']==15 && $e['count']==15)
	{
		echo '<center><button class="button1"><a href="toss.php" style="text-decoration: none;color: white;font-weight: bold;">Continue</a></button></center>';
		echo '<script type="text/javascript">
	document.getElementById("kaka").style.display="none";
</script>';
	}
?>

