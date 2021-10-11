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


		$overdetails=mysqli_query($database,"select * from overs,players where players.matchid=overs.matchid and players.matchid='$matchid'");
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


		$play1=$ffetch['striker'];
		$scub=mysqli_query($database,"select * from overs,players where players.matchid=overs.matchid and players.matchid='$matchid' and playername='$play1'");
		$fscub=mysqli_fetch_assoc($scub);

		$play2=$ffetch['nonstriker'];
		$scub2=mysqli_query($database,"select * from overs,players where players.matchid=overs.matchid and players.matchid='$matchid' and playername='$play2'");
		$fscub2=mysqli_fetch_assoc($scub2);

		$boww=$ffetch['bowler'];
		$mb=mysqli_query($database,"select * from bowler,players where bowler.matchid=players.matchid and bowler.matchid='$matchid' and players.playername='$boww'");
		$fmb=mysqli_fetch_assoc($mb);

		$ooov=mysqli_query($database,"select * from bowler where matchid='$matchid' and bowler='$boww'");
		

		if(mysqli_num_rows($ooov)==0)
		{
			$ovam=0; // overs
			$balam=0;  // balls
		}
		else
		{
			$fooov=mysqli_fetch_assoc($ooov);
			$ovam=$fooov['overr'];
			$balam=$fooov['ball'];
		}
		error_reporting(0);
?>

<font style="font-size: 25px;">Select The Striker</font>
			<form>
				<label for="player1"><?php echo $ffetch['striker'].' '.$fscub['runs'].'('.$fscub['balls'].')';?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="player2"><?php echo $ffetch['nonstriker'].' '.$fscub2['runs'].'('.$fscub2['balls'].')';?></label>
			</form><br>
			<font style="font-size: 25px; margin-top: 10px;">Bowler</font>
			<div class='bowler'>
				<font class="dis"><?php echo $ffetch['bowler'].' '.$fmb['runconceed'].'-'.$fmb['wickets'].'('.$ovam.'.'.$balam.')';?></font><br>
			</div>