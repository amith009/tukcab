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
require_once "../../core/php/connection.php";
$fun = $_GET['fun'];
$funCall = substr($fun,0,3);
if($funCall == "add"){
  $descp = "";
  $amnt = "";
  $payDat = date("Y-m-d");
  $pmo = 1;
  $chno = "";
  $bank = "";
  $chDat = date("Y-m-d");
  $card = "";
  $expId = "";
  $expWhom = "";
  $submit = "SAVE";
}
elseif($funCall == "del"){
 $expId = substr($fun,4);
 $sqlDel = mysql_query("DELETE FROM `expence` WHERE `expId` = $expId");
 if(mysql_error()){
   echo '<p align="center"> <img src="images/001_18.png" width="26" height="26" align="absmiddle"/><br><b style="color:#990000; font-size:20px;">Try Again!</b></p>';
 }else{
  echo ' <p align="center"><img src="images/001_19.png" width="26" height="26" align="absmiddle"/><br><b style="color:#009933; font-size:20px;">Success To Delete Record!</b></p>';
 }
}
else{
  $expId = substr($fun,4);
  $sqlTrc = mysql_query("SELECT * FROM `expence` WHERE `expId` = $expId");
  if(mysql_error()){
     echo 'No Record Found';
  }else{
  $roEx = mysql_fetch_assoc($sqlTrc);
      $descp = $roEx['expDetails'];
	  $amnt = $roEx['expAmount'];
	  $payDat = substr($roEx['expDate'],0,10);
	  $pmo = $roEx['expPayMode'];
	  $chno = $roEx['expChqeNo'];
	  $bank = $roEx['expBank'];
	  $chDat = $roEx['expchqDate'];
	  $card = $roEx['expCardNo'];
          $expWhom = $roEx['expWhom'];
	  $submit = "UPDATE";
  }
}
if($funCall == "del"){
}else{
?>
<form id="expenceaddform" name="frmCreateCustomer" method="post" action="../master/php/addExpence.php?acf=<?php echo $submit; ?>">
    <input type="hidden" value="<?php echo $expId; ?>" name="expId" />
     <input type="hidden" value="<?php echo $submit; ?>" name="pass" />
<table width="100%">
    <tr><th colspan="2" class="table-header-repeat" align="left">
	<?php
	if($funCall == "add"){
	echo 'Add New Record!';
	}else{
	echo 'Update Record!';
	}
	?>
	</th></tr>
    <tr class="row-inactive"><td>Description :</td><td>
            <select name="descp">
            <?php
            if($funCall == "edi"){
                $sqlPeD = mysql_query("SELECT * FROM `expencedetails` WHERE `edId` = '$descp'");
                if(mysql_error()){
                  echo '<option value="">No Record Found!</option>';  
                }
                else{
                    $rol = mysql_fetch_assoc($sqlPeD);
                    echo '<option value="'.$rol['edId'].'">'.$rol['exDetals'].'</option>';
                }
                echo '<option disable >-------------------------</option>';
            }
            $sqlPe = mysql_query("SELECT * FROM `expencedetails` WHERE `status` = 1");
            if(mysql_query()){
                echo '<option value="">No Record Found!</option>';
            }else{
                while($ropE = mysql_fetch_assoc($sqlPe)){
                echo '<option value="'.$ropE['edId'].'">'.$ropE['exDetals'].'</option>';
                }
            }
            ?>
            </select>
            </td></tr>
     <tr class="row-active"><td>Amount :</td><td>
             <input type="text" name="amnt" class="required number" <?php if($funCall != "add"){ echo 'value="'.$amnt.'"';}else{} ?> style="text-align: right; width: 120px;" /><img src="images/rs.png" width="16" height="16" align="absmiddle"/></td></tr>
      <tr class="row-inactive"><td>Date</td><td><input type="text" <?php if($funCall != "add"){ echo 'value="'.$payDat.'"';}else{} ?> id="nextDueDate" name="startDate" class="required" />
                        </td></tr>
       <tr class="row-inactive"><td>To whom</td><td><input type="text" value="<?php echo $expWhom; ?>" name="expWhom"  />
                        </td></tr>
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
    <td><input name="chno" type="text" value="<?php echo $chno; ?>" /></td>
  </tr>
  <tr id="bank" class="row-active">
    <td>Bank Name : </td>
    <td><input name="bank" type="text" value="<?php echo $bank; ?>" /></td>
  </tr>
   <tr id="chequeDate" class="row-inactive">
    <td>Cheque issue Date:</td>
    <td><input name="chdate" id="chequeDateCal" type="text" value="<?php echo $chDat; ?>" />  <em>YYYY-MM-DD</em></td>
  </tr>
  <tr id="card" class="row-active">
    <td>Card Number</td>
    <td><input name="card" type="text" value="<?php echo $card; ?>" /></td>
  </tr>
       <tr><th colspan="2">
               <input type="submit"  name="submit" class="NavButton" value="<?php echo $submit; ?>" />
           </th></tr>
</table>
</form>
<?php
}
?>
<script language="javascript">
    $("#expenceaddform").validate();
  
togglePaymentFields('<?php echo $pmo; ?>');
         
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
