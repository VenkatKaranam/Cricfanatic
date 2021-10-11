<!DOCTYPE html>
<html>
<head>
	<title>
		profile update
	</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.picu
		{
			margin-top: 250px;
			width: 350px;
			background-color: #5499C7;
			padding: 15px;
			border-radius: 15px;
		}
		form
		{
			font-family: sans-serif;
			color: white;
		}
		input[type='submit']
		{
			background-color: #1A5276;
			padding: 10px;
			outline: none;
			border:none;
			color: white;
			border-radius: 5px;
			cursor: pointer;
		}
		#warning
		{
			
			background-color: red;
			color: white;
			padding: 5px;
			margin: 2px;
			border-radius: 5px;
			display: none;
		}
		#warning1
		{
			
			background-color: red;
			color: white;
			padding: 5px;
			margin: 2px;
			border-radius: 5px;
		}
		button
		{
			border:none;
			outline: none;
			background:none;
			cursor: pointer;
			padding: 5px;
			width: 25px;
			color: white;
			background-color: #1A5276;
		}
	</style>
</head>
<body>
	<?php
		include 'nav.php';
	?>

	<center><div class="picu">
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
		<form action="updpic.php" method="post" enctype="multipart/form-data" onsubmit="return validate();" name="f">
			<input type="file" name="picture"><br><br>
			<input type="submit" value="continue">
		</form>
	</div>
</div>

<script type="text/javascript">
	function validate()
	{
		var a=document.f.picture.value;
		if(a.length==0)
		{
			document.getElementById('warset').innerHTML="please select picture";
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