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
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT cab_id,cab_code FROM `cabs` WHERE `cab_id` = $id");
if(mysql_error()){
	echo 'ERROR: Unable to read cab record!<br>Try Again';
}else{
	$rowsCab = mysql_fetch_assoc($sqlCab);
	$cabCode = $rowsCab['cab_code'];
echo '<table width="100%" border="0" id="product-table">
  <tr>
    <th class="table-header-repeat">Sl No.</th>
    <th class="table-header-repeat">Opp Code</th>
    <th class="table-header-repeat">Net Amount</th>
    <th class="table-header-repeat">Amount Paid</th>
    <th class="table-header-repeat">Balance</th>
    <th class="table-header-repeat">Discount</th>
    <th class="table-header-repeat">Pay Mode</th>
    <th class="table-header-repeat">For Month</th>
    <th class="table-header-repeat">Pay Date & Time</th>
    <th class="table-header-repeat">Due Date</th>
  </tr>';
  $sqlAmo = mysql_query("SELECT * FROM `cab_payment` WHERE `cp_cab_code` = '$cabCode'");
  if(mysql_error()){
	  echo 'ERROR: No record Found!!';
  }else{
	  $i = 1;
	   while($rowsPay = mysql_fetch_assoc($sqlAmo)){
       $t = $i++;
 
   echo '<tr align="center" ';
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
   }
	echo '>
    <td>'.$t.'</td>
	<td>';
	$sqlApp = mysql_query("SELECT al_emp_id,al_log_type,al_log_code FROM `app_log` WHERE `al_log_type` = 'CMP' OR `al_log_type` = 'SPC' AND `al_log_code` = '$cabCode'");
	if(mysql_error()){
		echo 'ERROR: Unable to track Employee Id.';
	}else{
		$roApp = mysql_fetch_assoc($sqlApp);
		$empId = $roApp['al_emp_id'];
		$sqlEmp = mysql_query("SELECT emp_id,emp_name FROM `employee` WHERE `emp_id` = $empId");
		if(mysql_error()){
			echo 'ERROR: Unable to read employee record!!';
		}else{
			$roEmp = mysql_fetch_assoc($sqlEmp);
			echo $roEmp['emp_name'];
		}
	}
	echo '</td>
    <td>'.$rowsPay['cp_amt_to_pay'].'</td>
    <td>'.$rowsPay['cp_amt_paid'].'</td>
    <td>'.$rowsPay['cp_balance'].'</td>
    <td>'.$rowsPay['cp_discount'].'</td>
    <td>';
	$pmo = $rowsPay['cp_mode'];
	if($pmo == 1){
		echo 'Cash';
	}
	elseif($pmo == 2){
		echo 'Credit <br>';
		echo $rowsPay['cp_card_no'];
	}
	elseif($pmo == 3){
		echo 'Cheque<br>';
		echo $rowsPay['cp_chq_no'].'-'.$rowsPay['cp_bank_name'].'<br>'.$rowsPay['cp_chq_iss_date'];
	}
	else{
		echo '-';
	}
	echo '</td>
    <td>';
	$month = $rowsPay['cp_payment_date'];
	$mm = substr($month,5,2);
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
	echo '<br>'.substr($month,0,4);
	echo '</td>
	<td>'.$rowsPay['cp_payment_date'].'<br>'.$rowsPay['cp_payment_time'].'</td>
    <td>'.$rowsPay['cp_next_due_date'].'</td>
    
  </tr>
  ';
	   }//while close
  }//else close
  ?>
</table>
<?php
}//main else close
?>