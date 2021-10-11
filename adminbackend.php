<?php
	session_start();
	include 'database.php';
	$matchid=$_SESSION['matchid'];
	if(isset($_POST['striker']) && isset($_POST['bowler']) && isset($_POST['run']))
	{
		$bat=$_POST['striker'];
		$ball=$_POST['bowler'];
		$_SESSION['bowler']=$ball;
		$run=$_POST['run'];
		$z=mysqli_query($database,"select * from players where playername='$ball' and matchid='$matchid'");
		$zf=mysqli_fetch_assoc($z);
		$team=$zf['team'];
		$a=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
		if(mysqli_num_rows($a)==0)
		{
			mysqli_query($database,"insert into bowler(matchid,bowler,striker,team) values('$matchid','$ball','$bat','$team')");
		}
		mysqli_query($database,"update bowler set ball=ball+1 where bowler='$ball' and matchid='$matchid'");

		mysqli_query($database,"update players set runs=runs+$run where matchid='$matchid' and playername='$bat'");
		mysqli_query($database,"update players set balls=balls+1 where matchid='$matchid' and playername='$bat'");
		mysqli_query($database,"update players set runconceed=runconceed+$run where matchid='$matchid' and playername='$ball'");

		if($run==4)
		{
			mysqli_query($database,"update players set fours=fours+1 where matchid='$matchid' and playername='$bat'");
		}
		if($run==6)
		{
			mysqli_query($database,"update players set sixes=sixes+1 where matchid='$matchid' and playername='$bat'");	
		}


		$fea=mysqli_query($database,"select sum(overr) as `over`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team'");
		$ffea=mysqli_fetch_assoc($fea);
		$chudu=$ffea['over'];
		$balu=$ffea['balls'];
		mysqli_query($database,"insert into commentary(matchid,overr,ball,striker,bowler,run) values('$matchid','$chudu','$balu','$bat','$ball','$run')");

		$q=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
		$b=mysqli_fetch_assoc($q);
		if($b['ball']==6)
		{
			mysqli_query($database,"update bowler set overr=overr+1 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update bowler set ball=0 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set overs=overs+1 where matchid='$matchid' and playername='$ball'");
		}	


	}


	if(isset($_POST['striker']) && isset($_POST['bowler']) && isset($_POST['extrar']) && isset($_POST['exrun']))
	{
		$bat=$_POST['striker'];
		$ball=$_POST['bowler'];
		$_SESSION['bowler']=$ball;
		$extra=$_POST['extrar'];
		$run=$_POST['exrun'];

		$getteam=mysqli_query($database,"select * from players where playername='$ball' and matchid='$matchid'");
		$fetteam=mysqli_fetch_assoc($getteam);
		$teamu=$fetteam['team'];

		$z=mysqli_query($database,"select * from players where playername='$ball' and matchid='$matchid'");
		$zf=mysqli_fetch_assoc($z);
		$team=$zf['team'];

		$big=mysqli_query($database,"select * from matches where matchid='$matchid'");
		$fbig=mysqli_fetch_assoc($big);

		if($extra=="wd")
		{
			$totrun=$run+1;
			if($teamu==$fbig['team1'])
				mysqli_query($database,"update extras set team1=team1+$totrun where matchid='$matchid'");
			else
				mysqli_query($database,"update extras set team2=team2+$totrun where matchid='$matchid'");
			mysqli_query($database,"update players set wides=wides+1 where playername='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set runconceed=runconceed+$totrun where playername='$ball' and matchid='$matchid'");
		}
		if($extra=="nb")
		{
			$totrun=$run+1;
			if($teamu==$fbig['team1'])
				mysqli_query($database,"update extras set team1=team1+1 where matchid='$matchid'");
			else
				mysqli_query($database,"update extras set team2=team2+1 where matchid='$matchid'");
			mysqli_query($database,"update players set noballs=noballs+1 where playername='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set runs=runs+$run where playername='$bat' and matchid='$matchid'");
			mysqli_query($database,"update players set balls=balls+1 where playername='$bat' and matchid='$matchid'");

			if($run==4)
			{
				mysqli_query($database,"update players set fours=fours+1 where matchid='$matchid' and playername='$bat'");
			}
			if($run==6)
			{
				mysqli_query($database,"update players set sixes=sixes+1 where matchid='$matchid' and playername='$bat'");	
			}
			mysqli_query($database,"update players set runconceed=runconceed+$totrun where playername='$ball' and matchid='$matchid'");


		}
		if($extra=="lb")
		{
			if($teamu==$fbig['team1'])
				mysqli_query($database,"update extras set team1=team1+$run where matchid='$matchid'");
			else
				mysqli_query($database,"update extras set team2=team2+$run where matchid='$matchid'");

			$a=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
			if(mysqli_num_rows($a)==0)
			{
				mysqli_query($database,"insert into bowler(matchid,bowler,striker,team) values('$matchid','$ball','$bat','$team')");
			}

			mysqli_query($database,"update players set balls=balls+1 where playername='$bat' and matchid='$matchid'");
			mysqli_query($database,"update bowler set ball=ball+1 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set legbys=legbys+1 where playername='$ball' and matchid='$matchid'");
		}
		if($extra=="b")
		{
			if($teamu==$fbig['team1'])
				mysqli_query($database,"update extras set team1=team1+$run where matchid='$matchid'");
			else
				mysqli_query($database,"update extras set team2=team2+$run where matchid='$matchid'");

			$a=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
			if(mysqli_num_rows($a)==0)
			{
				mysqli_query($database,"insert into bowler(matchid,bowler,striker,team) values('$matchid','$ball','$bat','$team')");
			}

			mysqli_query($database,"update players set balls=balls+1 where playername='$bat' and matchid='$matchid'");
			mysqli_query($database,"update bowler set ball=ball+1 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set bys=bys+1 where playername='$ball' and matchid='$matchid'");
		}

		$fea=mysqli_query($database,"select sum(overr) as `over`,sum(ball) as `balls` from bowler where matchid='$matchid' and team='$team'");
		$ffea=mysqli_fetch_assoc($fea);
		$chudu=$ffea['over'];
		$balu=$ffea['balls'];
		$runu=$extra.$run;
		mysqli_query($database,"insert into commentary(matchid,overr,ball,striker,bowler,run) values('$matchid','$chudu','$balu','$bat','$ball','$runu')");

		$q=mysqli_query($database,"select * from bowler where bowler='$ball' and matchid='$matchid'");
		$b=mysqli_fetch_assoc($q);
		if($b['ball']==6)
		{
			mysqli_query($database,"update bowler set overr=overr+1 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update bowler set ball=0 where bowler='$ball' and matchid='$matchid'");
			mysqli_query($database,"update players set overs=overs+1 where matchid='$matchid' and playername='$ball'");
		}	

	}
	

?>