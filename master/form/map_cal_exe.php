<?php
$submit = $_POST['submit'];
if(isset($submit)){
	$km = $_POST['km'];
	$sk = $_POST['sk'];
	$ak = $_POST['ak'];
	
	$mk = $km-5;
	$am_ae = $mk*$ak; //before km
	$tot = $am_ae+$sk;
	
	header("location: map_cal.php?amnt=".$tot);
	
}
?>