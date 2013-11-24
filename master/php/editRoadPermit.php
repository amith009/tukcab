<?php
require_once "../../core/php/connection.php";
    $cabId = $_POST['cabId'];
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
    
    $sqlCabCod = mysql_query("SELECT `cab_code` FROM `cabs` WHERE `cab_id` = '$cabId'");
if(mysql_error()){
  echo 'unable to read Cab Record!';
}else{
    $roCab = mysql_fetch_assoc($sqlCabCod);
   $cabCode = $roCab['cab_code'];
   $code = $cabCode;
   
    //search if all ready exits then update values
    $sqlChe = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$code'");
    $count = mysql_num_rows($sqlChe);
    
    if($count == 1){
        if($perNat == 1 || $perNat != ""){
        $rodUp .= ", `roadPerType` = '".$perNat."'";
    }
    if($satNat == 1 || $satNat != ""){
        $rodUp .= ", `rodSatePer` = '".$satNat."'";
    }
    if($rodTax == 1 || $rodTax != ""){
        $rodUp .= " , `rodTax` = '".$rodTax."'";
    }
    if($dateRodIss != ""){
        $rodUp .= ", `taxIssue` = '".$dateRodIss."'";
    }
    if($dateRodExp != ""){
        $rodUp .= ", `taxExp` = '".$dateRodExp."'";
    }
    if($trnNat == 1 || $trnNat != ""){
        $rodUp .= ", `rodTriuPer` = '".$trnNat."'";
    }
    if($dateNatIss != ""){
        $rodUp .= ", `roadPerIssue` = '".$dateNatIss."'";
    }
    if($dateNatExp != ""){
        $rodUp .= ", `roadPerExp` = '".$dateNatExp."'";
    }
    if($dateSatIss != ""){
        $rodUp .= ", `rodSateIsse` = '".$dateSatIss."'";
    }
    if($dateSatExp != ""){
        $rodUp .= ", `rodSateExp` = '".$dateSatExp."'";
    }
    if($dateTrnIss != ""){
        $rodUp .= ", `rodTriuIsse` = '".$dateTrnIss."'";
    }
    if($dateTrnExp != ""){
        $rodUp .= ", `rodTriuExp`  = '".$dateTrnExp."'";
    }
    $sqlUpDa = "UPDATE `cabroadpermit` SET `status` = 1 $rodUp WHERE `cabCode` = '$code'";
    $result = mysql_query($sqlUpDa);
    if(mysql_error()){
        echo 'Unable To Update Permit Record!';
        //echo mysql_error();
    }else{
        header("location: ../form/view-cab-details.php?id=".$cabId);
    }
    }
    ///////////////////////////////////////////////////////////////////////////////
    else{
    if($rodTax == 1 || $rodTax != ""){
        $rodData .= ', `rodTax`';
        $rodVal .= ", '".$rodTax."'";
    }
    if($dateRodIss != ""){
        $rodData .= ', `taxIssue`';
        $rodVal .= ", '".$dateRodIss."'";
    }
    if($dateRodExp != ""){
        $rodData .= ', `taxExp`';
        $rodVal .= ", '".$dateRodExp."'";
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
    header("location: ../form/view-cab-details.php?id=".$cabId);
    }
    }
    }//else close for checking
?>
