	<?php
		include 'nav.php';
		session_start();
		include 'database.php';
		$matchid=$_SESSION['playmatch'];
		$_SESSION['playmatch']=$matchid;
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

		$fis=mysqli_query($database,"select sum(runs) as `runs`,sum(wickets) as `wickets`,sum(runouts) as `ro` from players where matchid='$matchid' and team='$team'");
		$fetfis=mysqli_fetch_assoc($fis);

		$fis2=mysqli_query($database,"select sum(runs) as `runs`,sum(wickets) as `wickets`,sum(runouts) as `ro` from players where matchid='$matchid' and team='$team2'");
		$fetfis2=mysqli_fetch_assoc($fis2);

		$ovv=mysqli_query($database,"select * from matches where matchid='$matchid'");
		$fov=mysqli_fetch_assoc($ovv);

		$fina=mysqli_query($database,"select * from extras where matchid='$matchid'");
		$fefina=mysqli_fetch_assoc($fina);

		$hah=mysqli_query($database,"select sum(overr) as `overs`,sum(ball)as `balls` from bowler where matchid='$matchid' and team='$team2'");
		$fhah=mysqli_fetch_assoc($hah);


		$haha=mysqli_query($database,"select sum(overr) as `overs`,sum(ball)as `balls` from bowler where matchid='$matchid' and team='$team'");
		$fhaha=mysqli_fetch_assoc($haha);

		
			if($team==$fetch['team1'])
			{
				$toru1=$fetfis['runs']+$fefina['team2'];
				$toru2=$fetfis2['runs']+$fefina['team1'];
			}
			else
			{
				$toru1=$fetfis['runs']+$fefina['team1'];
				$toru2=$fetfis2['runs']+$fefina['team2'];	
			}


		$stri=mysqli_query($database,"select * from overs,players where overs.matchid=players.matchid  and overs.matchid='$matchid'");
		$fstri=mysqli_fetch_assoc($stri);

		$p1=$fstri['striker'];
		$p2=$fstri['nonstriker'];
		$b1=$fstri['bowler'];


		$fp1=mysqli_query($database,"select * from players where matchid='$matchid' and playername='$p1'");
		$ffp1=mysqli_fetch_assoc($fp1);

		$fp2=mysqli_query($database,"select * from players where matchid='$matchid' and playername='$p2'");
		$ffp2=mysqli_fetch_assoc($fp2);

		$fp3=mysqli_query($database,"select * from players where matchid='$matchid' and playername='$b1'");
		$ffp3=mysqli_fetch_assoc($fp3);

		$tww1=$fetfis2['wickets']+$fetfis2['ro'];
		$tww2=$fetfis['wickets']+$fetfis['ro'];

	?>


	<div class="livescore">
		<table><tr><td><div class="dot"></div></td><td> <?php echo $fetch['schedule'];?></td></tr></table>

		<table>
			<tr>
				<td class="name"><?php echo '<a href="players.php?player='.$team.'" style="text-decoration: none;" target="_blank">';?><?php echo $team;?></a></td>
				<td ><?php echo $toru1.'/'.$tww1.' ('.$fhah['overs'].'.'.$fhah['balls'].'/'.$fetch['overs'].')';?></td>
			</tr>
			<tr>
				<td class="name"><?php echo '<a href="players.php?player='.$team2.'" target="_blank" style="text-decoration: none;">'; ?><?php echo $team2;?></a></td>
				<td><?php echo $toru2.'/'.$tww2.' ('.$fhaha['overs'].'.'.$fhaha['balls'].'/'.$fetch['overs'].')';?></td>
			</tr>
			<tr>
				<td colspan="2"><font class="res">
					<?php

						$inn=mysqli_query($database,"select * from matchdetails where matchid='$matchid'");
						$finn=mysqli_fetch_assoc($inn);
						if($finn['innings']==1)
				 			echo $fetch['toss'].' won the toss and choose to '.$fetch['tossresult']; 
				 		else
				 		{
				 			if($fetch['schedule']=='ended')
				 				echo $fetch['win'];
				 			else
				 				echo $fetch['toss'].' won the toss and choose to '.$fetch['tossresult'];
				 		}


				 	?>
				 	</font></td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
		</table>
		<table>	
			<tr>
				<td class="name">Batsmen</td>
				<td>R</td>
				<td>B</td>
				<td>4s</td>
				<td>6s</td>
			</tr>
			<tr>
				<td class="name">
					<?php
						if($p1!='haha')
					 		echo $p1;
					 ?>
						
				</td>
				<td>
					<?php
						if($p1!='haha')
							echo $ffp1['runs'];
					?></td>
				<td>
					<?php
					if($p1!='haha')
					 	echo $ffp1['balls'];
					 ?></td>
				<td>
					<?php
					if($p1!='haha')
						echo $ffp1['fours'];
					 ?></td>
				<td>
					<?php
					if($p1!='haha')
						echo $ffp1['sixes'];
					?></td>
			</tr>
			<tr>
				<td class="name">
					<?php 
						if($p2!='haha')
							echo $p2;
					?></td>
				<td><?php 
				if($p2!='haha')
					echo $ffp2['runs'];?></td>
				<td><?php 
				if($p2!='haha')
					echo $ffp2['balls'];?></td>
				<td><?php 
				if($p2!='haha')
					echo $ffp2['fours'];?></td>
				<td><?php 
				if($p2!='haha')
					echo $ffp2['sixes'];?></td>
			</tr>
			<tr>
				<td colspan="5">
					<hr>
				</td>
			</tr>
			<tr>
				<td class="name">Bowler</td>
				<td>O</td>
				<td>M</td>
				<td>R</td>
				<td>W</td>
			</tr>
			<tr>
				<td class="name"><?php echo $b1;?></td>
				<td><?php echo $ffp3['overs'];?></td>
				<td><?php echo $ffp3['maidens'];?></td>
				<td><?php echo $ffp3['runconceed'];?></td>
				<td><?php echo $ffp3['wickets'];?></td>
			</tr>
		</table>
	</div>
	
	<hr class="hr">
	


