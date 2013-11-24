<?php
/*
File Name: edit-cab.php
Work and function: this is back end file for add-new-cab.php (location: form/)
cab code format as per type of cab and coloum increment value
##########
Create date = 04 DES 2011
Time: 12:24
Last Update:
Date: 
Time: 
Author Name: amit kumar
*/
session_start(); 
require_once "../../core/php/connection.php";
date_default_timezone_set('Asia/Kolkata'); //time stamp

$plNo = $_POST['plNo'];
$cabType = $_POST['cabType'];
$modYear = $_POST['modYear'];
$fulType = $_POST['fulType'];
$color = $_POST['color'];
$chNo = $_POST['chNo'];
$airCon = $_POST['airCon'];
$engNo = $_POST['engNo'];
$mtrType = $_POST['mtrType'];
$eqment = $_POST['eqment'];
$insNo = $_POST['insNo'];
$insComp = $_POST['insComp'];
$insIssDat = $_POST['insIssDat'];
$insExpDat = $_POST['insExpDat'];
$perIssDat = $_POST['perIssDat'];
$perExpDat = $_POST['perExpDat'];
$doj = $_POST['doj'];
$cabId = $_POST['cabid'];
$status = $_POST['status'];
$emisatCode = $_POST['emisatCode'];
$emiNo = $_POST['emiNo'];
$cabtop = $_POST['cabtop'];
$sticker = $_POST['sticker'];
$meter = $_POST['meter'];

$strVal = 1;
if($emisatCode !=''){
	$dateCols .= " ,`eminiNo` = '".$emisatCode."'";
}

if($perIssDat!=''){
	$dateCols .= " ,`eminIss` = '".$perIssDat."'";
}
if($perExpDat!=''){
	$dateCols .= " ,`eminExp` = '".$perExpDat."'";
}
//exit(0);
//end here
	$sqlCab = mysql_query("UPDATE `cabs` SET `plate_no` = '$plNo', `cab_type` = '$cabType', `mfd_year` = '$modYear', `engine_no` = '$engNo', `chassis_no` = '$chNo', `color` = '$color', `fuel_type` = '$fulType', `meter` = '$meter', `sticker` = '$sticker', `cabTop` = '$cabtop', `cab_ac` = '$airCon', `insurance_comp` = '$insComp', `insurance_no` = '$insNo', `insurance_issue_date` = '$insIssDat', `insurance_exp_date` = '$insExpDat', `eminiAv` = '$emiNo', `equipments` = '$eqment', `meter_type` = '$mtrType', `doj` = '$doj', `status` = '$status' $dateCols WHERE `cab_id` = '$cabId'");
	if(mysql_error()){
            echo mysql_error();
		echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
	}else{
		header("location: ../form/view-cab-details.php?id=".$cabId);
	}
	mysql_close($con);
?>