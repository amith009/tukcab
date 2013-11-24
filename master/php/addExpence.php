<?php
session_start();

require_once "../../core/php/connection.php";

$time = date("H:i:s");
$decp = $_POST['descp'];
$amnt = $_POST['amnt'];
$startDate = $_POST['startDate'].' '.$time;
$emp_id = $_SESSION['EMP_ID'];
$bank = $_POST['bank'];
$pmo = $_POST['pmo'];
$chdate = $_POST['chdate'];
$card = $_POST['card'];
$chno = $_POST['chno'];
$submit = $_GET['acf'];

$expId = $_POST['expId'];
$expWhom = $_POST['expWhom'];
if($submit == "SAVE" ){
       $sql = "INSERT INTO `expence` (`expDetails`, `expAmount`, `expWhom`, `expPayMode`, `expBank`, `expChqeNo`, `expchqDate`, `expCardNo`, `expDate`, `empId`) VALUES ('$decp', '$amnt', '$expWhom', '$pmo', '$bank', '$chno', '$chdate', '$card', '$startDate', '$emp_id')";
       //exit(0);
       $result = mysql_query($sql);
        if($result != true){
            echo mysql_error();
           echo '<p align="center"> <img src="images/001_18.png" width="26" height="26" align="absmiddle"/><br><b style="color:#990000; font-size:20px;">Try Again for inserting!</b></p>';
         }else{
          echo ' <p align="center"><img src="images/001_19.png" width="26" height="26" align="absmiddle"/><br><b style="color:#009933; font-size:20px;">Success To Add Record!</b></p>';
         }
   }
else{
      echo $sqlUp = "UPDATE `expence` SET `expDetails` = '$decp', `expAmount` = '$amnt', `expWhom` = '$expWhom',`expPayMode` = '$pmo', `expBank` = '$bank', `expChqeNo` = '$chno', `expchqDate` = '$chdate', `expCardNo` = '$card', `expDate` = '$startDate', `empId` = '$emp_id' WHERE `expId` = $expId";
      $resultUp = mysql_query($sqlUp);
        if(mysql_error()){
            echo mysql_error();
           echo '<p align="center"> <img src="images/001_18.png" width="26" height="26" align="absmiddle"/><br><b style="color:#990000; font-size:20px;">Try Again!</b></p>';
         }else{
          echo ' <p align="center"><img src="images/001_19.png" width="26" height="26" align="absmiddle"/><br><b style="color:#009933; font-size:20px;">Success To Update Record!</b></p>';
         }
      
  }
  

?>
