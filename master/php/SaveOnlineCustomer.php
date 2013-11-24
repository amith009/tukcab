<?php
/************************************************************************************
Save Online customer Record
*************************************************************************************
Create date = 30 NOV 2011
Time: 12:42 AM
Last Update:
Date: 09-MAR-2012
Time: 07:00 PM
Author Name: amit kumar

***********************************************************************************/
session_start();
require_once "../../core/php/connection.php";
$curDate = date("Y-m-d");
$curTime = date("H:i:s");
$orId = $_GET['id'];
 $sqlOnl = mysql_query("SELECT * FROM `online_record` WHERE `booking_id` = $orId");
 $sqlDel = mysql_query("UPDATE `online_record` SET `status` = 3 WHERE `booking_id` = '$orId'");
 if(mysql_error()){
     echo 'No Record Found!!';
 }else{
     $rowsOr = mysql_fetch_assoc($sqlOnl);
   
//end function count date
//variable declaration
$ordId = $rowsOr['booking_code'];
$custName = $rowsOr['custName'];
$custMob = $rowsOr['cust_no'];
$CustEmail = $rowsOr['CustEmail'];
$CustType = 1;

//number tracking
$srvType = $rowsOr['servicesType'];
$pickUp = $rowsOr['pickup'];
$rdate = $rowsOr['date'];
$rtime = $rowsOr['time'];
$edate = $rowsOr['edate'];
$finalPickUp = $rowsOr['address'];

$dropUp = $rowsOr['dropPoint'];

$typeCab = $rowsOr['cabType'];
$noCabs = $rowsOr['nocab'];
$status = 1;
//
		/*note **************************************************\\
		$pp = 1 -> office
		$pp = 2 -> Current
		$pp = 3 -> Recidence
		**********************************************************/
		
//check customer allready exisit or not

//track customer address type
if($custMob != "0"){
   $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `mobile` = '$custMob'");
   if(mysql_error()){
       $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `phone_no` = '$custMob'");
       if(mysql_error()){
          $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `alt_mobile` = '$custMob'"); 
       }
   }
  
}
else{
    echo 'Unable to read mobile noumber!';
    exit(0);
}

$countCust = mysql_num_rows($sqlCust);
if($countCust != 0){
   $rowsCust = mysql_fetch_assoc($sqlCust);
     $custId = $rowsCust['cust_id'];
    $office = $rowsCust['office'];
    $current = $rowsCust['current'];
    $recedn = $rowsCust['recedence'];
    
    $sqlAddUp = mysql_query("UPDATE `cust_master` SET `current` = '$pickUp' WHERE `cust_id` = $custId");
   $sqldetUp = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$finalPickUp' WHERE `cust_id` = $custId");
       if(mysql_error()){
           echo 'Unable to update customer record';
       }
       echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Customer Record existing!!</b></div>';
}else{
      $pws = rand(999,9999);
      $sqlCustIns = mysql_query("INSERT INTO `cust_master` (`cust_type`, `cust_name`, `cust_username`, `cust_password`, `mobile`, `email`, `current`, `date_join`, `status`) VALUES ('$CustType', '$custName', '$custMob', '$pws', '$custMob', '$CustEmail', '$pickUp', '$curDate', '$status')");
      if(mysql_error()){
             echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
      }else{
              //track customer id
              $lastCustID = mysql_insert_id();
              $sqlCustSel = mysql_query("SELECT cust_id,mobile FROM `cust_master` WHERE `cust_id` = $lastCustID");
                $counCust = mysql_num_rows($sqlCustSel);
                if($counCust == 0){
                        echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
                        exit();
                }else{
                        $rowsCust = mysql_fetch_assoc($sqlCustSel);
                        $custId = $rowsCust['cust_id'];
                        //add into address table
                       
                        $sqlAddCuts = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`) VALUES ('$custId', '$finalPickUp')");
                        if(mysql_error()){
                                echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
                                 exit();
                        }else{
                        echo '<div class="success"><img src="images/001_19.png" width="32" height="32"><br><b>Success to Add Record!!</b></div>';
                        }
//end adding new customer
    }
   }
    }
 }

 
mysql_close();
?>
