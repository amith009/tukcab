<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];

$sql = mysql_query("DELETE FROM `service_type` WHERE `service_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!';
}else{
	//echo 'Record has been deleted.';
	header('location:../form/view-services.php');
}
?>