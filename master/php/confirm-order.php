<?php
/************************************************************************************
File Name: booking-form.php
T=table name -> book_master
*************************************************************************************
Create date = 30 NOV 2011
Time: 12:42 AM
Last Update:
Date: 22-JAN-2012
Time: 07:00 PM
Author Name: amit kumar
 * Updation: booking code, 
***********************************************************************************/
session_start();
require_once "../../core/php/connection.php";
$curDate = date("Y-m-d");
$curTime = date("H:i:s");
$orId = $_GET['id'];
$curYear = date("Y");
$firstYearMonth = date("m");
$firstYearDate = date("d");
$sqlYear = mysql_query("SELECT * FROM `year_pass_code` WHERE `ypc_year` = '$curYear'");

if(!mysql_error()){
	$rowsYear = mysql_fetch_assoc($sqlYear);
	$ypc = $rowsYear['ypc_code'];
	/*$newYearCode = $ypc."101";
	if($firstYearMonth == "1" AND $firstYearDate == "1" ){
		$sqlBoCoUp = mysql_query("SELECT booking_id,booking_code FROM `book_master` ORDER BY `booking_id` DESC");
		if(!mysql_error()){
			$rowsLaos = mysql_fetch_assoc($sqlBoCoUp);
			$lastBid = $rowsLaos['booking_id'];
			$sqlUpOrder = mysql_query("UPDATE `book_master` SET `booking_code` = '$newYearCode' WHERE `booking_id` = '$lastBid' LIMIT 1");
			
		}
		
	}
	*/
	
}

$yearPassCode = $ypc;
 $sqlOnl = mysql_query("SELECT * FROM `online_record` WHERE `booking_id` = $orId");
 $sqlDel = mysql_query("UPDATE `online_record` SET `status` = 2 WHERE `booking_id` = '$orId'");
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
$online = 1;
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
  
}elseif($custPh != "0" && $custPh != ""){
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `phone_no` = '$custPh'");
   echo "2";
	}
