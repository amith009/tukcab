<?php
session_start();
require_once "../../core/php/connection.php";
$bid = $_POST['bid'];
$cabId = $_POST['cabId'];
$date = $_POST['date'];
$time = $_POST['rtime'];
$type = $_POST['type'];
$custMob = "";
$custPho = "";
$msgCust = "";
$drivMob = "";
$msgDrv = "";
$sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
if(mysql_error()){
	echo 'No Driver Assigned for This Cab!';
}else{
	$roDr = mysql_fetch_assoc($sqlDriv);
	$drvId = $roDr['driver_id'];
	
     $sqlUp = mysql_query("UPDATE `book_master` SET `status` = 2, `cab_id` = $cabId, `driver_id` = $drvId WHERE `booking_id` = $bid");
     
     $sqlNo = mysql_query("SELECT booking_code FROM `book_master` WHERE `booking_id` = $bid");
	 if(mysql_error()){
		
		 echo '<h2>No Driver Assigned for This Cab!<br>Try Again!</h2>';
	 }else{
	 $cabCodr = mysql_query("SELECT cab_id,plate_no,cab_code FROM `cabs` WHERE `cab_id` = '$cabId'");
	 if(mysql_error()){
	 $cabCodeCh = "N/A";
	 }else{
	 $rou = mysql_fetch_assoc($cabCodr);
         $rowsNom = mysql_fetch_assoc($sqlNo);
         $orNom = $rowsNom['booking_code'];
	 $cabCodeCh = $rou['cab_code'];
	 }
		        $eid = $_SESSION['EMP_ID'];
				if($type == "CC"){
					$appType = "CHC";
				$appComm = $cabCodeCh.'-'.$_POST['remark'];
				}else{
				$appType = "DIS";
				$appComm = $cabCodeCh.'-'.$_POST['remark'];
				}
				$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$orNom', '$appComm', '$timDat')");
		if(mysql_error()){
			
		}else{
			$sqlFreeCab = mysql_query("UPDATE `free_cabs` SET `status` = 1 WHERE `cab_id` = $cabId");
			if(mysql_error()){
				echo 'ERROR: Could not update free cab list!';
			}else{
			$msgDrv = "";
$msgCust = "";
//track order
$sqlOr = mysql_query("SELECT * FROM `book_master` WHERE `booking_id` = $bid");

$couOr = mysql_num_rows($sqlOr);
if($couOr == 0){
	echo '<strong>No Record found!!</strong>';
}else{
	$rowOr = mysql_fetch_assoc($sqlOr);
	$custId = $rowOr['cust_id'];
	$startTime = $rowOr['required_time'];
	 //track customer number.
	 $sqlCu = mysql_query("SELECT `cust_id`,`mobile`,`alt_mobile`,`phone_no`,`cust_name` FROM `cust_master` WHERE `cust_id` = $custId");
	 $sqlCuDet = mysql_query("SELECT `cust_add_curr`,`cust_add_offi`,`cust_add_res` FROM `cust_detail` WHERE `cust_id` = $custId");
	 $couCu = mysql_num_rows($sqlCu);
	 if($couCu == 0){
		 echo 'Customer Record Not found!!';
	 }else{
		 $rowCu = mysql_fetch_assoc($sqlCu);
		 $rowDet = mysql_fetch_assoc($sqlCuDet);
	     $piUp = $rowOr['pickup_point'];
         $ppO = $rowOr['pickup_point'];
		 $adt = explode("+",$ppO);
		 $pickUp = current($adt);
		 $custMob = $rowCu['mobile'];
		 $custPho = $rowCu['phone_no'];
		 $custName = $rowCu['cust_name'];
		 //driver record track
		 $di = $rowOr['driver_id'];
		 if($di == "NULL"){
			 //do nothink
			 $drivMob = '';
		 }else{
			//echo "I am here".$di;
			 $drvId = $rowOr['driver_id'];
			 $sqlDrk = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = $drvId");
			 if(mysql_error()){
				 //do nothing
				 $drivMob = "";
			 }else{
				 $roDrv = mysql_fetch_assoc($sqlDrk);
				 $drivMob = $roDrv['mobile_no'];
				 $drivName = $roDrv['driver_name'];
				 //cab details
				 $sqlCab = mysql_query("SELECT cab_id,plate_no,cab_code FROM `cabs` WHERE `cab_id` = '$cabId'");
				 if(mysql_error()){
					 //do nothing
				 }else{
					 $roCab = mysql_fetch_assoc($sqlCab);
					 $regNo = $roCab['plate_no'];
				 //end here
				 if($custMob == "" || $custMob == 0){
					$sendDrNo = $custPho;
				 }else{
				  $sendDrNo = $custMob;
				 }
				 $msgDrvL = "RPT- ".$startTime.", Cust- ".$custName.", Ph- ".$sendDrNo.", PP- ".$pickUp;
				 $msgDrv = preg_replace("/[\n\r]/"," ",$msgDrvL);
				 $reqTim = substr($rowOr['required_time'],0,5);
				 //$msgCust = "Dear, $custName. your Driver Details- ".$drivName." Ph- ".$drivMob.", Cab No.". $regNo." Req Time. ".$reqTim ."for more details call 08041519999 or visit www.kkcabs.com";
				 
				 $msgCustL = "Dear Customer ur cab details: Cabby: $drivName-$drivMob, Cab no: $regNo. For further bookings and enquiry, call 08041519999";
				 $msgCust = preg_replace("/[\n\r]/"," ",$msgCustL);
				  //end here
	 

				 }
			 }
		 }
	 }
         ?>
<table align="center"><tr><th colspan="3" align="center"><strong>Cab has been assigned <?php echo $roCab['cab_code']; ?></strong></th></tr>
<tr>
    <td>
        <INPUT type="button" value="Send SMS to Driver" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $drivMob; ?>&message=<?php echo $msgDrv; ?>','SEND SMS','width=400,height=200')" /> 
    </td>
      <td>
         <INPUT type="button" value="Send SMS to Customer" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $msgCust; ?>','SEND SMS','width=400,height=200')" /> 
          </td>
      <td>
        <INPUT type="button" value="Send Email Customer" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/email-dispt-order.php?id=<?php echo $bid; ?>','SEND EMAIL','width=400,height=200')" />
      </td>
</tr>
                      	
</table>
		<?php
			}//else free cabs
        }
		 
	 }
}
}//else order


//**UPDATE ONLINE RECORD 	 **/
$onlineBook = $rowOr['onlineBook'];
if($onlineBook != 0){

$ordNo = $rowOr['booking_code'];
	$conOn = mysql_connect('tmkasim.db.8924211.hostedresource.com','tmkasim','Kkc@bs12') or die("Cannot connect to database");
	mysql_select_db('tmkasim');	
	//echo "UPDATE online_record SET `status` = 3 WHERE `appId` = '$bid'";
	 mysql_query("UPDATE online_record SET `status` = 3 WHERE `appId` = ".$ordNo,$conOn);
		if(mysql_error()){
		echo mysql_error().'Online';
		}
		mysql_close($conOn);
		//* END HERE ONLINE UPDATE
}
?>