
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Challenge Users</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	  <!-- Select2 -->
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea',
  });
 
  </script>
  </head>
 
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include_once("template_header.php") ?>
	  <?php 
if(isset($_GET['e'])){
	$gameID = $_GET['e'];
	$id = decrypt($gameID);
	$users_left = '';
$sql = "select game_play.game_id, count(*), games.name from games join game_play on game_play.game_id = games.id where game_play.game_id = '".$id."'";
$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
				$games = '';
				$gamepending = '';
				$gamecurrent = '';
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					$gameID = $row[0];
					$users_ = $row[1];
					$game_name = $row[2];
					
					$users_left = 5 - $users_;
					}
				}
				
}
else{
						echo "<script>window.open('../index.php','_self')</script>";
				}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
		  <?php echo $game_name; ?>: <?php echo $users_left; ?> Players Left
          </h1>
          <ol class="breadcrumb">
            <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a >Game</a></li>
            <li class="active">Challenge Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                  <!-- /.form-group -->
	<form id="checkout_form" method="post" enctype="multipart/form-data" action="challenge.php">
						   <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Invite Gamers to your Challenge</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
              <div class="form-group">
                <label>Select Users</label>
				<input name="id" type="hidden" value="<?php echo $_GET['e']; ?>" />
				<input name="challenger" type="hidden" value="<?php echo $user ?>" />
                <select name="select[]" class="form-control select2" multiple="multiple" data-placeholder="Select Users (you can select multiple)" style="width: 100%;" /Required>
                  <?php 
						
						$sql = "select username, email from account";
						$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
									$gameCount = mysqli_affected_rows($conn);
										$option = '';
										if ($gameCount > 0) {
											while($row = mysqli_fetch_array($game_query)){ 
											$username = $row[0];
											$email = $row[1];
											
											$option .= '<option value="'.$email.'">'.$username.'</option>';
											}
										}
										else{
							$oprion = '<li><i class="fa fa-circle-o text-red"></i> <span>No user has been registered yet</span></li>';

										}
						?>
				  <?php echo $option; ?>	
				  <option value="php array for name and email">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
							<label for="message">Message Description (Optional)</label>
							<textarea name="message" class="form-control" type="text" id="mytextarea" ><p></p></textarea>
			</div>
			<footer>NB: You must have complete 5 players to start a challenge</footer>
			          <input type="submit" name="challengeUser" id="challengeUser" value="Send Challenge"  class="btn btn-sm btn-default btn-flat pull-right"> 

              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
						  
					
                </form>
                 
                </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once("../footer.php") ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
	<!-- Select2 -->
	<script src="../plugins/select2/select2.full.min.js"></script>
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->
	<script type="text/javascript">
  $('select').select2();
</script>
  </body>
</html>
