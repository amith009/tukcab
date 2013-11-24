<?php
 require_once "../../core/php/connection.php";
 $orId = $_GET['id'];
 
 //$sqlOnl = mysql_query("SELECT * FROM `online_record` WHERE `booking_id` = $orId");
 $sqlOnl = mysql_query("SELECT driver_id,booking_code,cab_id,cust_id FROM `book_master` WHERE `booking_id` = $orId");
 if(mysql_error()){
     echo 'No Record Found!!';
 }else{
        $rowsOr = mysql_fetch_assoc($sqlOnl);
        $drivId = $rowsOr['driver_id'];
        $orderNo = $rowsOr['booking_code']; 
        $cabId =  $rowsOr['cab_id'];
        $custId = $rowsOr['cust_id'];
        $dateOr = $rowsOr['required_date'];
        $timeOr = $rowsOr['required_time'];
     //tarck customer
     $sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = $custId");
     if(mysql_error()){
         echo 'Customer Record Not Found!!';
         exit(0);
     }
         $rowsCust = mysql_fetch_assoc($sqlCust);
         $ccMail = $rowsCust['email'];
         $toMail = $rowsCust['email'];
         $custName = $rowsCust['cust_name'];
    
    //tarck driver record
         $sqlDriv = mysql_query("SELECT mobile_no,driver_name,image_file FROM `drivers` WHERE `driver_id` = $drivId AND `status` = 1");
         if(mysql_error()){
             echo 'Driver record not Found.';
             exit(0);
         }
         //mail sending start here
         $rowsDriv = mysql_fetch_assoc($sqlDriv);
         $drivNo = $rowsDriv['mobile_no'];
         $drivName = $rowsDriv['driver_name'];
         
         $drivImg = $rowsDriv['image_file'];
         if($drivImg == ""){
            $drivImgShow = "driver_images/default_driver.gif"; 
         }else{
            $drivImgShow =  $drivImg;
         }
     //Track Cab Record
         $sqlCab = mysql_query("SELECT plate_no FROM `cabs` WHERE `cab_id` = $cabId AND `status` = 1");
         if(mysql_error()){
           echo 'Cab record Not Found!';
           exit(0);
         }
         $rowsCab = mysql_fetch_assoc($sqlCab);
         
     $plateNo = $rowsCab['plate_no'];
     $mailSub = "KK CAB Services.";
     $status = 1;
     
     $mailHead = '<img src="http://www.kkcabs.com/images/mail-head.gif" />';
     $mailFooter = '<img src="http://www.kkcabs.com/images/mail-footer.gif" />';
     $mailBody = '<br><br>Dear '.$custName.',<br><br> 
		Your booking with referance '.$orderNo.' has been Dispatch.<br><br>
                 
                 <table width="400px" border="0">
                <tr><td colspan="2" style="padding:10px;"><b>Your driver details.</b></td></tr> 
                <tr><td rowspan="4" align="center" valign="top"><img src="http://www.kkcabs.com/'.$drivImgShow.'" width="100" height="110" style="border:5px #909498 solid;"  /></td>
                <td align="left"><b>Name : </b> '.$drivName.'</td></tr>
                <tr><td align="left"><b>Contact No. </b>'.$drivNo.'</td></tr>
                <tr><td align="left"><b>Cab Plate No. </b>'.$plateNo.'</td></tr>
                
                </table>
                <br><br> Thanks for choosing <a href="http://www.kkcabs.com/">KK CABS</a>. Wish you a safe and pleasant ride.<br><br>
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