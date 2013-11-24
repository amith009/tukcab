<?php
/************************************************************************************
File Name: booking-form.php
T=table name -> drivers
##########
Create date = 29 NOV 2011
Time: 06:21 PM
Last Update:
Date: 07-12-2011
Time: 00:00
Author Name: amit kumar
***********************************************************************************/
session_start();
$empType = $_SESSION['EMP_TYPE'];
$date = date("Y-m-d");
require_once "../../core/php/connection.php";
$min = date("i");
$sqlBok = mysql_query("SELECT * FROM `upcoming_call` WHERE DATE_FORMAT(`date`, '%Y-%m-%d') = '$date' AND DATE_FORMAT(`time`, %i')  ORDER BY `time`DESC LIMIT 20");
if(mysql_error()){
	 echo '<strong>No Record Found!</strong>';
}else{
?>
<table width="100%" border="0">
  <tr>
    <th>Sl No.</th>
    <th>Employee Name</th>
    <th>Customer Attend</th>
    <th>Date AND TIME</th>
    <th>Status</th>
  </tr>
  <?php
  $i =1;
  while($ropl = mysql_fetch_assoc($sqlBok)){
   $t = $i++;
  ?>
  <tr <?php
  
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	   } ?>>
    <td><?php echo $t; ?></td>
    <td><?php $empId = $ropl['emp_id']; 
	if($empId == 0){
		echo '<strong>-</strong>';
	}else{
	  $sqlEmp = mysql_query("SELECT emp_name FROM `employee` WHERE `emp_id` = '$empId'");
	  if(mysql_error()){
		  echo '<strong>-</strong>';
	  }else{
		  $rowEmp = mysql_fetch_assoc($sqlEmp);
		  echo $rowEmp['emp_name'];
	  }
	}
	?></td>
    <td><?php $no = $ropl['number'];
	      $sqlCu = mysql_query("SELECT cust_name FROM `cust_master` WHERE `mobile` = '$no' OR `alt_mobile` = '$no' OR `phone_no` = '$no'");
		  if(mysql_error()){
			  echo $no;
		  }else{
			  $roCu = mysql_fetch_assoc($sqlCu);
			  echo $roCu['cust_name'].'<br>'.$no;;
		  }
	  ?></td>
    <td><?php echo $ropl['date'].' '.$ropl['time']; ?></td>
    <td><?php 
	$eSat = $ropl['status'];
	 if($eSat == 0){
		 echo '<b style="color:#dc1d1d;">MISSED</b>';
	 }else{
		 echo '<b style="color:#2c9c20;">ATTENDED</b>';
	 }
	?>
    </td>
  </tr>
  <?php
  }//while close
  ?>
</table>
<?php
}
?>
