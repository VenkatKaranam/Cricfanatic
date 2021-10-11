<!DOCTYPE html>
<html>
<head>
	<title>Match Details</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="create.css">
</head>
<body>
	<div>
	<?php 

	include 'nav.php'

	 ?>
	</div>

	<div class="container">
		<div class="title">Match details</div>
		<?php
		session_start();
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
		<form action="matlive.php" method="post" onsubmit="return validate();" name="f">
		<div class="input_field">
			<input type="text" name="venue">
			<span></span>
			<label>Venue</label>
		</div>
		<div class="input_field">
			<input type="text" name="creator">
			<span></span>
			<label>Match Creator</label>
		</div>
		<div class="input_field">
			<input type="number" name="overs">
			<span></span>
			<label>No.of overs</label>
		</div>
		<div class="input_field">
			<input type="text" name="team1" >
			<span></span>
			<label>Team 1</label>
		</div>
		<div class="input_field">
			<input type="text" name="team2" >
			<span></span>
			<label>Team 2</label>
		</div>
		<div>
			<input class="btn" type="submit" value="Continue"  name="submit">
		</div>


	</form>
	</div>


	<script type="text/javascript">
		function validate()
		{
			var a=document.f.venue.value;
			var b=document.f.creator.value;
			var c=document.f.overs.value;
			var d=document.f.team1.value;
			var e=document.f.team2.value;

			if((a.trim()).length==0 || a.length>20)
			{
				document.getElementById('warset').innerHTML="please enter venue and max 20 letters";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
			if((b.trim()).length==0 || b.length>15)
			{
				document.getElementById('warset').innerHTML="please enter creator name and max 15 letters";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
			if((c.trim()).length==0 || c>20)
			{
				document.getElementById('warset').innerHTML="please enter overs  and max 20  overs";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
			if((d.trim()).length==0 || d.length>15)
			{
				document.getElementById('warset').innerHTML="please enter team1 name and max 15 letters";
				document.getElementById('warning').style.display="inline-block";
				return false;
			}
			if((e.trim()).length==0 || e.length>15)
			{
				document.getElementById('warset').innerHTML="please enter team 2 name and max 15 letters";
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