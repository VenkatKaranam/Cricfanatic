<?php
	session_start();
	$matchid=$_SESSION['playmatch'];	
	include 'database.php';
	echo '<u>Commentary</u><br>';
	$a=mysqli_query($database,"select * from commentary where matchid='$matchid' order by sn desc");
	if(mysqli_num_rows($a)==0)
	{
		echo 'match not yet started';
	}
	while($b=mysqli_fetch_assoc($a))
	{
		echo $b['overr'].'.'.$b['ball'].' '.$b['bowler'].' to'.' '.$b['striker'].' ,<b>'.$b['run'].'</b><br><hr>';
	}

?>