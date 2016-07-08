<?php 
include_once('../../../storescripts/connect_to_mysql.php');
include_once('../../../storescripts/crypto.php');  

session_start();
$user = '';
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
	$sql = "select games.name, game_play.game_score, game_play.game_status, game_play.game_end from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_id = '".$id."' and game_play.date_created = '".$date_created."'";
	$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					//Display all game details
						$username = $user;
						$game_name = $row['name'];
						$game_score = $row['game_score'];
						$game_status = $row['game_status'];
						$game_end = $row['game_end'];
						}
						
						echo "".$username." ".$id." ".$game_score." ".$game_status." ".$date_created ;
				}
}
else{
		echo" <script>alert('Error: 0251. ');</script>"; 
		echo" <script>window.location='../index.php';</script>"; 
	}
?>