<?php
	require_once "../../core/php/connection.php";
	$mainArea = $_POST['parentArea'];
	$subArea = $_POST['subArea'];
	$res = mysql_query("INSERT INTO sub_area (area_id,sub_area_name,status) values ($mainArea,'$subArea',1)");
	if($res==FALSE)
		echo 'ERROR: Can\'t add sub area!';
	else{
		header("location: ../form/view-sub-area-fronted.php");
	}
?>