elseif($custAltMob != "0" && $custAltMob != ""){
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `alt_mobile` = '$custAltMob'");
   echo "3";
   
	}else{
  echo 'ERROR: No Phone Numbers Found!!';
  
  
}
$countCust = mysql_num_rows($sqlCust);
if($countCust != 0){
   $rowsCust = mysql_fetch_assoc($sqlCust);
     $custId = $rowsCust['cust_id'];
    $office = $rowsCust['office'];
    $current = $rowsCust['current'];
    $recedn = $rowsCust['recedence'];
    if($office == $pickUp || $current == $pickUp || $recedn == $pickUp){
    //do nothing
      //echo $custId;
}

else{
   //update with current address
   $sqlAddUp = mysql_query("UPDATE `cust_master` SET `current` = '$pickUp' WHERE `cust_id` = $custId");
   $sqldetUp = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$finalPickUp' WHERE `cust_id` = $custId");
   if(mysql_error()){
       echo 'Unable to update customer record';
   }
}
}else{
   
      //add as new customer
       $pws = rand(999,9999);
      $sqlCustIns = mysql_query("INSERT INTO `cust_master` (`cust_type`, `cust_name`, `cust_username`, `cust_password`, `mobile`, `email`, `current`, `date_join`, `status`) VALUES ('$CustType', '$custName', '$custMob', '$pws', '$custMob', '$CustEmail', '$pickUp', '$curDate', '$status')");
      if(mysql_error()){
             echo 'ERROR: Unable to add customer record';
      }else{
              //track customer id
              $lastCustID = mysql_insert_id();
              $sqlCustSel = mysql_query("SELECT cust_id,mobile FROM `cust_master` WHERE `cust_id` = $lastCustID");
                $counCust = mysql_num_rows($sqlCustSel);
                if($counCust == 0){
                        echo 'ERROR: No record Found';
                        exit();
                }else{
                        $rowsCust = mysql_fetch_assoc($sqlCustSel);
                        $custId = $rowsCust['cust_id'];
                        //add into address table
                       //echo "INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)";
                        $sqlAddCuts = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`) VALUES ('$custId', '$finalPickUp')");
                        if(mysql_error()){
                                echo 'ERROR: Address not Added!';
                                    exit();
                        }
//end adding new customer
    }
   }
  }
  


  //echo $custId;
$pick = $finalPickUp.'+'.$pickUp;

if($srvType == 5){
   $date1 = strtotime($rdate);
   $date2 = strtotime($edate);
  $datediff = $date2-$date1;
  $totalDate= floor($datediff/(60*60*24))+1;
  $noCab = $totalDate*$noCabs;
  
}else{
    $noCab = $noCabs;
    }
	
 #track booking id
           for($i=1; $i<=$noCab; $i++){
                 //date increment
                $t= $i-1;
                $date = new DateTime($rdate);
                $date->modify('+'.$t.' day');
                //this is for if order bulk and out of station date will increment by 1 day
                if($srvType == 6 || $srvType == 5 ){
                   $tdate = $date->format('Y-m-d'); 
                 }else{
                  $tdate = $rdate;
                 }
                 $sqlBoCo = mysql_query("SELECT booking_id,booking_code FROM `book_master` ORDER BY `booking_id` DESC");
                        if(mysql_error()){
                                 $code = 101;
                        }else{
                                $coBo = mysql_num_rows($sqlBoCo);
                                if($coBo == 0){
                                         $code = 101;
                                }else{
                                  $roCo = mysql_fetch_assoc($sqlBoCo);
                                  $col = $roCo['booking_code'];
								  $subCode = substr($col,1)+1;
								  $code = $yearPassCode.$subCode; 
                                }
                        }
                       
                        //
                 $sqlBookQur = "INSERT INTO `book_master` (`booking_code`, `cust_id`, `service_type`, `pickup_point`, `required_date`, `required_time`, `end_date`, `destination`, `cab_type`, `number_of_cab`, `onlineBook`,  `status`) VALUES ('$code', '$custId', '$srvType', '$pick', '$tdate', '$rtime', '$edate', '$dropUp', '$typeCab', '$noCab', '$online', '$status')";
                 $sqlBook = mysql_query($sqlBookQur);
                  if(mysql_error()){
                      //echo mysql_error();
                         echo 'ERROR: Please check form values and try again!';
                  }else{
				  
							
				        mysql_query("UPDATE `online_record` SET `status` = 2 WHERE `booking_id` = $orId");
						if(mysql_error()){
						echo 'ERROR: Unable to Update Online Record!';
						}
						$eid = $_SESSION['EMP_ID'];
                        $appType = "BOK";
                        $appComm = "Booked Order ".$code;
                        $timDat = date("Y-m-d").' '.date("H:i:s");
                //insert in to employee record		
                         $sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
                                
                                if($i == $noCab){
                                                        //sending sms

echo '<div class="formContainer" style="text-align:center;"><div class="title">Order Confirmation</div><h1>Order no is: '.$code.'</h1><br/>';
//$msg = "Dear, $custName your booking is confirm $rdate / $rtime. and your BID is $code. for more details loging your account www.kkcabs.com";
$msg = "Thank you for booking online. your confirmed order no: ".$code.",".$rdate." ".$rtime.". For further details call 08041519999 or visit www.kkcabs.com"
?>
<a href="#" id="../master/form/booked-order-list.php" onClick="showMainAction(this.id)" class="NavButton">Show Waiting List </a> 
<INPUT type="button" value="Send Confirmation SMS" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $msg; ?>','SEND SMS','width=400,height=200')" /> 
<INPUT type="button" value="Send Confirmation Email" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/email-conf-order.php?id=<?php echo $orId; ?>','SEND EMAIL','width=400,height=200')" /> 
<?php
                                        	
                                      }
                          }
                        //end employee record inserting here
                  }//for loop close here
  }
//end here
			 
mysql_close();

//**UPDATE ONLINE RECORD 	 **/

$conOn = mysql_connect('tmkasim.db.8924211.hostedresource.com','tmkasim','Kkc@bs12') or die("Cannot connect to database");
mysql_select_db('tmkasim');	
mysql_query("UPDATE online_record SET `status` = 2, `appId` = '$code' WHERE booking_id=".$orId,$conOn);
if(mysql_error()){
echo 'Online Record Not Updated';
}
mysql_close($conOn);
//* END HERE ONLINE UPDATE
?>
