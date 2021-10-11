<!DOCTYPE html>
<html>
<head>
	<title>Select player and bowler</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<?php
		session_start();
		include 'nav.php';
		include 'database.php';
		$matchid=$_SESSION['matchid'];
		$toss=mysqli_query($database,"select * from matches,matchdetails where matches.matchid=matchdetails.matchid and matches.matchid='$matchid'");
		$fetch=mysqli_fetch_assoc($toss);
		if($fetch['innings']==1)
		{
			if($fetch['toss']==$fetch['team1'] && $fetch['tossresult']=='Bat')
			{
				$team=$fetch['team1'];
				$team2=$fetch['team2'];
			}
			if($fetch['toss']==$fetch['team1'] && $fetch['tossresult']=='Ball')
			{
				$team=$fetch['team2'];
				$team2=$fetch['team1'];
			}
			if($fetch['toss']==$fetch['team2'] && $fetch['tossresult']=='Bat')
			{
				$team=$fetch['team2'];
				$team2=$fetch['team1'];
			}
			if($fetch['toss']==$fetch['team2'] && $fetch['tossresult']=='Ball')
			{
				$team=$fetch['team1'];
				$team2=$fetch['team2'];
			}
		}
		else
		{
			if($fetch['toss']==$fetch['team1'] && $fetch['tossresult']=='Bat')
			{
				$team=$fetch['team2'];
				$team2=$fetch['team1'];
			}
			if($fetch['toss']==$fetch['team1'] && $fetch['tossresult']=='Ball')
			{
				$team=$fetch['team1'];
				$team2=$fetch['team2'];
			}
			if($fetch['toss']==$fetch['team2'] && $fetch['tossresult']=='Bat')
			{
				$team=$fetch['team1'];
				$team2=$fetch['team2'];
			}
			if($fetch['toss']==$fetch['team2'] && $fetch['tossresult']=='Ball')
			{
				$team=$fetch['team2'];
				$team2=$fetch['team1'];
			}
		}
	?>

	<center><form action="updatedetailsout.php" method="post" style="margin-top: 150px;">
		<table><tr><td>Select Striker:</td><td><select class="custom_selection" name="striker">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid' and outornot='yettobat' and ineleven='yes' and team='$team'");
				while($a=mysqli_fetch_assoc($matchdetails))
				{
					echo '<option>'.$a['playername'].'</option>';
				}
			?>
		</select></td></tr>

	</table>
	<input type="submit" style="outline: none;border:none;background-color: #1A5276;color: white;font-weight: bold;padding: 15px;border-radius: 15px;cursor: pointer;" value="continue">
	</form><center>
</body>
</html>