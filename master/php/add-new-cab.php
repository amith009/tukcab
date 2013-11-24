<?php
/*
File Name: add-new-cab.php
Work and function: this is back end file for add-new-cab.php (location: form/)
cab code format as per type of cab and coloum increment value
##########
Create date = 28 NOV 2011
Time: 12:24
Last Update:
Date: 28 NOV 2011
Time: 4:00
Author Name: amit kumar
*/
session_start(); 
require_once "../../core/php/connection.php";
date_default_timezone_set('Asia/Kolkata'); //time stamp
$attType = $_POST['attType'];
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
$cabTopAmnt = $_POST['cabtopamt'];
$insComp = $_POST['insComp'];
$insIssDat = $_POST['insIssDat'];
$insExpDat = $_POST['insExpDat'];
$emisatCode = $_POST['emisatCode'];
$perIssDat = $_POST['perIssDat'];
$perExpDat = $_POST['perExpDat'];
$depAmnt = $_POST['depAmnt']==''?0:$_POST['depAmnt'];
$dopRef = $_POST['dopRef'];
$activAmnt = $_POST['activAmnt'];
$srvTax = $_POST['srvTax'];
$stkrSrv = $_POST['stkrSrv'];
$stkrAmnt = $_POST['stkrAmnt']==''?0:$_POST['stkrAmnt'];
$doj = $_POST['doj'];
$emiNo = $_POST['emiNo'];
$cabtop = $_POST['cabtop'];
$cabTopAmount = $_POST['cabtopamt'];
$sticker = $_POST['sticker'];
$meter = $_POST['meter'];

