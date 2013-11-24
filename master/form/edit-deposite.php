<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT cab_id,cab_code FROM `cabs` WHERE `cab_id` = $id");
if(mysql_error()){
	echo 'Unable to track Cab Code';
}else{
	$roCb = mysql_fetch_assoc($sqlCab);
	$cabCode = $roCb['cab_code'];
$sqlDep= mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cabCode'");
if(mysql_error()){
	echo 'No Record Found!!';
}else{
	 $roDp = mysql_fetch_assoc($sqlDep);
?>
<form name="frmCreateStartPay" id="frmStarPay" method="post" action="../master/php/edit-cab-deposite.php">
    <input type="hidden" value="<?php echo $cabCode; ?>" name="id" />
<table width="100%" id="product-table">
  <tr class="row-inactive">
    <td width="14%">Deposite Amount:</td>
    <td width="32%"><img src="images/rs.png" width="13" height="13" align="absmiddle" />
      <input name="depAmnt" type="text" class="number" style="text-align:right;" value="<?php echo $roDp['cd_deposite_amount']; ?>" /></td>
    <td width="25%">Refundable:</td>
    <td width="29%"><select name="dopRef">
    <?php
	$ds = $roDp['cd_deposite_refed'];
	if($ds == 1){
		echo '<option value="1">Yes</option>';
	}else{
		echo '<option value="0">No</option>';
	}
	?>
      <option value="0" disabled>---------------</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select></td>
  </tr>
  <tr class="row-active">
    <td>Active Amount:</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
      <input name="activAmnt" type="text" class="number required" style="text-align:right;" value="<?php echo $roDp['cd_call_center_charge']; ?>"/></td>
    <td>Services Tax:</td>
    <td><select name="srvTax">
    <?php
	$srv = $roDp['cd_service_charge'];
	if($srv == 1){
		echo '<option value="1">Yes</option>';
	}else{
		echo '<option value="0">No</option>';
	}
	?>
      <option value="0" disabled>-----------</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select></td>
  </tr>
  <tr class="row-active">
    <td>Cab Top:</td>
    <td><select name="cabtop">
      <option value="0">Select</option>
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select></td>
    
    <td >Cab Top Amount</td>
    <td ><img src="images/rs.png" width="13" height="13" align="absmiddle" />
	<input type="text"  name="cabtopamt" class="number" value="<?php echo $roDp['cabTopAmount']; ?>"/></td>
    
  </tr>
  <tr class="row-inactive">
    <td> Sticker Charge:</td>
    <td><select name="stkrSrv">
     <?php
	 $stkr = $roDp['cd_sticker_charge'];
	 if($stkr == 0){
		 echo '<option value="0">No</option>';
	 }else{
		 echo '<option value="1">Yes</option>';
	 }
	 ?>
      <option disabled>------------</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select></td>
    <td >Sticker Amount:</td>
    <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
      <input name="stkrAmnt" type="text" class="number" style="text-align:right;" value="<?php echo $roDp['cd_sticker_charge']; ?>" /></td>
  </tr>
  
  <tr class="row-active">
    <td colspan="4" align="right"><input type="submit"  value="Save" class="NavButton" /></td>
  </tr>
</table>
</form>
<?php
	}
}
?>