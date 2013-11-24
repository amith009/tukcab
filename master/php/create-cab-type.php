<?php
	require_once "../../core/php/connection.php";
	$cabType = $_POST['cabName'];
	$status = $_POST['cabStatus'];
	$status = $status='Active'?1:0;
	$cabTypeCode = substr($cabType,0,2)."01";
	$qry = "INSERT INTO cab_types (cab_type_code,cab_type_name,status) values ('".$cabTypeCode."','".$cabType."',".$status.")";
	mysql_query($qry);
	if(mysql_error()){
		echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
	}else{
		echo ' <div class="success">
  <img src="images/001_19.png" width="32" height="32"><br><b>Record added!!</b>
  </div>';
		//header("location:../form/redirected.php");
	}
	mysql_close($con);
?>