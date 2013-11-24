<?php
require_once "../../core/php/connection.php";

$cabid = $_GET['cabid'];
$cabDet = mysql_query("SELECT cab_id FROM `cabs` where `cab_code` = '$cabid' and `status` = '1'");
                     $cobNo = mysql_num_rows($cabDet);
                    
                    if($cobNo == 1){
                    $rowCabId = mysql_fetch_assoc($cabDet);
                    $cabIdPas = $rowCabId['cab_id'];
$sqlCab = mysql_query("SELECT driver_id FROM `assigned_cabs` where `cab_id` = '$cabIdPas' and `status` = '1'");
                    if($sqlCab == true){
                        $rowCab = mysql_fetch_assoc($sqlCab);
                        $drivId = $rowCab['driver_id'];
                        $sqlDrv = mysql_query("SELECT mobile_no,email,driver_name,driver_type,driver_owner  FROM `drivers` where `driver_id` = '$drivId'");
                        $countDriv = mysql_num_rows($sqlDrv);
                        if($countDriv == 1){
                            $rowsDrv = mysql_fetch_assoc($sqlDrv);
                            $drvMob = $rowsDrv['mobile_no'];
                            $drvEmail = $rowsDrv['email'];
                            $drType = $rowsDrv['driver_type'];
                            $drOwn = $rowsDrv['driver_owner'];
                            if($drOwn != ''){
                            $sqlOwn = mysql_query("SELECT mobile_no,email,driver_name  FROM `drivers` where `driver_id` = '$drOwn'");
                            if(mysql_num_rows($sqlOwn) == 1){
                                $rowsOwn = mysql_fetch_assoc($sqlOwn);
                                $ownNo = $rowsOwn['mobile_no'];
                                $ownEmail = $rowsOwn['email'];
                                
                             }
                            } 
$mailSub = "Welcome mail from KK CABS.";
     $status = 1;
     
     $mailHead = '<img src="http://www.kkcabs.com/images/mail-head.gif" />';
     $mailFooter = '<img src="http://www.kkcabs.com/images/mail-footer.gif" />';
     $mailBody .= '<br><br>Hi ';
        if($drOwn != ''){
            $mailBody .= $rowsOwn['driver_name'];
        }else{
            $mailBody .= $rowsDrv['driver_name'];
        }
     $mailBody .= '<br><br> 
		At fist we would like to welcome you to the KK Cabs family!<br />
                Thank  you  for choosing  and becoming  an integral part of our team. <br />
                wish  you  a great  future  with  us  ahead.<br />
                Your cab '.$cabid.' is  and coordination no. +91-990230099 and ';
                     if($drOwn != ''){
                            $mailBody .=  'ur driver no. '.$drvMob.'.<br /><br />';
                        }else{
                            $mailBody .= 'ur no. '.$drvMob.'.<br /><br />';
                        }
                $mailBody .= 'For any further assistance we will  be available at 08041519999 or u can log on  to our website www.kkcabs.com.<br /><br /><br /><br />
             
		  Regards,<br />
                 MANAGEMENT,KK CABS<br /><br />';
        
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
                 
                }
            }
            $sqlSendMail = mysql_query("INSERT INTO `emailcontents` (`email_to`, `email_cc`, `email_subject`, `email_body`, `status`) VALUES ('$drvEmail', '$ownEmail', '$mailSub', '$mailContent', '$status')");

                 if(mysql_error()){
                     echo 'Try Again!!';
                 }else{
                     echo 'Mail send successfull.';
                 }
        }else{
            echo 'Driver Assign record not found';
        }
 ?>
