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
		$bowler=$_SESSION['bowler'];
		$gg=mysqli_query($database,"select * from overs,players where overs.matchid=players.matchid and overs.matchid='$matchid' and overs.bowler=players.playername");
		$ge=mysqli_fetch_assoc($gg);
		$team2=$ge['team'];

		$hag=mysqli_query($database,"select * from overs,players where players.matchid=overs.matchid and players.playername=overs.striker and  players.matchid='$matchid'");
		$fhag=mysqli_fetch_assoc($hag);
		$team=$fhag['team'];
	?>

	<center><form action="outback.php" method="post" style="margin-top: 150px;">
		<table><tr><td>Who is out:</td><td><select class="custom_selection" name="striker">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid' and outornot='bat' and ineleven='yes' and team='$team'");
				while($a=mysqli_fetch_assoc($matchdetails))
				{
					echo '<option>'.$a['playername'].'</option>';
				}
			?>
		</select></td></tr><tr>
		<td>How:</td><td><select class="custom_selection" name="outta">
			<option>runout</option>
			<option>caught</option>
			<option>bowled</option>
			<option>stumps</option>
		</select></td></tr>

		<tr><td>Caught/Runout</td><td><select class="custom_selection" name="bowler">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='yes' and team='$team2'");
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