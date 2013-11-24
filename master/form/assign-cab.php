<?php
session_start();
require_once "../../core/php/connection.php";
$type = $_GET['type'];
$passVal = substr($type,0,2);
$date = date("Y-m-d");
$time = date("H:i:s");
$type = $_GET['type'];
$orId = substr($type,3);
$sqlOrd = mysql_query("SELECT * FROM `book_master` WHERE `booking_id` = '$orId'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
	$roOd = mysql_fetch_assoc($sqlOrd);
?>
  <script type="text/javascript">
    function formatTime(obj){
	if(obj.value=='') return;
	var timeVal = obj.value;
	var hr = timeVal.substr(0,2);
	if(hr>24){
		alert("Invalid Hour [must be between 0 & 24]");
		obj.value="";
		obj.focus();
	}
	var cln = timeVal.substr(2,1);
	var mn = '00';
	if(cln==':'){
		mn = timeVal.substr(3,2);
	}else{
		mn = timeVal.substr(2,2);
	}
	if(mn=='') mn='00';
	if(mn>59)
		alert('Invalid Time');
	obj.value = hr+":"+mn+":00";
	return false;
}
</script>
<form name="frmAssinCab" id="frmAssinCab" method="post" action="../master/php/assign-cab.php">
<table width="100%" align="center" id="product-table">
<tr><th colspan="2" class="table-header-repeat">
<strong>
<?php
if($passVal == "CC"){
	echo 'Change ';
}else{
	echo 'Assign';
}
?>
 Cab for Order No. <?php echo $roOd['booking_code']; ?></strong>
</th></tr>
<tr><td>
Select Cab :
</td><td><input type="hidden" name="type" value="<?php echo $passVal; ?>" />
<input type="hidden" name="bid" value="<?php echo $orId; ?>">
<select name="cabId" id="cabId" class="required">
<option value="">Select Cab</option>
<?php
$sqlCab = mysql_query("SELECT cab_id,cab_code,status FROM `cabs` WHERE `status` = '1' ORDER BY `cab_code` ASC");
if(mysql_error()){
	echo '<option value="">No Record Found!!</option>';
}else{
	while($rows = mysql_fetch_assoc($sqlCab)){
   echo '<option value="'.$rows['cab_id'].'">'.$rows['cab_code'].'</option>';
	}
}
?>
</select>
</td>
</tr>
<tr><td>Date: </td><td><input type="text" name="date" id="fDate" value="<?php echo $date; ?>" class="required" />
      <em>YYYY-MM-DD</em></td></tr>
      <tr><td>Time:</td><td>
    <label for="input_time">
    <input name="rtime" type="text" class="text input_mask mask_time required" id="input_time" onClick="erase(this);" onBlur="formatTime(this);" value="<?php echo $time; ?>" />   <em>24 Hrs. Format.</em>
      </label>
      </td></tr>
	  <?php
		if($passVal == "CC"){
			echo 'Change ';
		?>
	  <tr><td>Remark:</td><td>
	  <textarea name="remark" class="required"></textarea>
	  </td></tr>
	  <?php
	  }else{
			echo '<input type="hidden" value="Assign Cab" name="remark" />';
		}
	  ?>
      <tr><td colspan="2" align="right" bgcolor="#CCCCCC">
      <input type="submit" value="Save" class="NavButton" />
    </td></tr>
</table>
</form>
<?php

}?>
<script language="javascript">
$("#frmAssinCab").validate();

		$( "#fDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: 0,
			maxDate: "+1M +60D"
		});
</script>
