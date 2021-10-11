<!DOCTYPE html>
<html>
<head>
	<title>Select player and bowler</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="create.css">
</head>
<body>
	<?php
		include 'nav.php';
		session_start();
		if(isset($_SESSION['warning']))
		{	
			echo '<center>';
			echo '<div id="warning1">';
			echo '<font id="warset">'.$_SESSION['warning'].' </font>'; 
			echo '</div>';
			echo '</center>';
			unset($_SESSION['warning']);
		}
	 
	?>

	<center><form action="liveback.php" method="post" style="margin-top: 150px;">
		<div class="input_field">
			<input type="text" name="adminid"  required="">
			<span></span>
			<label> Enter Match ID</label>
		</div>
	<input type="submit" style="outline: none;border:none;background-color: #1A5276;color: white;font-weight: bold;padding: 15px;border-radius: 15px;cursor: pointer;" value="continue">
	</form><center>
</body>
</html>