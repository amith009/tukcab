<?php
require_once "../../core/php/connection.php";
$id = $_POST['id'];
$name = $_POST['areaName'];
$areaStaus = $_POST['areaStaus'];

$sql = mysql_query("UPDATE `area` SET `area_name` = '$name', `status` = '$areaStaus' WHERE `area_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Record has been updated.';
	//$response['status']='success';
	//$response['data']="Area name updated to: $name";
	//$response['action']="close";
	//echo json_encode($response, JSON_FORCE_OBJECT);
}
?>