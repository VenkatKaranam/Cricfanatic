<!DOCTYPE html>
<html>
<head>
	<title>Create Match</title>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="create.css">
</head>
<body>
	<div>
	<?php 

	include 'nav.php';
	session_start();
	include 'database.php';
	if(isset($_REQUEST['mat']))
		$_SESSION['asadmin']=$_REQUEST['mat'];
	
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
	</div>

	<div class="container">
		<div class="title">Enter Admin Id</div>
		<form action="valid.php" method="post">
		<div class="input_field">
			<input type="text" name="adminid"  required="">
			<span></span>
			<label> Enter Admin ID</label>
		</div>
			<input class="btn" type="submit" value="Continue"  name="submit">
		</div>
	</form>
	</div>
</body>
</html>