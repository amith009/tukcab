
<?php
/******************************************************************************
File Name: add-free-cab.php
##########
Create date = 29 NOV 2011
Time: 00:22
Last Update:
Date: 29 NOV 2011
Time: 11:00
Author Name: amit kumar
********************************************************************************/ 
session_start();
require_once "../../core/php/connection.php";

$cabId = $_POST['cabId'];
$area = $_POST['area'];
$bid = $cabId;
$date = $_POST['date'];
$time = $_POST['time'];
$satatus = 0;
$eid = $_SESSION['EMP_ID'];
$appType = "AFC";
$appComm = $area;			
$timDat = $date.' '.$time;

//inserting into DB
//check if allready  added
$sqlCh = mysql_query("SELECT `cab_id` FROM `free_cabs` WHERE `cab_id` = '$cabId'");
$countCh = mysql_num_rows($sqlCh);

if($countCh == 0){
	//if not exsist add as new record
	$sqlFrCab = mysql_query("INSERT INTO `free_cabs` (`cab_id`, `location`, `date`, `time`, `status`) VALUES ('$cabId', '$area', '$date', '$time', '$satatus')");
        
}else{
   //if exsist update status 1->0
	$sqlFrCab = mysql_query("UPDATE `free_cabs` SET `location` = '$area', `date` = '$date', `time` = '$time', `status` = '$satatus' WHERE `cab_id` = '$cabId'");
	

}

if(mysql_error()){
	echo '<div class="error"><img src="images/alert.png" width="32" height="32"><br>Try Again!!';
}else{
	$sqlAss = mysql_query("SELECT `cab_id`,`driver_id`,`status` FROM `assigned_cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
	if(mysql_error()){
		echo '<div class="error"><img src="images/alert.png" width="32" height="32"><br>Enable to Get Driver Record';
	}else{
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
		$rowAss = mysql_fetch_assoc($sqlAss);
		$drvId = $rowAss['driver_id'];
		//driver record
		$sqlDrv = mysql_query("SELECT driver_id,mobile_no,driver_name,alt_mobile_no,phone_no FROM `drivers` WHERE `driver_id` = '$drvId'");
		if(mysql_error()){
			echo '<div class="error"><img src="images/alert.png" width="32" height="32"><br>Enable to Get Driver Record';
		}else{
			//check cab is active or not
			$sqlCab = mysql_query("SELECT `cab_id`,`cab_code`,`status` FROM `cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
			$countCab = mysql_num_rows($sqlCab);
			if($countCab == 0){
				echo '<div class="error"><img src="images/alert.png" width="32" height="32"><br>This Cab is Not Active';
			}else{
				$roCAb = mysql_fetch_assoc($sqlCab);
				
			//end checking
			$rowDr = mysql_fetch_assoc($sqlDrv);
			echo '<div class="formContainer"><div class="title">Free cab added</div>
                            <table width="500" border="0" align="center">
				  <tr>
					<td>Cab Code</td>
					<td>'.$roCAb['cab_code'].'</td>
				  </tr>
				  <tr>
					<td>Driver Name</td>
					<td>'.$rowDr['driver_name'].'</td>
				  </tr>
				  <tr>
					<td>Contact No.</td>
					<td><strong>MOB:</strong>'.$rowDr['mobile_no'].','.$rowDr['alt_mobile_no'].' <br><strong>PH:</strong>'.$rowDr['phone_no'].'</td>
				  </tr>
				</table></div>';
			}//cab else close hrere
		}
		//end here
	}
} 
?>

