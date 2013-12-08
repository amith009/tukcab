<?php
	session_start();
	if(!isset($_SESSION['EMP_ID']) OR $_SESSION['EMP_ID']!='AUTHORIZED')
		echo header('location:auth/');
	else
		echo header('location:core/');
?>