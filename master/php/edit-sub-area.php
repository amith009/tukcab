<?php
	require_once "../../core/php/connection.php";
	$id = $_POST['id'];
	$parentArea = $_POST['parentArea'];
	$subArea = $_POST['subArea'];
	
	$sql = mysql_query("UPDATE `sub_area` SET `area_id` = $parentArea, `sub_area_name` = '$subArea' WHERE `sub_area_id` = $id");
	if(mysql_error()){
		echo 'ERROR: Record not update!!';
	}else{
		header("location: ../form/view-sub-area-fronted.php");
	}
?>