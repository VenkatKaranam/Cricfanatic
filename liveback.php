<?php 
	session_start();
	include 'database.php';
	if(isset($_REQUEST['adminid']))
	{
		$b=$_REQUEST['adminid'];
		$a=mysqli_query($database,"select * from matches where matchid='$b'");
		if(mysqli_num_rows($a))
		{
			$_SESSION['playmatch']=$b;
			header('location:livescores.php');
		}
		else
		{
			$_SESSION['warning']="match not found with this matchid";
			header('location:live.php');
		}
	}

?>