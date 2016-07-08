<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Refill Account</title>
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
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Refill Account
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Account</a></li>
            <li class="active">Refill Account</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            
                 <form method="POST" action="https://voguepay.com/pay/">
				 <div class="col-md-12">
					 <input type="hidden" name="v_merchant_id" value="9696-0040365" />
					 <input type="hidden" name="memo" value="Gamer - Account top-up" />
					 <input type="hidden" name="cur" value="NGN" />
				<input type="hidden" name="success_url" value="http://gamfari.com/portal/account/success.php" />
				<input type="hidden" name="fail_url" value="http://gamfari.com/portal/account/failed.php" />
				<input type="hidden" name="notify_url" value="http://gamfari.com/portal/account/notification.php" />
					 <input type="hidden" name="item_1" value="Account Top-UP" />
					 <input type='hidden' name='developer_code' value='57758c7f10206' />
					 <div class="form-group">
			<input name="price_1" class="form-control input-lg" type="text" id="price_1" placeholder="Amount (eg 5000 for N5,000)" / required>
						</div>
					 <input type="hidden" name="description_1" value="pay into your gamer account" />
	
						</div><!-- /.col -->
						<div class="col-xs-6 col-md-6 no-margin">
						<button type="submit" class="btn-block btn-lg btn btn-danger" alt="PAY"><i class="fa fa-refresh"></i>&nbsp;Refill Account</button>
						
					</div>
				</form>
				
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
