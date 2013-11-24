<?php

/*
 * Author: amit kumar
 * date: 10-01-2012
 * function: this file is updating employee record
 * table name:employee_sallery, employee
 */

require_once "../../core/php/connection.php";

	$empname = $_POST['empname'];
	$emptype = $_POST['emptype'];
	$empmob = $_POST['empmob'];
	$empaltMob = $_POST['empaltMob'];
	$empNo = $_POST['empNo'];
	$empRef = $_POST['empRef'];
	$empSex = $_POST['empSex'];
	$empDob = $_POST['empDob'];
	$empEmal1 = $_POST['empEmal1'];
	$empEmail2 = $_POST['empEmail2'];
	$str1 = $_POST['str1'];
	$str2 = $_POST['str2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$cont = $_POST['cont'];
	$pin = $_POST['pin'];
	$doj = $_POST['doj'];
	$status = $_POST['status'];
	$pws = $_POST['pws'];
	//$img = ""; //employee image content 
	//$code = $_POST['empId'];
	$basic = $_POST['basic'];
	$vda = $_POST['vda'];
	$hra = $_POST['hra'];
	$esi = $_POST['esi'];
	$pf = $_POST['pf'];
        $dob = $_POST['empDob'];
	$busPass = $_POST['busPass'];
	$vechCon = $_POST['vechCon'];
	$vechAmnt = $_POST['vechAmnt'];
	$mobilCon = $_POST['mobilCon'];
	$mobComp = $_POST['mobComp'];
	$lapCon = $_POST['lapCon'];
	$lapComp = $_POST['lapComp'];
        $vechIss = $_POST['vechIss'];
        $mobIss = $_POST['mobIss'];
        $lapIss = $_POST['lapIss'];
        $empId = $_POST['empId'];
        $empCode = $_POST['empCode'];
        $whrs = $_POST['whrs'];
	//end here
	//exit();
//image intero back file
       
	 $f6_name = $_FILES['img']['name'];
         if($f6_name != ""){
             move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/employeeImages/".$empCode.$_FILES["img"]["name"]);
	  $imgib_content = 'employeeImages/'.$empCode.$f6_name;
           $colVal .= ", `emp_img_content` = '$imgib_content'";
         }
        
	//end here
          //exit(0);
	if($empaltMob != ""){
          $colVal .= ", `alt_number` = '$empaltMob'";
        }
        if($dob != ""){
        $colVal .= ", `dob` =  '$dob'";      
        }
        if($doj != ""){
          $colVal .= ", `doj` =  '$doj'";
        }
        if($empNo != ""){
            $colVal .= ", `ph_number` =  '$empNo'";
        }
        if($hra != ""){
          $colVal1 .= ", `hra` =  '$hra'";           
        }
        if($vda != ""){
            $colVal1 .= ", `vda` =  '$vda'";
        }
        
        if($mobComp != ""){
            $colVal1 .= ", `mobile_allowance` =  '$mobComp'";
        }
        if($mobilCon != ""){
            $colVal1 .= ", `mobile` =  '$mobilCon'";
        }
        if($vechCon != ""){
            $colVal1 .= ", `vehicle` =  '$vechCon'";
        }
        if($vechAmnt != ""){
            $colVal1 .= ", `vehicle_allowance` = '$vechAmnt'";
        }
        if($lapCon != ""){
            $colVal1 .= ", `laptop` = '$lapCon'";
        }
        if($lapComp != ""){
            $colVal1 .= ", `laptop_allowance` = '$lapComp'";
        }
        if($vechIss != ""){
            $colVal1 .= ", `vechDateIss` = '$vechIss'";
        }
        if($mobIss != ""){
            $colVal1 .= ", `mobDateIss` = '$mobIss'";
        }
        if($lapIss != ""){
            $colVal1 .= ", `LapDateIss` = '$lapIss'";
        }
        
        
        $sqlMain = "UPDATE `employee` SET `password` = '$pws', `emp_name` = '$empname', `gender` = '$empSex', `mobile_no` = '$empmob', `email` = '$empEmal1', `alt_email` = '$empEmail2', `reference` = '$empRef', `emp_add1` = '$str1', `emp_add2` = '$str2', `city` = '$city', `state` = '$state', `country` = '$cont', `zip` = '$pin', `working_hrs` = '$whrs', `emp_status` = '$status', `access_level` = '$emptype' $colVal WHERE `emp_id` = $empId";
          $result = mysql_query($sqlMain);
          if(mysql_error()){
              echo 'Unable to Update record!';
              echo mysql_error();
          }else{
           $sql = mysql_query("UPDATE `employee_sallery` SET `basic` = '$basic', `pf` = '$pf', `esi` = '$esi', `bus_pass` = '$busPass' $colVal1 WHERE `emp_id` = '$empCode'");
            if(mysql_error()){
                echo 'Unable to update Salary Record';
               echo  mysql_error();
            }else{
            header("location: ../form/view-employee-record.php?id=".$empId);
            }
          }
        ?>
