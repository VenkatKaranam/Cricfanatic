<!DOCTYPE html>
<html>
<head>
	<title>Select bowler</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<?php
		session_start();
		include 'nav.php';
		include 'database.php';
		$matchid=$_SESSION['matchid'];
		$boha=mysqli_query($database,"select * from overs where matchid='$matchid'");
		$fb=mysqli_fetch_assoc($boha);
		$bowler=$fb['bowler'];
		$gg=mysqli_query($database,"select * from players where matchid='$matchid' and playername='$bowler'");
		$ge=mysqli_fetch_assoc($gg);
		$team2=$ge['team'];
	?>

	<center><form action="updatebowler.php" method="post" style="margin-top: 150px;">
		<table>
		<tr><td>Select Bowler</td><td><select class="custom_selection" name="bowler">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid'  and ineleven='yes' and team='$team2'");
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