<?php
	session_start();
	if(isset($_SESSION['username']))
		header('location:profile.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="sst.css">
</head>
<body>

<div class="container">
	<div class="title">
		SIGN IN
	</div>
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
	<form action="ssignin.php" method="post" onsubmit="return validate();" name="f">
		<div class="input_field">
			<input type="text" name="username"  >
			<span></span>
			<label> Username</label>
		</div>
		<div class="input_field">
			<input type="password" name="password">
			<span></span>
			<label>Password</label>
		</div>
		<div >
			<a class="forgot" href="forgot.php"> Forgot Password?</a>
		</div>
		<div>
			<input class="btn" type="submit" value="Sign in"  name="submit">
		</div>
		<div class="up"  >
			Not a Member?<a  href="signup.php"> Sign up </a>
		</div>


	</form>
		
</div>
<script type="text/javascript">
	function validate()
	{
		var a=document.f.username.value;
		var b=document.f.password.value;
		if((a.trim()).length==0)
		{
			document.getElementById('warset').innerHTML="please enter username";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((b.trim()).length==0)
		{
			document.getElementById('warset').innerHTML="please enter password";
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