<?php
if (isset($_POST["getPass"])) {
		$email = $_POST["emailaddress"];
		
     $sql = "SELECT user_email, user_password FROM user WHERE user_email='$email'";
	$insert_pro = mysqli_query($conn,$sql);
	 // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysqli_affected_rows($conn); // count the row nums
    if ($existCount == 1) { // evaluate the count
	  while($row = mysqli_fetch_array($sql)){
	    $pass = $row["user_password"];
	  }
		$errmasg = "Message not sent";

 // Global Configuration start: From here you can change the email-id of receiver, cc, from email-id & subject;
$to = $email;
$from = "support@informashop.com";
$cc = "";
$subject = "Forgot Password";
// Global configuration end

$message = "your informashop password is <br/> ".$pass."";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From:'.$from . "\r\n";
$headers .= 'Cc:'.$cc . "\r\n";

if($errmasg == ""){
if(mail($to,$subject,$message,$headers)){
    	
    echo '
	<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  your password has been sent to your mail
</div>
	';   
}else{
    echo '<div class="alert alert-danger" role="alert">
  <strong>Error!</strong> Error occured while sending your mail <a href="login.php" class="alert-link">Try again</a>
</div>';
}
}else{
    echo '<div class="alert alert-danger" role="alert">
  <strong>Error!</strong>'.$errmasg.'</div>';
}
		
		 
    } else {
		echo '
		<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  Your email is not registered with us. 
		</div>
		';
		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InformaShop | forgot password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="index.php"><b>InformaShop</b> password</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name">John Doe</div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form method="post" action="forgot.php" class="lockscreen-credentials">
          <div class="input-group">
            <input name="emailaddress" type="text" class="form-control" placeholder="Enter your email address">
            <div class="input-group-btn">
              <button type="submit" name="getPass" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Enter your email address to retrieve your password
      </div>
      <div class="text-center">
        <a href="login.php">Or sign in as a different user</a>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright &copy; 2016 <b><a href="http://informashop.com" class="text-black">InformaShop</a></b><br>
        All rights reserved
      </div>
    </div><!-- /.center -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
