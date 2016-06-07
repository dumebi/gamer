<?php
//connecting to database
include('../storescripts/connect_to_mysql.php');
session_start();
if (!isset($_SESSION["admin_manager"])) {
   echo" <script>window.location='login.php';</script>"; 
    exit();
}
?>

<?php 
if(isset($_POST['insertacc'])){
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	if($pass == $pass2){
		$password = md5($pass);
		$insertCard = mysqli_query($conn, "insert into user (username, password, reg_date, last_log_date) values ('$username','$password',now(),now())") or die(mysqli_error($conn));
			if($insertCard){
				echo" <script>alert('User has been added');</script>"; 
				echo" <script>window.location='index.php';</script>";  
			}else{
				echo" <script>alert('Error! user not added');</script>"; 
			}
	}
	else{
				echo" <script>alert('Error! Passwords are not same');</script>"; 
			}
}
?>
<?php 
// This block grabs the whole list for viewing
$user = $_SESSION['admin_manager'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InformaShop | New User</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include_once("template_header.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            New User
           
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a>Account</a></li>
            <li class="active">New user</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
			<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 
                </div><!-- /.box-header -->
                  <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- /.form-group -->
				  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="new_user.php">
						  <div class="form-group">
							<label for="username">Username</label>
							<input name="username" class="form-control" type="text" id="username" placeholder="Username" / required>
						  </div>
						  <div class="form-group">
							<label for="cardval">Password</label>
							<input name="pass" class="form-control" type="password" id="pass" placeholder="Password" / required>
						  </div>
						  <div class="form-group">
							<label for="pass2">Repeat Password</label>
							<input name="pass2" class="form-control" type="password" id="pass2" placeholder="Repeat Password" / required>
						  </div>
					<input type="submit" name="insertacc" id="insertacc" value="Insert User"  class="btn btn-sm btn-default btn-flat pull-right"> 
                </form>
                 
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once("footer.php") ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->

  </body>
</html>
