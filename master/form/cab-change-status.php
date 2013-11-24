<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");

$id = $_GET['id'];
$cabId = substr($id,1);
$status = substr($id,0,1);

//Track driver id

$sqlDrv = mysql_query("SELECT driver_id FROM `assigned_cabs` WHERE `cab_id` = $cabId AND `status` = '1'");
if(mysql_error()){
    echo 'Driver Record Not Found!';
}else{
   $rowDrv = mysql_fetch_assoc($sqlDrv); 
   $driverId = $rowDrv['driver_id'];
}

$query = "UPDATE `cabs` SET `status` = '$status', `dol` = '$date' WHERE `cab_id` = '$cabId'";
$queryDrv = "UPDATE `drivers` SET `status` = '$status' WHERE `driver_id` = '$driverId'";
$result = mysql_query($query);
if($result == TRUE && $queryDrv == TRUE){
    echo 'Success To update Record!!';
}else{
    echo 'Please Try Again!!';
}
?>
