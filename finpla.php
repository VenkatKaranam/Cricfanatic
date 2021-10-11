<?php
	session_start();
	include 'database.php';
	$match=$_SESSION['matchid'];
	$che=0;

	if(isset($_POST['name']))
	{
		$player = '%'.$_REQUEST['name'].'%';
		$a=mysqli_query($database,"select * from profiles where username like '$player'");
		$y=mysqli_num_rows($a);
		if($y==0)
		{
			echo 'no players found';
		}
		else
		{
				
				while($b=mysqli_fetch_assoc($a))
				{
					$expl=$b['username'];
					$ifex=mysqli_query($database,"select * from players where playername='$expl' and matchid='$match'");
					$exro=mysqli_num_rows($ifex);
					if($exro==0){
						$che=1;
					echo '<div class="block">
							<div>
							<img src="profile.png" width="38" height="38">

							</div>
							<label>'.$b['username'].'</label>
							<div class="addbtn">
							<a href="ad.php?name='.$b['username'].'"><button class="button">+</button></a>
							</div>
						</div>';}

				}
				if($che==0)
				{
					
						
							echo '<h3>Currently players you are looking for is Unavailable</h3>';
						
				}
		}
	}
?>

