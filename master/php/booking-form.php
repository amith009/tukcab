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

//end function count date
//variable declaration
$custName = $_POST['custName'];
$CustType = $_POST['CustType'];
$comp = $_POST['comp'];
$coname = $_POST['coname'];
$cono = $_POST['cono'];
$coemil = $_POST['coemil'];
$MO = $_POST['MO'];
$custMob = $_POST['custMob'];
$EM = $_POST['EM'];
$CustEmail = $_POST['CustEmail'];
$AMO = $_POST['AMO'];
$custAltMob = $_POST['custAltMob'];
$EMA = $_POST['EMA'];
$CustEmailAlt = $_POST['CustEmailAlt'];
$custPh = $_POST['custPh'];
$srvType = $_POST['srvType'];
$pickUp = $_POST['pickUp'];
$rdate = $_POST['rdate'];
$rtime = $_POST['rtime'];
$edate = $_POST['edate'];
$finalPickUp = $_POST['finalPickUp'];
$PP = $_POST['PP'];
$lm = $_POST['lm'];
$req = $_POST['req'];
$dropUp = $_POST['dropUp'];
$lq1 = $_POST['lq1'];
$lq2 = $_POST['lq2'];
$lq3 = $_POST['lq3'];
$lq4 = $_POST['lq4'];
$typeCab = $_POST['typeCab'];
$noCabs = $_POST['noCab'];
$pmo = $_POST['pmo'];
$comment = $_POST['comment'];
$status = 1;
$office = $_POST['office'];
$current = $_POST['current'];
$recedn = $_POST['recedn'];
//booking code
//$cbid = 5;
//$drc = 23;
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
//exit(0);
//as per record
	 if($PP == 3){
		    $colInsert = "`arecedence_lq1`, `arecedence_lq2`, `arecedence_lq3`, `arecedence_lq4`, `arecedence_lm`";
			$valInsert = "'".$lq1."', '".$lq2."', '".$lq3."', '".$lq4."', '".$lm."'";
			$valuPass = "`arecedence_lq1` = '".$lq1."', `arecedence_lq2` = '".$lq2."', `arecedence_lq3` = '".$lq3."', `arecedence_lq4` = '".$lq4."', `arecedence_lm` = '".$lm."'";
			$mainPickOf = "";
			$mainPickRe = $pickUp;
			$mainPickCu = "";
			
		}
		elseif($PP == 1){
			$colInsert = "`aoffice_lq1`, `aoffice_lq2`, `aoffice_lq3`, `aoffice_lq4`, `aoffice_lm`";
			$valInsert = "'".$lq1."', '".$lq2."', '".$lq3."', '".$lq4."', '".$lm."'";
			$valuPass = "`aoffice_lq1` = '".$lq1."', `aoffice_lq2` = '".$lq2."', `aoffice_lq3` = '".$lq3."', `aoffice_lq4` = '".$lq4."', `aoffice_lm` = '".$lm."'";
			$mainPickOf = $pickUp;
			$mainPickRe = "";
			$mainPickCu = "";
		}
		elseif($PP== 2){
			$colInsert = "`acurrent_lq1`, `acurrent_lq2`, `acurrent_lq3`, `acurrent_lq4`, `acurrent_lm`";
			$valInsert = "'".$lq1."', '".$lq2."', '".$lq3."', '".$lq4."', '".$lm."'";
			$valuPass = "`acurrent_lq1` = '".$lq1."', `acurrent_lq2` = '".$lq2."', `acurrent_lq3` = '".$lq3."', `acurrent_lq4` = '".$lq4."', `acurrent_lm` = '".$lm."'";
			$mainPickOf = "";
			$mainPickRe = "";
			$mainPickCu =  $pickUp;
			
		}
		else{
		}
		
		if($custAltMob!=''){
	     $dateCols .= ' ,alt_mobile';
	    $dateVals .= ", '$custAltMob'";
        }	
		//
		/*note **************************************************\\
		$pp = 1 -> office
		$pp = 2 -> Current
		$pp = 3 -> Recidence
		**********************************************************/
		
//check customer allready exisit or not
//echo $custMob.'<br>AM-'.$custAltMob.'<br>p-'.$custPh; exit(0);

