<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sql = mysql_query("DELETE FROM `cab_types` WHERE `cab_type_id` = '$id'");
if(mysql_error()){
	echo 'ERROR: Cannot delete!!';
}else{
	//header("location: ../master/form/view-cab-type.php");
	echo 'SUCCE: Cab Type deleted.';
}
?>