
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
Date: 29 NOV 2011
Time: 12:34
Author Name: amit kumar
*/
session_start(); 
require_once "../../core/php/connection.php";

$cabid = $_POST['cabid'];
$doj = $_POST['doj'];
$time = date("H:i:s");
$needPay = $_POST['amntr'];
$discount = $_POST['disco'];
$amntPay = $_POST['amntPay'];
$pmo = $_POST['pmo'];
$chno = $_POST['chno'];
$bank = $_POST['bank'];
$chdate = $_POST['chdate'];
$deuDate = $_POST['date'];
$card = $_POST['card'];
$doppay = $_POST['doppay'];
$stkrpay = $_POST['stkrpay'];
$total = $needPay-$discount;
$balnce = $total-$amntPay;;
//exit(0);
$sql = "INSERT INTO `cab_payment` (`cp_cab_code`, `cp_payment_date`, `cp_payment_time`, `cp_amt_to_pay`, `cp_amt_paid`, `cp_balance`, `cp_discount`, `cp_next_due_date`, `cp_mode`, `cp_chq_no`, `cp_bank_name`, `cp_chq_iss_date`, `cp_card_no`) VALUES ('$cabid', '$doj', '$time', '$needPay', '$amntPay', '$balnce', '$discount', '$deuDate', '$pmo', '$chno', '$bank', '$chdate', '$card')";

$result = mysql_query($sql);
if(mysql_error()){
	echo 'error';
}else{
	$sqlUp = mysql_query("UPDATE `cab_deposite` SET `cd_received_deposite` = '$doppay', `cd_sticker_charge_paid` = '$stkrpay' WHERE `cd_cab_code` = '$cabid'");
	if(mysql_error()){
		echo 'ERROR: Deposite Amount Not Update!!';
	}else{
	    $eid = $_SESSION['EMP_ID'];
		$appType = "SPC";
		$appComm = "Starting Pay amount ".$cabid;
		$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$cabid', '$appComm', '$timDat')");
		
		if(mysql_error()){
			echo 'ERROR: Anable add App log';
		}else{
                    //exit(0);
			//echo 'SUCCE: New Cab Added Succe';
			//header("location: ../form/view-cab-record.php?check=ACT&act=c");
                    
                    $cabDet = mysql_query("SELECT cab_id FROM `cabs` where `cab_code` = '$cabid' and `status` = '1'");
                    $cobNo = mysql_num_rows($cabDet);
                    
                    if($cobNo == 1){
                    $rowCabId = mysql_fetch_assoc($cabDet);
                    $cabIdPas = $rowCabId['cab_id'];
                    
                    $sqlCab = mysql_query("SELECT driver_id FROM `assigned_cabs` where `cab_id` = '$cabIdPas' and `status` = '1'");
                    if($sqlCab == true){
                        $rowCab = mysql_fetch_assoc($sqlCab);
                        $drivId = $rowCab['driver_id'];
                        $sqlDrv = mysql_query("SELECT mobile_no,email,driver_name,driver_type,driver_owner  FROM `drivers` where `driver_id` = '$drivId'");
                        $countDriv = mysql_num_rows($sqlDrv);
                        if($countDriv == 1){
                            $rowsDrv = mysql_fetch_assoc($sqlDrv);
                            $drvMob = $rowsDrv['mobile_no'];
                            $drvEmail = $rowsDrv['email'];
                            $drType = $rowsDrv['driver_type'];
                            $drOwn = $rowsDrv['driver_owner'];
                            if($drOwn != ''){
                            $sqlOwn = mysql_query("SELECT mobile_no,email,driver_name  FROM `drivers` where `driver_id` = '$drOwn'");
                            if(mysql_num_rows($sqlOwn) == 1){
                                $rowsOwn = mysql_fetch_assoc($sqlOwn);
                                $ownNo = $rowsOwn['mobile_no'];
                                $ownEmail = $rowsOwn['email'];
                                $msgOwn ="Thank you for choosing n be a part of KK Cabs! Ur cab code is ".$cabid." and coordination no. +91-9902300099 and ur driver no. ".$drvMob." for futher details Call 080 40733100.";
                             }
                            }
                                $msgDrv ="Thank you for choosing n be a part of KK Cabs! Ur cab code is ".$cabid." and coordination no. +91-9902300099 and ur no. ".$drvMob." for futher details Call 080 40733100.";
                            ?>
<div class="title">CAB RECORD ADDED</div>
<table>
    <tr class="row-inactive">
        <td>
            CAB CODE :
        </td>
        <td>
            <?php echo $cabid; ?>
        </td>
    </tr>
    <?php
             if($drOwn != ''){
                ?>
    <tr class="row-active">
        <td>
            Owner Name :
        </td>
        <td>
            <?php echo $rowsOwn['driver_name']; ?>
        </td>
    </tr>
    <tr class="row-inactive">
        <td>
            Owner Contact No: :
        </td>
        <td>
            <?php echo $ownNo; ?>
        </td>
    </tr>
    <tr class="row-active">
        <td>
            Owner Email Address: :
        </td>
        <td>
            <?php echo $ownEmail; ?>
        </td>
    </tr>
    <?php } ?>
    <tr class="row-inactive">
        <td>
            Driver Name :
        </td>
        <td>
            <?php echo $rowsDrv['driver_name']; ?>
        </td>
    </tr>
    <tr class="row-active">
        <td>
            Active Mobile No: :
        </td>
        <td>
            <?php echo $drvMob; ?>
        </td>
    </tr>
    <tr class="row-inactive">
        <td>
            Active Email address:
        </td>
        <td>
            <?php echo $drvEmail; ?>
        </td>
    </tr>
    <tr class="row-active">
        <td colspan="2">
            <?php
             if($drType != ''){
                ?>
                <INPUT type="button" value="Send SMS Owner" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $ownNo; ?>&message=<?php echo $msgOwn; ?>','SEND SMS','width=400,height=200')" />
                <?php if($ownEmail != ""){ ?> <INPUT type="button" value="Send Email Owner" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/sendemail_newcab.php?cabid=<?php echo $cabid; ?>','SEND EMAIL','width=400,height=200')" /> <?php }  ?>
                
             <?php
             }
            ?>
            <INPUT type="button" value="Send SMS" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $drvMob; ?>&message=<?php echo $msgDrv; ?>','SEND SMS','width=400,height=200')" />
            <?php if($ownEmail != ""){ ?> <INPUT type="button" value="Send Email" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/sendemail_newcab.php?cabid=<?php echo $cabid; ?>','SEND EMAIL','width=400,height=200')" /> <?php }  ?>
            <INPUT type="button" value="View Cab Record" class="defaultButton" id="../master/form/view-cab-details.php?id=<?php echo $cabid; ?>" onClick="showMainAction(this.id)" />
            <!--INPUT type="button" value="Print Bill" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/print_bill_newcab.php?cabid=<?php echo $cabid; ?>','Print Bill','width=750,height=700')" /-->
        </td>
    </tr>
</table>
           <?php
        }
        }
    }

}
}
}//deposite else close here
?>