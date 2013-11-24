<?php
	//$con = mysql_connect('tmkasim.db.8924211.hostedresource.com','tmkasim','Kkc@bs12');
	$con = mysql_connect('localhost','root','');

	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	mysql_select_db('tmkasim');
	
	date_default_timezone_set('Asia/Kolkata'); //time stamp
?>