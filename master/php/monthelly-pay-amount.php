<?php
/*
File Name: starting-pay-amount.php
Work and function: this is back end file for starting-pay-amount.php (location: php/)
in this file we just track only deposit amount and stkering charge amount

table call "cab_deposite"

as per cab id call query

##########
Create date = 28 NOV 2011
Time: 02:07
Last Update:
Date: 28 NOV 2011
Time: 02:07
Author Name: amit kumar
*/
session_start();
require_once "../../core/php/connection.php";
$cabId = $_POST['cabId'];
$date = $_POST['payDate'];
$time = date("H:i:s");
$netPay = $_POST['netPay'];
$payAmnt = $_POST['payAmnt'];
$discount = $_POST['discount'];
$dueDate = $_POST['dueDate'];
$pmo = $_POST['pmo'];
$chno = $_POST['chno'];
$bank = $_POST['bank'];
$chdate = $_POST['chdate'];
$card = $_POST['card'];
$cabPayDate = $_POST['cabPayMonth'];
$comment = $_POST['comment'];
$balance = $netPay-$payAmnt-$discount;

//last deposite amount track
$sqlDep = mysql_query("SELECT cd_received_deposite,cd_sticker_charge_paid FROM `cab_deposite` WHERE `cd_cab_code` = '$cabId'");
if(mysql_error()){
	echo 'ERROR: Unable to read Deposite amount!';
	exit(0);
}else{
	$rowsAn = mysql_fetch_assoc($sqlDep);
	$lastAmountDep = $rowsAn['cd_received_deposite'];
	$lastAmountStkr = $rowsAn['cd_sticker_charge_paid'];
}
//end here
$depoAmnt = $_POST['depoAmnt']+$lastAmountDep;
$depostkr = $_POST['depostkr']+$lastAmountStkr;


$sql = mysql_query("INSERT INTO `cab_payment` (`cp_cab_code`, `cp_payment_date`, `cp_payment_time`, `cp_amt_to_pay`, `cp_amt_paid`, `cp_balance`, `cp_discount`, `cp_next_due_date`, `cp_mode`, `cp_chq_no`, `cp_bank_name`, `cp_chq_iss_date`, `cp_card_no`) VALUES ('$cabId', '$date', '$time', '$netPay', '$payAmnt', '$balance', '$discount', '$dueDate', '$pmo', '$chno ', '$bank', '$chdate', '$card')");
if(mysql_error()){
echo 'ERROR: Try Again!!';
}else{
	$sqlUp = mysql_query("UPDATE `cab_deposite` SET `cd_received_deposite` = '$depoAmnt', `cd_sticker_charge_paid` = '$depostkr' WHERE `cd_cab_code` = '$cabId'");
	if(mysql_error()){
		echo 'ERROR: Deposite Amount Not Update!!';
	   }else{
			          $eid = $_SESSION['EMP_ID'];
						$appType = "CMP";
						$appComm = $comment;
						$timDat = date("Y-m-d").' '.date("H:i:s");
				
				$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$cabId', '$appComm', '$timDat')");
				if(mysql_error()){
					echo 'ERROR: Unable to add App Log Record!';
				}else{
				
				 //track driver number
                  //echo "SELECT driver_id	 FROM `assigned_cabs` WHERE `cab_id` = (SELECT cab_code FROM cabs WHERE `cab_id` = '$cabId')";
				$sqlDriver = mysql_query("SELECT driver_id FROM `assigned_cabs` WHERE `cab_id` = (SELECT cab_id FROM cabs WHERE `cab_code` = '$cabId')");
				 if(mysql_error()){
				   echo 'Driver record Not FoundS';
				 }else{
				    $rowAsDr = mysql_fetch_assoc($sqlDriver);
					$drivId = $rowAsDr['driver_id'];
					$sqlDrDet = mysql_query("SELECT mobile_no FROM `drivers` WHERE `driver_id` = $drivId");
					if(mysql_error()){
					  echo 'Driver record Not Found!';
					}else{
					   $roD = mysql_fetch_assoc($sqlDrDet);
					   $drNo = $roD['mobile_no'];
					   $msgDrv = "Thank You for being part of KK cabs. Monthly payment has been received for Rs. $payAmnt on $date";
					}
				 }
				 //end here
				?>
<div class="title">Success to receive monthly payment for cab <?php echo $cabId; ?> </div>
<p align="center">
<INPUT type="button" value="Send SMS To Driver" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $drNo; ?>&message=<?php echo $msgDrv; ?>','SEND SMS','width=400,height=200')" />
<a href="#" id="../master/form/view-cab-record.php?check=ACT" class="defaultButton" onClick="showMainAction(this.id)">Show Cab Record</a>			
</p>	  
<?php
	  
	  //header("Location: ../form/cabPyametsFronted.php");
				}
	}//update cab payment else close
}
?>