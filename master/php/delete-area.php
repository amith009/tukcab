<?php
require_once "../../core/php/connection.php";
$id = $_GET['type'];
$sql = mysql_query("DELETE FROM `area` WHERE `area_id` = $id");
if(mysql_error()){
echo 'Try Again!';
echo mysql_error();
}else{
	echo 'Record has been deleted.';
	/*$response['status']="success";
	$response['data']="Area has been deleted.";
	$response['action']="close";
	echo json_encode($response, JSON_FORCE_OBJECT);*/
}
?>