<?php
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Live Scores</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id="live">
		
	</div>


	<div class="over">
	
	</div><br>
	<button id="button"><a href="scorecard.php">ScoreCard</a></button><br><br>
	<div class="commentary">
		
	</div><br><br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$('#live').load('dummy.php');
				$('.over').load('comm.php');
				$('.commentary').load('commy.php');
			},800);
		});
	</script>
</body>
</html>

