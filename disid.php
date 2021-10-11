<?php
	session_start();
	include 'database.php';
	$b=$_SESSION['matchid'];

	$e=mysqli_query($database,"select * from displayid where matchid='$b'");
	$f=mysqli_fetch_assoc($e);
	if($f['adminid']==NULL)
	{	
		$a=uniqid();
		$c=mysqli_query($database,"update displayid set adminid='$a' where matchid='$b'");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>REMEMBER THIS!!!</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<style type="text/css">
		.div
		{
			width: 350px;
			display: flex;
			justify-content: space-around;
			align-items: center;
			margin-top: 150px; 
			padding: 15px;
			background-color: #1A5276;
			border-radius: 15px;
			color: white;
		}
	</style>
</head>
<body>
		<?php
			include 'nav.php';
		?>


		<center><div class="div">REMEMBER THIS CODE<br>TO UPDATE LIVE SCORES YOU NEED THIS ID<br></div>ADMIN ID: <br><font id="idi">Generating ID...</font><br>
		<a href="select.php"><button style="font-weight: bold;color: white;outline: none;border:none;background-color:#1A5276;border-radius: 5px;padding: 5px;margin-top: 15px; ">Update Scoreboard</button></a></center>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				setInterval(function(){
					$('#idi').load('id.php');	
				},500);
			});
		</script>
</body>
</html>