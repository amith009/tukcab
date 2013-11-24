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
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT cab_id,cab_code FROM `cabs` WHERE `cab_id` = $id");
if(mysql_error()){
	echo 'ERROR: Unable to read cab record!<br>Try Again';
}else{
	$rowsCab = mysql_fetch_assoc($sqlCab);
	$cabCode = $rowsCab['cab_code'];
	
	$sqlAssign = mysql_query("DELETE FROM `assigned_cabs` WHERE `cab_id` = $id");
	$sqlPayment = mysql_query("DELETE FROM `cab_payment` WHERE `cp_cab_code` = '$cabCode'");
	$sqlFree = mysql_query("DELETE FROM `free_cabs` WHERE `cab_id` = $id");
	$sqlApp = mysql_query("DELETE FROM `app_log` WHERE `al_log_code` = '$cabCode'");
	$sqlDepo = mysql_query("DELETE FROM `cab_deposite` WHERE `cd_cab_code` = '$cabCode'");
	$sqlCabRe = mysql_query("DELETE FROM `cabs` WHERE `cab_id` = $id");
	if(mysql_error()){
		echo 'ERROR: Try Again!!';
	}else{
		header("location: ../../core/index.php");
	}
}
?>