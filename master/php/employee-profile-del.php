<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sql = mysql_query("DELETE FROM `employee` WHERE `emp_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Record deleted.';
}
?>