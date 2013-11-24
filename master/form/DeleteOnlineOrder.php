<?php
require_once "../../core/php/connection.php";
 $orId = $_GET['id'];
 
 $sqlDel = mysql_query("UPDATE `online_record` SET `status` = 3 WHERE `booking_id` = '$orId' OR `booking_id` = '$passVal'");
 if(mysql_error()){
  echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
 }else{
     header("location: main-home.php?no=ALL&type=ALL");
 }
 mysql_close();
?>