$dateCols = '';
$dateVals = '';
if($insIssDat!=''){
	$dateCols .= ' ,`insurance_issue_date`';
	$dateVals .= ", '$insIssDat'";
}
if($emisatCode !=''){
	$dateCols .= ' ,`eminiNo`';
	$dateVals .= ", '$emisatCode'";
}
if($emiNo !=''){
	$dateCols .= ' ,`eminiAv`';
	$dateVals .= ", '$emiNo'";
}
if($insExpDat!=''){
	$dateCols .= ' ,`insurance_exp_date`';
	$dateVals .= ", '$insExpDat'";
}
if($perIssDat!=''){
	$dateCols .= ' ,`eminIss`';
	$dateVals .= ", '$perIssDat'";
}
if($perExpDat!=''){
	$dateCols .= ' ,`eminExp`';
	$dateVals .= ", '$perExpDat'";
}
//cab type track
$sqlCabTY = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = $cabType");
if(mysql_error()){
	echo 'ERROR: Please Select Cab Type!';
}else{
	$rows = mysql_fetch_assoc($sqlCabTY);
	$cabTyCod = $rows['cab_type_code'];
//end here


$sqlCC = mysql_query("SELECT * FROM `cabs` WHERE `cab_code` LIKE '%$cabTyCod%' ORDER BY `cab_id` DESC");
$countCC = mysql_num_rows($sqlCC);
if($countCC == 0){
	$code = $cabTyCod.$strVal;
}else{
	
	$rowCC = mysql_fetch_assoc($sqlCC);
	$cuVal = $rowCC['cab_code'];
	 $isVal = substr($cuVal,3);
	$nowVal = $isVal+1;
    $code =  $cabTyCod.$nowVal;
   //$code = "LOG6";
}
//exit(0);
//image front file
	//echo $_FILES['imgf']['name'].' - Tmp Location: '.$_FILES["imgf"]["tmp_name"]; exit(0);
	$f1_name = $_FILES['imgf']['name'];
	move_uploaded_file($_FILES["imgf"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgf"]["name"]);
	 $imgf_content = $f1_name==''?'':'cab_images/'.$code.$_FILES["imgf"]["name"];
	//end here
	//image back file
	$f2_name = $_FILES['imgb']['name'];
	move_uploaded_file($_FILES["imgb"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgb"]["name"]);
	  $imgb_content = $f2_name==''?'':'cab_images/'.$code.$_FILES["imgb"]["name"];
	//end here
	//image left file
	$f3_name = $_FILES['imgl']['name'];
	move_uploaded_file($_FILES["imgl"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgl"]["name"]);
	  $imgl_content = $f3_name==''?'':'cab_images/'.$code.$_FILES["imgl"]["name"];
	//end here
	//image front file
	$f4_name = $_FILES['imgr']['name'];
	move_uploaded_file($_FILES["imgr"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgr"]["name"]);
	  $imgr_content = $f4_name==''?'':'cab_images/'.$code.$_FILES["imgr"]["name"];
	//end here
	//image inteor front file
	 $f5_name = $_FILES['imgif']['name'];
	move_uploaded_file($_FILES["imgif"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgif"]["name"]);
	  $imgif_content = $f5_name==''?'':'cab_images/'.$code.$_FILES["imgif"]["name"];
	//end here
	//image intero back file
	$f6_name = $_FILES['imgib']['name'];
	move_uploaded_file($_FILES["imgib"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgib"]["name"]);
	  $imgib_content = $f6_name==''?'':'cab_images/'.$code.$_FILES["imgib"]["name"];
	//end here
	
$status = $_POST['status'];

$strVal = 1;
//get cab type code
	$sqlCt = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabType'");
	if($sqlCt == TRUE){
		$rowTy = mysql_fetch_assoc($sqlCt);
		$cabTyCod = $rowTy['cab_type_code'];
	}else{
		echo 'ERROR: Please Select Type of Cab!!';
		exit(0);
	}
	//end here


//end here
 echo $sqlMain = "INSERT INTO `cabs` (`cab_code`, `plate_no`, `cab_type`, `mfd_year`, `engine_no`, `chassis_no`, `color`, `fuel_type`, `meter`, `sticker`, `cabTop`, `cab_ac`, `insurance_comp`, `insurance_no`, `equipments`, `meter_type`, `doj`, `status` $dateCols) VALUES ('$code', '$plNo', '$cabType', '$modYear', '$engNo', '$chNo', '$color', '$fulType', '$meter', '$sticker', '$cabtop', '$airCon', '$insComp', '$insNo', '$eqment', '$mtrType', '$doj', '$status' $dateVals)";
//exit(0);
$result = mysql_query($sqlMain);

if(mysql_error()){
    echo mysql_error();
	echo 'ERROR: Unable to add cab!';
   echo mysql_error();
   
}else{
    //permit details
    $perNat = $_POST['perNat'];
    $dateSatIss = $_POST['dateSatIss'];
    $dateSatExp = $_POST['dateSatExp'];
    $satNat = $_POST['satNat'];
    $dateNatIss = $_POST['dateNatIss'];
    $dateNatExp = $_POST['dateNatExp'];
    $trnNat = $_POST['trnNat'];
    $dateTrnIss = $_POST['dateTrnIss'];
    $dateTrnExp = $_POST['dateTrnExp'];
    $rodTax = $_POST['rodTax'];
    $dateRodIss = $_POST['dateRodIss'];
    $dateRodExp = $_POST['dateRodExp'];
    if($rodTax == 1 || $rodTax != ""){
        $rodData .= ', `rodTax`';
        $rodVal .= ", '".$rodTax."'";
    }
    if($perNat == 1 || $perNat != ""){
        $rodData .= ', `roadPerType`';
        $rodVal .= ", '".$perNat."'";
    }
    if($satNat == 1 || $satNat != ""){
        $rodData .= ', `rodSatePer`';
        $rodVal .= ", '".$satNat."'";
    }
    if($trnNat == 1 || $trnNat != ""){
        $rodData .= ', `rodTriuPer`';
        $rodVal .= ", '".$trnNat."'";
    }
    if($dateNatIss != ""){
        $rodData .= ', `roadPerIssue`';
        $rodVal .= ", '".$dateNatIss."'";
    }
    if($dateNatExp != ""){
        $rodData .= ', `roadPerExp`';
        $rodVal .= ", '".$dateNatExp."'";
    }
    if($dateRodIss != ""){
        $rodData .= ', `taxIssue`';
        $rodVal .= ", '".$dateRodIss."'";
    }
    if($dateRodExp != ""){
        $rodData .= ', `taxExp`';
        $rodVal .= ", '".$dateRodExp."'";
    }
    if($dateSatIss != ""){
        $rodData .= ', `rodSateIsse`';
        $rodVal .= ", '".$dateSatIss."'";
    }
    if($dateSatExp != ""){
        $rodData .= ', `rodSateExp`';
        $rodVal .= ", '".$dateSatExp."'";
    }
    if($dateTrnIss != ""){
        $rodData .= ', `rodTriuIsse`';
        $rodVal .= ", '".$dateTrnIss."'";
    }
    if($dateTrnExp != ""){
        $rodData .= ', `rodTriuExp`';
        $rodVal .= ", '".$dateTrnExp."'";
    }
    
    $sqlRoad = mysql_query("INSERT INTO `cabroadpermit` (`cabCode` $rodData) VALUES ('$code' $rodVal)");
    if(mysql_error()){
        //echo mysql_error();
        echo 'Unable To add Road Permit record!';
    }else{
//end for permit details
	//echo "INSERT INTO `cab_deposite` (`cd_cab_code`, `cd_deposite_amount`, `cd_sticker_charge`, `cd_service_charge`, `cd_call_center_charge`) VALUES ('$code', '$depAmnt',  '$stkrAmnt', '$srvTax', '$activAmnt')"; exit(0);
	$sqlAmnt = mysql_query("INSERT INTO `cab_deposite` (`cd_cab_code`, `cd_deposite_amount`, `cd_sticker_charge`, `cd_service_charge`, `cd_call_center_charge`, `cd_deposite_refed`, `cabTopAmount`) VALUES ('$code', '$depAmnt',  '$stkrAmnt', '$srvTax', '$activAmnt','$dopRef', '$cabTopAmount')");
	//insert cab images
	if(mysql_error()){
		echo "ERROR: Cab Deposite Amount Not Added!!";
		//echo $depAmnt.'<->'.mysql_error();
	}else{
	$sqlImages = mysql_query("INSERT INTO `cab_images` (`ci_code`, `ci_front_image`, `ci_back_image`, `ci_left_image`, `ci_right_image`, `ci_interior_front_image`, `ci_interior_back_image`) VALUES ('$code', '$imgf_content', '$imgb_content', '$imgl_content', '$imgr_content', '$imgif_content', '$imgib_content')");
	 if(mysql_error()){
		 echo "ERROR: Unable to add cab images!";
	 }else{
	if($sqlAmnt == TRUE){
		
		//insert into work app log
	     $eid = $_SESSION['EMP_ID'];
		$appType = "ACD";
		$appComm = "Add new Cab ".$code;
		$timDat = date("Y-m-d").' '.date("H:i:s");
		
		$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$code', '$appComm', '$timDat')");
		
		if(mysql_error()){
			echo 'ERROR: Anable update log';
		}else{
			header("location: ../form/add-new-driver.php?cbId=".$code."&dt=".$attType."&owner=0&doj=".$doj);
		}
	}//image else close
   }//else deposite
		//end here
        }	
	}
}//cab type else close
	
}
mysql_close();
?>