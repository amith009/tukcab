<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("DELETE FROM `cust_master` WHERE `cust_id` = '$id'");
$sqlAdd = mysql_query("DELETE FROM `cust_detail` WHERE `cust_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Record deleted.';
}
?>