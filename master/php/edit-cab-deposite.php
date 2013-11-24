<?php

/*Author name: amit kumar
 * date: 31-12-2011
 * 
 * this file is backend for cab deposite payment update record
 * only updation not for increment mode
 */

require_once "../../core/php/connection.php";

echo $cabId = $_POST['id'];
//exit(0);
$depAmnt = $_POST['depAmnt'];
$dopRef = $_POST['dopRef'];
$activAmnt = $_POST['activAmnt'];
$srvTax = $_POST['srvTax'];
$stkrSrv = $_POST['stkrSrv'];
$stkrAmnt = $_POST['stkrAmnt'];
$cabtopamt = $_POST['cabtopamt'];

//echo $sql = "UPDATE `cab_deposite` SET `cd_deposite_amount` = '$depAmnt', `cd_sticker_charge` = '$stkrAmnt', `cd_service_charge` = '$srvTax', `cd_deposite_refed` = '$dopRef', `cd_call_center_charge` = '$activAmnt' WHERE `cd_cab_id` = '$cabId'";
//exit(0);
$sqlSer = mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cabId'");
$count = mysql_num_rows($sqlSer);
if($count == 0){
	$sqlAmnt = mysql_query("INSERT INTO `cab_deposite` (`cd_cab_code`, `cd_deposite_amount`, `cd_sticker_charge`, `cd_service_charge`, `cd_call_center_charge`, `cd_deposite_refed`, `cabTopAmount`) VALUES ('$cabId', '$depAmnt',  '$stkrAmnt', '$srvTax', '$activAmnt','$dopRef', '$cabtopamt')");
	  if(mysql_error()){
    echo mysql_error();
    echo 'Record Not Updated';
}else{
   $sqlCab = mysql_query("SELECT `cab_id` FROM `cabs` WHERE `cab_code` = '$cabId'");
   if(mysql_error()){
      echo 'Unable to read Cab Record!!';
   }else{
       $roCab = mysql_fetch_assoc($sqlCab);
       $cabI = $roCab['cab_id'];
        header("location: ../form/view-cab-details.php?id=".$cabI);
   }
}
   
}else{
$sql = mysql_query("UPDATE `cab_deposite` SET `cd_deposite_amount` = '$depAmnt', `cd_sticker_charge` = '$stkrAmnt', `cd_service_charge` = '$srvTax', `cd_deposite_refed` = '$dopRef', `cd_call_center_charge` = '$activAmnt', `cabTopAmount` = '$cabtopamt' WHERE `cd_cab_code` = '$cabId'");

if(mysql_error()){
    echo mysql_error();
    echo 'Record Not Updated';
}else{
   $sqlCab = mysql_query("SELECT `cab_id` FROM `cabs` WHERE `cab_code` = '$cabId'");
   if(mysql_error()){
      echo 'Unable to read Cab Record!!';
   }else{
       $roCab = mysql_fetch_assoc($sqlCab);
       $cabI = $roCab['cab_id'];
        header("location: ../form/view-cab-details.php?id=".$cabI);
   }
}
   
}
?>
