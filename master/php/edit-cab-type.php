<?php
require_once "../../core/php/connection.php";
$id = $_POST['id'];
$cabName = $_POST['cabName'];
$cabStatus = $_POST['cabStatus'];
//echo "UPDATE `cab_types` SET `cab_type_name` = '$cabName', `status` = '$cabStatus' WHERE `cab_type_id` = '$id'";
//exit(0);
$sql = mysql_query("UPDATE `cab_types` SET `cab_type_name` = '$cabName', `status` = '$cabStatus' WHERE `cab_type_id` = '$id'");
if(mysql_error()){
	header('location: ../form/edit-cab-type.php?id='.$id);
}else{
	header('location: ../form/view-cab-type.php');
}
?>