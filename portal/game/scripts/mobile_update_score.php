<?php 
include_once('../../../storescripts/connect_to_mysql.php'); 



 if(isset($_GET["game_id"]) && isset($_GET["username"]) && isset($_GET["date_created"]) && isset($_GET["newscore"]) && isset($_GET["hash"])){
	$name = $_GET['username']; 
	 $hash = $_GET['hash']; 
	 $game_id = $_GET["game_id"];
	$date = $_GET["date_created"];
	$date_created = strtr($date, '%20', ' ');
	$newscore = $_GET["newscore"];
	
	$secretKey="HerTa123@suMkey!?";
        
        //We md5 hash our results.
        $expected_hash = md5($game_id . $name . $secretKey); 
		echo "name ".$name."</br>";
        echo "expected hash ".$expected_hash."</br>";
		echo "hash ".$hash."</br>";
		echo "game_id ".$game_id."</br>";
		echo "date_created ".$date_created."</br>";
		echo "newscore ".$newscore."</br>";
		
			//If what we expect is what we have:
			if($expected_hash == $hash) { 
				$sql = "update game_play set game_score = ".$newscore." where username = '".$name."' and game_id = ".$game_id." and game_play.date_created = '".$date_created."'";
				$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
				if($game_query){
				echo "update went well";
				}
				else{
					echo "Error!! Bad update error";
				}
			}
			else{
			echo" Hash value is wrong!!"; 
			//echo" <script>window.location='../index.php';</script>"; 
			}
 }		
else{
		echo" 'Error: 0251"; 
		//echo" <script>window.location='../index.php';</script>"; 
	}

?>

