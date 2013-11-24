<?php error_reporting(0); ?>
<?php
	$con = mysql_connect('localhost','root','THIPARAMBIL');
	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	mysql_select_db('easybooking');
	
	date_default_timezone_set('Asia/Kolkata'); //time stamp
	
?>