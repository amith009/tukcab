<?php
	$con = mysql_connect('209.212.146.48','kkcabs_kasim','ZZ@XCxa*^G(X');
	if(!$con){
		echo "DB Connection failed";
		exit(1);
	}
	mysql_select_db('kkcabs_online');
?>