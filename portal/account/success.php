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
	<script src="https://checkout.simplepay.ng/simplepay.js"></script>
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
            <div class="col-md-12">
                  <!-- /.form-group -->
				  <form id="checkout_form" method="post" enctype="multipart/form-data" action="verify.php">
                    <input type="hidden" name="token" id="token" value="">
                    <input type="hidden" name="transaction_id" id="transaction_id" value="">
						  <div class="form-group">
							<label for="Amount">Username</label>
							<input name="amount" class="form-control" type="text" id="amount" placeholder="Amount (eg 5000 for N5,000)" / required>
						  </div>
				<div  align="center">
					<input  type="image" id="btn-checkout" src="http://assets.simplepay.ng/buttons/pay_medium_dark.png" />	  
                </div>
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
     <script type="text/javascript">
        // Use the "token" to validate the payment
        function processPayment (token) {
				// implement your code here - we call this after a token is generated
				// example:
				var form = $('#checkout_form');
				form.append(
					$('<input />', { name: 'token', type: 'hidden', value: token })
				);
				form.submit();
			}

			// Configure SimplePay's Gateway
			var handler = SimplePay.configure({
			   token: processPayment, // callback function to be called after token is received
			   key: 'test_pu_3edd8283663645e3871feb2a9977e650', // place your api key. Demo: test_pu_*. Live: pu_*
			   image: 'http://' // optional: an url to an image of your choice
			});

       $('#btn-checkout').on('click', function (e) { // add the event to your "pay" button
			e.preventDefault();

			handler.open(SimplePay.CHECKOUT, // type of payment
			{
			   email: '<?php echo $email ?>', // optional: user's email
			   phone: '', // optional: user's phone number
			   description: '<?php echo $user ?>', // a description of your choosing
			   address: '31 Kade St, Abuja, Nigeria', // user's address
			   postal_code: '110001', // user's postal code
			   city: 'Abuja', // user's city
			   country: 'NG', // user's country
			   amount: '110000', // value of the purchase, ₦ 1100
			   currency: 'NGN' // currency of the transaction
			});
		});

    </script>
  </body>
</html>
