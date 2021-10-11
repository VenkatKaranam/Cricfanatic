<!DOCTYPE html>
<html>
<head>
	<title>scorecard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="card.css">
</head>
<body>
	<?php
		include 'nav.php';
		session_start();
		include 'database.php';
		$matchid=$_SESSION['playmatch'];
		$a=mysqli_query($database,"select * from matches where matchid='$matchid'");
		$b=mysqli_fetch_assoc($a);
		$team1=$b['team1'];
		$team2=$b['team2'];
		$s=mysqli_query($database,"select sum(runs) as `runs` from players where matchid='$matchid' and team='$team1'");
		$ss=mysqli_fetch_assoc($s);
		$ts=mysqli_query($database,"select * from extras where matchid='$matchid'");
		$tss=mysqli_fetch_assoc($ts);
		$score1=$ss['runs']+$tss['team2'];

		$ov=mysqli_query($database,"select sum(overr) as `overs`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team2'");
		$fov=mysqli_fetch_assoc($ov);

		$pl=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='yes' and team='$team1'");

		$bo1=mysqli_query($database,"select * from players,bowler where players.playername=bowler.bowler and players.matchid=bowler.matchid and players.matchid='$matchid' and players.team='$team2'");

		$wic=mysqli_query($database,"select count(*) as `coun` from players where matchid='$matchid' and outornot='out' and team='$team1'");
		$fwic=mysqli_fetch_assoc($wic);


		$s1=mysqli_query($database,"select sum(runs) as `runs` from players where matchid='$matchid' and team='$team2'");
		$ss1=mysqli_fetch_assoc($s1);
		$score2=$ss1['runs']+$tss['team1'];

		$ov1=mysqli_query($database,"select sum(overr) as `overs`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team1'");
		$fov1=mysqli_fetch_assoc($ov1);

		$pl1=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='yes' and team='$team2'");

		$bo2=mysqli_query($database,"select * from players,bowler where players.playername=bowler.bowler and players.matchid=bowler.matchid and players.matchid='$matchid' and players.team='$team1'");

		$wic1=mysqli_query($database,"select count(*) as `coun` from players where matchid='$matchid' and outornot='out' and team='$team2'");
		$fwic1=mysqli_fetch_assoc($wic1);

	?>

	<center>
		<h2 style="color:#1A5276; text-shadow: none;"><?php
			echo $b['matchname'];
		?></h2><br>


		<button onclick="return a();">Team <?php echo $b['team1']?> innings</button>
		<button onclick="return b();">Team <?php echo $b['team2']?> innings</button>

<br><br>
		<div id="a">
			Team <?php echo $b['team1']?> innings - <?php echo $score1.'-'.$fwic['coun'] .' ('.$fov['overs'].'.'.$fov['balls'].'/'.$b['overs'].')';  ?> 
			<hr>
			<table>
				<tr>
					<td>Batsmen</td>
					<td>status</td>
					<td>R</td>
					<td>B</td>
					<td>4</td>
					<td>6</td>
				</tr>
				<?php
					while($fpl=mysqli_fetch_assoc($pl))
					{
						echo '<tr><td>'.$fpl['playername'].'</td>';
						if($fpl['outornot']=='yettobat')
						{
							echo '<td>yet to bat</td>';
							echo '<td>-</td>';
							echo '<td>-</td>';
							echo '<td>-</td>';
							echo '<td>-</td></tr>';
						}
						if($fpl['outornot']=='bat')
						{
							echo '<td>Not Out</td>';
							echo '<td>'.$fpl['runs'].'</td>';
							echo '<td>'.$fpl['balls'].'</td>';
							echo '<td>'.$fpl['fours'].'</td>';
							echo '<td>'.$fpl['sixes'].'</td></tr>';
						}
						if($fpl['outornot']=='out')
						{
							$plname=$fpl['playername'];
							$gett=mysqli_query($database,"select * from catchout where matchid='$matchid' and striker='$plname'");
							$fget=mysqli_fetch_assoc($gett);
							if($fget['how']=='runout' || $fget['how']=='bowled')
								echo '<td>'.$fget['how'].' '.$fget['reason'].'</td>';
							if($fget['how']=='caught')
								echo '<td>c.'.$fget['reason'].' b.'.$fget['bowler'].'</td>';
							if($fget['how']=='stumps')
								echo '<td>st.'.$fget['reason'].' b.'.$fget['bowler'].'</td>';
							echo '<td>'.$fpl['runs'].'</td>';
							echo '<td>'.$fpl['balls'].'</td>';
							echo '<td>'.$fpl['fours'].'</td>';
							echo '<td>'.$fpl['sixes'].'</td></tr>';
						}
					}
				?>
			</table>
