<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Game Dashboard </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.css">

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
 $end_time = '';
//connecting to database
if(isset($_GET['game'])){
	$eid = $_GET['game'];
	$id = decrypt($eid);
	$newformat = '';
	$game_end = '';
	$games = '';
	$cost = '';
	$sql = "select games.name, games.type, games.image, games.location, games.cost, games.description, game_play.game_score, game_play.game_status, game_play.game_end from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_id = '".$id."'";
	$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					
					//Display all game details
						$name = $row['name'];
						$type = $row['type'];
						$image = $row['image'];
						$location = $row['location'];
						$cost = $row['cost'];
						$description = $row[5];
						$game_score = $row[6];
						$game_status = $row[7];
						$game_end = $row[8];
						}
						
						$end_time = date("n/j/Y g:i:s A", strtotime($game_end));
						//echo '<script>window.alert("'.$end_time.'");</script>';
					
				}
}
?>
<?php
if(isset($_GET['game'])){
	$eid = $_GET['game'];
	$id = decrypt($eid);
	$leaderboard ='';
$sql = "select username, game_score, @curRank := @curRank + 1 As rank from game_play , (Select @curRank := 0 ) r where id = (select id from game_play where username = '".$user."' and game_id = '".$id."') order by game_score ";
	$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	//LeaderBoard
			$gameCount = mysqli_affected_rows($conn);
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){
						$username = $row['username'];
						$game_score = $row['game_score'];
						$rank = $row['rank'];
						$price = '';
						if ($rank == '1'){
							$price = 0.5 * ($cost * 5);
						}
						elseif ($rank == '2'){
							$price = 0.4 * ($cost * 5);
						}
						else{
							$price = '';
						}
						
						$leaderboard .= '
						<tr>
						  <td>'.$username.'</td>
						  <td>
							'.$game_score.'
						  </td>
						  <td><i class="material-icons">'.$rank.'</i></td>
						  <td> NGN '.$price.'</td>
						</tr>
						';
					}
				}
}
?>
<?php
if(isset($_GET['game'])){
	$eid = $_GET['game'];
	$id = decrypt($eid);
	$rank = '';
$ssql = "select username, game_score, @curRank := @curRank + 1 As rank from game_play , (Select @curRank := 0 ) r where id = (select id from game_play where username = '".$user."' and game_id = '".$id."') and username = '".$user."' order by game_score ";
	$games_query = mysqli_query($conn,$ssql) or die(mysqli_error($conn));
	// Rank and game score of a particular user
			$gamesCount = mysqli_affected_rows($conn);
				if ($gamesCount > 0) {
					while($rows = mysqli_fetch_array($games_query)){
						$rank = $rows['rank'];
						$user_score = $rows['game_score'];
					}
				}
}
?>
<script>

var end = new Date('<?php echo $end_time ?>');
//var end = new Date('08/12/2016 02:00 PM');

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;
var timer;

function showRemaining() {
    var now = new Date();
    var distance = end - now;
    if (distance < 0) {
		
        clearInterval(timer);
        document.getElementById('countdown').innerHTML = '<h3> Game Challenge Has Expired</h3>';

        return;
    }
    var days = Math.floor(distance / _day);
    var hours = Math.floor((distance % _day) / _hour);
    var minutes = Math.floor((distance % _hour) / _minute);
    var seconds = Math.floor((distance % _minute) / _second);
	
    document.getElementById('day-number').innerHTML = days;
    document.getElementById('hour-number').innerHTML = hours;
    document.getElementById('minute-number').innerHTML = minutes;
    document.getElementById('second-number').innerHTML = seconds;
}
timer = setInterval(showRemaining, 1000);
</script>
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
					<?php echo $user_score ?>
					<small>points</small>
					
				  </h3>
			  </div> 
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					#<?php echo $rank ?>
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
            <div id="countdown" class="col-md-6 col-sm-6 col-xs-12">
			  <div  class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					<span id="day-number">11</span>
					<small>Day(s)</small>
				  </h3>
			  </div> 
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					<span id="hour-number">11</span>
					<small>Hr(s)</small>
				  </h3>
			  </div>
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					<span id="minute-number">11</span>
					<small>Minute(s)</small>
				  </h3>
			  </div>
			  <div class="col-md-3 col-sm-3 col-xs-3">
				   <h3>
					<span id="second-number">11</span>
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
							<img class="img-responsive"  src='../../game_icons/<?php echo $image ?>' alt='Product Image'>
						  </div>
			  </div>
			  <div class="col-md-6 col-sm-6 col-xs-12">
				   <h3><?php echo $name ?></h3>
				   <div class="col-md-6 col-sm-6 col-xs-6">
					<p><i class="fa fa-gamepad"></i> <?php echo $type ?></p>
				   </div>
				   <div class="col-md-6 col-sm-6 col-xs-6">
				   <p><i class="fa fa-money"></i> NGN <?php echo $cost ?></p>
					</div>
				   <?php echo $description ?>
				   <a href="../../games/<?php echo $location ?>" class="btn btn-sm btn-default btn-flat pull-left">Play Game</a>
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
				  <th>Win</th>
                </tr>
				<?php echo $leaderboard; ?>
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
	<script src="jquery.min.js"></script>
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