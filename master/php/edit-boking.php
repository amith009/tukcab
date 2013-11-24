<?php
/************************************************************************************
File Name: booking-form.php
T=table name -> book_master
*************************************************************************************
Create date = 30 NOV 2011
Time: 12:42 AM
Last Update:
Date: 06-Dec-2011
Time: 07:00 PM
Author Name: amit kumar
***********************************************************************************/
session_start();
require_once "../../core/php/connection.php";
$curDate = date("Y-m-d");
$curTime = date("H:i:s");

//variable declaration
$bid = $_POST['bid'];
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
$noCab = $_POST['noCab'];
$pmo = $_POST['pmo'];
$comment = $_POST['comment'];

$office = $_POST['office'];
$current = $_POST['current'];
$recedn = $_POST['recedn'];
$custId = $_POST['custId'];
$pick =  $finalPickUp.'+'.$pickUp;
$sqlBook = mysql_query("SELECT booking_code,cab_id FROM `book_master` WHERE `booking_id` = $bid");
if(mysql_error()){
    echo 'Booking Record not Found!!';
}else{
    $rop = mysql_fetch_assoc($sqlBook);
    $code = $rop['booking_code'];
    $cv = $rop['cab_id'];
    if($cv == NULL){
        $status = 1;
    }else{
        $status = 2;
    }
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

$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = $custId");
                     $roCust = mysql_fetch_assoc($sqlCust);
				  
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
					  //echo 'Address not Updated!!';
                                      echo mysql_error();
                                      //
				  }else{
                                     
			 //address details
                                  //check if cust_details exists, if not insert
                                  $sqlChk = mysql_query("SELECT cust_id custCount FROM cust_detail WHERE `cust_id` = $custId");
                                  if(mysql_num_rows($sqlChk)==0){
                                      $sqlDetInsert = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)");
                                  }
                                  else{
                                      $sqlUpAdd = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = $custId");
                                  // echo "UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = $custId";
                                      
                                  }
                                  
				  //$sqlUpAdd = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = '$custId'");
					 
					 if(mysql_error()){
                                                echo mysql_error();
						 echo 'Address not update!';
                                                 
					 }else{
						 //now booking start here
						$sqlUpOr = mysql_query("UPDATE `book_master` SET `service_type` = '$srvType', `pickup_point` = '$pick', `required_date` = '$rdate', `required_time` = '$rtime', `end_date` = '$edate', `destination` = '$dropUp', `cab_type` = '$typeCab', `number_of_cab` = '$noCab', `payment_mode` = '$pmo', `remarks` = '$comment', `status` = $status WHERE `booking_id` = '$bid'");
						  if(mysql_error()){
							  echo 'ERROR: Please check form values and try again!';
							  //echo 'ERROR: '.mysql_error();
						  }else{
                                                        $eid = $_SESSION['EMP_ID'];
                                                        $appType = "BOU";
                                                        $appComm = "Booking Updated ".$bid;
                                                        $timDat = date("Y-m-d").' '.date("H:i:s");

							//insert in to employee record		
						$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
									if(mysql_error()){
										echo 'Unable to add this record';
									}else{
										
											          					    
			//end sms sending
			echo '<div class="formContainer" style="text-align:center;"><div class="title">Order Confirmation</div><h1>Order no is: '.$code.'</h1><br/>';
			//$msg = "Dear, $custName your booking is confirm $rdate / $rtime. and your BID is $code. for more details loging your account www.kkcabs.com";
			$msg = "Thank you for calling KK Cabs. Your confirmed booking no: ".$bid.",".$rdate." ".$rtime.". For further details call 08041519999 or visit www.kkcabs.com"
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
}
mysql_close();
?>