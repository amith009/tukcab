<?php

/***********************************************************
 * Author Amit Kuamr.
 * Date: 03-01-12
 * functions: this is fronted file for generated reporting for monthelly and yearelly reports
 */
//sassion_start();
require_once "../../core/php/connection.php";
session_start();
$emp_type = $_SESSION['EMP_TYPE'];
?>
<script type="text/javascript">
var keepPopup = false;
function keepAlive(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}
function showAction(str)
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
function setVisibility(obj, id, visibility) {
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
$sd = $_GET['sDate'];
$ed = $_GET['eDate'];
$cabId = $_GET['cabId'];

if($cabId == "0"){
    $val = "";
}else{
  $val = " AND `cp_cab_code` = '$cabId'";
}
//echo $mm;
$sqlCabPay = "SELECT * FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' $val GROUP BY `cp_cab_code` ORDER BY `cp_cab_code`";
$resCab = mysql_query($sqlCabPay);
if($resCab == TRUE){
    $i = 1;
     echo '<table width="100%" cellspacing="0" id="product-table">';
     echo '<tr>';
     echo '<th class="table-header-repeat">Sl No.</th>';
     echo '<th class="table-header-repeat">Cab Code.</th>';
     echo '<th class="table-header-repeat">Pay Date</th>';
     echo '<th class="table-header-repeat">History</th>';
     echo '<th class="table-header-repeat">Total Amount</th>';
     echo '<th class="table-header-repeat">Pay Amount</th>';
     echo '<th class="table-header-repeat">Discount</th>';
     echo '<th class="table-header-repeat">Balance</th>';
     echo '<th class="table-header-repeat">For Month & Year</th>';
     echo '<th class="table-header-repeat">Pay Mode</th>';
     
     echo '</tr>';
     $countRe = mysql_num_rows($resCab);
     if($countRe == 0){
        echo '<tr><td align="center" colspan="9"><div><img src="images/001_11.png" width="24" height="24"><br><b>No Record Found!</b></div></td></tr>';
     }
     $topay = 0;
     $tobal = 0;
     $toAmPay = 0;
     $todis = 0;
 while($rwoPay = mysql_fetch_assoc($resCab)){
          $t = $i++;
     echo '<tr align="center" ';
   
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   
	echo '>';
     echo '<td align="center" valign="top">';
     
     echo $t;
     echo '</td>';
     echo '<td align="center" valign="top">';
    
     $p = $t;
     $cabCode = $rwoPay['cp_cab_code'];
     ?>

     <a href="#" onClick="keepAlive(this,'sub<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub<?php echo $p; ?>', 'none');">
     <?php echo $cabCode; ?>
     </a>
             <div id="sub<?php echo $p; ?>" class="popup">
                 <?php
                 $sqlDep = mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cabCode'");
                 if(mysql_error()){
                     echo 'No Record Found!!';
                 }else{
                     $rowDep = mysql_fetch_array($sqlDep);
                     echo '<table width="100%" cellspacing="0" id="product-table">';
                     echo '<tr class="row-active"><td><b>Deposit Amount:</b></td><td>'.$rowDep['cd_deposite_amount'].'</td></tr>';
                     echo '<tr class="row-inactive"><td><b>Pay in Deposit Amount:</b></td><td>'.$rowDep['cd_received_deposite'].'</td></tr>';
                     echo '<tr class="row-active"><td><b>Deposit Amount Ref. :</b></td><td>'.$rowDep['cd_deposite_refed'].'</td></tr>';
                     echo '<tr class="row-inactive"><td><b>Sticker Amount:</b></td><td>'.$rowDep['cd_sticker_charge'].'</td></tr>';
                     echo '<tr class="row-active"><td><b>Sticker Amount Paid:</b></td><td>'.$rowDep['cd_sticker_charge_paid'].'</td></tr>';
                     echo '<tr class="row-inactive"><td><b>Call Center Charge:</b></td><td>'.$rowDep['cd_call_center_charge'].'</td></tr>';
                     echo '<tr class="row-active"><td><b>Services Tax:</b></td><td>'.$rowDep['cd_service_charge'].'</td></tr>';
                     echo '</table>';
                 }
                 ?>
             </div>
     <?php
         $l = $t++;    
     echo '</td>';
     echo '<td align="center" valign="top">'.$rwoPay['cp_payment_date'].'<br>'.$rwoPay['cp_payment_time'].'</td>';
     echo '<td align="center" valign="top">';
     ?>
       <a href="#" onClick="keepAlive(this,'sub1<?php echo $l; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $l; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $l; ?>', 'none');">
     SHOW
     </a>
        <div id="sub1<?php echo $l; ?>" class="popup" style="width:500px; font-size:11px;">
        <?php
            echo '<table width="100%" id="product-table">';
            //echo '<tr><th colspan="5">Amount pay record</th></tr>';
            echo '<tr>
                <th class="table-header-repeat">Pay Date</th>
                <th class="table-header-repeat">Opp Id</th>
                <th class="table-header-repeat">Amount</th>
                <th class="table-header-repeat">Comment</th>
                <th class="table-header-repeat">Next due date</th>
                </tr>';
				//echo "SELECT cp_cab_code,cp_balance,cp_amt_paid,cp_payment_date,cp_next_due_date FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' $vals AND `cp_cab_code` = '$cabCode'";
				$showQuer = mysql_query("SELECT cp_cab_code,cp_balance,cp_amt_paid,cp_payment_date,cp_next_due_date FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' $vals AND `cp_cab_code` = '$cabCode'");
                $x=1;
                while($showRow = mysql_fetch_assoc($showQuer)){
                    $cabAppId = $showRow['cp_cab_code'];
                    $v = $x++;
                    $sqlHis = mysql_query("SELECT * FROM `app_log` WHERE `al_log_type` = 'CMP' AND `al_log_code` = '$cabAppId' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' $vals");
                    $roHis = mysql_fetch_assoc($sqlHis);
                   echo '<tr ';
                   if($v %2 == 0){
		echo 'class="row-active"';
                }else{
		echo 'class="row-inactive"';
                }
                   echo '>';
                   echo '<td>'.$showRow['cp_payment_date'].'</td>';
                   echo '<td>';
                   $empId = $roHis['al_emp_id'];
                    $sqlEmp = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$empId'");
                    $roEmp = mysql_fetch_assoc($sqlEmp);
                    echo $roEmp['emp_name'];
                   echo '</td>';
                   echo '<td>'.$showRow['cp_amt_paid'].'</td>';
                   echo '<td>'.$roHis['al_comment'].'</td>';
                   echo '<td>'.$showRow['cp_next_due_date'].'</td>';
                   echo '</tr>';
                }
            echo '</table>';
        
        ?>
        </div>
<?php
echo '</td>';
     echo '<td align="center" valign="top">';
     echo $atp = $rwoPay['cp_amt_to_pay'];
     $topay = $atp + $topay;
     echo '</td>';
     echo '<td align="center" valign="top">';
     // Amount Caculation
     $samt = 0;
     $sqlAmt = mysql_query("SELECT cp_balance,cp_amt_paid,cp_payment_date FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' AND `cp_cab_code` = '$cabCode'");
     if(mysql_error()){
         echo 'N/A';
     }
     $z=$l++;
     while($rosAmt = mysql_fetch_assoc($sqlAmt)){
         
        $ampay = $rosAmt['cp_amt_paid'];
         $samt = $samt+$ampay;
     }
     $amtSd = $rwoPay['cp_amt_paid'];
     
    
    echo  $pasAmou = $samt;
     $toAmPay = $pasAmou + $toAmPay;
     
     echo '</td>';
     echo '<td align="center" valign="top">';
     echo $tdo =  $rwoPay['cp_discount'];
     $todis = $tdo + $todis;
     echo '</td>';
     echo '<td align="center" valign="top">';
     //echo "SELECT max(cp_cab_id),cp_balance FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m') = '$date' AND `cp_cab_code` = '$cabCode'";
     $sqlBaln = mysql_query("SELECT cp_balance FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m-%d') BETWEEN '$sd' AND '$ed' AND `cp_cab_code` = '$cabCode' ORDER BY `cp_cab_id` DESC");
     if(mysql_error()){
         echo 'N/A';
     }
     $rowsBanl = mysql_fetch_assoc($sqlBaln);
     $tbl = $rowsBanl['cp_balance'];
     if($tbl == "0.00"){
         echo $tbl;
     }else{
         echo '<span style="color:#ea4d2e; font-weight:bold;">'.$tbl.'</span>';
     }
     $tobal = $tbl + $tobal;
     echo '</td>';
     echo '<td align="center" valign="top">';
     $dat = $rwoPay['cp_payment_date'];
     $mm = substr($dat,5,2);
		  if($mm == "1"){
		echo 'January';
			}
			elseif($mm == "2"){
				echo 'February';
			}
			elseif($mm == "3"){
				echo 'March';
			}
			elseif($mm == "4"){
				echo 'April';
			}
			elseif($mm == "5"){
				echo 'May';
			}
			elseif($mm == "6"){
				echo 'June';
			}
			elseif($mm == "7"){
				echo 'July';
			}
			elseif($mm == "8"){
				echo 'August';
			}
			elseif($mm == "9"){
				echo 'September';
			}
			elseif($mm == "10"){
				echo 'October';
			}
			elseif($mm == "11"){
				echo 'November';
			}
			elseif($mm == "12"){
				echo 'December';
			}
			else{
			//do nithink
			}
                        echo '<br>'.substr($dat,0,4);
     echo '</td>';
          
     echo '<td align="center" valign="top">';
     $pay = $rwoPay['cp_mode'];
     if($pay == 1){
         echo 'Cash';
     }
     elseif($pay == 2){
         echo 'Chaque No.'.$rwoPay['cp_chq_no'].'<br>';
          echo 'Bank Name.'.$rwoPay['cp_bank_name'].'<br>';
           echo 'Chaque No.'.$rwoPay['cp_chq_iss_date'];
     }elseif($pay == 3){
         echo 'Card No.'.$rwoPay['cp_card_no'];
     }
     else{
         echo 'N/A';
     }
     echo '</td>';

     echo '</tr>';
     
 }//while close
 if($emp_type == 7 || $emp_type == 5){
     //do nothink
 }else{
 echo '<tr>';
     echo '<th class="table-header-repeat">&nbsp;</th>';
     echo '<th class="table-header-repeat">&nbsp;</th>';
     echo '<th class="table-header-repeat">&nbsp;</th>';
      echo '<th class="table-header-repeat">TOTAL:</th>';
     echo '<th class="table-header-repeat">'.$topay.'</th>';
     echo '<th class="table-header-repeat">'.$toAmPay.'</th>';
      echo '<th class="table-header-repeat">'.$todis.'</th>';
     echo '<th class="table-header-repeat">'.$tobal.'</th>';    
    
     echo '<th class="table-header-repeat">&nbsp;</th>';
     echo '<th class="table-header-repeat">&nbsp;</th>';
     echo '</tr>';
 }
 echo '</table>';
}


?>
