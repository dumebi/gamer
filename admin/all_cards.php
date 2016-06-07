<?php
//connecting to database
include('../storescripts/connect_to_mysql.php');
session_start();
if (!isset($_SESSION["admin_manager"])) {
   echo" <script>window.location='login.php';</script>"; 
    exit();
}
?>
 <?php 

?>

<?php 
// Delete Item Question to Admin, and Delete Product if they choose

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="all_cards.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="all_cards.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($conn,"DELETE FROM cards WHERE id='$id_to_delete' LIMIT 1") or die (mysqli_error($conn));
	// unlink the image from server
	// Remove The Pic -------------------------------------------

	header("location: all_cards.php"); 
    exit();
}

?>
<?php 
if(isset($_POST['insertButton'])){
	$cardno = $_POST['cardno'];
	$cardval = $_POST['cardval'];
	$insertCard = mysqli_query($conn, "Insert into cards (card_no, card_value, date_added) values ('$cardno', '$cardval', now())");
	if($insertCard){
		echo" <script>alert('Card has been added');</script>"; 
		echo" <script>window.location='all_cards.php';</script>"; 
	}else{
		echo" <script>alert('Error! card not added');</script>"; 
	}
}
?>
<?php 
// This block grabs the whole list for viewing
$user = $_SESSION['admin_manager'];
$card_list = "";
$shop_products = mysqli_query($conn,"select * from cards") or die(mysqli_error($conn));
$productCount = mysqli_affected_rows($conn);
$status = '';
if ($productCount > 0) {
	while($row = mysqli_fetch_array($shop_products)){ 
             $id = $row["id"];
			 $card_no = $row["card_no"];
			 $card_value = $row["card_value"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 
			 $card_list .= " 
 
				<tr>
					<td>$card_no</td>
					<td>$card_value</td> 
					<td>$date_added</td>
					<td><a href='all_cards.php?deleteid=".$id."'>Delete</a></td>
				  </tr>

			 ";
				
	}
} else {
	//$card_list = "You have no products listed in your store yet";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InformaShop | All Cards</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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

      <?php include_once("template_header.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Cards
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Cards</a></li>
            <li class="active">All Cards</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 
                </div><!-- /.box-header -->
                <div class="box-body">
				<div class="table-responsive">
				
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Card Number</th>
						<th>Card Value</th> 
						<th>Date Added</th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php echo $card_list; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
				 </div>
              </div><!-- /.box -->

            </div><!-- /.col -->
			
			<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 
                </div><!-- /.box-header -->
                  <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- /.form-group -->
				  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="all_cards.php">
						  <div class="form-group">
							<label for="cardno">Card Number</label>
							<input name="cardno" class="form-control" type="text" id="cardno" placeholder="Card Number" / required>
						  </div>
						  <div class="form-group">
							<label for="cardval">Card Value</label>
							<input name="cardval" class="form-control" type="text" id="cardval" placeholder="Card Value" / required>
						  </div>
					<input type="submit" name="insertButton" id="insertButton" value="Insert product"  class="btn btn-sm btn-default btn-flat pull-right"> 
                </form>
                 
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once("footer.php") ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
  </body>
</html>