<hr>

			<table>
				<tr>
					<td>Bowler</td>
					<td>O</td>
					<td>M</td>
					<td>R</td>
					<td>W</td>
					<td>nb</td>
					<td>wd</td>
				</tr>

				<?php
					while($gbo=mysqli_fetch_assoc($bo1))
					{
						echo '<tr><td>'.$gbo['playername'].'</td>';
						echo '<td>'.$gbo['overr'].'.'.$gbo['ball'].'</td>';
						echo '<td>'.$gbo['maidens'].'</td>';
						echo '<td>'.$gbo['runconceed'].'</td>';
						echo '<td>'.$gbo['wickets'].'</td>';
						echo '<td>'.$gbo['noballs'].'</td>';
						echo '<td>'.$gbo['wides'].'</td></tr>';
					}
				?>
			</table>
		</div>

<div id="b">
			Team <?php echo $b['team2']?> innings - <?php echo $score2.'-'.$fwic1['coun'] .' ('.$fov1['overs'].'.'.$fov1['balls'].'/'.$b['overs'].')';  ?> 
			<hr>
			<table>
				<tr>
					<td>Batsmen</td>
					<td>status</td>
					<td>R</td>
					<td>B</td>
					<td>4</td>
					<td>6</td>
				</tr>
				<?php
					while($fpl1=mysqli_fetch_assoc($pl1))
					{
						echo '<tr><td>'.$fpl1['playername'].'</td>';
						if($fpl1['outornot']=='yettobat')
						{
							echo '<td>yet to bat</td>';
							echo '<td>-</td>';
							echo '<td>-</td>';
							echo '<td>-</td>';
							echo '<td>-</td></tr>';
						}
						if($fpl1['outornot']=='bat')
						{
							echo '<td>Not Out</td>';
							echo '<td>'.$fpl1['runs'].'</td>';
							echo '<td>'.$fpl1['balls'].'</td>';
							echo '<td>'.$fpl1['fours'].'</td>';
							echo '<td>'.$fpl1['sixes'].'</td></tr>';
						}
						if($fpl1['outornot']=='out')
						{
							$plname=$fpl1['playername'];
							$gett=mysqli_query($database,"select * from catchout where matchid='$matchid' and striker='$plname'");
							$fget=mysqli_fetch_assoc($gett);
							if($fget['how']=='runout' || $fget['how']=='bowled')
								echo '<td>'.$fget['how'].' '.$fget['reason'].'</td>';
							if($fget['how']=='caught')
								echo '<td>c.'.$fget['reason'].' b.'.$fget['bowler'].'</td>';
							if($fget['how']=='stumps')
								echo '<td>st.'.$fget['reason'].' b.'.$fget['bowler'].'</td>';
							echo '<td>'.$fpl1['runs'].'</td>';
							echo '<td>'.$fpl1['balls'].'</td>';
							echo '<td>'.$fpl1['fours'].'</td>';
							echo '<td>'.$fpl1['sixes'].'</td></tr>';
						}
					}
				?>
			</table>
<hr>

			<table>
				<tr>
					<td>Bowler</td>
					<td>O</td>
					<td>M</td>
					<td>R</td>
					<td>W</td>
					<td>nb</td>
					<td>wd</td>
				</tr>

				<?php
					while($gbo=mysqli_fetch_assoc($bo2))
					{
						echo '<tr><td>'.$gbo['playername'].'</td>';
						echo '<td>'.$gbo['overr'].'.'.$gbo['ball'].'</td>';
						echo '<td>'.$gbo['maidens'].'</td>';
						echo '<td>'.$gbo['runconceed'].'</td>';
						echo '<td>'.$gbo['wickets'].'</td>';
						echo '<td>'.$gbo['noballs'].'</td>';
						echo '<td>'.$gbo['wides'].'</td></tr>';
					}
				?>
			</table>
		</div><br><br>



	</center>

<script type="text/javascript">
	function a()
	{
		document.getElementById('a').style.display="inline-block";
		document.getElementById('b').style.display="none";
		return false;
	}
	function b()
	{
		document.getElementById('b').style.display="inline-block";
		document.getElementById('a').style.display="none";
		return false;
	}
</script>
</body>
</html>