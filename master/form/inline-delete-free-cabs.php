<?php 
        session_start();
	require_once "../../core/php/connection.php";
	$cabID = $_GET['id'];
        $eid = $_SESSION['EMP_ID'];
        $appType = "AFC";
        $appComm = $_GET['reason'];
        $time = date("H:i:s");
        $timDat = date("Y-m-d").' '.$time;
        
	mysql_query("UPDATE free_cabs SET `status`=3 WHERE cab_id = (SELECT cab_id FROM cabs WHERE cab_code = '$cabID')");
	if(mysql_error()){
		//$ret = array('error'=>mysql_error());
		$ret['error']=mysql_error();
		echo json_encode($ret);
		exit(1);
	}
	$ret['success']="SUCCE: Updated";
	echo json_encode($ret);
        $sqlCf = mysql_query("SELECT cab_id FROM cabs WHERE cab_code = '$cabID'");
        if(mysql_error()){
          $bid = "NULL";  
        }
        $rop = mysql_fetch_assoc($sqlCf);
        $bid = $rop['cab_id'];
        $sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
?>