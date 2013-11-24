<?php
require_once "../../core/php/connection.php";
$type = $_GET['type'];
$status = substr($type,0,1);

$time = date('H:i:s');
$id = substr($type,2);
//exit(0);
$sql = "UPDATE `employee_login` SET `status` = '$status', `logout_time` = '$time' WHERE `logoff_id` = '$id'";

$result = mysql_query($sql);

if($result != true){
    echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
    echo '<div class="success"><img src="images/001_19.png" width="32" height="32"><br><b>Success to Update Record!!</b></div>';
}



?>
