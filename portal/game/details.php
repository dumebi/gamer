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
					<small>Sec(s)</small>
				  </h3>
			  </div>
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

           
          </div><!-- /.row -->

		  
		  <div class="row">
            <div class="col-md-12">
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6 col-sm-6 col-xs-12">
				   <div class='product-img'>
							<img class="img-responsive"  src='../../game_icons/hightin.jpg' alt='Product Image'>
						  </div>
			  </div>
			  <div class="col-md-6 col-sm-6 col-xs-12">
				   <h3>Game Name</h3>
				   <div class="col-md-6 col-sm-6 col-xs-6">
					<p>Type</p>
				   </div>
				   <div class="col-md-6 col-sm-6 col-xs-6">
				   <p>Cost</p>
					</div>
				   <p>
 This file is not intended to serve as a complete backup of your site. 


 To import this information into a WordPress site follow these steps: 

  1. Log in to that site as an administrator.  -->

 2. Go to Tools: Import in the WordPress admin panel. 

  3. Install the "WordPress" importer from the list.  
  4. Activate & Run Importer.  

 5. Upload this file using the form provided on that page. 


 6. You will first be asked to map the authors in this export file to users 
    on the site. For each author, you may choose to map to an 

     existing user on the site or to create a new user.  

 7. WordPress will then import each of the posts, pages, comments, categories, etc. 

     contained in this file into your site. 
				   </p>
				   <a class="btn btn-sm btn-default btn-flat pull-left">Play Game</a>
			  </div>
            </div>
            <!-- /.box-body -->
          </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
		  
          <div class="row">
            <div class="col-md-12">
                       <div class="box">
            <div class="box-header">
              <i class="fa fa-bar-chart"></i> <h3 class="box-title">LeaderBoard</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-condensed">
                <tr>
                  <th>Name</th>
                  <th>Score</th>
                  <th>Position</th>
				  <th>Price</th>
                </tr>
                <tr>
                  <td>Update software</td>
                  <td>
                    2000
                  </td>
                  <td><i class="material-icons">looks_one</i></td>
				  <td>N5000</td>
                </tr>
                <tr>
                  <td>Clean database</td>
                  <td>
                    1800
                  </td>
                  <td><i class="material-icons">looks_two</i></td>
				  <td>N4000</td>
                </tr>
                <tr>
                  <td>Cron job running</td>
                  <td>
                    1600
                  </td>
                  <td></td>
				  <td>N5000</td>
                </tr>
                <tr>
                  <td>Fix and squish bugs</td>
                  <td>
                    1500
                  </td>
                  <td></td>
				  <td>N5000</td>
                </tr>
				<tr>
                  <td>Fix and squish bugs</td>
                  <td>
                    1200
                  </td>
                 <td></td>
				 <td>N5000</td>
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