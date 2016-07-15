<?php
//connecting to database
include('../storescripts/connect_to_mysql.php');
include('../storescripts/crypto.php');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
session_start();
if (!isset($_SESSION["admin_manager"])) {
   echo" <script>window.location='login.php';</script>"; 
    exit();
}
?>

<?php 
if(isset($_POST['updateButton'])){
	$id = $_POST['id'];
	$location = '';
	$name = $_POST['name'];
	$type = $_POST['type'];
	$image = $_FILES['image']['name'];
	$cost = $_POST['cost'];
	$duration = $_POST['duration'];
	$description = $_POST['description'];
	$imageicon = $_POST['imageicon'];
	$filename = $_FILES["gameFile"]["name"];
	$uploadgamefile = $_POST['uploadgamefile'];
	
	if($image == ''){
		$image = $imageicon;
	}
	else{
		//$image = $_FILES['image']['name'];
		$image_temp1 = $_FILES['image']['tmp_name'];
		move_uploaded_file($image_temp1,"../game_icons/$image");
	}
	if($filename == ''){
		$location = $uploadgamefile;
	}
	else{
	$loc = explode(".", $filename);
	$location = $loc[0];
			
		// ----------------------- ZIP -----------------------------------
				if($_FILES["gameFile"]["name"]) {
				$filename = $_FILES["gameFile"]["name"];
				$source = $_FILES["gameFile"]["tmp_name"];
				$type = $_FILES["gameFile"]["type"];
				
				$name = explode(".", $filename);
				$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
				foreach($accepted_types as $mime_type) {
					if($mime_type == $type) {
						$okay = true;
						break;
					} 
				}
				
				$continue = strtolower($name[1]) == 'zip' ? true : false;
				if(!$continue) {
				echo "The file you are trying to upload is not a .zip file. Please try again.";
				}

				$target_path = "../games/".$filename;  // change this to the correct site path
				if(move_uploaded_file($source, $target_path)) {
					$zip = new ZipArchive();
					$x = $zip->open($target_path);
					if ($x === true) {
						$zip->extractTo("../games/"); // change this to the correct site path
						$zip->close();
				
						unlink($target_path);
					}
				echo "Your .zip file was uploaded and unpacked.";
				} else {	
				echo "There was a problem with the upload. Please try again.";
				}
			}

// --------------------------------------- ZIP END ----------------------------
	}
	
	$updateGame = mysqli_query($conn, 'Update games set name = "'.$name.'", type = "'.$type.'", image = "'.$image.'", location = "'.$location.'", cost = "'.$cost.'", duration = "'.$duration.'", description = "'.$description.'", date_created = now() where id='.$id.'')or die(mysqli_error($conn));
	if($updateGame){

		
		echo" <script>alert('Product has been Edited');</script>"; 
		echo" <script>window.location='all_games.php';</script>"; 
	}
	
	else{
		echo" <script>alert('Error! Product not Edited');</script>"; 
	}
}

?>

<?php 
// This block grabs the whole list for viewing
if(isset($_GET["pid"])){
		$game = $_GET["pid"];
		$shop_games = mysqli_query($conn,"select * from games where id=".$game."") or die(mysqli_error($conn));
		$productCount = mysqli_affected_rows($conn);
		if ($productCount > 0) {
			while($row = mysqli_fetch_array($shop_games)){ 
					 $id = $row["id"];
					 $name = $row["name"];
					 $image = $row["image"];
					 $type = $row["type"];
					 $location = $row["location"];
					 $duration = $row["duration"];
					 $description = $row["description"];
					 $cost = $row["cost"];
			}
		} 
	}
else {
	//$game_list = "You have no games listed in your store yet";
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Edit Game</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	 <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea',
  });
 
  </script>
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
            Edit Game - <?= $name ?>
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Games</a></li>
            <li class="active">Edit Games</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
			
			 <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <h1>
            Edit Game
          </h1>
                </div><!-- /.box-header -->
                  <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- /.form-group -->
				  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="edit_games.php">
                  <div class="form-group">
                    <label for="name">Game Name</label>
					<input name="id" type="hidden" value="<?= $id ?>" / required>
                    <input name="name" class="form-control" type="text" id="name" value="<?= $name ?>" / required>
                  </div>
				  <div class="form-group">
                    <label for="type">Game Type</label>
                    <input name="type" class="form-control" type="text" id="type" value="<?= $type ?>" / required>
                  </div>
				  <div class="form-group">
					<label for="image">Upload Icon </label>
					<input type="hidden" name="imageicon" value="<?= $image ?>" required/>
			        <input type="file" name="image" accept="image/*" value="<?= $image ?> />
				  </div>
				  <div class="form-group">
					<label for="gameFile">Upload Game </label>
					<input type="hidden" name="uploadgamefile" value="<?= $location ?>" required/>
			        <input type="file" name="gameFile" value="<?= $location ?>" accept="application/zip"/>
				  </div>
				  <div class="form-group">
                    <label for="duration">Game Duration (Hours)</label>
                    <input name="duration" class="form-control" type="text" id="duration" value="<?= $duration ?>" / required>
                  </div>
				  <div class="form-group">
                    <label for="cost">Game Cost</label>
                    <input name="cost" class="form-control" type="text" id="cost" value="<?= $cost ?>" / required>
                  </div>
				  <div class="form-group">
                    <label for="description">Game Description</label>
                    <textarea name="description" class="form-control" type="text" id="mytextarea" / required><?= $description ?></textarea>
                  </div>
					<input type="submit" name="updateButton" id="updateButton" value="Update Game"  class="btn btn-sm btn-default btn-flat pull-right"> 
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
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
