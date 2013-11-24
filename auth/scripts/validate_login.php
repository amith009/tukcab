<?php

	session_start();
	error_reporting(E_ALL);
	require_once "../../core/scripts/error_handler.php";
	require_once "../../core/php/connection.php";
	$date = date("Y-m-d");
	date_default_timezone_set('Asia/Kolkata');

    $time = date("H:i:s");
	$username = $_POST['username'];
	$password = $_POST['userpass'];
	
	$qry = "SELECT * FROM employee WHERE username = '$username' AND password = '$password' AND emp_status = 1";
        $StatusAcc = mysql_query("SELECT * FROM employee WHERE username = '$username' AND password = '$password' AND emp_status = 0");
        $contEmp = mysql_num_rows($StatusAcc);
        if($contEmp == 1){
            header('location: ../access_fail.php');
            exit(0);
        }
	
	$res = mysql_query($qry);
	//we must get only one row, any other result is invalid
        mysql_num_rows($res);
	if(!mysql_num_rows($res)){
		
		 header('location: ../index.php');
		exit(0);
	}
	if(mysql_num_rows($res)>1) die ("Multiple usernames found: $username");
	$row = mysql_fetch_array($res);
	$_SESSION['EMP_NAME']=$row['emp_name'];
	$_SESSION['EMP_ID']=$row['emp_id'];
	$_SESSION['EMP_TYPE']=$row['access_level'];
        $_SESSION['EMP_CODE'] = $row['username'];
	$_SESSION['sessionTime']=time();
	$empTy = $row['access_level'];
	//insert into login details
	$eid = $row['emp_id'];
	$status = 1;
        $loginTime = date("H:i:s");
        $loginDate = date("Y-m-d");
        $sysIp = $_SERVER["REMOTE_ADDR"];
        $code = rand(00000,99999);
        
        /*working hours*/
        $empSqlWork = mysql_query("SELECT working_hrs FROM `employee` WHERE `emp_id` = $eid");
        if(mysql_error()){
            header('location: ../index.php');
            exit(0);
         }else{
             $empRows = mysql_fetch_assoc($empSqlWork);
             $workHrs = $empRows['working_hrs'];
         
        $timestamp_from_array = $loginDate." ".$loginTime;
        $workHrs = date( "Y-m-d H:i:s" , strtotime( $timestamp_from_array ) + $workHrs * 3600);
      
        $status = 1;
        
                    if($empTy == 1 || $empTy == 6){
                            header("location: ../../core/index.php");
                    }else{
                    $sqChe = mysql_query("SELECT access_code,ip_address FROM `employee_login` where `emp_id` = '$eid' and `status` = 1 and DATE_FORMAT(`date`,'%Y-%m-%d') = '$date'");
                    $countChe = mysql_num_rows($sqChe);
                    $rowsChe = mysql_fetch_assoc($sqChe);
                    $ActIp = $rowsChe['ip_address'];
                    $acCo = $rowsChe['access_code'];
                    //exit(0);
                    if($countChe != 0){
                        if($ActIp == $sysIp){
                            //echo 'Here';
                           header('location: ../login_confirm.php?cpas=0');
                            exit(0);
                        }else{
                           header('location: ../account_active.php');
                            exit(0);
                        }
                        
                    }else{        
                        if(!mysql_error()){
                                if($empTy == 1 || $empTy == 6){
                                       header("location: ../../core/index.php");
                                }else{
                                    $empAccess = mysql_query("INSERT INTO `employee_login` (`emp_id`, `ip_address`, `login_time`, `access_code`, `workin_time`, `date`, `status`) VALUES ('$eid', '$sysIp', '$loginTime', '$code', '$workHrs', '$loginDate', '$status')");
                                    $curMin = date("i");
                                    header('location: ../welcome-notes.php?time='.$curMin);
                                    
                                                /** Send mail*/
                                                $sqlEm = mysql_query("SELECT email_url,email_url_2 FROM `active_url`");
                                                if(mysql_error()){
                                                    //do nothink
                                                }else{
                                                    $roEm = mysql_fetch_assoc($sqlEm);
                                                    $sendEmail = $roEm['email_url'];
                                                    $ccMail = $roEm['email_url_2'];
                                                    $mailSub = "Employee Login details.";
                                                    $statusEm = 1;

                                                     $mailHead = '<img src="http://www.kkcabs.com/images/mail-head.gif" />';
                                                     $mailFooter = '<img src="http://www.kkcabs.com/images/mail-footer.gif" />';
                                                     $mailBody = '<br><br>EMPLOYEE LOGIN ON APPLICATION.<br><br>

                                                                 <table width="400px" border="0">
                                                                <tr><td colspan="2" style="padding:10px;"><b>EMPLOYEE DETAILS.</b></td></tr> 
                                                                <tr><td align="left"><b>Name : </b> '.$row['emp_name'].'</td></tr>
                                                                <tr><td align="left"><b>ACCESS CODE. </b>'.$row['username'].'</td></tr>
                                                                <tr><td align="left"><b>Date & Time.</b>'.$timestamp_from_array.'</td></tr>
                                                                </table>
                                                                <br><br>
                                                                KK CABS TEAM<br>
                                                                080 41519999<br>
                                                                www.kkcabs.com';
                                                     $mailContent = '<html>
                                                                            <body>
                                                                                <table width="800px" cellspacing="0" cellpadding="0">
                                                                                    <tr><td>'.$mailHead.'</td></tr>
                                                                                    <tr><td>'.$mailBody.'</td></tr>
                                                                                    <tr><td>'.$mailFooter.'</td></tr>
                                                                                </table>
                                                                            </body>
                                                                        </html>
                                                                        ';
                                                     $status = 0;
                                                     $sqlSendMail = mysql_query("INSERT INTO `emailcontents` (`email_to`, `email_cc`, `email_subject`, `email_body`, `status`) VALUES ('$sendEmail', '$ccMail', '$mailSub', '$mailContent', '$statusEm')");

                                    }
                /*End mail sending*/
                                }
                            }else{		
                                header('location: ../index.php');
                                exit(0);
                             }
                    
                        }
                    }
                }
mysql_close($con);
?>