<?php
require_once "../../core/php/connection.php";
$srvName= $_POST['srvName'];
$status = $_POST['staus'];

$sql = mysql_query("INSERT INTO `service_type` (`service_type`, `status`) VALUES ('$srvName', '$status')");
if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Record added.';
}
mysql_close();
?>