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
$id = $_POST['id'];
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
$jod = $_POST['jod'];
$dl = $_POST['dl'];
$bdge = $_POST['bdge'];
$dldoi = $_POST['dldoi'];
$dlex = $_POST['dlex'];
$inco = $_POST['inco'];
$inno = $_POST['inno'];
$insdatEx = $_POST['insdatEx'];
$badEx = $_POST['badgEx'];
$badIs = $_POST['badIs'];
//calculate exprience
$jodYear = substr($jod,0,4);
$dlIssDat = substr($dldoi,0,4);
$expTotal = $jodYear-$dlIssDat;
if(substr($expTotal,0,1) == "-"){
	$exp = "0";
}else{
	$exp = $expTotal;
}
$code = rand(999,9999999);
echo $exp;
        $f6_name = $_FILES['img']['name'];
        if($f6_name == ""){
          $valImg = "";
            
        }else{
	move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/driver_images/".$code.$_FILES["img"]["name"]);
	  $img_content = $f6_name==''?'':'driver_images/'.$code.$_FILES["img"]["name"];
          
             $valImg = ", `image_file` = '".$img_content."'";
	//end here
        }
//value tracking

if($mob != ""){
	$valDriv1  = ", `mobile_no` = '$mob'";
}
else{
	$valDriv1 = "";
}
if($mob2 != ""){
	$valDriv2  = ", `alt_mobile_no` = '$mob2'";
}
else{
	$valDriv2 = "";
}
if($dob != ""){
	$valDriv3 = ", `dob` = '$dob'";
}
else{
	$valDriv3 = "";
}
if($area != ""){
	$valDriv4 = " ,`prefered_area` = '$area'";
}
else{
	$valDriv4 = "";
}
if($badIs != ""){
	$valDriv5 = ", `badge_iss_date` = '$badIs'";
}
else{
	$valDriv5 = "";
}
if($badEx != ""){
	$valDriv6 = ",`badge_exp_date`  = '$badEx'";
}
else{
	$valDriv6 = "";
}
if($bdge != ""){
	$valDriv7 = ", `badge_no` = '$bdge'";
}
else{
	$valDriv7 = "";
}
if($dl != ""){
	$valDriv8 = ", `dl_no` = '$dl'";
}
else{
	$valDriv8 = "";
}
if($dldoi != ""){
	$valDriv9 = ", `dl_issue_date` = '$dldoi'";
}
else{
	$valDriv9 = "";
}
if($dlex != ""){
	$valDriv13 = ", `dl_exp_date` = '$dlex'";
}
else{
	$valDriv13 = "";
}
if($inco != ""){
	$valDriv10 = ", `insaurance_comp` = '$inco'";
}
else{
	$valDriv10 = "";
}
if($inno != ""){
	$valDriv11 = ", `insaurance_no` = '$inno'";
}
else{
	$valDriv11 = "";
}
if($insdatEx != ""){
	$valDriv12 = ", `insaurance_exp_date` = '$insdatEx'";
}else{
	$valDriv12 = "";
}
//end here
//exit(0);//end here

$sqlMain = "UPDATE `drivers` SET `driver_name` = '$drivNam', `driver_type` = '$attType', `driver_owner` = '$ownId', `add_1` = '$addLine1', `add_2` = '$addLine2', `city` = '$city', `state` = '$state', `country` = '$country', `zip` = '$pin', `phone_no` = '$ph', `email` = '$email', `doj` = '$jod',`reference_by` = '$ref', `experience` = '$exp' $valDriv1 $valDriv2 $valDriv3 $valDriv4 $valDriv5 $valDriv6 $valDriv7 $valDriv8 $valDriv9 $valDriv10 $valDriv11 $valDriv12 $valDriv13 $valImg WHERE `driver_id` = $id";

$result = mysql_query($sqlMain);
if(mysql_error()){
   echo 'ERROR: Try again!!';
	//echo mysql_error();
}else{
	echo 'SUCCE: Success to Update record!';
	header("location: ../form/view-driver-record.php");
}
mysql_close();
?>