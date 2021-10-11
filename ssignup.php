<?php
	//now we include the database connectiion in our project
	include 'database.php';
	//check whether database is connected or not
	//getting user inputs from the form since we use post method in form
	$a=$_POST['username'];  //name of the username field in form
	$b=$_POST['branch'];
	$c=$_POST['type'];     //we dont want role here endhukante role select cheskuntene ga type pettagalam
	$d=$_POST['phonenumber'];
	$e=$_POST['password'];   //we dont need cnfirm password to store in database.
	$g=$_POST['question'];
	$h=$_POST['securityanswer'];
	//we need player id to be generate automatically
	$i=uniqid();        
	$check=0;
	//here we need not to insert the sn number as it is auto increment variable
	if(strlen($a)==0 || strlen($b)==0 || strlen($c)==0 || strlen($d)==0 || strlen($e)==0 || strlen($g)==0 || strlen($h)==0)
	{
		header('location : signup.php');   //if any field of form is empty then it redirects to signup page again
	}
	else
	{
			//it accepts same username for other players also but we dont need it .. for exapmle so to eliminate that
			//we first check thatif username entered by user is exixts in table or not for that
		$n=mysqli_query($database,"select * from profiles");   //selecting the profles table in database
		while($o=mysqli_fetch_assoc($n))   //here for every iteration $o contains the each line of table from first row to end of the table as we are passing '$n'
		{
			if($o['username']==$a)
			{
					session_start();
					$_SESSION['warning']="username already exists";
					$check=1;
					header('location:signup.php');
			}
		}
		if($check==0)
		{
				$m=mysqli_query($database,"insert into profiles(username,branch,role,phonenumber,password,securityquestion,securityanswer,playerid) values('$a','$b','$c','$d','$e','$g','$h','$i')"); //query to insert
				/*
					mysqli_query() accepts two parameters
					1st parameter is database connection which we store in $database
					2nd parameter is sql query whether it is select insert or delete or update
				*/
				if($m)
				{
					echo 'sign up successfull';
					header('location:signin.php');         //after successfully inserted it redirects to siginin.php page
				} 
		}       //success
	}
?>