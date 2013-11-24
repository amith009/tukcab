<?php
require_once "../../core/php/connection.php";
$curDate = date("Y-m-d");
$curTime = date("H:i:s");

//end function count date
//variable declaration
$custId = $_GET['custId'];
$custName = $_GET['custName'];
$CustType = $_GET['CustType'];
$comp = $_GET['comp'];
$coname = $_GET['coname'];
$cono = $_GET['cono'];
$coemil = $_GET['coemil'];
$MO = $_GET['MO'];
$custMob = $_GET['custMob'];
$EM = $_GET['EM'];
$CustEmail = $_GET['CustEmail'];
$AMO = $_GET['AMO'];
$custAltMob = $_GET['custAltMob'];
$EMA = $_GET['EMA'];
$CustEmailAlt = $_GET['CustEmailAlt'];
$custPh = $_GET['custPh'];
$srvType = $_GET['srvType'];
$pickUp = $_GET['pickUp'];
$rdate = $_GET['rdate'];
$rtime = $_GET['rtime'];
$edate = $_GET['edate'];
$finalPickUp = $_GET['finalPickUp'];
$PP = $_GET['PP'];
$lm = $_GET['lm'];
$req = $_GET['req'];
$dropUp = $_GET['dropUp'];
$lq1 = $_GET['lq1'];
$lq2 = $_GET['lq2'];
$lq3 = $_GET['lq3'];
$lq4 = $_GET['lq4'];
$typeCab = $_GET['typeCab'];
$noCabs = $_GET['noCab'];
$pmo = $_GET['pmo'];
$comment = $_GET['comment'];
$status = 1;
$office = $_GET['office'];
$current = $_GET['current'];
$recedn = $_GET['recedn'];
//booking code
//$cbid = 5;
//$drc = 23;
$pick = $finalPickUp.'+'.$pickUp;

if($srvType == 5){
	$date1 = strtotime($rdate);
	$date2 = strtotime($edate);
	$datediff = $date2-$date1;
	$totalDate= floor($datediff/(60*60*24))+1;
	$noCab = $totalDate*$noCabs;
}else{
	$noCab = $noCabs;
}

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

if($custAltMob!=''){
	$dateCols .= ' ,alt_mobile';
	$dateVals .= ", '$custAltMob'";
}	


if($custId == "BLNK"){

$datjoi = date("Y-m-d");
	//if no customer found then add as new customer
	$pws = rand(999,9999);
	$sqlCustIns = mysql_query("INSERT INTO `cust_master` (`cust_type`, `cust_name`, `cust_username`, `cust_password`, `mobile`, `phone_no`, `email`, `alt_email`, `office`, `recedence`, `current`, `requirement`, `date_join`, `status` $dateCols) VALUES ('$CustType', '$custName', '$custMob', '$pws', '$custMob', '$custPh', '$CustEmail', '$CustEmailAlt', '$mainPickOf', '$mainPickRe', '$mainPickCu', '$req', '$datjoi', '$status' $dateVals)");
	if(mysql_error()){
		echo 'ERROR: Unable to add customer record';
	}else{
		//echo "1. New Customer Added";
		//track customer id
		$lastID = mysql_insert_id();
		$sqlCustSel = mysql_query("SELECT cust_id,mobile FROM `cust_master` WHERE `cust_id`=$lastID");
		$counCust = mysql_num_rows($sqlCustSel);
		if($counCust == 0){
			echo 'ERROR: No record Found';
		}else{
			$rowsCust = mysql_fetch_assoc($sqlCustSel);
			$custId = $rowsCust['cust_id'];
			//add into address table
			$sqlAddCuts = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)");
			if(mysql_error()){
				echo 'ERROR: Address not Added!';
				//echo mysql_error();
				exit();
			}else{
			     echo 'SUCCE: New Record Added';
			}//else close here
		}//addres insert else close here
		//end here tracking customer id
		//echo "\n2. Customer details updated";
	}
	//end here
}else{
    $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = $custId");
	if(mysql_error()){
	  echo 'ERROR: No Record Found!';
	}else{
	$roCust = mysql_fetch_assoc($sqlCust);
	$custId = $roCust['cust_id'];
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
	echo 'ERROR: Address not Updated!!';
	//echo mysql_error();
	//
	}else{
		//address details
		//check if cust_details exists, if not insert
		$sqlChk = mysql_query("SELECT cust_id custCount FROM cust_detail WHERE `cust_id` = '$custId'");
		if(mysql_num_rows($sqlChk)==0){
			$sqlDetInsert = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `cust_add_curr`, `cust_add_offi`, `cust_add_res`, $colInsert) VALUES ('$custId', '$current', '$office', '$recedn', $valInsert)");
		}
		else{
			$sqlUpAdd = mysql_query("UPDATE `cust_detail` SET `cust_add_curr` = '$current', `cust_add_offi` = '$office', `cust_add_res` = '$recedn', $valuPass  WHERE `cust_id` = '$custId'");
		}
		if(mysql_error()){
			echo mysql_error();
			echo 'ERROR: Address not update!';
		}else{
		}
		//end here
	}
	//end here
}
}//main else close here
mysql_close();
?>