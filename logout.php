<?php

	session_start();
	require_once 'dbconnect.php';
  
  
	/*if (!isset($_SESSION['user'])) {
		header("Location: index.php");
	} else 

	if(isset($_SESSION['user'])!="") {
		header("Location: main.php");
	}
	
	if (isset($_GET['logout'])) {
		*/
	
		unset($_SESSION['useremail']);
		unset($_SESSION['userpassword']);
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		//header("Location: index.php");
		
		//echo "You are successfully logged out";
		header("Refresh: 1; URL = index.php");
	?>
		<script type='text/javascript'>confirm('You are logged out successfully');</script>
		<?php
		exit;
		
	?>