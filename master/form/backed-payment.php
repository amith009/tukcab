<?php 
/***************************************************************************************
File Name: make-payment.php
Work and function: monthelly payment add into database

Create date = 29 NOV 2011
Time: 03:24
Last Update:
Date: __ NOV 2011
Time: __:__
Author Name: amit kumar
*******************************************************************************************/
require_once "../../core/php/connection.php";
$cabId = $_POST['cabId'];
$cabMonth = $_POST['cbaMonth'];
$cabYear = $_POST['cabYear'];
$date = $cabYear.'-'.$cabMonth;
$sqlCab = mysql_query("SELECT cab_id,cab_code,doj FROM `cabs` WHERE `cab_id` = $cabId");
if(mysql_error()){
	//do nothink
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
	$cbCode = $roCab['cab_code'];
	$sqlDepo = mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cbCode'");
	if(mysql_error()){
		echo 'ERROR: Unable to Ready Deposite Amount!';
	}else{
		$roDop = mysql_fetch_assoc($sqlDepo);
		
		$intDep = $roDop['cd_deposite_amount'];
		$intDepPaid = $roDop['cd_received_deposite'];
		
		if($intDep == $intDepPaid){
			$needPaid = "0.00";
		}else{
		    $needPaid = $intDep - $intDepPaid;
		}
		//stker amount
		$stkDep = $roDop['cd_sticker_charge'];
		$stkPaid = $roDop['cd_sticker_charge_paid'];
		if($stkDep == $stkPaid){
			$skrPay = "0.00";
		}else{
		$skrPay = $stkDep-$stkPaid;
		}
		
		$sqlLast = mysql_query("SELECT  cp_balance,cp_cab_code,DATE_FORMAT(cp_payment_date, '%Y-%m') FROM `cab_payment` WHERE `cp_cab_code` = '$cbCode' AND DATE_FORMAT(cp_payment_date, '%Y-%m') = '$date' AND cp_cab_id = (SELECT MAX(cp_cab_id) FROM cab_payment WHERE `cp_cab_code` = '$cbCode')");
		
		$countCp = mysql_num_rows($sqlLast);
		if($countCp == 0){
			//deposit amount
		
		$cccamnt = $roDop['cd_call_center_charge'];
		$servCon = $roDop['cd_service_charge'];
		if($servCon == 1){
			$sqlServ = mysql_query("SELECT as_srv_type,status FROM `account_seeting` WHERE `status` = 1");
			if(mysql_error()){
				echo 'ERROR: Unable to read Services Charge!';
				$servTax = 0;
			}else{
				$roSev = mysql_fetch_assoc($sqlServ);
				$sePer = $roSev['as_srv_type'];
				$servTax = (($cccamnt*$sePer)/100);
			}
		  }else{
		  	$servTax = 0;
		  }
		  //track last month blanace
		  $lastMm = $cabMonth-1;
                  $comonth = strlen($lastMm);
                  if($comonth == 2){
                    $lastDate = $cabYear.'-'.$lastMm;  
                  }else{
                      $lastDate = $cabYear.'-0'.$lastMm;
                  }
		 $sqlLastMont = mysql_query("SELECT  cp_balance,cp_cab_code,DATE_FORMAT(`cp_payment_date`, '%Y-%m') FROM `cab_payment` WHERE `cp_cab_code` = '$cbCode' AND DATE_FORMAT(`cp_payment_date`, '%Y-%m') = '$lastDate' AND cp_cab_id = (SELECT MAX(cp_cab_id) FROM cab_payment WHERE `cp_cab_code` = '$cbCode')");
		 $counLastMonth = mysql_num_rows($sqlLastMont);
		 if($counLastMonth != 0){
			 $ropl = mysql_fetch_assoc($sqlLastMont);
			 $balance = $ropl['cp_balance'];
			 }else{
			   $balance = "0.00";
			 }
		 //calculate CCC Amount for days remaining in the month
		 $cabDoj = $roCab['doj'];
		 $dojMonth = substr($cabDoj,0,7);
		 $curMonth = $date;
		 if($dojMonth == $curMonth){
			$curDay = date('d');
			$daysLeft = 30 - $curDay;
			$cccamnt = ceil(($cccamnt/30) * $daysLeft);
		 }
		 }else{
			  $cccamnt = 0;
			  $servTax = 0;	
                          $roLast = mysql_fetch_assoc($sqlLast);
			  $balance = $roLast['cp_balance'];
	}
	}//cab payment else close
}//cab deposit else close

 ?> 
 <form name="frmCreateStartPay" id="frmStarPay" method="post" action="../master/php/monthelly-pay-amount.php">
 <input type="hidden" id="cabPayMonth" name="cabPayMonth"/>
