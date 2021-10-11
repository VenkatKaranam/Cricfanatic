<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		function oko(){
			var a=document.f.a.value;
			var b=document.f.c.value;
			if(1){
			$.ajax({
				type:'post',
				data:{
					name : a,
					vali : b
				},
				url:'chk1.php',
				cache:false,
				success:function(html){
					$("#abc").html(html);
				}
			});
		}
			return false;
		}
	</script>
</head>
<body>
	<div id="abc">
		
	</div>
	<form name="f" onsubmit="return oko();">
		<input type="text" name="a">
		<input type="text" name="c">
		<input type="submit" value="submit">
	</form>
</body>
</html>