<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: cab rate adding 
##########
Create date = 3 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
$curdate = date("Y-m-d");
require_once "../../core/php/connection.php";


$track = $_POST['track'];
$values = $_POST['values'];
$crtid = $_POST['crtid'];
$cabType = $_POST['cbType'];
$status = $_POST['status'];
$total = sizeof($track);

/* OUT CITY RATE*/
   $k=0;
    for($i=0;$i<sizeof($track);$i++) {
     
      $result = mysql_query("INSERT INTO `cab_rate_record` (`crd_id`, `cab_type_id`, `crr_value`, `status`) VALUES ('$crtid[$i]', '$cabType', '$values[$i]', '$status')");
      if (!$result) {
        echo mysql_error();
        break;
      }
}
if($total == $k){
    echo '<h2>Success To Add record '.$total.'</h2>';
}
?>