<?php
include_once('../../../storescripts/connect_to_mysql.php');

 if(isset($_GET["game_id"]) && isset($_GET["username"]) && isset($_GET["hash"])){
	 $id = $_GET["game_id"];
	 $user = $_GET["username"];
	 $hash = $_GET["hash"];
	 
	 $secretKey="HerTa123@suMkey!?";
     $expected_hash = md5($id . $user . $secretKey);
	 
	 
	 if($expected_hash == $hash) { 
	$leaderboard ='';
$sql2 = "select username, game_score, @curRank := @curRank + 1 As rank from game_play , (Select @curRank := 0 ) r where id = (select id from game_play where username = '".$user."' and game_id = ".$id." and game_play.game_status = 'active') and game_id =".$id." order by game_score DESC";
	
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
			echo" Hash value is wrong!!"; 
			//echo" <script>window.location='../index.php';</script>"; 
			}
}
else{
				echo" Error: 0251. "; 
				//echo" <script>window.location='../index.php';</script>"; 
			}
?>