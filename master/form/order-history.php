<?php
require_once "../../core/php/connection.php";
$type = $_GET['type'];
$orCode = substr($type,3);
//track oredr id also
$sqlTor = mysql_query("SELECT booking_id,booking_code FROM `book_master` WHERE `booking_code` = '$orCode'");
if(mysql_error()){
	$orId = 0;
}else{
	$rop = mysql_fetch_assoc($sqlTor);
	$orId = $rop['booking_code'];
}
//end

$sqlOrd = mysql_query("SELECT * FROM `app_log` WHERE `al_log_code` = '$orCode'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
	echo '
<table width="100%" border="0" id="product-table">
<tr><td colspan="7" class="title">Order History for '.$orId.'</td></tr>
  <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Action</th>
    <th class="table-header-repeat">Comment.</th>
    <th class="table-header-repeat">Operator</th>
    <th class="table-header-repeat">Date & Time</th>
  </tr>';
  
  $i = 1;
  while($roOd = mysql_fetch_assoc($sqlOrd)){
  $t = $i++;
  echo '
  <tr ';
  if($t %2 == 0){
	  echo 'class="row-active"';
  }else{
	  echo 'class="row-inactive"';
  }
  echo '>
    <td>'.$t.'</td>
    <td>';
	$ty = $roOd['al_log_type'];
	if($ty == "BOK"){
		echo '<font color="#0066CC">Booked</font>';
	}
	elseif($ty == "DIS"){
		echo '<font color="#009966">Dispatch</font>';
	}
        elseif($ty == "BOU"){
		echo '<font color="#009966">Update Order</font>';
	}
	elseif($ty == "CEL"){
		echo '<font color="#CC3300">Cancel Order</font>';
	}
	elseif($ty == "SPC"){
		echo 'Starting Pay Amount';
	}
	elseif($ty == "MRA"){
		echo 'Monthly Payment';
	}
	elseif($ty == "CHC"){
		echo '<font color="#CC6600">Change Cab</font>';
	}
	elseif($ty == "ACD"){
		echo 'Add New Cab Details';
	}
	elseif($ty == "FCM"){
		echo 'Add as a free cab';
	}
	elseif($ty == "ADN"){
		echo 'Add New Driver';
	}
	elseif($ty == "ACP"){
		echo '<font color="#FF3333">Complain</font>';
	}
	elseif($ty == "AUD"){
		echo 'Update Trip Details';
	}
	elseif($ty == "ATD"){
		echo '<font color="#993366" style="text-decoration:blink;">Add trip details</font>';
	}
	elseif($ty == "UBO"){
		echo 'Update Order';
	}
	else{
		echo '<strong>-</strong>';
	}
	echo '</td>
    <td>'.$roOd['al_comment'].'</td>
    <td>';
	$emId = $roOd['al_emp_id'];
	$sqlEmp = mysql_query("SELECT emp_id,emp_name FROM `employee` WHERE `emp_id` = '$emId'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roEmp = mysql_fetch_assoc($sqlEmp);
		echo $roEmp['emp_name'];
	}
	echo '</td>
    <td>'.$roOd['al_date'].'</td>
  </tr>
  ';
  }
  ?>
</table>
<?php
}
?>