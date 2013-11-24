<?php
include '../../core/php/connection.php';
 header('Refresh: 1'); 
date_default_timezone_set('Asia/Kolkata');
$curDate = date("Y-m-d");

$sqlUp = mysql_query("SELECT * FROM `cab_payment`");
if(mysql_error()){
	echo 'here';
}else{
	while($rows = mysql_fetch_assoc($sqlUp)){
		$givTime = $rows['time'];
		$giMin = substr($givTime,3,2);
		if($givTime){
		}
		
	}
}
?>