<table width="100%" border="0" align="center" id="product-table" >
  <tr class="row-inactive">
      <input type="hidden" value="<?php echo $cbCode; ?>" readonly="readonly" name="cabId" />
    <th colspan="2" class="table-header-repeat">Selected Cab Code is <?php echo $cbCode; ?> </th>
     </tr>
  <tr class="row-active">
    <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Current Month Charge</b></td>
  </tr>
  <tr class="row-inactive">
    <td>CCC amount.</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />      <input type="text" value="<?php echo $cccamnt; ?>" class="number" id="cabPayCCC" readonly/>
    <?php 
    $curMonth = date("m"); 
    if($curMonth == $cabMonth){
        if($cccamnt==0) echo "<span style=\"background: url(images/alert.png) no-repeat left #ff0000;color:#fff;padding:10px;padding-left: 33px;\">&nbsp;CCC Paid for the month</span>";
    }
    ?>
   </td>
  </tr>
  <tr class="row-active">
    <td>Service Tax.</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />      <input type="text" value="<?php echo $servTax; ?>" class="number" id="cabPaySrvTax" readonly/></td>
  </tr>
  <tr class="row-inactive">
    <td>Sub Total</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />      <input type="text" value="<?php echo $subTotal = $cccamnt+$servTax; ?>" class="number" id="cabPaySubTotal" readonly/></td>
  </tr>
  <tr class="row-active">
    <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Balance for Cab</b></td>
  </tr>
  <tr class="row-inactive">
    <td>Initial Deposit Balance [ <img src="images/rs.png" width="13" height="13" align="absmiddle" /> <?php echo $needPaid;?>]</td>
    <td>  
      <img src="images/rs.png" width="13" height="13" align="absmiddle" /><input type="text" name="depoAmnt" value="<?php echo $needPaid;?>" class="number" id="cabPayInitDepoBalance" /></td>
  </tr>
  <tr class="row-active">
    <td>Sticker Charge Balance [<img src="images/rs.png" width="13" height="13" align="absmiddle" />  <?php echo $skrPay; ?>]</td>
    <td> 
        <img src="images/rs.png" width="13" height="13" align="absmiddle" /><input type="text" name="depostkr" value="<?php echo $skrPay; ?>" class="number" id="cabPayStkrBalance" /></td>
  </tr>
  <tr class="row-inactive">
    <td>Last Month Balance</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" /> 
        <input type="text" name="balance" value="<?php echo $balance; ?>" class="number" id="cabPayLastMonthBalance" readonly/>
    <?php 
    $curMonth = date("m"); 
    if($curMonth == $cabMonth){
        if($balance!=0)  echo "<span style=\"background: url(images/alert.png) no-repeat left #ff0000;color:#fff;padding:10px;padding-left: 33px;\">&nbsp;Balance for the month</span>"; 
   }
    ?>
    </td>
  </tr>
  <tr class="row-active">
    <td>Net Total</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />  
        <input name="netPay" type="text" class="number"  value="<?php echo $netTotal = $subTotal+$needPaid+$skrPay+$balance; ?>" id="cabPayNetTotal" readonly /></td>
  </tr>
   <tr class="row-inactive">
    <td>Discount Amount</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
      <input type="text" name="discount" value="0.00" class="number" id="cabPayDiscount"/><input type="submit" value="Calculate" onClick="calculateCabAmount();return false;"/></td>
  </tr>
  <tr class="row-active">
    <td>Amount To Pay</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />      <input type="text" name="payAmnt" value="0.00" class="number" id="cabPayPayAmount" /></td>
  </tr>
  <tr class="row-active">
    <td>Payment Mode:</td>
    <td>
    <select name="pmo" id="pmo" onchange="togglePaymentFields(this.value);">
        <option value="1">Cash</option>
        <option value="2">Cheque</option>
        <option value="3">Credit</option>
      </select>
    </td>
  </tr>
  <tr id="chno" class="row-inactive">
    <td>Cheque no: </td>
    <td><input name="chno" type="text"/></td>
  </tr>
  <tr id="bank" class="row-active">
    <td>Bank Name : </td>
    <td><input name="bank" type="text"/></td>
  </tr>
   <tr id="chequeDate" class="row-inactive">
    <td>Cheque issue Date:</td>
    <td><input name="chdate" id="chequeDateCal" type="text" value="<?php echo date("Y-m-d"); ?>" />  <em>YYYY-MM-DD</em></td>
  </tr>
  <tr id="card" class="row-active">
    <td>Card Number</td>
    <td><input name="card" type="text"/></td>
  </tr>
   <tr class="row-inactive">
    <td>Payment Date:</td>
    <td><input name="payDate" id="payDate" type="text" value="" class="required" />
      <em>YYYY-MM-DD</em></td>
  </tr>
  <tr class="row-active">
    <td>Next Due Date:</td>
    <td>
        <?php
          $curMm = date("m")+1;
          $datYy = date("Y");
          //$datDd = date("d");
          $dueDa = $datYy."-".$curMm."-01";
        ?>
        <input name="dueDate" id="nextDueDate" type="text" value="<?php  echo $dueDa; ?>" />  <em>YYYY-MM-DD</em></td>
  </tr>
  <tr class="row-inactive">
    <td valign="top">Comment:</td>
    <td><textarea name="comment" class="required" rows="4" cols="35"></textarea></td>
  </tr>
  <tr class="row-inactive"> 
    <td colspan="2" align="right"><input type="submit" name="submit" value=" SAVE " class="myButton" /></td>
  </tr>
