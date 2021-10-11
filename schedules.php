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
			$a=mysqli_query($database,"select * from matches where schedule='scheduled' order by matchid desc");
			if(mysqli_num_rows($a)==0)
			{
				echo '<h3>No matches are scheduled</h3>';
			}
			else
			{
				while($b=mysqli_fetch_assoc($a))
				{
					echo '<div>';
								echo '<font style="font-size:35px;">'.$b['matchname'].'</font><br>';
								echo '<table><tr><td>Date & Time:</td><td>'.$b['date'].'</td></tr>';
								echo '<tr><td>venue:</td><td>'.$b['venue'].'</td></tr>';		
								echo '<tr><td>creator :</td><td>'.$b['creator'].'</td></tr></table>';
						echo '</div>';
				}	
			}
		?>
	</div>
</body>
</html>