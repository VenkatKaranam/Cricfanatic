<!DOCTYPE html>
<html>
<head>
	<title>check</title>
</head>
<body>

	<div id="abc">
	</div>
	<div id="aq">hi</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		setInterval(function(){
			$('#abc').load('chk1.php');
		},1000);
	});
</script>
</body>
</html>