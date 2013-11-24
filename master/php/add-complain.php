<?php
session_start();
require_once "../../core/php/connection.php";
$bid = $_POST['bid'];

$comm = $_POST['comm'];
$eid = $_SESSION['EMP_ID'];
				$appType = "ACP";
				$appComm = $comm;
				$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
		if(mysql_error()){
			echo 'Try Again!';
		}else{
			echo 'Complaint added.';
		}
?>