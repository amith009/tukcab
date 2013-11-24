<?php
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
        $dob = $_POST['empDob'];
	$status = $_POST['status'];
	$pws = $_POST['pws'];
	//$img = ""; //employee image content 
	$code = $_POST['empId'];
	$basic = $_POST['basic'];
	$vda = $_POST['vda'];
	$hra = $_POST['hra'];
	$esi = $_POST['esi'];
	$pf = $_POST['pf'];
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
        $status = $_POST['status'];
        $whrs = $_POST['whrs'];
	//end here
	
//image intero back file
        if($_FILES['img']['error'] == TRUE){
        echo 'Image Not Good!!';
        $imgib_content = 'employeeImages/'.$code.$f6_name;
        }else{
	 $f6_name = $_FILES['img']['name'];
	move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/employeeImages/".$code.$_FILES["img"]["name"]);
	  $imgib_content = 'employeeImages/'.$code.$f6_name;
        }
	//end here
          //exit(0);
	if($empaltMob != ""){
          $colVal .= ', `alt_number`';
          $datVal .= ", '$empaltMob'";
        }
        if($dob != ""){
        $colVal .= ', `dob`';
          $datVal .= ", '$dob'";      
        }
        if($doj != ""){
          $colVal .= ', `doj`';
          $datVal .= ", '$doj'";
        }
        if($empNo != ""){
            $colVal .= ', `ph_number`';
            $datVal .= ", '$empNo'";
        }
        if($hra != ""){
          $colVal1 .= ', `hra`';
            $datVal1 .= ", '$hra'";           
        }
        if($vda != ""){
            $colVal1 .= ', `vda`';
            $datVal1 .= ", '$vda'";
        }
        
        if($mobilCon != ""){
            $colVal1 .= ', `mobile`';
            $datVal1 .= ", '$mobilCon'";
        }
        if($mobComp != ""){
            $colVal1 .= ', `mobile_allowance`';
            $datVal1 .= ", '$mobComp'";
        }
        if($vechCon != ""){
            $colVal1 .= ', `vehicle`';
            $datVal1 .= ", '$vechCon'";
        }
        if($vechAmnt != ""){
            $colVal1 .= ', `vehicle_allowance`';
            $datVal1 .= ", '$vechAmnt'";
        }
        if($lapCon != ""){
            $colVal1 .= ', `laptop`';
            $datVal1 .= ", '$lapCon'";
        }
        if($lapComp != ""){
            $colVal1 .= ', `laptop_allowance`';
            $datVal1 .= ", '$lapComp'";
        }
        if($vechIss != ""){
            $colVal1 .= ', `vechDateIss`';
            $datVal1 .= ", '$vechIss'";
        }
        if($mobIss != ""){
            $colVal1 .= ', `mobDateIss`';
            $datVal1 .= ", '$mobIss'";
        }
        if($lapIss != ""){
            $colVal1 .= ', `LapDateIss`';
            $datVal1 .= ", '$lapIss'";
        }
        
        //echo "INSERT INTO `employee` (`username`, `password`, `emp_name`, `gender`, `mobile_no`, `email`, `alt_email`, `reference`, `emp_add1`, `emp_add2`, `city`, `state`, `country`, `zip`, `emp_img_content`, `emp_status`, `access_level` $colVal) VALUES ('$code', '$pws', '$empname', '$empSex', '$empmob', '$empEmal1', '$empEmail2', '$empRef', '$str1', '$str2', '$city', '$state', '$cont', '$pin', '$imgib_content', '$status', '$emptype' $datVal)";
//exit(0);
        $sql = mysql_query("INSERT INTO `employee` (`username`, `password`, `emp_name`, `gender`, `mobile_no`, `email`, `alt_email`, `reference`, `emp_add1`, `emp_add2`, `city`, `state`, `country`, `zip`, `emp_img_content`, `working_hrs`, `emp_status`, `access_level` $colVal) VALUES ('$code', '$pws', '$empname', '$empSex', '$empmob', '$empEmal1', '$empEmail2', '$empRef', '$str1', '$str2', '$city', '$state', '$cont', '$pin', '$imgib_content', '$whrs', '$status', '$emptype' $datVal)");
echo mysql_error();
if(mysql_error()){
		echo "<div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><h2>Try Again!!</h2></div>";
	}else{
		$sqlSal = mysql_query("INSERT INTO `employee_sallery` (`emp_id`, `basic`, `pf`, `esi`, `bus_pass`,  `date` $colVal1) VALUES ('$code', '$basic', '$pf', '$esi', '$busPass',  '$doj' $datVal1)");
		if(mysql_error()){
                    echo mysql_error().'B';
			echo "<div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><br><b>Try Again!!</b></div>";
		}else{
		  header("location: ../form/view-employee.php?pas=1");
		}
	}
mysql_close($con);

?>