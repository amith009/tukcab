<?php error_reporting(0); ?>
<?php

/*
 * This is core coonection for IPBX call informations
 * Develop By: amit Kumar
 * date: 15-08-2012
 */
date_default_timezone_set('Asia/Kolkata'); //time stamp

$curDate = date("Y-m-d");
require_once "../../core/php/connection.php";

$coreConn = mysql_connect('localhost','root','THIPARAMBIL');

if($coreConn == true){
    
    $coreDb = mysql_select_db('coreconnection', $coreConn);
    //$cDb = mysql_select_db('easybooking', $coreConn);
    if($coreDb == TRUE){
        //echo 'Ready to Attend Call';
        /*Track Number start here*/
        
       $query = "SELECT no,date,status FROM `callrecord` WHERE DATE_FORMAT(`date`, '%Y-%m-%d') = '$curDate'  ORDER BY `cid` DESC LIMIT 10";
        
        $result = mysql_query($query);
        
        if($result == TRUE){
            $count = mysql_num_rows($result);
            if($count == 0){
                echo '<br /> <img src="../core/images/hourglass.png" align="absmiddle" />  Waiting For Call';
				//echo $curDate;
            }else{
                echo '<ul>';
                $i=0;
                while($rows = mysql_fetch_assoc($result)){
                   
                    $curNo = $rows['no'];
                    $time = substr($rows['date'],10);
                    $chkNo = substr($curNo,10,12);
                    $passArg = trim(substr($curNo,0,9));
                   // exit(0);
                    if($passArg == "CallState"){
                        //do nothink
                    }else{
                    $trimmed = trim($chkNo);
                   //var_dump($trimmed);
                    if($trimmed == "OwnerDecrem" || $trimmed == "" || $trimmed == "NumberOfMon" || $trimmed == "CallReason," || $trimmed == "ConnectedId" || $trimmed == "CallOrigin," || $trimmed == "OwnerIncrem"){
                        //do nothink
                    }else{
                                                
                       $unWaPar = array("C", "O", "N", 'NumberOf', 'umberf', 'allrig', 'u', 'w', 'a', 'n', 'L', 'l', 'nerDec', 'llri', 'erDe', 'ri', 'c');
                       $onlyconsonants = str_replace($unWaPar, "", $trimmed);
                       $FinalNo = strlen($onlyconsonants);
                       if($FinalNo == 12){
                          $conNo = substr($onlyconsonants,2,10); 
                       }else{
                           $conNo = $onlyconsonants;
                       }
                       
                       $sqlNam = mysql_query("SELECT    A.no AS FirstColumn,
                                                        B.cust_name AS bname,
                                                        B.mobile AS bmob,
                                                        B.alt_mobile AS bamob,
                                                        B.phone_no As bpno
                                             FROM       coreconnection.callrecord AS A,
                                                        easybooking.cust_master AS B
                                             WHERE      B.mobile = '$conNo' OR B.phone_no = '$conNo'"
                                            );
                       $countNum = mysql_num_rows($sqlNam);
                       if($rows['status'] == 1){
                            if($countNum == 0){
                                   echo '<li class="mised" style="font-size:14px;"><a href="#" id="../master/form/booking-form.php?ty=null&no='.trim($conNo).'&sat=1" onClick="showMainAction(this.id)" title="Booking Form">'.$conNo.'</a></li>';
                               }else{
                                   $rowsNum = mysql_fetch_assoc($sqlNam);
                                   echo '<li class="mised" style="font-size:14px;"><a href="#" id="../master/form/booking-form.php?ty=null&no='.trim($conNo).'&sat=1" onClick="showMainAction(this.id)" title="Booking Form">'.$rowsNum['bname'].'</a></li>';
                                }
                       }elseif($rows['status'] == 0){
                            if($countNum == 0){
                                   echo '<li class="newcall" style="font-size:14px;"><a href="#" id="../master/form/booking-form.php?ty=null&no='.trim($conNo).'&sat=1" onClick="showMainAction(this.id)" title="Booking Form">'.$conNo.'</a></li>';
                               }else{
                                   $rowsNum = mysql_fetch_assoc($sqlNam);
                                   echo '<li class="newcall" style="font-size:14px;"><a href="#" id="../master/form/booking-form.php?ty=null&no='.trim($conNo).'&sat=1" onClick="showMainAction(this.id)" title="Booking Form">'.$rowsNum['bname'].'</a></li>';
                                }
                       }else{
                           
                       }
                           
                                //break;
                             }       
                         }
                         //update cols
                          $calSat = strstr($curNo, 'OwnerDecrement');                       
                            if($calSat == true){
                             $sqlUp = mysql_query("UPDATE `callrecord` SET `status` = 1 WHERE `no` LIKE '%".$conNo."%'");
                             $sqlDel = mysql_query("DELETE FROM  `callrecord` WHERE `no` LIKE '%CallState:%'");
                             $sqlAno = mysql_query("DELETE FROM  `callrecord` WHERE `no` LIKE '%CallOrigin%' AND `no` LIKE '%".$conNo."%'");
                            }
                         
                }
                echo '<ul>';
            }
        }
        
        /*End Tracking Number*/
    }else{
        echo '<br /> <img src="../core/images/database_delete.png" align="absmiddle" /> DB Connection Close <br /> Contact Administrator.';
    }
    
}else{
    echo '<br /> <img src="../core/images/disconnect.png" align="absmiddle" /> Server Disconnected <br /> Contact Administrator.';
}
?>
