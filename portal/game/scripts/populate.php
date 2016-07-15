<?php 
include_once('../../../storescripts/connect_to_mysql.php');
include_once('../../../storescripts/crypto.php');  


 if(isset($_GET["game_id"])){
	 $id = $_GET["game_id"];
	 $sql1 = "select games.duration, max(game_play.id) from game_play join games on game_play.game_id = games.id where game_id=".$id."";
								$game_query1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
								$gameCount1 = mysqli_affected_rows($conn);
									$gid='';
									while($row1 = mysqli_fetch_array($game_query1)){ 
									$duration = $row1[0];
									$gid = $row1[1];
									}
	if($gid == ''){
	$sql = 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( 1, "donima4u", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( 1, "Nelronaldo", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( 1, "jude", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( 1, "Tyfene", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( 1, "james", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now())';
	$insert_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			}
	else{
	$sql = 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( '.($gid +1).', "donima4u", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( '.($gid +1).', "Nelronaldo", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( '.($gid +1).', "jude", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( '.($gid +1).', "Tyfene", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now()), ( '.($gid +1).', "james", "'.$id.'", 0, "active", now() + INTERVAL '.$duration.' HOUR, now())';
	$insert_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	}
			
}
else{
		echo" Error: Did not get game id n username"; 
	}
?>