</table>
</form>

<script language="javascript">
$("#frmStarPay").validate();
$("#cabPayMonth").val($("#cabYer").val()+'-'+$("#cabMon").val());
togglePaymentFields('1');
$("#frmStarPay").validate();
$( "#chequeDateCal" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "yy-mm-dd"
});
$( "#payDate" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "yy-mm-dd"
});
$( "#nextDueDate" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "yy-mm-dd"
});
function togglePaymentFields(mode){
	switch(mode){
		case '1':
			$("#chno").hide();
			$("#bank").hide();
			$("#chequeDate").hide();
			$("#card").hide();
			break;
		case '2':
			$("#chno").show();
			$("#bank").show();
			$("#chequeDate").show();
			$("#card").hide();
			break;
		case '3':
			$("#chno").hide();
			$("#bank").hide();
			$("#chequeDate").hide();
			$("#card").show();
	}
}
function getValue(str){
	var val = parseFloat(str);
	if(!val) return 0;
	return val;
}
function calculateCabAmount(){
	var subTotal = getValue($("#cabPayCCC").val())+getValue($("#cabPaySrvTax").val());
	var netTotal = subTotal+getValue($("#cabPayInitDepoBalance").val())+getValue($("#cabPayStkrBalance").val())+getValue($("#cabPayLastMonthBalance").val());
	var amountPay = netTotal-parseFloat($("#cabPayDiscount").val());
	$("#cabPaySubTotal").val(subTotal);
	$("#cabPayNetTotal").val(netTotal);
	$("#cabPayPayAmount").val(amountPay);
}
</script>