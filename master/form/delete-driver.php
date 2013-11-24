<?php
/***************************************************************************************
File Name: make-payment.php
Work and function: monthelly payment add into database

Create date = 29 NOV 2011
Time: 03:24
Last Update:
Date: __ NOV 2011
Time: __:__
Author Name: amit kumar
*******************************************************************************************/
require_once "../../core/php/connection.php";
echo $id = $_GET['id'];
//exit(0);
$sqlDrive = mysql_query("DELETE FROM `drivers` WHERE `driver_id` = '$id'");
if(mysql_error()){
	echo 'ERROR: No record Found!!';
}else{
	header("location: ../../core/index.php");
}
?>