<?php
include_once('../../storescripts/connect_to_mysql.php');
include_once('../../storescripts/crypto.php');
session_start();
$user = '';
$email = '';
$picture = '';
$image = '';
if (isset($_SESSION["list_manager"])){
$user = $_SESSION['list_manager'];
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' LIMIT 1"); 
    $existCount = mysqli_affected_rows($conn); 
    if ($existCount == 1) { 
		 while($row = mysqli_fetch_array($sql)){ 
             $email = $row["email"];
			 $image = $row["image"];
			 if($image == ''){
				  $picture = "../dist/img/profile/avatar.png";
			 }else{
			$picture = "../dist/img/profile/".$image."";
			 }
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
	echo "<script>window.open('../login.php','_self')</script>";
}

?>     
<?php 
$sql = "select game_play.game_id, game_play.game_status, games.name from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status != 'expired' order by games.name ASC";
$game_query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$gameCount = mysqli_affected_rows($conn);
				$games = '';
				$gamepending = '';
				$gamecurrent = '';
				if ($gameCount > 0) {
					while($row = mysqli_fetch_array($game_query)){ 
					$gameID = $row[0];
					$game_status = $row[1];
					$game_name = $row[2];
					
						$id = encrypt($gameID);
						if($game_status == 'pending'){
							$gamepending .= '<li><a href="join.php?e='.$id.'"><i class="fa fa-circle-o text-red"></i> <span>'.$game_name.'</span> <small class="label pull-right bg-red">Pending</small></a></li>';
						}
						else{
							$gamecurrent .= '<li><a href="index.php?game='.$id.'"><i class="fa fa-circle-o"></i> '.$game_name.'</a></li>';
						}
						
							$games = $gamecurrent ."\n".$gamepending;
					}
				}
				else{
					$games = '<li><a><i class="fa fa-exclamation-triangle"></i>No Registered game yet</a></li>';
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
                  <span class="hidden-xs"><?php echo $user ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $picture ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $user ?> - Gamer
                      <?php echo $email ?>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="../signout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
					<?php 
					if (isset($_SESSION["list_manager"])){
						echo '
						<div class="pull-left">
                      <a href="../account/account.php" class="btn btn-default btn-flat">Edit Profile</a>
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
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="../index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
			<li>
              <?php
				$amount = '';
				$sql = mysqli_query($conn, "SELECT amount FROM account WHERE username='$user' LIMIT 1"); 
					$existCount = mysqli_affected_rows($conn); 
					if ($existCount == 1) { 
						 while($row = mysqli_fetch_array($sql)){ 
							 $amount = $row[0];
						 }
					}
			?>
              <a href="../account/account.php">
                <i class="fa fa-user"></i> <span>My Account</span> <small class="label pull-right bg-green">NGN <?php echo $amount ?></small>
              </a>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-gamepad"></i>
                <span>My Games</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?php echo $games; ?>
              </ul>
            </li>
			<li>
              <a href="new.php">
                <i class="fa fa-plus-square"></i> <span>New Game</span> 
              </a>
            </li>
			<li>
              <a href="../account/refill.php">
                <i class="fa fa-refresh"></i> <span>Refill Account</span> 
              </a>
            </li>
			<li>
              <a href="../invite.php">
                <i class="fa fa-user-plus"></i> <span>Invite Friends</span> 
              </a>
            </li>
			<li>
              <a href="../signout.php">
                <i class="fa fa-sign-out"></i> <span>Log Out</span> 
              </a>
            </li>
            </ul>
        </section>
        <!-- /.sidebar -->
      </aside>