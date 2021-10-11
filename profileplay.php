<?php
	session_start();
	$user=$_REQUEST['playerr'];
	include 'database.php';
	$x=mysqli_query($database,"select * from profiles where username='$user'");
	$q=mysqli_query($database,"select * from profilepicture where username='$user'");
	$pic=mysqli_fetch_assoc($q);
	$y=mysqli_fetch_assoc($x);


	$stat=mysqli_query($database,"select sum(runs) as `r`,sum(balls) as `b`,sum(fours) as `f`,sum(sixes) as `s`,sum(overs) as `o`,sum(runconceed) as `rc`,sum(wickets) as `w`,sum(maidens) as `m`,count(*) as `count`,sum(catches) as `cat`,sum(runouts) as `run`,max(runs) as `maxi` from players where playername='$user'");
	$statfet=mysqli_fetch_assoc($stat);

	$wkts=mysqli_query($database,"select wickets,runconceed from players where playername='$user' and wickets in (select max(wickets) from players where playername='$user')");
	$wktfet=mysqli_fetch_assoc($wkts);
?>

<!DOCTYPE html>
<html>
<head>
	<title>PROFILE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
		<?php
			include 'nav.php';
		?>

		<center><div class="profile">
			<div class="profilepic">
				<?php
					if($pic['picture']==NULL)
					{
						echo '<img src="profile.png" class="propic">';
					}
					else
					{
						echo '<img src="data:image/jpg;base64,'.base64_encode($pic['picture']).'" class="propic">';
					}
				?>
			</div>
			<h3><?php echo $pic['username'];?></h3>

			<table>
				<tr>
					<td class="lef">Role</td>
					<td class="rig"><?php echo $y['role'];?></td>
				</tr>
				<tr>
					<td class="lef">Branch</td>
					<td class="rig"><?php echo $y['branch'];?></td>
				</tr>
				<tr>
					<td class="lef">Phone Number</td>
					<td class="rig"><?php echo $y['phonenumber'];?></td>
				</tr>
				<tr>
					<td colspan="2"><h3>Career Stats</h3></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>

				<tr>
					<td colspan="2" style="text-align: center;" class="lef">Batting Career</td>
				</tr>
			</table>
			<table>
				<tr>
					<td class="lef">M</td>
					<td class="lef">R</td>
					<td class="lef">B</td>
					<td class="lef">4's</td>
					<td class="lef">6's</td>
				</tr>
				<tr>
					<td><?php echo $statfet['count'];?></td>
					<td><?php echo $statfet['r'];?></td>
					<td><?php echo $statfet['b'];?></td>
					<td><?php echo $statfet['f'];?></td>
					<td><?php echo $statfet['s'];?></td>
				</tr>
				<tr>
					<td colspan="5"><hr></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align: center;" class="lef">Bowling Career</td>
				</tr>
				<tr>
					<td class="lef">M</td>
					<td class="lef">O</td>
					<td class="lef">R</td>
					<td class="lef">W</td>
					<td class="lef">Md</td>
				</tr>
				<tr>
					<td><?php echo $statfet['count'];?></td>
					<td><?php echo $statfet['o'];?></td>
					<td><?php echo $statfet['rc'];?></td>
					<td><?php echo $statfet['w'];?></td>
					<td><?php echo $statfet['m'];?></td>
				</tr>
			</table>
			<hr>
			<table>
				<tr>
					<td colspan="2" style="text-align: center;" class="lef">Best Figures</td>
				</tr>
				<tr>
					<td class="lef">HighScore </td>
					<td class="rig"><?php echo $statfet['maxi'];?></td>
				</tr>
				<tr>
					<td class="lef">Best Bowling</td>
					<td class="rig"><?php echo $wktfet['runconceed'].' ('.$wktfet['wickets'].')';?></td>
				</tr>
				<tr>
					<td class="lef">Catches</td>
					<td class="rig"><?php echo $statfet['cat'];?></td>
				</tr>
				<tr>
					<td class="lef">Runouts</td>
					<td class="rig"><?php echo $statfet['run'];?></td>
				</tr>
			</table>


		</div></center>
<br>


</body>
</html>