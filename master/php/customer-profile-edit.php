<?php
require_once "../../core/php/connection.php";
    echo $id = $_POST['id'];
	$custName = $_POST['custName'];

	$login = $_POST['login'];
	$pws = $_POST['pws'];
	$mob = $_POST['mob'];
	$mob2 = $_POST['mob2'];
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
        $rate = $_POST['rate'];
	$ph = $_POST['ph'];
	$req = $_POST['req'];
	$curr = $_POST['curr']; // current
	$off = $_POST['off']; //office
	$res = $_POST['res']; //residence
	$lmO = $_POST['lmO'];
	$lmR = $_POST['lmR'];
	$lmC = $_POST['lmC'];
	$lqR1 = $_POST['lqR1'];
	$lqR2 = $_POST['lqR2'];
	$lqR3 = $_POST['lqR3'];
	$lqR4 = $_POST['lqR4'];
	$lqO1 = $_POST['lqO1'];
	$lqO2 = $_POST['lqO2'];
	$lqO3 = $_POST['lqO3'];
	$lqO4 = $_POST['lqO4'];
	$lqC1 = $_POST['lqC1'];
	$lqC2 = $_POST['lqC2'];
	$lqC3 = $_POST['lqC3'];
	$lqC4 = $_POST['lqC4'];
	$status = $_POST['status'];
	
	$sql = mysql_query("UPDATE `cust_master` SET  `cust_name` = '$custName', `cust_username` = '$login', `cust_password` = '$pws', `mobile` = '$mob', `alt_mobile` = '$mob2', `phone_no` = '$ph', `email` = '$email1', `alt_email` = '$email2', `requirement` = '$req',`rate` = '$rate', `status` = '$status' WHERE `cust_id` = $id");
	
	$sqlAdd = mysql_query("UPDATE `cust_detail` SET `off_address` = '$off', `off_address_l1` = '$lqO1', `off_address_l2` = '$lqO2', `off_address_l3` = '$lqO3', `off_address_l4` = '$lqO4', `off_landmark` = '$lmO', `res_address` = '$res', `res_address_l1` = '$lqR1', `res_address_l2` = '$lqR2', `res_address_l3` = '$lqR3', `res_address_l4` = '$lqR4', `res_landmark` = '$lmR', `cur_address` = '$curr', `cur_address_l1` = '$lqC1', `cur_address_l2` = '$lqC2', `cur_address_l3` = '$lqC3', `cur_address_l4` = '$lqC4', `cur_landmark` = '$lmC' WHERE `cust_id` = $id");
	if(mysql_error()){
		echo 'Try Again!!';
	}else{
		echo 'Record updated.';
	}
	?>