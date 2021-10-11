<!DOCTYPE html>
<html>
<head>
	<title>Select player and bowler</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<?php


		//$team --> bat 
		//$team2--> bowling

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

	<center><form action="updatedetails.php" method="post" name="f" style="margin-top: 150px;" onsubmit="return validate();">
		<table><tr><td>Select Striker:</td><td><select class="custom_selection" name="striker">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid' and outornot!='out'  and ineleven='yes' and team='$team'");
				while($a=mysqli_fetch_assoc($matchdetails))
				{
					echo '<option>'.$a['playername'].'</option>';
				}
			?>
		</select></td></tr><tr>
		<td>Select Non-Striker:</td><td><select class="custom_selection" name="nonstriker">
			<?php
				$matchdetails=mysqli_query($database,"select * from players where matchid='$matchid' and outornot!='out'  and ineleven='yes' and team='$team'");
				while($a=mysqli_fetch_assoc($matchdetails))
				{
					echo '<option>'.$a['playername'].'</option>';
				}
			?>
		</select></td></tr>

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
		<script type="text/javascript">
			function validate()
			{
				var a=document.f.striker.value;
				var b=document.f.nonstriker.value;
				if(a==b)
				{
					alert("striker and non striker must not be same");
					return false;
				}
			}
		</script>
</body>
</html>