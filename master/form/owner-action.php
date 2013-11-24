<?php
/*********************************************************************************************

File Name: waiting-order-list.php
Work and function: display list all free cab avilable.
T=table name -> waith order list here
##########
Create date = 30 NOV 2011
Time: 08:05
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar
Condition for action tack by passing parametter

View Driver record under owner = VD
Add Driver under owner = AD
View Cab record under owner = VC
BL[0], BL[1] = Block all drivers and cab under this owner

***********************************************************************************************/
$type = $_GET['actionPass'];
$passVal = substr($type,0,2);
if($passVal == "VE"){
	echo 'View here';
}
elseif($passVal == "VD"){
	include 'view_owner_under_drivers.php?oid=oilp';
}
elseif($passVal == "AD"){
	include 'assign-cab.php';
}
elseif($passVal == "CC"){
	include 'assign-cab.php';
}
elseif($passVal == "DL"){
	echo 'Delete order';
}
elseif($passVal == "AD"){
	include 'complain-order.php';
}
elseif($passVal == "AT"){
	include 'add-trip.php';
}
if($passVal == "CO"){
	include 'cancel-order.php';
}
elseif($passVal == "HI"){
	include 'order-history.php';
}
elseif($passVal == "DOL"){
	include 'DeleteOnlineOrder.php';
}
else{
	//echo 'View order';
}
//gose as per condition
?>