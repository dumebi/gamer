<?php
include_once('../../../storescripts/connect_to_mysql.php');
include_once('../../../storescripts/crypto.php');  

session_start();
$user = '';;
$image = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
}
elseif(isset($_SESSION['google_name'])){
	$user = $_SESSION['google_name'];
}
elseif(isset($_SESSION['FBID'])){      
       $user = $_SESSION['FULLNAME'];
}
else{
	echo "<script>window.open('../login.php','_self')</script>";
}

 if(isset($_SESSION["game_id"]) && isset($_SESSION["date_created"])){
	 $eid = $_SESSION["game_id"];
	$time = $_SESSION["date_created"];
	$id = decrypt($eid);
	$date_created = decrypt($time);
	$leaderboard ='';
$sql2 = "select username, game_score, @curRank := @curRank + 1 As rank from game_play , (Select @curRank := 0 ) r where id = (select id from game_play where username = '".$user."' and game_id = ".$id." and game_play.date_created = '".$date_created."') and game_id =".$id." order by game_score ASC";
	
	$game_query = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
	//LeaderBoard
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){
						$username = $row['username'];
						$game_score = $row['game_score'];
						$rank = $row['rank'];
						$price = '';
						
						$leaderboard .= ''.$username.' '.$game_score.' '.$rank.'.';
					}
					
				}
				
				$leader = substr_replace($leaderboard, "", -1);
				echo $leader;
}
else{
				echo" <script>alert('Error: 0251. ');</script>"; 
				echo" <script>window.location='../index.php';</script>"; 
			}
?>