
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Edit Account</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

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
			  <?php 
		if(isset($_POST['editacc'])){
			$firstname = $_POST['firstname'];
			$lastname= $_POST['lastname'];
			$account_no= $_POST['account_no'];
			$bank_name= $_POST['bank_name'];
			$account_type= $_POST['account_type'];
			$insertfirst = mysqli_query($conn, "update account set firstname = '".$firstname."', lastname = '".$lastname."', AccountNo='".$account_no."', AccountBank='".$bank_name."', AccountType= '".$account_type."' where username='".$user."'");
					if (isset($_SESSION["list_manager"])){
						$email = $_POST['email'];
						
						$product_image1 = $_FILES['profile']['name'];
						if($product_image1 == ''){
							$product_image1 = $image;
						//	echo" <script>alert('image new: ".$product_image1."');</script>";
						}
						else{
						//echo" <script>alert('image: ".$product_image1."');</script>";
						$product_image_temp1 = $_FILES['profile']['tmp_name'];
						move_uploaded_file($product_image_temp1,"../dist/img/profile/$product_image1");
						}
						
						$insertemail = mysqli_query($conn, "update user set email = '".$email."', image = '".$product_image1."' where username='".$user."'");
						$insertemail2 = mysqli_query($conn, "update account set email = '".$email."' where username='".$user."'");
							if(isset($_POST['pass'])){
									$pass = $_POST['pass'];
									$pass2 = $_POST['pass2'];
									if($pass == $pass2){
										$password = md5($pass);
										$insertpass = mysqli_query($conn, "update user set password = '".$password."' where username='".$user."'");
											if($insertemail){
												echo" <script>alert('Account has been edited');</script>"; 
												echo" <script>window.location='account.php';</script>";  
											}else{
												echo" <script>alert('Error! Account not edited');</script>"; 
											}
									}
									else{
												echo" <script>alert('Error! Passwords are not same');</script>"; 
											}
							}
					}
		}
		?>
		<?php 
		// This block grabs the whole list for viewing
		$firstname = '';
		$lastname = '';
		$email = '';
			$sql = mysqli_query($conn, "SELECT * FROM account WHERE username='".$user."'");
				$count = mysqli_affected_rows($conn);
						if ($count > 0) {
							while($row = mysqli_fetch_array($sql)){
								$firstname = $row['firstname'];
								$lastname = $row['lastname'];
								$email = $row['email'];
								$AccountNo = $row['AccountNo'];
								$AccountBank = $row['AccountBank'];
								$AccountType = $row['AccountType'];
							}
						}
		?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            My Account
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a>Account</a></li>
            <li class="active">My Account</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
			<div class="col-xs-12">
			<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Game Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
					 <?php 
$sql1 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."'";
$game_all_query = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
					while($row1 = mysqli_fetch_array($game_all_query)){ 
					 $gameallCount = $row1[0];
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
?>
        <div class="box-body">
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
          <div class="row">
				<div class="social-auth-buttons">
					<div class="col-xs-6 col-md-6 no-margin">
						<button onClick="onClick();" class="btn-block btn-lg btn btn-success"><i class="fa fa-money"></i>&nbsp; Checkout Earnings</button>
					</div>
					<div class="col-xs-6 col-md-6 no-margin">
						<a href="refill.php" class="btn-block btn-lg btn btn-danger"><i class="fa fa-refresh"></i> &nbsp; Refill Account</a>
					</div>			
				</div>
              <!-- /.sicial Invite-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
		
		
              <div class="box">
			  
                <div class="box-header">
                 Edit Account
				 <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
                </div><!-- /.box-header -->
				
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- /.form-group -->
				  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="account.php">
						  <div class="form-group">
							<label for="username">Username</label>
							<input name="username" class="form-control" type="text" id="username" readonly="true" Value="<?php echo $user ?>" / required>
						  </div>
						  <div class="form-group">
								<div align="center" class="col-md-12">
								<label>User Details</label>
								</div>
								</br>
										<div class="col-md-6">
										  <div class="form-group">
											<label for="firstname">First Name</label>
											<input name="firstname" class="form-control" type="text" id="firstname" value="<?php echo $firstname ?>" / required>
										  </div>
										</div>
										<div class="col-md-6">
										  <div class="form-group">
											<label for="lastname">Last Name</label>
											<input name="lastname" class="form-control" type="text" id="lastname" value="<?php echo $lastname ?>" / required>
										  </div>
										</div>
						  </div>
						  <div class="form-group">
								<div align="center" class="col-md-12">
								<label>Bank Delails</label>
								</div>
								</br>
										<div class="col-md-4">
											  <div class="form-group">
												<label for="account_no">Account Number</label>
												<input name="account_no" class="form-control" type="text" value="<?php echo $AccountNo; ?>" placeholder="Account Number">
											  </div>
										</div>
									  <div class="col-md-4">
											  <div class="form-group">
												<label for="bank_name">Bank Name</label>
												<input name="bank_name" class="form-control" type="text" value="<?php echo $AccountBank; ?>" placeholder="Bank Name">
											  </div>
										</div>
										<div class="col-md-4">
											  <div class="form-group">
												<label for="account_type">Account Type</label>
												<select name="account_type" class="form-control select2" /Required>
														<option value="current" <?php if ($AccountType == "current") echo "selected='selected'";?> >Current</option>
														<option value="savings" <?php if ($AccountType == "savings") echo "selected='selected'";?>>Savings</option>
												</select>
											  </div>
										</div>
						</div> 
						  <?php 
						  if (isset($_SESSION["list_manager"])){
							echo '
							
							<div class="form-group">
							<label for="email">Email</label>
							<input name="email" class="form-control" type="text" id="email" value="'.$email.'" / required>
						  </div>
								  <div align="center" class="col-md-6">
										  <div class="form-group has-feedback">
											<div class="product-img">
												<img height="100px" width="100px" src="'.$picture.'" alt="Product Image">
											  </div>
										  </div>
									</div>
								  <div class="col-md-6">
										  <div  class="form-group has-feedback">
										  <label for="profile">Change</label>
											<input type="file" name="profile" value="'.$image.'" class="form-control">
											<span class="fa fa-camera form-control-feedback"></span>
										  </div>
									</div>
									
								<div class="form-group">
								<div align="center" class="col-md-12">
								<label>Change Password</label>
								</div>
								</br>
										<div class="col-md-6">
											  <div class="form-group">
												<label for="cardval">Password</label>
												<input name="pass" class="form-control" type="text" id="pass" placeholder="Password">
											  </div>
										</div>
									  <div class="col-md-6">
											  <div class="form-group">
												<label for="pass2">Repeat Password</label>
												<input name="pass2" class="form-control" type="text" id="pass2" placeholder="Repeat Password">
											  </div>
										</div>
								 </div> 
								 
							';
							}
							?>
						  
								  
								  
						
					<input type="submit" name="editacc" id="editacc" value="Edit Account"  class="btn btn-sm btn-default btn-flat pull-right"> 
                </form>
                 
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
              </div><!-- /.box -->

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
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->

  </body>
</html>
