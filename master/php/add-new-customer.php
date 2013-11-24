<?php
require_once "../../core/php/connection.php";

	$custName = $_POST['custName'];
	$CustType = $_POST['CustType'];
	$login = $_POST['login'];
	$pws = $_POST['pws'];
	$mob = $_POST['mob'];
	$mob2 = $_POST['mob2'];
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$ph = $_POST['ph'];
	$add1 = $_POST['add1']; // current
	$add2 = $_POST['add2']; //office
	$add3 = $_POST['add3']; //residence
	$status = 1;
	
$sqlCust = "INSERT INTO `cust_master` (`cust_type`, `cust_name`, `cust_username`, `cust_password`, `mobile`, `alt_mobile`, `phone_no`, `email`, `alt_email`, `status`) VALUES ('$CustType', '$custName', '$login', '$pws', '$mob', '$mob2', '$ph', '$email1', '$email2', '$status')";
$result = mysql_query($sqlCust);
//exit(0);
if(mysql_error()){
		echo "<div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><h2>Try Again!!</h2></div>";
	}else{
		//inser into customer details
		$sqlCust = mysql_query("SELECT cust_id,mobile FROM `cust_master` WHERE `mobile` = '$mob'");
		$counCust = mysql_num_rows($sqlCust);
		if(mysql_error()){
				echo "<div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><h2>Try Again to add address details!!</h2></div>";
		}else{
			$rowId = mysql_fetch_assoc($sqlCust);
			$cusId= $rowId['cust_id'];
			
		$sqlAdd = mysql_query("INSERT INTO `cust_detail` (`cust_id`, `off_address`, `res_address`, `cur_address`) VALUES ('$cusId', '$add2', '$add3', '$add1')");
		//end here
		if(mysql_error()){
		echo "<div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><h2>Try Again!!</h2></div>";
		}else{
			echo '<div class="success"><img src="images/001_19.png" width="32" height="32" /><br>'.$custName.' has been added.</div>';		}
		}
	}
mysql_close($con);

?>