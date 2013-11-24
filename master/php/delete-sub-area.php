<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];

$sql = mysql_query("DELETE FROM `sub_area` WHERE `sub_area_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!';
}else{
	header("location: ../form/view-sub-area-fronted.php");
}
?>