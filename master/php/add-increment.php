<?php
require_once "../../core/php/connection.php";
$id = $_POST['id'];
$basic = $_POST['basic'];
$vad = $_POST['vda'];
$hra = $_POST['hra'];
$pf = $_POST['pf'];
$esi = $_POST['esi'];
$date = $_POST['date'];
$status = $_POST['status'];
if($status == 1){
	$sqlUp = mysql_query("UPDATE `employee_sallery` SET `status` = 0 WHERE `emp_id` = '$id'");
	if(mysql_error()){
		echo 'Try again';
	}else{
		$sql = mysql_query("INSERT INTO `employee_sallery` ( `emp_id`, `basic`, `hra`, `vda`, `pf`, `esi`, `date`, `status`) VALUES ('$id', '$basic', '$hra', '$vad', '$pf', '$esi', '$status', '$status')");
		if(mysql_error()){
			echo 'Try again!';
		}else{
			echo 'Success to Upgrade Sallery';
		}
	}
}else{
	echo 'Try Again';
}


?>