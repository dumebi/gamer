<?php 
include_once('../storescripts/connect_to_mysql.php');
session_start();
if (isset($_SESSION["list_manager"])) {
   echo" <script>window.location='index.php';</script>"; 
    exit();
}

require_once ('google-login/libraries/Google/autoload.php');

//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '775390271094-hkaos9oalaqksdkv9sa7air2kkth1ola.apps.googleusercontent.com'; 
$client_secret = '4mq9I7LqUrEOX7a0Mm3ClxDM';
$redirect_uri = 'http://owanbedeals.com/gamer/portal/login.php';

//database
$db_username = "owanbede"; //Database Username
$db_password = "Dumebi@2010"; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'owanbede_gamer'; //Database Name

//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/
  
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

if (isset($authUrl)){ 

	
} else {
	
	$user = $service->userinfo->get(); //get user info 
	
	// connect to database
	$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
	
	//check if user exist in database using COUNT
	$result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
	$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
	
	if($user_count) //if user already exist change greeting text to "Welcome Back"
    {
    }
	else //else greeting text "Thanks for registering"
	{ 
		$statement = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?,?,?,?,?)");
		$statement->bind_param('issss', $user->id,  $user->name, $user->email, $user->link, $user->picture);
		$statement->execute();
		$account = $mysqli->prepare("INSERT INTO account (username, email, amount, date_added) VALUES (?,?,?,?)");
		$account->bind_param('ssis', $user->name, $user->email, 0, 'now()');
		$account->execute();
		echo $mysqli->error;
    }
	
	$_SESSION['google_name'] = $user->name;
	$_SESSION['google_email'] = $user->email;
	$_SESSION['google_pic'] = $user->picture;
	 echo" <script>window.location='index.php';</script>";
}


?>

<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
	$pass = md5($password);
    // Connect to the MySQL database  
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$manager' AND password='$pass' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysqli_affected_rows($conn); // count the row nums
    if ($existCount == 1) { // evaluate the count
		 $_SESSION["list_manager"] = $manager;
		echo" <script>window.location='index.php';</script>"; 
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamer | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>Gamer</b> Login</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <a href="forgot.php">I forgot my password</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
		<div class="social-auth-links text-center">
          <a href="<?php echo $authUrl ?>" class="btn btn-block btn-social btn-danger btn-flat"><i class="fa fa-google"></i>Login with Google</a>
		  <a href="1353/fbconfig.php" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-facebook"></i>Login with Facebook</a>
        </div>
		<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="register.php" class="btn btn-block btn-social btn-warning btn-flat"><i class="fa fa-sign-in"></i>Register with Us</a>
        </div> 
		
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
