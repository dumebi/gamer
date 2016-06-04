<?php
include_once('../storescripts/connect_to_mysql.php');
if (isset($_POST["regButton"])) {
	$username =  $_POST["username"];
	$userpass =  $_POST["userpass"];
	$userpass2 = $_POST["userpass2"];
	if ($userpass == $userpass2){
	$sql = "SELECT * FROM user WHERE username='$username'";
	$insert_pro = mysqli_query($conn,$sql);
    $existCount = mysqli_affected_rows($conn); // count the row nums
    if ($existCount >= 1) { // evaluate the count
	   echo "<script>alert('Sorry! username is taken')</script>"; 
    } else {
		$password = md5($userpass);
		$usermail =  $_POST["usermail"];
		$password = md5($userpass);
		
				
		$product_image1 = $_FILES['profile']['name'];
		$product_image_temp1 = $_FILES['profile']['tmp_name'];
		move_uploaded_file($product_image_temp1,"dist/img/profile/$product_image1");
		
    // Connect to the MySQL database  
    $insert_user = "insert into user (username, password, email, image, reg_date) values('$username', '$password', '$usermail', '$product_image1', now())"; 
	// insert into the database
   $insert_pro = mysqli_query($conn, $insert_user);
	
	if($insert_pro){

		
		
	echo "<script>alert('Thank you for Registering. Proceed to Login')</script>";
	echo "<script>window.open('login.php','_self')</script>";
		
		}
	else{
		echo "<script>alert('Sorry! Passwords do not match')</script>";;
		}
		
	}
		

	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Registration Page</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="index.php"><b>Gamer</b>Shop</a>
      </div>
      <div class="register-box-body">
        <p class="login-box-msg">Fill the form to register</p>
        <form action="register.php" enctype="multipart/form-data" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
			<input type="file" name="profile" class="form-control">
            <span class="fa fa-camera form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="usermail" class="form-control" placeholder="Email">
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="userpass" class="form-control" placeholder="Password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type="password" name="userpass2" class="form-control" placeholder="Retype password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="regButton" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>
		<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="login.php" class="btn btn-block btn-social btn-warning btn-flat"><i class="fa fa-hand-o-left"></i>Back to Login</a>
        </div> 
       
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
