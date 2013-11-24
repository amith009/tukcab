<?php
require_once "../../core/php/connection.php";

$custName = $_POST['custName'];
$login = $_POST['login'];
$sex = $_POST['sex'];
$pws = $_POST['pws'];
$mob = $_POST['mob'];
$mob2 = $_POST['mob2'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$ph = $_POST['ph'];
$req = $_POST['req'];
$status = $_POST['status'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$pin = $_POST['pin'];
$dob = $_POST['dob'];
$doj = $_POST['doj'];
$id = $_POST['id'];
$assLe = $_POST['accs'];
$f6_name = $_FILES['img']['name'];
        if($f6_name == ""){
          $valImg = "";
            
        }else{
	move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/driver_images/".$code.$_FILES["img"]["name"]);
	  $img_content = $f6_name==''?'':'driver_images/'.$code.$_FILES["img"]["name"];
          
             $valImg = ", `image_file` = '".$img_content."'";
	//end here
        }
$sql = mysql_query("UPDATE `employee` SET `password` = '$pws', `emp_name` = '$custName', `gender` = '$sex', `dob` = '$dob', `mobile_no` = '$mob', `alt_number` = '$mob2', `ph_number` = '$ph', `email` = '$email1', `alt_email` = '$email2', `reference` = '$req', `emp_add1` = '$add1', `emp_add2` = '$add2', `city` = '$city', `state` = '$state', `country` = '$country', `zip` = '$pin', `doj` = '$doj', `emp_status` = '$status' $valImg WHERE `emp_id` = $id");

if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Record updated.';
}
?>