<?php
include_once('../storescripts/connect_to_mysql.php');
include_once('../storescripts/crypto.php');
if (isset($_GET["g"])) {
	$text = $_GET["g"];
	$user = decrypt($text);
$update_account = "update user set status = 'active' where username = '".$user."'"; 
	// insert into the database
   $update_pro = mysqli_query($conn, $update_account);
   if($update_pro){
   echo "<script>alert('Your account has been activated. Proceed to Login')</script>";
	echo "<script>window.open('login.php','_self')</script>";
		}
	else{
		echo "<script>alert('Sorry! Account could not activate. Contact Support')</script>";;
		}
}
?>