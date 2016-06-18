<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1016626851763000','dfa51428893b1ca99757c815900974db' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://localhost/gamer/portal/1353/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?locale=en_US&fields=id,name,email');
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		echo '<script>alert("'.$femail.'");</script>';
	//require 'dbconfig.php';
	checkuser($fbid, $fbfullname, $femail);
	
    /* ---- header location after session ----*/
  header("Location: ../index.php");
} else {
 $loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
 header("Location: ".$loginUrl);
}

function checkuser($fuid, $fbfullname, $femail){
	require 'dbconfig.php';
    $check = mysqli_query($connection, "select * from users where Fuid='$fuid'");
	$check = mysqli_affected_rows($connection);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO users (Fuid,Ffname,Femail) VALUES ('$fuid','$fbfullname','$femail')";
	mysqli_query($connection, $query);
		$querys = "INSERT INTO account (username, email, amount,date_added) VALUES ('$fbfullname', '$femail', 0, now())";
	mysqli_query($connection, $querys);
	} else {   // If Returned user . update the user record		
	$query = "UPDATE users SET Ffname='$fbfullname', Femail='$femail' where Fuid='$fuid'";
	mysql_query($connection, $query);
	}
}
?>