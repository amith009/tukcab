<?php
/*
File Name: starting-pay-amount.php
Work and function: this is back end file for starting-pay-amount.php (location: php/)
in this file we just track only deposit amount and stkering charge amount

table call "cab_deposite"

as per cab id call query

##########
Create date = 28 NOV 2011
Time: 02:07
Last Update:
Date: 28 NOV 2011
Time: 02:07
Author Name: amit kumar
*/

require_once "../../core/php/connection.php";

$cabId = $_GET['cbId'];
$doj = $_GET['doj'];
	 //$cabId = "INV1";
	 //$doj = "2011-11-11";
	 
	   //fetch deposite amount
	   $sqlDep = mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cabId'");
       $couDop = mysql_num_rows($sqlDep);
	   if($couDop == 0){
		   echo 'ERROR: Enable to read cab code!!'.$cabId;
	   }else{
		   $roDop = mysql_fetch_assoc($sqlDep);
		   $deopAmnt = $roDop['cd_deposite_amount'];
		   $stkrAmnt = $roDop['cd_sticker_charge'];
		   $ccAmnt = $roDop['cd_call_center_charge'];
		   $cabTop = sprintf("%01.2f",$roDop['cabTopAmount']);
                   $dd = date('d');
                   $mm = date('m');
                   $yy = date('Y');
                   $num = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
                   
                   $amPer = $ccAmnt/$num;
                   $amnt = sprintf("%01.2f", $amPer);
                   
                   $resDay = $num-$dd;
                   $payAmnt = $amnt*$resDay;
                   $preAmnt = sprintf("%01.2f",$payAmnt);
                   
	 //end here
?>
<script language="javascript">
	function calculateAmount(){
		var subTtl = document.getElementById('subTtl'); //subtotal
		var dop = document.getElementById('dop'); //deposite amount
		var stkAmt = document.getElementById('stkAmt'); //Sticker Amount
		var cccAmt = document.getElementById('cccAmt'); //CCC amount
		var srvTax = document.getElementById('srvTax'); //service tax
		var amntPay = document.getElementById('amntPay'); //amount to be paid
		var depAmt = document.getElementById('depAmt'); //deposite amount paid
		var stkAmtPaid = document.getElementById('stkAmtPaid'); //sticker amount paid
		var disAmt = document.getElementById('disAmt'); //discount
		
		dop.value = dop.value==''?'0.00':dop.value;
		subTtl.value = subTtl.value==''?'0.00':subTtl.value;
		stkAmt.value = stkAmt.value==''?'0.00':stkAmt.value;
		cccAmt.value = cccAmt.value==''?'0.00':cccAmt.value;
		depAmt.value = depAmt.value==''?'0.00':depAmt.value;
		stkAmtPaid.value = stkAmtPaid.value==''?'0.00':stkAmtPaid.value;
		disAmt.value = disAmt.value==''?'0.00':disAmt.value;
		
		if(srvTax){
			stkAmt.value = stkAmt.value==''?'0.00':stkAmt.value;
			subTtl.value = (parseFloat(dop.value)+parseFloat(stkAmt.value)+parseFloat(cabTop.value)+parseFloat(cccAmt.value)+parseFloat(srvTax.value)).toFixed(2);
		}else
			subTtl.value = (parseFloat(dop.value)+parseFloat(stkAmt.value)+parseFloat(cabTop.value)+parseFloat(cccAmt.value)).toFixed(2);
		//deductions
		amntPay.value = (parseFloat(subTtl.value)+(parseFloat(depAmt.value)+parseFloat(stkAmtPaid.value)-parseFloat(disAmt.value))).toFixed(2);
	}
</script>
<form name="frmCreateStartPay" id="frmStarPay" method="post" action="../master/php/calculate-starting-pay.php">
  <table width="100%" id="product-table">
  <tr class="row-active">
    <td>Cab Code:</td>
    <td><img src="images/red_car.png" width="16" height="16" align="absmiddle">
      <input type="text" name="cabid" value="<?php echo $cabId; ?>" readonly>
    <input type="hidden" name="doj" value="<?php echo $_GET['doj']; ?>" />
    </b></td>
  </tr>
  <tr class="row-inactive">
    <td>Deposite Amount :</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle">
	<input name="dop" type="text" id="dop" style=" text-align:right;" <?php if($couDop == 0){}else{echo 'value="'.$deopAmnt.'"';} ?> readonly="readonly"  /></td>
  </tr>
  <tr class="row-active">
    <td>Deposite Amount Paid:</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle">
	<input name="doppay" id="depAmt" type="text"  style=" text-align:right;" class="number"  /></td>
    </tr>
  <tr class="row-inactive">
    <td>Sticker Amount :</td>
    <td>
    <img src="images/rs.png" width="13" height="13" align="absmiddle">
    <input name="stkr" id="stkAmt" type="text"  style=" text-align:right;"  <?php if($couDop == 0){}else{echo 'value="'.$stkrAmnt.'"';} ?>  readonly="readonly"  /></td>
  </tr>
  <tr class="row-inactive">
    <td>Cab top Amount:</td>
    <td>
    <img src="images/rs.png" width="13" height="13" align="absmiddle">
    <input name="cabTop" id="cabTop" type="text"  style=" text-align:right;"  <?php if($cabTop == 0){}else{echo 'value="'.$cabTop.'"';} ?>  readonly="readonly"  /></td>
  </tr>
   <tr class="row-active">
     <td>Sticker Amount Paid:</td>
     <td><img src="images/rs.png" width="13" height="13" align="absmiddle">
	 <input name="stkrpay" id="stkAmtPaid" type="text"  style=" text-align:right;" class="number" /></td>
    </tr>
   <tr class="row-inactive">
     <td>Fix CCC Amount  : <?php if($couDop == 0){}else{echo $ccAmnt;} ?> </td>
     <td>
     <img src="images/rs.png" width="13" height="13" align="absmiddle">
     <input name="amntr" id="cccAmt" <?php if($couDop == 0){}else{echo 'value="'.$payAmnt.'"';} ?> type="text" style="text-align:right;" class="number" />
     </td>
   </tr>
   <?php
  
   $srvTax = $roDop['cd_service_charge'];
   $taxTotal = 0;
   if($srvTax == 1){
	   $sqSrv = mysql_query("SELECT as_srv_type,status FROM `account_seeting` WHERE `status` = 1");
	   if($sqSrv == TRUE){
		   $rac = mysql_fetch_assoc($sqSrv);
		   $srvAmnt = $rac['as_srv_type'];
		   $perTax = (($preAmnt*$srvAmnt)/100);
                   $taxTotal = sprintf("%01.2f",$perTax);
	   }
   ?>
   <tr class="row-active">
     <td>Services Tax:</td>
     <td><img src="images/rs.png" width="13" height="13" align="absmiddle">    
        <input name="srv" id="srvTax" type="text" style=" text-align:right;" <?php if($couDop == 0){}else{echo 'value="'.$taxTotal.'"';} ?> class="number"  />
     </td>
   </tr>
   <?php
   }//else close here
   
   //calculate total amount need to pay
   $prNee = $deopAmnt+$stkrAmnt+$preAmnt+$taxTotal;
   $neePay = sprintf("%01.2f",$prNee);
   //end here
   ?>
  <tr class="row-inactive">
    <td>Sub Total:</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle">  
        <input name="amntr" id="subTtl" type="text" style=" text-align:right;"  <?php if($couDop == 0){}else{echo 'value="'.$neePay.'"';} ?> class="number" />
      
        </td>
  </tr>
  <tr class="row-active">
    <td>Discount:</td>
    <td>
    <img src="images/rs.png" width="13" height="13" align="absmiddle">   
       <input name="disco" id="disAmt" type="text"  class="number" style=" text-align:right;"  />
    </td>
  </tr>
  <tr class="row-inactive">
    <td>Amount to be Paid:</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle"> 
         <input name="amntPay" type="text" id="amntPay" style=" text-align:right;" class="number"  /><input type="button" value="Calculate" onclick="calculateAmount();" /></td>
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
    <td>Next Due Date:</td>
    <td><input name="date" id="nextDueDate" type="text" value="<?php echo date("Y-m-d"); ?>" />  <em>YYYY-MM-DD</em></td>
  </tr>
  <tr class="row-active">
    <td colspan="2" align="right"><input name="submit" type="submit" class="myButton" value=" save " /></td>
  </tr>
</table>
</form>
<?php
}//main else close here
?>
<script language="javascript">
togglePaymentFields('1');
$("#frmStarPay").validate();
$( "#chequeDateCal" ).datepicker({
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
</script>