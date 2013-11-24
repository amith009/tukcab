<?php
session_start();
	require_once "../../core/php/connection.php";
	$eid = $_SESSION['EMP_ID'];
	$pws = $_POST['pws'];
	
	$sqlEmp = mysql_query("UPDATE `employee` SET `password` = '$pws' WHERE `emp_id` = '$eid'");
	
	if(mysql_error()){
		echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
	}else{
		echo '  <div class="success"><img src="images/001_19.png" width="32" height="32"><br><b>Password has been Changed!!</b></div>';
	}
	?>