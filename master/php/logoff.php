<?php

session_start();
require_once "../../core/php/connection.php";
$eid = $_SESSION['EMP_ID'];
$code = $_POST['cod'];
$comm = $_POST['com'];
$sysIp = $_SERVER["REMOTE_ADDR"];
$date = date('Y-m-d');

$sqChe = mysql_query("SELECT access_code,ip_address FROM `employee_login` where `emp_id` = '$eid' and `status` = 1 and DATE_FORMAT(`date`,'%Y-%m-%d') = '$date'");
$countChe = mysql_num_rows($sqChe);
$rowsChe = mysql_fetch_assoc($sqChe);
$ActIp = $rowsChe['ip_address'];
$acCo = $rowsChe['access_code'];

if($countChe == 1){
  if($ActIp == $sysIp){
      if($acCo == $code){
          $sql = mysql_query("INSERT INTO `employee_logoff` (`emp_id`, `comment`, `date`) VALUES ('$eid', '$comm', NOW())");
 
         if($sql == TRUE){
            echo 'Please wait..!';
            ?>
<html>
    <head>
        <meta http-equiv="refresh" content="5;url=http://192.168.1.202/kkcabs-new/auth/login_confirm.php" />
    </head>
</html>
<?php
         }
          }else{
              echo 'Please Enter The Valid Access Code!';
          }
  } 
  else{
      echo 'You dont have authorized to log off application!!';
  }
}
?>