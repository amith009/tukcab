<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo 'jk';
require_once "../../core/php/connection.php";
$str = $_GET['str'];
echo $status = substr($str,0,1);
echo $drId = substr($str,2);

$sqlUp = "UPDATE `drivers` SET `driver_type` = '$status' WHERE `driver_id` = $drId";
$result = mysql_query($sqlUp);
if(mysql_error()){
    echo 'Record Not Updated!!';
}else{
    header("location: ../form/add-new-driver-edit-cab.php.php?owner=".$drId."&dt=4&cabid=");
}
?>
