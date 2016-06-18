<?php
require 'dbconfig.php';
/*
function checkuser($fuid,$ffname,$femail){
    $check = mysql_query("select * from users where Fuid='$fuid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO users (Fuid,Ffname,Femail) VALUES ('$fuid','$ffname','$femail')";
	mysql_query($query);
		$querys = "INSERT INTO account (username,amount,date_added) VALUES ('$ffname',0, now())";
	mysql_query($querys);
	} else {   // If Returned user . update the user record		
	$query = "UPDATE users SET Ffname='$ffname', Femail='$femail' where Fuid='$fuid'";
	mysql_query($query);
	}
}
*/
?>
