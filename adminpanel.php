<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		function runn()
		{
			var strike=document.f.striker.value;
			var runs=document.f.runs.value;
			if(strike!="select striker")
			{
				if(runs!="runs")
				{
					document.getElementById('x').style.display="inline-block";
					document.getElementById('c').style.display="none";
				}
			}
		}
		function upd()
		{
			var strike=document.f.striker.value;
			var runs=document.f.runs.value;
			var bow=document.f.bowler.value;
			if(strike!="select striker" && runs!="runs")
			{
				$.ajax({
					type : 'post',
					data : {
						striker : strike,
						bowler : bow,
						run : runs
					},
					url :'adminbackend.php',
					cache : false,
					success:function(html)
					{
						$('#tw').html(html);
					}
				});
			}
			return false;
		}
		function run()
		{
			var strike=document.f.striker.value;
			var extra=document.f.extra.value;
			if(strike!="select striker")
			{
				if(extra!="extras")
				{
						document.getElementById('c').style.display="inline-block";
						document.getElementById('x').style.display="none";
				}
			}
		}
		function okk()
		{
			var strike=document.f.striker.value;
			var extra=document.f.extra.value;
			var exruns=document.f.extraruns.value;
			var bow=document.f.bowler.value;
			$.ajax({
				type : 'post',
				data :{
					striker : strike,
					bowler : bow,
					extrar : extra,
					exrun : exruns
				},
				url : 'adminbackend.php',
				cache : false,
				success:function(html)
				{
					$('#tw').html(html);
				}
			});
			return false;
		}
	</script>
</head>
<body>
	<?php
		include 'nav.php';
		?>
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
	<div class="tw" style="display: none;">hi</div>
	<div class="score">
		
	</div>

	<div class="bord"> 

		<div class="player">
			
		</div>

		<div class="updscore">
			<form name="f" onsubmit="return send();">
				<center>
					<select  style="width: 300px;font-weight: bold;height: 50px;" name="striker">
						<option>select striker</option>
						<option><?php echo $ffetch['striker'];?></option>
						<option><?php echo $ffetch['nonstriker'];?></option>
					</select><br><br>
					<input type="hidden" name="bowler" value="<?php echo $ffetch['bowler'];?>">
					<select style="width: 300px;font-weight: bold;height: 50px;" onchange="return runn();" name="runs">
						<option>runs</option>
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
					</select><br>
					<button onclick="return upd();" id="x">continue</button>
				</center><br>
				<table class="tab">
				<tr>
					
					<td><select id="ex"  name="extra">
						<option>extras</option>
						<option>wd</option>
						<option>nb</option>
						<option>lb</option>
						<option>b</option>
					</select></td>
					<td>+</td>
					<td><select id="ru"  onchange="return run();" name="extraruns">
						<option>runs</option>
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>6</option>
					</select></td>
				</tr>
			<tr><td colspan="2">
				<button id="c" onclick="return okk();">continue</button>
			</td></tr></form>
			
			</table>
		<br>

					<a href="overchange.php">overchange</a>
					<a href="outt.php">out</a>
					<?php

						$chein=mysqli_query($database,"select * from matchdetails where matchid='$matchid'");
						$fchein=mysqli_fetch_assoc($chein);
						if($fchein['innings']==1)
							echo '<a href="inningschange.php">innings change</a>';
						else
							echo '<a href="end.php">end match</a>';

					?>
		</div>
	</div>


	<div class="over">
		
	</div>
	<br>


<script type="text/javascript">
	$(document).ready(function(){
		setInterval(function(){
			$('.score').load('dummy1.php');
			$('.player').load('dummy2.php');
			$('.over').load('comm1.php');
		},800);
	});
</script>

</body>
</html>