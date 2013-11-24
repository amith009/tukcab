<?php

if(!isset($_SESSION)){
	session_start();
	$_SESSION['timeout']=time();
}
if(isset($_SESSION['EMP_TYPE'])&&$_SESSION['EMP_TYPE']!=1 && $_SESSION['EMP_TYPE'] !=6){
	$inactive = 600; //10 mins
	if(isset($_SESSION['user_timeout'])){
		$session_life = time() - $_SESSION['user_timeout'];
		 
		if($session_life > $inactive)
		{
			header("Location: ../core/php/session-expired.php");
                    //header("Location: session-expired.php");
		}
	}
	$_SESSION['user_timeout']=time();
}
?>