<?php
 require_once "../../core/php/connection.php";
 $orId = $_GET['id'];
 $updateOrd = mysql_query("UPDATE `online_record` SET `status` = 2 WHERE `booking_id` = $orId");
 if(mysql_error()){
     echo 'Unable to Update record!! Try Again';
 }
 $sqlOnl = mysql_query("SELECT * FROM `online_record` WHERE `booking_id` = $orId");
 if(mysql_error()){
     echo 'No Record Found!!';
 }else{
     $rowsOr = mysql_fetch_assoc($sqlOnl);
     
     
     $toMail = $rowsOr['CustEmail'];
     $ccMail = $rowsOr['CustEmail'];
     $custName = $rowsOr['custName'];
     $orderNo = $rowsOr['booking_code'];
     $dateOr = $rowsOr['date'];
     $timeOr = $rowsOr['time'];
     $mailSub = "KK CAB Services.";
     $status = 1;
	 $mailHead = '<img src="http://www.kkcabs.com/images/mail-head.gif" />';
     $mailFooter = '<img src="http://www.kkcabs.com/images/mail-footer.gif" />';
     $mailBody = '<br><br>Dear '.$custName.',<br><br> 
		Your booking with refrance '.$orderNo.' has been confrimed. We will send you the cab and driver details before 30 minutes of schduled departure.<br><br> Thanks for choosing <a href="http://www.kkcabs.com/">KK CABS</a><br><br>
		KK Cabs<br>
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
     $sqlSendMail = mysql_query("INSERT INTO `emailcontents` (`email_to`, `email_cc`, `email_subject`, `email_body`, `status`) VALUES ('$toMail', '$ccMail', '$mailSub', '$mailContent', '$status')");
     
     if(mysql_error()){
         echo 'Try Again!!';
     }else{
         echo 'Mail send successfull.';
     }
     
 }
?>