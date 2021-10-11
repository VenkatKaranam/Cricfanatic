<?php
	session_start();
	include 'database.php';

	$a=$_POST['username'];
	$b=$_POST['password'];
	$z=0;
	$y=0;
	if(strlen($a)==0 || strlen($b)==0)
	{
		header('location:signin.php');
	}

	else
	{
		$c=mysqli_query($database,"select * from profiles");
		while($d=mysqli_fetch_assoc($c))
		{
			if($d['username']==$a)
			{
				$z=1;
				if($d['password']==$b)
				{
					$y=1;
					break;
				}
			}
		}
		if($z==0)
		{
			$_SESSION['warning']='username is incorrect';
			header('location:signin.php');
		}
		if($z==1 && $y==0)
		{
			$_SESSION['warning']='password is incorrect';
			header('location:signin.php');
		}
		if($z==1 && $y==1)
		{
			session_start();
			$_SESSION['username']=$a;
			header('location:profile.php');
		}
	}
?>