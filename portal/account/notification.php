<?php
include_once('../../storescripts/connect_to_mysql.php');
include_once('../../storescripts/crypto.php');
session_start();
$user = '';
$email = '';
$picture = '';
$image = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' LIMIT 1"); 
    $existCount = mysqli_affected_rows($conn); 
    if ($existCount == 1) { 
		 while($row = mysqli_fetch_array($sql)){ 
             $email = $row["email"];
			 $image = $row["image"];
			 if($image == ''){
			$picture = "dist/img/profile/avatar.png";
			 }else{
			$picture = "dist/img/profile/".$image."";
			 }
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
	echo "<script>window.open('../login.php','_self')</script>";
}

?> 
<?php
if(isset($_POST['transaction_id'])){
	$transaction_id = $_POST['transaction_id'];
$url = "https://voguepay.com/?v_transaction_id=".$transaction_id."&type=json";
	$response = file_get_contents($url);
	$response = json_decode($response);
	
	$tran_id = $response->{'transaction_id'};
	$email = $response->{'email'};
	$amount = $response->{'total'};
	$status = $response->{'status'};
	$date = $response->{'date'};
	
	
	if($status == 'Approved'){
		$credit_user = mysqli_query($conn, "update account set amount = ".$amount." where username= ".$user."");
		if($credit_user){
			echo" <script>alert('status: ".$status."');</script>";
		}
	}
	
}
else{
	echo "<script>window.open('../index.php','_self')</script>";
}

?>