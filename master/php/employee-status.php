<?php
require_once "../../core/php/connection.php";
$str = $_GET['str'];
  $empId = substr($str,2);
  $status = substr($str,0,1);
  $sqlEmp = mysql_query("UPDATE `employee` SET `emp_status` = '$status' WHERE `emp_id` = $empId");
  if(mysql_error()){
      echo '<img src="images/001_11.png"/> <br><b style="color:red;">Record Not Updated!!</b>';
  }else{
      echo '<img src="images/001_19.png"/><br><b style="color:green;">Record Updated!!</b>';
  }
?>