if($custMob != "0"){
   $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `mobile` = '$custMob'");
   //echo "1";
}elseif($custPh != "0" && $custPh != ""){
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `phone_no` = '$custPh'");
   //echo "2";
	}
elseif($custAltMob != "0" && $custAltMob != ""){
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `alt_mobile` = '$custAltMob'");
   //echo "3";
   
	}else{
  echo 'ERROR: No Phone Numbers Found!!';
    
}
			  $coCut = mysql_num_rows($sqlCust);
			  $datjoi = date("Y-m-d");
			  if($coCut == 0){
			 //if no customer found then add as new customer
			$pws = rand(999,9999);
				  $sqlCustIns = mysql_query("INSERT INTO `cust_master` (`cust_type`, `cust_name`, `cust_username`, `cust_password`, `mobile`, `phone_no`, `email`, `alt_email`, `office`, `recedence`, `current`, `requirement`, `date_join`, `status` $dateCols) VALUES ('$CustType', '$custName', '$custMob', '$pws', '$custMob', '$custPh', '$CustEmail', '$CustEmailAlt', '$mainPickOf', '$mainPickRe', '$mainPickCu', '$req', '$datjoi', '$status' $dateVals)");
				  if(mysql_error()){
					 echo 'ERROR: Unable to add customer record';
				  }else{
					  //track customer id
					  $lastCustID = mysql_insert_id();
					  $sqlCustSel = mysql_query("SELECT cust_id,mobile FROM `cust_master` WHERE `cust_id`=$lastCustID");
						$counCust = mysql_num_rows($sqlCustSel);
						if($counCust == 0){
							echo 'ERROR: No record Found';
						}else{
							$rowsCust = mysql_fetch_assoc($sqlCustSel);
							$custId = $rowsCust['cust_id'];
							//add into address table
                                                        //echo "INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)";
							$sqlAddCuts = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)");
							if(mysql_error()){
								echo 'ERROR: Address not Added!';
                                exit();
							}else{
							//now booking start here
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
						$sqlBook = mysql_query("INSERT INTO `book_master` (`booking_code`, `cust_id`, `service_type`, `pickup_point`, `required_date`, `required_time`, `end_date`, `destination`, `cab_type`, `number_of_cab`, `payment_mode`, `remarks`, `status`) VALUES ('$code', '$custId', '$srvType', '$pick', '$tdate', '$rtime', '$edate', '$dropUp', '$typeCab', '$noCab', '$pmo', '$comment', '$status')");
                          
						  if(mysql_error()){
							  echo 'ERROR: Please check form values and try again!';
							  }else{
							    $eid = $_SESSION['EMP_ID'];
								$appType = "BOK";
								$appComm = "Booked Order ".$code;
								$timDat = date("Y-m-d").' '.date("H:i:s");
							//inserti in to employee record		
						$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
									if(mysql_error()){
										echo 'ERROR: Unable to add this record';
									}else{
									if($i == $noCab){
											//sending sms
			
			echo '<div class="formContainer" style="text-align:center;"><div class="title">Order Confirmation</div><h1>Order no is: '.$code.'</h1><br/>';
			//$msg = "Dear, $custName your booking is confirm $rdate / $rtime. and your BID is $code. for more details loging your account www.kkcabs.com";
            $msg = "Thank you for calling KK Cabs. Your confirmed booking no: ".$code.",".$rdate." ".$rtime.". For further details call 08041519999 or visit www.kkcabs.com"
                        ?>
            
            <INPUT type="button" value="Show Waiting List" class="defaultButton" id="../master/form/booked-order-list.php" onClick="showMainAction(this.id)" />
            <INPUT type="button" value="Send SMS" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $msg; ?>','SEND SMS','width=400,height=200')" />
            <?php
									}	
								      }
							  }
							//end employee record inserting here
						  }//for loop close here
						 }//else close here
						 #end here booking
						}//addres insert else close here
					  //end here tracking customer id
				  }
			 //end here
			  }else{
				  $roCust = mysql_fetch_assoc($sqlCust);
				  $custId = $roCust['cust_id'];
				  if($PP == 1){
					  $passPpValu = "`office` = '".$pickUp."'";
				  }
				  elseif($PP == 2){
					  $passPpValu = "`current` = '".$pickUp."'";
				  }
				  elseif($PP == 3){
					  $passPpValu = "`recedence` = '".$pickUp."'";
				  }
				  else{
					  $passPpValu = "";
				  }
				  
				
			      //update master record first
				  if($custMob!= ""){
							$datVal .= ", `mobile` = '$custMob'";
						  
						}
						if($custAltMob != ""){
							$datVal .= ", `alt_mobile` = '$custAltMob'";
							
						}
						if($custPh != ""){
							$datVal .= ", `phone_no` = '$custPh'";
							
						}
						if($CustEmail != ""){
							$datVal .= ", `email` = '$CustEmail'";
						
						}
						if($CustEmailAlt != ""){
							$datVal .= ", `alt_email` = '$CustEmailAlt'";
						
						}
						if($req != ""){
							$datVal .= ", `requirement` = '$req'";
							
						}
						if($custName != ""){
							$datVal .= ", `cust_name` = '$custName'";
							
						}
					   // echo "UPDATE `cust_master` SET `status` = 1, $passPpValu $datVal   WHERE `cust_id` = '$custId'";
						
				  $sqlUpCust = mysql_query("UPDATE `cust_master` SET `status` = 1, $passPpValu $datVal WHERE `cust_id` = '$custId'");
				  if(mysql_error()){
					 echo 'ERROR: Address not Updated!!';
				  }else{
                                     
			 //address details
			  //check if cust_details exists, if not insert
			  $sqlChk = mysql_query("SELECT cust_id custCount FROM cust_detail WHERE `cust_id` = '$custId'");
			  if(mysql_num_rows($sqlChk)==0){
				  $sqlDetInsert = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)");
			  }
			  else{
				  $sqlUpAdd = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = '$custId'");
			  }
                                  
				  //$sqlUpAdd = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = '$custId'");
					 
					 if(mysql_error()){
                         echo mysql_error();
						 echo 'ERROR: Address not update!';
                                                 
					 }else{
						 //now booking start here
						 #track booking id
						 for($i=1; $i<=$noCab; $i++){
						 $t= $i-1;
						//date increment
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
						 // exit();
						 		  
						}
					}
							//
							$sqlBook = mysql_query("INSERT INTO `book_master` (`booking_code` , `cust_id` , `service_type`, `pickup_point`, `required_date`, `required_time`, `end_date`, `destination`, `cab_type`, `number_of_cab`, `payment_mode`, `remarks`, `status`)
VALUES ('$code', '$custId', '$srvType', '$pick', '$tdate', '$rtime', '$edate', '$dropUp', '$typeCab', '$noCab', '$pmo', '$comment', '$status')");
                          
						  if(mysql_error()){
							    echo 'ERROR: Please check form values and try again!';
							  //echo 'ERROR: '.mysql_error();
						  }else{
							    $eid = $_SESSION['EMP_ID'];
								$appType = "BOK";
								$appComm = "Booked Order ".$code;
								$timDat = date("Y-m-d").' '.date("H:i:s");
                                                                
							//insert in to employee record		
						$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
									if(mysql_error()){
										echo 'ERROR: Unable to add this record';
									}else{
										if($i == $noCab){
											//sending sms
			          					    
			//end sms sending
			echo '<div class="formContainer" style="text-align:center;"><div class="title">Order Confirmation</div><h1>Order no is: '.$code.'</h1><br/>';
			//$msg = "Dear, $custName your booking is confirm $rdate / $rtime. and your BID is $code. for more details loging your account www.kkcabs.com";
			$msg = "Thank you for calling KK Cabs. Your confirmed booking no: ".$code.",".$rdate." ".$rtime.". For further details call 08041519999 or visit www.kkcabs.com"
                        ?>
            <INPUT type="button" value="Show Waiting List" class="defaultButton" id="../master/form/booked-order-list.php" onClick="showMainAction(this.id)" />
			
            <INPUT type="button" value="Send SMS" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $msg; ?>','SEND SMS','width=400,height=200')" />
            <?php
            echo '</div>';
			//header('location: ../form/main-home.php');
										}	
									}
							}
							//end employee record inserting here
						  }
						 }//for loop close here
						 #end here
						 //end here
					 }
					 //end here
				  }
				  //end here
mysql_close();
?>
