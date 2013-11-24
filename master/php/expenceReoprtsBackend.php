<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: display list all expences list.
T=table name -> expence
##########
Create date = 3 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
$curdate = date("Y-m-d");
require_once "../../core/php/connection.php";
$srTy = $_GET['srTy'];
$sDate = $_GET['sDat'];
$eDate = $_GET['eDat'];
?>
<script type="text/javascript">
var keepPopup = false;
function keepAliveExp(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}
function showActionExp(str)
{
	var uri = "../master/form/order-action.php?mode=cabTy&type="+str;
	var obj = document.getElementById("waitCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
}
function setVisibilityExp(obj, id, visibility) {
	if(keepPopup) return;
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
	if(oTop>$(document).height()-50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}
</script>
<?php
########################################### COMPANY EXPENCE RECORD ######################################################
if($srTy == "COM"){
    

$sqlExp = "SELECT * FROM `expence` WHERE DATE_FORMAT(`expDate`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate'";
$resultExp = mysql_query($sqlExp);
echo '<table width="100%">';
echo '<tr><td colspan="5" align="center" class=redM>Expence Record Form '.$sDate.' To '.$eDate.'</td></tr>';
echo '<tr><th class="table-header-repeat">Sl no.</th><th class="table-header-repeat">Description</th><th class="table-header-repeat">Pay Mode</th><th class="table-header-repeat">Date/ Time</th><th class="table-header-repeat">Amount</th></tr>';
if(mysql_error()){
    echo '<tr><td colspan="5"  align="center"> <img src="images/warning.png" width="16" height="16" align="absmiddle"/><br><b style="color:#FF00CC; font-size:14px;">Unable to connect Database!!</b></td></tr>';
}
else{
    $countExp = mysql_num_rows($resultExp);
    if($countExp == 0){
         echo '<tr><td colspan="5" align="center"> <img src="images/cancel.png" width="26" height="26" align="absmiddle"/><br><b style="color:#CCC; font-size:20px;">No Record Found!</b></td></tr>';
    }
    $amt = 0;
    $i=1;
    while($rowsExp = mysql_fetch_assoc($resultExp)){
     
        $t = $i++;
        echo '<tr ';
   
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   
	echo '><td align="center">'.$t.'</td>';
        echo '<td>';
        $exDetId = $rowsExp['expDetails'];
        $sqlPeD = mysql_query("SELECT * FROM `expencedetails` WHERE `edId` = '$exDetId'");
                if(mysql_error()){
                  echo 'N/A';  
                }
                else{
                    $rol = mysql_fetch_assoc($sqlPeD);
                    echo $rol['exDetals'];
                    $dt = $rowsExp['expWhom'];
                    if($dt != ""){
                        echo '<b><br>To Whom :</b> '.$dt;
                    }
                }
        echo '</td>';
        echo '<td>';
		
        $paYmo = $rowsExp['expPayMode'];
        if($paYmo == 1){
            echo 'Cash';
        }elseif($paYmo == 2){
           echo 'Cheque<br><em><b>Bank:</b>'.$rowsExp['expBank'].'<br><b>Ch. No.:</b>'.$rowsExp['expChqeNo'].'<br><b>Exp. Dat.:</b>'.$rowsExp['expchqDate'].'</em>'; 
        }elseif($paYmo == 3){
            echo 'Card<br><em><b>Card No.:</b>'.$rowsExp['expCardNo'];
        }
        else{
            echo 'N/A';
        }
        echo '<td>';
		$p = $t++;
		?>
		 <a href="#" onClick="keepAliveExp(this,'sub12<?php echo $p; ?>');" onMouseOver="setVisibilityExp(this,'sub12<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityExp(this,'sub12<?php echo $p; ?>', 'none');">
		<?php echo $rowsExp['expDate'];  ?>
		</a>
		
        <div id="sub12<?php echo $p; ?>" class="popup" style="width:60px; background:#e7e7e7;">
		<a href="#" onclick="addExpence(this.id)" id="edi-<?php echo $rowsExp['expId']; ?>" style="color:#fff;"><img src="images/001_45.png" width="22" height="22" align="absmiddle"/></a>&nbsp;&nbsp;
		<a href="#" onclick="addExpence(this.id)" id="del-<?php echo $rowsExp['expId']; ?>" style="color:#fff;"><img src="images/001_29.png" width="22" height="22" align="absmiddle"/></a>&nbsp;&nbsp;
		</div>
		<?php
		echo '</td>';
        echo '</td>';
        echo '<td>';
		
        echo $amo = $rowsExp['expAmount'];
        $amt = $amo+$amt;
        echo '</td>';
        echo '</tr>';
    }
}
echo '<tr><th colspan="4" align="right" class="table-header-repeat">Total:</th><th class="table-header-repeat">'.$amt.'</th></tr>';
echo '</table>';
}
########################################### CAB PAYMENT RECORD ######################################################
elseif($srTy == "CAB"){
    
    $sqlCacB = mysql_query("SELECT  cp_cab_code,cp_mode,cp_bank_name,cp_card_no,cp_chq_no,cp_chq_iss_date,cp_payment_date,cp_payment_time,SUM(cp_amt_paid) FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' GROUP BY `cp_cab_code`");
    $countRe = mysql_num_rows($sqlCacB);
    echo '<table width="100%">';
    echo '<tr><td colspan="5" align="center" class=redM>Income Record Form '.$sDate.' To '.$eDate.'</td></tr>';
    echo '<tr><th class="table-header-repeat">Sl no.</th><th class="table-header-repeat">Cab Code</th><th class="table-header-repeat">Pay Mode</th><th class="table-header-repeat">Date/ Time</th><th class="table-header-repeat">Amount</th></tr>';
    if($countRe == 0){
         echo '<tr><td colspan="5" align="center"> <img src="images/cancel.png" width="26" height="26" align="absmiddle"/><br><b style="color:#CCC; font-size:20px;">No Record Found!</b></td></tr>';
    }
    $camnt = 0;
    $i = 1;
    while($rowCab = mysql_fetch_assoc($sqlCacB)){
         $t = $i++;
            echo '<tr ';

            if($t %2 == 0){
                    echo 'class="row-active"';
            }else{
                    echo 'class="row-inactive"';
            }

            echo '><td align="center">'.$t.'</td>';
            echo '<td>'.$rowCab['cp_cab_code'].'</td>';
            echo '<td>';

            $paYmo = $rowCab['cp_mode'];
            if($paYmo == 1){
                echo 'Cash';
            }elseif($paYmo == 2){
               echo 'Cheque<br><em><b>Bank:</b>'.$rowCab['cp_bank_name'].'<br><b>Ch. No.:</b>'.$rowCab['cp_chq_no'].'<br><b>Exp. Dat.:</b>'.$rowCab['cp_chq_iss_date'].'</em>'; 
            }elseif($paYmo == 3){
                echo 'Card<br><em><b>Card No.:</b>'.$rowCab['cp_card_no'];
            }
            else{
                echo 'N/A';
            }
            echo '</td><td>'.$rowCab['cp_payment_date'].' '.$rowCab['cp_payment_time'].'</td>';
            echo '<td>';
             echo $rowCab['SUM(cp_amt_paid)'];
             $camnt = $rowCab['SUM(cp_amt_paid)']+$camnt;
            echo '</td>';
            echo '</tr>';
    }
    echo '<tr><th colspan="4" align="right" class="table-header-repeat">Total:</th><th class="table-header-repeat">'.$camnt.'</th></tr>';

    echo '</table>';
}
############################################ END CAB PAY MENT HERE ###################################################
############################################ PROFIT AND LOSS STATMENT ################################################
elseif($srTy == "PAL"){
    $sqlPl = mysql_query("SELECT  cp_cab_code,SUM(cp_amt_paid) FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' GROUP BY `cp_cab_code`");
    $countPl = mysql_num_rows($sqlPl);
    echo '<table width="100%">';
    echo '<tr><td colspan="4" align="center" class=redM>Profit And Loss Statment Form '.$sDate.' To '.$eDate.'</td></tr>';
    echo '<tr><th width="15%" class="table-header-repeat">Sl. No.</th><th width="45%" class="table-header-repeat">Description</th><th width="25%" class="table-header-repeat">Credit [Rs.]</th><th width="25%" class="table-header-repeat">Debit [Rs.]</th>';
    if($countPl == 0){
         echo '<tr><td colspan="4" align="center"> <img src="images/cancel.png" width="26" height="26" align="absmiddle"/><br><b style="color:#CCC; font-size:20px;">No Record Found!</b></td></tr>';
    }
    //opning stock
    $openStock = 0;
    while($rowPl = mysql_fetch_array($sqlPl)){
	$openStock = $rowPl['SUM(cp_amt_paid)']+$openStock;
	}
   echo '<tr style="border-bottom: 1px #000000 dashed; padding: 3px;"><td><b>A)</b> </td><td colspan="2"><b>Opening Stock</b></td><td align="right">'.$openStock.'</td></tr>';
    //end opning stock
   $sqlDetExp = mysql_query("SELECT * FROM `expence` WHERE DATE_FORMAT(`expDate`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate'");
   if(mysql_query()){
    echo '<tr><td colspan="4" align="center"> <img src="images/cancel.png" width="26" height="26" align="absmiddle"/><br><b style="color:#CCC; font-size:20px;">No Record Found!</b></td></tr>';
   }
   else{
       $k = 1;
       $plAmnt = 0;
     while($roExPl = mysql_fetch_assoc($sqlDetExp)){
         $h = $k++;
         echo '<tr style="border-bottom: 1px #000000 dashed; padding: 3px;">';
         echo '<td align="center">'.$h.'</td>';
        echo '<td>';
        $exDetId = $roExPl['expDetails'];
        $sqlPeD2 = mysql_query("SELECT * FROM `expencedetails` WHERE `edId` = '$exDetId'");
                if(mysql_error()){
                  echo 'N/A';  
                }
                else{
                    $rol2 = mysql_fetch_assoc($sqlPeD2);
                    echo $rol2['exDetals'];
                }
        echo '</td>';
        echo '<td align="right">';
         $amo2 = $roExPl['expAmount'];
         printf("%.2f",$amo2);
        $plAmnt = $amo2+$plAmnt;
        echo '</td><td>&nbsp;</td>';
        echo '</tr>';
     }
     echo '<tr style="border-bottom: 1px #000000 dashed; padding: 3px;"><td><b>B)</b> </td><td colspan="1"><b>Total Expence</b></td><td align="right">';
      printf("%.2f",$plAmnt);
      echo '</td><td>&nbsp;</td></tr>';
   }
   $gp = $openStock-$plAmnt;
   echo '<tr ><th colspan="3" align="right" class="table-header-repeat">Net Profit</th><th align="right" class="table-header-repeat">'.$gp.'</th></tr>';
   echo '</table>';
}

############################################ END PROFIT AND LOSS STATMENT ###########################################
############################################ EMPLOYEE SALLERY STATEMENT #############################################
elseif($srTy == "EMP"){
    
}
############################################ END EMPLOYEE SALLERY STATEMENT #########################################
else{
   echo '<p align="center"><img src="images/cancel.png" width="26" height="26" align="absmiddle"/><br><b style="color:#CCC; font-size:20px;">Please select Valid Input!</b></p>';
}
?>
