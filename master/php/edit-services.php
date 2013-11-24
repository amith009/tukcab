<?php
require_once "../../core/php/connection.php";
$id = $_POST['id'];
$srvName = $_POST['srvName'];
$staus = $_POST['staus'];
$sql = mysql_query("UPDATE `service_type` SET `service_type` = '$srvName', `status` = '$staus' WHERE `service_id` = '$id'");
if(mysql_error()){
	echo 'Try Agin';
}else{
	echo 'Record updated.';
}
?>