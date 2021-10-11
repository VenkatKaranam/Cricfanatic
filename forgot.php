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
	<title>forgot password</title>
	<link rel="stylesheet" type="text/css" href="for.css">
</head>
<body>
	<div class="container">
	<div class="title">
		FORGOT PASSWORD
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
	<div class="form">
	<form action="forg.php" method="post" onsubmit="return validate();" name="f">
		<div class="input_field">
			<input type="text" name="username"  class="input" placeholder="username">
		</div>
			<div class="custom_selection">
				<select name="question">
					<option selected="" >Security Question</option>
					<option>what is your pet name?</option>
					<option>what is your favourite food?</option>
					<option>what is your nick name?</option>
					<option>what is high school name?</option>
				</select>
			</div>
		</div>
		<div class="input_field">
			<input type="text" class="input" name="securityanswer" placeholder="Your Security Answer">
		</div>
		<div class="input_field">
			<input type="password" name="password"  class="input" placeholder="NEW PASSWORD">
		</div> 
		<div class="input_field">
			<input type="password" name="confirmpassword"  class="input" placeholder="CONFIRM PASSWORD">
		</div>
		<div class="input_field">
			<input class="btn" type="submit" value="ChangePassword"  name="submit">
		</div>
		<div class="up"  >
			Already a Member?<a  href="signin.php"> Sign in </a>
		</div>


	</form>
		
</div>
</div>

<script type="text/javascript">
	function validate(){
		var a=document.f.username.value;
		var b=document.f.question.value;
		var c=document.f.securityanswer.value;
		var d=document.f.password.value;
		var e=document.f.confirmpassword.value;

		if((a.trim()).length==0)
		{
			document.getElementById('warset').innerHTML="please enter username";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}

		if(b=="Security Question")
		{
			document.getElementById('warset').innerHTML="please select sequrity question";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((c.trim()).length==0)
		{
			document.getElementById('warset').innerHTML="please enter answer";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((d.trim()).length==0 || d.length>15)
		{
			document.getElementById('warset').innerHTML="please enter password and max 15 letters";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(e!=d)
		{
			document.getElementById('warset').innerHTML="password and confirm password must be same";
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