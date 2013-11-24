<?php
        session_start();
	require_once "../../core/php/connection.php";
	$cabID = $_GET['id'];
        
	$loc = $_GET['cabLoc'];
	$time = $_GET['cabTime'];
        $eid = $_SESSION['EMP_ID'];
        $appType = "AFC";
        $appComm = $loc;			
        $timDat = date("Y-m-d").' '.$time;
	mysql_query("UPDATE free_cabs SET location = $loc,time='$time' WHERE cab_id = (SELECT cab_id FROM cabs WHERE cab_code = '$cabID')");
	if(mysql_error()){
		//$ret = array('error'=>mysql_error());
		$ret['error']=mysql_error();
		echo json_encode($ret);
		exit(1);
	}
        $sqlCf = mysql_query("SELECT cab_id FROM cabs WHERE cab_code = '$cabID'");
        if(mysql_error()){
            
        }
        $rop = mysql_fetch_assoc($sqlCf);
        $bid = $rop['cab_id'];
	$res = mysql_query("SELECT area_name FROM area WHERE area_id=$loc");
	$row = mysql_fetch_array($res);
	$sqlAppLog = mysql_query("INSERT INTO `app_log` (`al_emp_id`, `al_log_type`, `al_log_code`, `al_comment`, `al_date`) VALUES ('$eid', '$appType', '$bid', '$appComm', '$timDat')");
	//$ret = array('area'=>$row['area_name'],'time'=>$time);
	$ret['area']=$row['area_name'];
	$ret['time']=$time;
	echo json_encode($ret);
?>