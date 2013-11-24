<?php
/*********************************************************************************************

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
      $k++;
     //echo "UPDATE `cab_rate_record` SET `crr_value` = '$values[$i]', `status` = '$status' WHERE `crd_id` = '$crtid[$i]' AND `cab_type_id` = '$cabType'";
      $result = mysql_query("UPDATE `cab_rate_record` SET `crr_value` = '$values[$i]', `status` = '$status' WHERE `crd_id` = '$crtid[$i]' AND `cab_type_id` = '$cabType'");
      if (!$result) {
        echo mysql_error();
        break;
      }
}
if($total == $k){
    echo '<h2>Success To Update record '.$total.'</h2>';
}

?>