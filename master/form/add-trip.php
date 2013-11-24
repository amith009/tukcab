<?php
require_once "../../core/php/connection.php";
$type = $_GET['type'];
$orId = substr($type,3);
$sqlOrd = mysql_query("SELECT * FROM `book_master` WHERE `booking_id` = '$orId'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
	$roOd = mysql_fetch_assoc($sqlOrd);
	//check for trip
	$sqlTrip = mysql_query("SELECT * FROM `trip_details` WHERE `booking_id` = '$orId'");
	$count = mysql_num_rows($sqlTrip);
	if($count == 0){
		$startKm = 0;
		$endKm = 0;
		$date = $roOd['required_date'];
		$time = $roOd['required_time'];
		$amount = "0.00";
		$status = 0;
	}else{
		$rows = mysql_fetch_assoc($sqlTrip);
		$startKm = $rows['opening_km'];
		$endKm = $rows['closing_km'];
		$amount= $rows['amount'];
		$date = $rows['trip_date'];
		$time = $rows['trip_time'];
		$status = $rows['status'];
	}
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
    <form action="../master/php/add-trip.php" name="frmAddTrip" method="post" id="frmAddTrip">
<table width="100%" border="0" id="product-table">
  <tr >
    <th colspan="4" bgcolor="#A6A6A6">Add Trip Details for Order No. <?php echo $orId; ?></th>
  </tr>
  <input type="hidden" value="<?php echo $orId; ?>" name="bid" />
  <tr class="row-active">
    <td>Starting Km.</td>
    <td><input name="sk" type="text" id="sk" value="<?php echo $startKm; ?>" class="number required" /></td>
    <td>Date:</td>
    <td>
    <input name="date" type="text" class="input" id="f_date_c" value="<?php echo $date; ?>" />
     
      <em>YYYY-MM-DD</em>
    </td>
  </tr>
  <tr class="row-inactive">
    <td>Closeing Km.</td>
    <td><input name="ck" type="text" id="ck" value="<?php echo $endKm; ?>" class="number" /></td>
    <td>Time:</td>
    <td>
    <label for="input_time">
    <input name="rtime" type="text" class="text input_mask mask_time" id="input_time" onClick="erase(this);" onBlur="formatTime(this);" value="<?php echo $time; ?>"/>   <em>24 Hrs. Format.</em>
      </label>
    </td>
  </tr>
  <tr class="row-active">
    <td>Amount :</td>
    <td><img src="images/rs.png" width="13" height="13">   
       <input name="amnt" type="text" id="amnt" value="<?php echo $amount; ?>" class="number" style="text-align:right;" /></td>
    <td>Status :</td>
    <td>
    <select name="sta" class="required">
 
    <?php
	 $st = $status;
	  if($st == 1){
		  echo '<option value="1">START</option>';
	  }
	  elseif($st == 0){
	  echo '<option value="0">CLOSE</option>';
	  }
	  else{
		  echo '<option value=" ">SELECT</option>';
	  }
	?>
   
    <option disabled="disabled">------------------</option>
    <option value="1">START</option>
    <option value="0">CLOSE</option>
    </select>
   </td>
  </tr>
  <tr class="row-inactive">
    <td>Booking Date:</td>
    <td><?php echo $roOd['required_date']; ?></td>
    <td>Booking Time :</td>
    <td><?php echo $roOd['required_time']; ?></td>
  </tr>
  <tr class="row-active">
    <th colspan="4" align="right" bgcolor="#A6A6A6"><input type="submit" name="submit" class="NavButton" value=" Save " /></th>
  </tr>
  <?php
}
?>
</table>
</form>
<script language="javascript">
	$("#frmAddTrip").validate();	
		$( "#f_date_c" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script>
