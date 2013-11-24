<?php
/*
File Name: add-new-driver.php
Work and function: this is back end file for add-new-driver.php (location: form/)
in this as per date of joining we count exp.
driver code format as per KKD0 and coloum increment value
##########
Create date = 28 NOV 2011
Time: 12:24
Last Update:
Date: 28 NOV 2011
Time: 12:24
Author Name: amit kumar
*/
session_start();
require_once "../../core/php/connection.php";

$drivNam = $_POST['drivNam'];
$addLine1 = $_POST['addLine1'];
$mob = $_POST['mob'];
$addLine2 = $_POST['addLine2'];
$mob2 = $_POST['mob2'];
$city = $_POST['city'];
$ph = $_POST['ph'];
$state = $_POST['state'];
$area = $_POST['area'];
$country = $_POST['country'];
$email = $_POST['email'];
$pin = $_POST['pin'];
$attType = $_POST['attType'];
$ownId = $_POST['ownId'];
$ref = $_POST['ref'];
$dob = $_POST['dob'];
$jod = $_POST['jodadt'];
$dl = $_POST['dl'];
$bdge = $_POST['bdge'];
$badgeIss = $_POST['badgeIss'];
$badgeExp = $_POST['badgeExp'];
$dldoi = $_POST['dldoi'];
$dlex = $_POST['dlex'];
$inco = $_POST['inco'];
$inno = $_POST['inno'];
$insdatEx = $_POST['insdatEx'];
$status = $_POST['status'];
$cabId = $_POST['cabId'];         ///cab code

if($jod!=''){
	$dateCols .= ' ,doj';
	$dateVals .= ", '$jod'";
}
if($insdatEx!=''){
	$dateCols .= ' ,dob';
	$dateVals .= ", '$insdatEx'";
}
if($dob!=''){
	$dateCols .= ' ,insaurance_exp_date';
	$dateVals .= ", '$dob'";
}

if($dldoi!=''){
	$dateCols .= ' ,dl_issue_date';
	$dateVals .= ", '$dldoi'";
}
if($dlex!=''){
	$dateCols .= ' ,dl_exp_date';
	$dateVals .= ", '$dlex'";
}
if($badgeIss!=''){
	$dateCols .= ' ,badge_iss_date';
	$dateVals .= ", '$badgeIss'";
}
if($badgeExp!=''){
	$dateCols .= ' ,badge_exp_date';
	$dateVals .= ", '$badgeExp'";
}

if($mob2!=''){
	$dateCols .= ' ,alt_mobile_no';
	$dateVals .= ", '$mob2'";
}
if($area != ''){
    $dateCols .= ' ,prefered_area';
    $dateVals .= ", '$area'";
}
//image intero back file
	$f6_name = $_FILES['img']['name'];
	move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/driver_images/" . $_FILES["img"]["name"]);
	  $imgib_content = 'driver_images/'.$f6_name;
	//end here

$sqDriv = mysql_query("SELECT driver_id, driver_code FROM `drivers` ORDER BY `driver_id` DESC");
if(mysql_error()){
	 $code = "KKD01";
}else{
	$roDriv = mysql_fetch_assoc($sqDriv);
	$actualVal = $roDriv['driver_code'];
    $cutVal = substr($actualVal,3);
	$upgradeVal = $cutVal+1;
    $code = "KKD".$upgradeVal;
}

//exit(0);
//calculate exprience
$jodYear = substr($jod,0,4);
$dlIssDat = substr($dldoi,0,4);
$expTotal = $jodYear-$dlIssDat;
if(substr($expTotal,0,1) == "-"){
	$exp = 0;
}else{
	$exp = $expTotal;
}
//exit(0);//end here
$status = 1;
$sqlMain = "INSERT INTO `drivers` (`driver_code`, `driver_name`, `driver_type`, `driver_owner`, `add_1`, `add_2`, `city`, `state`, `country`, `zip`, `mobile_no`, `phone_no`, `email`, `reference_by`,  `dl_no`, `badge_no`, `experience`, `insaurance_comp`, `insaurance_no`, `status` $dateCols) VALUES ('$code', '$drivNam', '$attType', '$ownId', '$addLine1', '$addLine2', '$city', '$state', '$country',  '$pin', '$mob', '$ph', '$email', '$ref', '$dl', '$bdge', '$exp', '$inco', '$inno', '$status' $dateVals)";

$result = mysql_query($sqlMain);
if(mysql_error()){
	//echo 'Try Again!!';
	echo mysql_error();
}else{
	$sqlDrId = mysql_query("SELECT driver_id,driver_code FROM `drivers` WHERE `driver_code` = '$code'");
	$sqlCabID = mysql_query("SELECT cab_id,cab_code FROM `cabs` WHERE `cab_code` = '$cabId'");
	if(mysql_error()){
		echo 'ERROR: Driver details Not Fatching!!';
	}else{
		$roDrId = mysql_fetch_assoc($sqlDrId);
		$roCabID = mysql_fetch_assoc($sqlCabID);
		$cId = $roCabID['cab_id'];
		$dID = $roDrId['driver_id'];
		$date = date("Y-m-d");
		$time = date("H:i:s");
                
                if($attType == 3){
                    $status_cab = '0';
                }else{
                    $status_cab = '1';
                }
                $sql = mysql_query("INSERT INTO `assigned_cabs` (`cab_id`, `driver_id`, `assign_date`, `assign_time`, `status`) VALUES ('$cId', '$dID', '$date', '$time', '$status_cab')");
	
	     if(mysql_error()){
			echo 'ERROR: Please Assign cab for this Driveraf!!';
		 }else{
			   $eid = $_SESSION['EMP_ID'];
				$appType = "ADN";
				$appComm = "Add new Driver ".$code;
				$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
		
		if(mysql_error()){
			echo 'ERROR: Unable to add App Log';
		}else{
			echo 'Success to add record';
		  }
		 }
	}
}
?>