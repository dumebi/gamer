<?php  
$conn = mysqli_connect("localhost","jude","juthelif","gamer");      
?>
<?php
$sql1 = "select game_status, game_id, date_created, game_end from game_play";
	$game_query = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
						$game_end = $row["game_end"];
						$game_status = $row["game_status"];
						$id = $row["game_id"];
						$date_created = $row["date_created"];
						
							if($game_status == 'active'){
									if(new DateTime() > new DateTime("".$game_end."")){
									$expiry = mysqli_query($conn, "update game_play set game_status = 'expired' where game_id =".$id." and date_created = '".$date_created."'") or die(mysqli_error($conn));
											if($expiry){
												//echo "expired"; 
											
											}
											else{
												echo '<script>window.alert("Error 1004 has occured. pls contact support");</script>';
											}
									}
							}
						}
						 
				}				
?>