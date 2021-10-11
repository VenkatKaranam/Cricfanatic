<?php
		include 'database.php';
		session_start();
		$matchid=$_SESSION['matchid'];
		$matches=mysqli_query($database,"select * from matches where matchid='$matchid'");
		$fmatches=mysqli_fetch_assoc($matches);
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
		$discore=mysqli_query($database,"select sum(runs) as `runs` from players where matchid='$matchid' and team='$team'");
		$fdisscore=mysqli_fetch_assoc($discore);
		$diswkts=mysqli_query($database,"select sum(wickets) as `wkts`,sum(overs) as `overs`,sum(runouts) as `ro` from players where matchid='$matchid' and team='$team2'");
		$fdiswkts=mysqli_fetch_assoc($diswkts);
		$overdetails=mysqli_query($database,"select * from overs where matchid='$matchid'");
		$ffetch=mysqli_fetch_assoc($overdetails);

		$overr=mysqli_query($database,"select sum(overr) as `overs`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team2'");
		$foverr=mysqli_fetch_assoc($overr);

		$ext=mysqli_query($database,"select * from extras where matchid='$matchid'");
		$fext=mysqli_fetch_assoc($ext);
		if($fetch['team1']==$team)
			$exrun=$fext['team2'];
		else
			$exrun=$fext['team1'];

		$tww=$fdiswkts['wkts']+$fdiswkts['ro'];

?>
<font style="font-size: 18px;"><?php echo 'Matchid : '.$fmatches['matchid'];?></font> <br>
<font style="font-size: 18px;"><?php echo $fmatches['matchname'];?></font> <br>
		<?php $tor=$fdisscore['runs']+$exrun; echo $team.' '.$tor;?>/<?php echo $tww;?> <font style="font-size: 20px;">(<?php echo $foverr['overs'].'.'.$foverr['balls'];?>/<?php echo $fmatches['overs'];?>) </font>
		<br>
		<font  class="det"><?php echo $fmatches['toss'].' won the toss and elected to '.$fmatches['tossresult'].' first';?></font>