<?php
session_start();
require_once "../../core/php/connection.php";
$bid = $_POST['bid'];
$comm = $_POST['comm'];

$sqlOr = mysql_query("UPDATE `book_master` SET `status` = 3 WHERE `booking_id` = '$bid'");
if(mysql_error()){
    echo mysql_error();
    exit(0);
}else{
$sqlBok = mysql_query("SELECT booking_code,driver_id,cust_id FROM `book_master` WHERE `booking_id` = '$bid'");
if(mysql_error()){
	 echo '<tr><img src="images/001_11.png" width="24" height="24" /><br /><font color="#CC3300"><strong>No Record Found!!</strong></font>';
}else{
    $rows = mysql_fetch_assoc($sqlBok);
    $ordNo = $rows['booking_code'];
    $drivNo = $rows['driver_id'];
    $custId = $rows['cust_id'];
    
    $sqlDrv = mysql_query("SELECT mobile_no FROM `drivers` WHERE `driver_id` = '$drivNo'");
    $sqlCust = mysql_query("SELECT mobile,alt_mobile FROM `cust_master` WHERE `cust_id` = '$custId'");
    if(mysql_error()){
        echo mysql_error();
        exit(0);
    }else{
        $rowsDr = mysql_fetch_assoc($sqlDrv);
        $rowsCust = mysql_fetch_assoc($sqlCust);
        
        $DriMob = $rowsDr['mobile_no'];
        $custMob = $rowsCust['mobile'];
        
        $eid = $_SESSION['EMP_ID'];
        $appType = "CEL";
        $appComm = $comm;
        $timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$ordNo', '$appComm', '$timDat')");
		if(mysql_error()){
			echo mysql_error();
                        exit(0);
		}else{
                    $msg = "Dear Cabby Your Order No ".$ordNo." has been cancelled. for futher details contact office.";
                    $custMsg = "Dear Customer ur order no ".$ordNo." has been cancelled. For further details call 08041519999 or visit www.kkcabs.com";
                    $custMsg2 = "Dear Customer the cab ur trying its not available try next time. For further details call 08041519999 or visit www.kkcabs.com";;
                    echo '<div class="title">Success to cancel the order no '.$ordNo.'</div>';
			?>
                        <br /><br />
                     <INPUT type="button" value="Send SMS To Driver" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $DriMob; ?>&message=<?php echo $msg; ?>','SEND SMS','width=400,height=200')" />
                     <INPUT type="button" value="Send SMS To Customer" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $custMsg; ?>','SEND SMS','width=400,height=200')" />
                    <INPUT type="button" value="Send SMS To Customer for No cabs" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $custMsg2; ?>','SEND SMS','width=400,height=200')" />
                     <?php
                    }
		}
        }
}
?>