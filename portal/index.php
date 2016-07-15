<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | User Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
 <?php 
$sql = "select game_play.game_id, game_play.game_status, games.name, game_play.game_score, games.type, game_play.date_created from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' order by games.name ASC limit 10";
$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
				$latestgames = '';
				$gamepending = '';
				$gamecurrent = '';
				$gameexpired = '';
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					$gameID = $row[0];
					$game_status = $row[1];
					$game_name = $row[2];
					$game_score = $row[3];
					$type = $row[4];
					$date_created = $row[5];
						$id = encrypt($gameID);
						$game_time = encrypt($date_created);//game end time
						if($game_status == 'pending'){
							$gamepending .= '
							<tr>
								<td>'.$game_name.'</td>
								<td>'.$type.'</td>
								<td><span class="label label-warning">Pending</span></td>
								<td>
								  
								</td>
						   </tr>
							';
						}
						elseif($game_status == 'active'){
							$gamecurrent .= '
							<tr>
								<td><a href="game/?game='.$id.'&time='.$game_time.'">'.$game_name.'</a></td>
								<td>'.$type.'</td>
								<td><span class="label label-info">Ongoing</span></td>
								<td>
								  <i class="fa fa-circle-o"></i>&nbsp;'.$game_score.'
								</td>
						   </tr>
							';
						}
						elseif($game_status == 'expired'){
							$gameexpired .= '
							<tr>
								<td><a href="game/?game='.$id.'&time='.$game_time.'">'.$game_name.'</a></td>
								<td>'.$type.'</td>
								<td><span class="label label-success">Completed</span></td>
								<td>
								   <i class="fa fa-circle-o"></i>&nbsp;'.$game_score.'
								</td>
						   </tr>
							';
						}                                                                                                  
						
							$latestgames = $gamepending ."\n".$gamecurrent."\n".$gameexpired;
					}
				}
				else{
					$latestgames = '<li><a><i class="fa fa-exclamation-triangle"></i>No Registered game yet</a></li>';
				}
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Dashboard
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
                <section class="content">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Games</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Score</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php echo $latestgames; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="game/new.php" class="btn btn-sm btn-info btn-flat pull-right">Create New Game</a>
              
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->  
			 <?php 
$sql1 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."'";
$game_all_query = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
					while($row1 = mysqli_fetch_array($game_all_query)){ 
					 $gameallCount = $row1[0];
					}
$sql2 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.result = 'won'";
$game_won_query = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
					while($row2 = mysqli_fetch_array($game_won_query)){ 
					 $gamewonCount = $row2[0];
					}
$sql3 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.result = 'lost'";
$game_lost_query = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
					while($row3 = mysqli_fetch_array($game_lost_query)){ 
					 $gamelostCount = $row3[0];
					}
$sql4 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status = 'pending'";
$game_pending_query = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
					while($row4 = mysqli_fetch_array($game_pending_query)){ 
					 $gamependingCount = $row4[0];
					}
$sql5 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status = 'active'";
$game_ongoing_query = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
					while($row5 = mysqli_fetch_array($game_ongoing_query)){ 
					 $gameongoingCount = $row5[0];
					}
$sql6 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status = 'expired'";
$game_expired_query = mysqli_query($conn,$sql6) or die(mysqli_error($conn));
					while($row6 = mysqli_fetch_array($game_expired_query)){ 
					 $gameexpiredCount = $row6[0];
					}
$sql7 = "select amount from account where username = '".$user."'";
$user_amount_query = mysqli_query($conn,$sql7) or die(mysqli_error($conn));
					while($row7 = mysqli_fetch_array($user_amount_query)){ 
					 $user_amount = $row7[0];
					}
$wongames = ($gamewonCount / $gameallCount) * 100;
$lostgames = ($gamelostCount / $gameallCount) * 100;
$pendinggames = ($gamependingCount / $gameallCount) * 100;
$ongoinggames = ($gameongoingCount / $gameallCount) * 100;			
?>		  
		  <!-- /.row -->
		<div class="box">
             <div class="row">
                <div class="col-sm-4 col-xs-4">
                  <div class="description-block border-right">
                    <h5 class="description-header">NGN <?php echo $user_amount; ?></h5>
                    <span class="description-text"><strong>ACCOUNT</strong></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-xs-4">
                  <div class="description-block border-right">
                    <h5 class="description-header"><?php echo $gameallCount; ?></h5>
                    <span class="description-text"><strong>TOTAL GAMES</strong></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-xs-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $gameexpiredCount; ?></h5>
                    <span class="description-text"><strong>GAME COMPLETIONS</strong></span>
                  </div>
                  <!-- /.description-block -->
                </div>
			  </div>
              <!-- /.row -->
            </div>
       <div class="row">
            <div class="col-md-8">
                       <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Top Gamers</h3>

                  <div class="box-tools pull-right">
                    
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
				<?php 
				// Get the top gamers and the number of games won
