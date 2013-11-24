<?php
require_once "../../core/php/connection.php";

$driverId = $_POST['driverId'];
$cabid = $_POST['cabid'];
$date = date('Y-m-d');
$time = date('H:i:s');
$sqlTrac = mysql_query("SELECT ac_id FROM `assigned_cabs` where `cab_id`= $cabid and status=1");
$countCab = mysql_num_rows($sqlTrac);

if($countCab <= 1){
    $pas = 0;
    while($rowsCab = mysql_fetch_assoc($sqlTrac)){
        $asCabId = $rowsCab['ac_id'];        
        $sqlAss = mysql_query("UPDATE `assigned_cabs` SET `status` = 0 where `ac_id` = $asCabId");   
        
        if(!mysql_error()){
            echo mysql_error();
        }else{
            $pas = $pas+1;
        }
    }
    if($pas <= 0){
        $sqlIns = mysql_query("INSERT INTO `assigned_cabs` (`cab_id`, `driver_id`, `assign_date`, `assign_time`, `status`) VALUES ( '$cabid', '$driverId', '$date', '$time', '1')");
    
        if(mysql_error()){
            echo mysql_error();
            
        }else{
            header("location: ../form/view-cab-details.php?id=".$cabid);
        }
    }
    
}
?>
