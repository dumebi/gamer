<?php 
include_once('../../../storescripts/connect_to_mysql.php');


 if(isset($_GET["game_id"]) && isset($_GET["username"]) && isset($_GET["hash"])){
	 $id = $_GET["game_id"];
	 $user = $_GET["username"];
	 $hash = $_GET["hash"];
	 
	 $secretKey="HerTa123@suMkey!?";
     $expected_hash = md5($id . $user . $secretKey);
	 
	 
	 if($expected_hash == $hash) { 
	$sql = "select games.name, game_play.game_score, game_play.game_status, game_play.date_created, game_play.game_end from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_id = '".$id."' and game_play.game_status='active'";
	$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){
						$game_score = $row['game_score'];
						$date_created = $row['date_created'];
						$game_end = $row['game_end'];
						
						$now = new DateTime();
						$endtime = new DateTime("".$game_end."");
						$hourdiff = round(($endtime - $now)/3600, 1);
						
						
						$userDet .= "".$game_score." ".$date_created." ".$hourdiff.".";
						}
						
				$userDetails = substr_replace($userDet, "", -1);
				echo $userDetails;
				}
				else{
					echo" No active games for ".$user.""; 
				}
				
		}
else{
			echo" Hash value is wrong!!"; 
			//echo" <script>window.location='../index.php';</script>"; 
			}
 }
else{
		echo" Error: Did not get game id n username"; 
	}
?>