<?php
//connecting to database
include_once('../../storescripts/connect_to_mysql.php');
if(isset($_GET['game'])){
	
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | User Dashboard</title>
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
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					2000
					<small>points</small>
					
				  </h3>
			  </div> 
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					#5
					<small>Rank</small>
				  </h3>
				  
			  </div> 
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					2000/<strong>4000</strong>
					<small>Experience</small>
				  </h3>
			  </div>
            </div><!-- /.col -->
            <div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					0
					<small>Day(s)</small>
				  </h3>
			  </div> 
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					5
					<small>Hr(s)</small>
				  </h3>
			  </div>
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					12
					<small>Minute(s)</small>
				  </h3>
			  </div>
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					11
					<small>Second(s) Left</small>
				  </h3>
			  </div>
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

           
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-12">
                       <div class="box">
            <div class="box-header">
              <h3 class="box-title">Condensed Full Width Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Score</th>
                  <th>Position</th>
				  <th>Price</th>
                </tr>
                <tr>
				<td>&nbsp;</td>
                  <td>Update software</td>
                  <td>
                    2000
                  </td>
                  <td><i class="material-icons">looks_one</i></td>
				  <td>N5000</td>
                </tr>
                <tr>
				<td>&nbsp;</td>
                  <td>Clean database</td>
                  <td>
                    1800
                  </td>
                  <td><i class="material-icons">looks_two</i></td>
				  <td>N4000</td>
                </tr>
                <tr>
				<td>&nbsp;</td>
                  <td>Cron job running</td>
                  <td>
                    1600
                  </td>
                  <td></td>
                </tr>
                <tr>
				<td>&nbsp;</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    1500
                  </td>
                  <td></td>
                </tr>
				<tr>
				<td>&nbsp;</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    1200
                  </td>
                 <td></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
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