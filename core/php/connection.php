<?php error_reporting(0); ?>
<?php
	//include 'session-watch.php';
	$con = mysql_connect('localhost','root','THIPARAMBIL');
	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	$db = mysql_select_db('kkcabs_v04',$con);
	
	date_default_timezone_set('Asia/Kolkata'); //time stamp
	
?>