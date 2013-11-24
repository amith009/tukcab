<?php
session_start();
require_once "../../core/php/connection.php";

$bid = $_POST['bid'];
$sk = $_POST['sk'];
$end = $_POST['ck'];
$date = $_POST['date'];
$time = $_POST['rtime'];
$amount = $_POST['amnt'];
$status = $_POST['sta'];

$sqlTrip = mysql_query("SELECT booking_id FROM `trip_details` WHERE `booking_id` = '$bid'");
$counTrip = mysql_num_rows($sqlTrip);
if($counTrip == 0){
	$sqlAddTrip  = mysql_query("INSERT INTO `trip_details` (`booking_id`, `opening_km`, `closing_km`, `amount`, `trip_date`, `trip_time`, `status`) VALUES ('$bid', '$sk', '$end', '$amount', '$date', '$time', '$status')");
	if($sqlAddTrip == TRUE){
		 $eid = $_SESSION['EMP_ID'];
				$appType = "ATD";
				$appComm = "Add Trip ";
				$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
		if(mysql_error()){
			echo 'Try Again!';
			echo mysql_error();
		}else{
			echo '<strong>Record added.</strong>';
		}
	}else{
		echo 'Try Again!';
		echo mysql_error();
	}
}else{
	$sqlUpTrip = mysql_query("UPDATE `trip_details` SET `opening_km` = '$sk', `closing_km` = '$end', `amount` = '$amount', `trip_date` = '$date', `trip_time` = '$time', `status` = '$status' WHERE `booking_id` = '$bid'");
	if($sqlUpTrip == TRUE){
		 $eid = $_SESSION['EMP_ID'];
				$appType = "AUD";
				$appComm = "Update Trip Record ";
				$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
		if(mysql_error()){
			echo 'Try Again!';
		}else{
			echo '<strong>Success to Update Trip Record</strong>';
		}
			}else{
				echo 'Try Again!';
			}
	
	
}mysql_close();
?>