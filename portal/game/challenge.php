<?php 
if(isset($_POST['challengeUser'])){
	$id = $_POST['id'];
	$challenger = $_POST['challenger'];
	$users = $_POST['select'];
	$message = $_POST['message'];
	
	foreach ($users as $challengee)
		{
$user_email = $challengee;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= "From: Gamer Support <support.gamer.com>"."\r\n";
			// message subject
			$subject = 'New Gamer Challenge Invite';

			// Forming Message
			$text = "
			You have a new Gamer challenge from ".$challenger."\n
			".$message."\n\n
			<a href='localhost/gamer/game/details.php?g=".$id."'>Clock here </a> to Join
			";

			$result = mail($user_email, $subject, $text, $headers);
		}
		echo "</br>yh";
}
?>