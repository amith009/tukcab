<?php
/******************************************************************************
File Name: add-free-cab.php
##########
Create date = 29 NOV 2011
Time: 00:22
Last Update:
Date: 29 NOV 2011
Time: 11:00
Author Name: amit kumar
********************************************************************************/ 
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$time = date("H:i:s");
?>
<div class="formContainer" style="width:99%;">
<div class="title">Add Free Cab</div>
<form name="frmCreateFreeCab" method="post" action="../master/php/add-free-cab.php">
<table width="100%" align="center" id="product-table">
<tr class="row-inactive"><td width="31%">
Select Cab :
</td><td width="69%">
<select name="cabId" id="cabId">
<option value="0">Select Cab</option>
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
<tr class="row-active"><td>Current Location:</td>
<td>
<select name="area">
<option value="0">Select Location</option>
<?php
$sqlAre = mysql_query("SELECT area_id,area_name FROM `area` ORDER BY `area_name` ASC");
if(mysql_error()){
	echo '<option value="">No Record Found!!</option>';
}else{
	while($rowsAre = mysql_fetch_assoc($sqlAre)){
		echo '<option value="'.$rowsAre['area_id'].'">'.$rowsAre['area_name'].'</option>';
	}
}
?>
</select>
</td>
</tr>
<tr class="row-inactive"><td>Date: </td><td><input type="text" name="date" id="f_date_b" value="<?php echo $date; ?>" />
      <em>YYYY-MM-DD</em></td></tr>
      <tr><td>Time:</td><td>
    <input name="time" type="text" Value="<?php echo $time; ?>"/>
    
      <em>24 Hrs. Format.</em>
      </label>
      </td></tr>
      <tr class="row-active"><td colspan="2" align="right">
      <input type="submit" value="Add Free Cab" class="myButton" />
    </td></tr>
</table>
</form>
</div>
<script language="javascript">
		$( "#f_date_b" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: 0,
			maxDate: "+1M +60D"
		});
</script>
