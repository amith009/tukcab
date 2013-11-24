<?php
require_once "../../core/php/connection.php";
$CurDate = date("Y-m-d");
$date = '2011-12-27';
$sql = mysql_query("SELECT * FROM `book_master` WHERE `required_date` = '$date' OR `end_date` >= '$date' AND `status` = 1");
echo $count = mysql_num_rows($sql).'<br><hr>';
if(mysql_error()){
	echo 'try again';
}else{
 while($rows = mysql_fetch_assoc($sql)){
	 echo $rows['booking_code'].'=+='.$rows['service_type'].'<br>';
 }
}
?>