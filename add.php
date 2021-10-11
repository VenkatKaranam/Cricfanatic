<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="add.css">
	<title>Add players</title>
	<script type="text/javascript">
		function findd()
		{
			var a=document.f.player.value;
			if((a.trim()).length==0)
			{
				document.getElementById('warset').innerHTML="please enter player name";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
			else
			{
				datu="name="+a;
				$.ajax({
					type : 'post',
					data : datu,
					url : 'finpla.php',
					cache : false,
					success:function (html){
						$('#s').html(html);
					}
				});
				return false;
			}
		}
		function warclose()
		{
			document.getElementById('warning').style.display="none";
			document.getElementById('warning1').style.display="none";
		}
	</script>
</head>
<body>
	<?php 
	session_start();
	include 'nav.php'

	 ?>

	<center><div class="container">
		<div class="h2">ADD PLAYERS</div>
		<?php
		if(isset($_SESSION['warning']))
		{
			echo '<center>';
			echo '<div id="warning1">';
			echo '<font id="warset">'.$_SESSION['warning'].' </font>'; 
			echo "<button onclick='warclose()'><b>x</b></button>";
		echo '</div>';
		echo '</center>';
		unset($_SESSION['warning']);
		}
	?>
	<center>
	<div id="warning">
		<font id="warset">Sorry!</font> 
		<button onclick="warclose();"><b>x</b></button>
	</div>
	</center>
		<div>
			<form onsubmit="return findd();" name="f">
				<div>
				<table><tr><td><input type="text" class="input" id="kaka" name="player" placeholder="ENTER PLAYER NAME"></td>
				</div>
				<div>
					<td><div class="search"></div></td></tr></table>
				</div>
			</form>
		</div>
		<div class="list">
			<h3></h3>
		</div>

		<div id="foro1"></div>

		<div id="dis"></div>

		<div id="s" style=""></div>

		<div>
			
			<?php
				include 'database.php';
				$matchid=$_SESSION['matchid'];
				$team1=$_SESSION['team1'];
				$team2=$_SESSION['team2'];
				$mat=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='yes' and team='$team1'");
				if(mysqli_num_rows($mat)!=0){
					echo '<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:25px;color:#1A5276;">playing eleven for team '.$team1.'</td></tr>';
					echo '<table><tr><td style="color:#1A5276;">playername</td><td style="color:#1A5276;">team</td><td style="color:#1A5276;">status</td><td style="color:#1A5276;">edit</td></tr>';
				while($que=mysqli_fetch_assoc($mat))
				{
					$pl=($que['ineleven']=='yes')?'playing':'bench';
					echo '<tr><td>'.$que['playername'].'</td><td>'.$que['team'].'</td><td>'.$pl.'</td><td>';
					echo '<a href="del.php?name='.$que['playername'].'"><button class="button" style="font-size:10px;background-color:red;border-radius:15px;font-weight:bold;height:25px;">delete</button></a>';
					echo '</tr>' ;
				}}
				$mat1=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='no' and team='$team1'");
				if(mysqli_num_rows($mat1)!=0){
					echo '<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:25px;color:#1A5276;">Substitutes for team '.$team1.'</td></tr>';
					echo '<table><tr><td style="color:#1A5276;">playername</td><td style="color:#1A5276;">team</td><td style="color:#1A5276;">status</td><td style="color:#1A5276;">edit</td></tr>';
				while($que1=mysqli_fetch_assoc($mat1))
				{
					$pl1=($que1['ineleven']=='yes')?'playing':'bench';
					echo '<tr><td>'.$que1['playername'].'</td><td>'.$que1['team'].'</td><td>'.$pl1.'</td><td>';
					echo '<a href="del.php?name='.$que1['playername'].'"><button class="button" style="font-size:10px;background-color:red;border-radius:15px;font-weight:bold;height:25px;">delete</button></a>';
					echo '</tr>' ;
				}}
				$mat2=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='yes' and team='$team2'");
				if(mysqli_num_rows($mat2)!=0){
					echo '<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:25px;color:#1A5276;">playing eleven for team '.$team2.'</td></tr>';
					echo '<table><tr><td style="color:#1A5276;">playername</td><td style="color:#1A5276;">team</td><td style="color:#1A5276;">status</td><td style="color:#1A5276;">edit</td></tr>';
				while($que2=mysqli_fetch_assoc($mat2))
				{
					$pl2=($que2['ineleven']=='yes')?'playing':'bench';
					echo '<tr><td>'.$que2['playername'].'</td><td>'.$que2['team'].'</td><td>'.$pl2.'</td><td>';
					echo '<a href="del.php?name='.$que2['playername'].'"><button class="button" style="font-size:10px;background-color:red;border-radius:15px;font-weight:bold;height:25px;">delete</button></a>';
					echo '</tr>' ;
				}}
				$mat3=mysqli_query($database,"select * from players where matchid='$matchid' and ineleven='no' and team='$team2'");
				if(mysqli_num_rows($mat3)!=0){
					echo '<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:25px;color:#1A5276;">Substitutes for team '.$team2.'</td></tr>';
					echo '<table><tr><td style="color:#1A5276;">playername</td><td style="color:#1A5276;">team</td><td style="color:#1A5276;">status</td><td style="color:#1A5276;">edit</td></tr>';
				while($que3=mysqli_fetch_assoc($mat3))
				{
					$pl3=($que3['ineleven']=='yes')?'playing':'bench';
					echo '<tr><td>'.$que3['playername'].'</td><td>'.$que3['team'].'</td><td>'.$pl3.'</td><td>';
					echo '<a href="del.php?name='.$que3['playername'].'"><button class="button" style="font-size:10px;background-color:red;border-radius:15px;font-weight:bold;height:25px;">delete</button></a>';
					echo '</tr>' ;
				}}
			?>
		</table>
		</div>



	</div></center>

	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$('.h2').load('play.php');
				$('.search').load('foro.php');
			},500);
		});	
		$(document).ready(function(){
			setInterval(function(){
				$('#foro1').load('foro1.php');
			},2000);
		});	

	$(document).ready(function(){
			setInterval(function(){
				$('.list').load('finpla.php');
			},2000);
		});						
	</script>
				
</body>
</html>