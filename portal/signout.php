<?php
session_start();
	session_destroy();
	session_unset();
	echo "<script>window.open('login.php','_self')</script>";
?>