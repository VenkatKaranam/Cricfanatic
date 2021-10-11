<?php
	session_start();
	include 'database.php';

	if(isset($_POST['striker']) && isset($_POST['outta']) && isset($_POST['bowler']))
	{
		$striker=$_POST['striker'];
		$reason=$_POST['bowler'];
		$matchid=$_SESSION['matchid'];
		$re=$_POST['outta'];

		$fid=mysqli_query($database,"select * from overs where matchid='$matchid'");
		$ffid=mysqli_fetch_assoc($fid);
		$ball=$ffid['bowler'];
		$z=mysqli_query($database,"select * from players where playername='$ball' and matchid='$matchid'");
		$zf=mysqli_fetch_assoc($z);
		$team=$zf['team'];



		$a=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
		if(mysqli_num_rows($a)==0)
		{
			mysqli_query($database,"insert into bowler(matchid,bowler,striker,team) values('$matchid','$ball','$striker','$team')");
			$_SESSION['bowler']=$ball;
		}

		$bowler=$_SESSION['bowler'];

		mysqli_query($database,"update players set balls=balls+1 where matchid='$matchid' and playername='$striker'");

		mysqli_query($database,"insert into catchout values('$matchid','$striker','$bowler','$re','$reason')");
		mysqli_query($database,"update bowler set ball=ball+1 where bowler='$bowler' and matchid='$matchid'");
		mysqli_query($database,"update players set outornot='out' where playername='$striker' and matchid='$matchid'");
		if($_POST['outta']=="runout")
		{
			mysqli_query($database,"update players set runouts=runouts+1 where playername='$reason' and matchid='$matchid'");
		}
		else
		{
			mysqli_query($database,"update players set wickets=wickets+1 where playername='$bowler' and matchid='$matchid'");	
		}


		$fea=mysqli_query($database,"select sum(overr) as `over`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team'");
		$ffea=mysqli_fetch_assoc($fea);
		$chudu=$ffea['over'];
		$balu=$ffea['balls'];
		mysqli_query($database,"insert into commentary(matchid,overr,ball,striker,bowler,run) values('$matchid','$chudu','$balu','$striker','$ball','w')");

		$q=mysqli_query($database,"select * from bowler where bowler='$bowler' and matchid='$matchid'");
		$b=mysqli_fetch_assoc($q);
		if($b['ball']==6)
		{
			mysqli_query($database,"update bowler set overr=overr+1 where bowler='$bowler' and matchid='$matchid'");
			mysqli_query($database,"update bowler set ball=0 where bowler='$bowler' and matchid='$matchid'");
			mysqli_query($database,"update players set overs=overs+1 where matchid='$matchid' and playername='$bowler'");
		}

		$eking=mysqli_query($database,"select * from overs where matchid='$matchid'");
		$feking=mysqli_fetch_assoc($eking);
		if($feking['striker']==$striker)
			mysqli_query($database,"update overs set striker='haha' where matchid='$matchid'");
		else
			mysqli_query($database,"update overs set nonstriker='haha' where matchid='$matchid'");

		header('location:selafout.php');
	}

?>