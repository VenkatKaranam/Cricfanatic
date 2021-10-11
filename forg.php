<?php
	session_start();
	include 'database.php';
	$a=$_POST['username'];
	$b=$_POST['question'];
	$c=$_POST['securityanswer'];
	$d=$_POST['password'];

	$k=0;
	$l=0;
	$m=0;

	if(strlen($a)==0 || strlen($b)==0 || strlen($c)==0 || strlen($d)==0)
	{
		header('location : forgot.php');
	}
	else
	{
		$e=mysqli_query($database,"select * from profiles");
		while($g=mysqli_fetch_assoc($e))
		{
			if($g['username']==$a)
			{
				$k=1;
				if($g['securityquestion']==$b)
				{
					$l=1;
					if($g['securityanswer']==$c)
					{
						$m=1;
						$h=mysqli_query($database,"update profiles set password='$d' where username='$a'");
						if($h)
						{
							header('location:signin.php');
						}
					}
				}
			}
		}
		if($k==0)
		{
			$_SESSION['warning']='username doesnt exits';
			header('location:forgot.php');
		}
		elseif ($l==0) {
			$_SESSION['warning']='incorrect security question';
			header('location:forgot.php');
		}
		elseif ($m==0) {
			$_SESSION['warning']='security answer is wrong';
			header('location:forgot.php');
		}
	}

?>