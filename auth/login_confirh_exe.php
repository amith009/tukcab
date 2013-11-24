<?php
session_start(); 
require "../core/php/auth.php";
require_once "../core/php/connection.php";

	$eid = $_POST['eid'];
	$pws = $_POST['pws'];
	$asc = $_POST['passCode'];
	$pass = $_POST['pass'];
	//exit();
	if($asc == $pws){
		header("location: ../core/index.php");
		//echo 'not equal';
                 
	}else{
	if($pass == 4){
            
	$sql = mysql_query("UPDATE `employee` SET `emp_status` = '0' WHERE `emp_id` = '$eid'");
        
//$client = $_SERVER['REMOTE_ADDR'];
//$time = date("H:i:s");
//$date = date("Y-m-d");
//$sql = mysql_query("UPDATE `login_details` SET `logout_time` = '$time', `status` = 0 WHERE `login_date` = '$date' AND `emp_id` = '$eid'");
//unregister client
//$sqlUnReg = mysql_query("DELETE FROM registered_clients WHERE remote_addr = '$client'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
	unset($_SESSION['EMP_ID']);
	unset($_SESSION['EMP_NAME']);
	unset($_SESSION['EMP_TYPE']);
	unset($_SESSION['sessionTime']);
	session_destroy();
	header("location: index.php");
}
		
	}else{
            $comm = "Access Code Attend Failed!";
            $sql = mysql_query("INSERT INTO `employee_logoff` (`emp_id`, `comment`, `date`) VALUES ('$eid', '$comm', NOW())");
		header("location: login_confirm.php?cpas=".$pass);
		//echo 'equal';
               
		}
	}
	
?>