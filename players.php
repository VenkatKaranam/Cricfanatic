<!DOCTYPE html>
<html>
<head>
	<title>players</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="playing11.css">
</head>
<body>
	<?php
		include 'nav.php';
		include 'database.php';
		session_start();
		$a=$_REQUEST['player'];
		$matchid=$_SESSION['playmatch'];
		$sel11=mysqli_query($database,"select * from players where matchid='$matchid' and team='$a' and ineleven='yes'");
		$sel=mysqli_query($database,"select * from players where matchid='$matchid' and team='$a' and ineleven='no'");
	?>
	<center>
	<div class="display">
		<table>
			<tr><td colspan="2"><h2 style="color: #1A5276; text-shadow: none;"><?php echo 'playing XI of <u>'.$a.'</u><br>'; ?></h2></td></tr>
		<?php
			while($fet=mysqli_fetch_assoc($sel11))
			{
				$na=$fet['playername'];
				$pic=mysqli_query($database,"select * from profilepicture where username='$na'");
				$fetpic=mysqli_fetch_assoc($pic);
				if($fetpic['picture']==NULL)
				{
					echo '<tr><td><img src="profile.png" style="width:45px;height:45px;border-radius:50%;"></td>';
				}
				else
				{
					echo '<tr><td><img src="data:iimage/jpg;base64,'.base64_encode($fetpic['picture']).'" style="width:45px;height:45px;border-radius:50%;"></td>';
				}
				echo '<td><a href="profileplay.php?playerr='.$fet['playername'].'" style="text-decoration:none;">'.$fet['playername'].'</a></td></tr>';
			}
		?>
		</table>
	</div>


	<div class="display">
		<table>
			<tr><td colspan="2"><h2 style="color: #1A5276; text-shadow: none;"><?php echo 'Bench Players for <u>'.$a.'</u><br>'; ?></h2></td></tr>
		<?php
			while($fet=mysqli_fetch_assoc($sel))
			{
				$na=$fet['playername'];
				$pic=mysqli_query($database,"select * from profilepicture where username='$na'");
				$fetpic=mysqli_fetch_assoc($pic);
				if($fetpic['picture']==NULL)
				{
					echo '<tr><td><img src="profile.png" style="width:45px;height:45px;border-radius:50%;"></td>';
				}
				else
				{
					echo '<tr><td><img src="data:image/jpg;base64,'.base64_encode($fetpic['picture']).'" style="width:45px;height:45px;border-radius:50%;"></td>';
				}
				echo '<td><a href="profileplay.php?playerr='.$fet['playername'].'" style="text-decoration:none;">'.$fet['playername'].'</a></td></tr>';
			}
		?>
		</table>
	</div>
</center>
</body>
</html>