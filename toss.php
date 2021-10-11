<?php
	session_start();
	include 'database.php';
	$match=$_SESSION['matchid'];
	$d=mysqli_query($database,"select * from matches where matchid='$match'");
	$e=mysqli_fetch_assoc($d);
	if($e['schedule']=="scheduled")
	{
		header('location:displayid.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Match</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="toss.css">
</head>
<body>
	<div>
	<?php 
	include 'nav.php'

	 ?>
	</div>

	<div class="container">
		<div class="title">Toss </div>
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
		<form action="to.php" method="post" onsubmit="return validate();" name="f">
		<div class="input_field">
			<select name="team1" class="custom_selection">
				<option>who won toss</option>
				<option><?php echo $_SESSION['team1'];?></option>
				<option><?php echo $_SESSION['team2'];?></option>
			</select>
		</div>
		<div class="input_field">
			<select name="batbal" class="custom_selection">
				<option>choosed</option>
				<option>Bat</option>
				<option>Ball</option>
			</select>
		</div>
		<div>
			<input class="btn" type="submit" value="Continue"  name="submit">
		</div>

	</form>
	</div>
	<script type="text/javascript">
		function validate()
		{
			var a=document.f.team1.value;
			var b=document.f.batbal.value;

			if(a=='who won toss')
			{
				document.getElementById('warset').innerHTML="please enter who won the toss";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}

			if(b=='choosed')
			{
				document.getElementById('warset').innerHTML="please enter what they elected?";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
		}
		function warclose()
		{
			document.getElementById('warning').style.display="none";
			document.getElementById('warning1').style.display="none";
		}
	</script>
</body>
</html>