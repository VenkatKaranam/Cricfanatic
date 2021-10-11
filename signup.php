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
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
	<div class="title">
		SIGN UP
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
	<form action="ssignup.php" method="post" onsubmit="return validate();" name="f">
		<div class="input_field">
			<input type="text" name="username"  class="input" placeholder="USERNAME">
		</div>
		<div class="input_field">
				<div class="custom_selection">
					<select name="branch">
						<option>branch</option>
						<option>CSE</option>
						<option>ECE</option>
						<option>MECHANICAL</option>
						<OPTION>CIVIL</OPTION>
						<OPTION>CHEMICAL</OPTION>
					</select>
				</div> 
		</div>
		<div class="input_field">
				<div class="custom_selection">
					<select name="role"  id="main"> 
						<option selected="" disabled="">role</option>
						<option value="batsmen">batsmen</option>
						<option value="bowler">bowler</option>
						<option value="allrounder">all rounder</option>
					</select>
				</div> 
		</div>
		<div class="input_field">
				<div class="custom_selection">
					<select name="type" id="sub">
						
					</select>
				</div> 
		</div>
		<div class="input_field">
			<input type="text" name="phonenumber"  class="input" placeholder="PHONE NUMBER">
		</div>
		<div class="input_field">
			<input type="password" name="password"  class="input" placeholder="PASSWORD">
		</div> 
		<div class="input_field">
			<input type="password" name="confirmpassword"  class="input" placeholder="CONFIRM PASSWORD">
		</div>
		<div class="input_field">
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
		<div >
			<input class="btn" type="submit" value="Sign Up"  name="submit">
		</div>
		<div class="up"  >
			Already a Member?<a  href="signin.php"> Sign in </a>
		</div>


	</form>
		
</div>
</div>

</body>
<script type="text/javascript">
	var types={
		batsmen:["select batting type","Right arm batsmen","left arm batsmen"],
		bowler:["select bowling type","Right arm spin","left are spin","Right arm pace ", "left arm pace"],
		allrounder:["select batting and bowling style","Right arm batsmen Right arm spin bowler","left arm batsmen left are spin bowler"]

	}

	var main_menu=document.getElementById('main');
	var sub_menu=document.getElementById('sub');

	main_menu.addEventListener('change',function()
	{

		var selected_option=types[this.value];


		while(sub_menu.options.length>0){

			sub_menu.options.remove(0);

		}

		Array.from(selected_option).forEach(function(element){

			let option =new Option(element,element);

			sub_menu.appendChild(option);
		});


	});

</script>

<script type="text/javascript">
	function validate()
	{
		var a=document.f.username.value;
		var b=document.f.branch.value;
		var c=document.f.role.value;
		var d=document.f.type.value;
		var e=document.f.phonenumber.value;
		var g=document.f.password.value;
		var h=document.f.confirmpassword.value;
		var i=document.f.question.value;
		var j=document.f.securityanswer.value;
		var k=/^\w+$/;
		if((a.trim()).length==0 || !(a.match(k)) || (a.trim()).length>15)
		{
			document.getElementById('warset').innerHTML="username must be aplhabets,numbers and underscroll only and must not be empty and less then 15";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(b=="branch")
		{
			document.getElementById('warset').innerHTML="please select branch";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(c=="role")
		{
			document.getElementById('warset').innerHTML="please select role";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(d=="select batting type" || d=="select bowling type" || d=="select batting and bowling style")
		{
			document.getElementById('warset').innerHTML="please select type";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((e.trim()).length==0 || isNaN(e) || (e.trim()).length!=10)
		{
			document.getElementById('warset').innerHTML="please check mobile number(india)";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((g.trim()).length==0 || g.length>15)
		{
			document.getElementById('warset').innerHTML="password must not be empty";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(h!=g)
		{
			document.getElementById('warset').innerHTML="password and confirm password must be same";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if(i=="Security Question")
		{
			document.getElementById('warset').innerHTML="please select security question";
			document.getElementById('warning').style.display="inline-block";
			return false;
		}
		if((j.trim()).length==0 || j.length>15)
		{
			document.getElementById('warset').innerHTML="please enter answer";
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
</html>
