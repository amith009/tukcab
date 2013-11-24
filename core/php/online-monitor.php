<?php
	/*
		Script to monitor online bookings
		Author	: Nilotpal
		Date	: 12-Feb-2012
	*/
	$con = mysql_connect('tmkasim.db.8924211.hostedresource.com','tmkasim','Kkc@bs12') or die("Cannot connect to database");
	mysql_select_db('tmkasim');
	$qry = "SELECT * FROM online_record WHERE pooled=0";
	$res = mysql_query($qry);
	while($row=mysql_fetch_assoc($res)){
		$vals = $row['booking_id'].",'".$row['booking_code']."','".$row['custName']."','".$row['cust_no']."','".$row['CustEmail']."',".$row['pickup'].",'".$row['address']."','".$row['date']."','".$row['edate']."','".$row['time']."',".$row['servicesType'].",".$row['cabType'].",".$row['nocab'].",".$row['dropPoint'].",'".$row['sysIp']."',".$row['status'];
		insertInLocalDB($vals);
		mysql_query("UPDATE online_record SET pooled=1 WHERE booking_id=".$row['booking_id'],$con);
		if(mysql_errno())
		echo mysql_error();
		}
		
	mysql_close($con);
	
	function insertInLocalDB($vals){
		//insert to local database
		$con2 = mysql_connect('localhost','root','THIPARAMBIL');
		if(!$con2){
			echo "DB Connection failed.";
			exit(1);
		}
		mysql_select_db('easybooking');
		mysql_query("INSERT INTO online_record VALUES($vals)");
		
		mysql_close($con2);
	}
	

?>