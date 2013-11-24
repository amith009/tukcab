<?php
    /*require("connection.php");
    $cid = $_GET['cid'];
    $type = $_GET['type'];
    $opId = $_GET['opid']; //if need employee id 
    $timeSf = date("H:i:s");
    $remoteAddr = $_SERVER['REMOTE_ADDR'];
    $regToken = $_GET['regToken'];
    
	$sqlGetId = mysql_query("SELECT MAX(id) id FROM call_logs");
        $res = mysql_fetch_assoc($sqlGetId);
        $resId = $res['id']+1;
        if($resId==21){
            mysql_query("DELETE FROM call_logs WHERE id=1");//delete the last entry
            mysql_query("UPDATE call_logs SET id=id-1"); //unshift all rows by 1
            $resId = $resId - 1;
        }
        $sqlLogger = mysql_query("INSERT INTO call_logs VALUES ($resId,'$cid','$type','$timeSf')");
        echo "Updated - ".$cid." - ".$type;
	
    /*$sqlCheckToken = mysql_query("SELECT MIN(registration_token) token FROM registered_clients");
    
    if(mysql_errno()){
        echo mysql_error();
    }
    $res = mysql_fetch_assoc($sqlCheckToken);
    $token = $res['token'];
    
    if($regToken==$token){ //if requesting client does not hold the lowest token ignore the request
        $sqlGetId = mysql_query("SELECT MAX(id) id FROM call_logs");
        $res = mysql_fetch_assoc($sqlGetId);
        $resId = $res['id']+1;
        if($resId==21){
            mysql_query("DELETE FROM call_logs WHERE id=1");//delete the last entry
            mysql_query("UPDATE call_logs SET id=id-1"); //unshift all rows by 1
            $resId = $resId - 1;
        }
        $sqlLogger = mysql_query("INSERT INTO call_logs VALUES ($resId,'$cid','$type','$timeSf')");
        echo "Updated - ".$cid." - ".$type;
    }*/
?>
