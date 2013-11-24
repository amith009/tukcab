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


if($jod!=''){
	$dateCols .= ' ,doj';
	$dateVals .= ", '$jod'";
}
if($insdatEx!=''){
	$dateCols .= ' ,dob';
	$dateVals .= ", '$dob'";
}
if($dob!=''){
	$dateCols .= ' ,insaurance_exp_date';
	$dateVals .= ", '$insdatEx'";
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

	$f3_name = $_FILES['pictures']['name'];
	move_uploaded_file($_FILES["pictures"]["tmp_name"],
  "../../core/driver_images/".$code.$_FILES["pictures"]["name"]);
	  $imgl_content = $f3_name==''?'':'driver_images/'.$code.$_FILES["pictures"]["name"];
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
$sqlMain = "INSERT INTO `drivers` (`driver_code`, `driver_name`, `driver_type`, `driver_owner`, `add_1`, `add_2`, `city`, `state`, `country`, `zip`, `mobile_no`, `phone_no`, `email`, `reference_by`,  `dl_no`, `badge_no`, `experience`, `insaurance_comp`, `insaurance_no`, `image_file`, `status` $dateCols) VALUES ('$code', '$drivNam', '$attType', '$ownId', '$addLine1', '$addLine2', '$city', '$state', '$country',  '$pin', '$mob', '$ph', '$email', '$ref', '$dl', '$bdge', '$exp', '$inco', '$inno', '$imgl_content', '$status' $dateVals)";

$result = mysql_query($sqlMain);
if(mysql_error()){
	//echo 'Try Again!!';
	echo mysql_error();
}else{
   header("location: ../form/view_owner_under_drivers.php?oid=".$ownId);
	
	}
?>