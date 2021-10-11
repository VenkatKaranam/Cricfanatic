<?php
	session_start();
	include 'database.php';
	$matchid=$_SESSION['matchid'];
	$a=mysqli_query($database,"select * from commentary where matchid='$matchid' order by sn desc limit 6");
	echo 'last six balls';
	while($b=mysqli_fetch_assoc($a))
	{
		
		if($b['run']=='0' || $b['run']=='1' || $b['run']=='2' || $b['run']=='3'  || $b['run']=='5')
			echo '<div class="bal">'.$b['run'].'</div>';
		else if($b['run']=='4')
			echo '<div class="bal" style="background-color: #1A5276; color: white;">4</div>';
		else if($b['run']=='6')
			echo '<div class="bal" style="background-color: gray;color: white;">6</div>';
		else if($b['run']=='w')
			echo '<div class="bal" style="background-color: red;color: white;">w</div>';
		else
			echo '<div class="bal" style="background-color: black;color: white;">'.$b['run'].'</div>';


	}

	
?>