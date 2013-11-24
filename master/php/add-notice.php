<?php
require_once "../../core/php/connection.php";

$id = $_POST['id'];
$title = $_POST['title'];
$remark = $_POST['remark'];
$date = date("Y-m-d");
$sat = 1;
$sql = mysql_query("INSERT INTO `notices` (`emp_id`, `title`, `content`, `date`, `status`) VALUES ('$id', '$title', '$remark', '$date', '$sat')");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
	echo '<div class="success"><img src="images/001_19.png" width="32" height="32"><br><b>Success to Add Record!!</b></div>';
}
?>