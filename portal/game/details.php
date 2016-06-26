<?php
//connecting to database
include_once('../../storescripts/connect_to_mysql.php');
include_once('../../storescripts/crypto.php');
if(isset($_GET['g'])){
	$gameID = $_GET['g'];
	$id = decrypt($gameID);
	$game ='';
$sql = "select * from games where id=".$id."";
$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
				$game_details = '';
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					$id = $row['id'];
					$name = $row['name'];
					$image = $row['image'];
					$type = $row['type'];
					$cost = $row['cost'];
					$description = $row['description'];
					
					$game_details .= '
						  <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6 col-sm-6 col-xs-12">
				   <div class="product-img">
							<img class="img-responsive"  src="../../game_icons/'.$image.'" alt="Product Image">
						  </div>
			  </div>
			  <div class="col-md-6 col-sm-6 col-xs-12">
				   <h3>'.$name.'</h3>
				   <div class="col-md-6 col-sm-6 col-xs-6">
					<p>'.$type.'</p>
				   </div>
				   <div class="col-md-6 col-sm-6 col-xs-6">
				   <p>'.$cost.'</p>
					</div>
				   <p>
				   '.$description.'
				   </p>
				   <a class="btn btn-sm btn-default btn-flat pull-left" href="add.php?new='.$gameID.'">Add Game</a>
			  </div>
            </div>
            <!-- /.box-body -->
					';
					}
				}
}
else{
	$absolute_url = full_url( $_SERVER );
	$_SESSION["header"] = $absolute_url;
	echo "<script>window.open('../login.php','_self')</script>";
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">

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
       

        <!-- Main content -->
                <section class="content">

		  
		  <div class="row">
            <div class="col-md-12">
            <div class="box">
            
          <?php echo $game_details; ?>
          </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include_once("../footer.php") ?>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
  </body>
</html>