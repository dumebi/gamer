<?php 
session_start();
if (!isset($_SESSION["admin_manager"])) {
   echo" <script>window.location='login.php';</script>"; 
    exit();
}
?>
<?php
//connecting to database
include('../storescripts/connect_to_mysql.php');
?>
<?php 
// This block grabs the whole list for viewing
$user = $_SESSION['admin_manager'];
$game_list = "";
$sum = '';
$account_sum = '';
$game_accounts = mysqli_query($conn,"select * from account") or die(mysqli_error($conn));
$account_sum = mysqli_affected_rows($conn);

$games = mysqli_query($conn,"select * from games") or die(mysqli_error($conn));
$gameCount = mysqli_affected_rows($conn);
if ($gameCount > 0) {
	while($row = mysqli_fetch_array($games)){ 
             $id = $row["id"];
			 $name = $row["name"];
			 $image = $row["image"];
			 $type = $row["type"];
			 $cost = $row["cost"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_created"]));
			 
			 $game_list .= "
				<tr>
					<td>
							<div class='product-img'>
							<img height='30px' width='30px' src='../game_icons/".$image."' alt='Product Image'>
						  </div>
					</td> 
					<td>$name</td>
					<td>$type</td> 
					<td>$cost</td> 
					<td>$date_added</td> 
					<td><a class='tiny button' href='product_edit.php?pid=$id'>edit</a></td>
					<td><a class='tiny button' href='all_games.php?deleteid=$id'>delete</a></td>
					
				  </tr>

			 ";
			 
			 
				
	}
} else {
	$game_list = "You have no products in our database yet";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Admin Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
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

 <?php include_once("template_header.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            InformaShop Dashboard
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
                <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gamepad 4x"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">All Games</span>
                  <span class="info-box-number"><?php echo $gameCount ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">All Users</span>
                  <span class="info-box-number"><?php echo $account_sum ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

           
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <div class="col-md-12">

              <!-- GAME LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Recently Added Games</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
				
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
						<th></th>
						<th>Game Name</th>
						<th>Game Type</th>
						<th>Cost</th>		
						<th>Date Added</th>
						<th></th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php echo $game_list; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="all_games.php" class="uppercase">View All Games</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
			  
			  <!-- USER LIST -->
			  <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">New Users</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
				
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
						<th></th>
						<th>Game Name</th>
						<th>Game Type</th>
						<th>Cost</th>		
						<th>Date Added</th>
						<th></th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php echo $game_list; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="all_games.php" class="uppercase">View All Users</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include_once("footer.php") ?>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
