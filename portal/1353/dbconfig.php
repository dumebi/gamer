<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'jude');    // DB username
define('DB_PASSWORD', 'juthelif');    // DB password
define('DB_DATABASE', 'gamer');      // DB name
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die( "Unable to connect");
//$database = mysqli_select_db($connection,) or die( "Unable to select database");
?>