<?php
//connecting to database
include_once('../../storescripts/connect_to_mysql.php');
include_once('../../storescripts/crypto.php');
session_start();
$user = '';
$email = '';
$picture = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
$email = '';
$picture = '';
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' LIMIT 1"); 
    $existCount = mysqli_affected_rows($conn); 
    if ($existCount == 1) { 
		 while($row = mysqli_fetch_array($sql)){ 
             $email = $row["email"];
			 $image = $row["image"];
			$picture = "dist/img/profile/".$image."";
		 }
    }
}
elseif(isset($_SESSION['google_name'])){
	$user = $_SESSION['google_name'];
	$email = $_SESSION['google_email'];
	$picture = $_SESSION['google_pic']; 

}
elseif(isset($_SESSION['FBID'])){      
       $user = $_SESSION['FULLNAME'];
	   $email = $_SESSION['EMAIL'];
	   $picture = "https://graph.facebook.com/".$_SESSION['FBID']."/picture";
}
else{
	echo "<script>window.open('login.php','_self')</script>";
}



if(isset($_GET['new'])){
	$gameID = $_GET['new'];
	$id = decrypt($gameID);
	$user_amount = '';
	$GameCost = '';
	
	//get user's account balance
	$sqlAmount = "select amount from account where username='".$user."'";
	$amount_query = mysqli_query($conn,$sqlAmount) or die(mysqli_error($conn));
	while($ammrow = mysqli_fetch_array($amount_query)){ 
		$user_amount = $ammrow["amount"];
		
			//Cost of the game
			$sqlGameCost = "select cost from games where id=".$id."";
			$GameCost_query = mysqli_query($conn,$sqlGameCost) or die(mysqli_error($conn));
			while($GameCostrow = mysqli_fetch_array($GameCost_query)){ 
			$GameCost = $GameCostrow["cost"];
			}
		}
	
	if($user_amount > $GameCost){
	$newBalance = $user_amount - $GameCost;
	$deductGame = mysqli_query($conn, "update account set amount=".$newBalance." where username='".$user."'");
	$sql = "select * from game_play where game_id=".$id."";
	$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
			//if players are less than 5
				if ($gameCount < 5) {
					
					$result = ($gameCount % 5);
						
							//if remains one more for tournament members to be complete ie 4 
							if ($result == 4) {
								
							$sql = "select max(id) from game_play where game_id=".$id."";
								$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
								$gameCount = mysqli_affected_rows($conn);
									$gid='';
									while($row = mysqli_fetch_array($game_query)){ 
									$gid = $row[0];
									}
	$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( 1, "'.$user.'", "'.$id.'", 0, "pending", now(), now())');
	//is now more than 5...activate and set end date +3
	$updateCard = mysqli_query($conn, 'update game_play set game_status = "active", game_end = now() + interval 3 day where id=1 and game_id="'.$id.'"') or die(mysqli_error($conn));
										//if User has not already been added into this challenge, it works....if not!
										if($insertCard && $updateCard){
											echo" <script>alert('Your Game has been added!')</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
										else{
											echo" <script>alert('Error! You are already in a challenge in this Game');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
									}
							elseif($result < 4){
								//echo 'Yes';
								// if still needs more ie 1,2,3 etc
								$sql = "select max(id) from game_play where game_id=".$id."";
								$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
								$gameCount = mysqli_affected_rows($conn);
									$gid='';
									while($row = mysqli_fetch_array($game_query)){ 
									$gid = $row[0];
									}
	$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( 1, "'.$user.'", "'.$id.'", 0, "pending", now(), now())') ;
								//if User has not already been added into this challenge, it works....if not!
								if($insertCard){
											echo" <script>alert('Your Game has been added');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
								else{
											echo" <script>alert('Error! You are already in a challenge in this Game');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
							}
						
				}
				//if players are already 5. increase the id, create new tournament and add this person 
				if ($gameCount == 5) {
						$gid='';
						while($row = mysqli_fetch_array($game_query)){ 
						$gid = $row['id'];
						}				
	$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( '.($gid+1).', "'.$user.'", "'.$id.'", 0, "pending", now(), now())');
				if($insertCard){
											echo" <script>alert('Your Game has been added!')</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
				}
				
				//if players are more than 5
				if ($gameCount > 5) {
					$result = ($gameCount % 5);
					// if more than 5 players but not a multiple of 5
						if ($result != 0) {
							//if remains one more for tournament members to be complete eg 9, 14 etc
							if ($result == 4) {
							$sql = "select max(id) from game_play where game_id=".$id."";
								$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
								$gameCount = mysqli_affected_rows($conn);
									$gid='';
									while($row = mysqli_fetch_array($game_query)){ 
									$gid = $row[0];
									}
							$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( '.($gid).', "'.$user.'", "'.$id.'", 0, "pending", now(), now())');
							//is now more than 5...activeate and set end date +3
						$updateCard = mysqli_query($conn, 'update game_play set game_status = "active", game_end = now() + interval 3 day where id='.($gid).' and game_id="'.$id.'"') or die(mysqli_error($conn));
										//if User has not already been added into this challenge, it works....if not!
										if($insertCard && $updateCard){
											echo" <script>alert('Your Game has been added!')</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
										else{
											echo" <script>alert('Error! You are already in a challenge in this Game');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
									}
							//------------------- End if ($result == 4) ------------------------
							
							// if still needs more ie 6,7 etc
							elseif($result < 4){
								$sql = "select max(id) from game_play where game_id=".$id."";
								$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
								$gameCount = mysqli_affected_rows($conn);
									$gid='';
									while($row = mysqli_fetch_array($game_query)){ 
									$gid = $row[0];
									}
							$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( '.($gid).', "'.$user.'", "'.$id.'", 0, "pending", now(), now())');
									if($insertCard){
											echo" <script>alert('Your Game has been added!')</script>"; 
											echo" <script>window.location='index.php';</script>"; 
										}
							}
							//------- End elseif($result < 4) ----------------------------
						}
						
					//if more than 5 and a multiple of 5. increase the id, create new tournament and add this person 	
					elseif ($result == 0){
									$sql = "select max(id) from game_play where game_id=".$id."";
									$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
									$gameCount = mysqli_affected_rows($conn);
										$gid='';
										while($row = mysqli_fetch_array($game_query)){ 
										$gid = $row[0];
										}
										$insertCard = mysqli_query($conn, 'Insert into game_play (id, username, game_id, game_score, game_status, game_end, date_created) values ( '.($gid+1).', "'.$user.'", "'.$id.'", 0, "pending", now()+ interval 3 day, now())');
									//if User has not already been added into this challenge, it works....if not!
								if($insertCard){
											echo" <script>alert('Your Game has been added');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
										else{
											echo" <script>alert('Error! You are already in a challenge in this Game');</script>"; 
											echo" <script>window.location='../index.php';</script>"; 
										}
							}
					//---------------------- End IF ---------------------------
				}
				
	}else{
		echo" <script>alert('Error!! you do not have enough money for this game. ');</script>"; 
		echo" <script>window.location='../index.php';</script>"; 
	}	
}

?>