$game1 = "select distinct username, count('result') from game_play where result = 'won' order by count('result') DESC limit 8";
$topgamers = mysqli_query($conn,$game1) or die(mysqli_error($conn));
$gamer_image = '';
$username = '';
$wonGames = '';
$topgamers_list = '';
$login_type = '';	
			$gamerCount = mysqli_affected_rows($conn);
				if ($gamerCount > 0) {
					while($gamerrow = mysqli_fetch_array($topgamers)){ 
					$username = $gamerrow[0];
					$wonGames = $gamerrow[1];
					
					
					// Now for their images
					//First check their login type - to know what database their image is in
					
										$game2 = mysqli_query($conn,"select login_type from account where username='".$username."'");
										while($gamerrow2 = mysqli_fetch_array($game2)){ 
											$login_type = $gamerrow2[0];
							
													if($login_type == 'google'){
															$game3 = mysqli_query($conn,"select google_picture_link from google_users where google_name='".$username."'");
															while($gamerrow2 = mysqli_fetch_array($game3)){ 
															$gamer_image = $gamerrow2[0];
														}
													}
													if($login_type == 'facebook'){
															$game4 = mysqli_query($conn,"select Fuid from users where Ffname='".$username."'");
															while($gamerrow3 = mysqli_fetch_array($game4)){ 
															$facebookID = $gamerrow2[0];
															$gamer_image = "https://graph.facebook.com/".$facebookID."/picture";
														}
													}
													if($login_type == 'normal'){
															$game5 = mysqli_query($conn,"SELECT image FROM user WHERE username='".$username."'");
															while($gamerrow4 = mysqli_fetch_array($game5)){ 
															$userimage = $gamerrow4["image"];
															
															 if($userimage == ''){
															$gamer_image = "dist/img/profile/avatar.png";
															 }else{
															$gamer_image = "dist/img/profile/".$userimage."";
															 }
														}
													}
										}
										
										if ($username == $user) {
												$username = 'You';
											}
										if ($username != '') {
									$topgamers_list .= '
											<li>
											  <img src="'.$gamer_image.'" width="100px" height="100px" alt="User Image">
											  <a class="users-list-name">'.$username.'</a>
											  <span class="users-list-date">'.$wonGames.' Game(s) Won</span>
											</li>
									';
										}
										else{
												$topgamers_list .= '<h3>&nbsp;<i class="fa fa-exclamation-triangle"></i> No Top Gamer Yet</h3>';
											}
												
			}
		}
				else{
					$topgamers_list .= '<h3>&nbsp;<i class="fa fa-exclamation-triangle"></i> No Top Gamer Yet</h3>';
				}
?>
                  <ul class="users-list clearfix">
                    <?php echo $topgamers_list; ?>
                    
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-footer -->
              </div>
		  </div>
		  <div class="col-md-4">
				
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">My Games</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            
            <!-- /.box-body -->
            <div class="box-footer no-padding">

              <ul class="nav nav-pills nav-stacked">
                <li><a>Games Won
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> <?php echo $wongames; ?>%</span></a></li>
                <li><a>Games Lost <span class="pull-right text-green"><i class="fa fa-angle-up"></i> <?php echo $lostgames; ?>%</span></a>
                </li>
                <li><a>Pending Games
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> <?php echo $pendinggames; ?>%</span></a></li>
                <li><a>Ongoing Games
                  <span class="pull-right text-blue"><i class="fa fa-angle-left"></i> <?php echo $ongoinggames; ?>%</span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
          <!-- /.box -->
		  </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		<?php include_once("footer.php") ?>
      </div><!-- /.content-wrapper -->

      
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
	<script src="dist/js/pages/dashboard2.js"></script>
	<?php // include_once("dist/js/pages/dashboard.php") ?>
	
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

  </body>
</html>