<?php
	require_once "../../core/php/connection.php";
	$areaName = $_POST['areaName'];
	$areaStaus = $_POST['areaStaus'];
    $stateCode = "BA";	//
	$qry = mysql_query("INSERT INTO `area` (`area_name`, `area_code`, `status`) VALUES ('$areaName', '$stateCode', '$areaStaus')");
	

	if(mysql_error()){
		echo "Database transaction failed.";
	}else{
		//$response[];
		//$response['status']='success';
		//$response['data']="Added record $areaName";
		//$response['action']="close";
		echo "<div class=\"success\"><img src=\"images/001_19.png\" width=\24\" height=\"24\" /><h2>Added record $areaName</h2></div>";
		//echo json_encode($response, JSON_FORCE_OBJECT);
	}
	mysql_close($con);
?>