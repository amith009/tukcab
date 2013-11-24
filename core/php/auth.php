<?php
	//Start session
	session_start();
	
	//Check whether the session variable EMP_ID is present or not
	if(!isset($_SESSION['EMP_ID'])) {
		header("location: ../auth/index.html");
		exit();
	}
?>