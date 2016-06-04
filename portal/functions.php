<?php  
$conn = mysqli_connect("localhost","root","juthelif","informashop");     
	
	if(mysqli_connect_errno()){
	echo "failed to connect to MySQL:".mysqli_connect_error();	
	} 
error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
