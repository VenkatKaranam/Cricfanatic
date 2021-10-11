<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header('location:signin.php');
	}
	include 'database.php';
	$user=$_SESSION['username'];
	$b=addslashes(file_get_contents($_FILES['picture']['tmp_name']));
	if(strlen($_POST['picture'])==0)
	{
		header('location:upd.php');
	}
	$c=mysqli_query($database,"update profilepicture set picture='$b' where username='$user'");
	if(!$c)
	{
		$_SESSION['warning']="some error please try again";
		header('location:upd.php');
	}
	else
	{
		header('location:profile.php');
	}
?>