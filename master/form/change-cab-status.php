<?php
session_start();
require_once "../../core/php/connection.php";
$empTyp = $_SESSION['EMP_TYPE'];
$type = $_GET['type'];
$drId = substr($type,1); //driver id
$sat = substr($type,0,1); //status
//track cab assign and update status 3 for went home no mor cab for today
$sqlCabAs = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `driver_id` = '$drId' AND `status` = 1");
if(mysql_error()){
 echo 'No Cab Assign fr this Driver!!';
}else{
	$roAsDr = mysql_fetch_assoc($sqlCabAs);
	$cabId = $roAsDr['cab_id'];
	$sqlUpCab = mysql_query("UPDATE `free_cabs` SET `status` = 3 WHERE `cab_id` = '$cabId'");
	if(mysql_error()){
		echo 'Not Update in free Cab Record';
	}else{
		

//end here
$sqlOp = mysql_query("UPDATE `cabs` SET `status` = $sat WHERE `cab_id` = $cabId");
$sqlUp = mysql_query("UPDATE `drivers` SET `status` = $sat WHERE `driver_id` = $drId");
if(mysql_error()){
	echo 'ERROR: Colud not update!<br/>Try again.';
}else{
	echo 'SUCCE: Driver Status Updated.';
}
	} //else close for free cab
}//else close for assign cab
?>