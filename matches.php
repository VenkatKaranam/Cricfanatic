<!DOCTYPE html>
<html>
<head>
	<title>Scheduled Matches</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="sched.css">
</head>
<body>
	<?php
		include 'nav.php';
	?>

	<div class="schedules">
		<?php
			session_start();
			include 'database.php';
			$a=mysqli_query($database,"select * from matches where schedule='live' or schedule='ended' order by matchid desc");
			if(mysqli_num_rows($a)==0)
			{
				echo '<h3>No matches are scheduled</h3>';
			}
			else
			{
				while($b=mysqli_fetch_assoc($a))
				{
					$matchid=$b['matchid'];
					$cr=mysqli_query($database,"select * from overs where matchid='$matchid'");
					$crf=mysqli_fetch_assoc($cr);
					
					echo '<div>';
								echo '<font style="font-size:35px;">'.$b['matchname'].'</font><br>';
								echo '<table><tr><td>Status :</td><td>'.$b['schedule'].'</td></tr>';
								echo '<tr><td>venue:</td><td>'.$b['venue'].'</td></tr>';		
								echo '<tr><td>creator :</td><td>'.$b['creator'].'</td></tr>';
								if($crf['striker']!=NULL)
								{
								echo '<tr><td><a href="lively.php?match='.$b['matchid'].'"><button>scoreboard</button></a></td>';
								}
								if($b['schedule']!='ended')
									echo '<td><a href="create.php?mat='.$b['matchid'].'"><button>Admin</button></a></td>';
						echo '</tr></table></div>';
					
				}	
			}
		?>
	</div>
</body>
</html>