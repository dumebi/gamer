<?php
include('../../storescripts/connect_to_mysql.php');
session_start();
$user = '';
$email = '';
$picture = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
$email = '';
$picture = '';
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' LIMIT 1"); 
    $existCount = mysqli_affected_rows($conn); 
    if ($existCount == 1) { 
		 while($row = mysqli_fetch_array($sql)){ 
             $email = $row["email"];
			 $image = $row["image"];
			$picture = "dist/img/profile/".$image."";
		 }
    }
}
elseif(isset($_SESSION['google_name'])){
	$user = $_SESSION['google_name'];
	$email = $_SESSION['google_email'];
	$picture = $_SESSION['google_pic']; 

}
elseif(isset($_SESSION['FBID'])){      
       $user = $_SESSION['FULLNAME'];
	   $email = $_SESSION['EMAIL'];
	   $picture = "https://graph.facebook.com/".$_SESSION['FBID']."/picture";
}
else{
	echo "<script>window.open('login.php','_self')</script>";
}

?>     
	 <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>G</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Gamer</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
            
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $picture ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $email ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $picture ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $user ?> - Gamer
                      
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
					<?php 
					if (isset($_SESSION["list_manager"])){
						echo '
						<div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat">Edit Profile</a>
                    </div>
						';
					}
					else{}
					
					?>
					
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $picture ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $user ?></p>
			  </br></br>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-gamepad"></i>
                <span>My Games</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/deals/all_deals.php"><i class="fa fa-circle-o"></i> New Game</a></li>
				<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
              </ul>
            </li>
			<li>
              <a href="account/stats.php">
                <i class="material-icons">gamepad</i> <span>New Game</span> 
              </a>
            </li>
			<li>
              <a href="account/stats.php">
                <i class="fa fa-bar-chart"></i> <span>View My Stats</span> 
              </a>
            </li>
			<li>
              <a href="account/refill.php">
                <i class="fa fa-refresh"></i> <span>Refill Account</span> 
              </a>
            </li>
			<li>
              <a href="signout.php">
                <i class="fa fa-sign-out"></i> <span>Log Out</span> 
              </a>
            </li>
            </ul>
        </section>
        <!-- /.sidebar -->
      </aside>