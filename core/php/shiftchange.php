<?php
require_once "../php/con-no-watch.php";
date_default_timezone_set('Asia/Kolkata'); //time stamp
session_start();
$empType = $_SESSION['EMP_TYPE'];  
$date = date('Y-m-d');    
 $eid = $_SESSION['EMP_ID'];
 $curentDate = date("Y-m-d");
 $curentTime = date( "Y-m-d H:i:s");
 if($eid == ""){
  echo 'Session Destory!!';
 }else{
    // echo 'Session Active!';
    // $date = date("Y");
     $sesSql = mysql_query("SELECT * FROM `employee_login` WHERE `emp_id` = '$eid' AND `status` = 1 ORDER BY `logoff_id` DESC ");
    
     if(mysql_error()){
         echo 'Session Destory!!';
     }else{
        $sesRows = mysql_fetch_assoc($sesSql);
        
        $workHrs = $sesRows['workin_time'];
        $timestamp_from_array = $sesRows['date'].' '.$sesRows['login_time'];
        
         if($empType == 1 || $empType == 6){
         echo '
                <table width="100%" style="font-size:12px;" align="center" valign="top">
                    <tr><td class="blue" align="left"><div id="netstatus"><i><img src="images/nedisconnected.png" width="16" height="16" /></i></div><b style="font-size:16px;float:right;"><img src="images/alarm.png" align="absmiddle" />'.date('H:i:s').'</span></td></tr>
                </table>
              ';
         }else{
         $passArg = array("-", ":", "");
         $passWork = str_replace($passArg, "", $workHrs);
         $DatTy = substr($passWork,0,8);
         $TimeTy = substr($passWork,9);
         $finWorkHrs = $DatTy.$TimeTy;
         $passCurent = trim(str_replace($passArg, "", $curentTime));
        //$argCur= var_dump($passCurent);
        echo '
                <table width="100%" style="font-size:12px;" align="center" valign="top">
                <tr>
                    <td class="green" align="center"><b>YOUR LOGIN TIME</b><br />'.$timestamp_from_array.'</td></tr>
                    <td class="redM" align="center"><b>ASSIGN HOURS</b><br />'.$workHrs.'</td>
                </tr>
                <tr>
                    <td class="blue" align="center"><div id="netstatus"><i><img src="images/nedisconnected.png" width="16" height="16" /></i></div><b style="font-size:16px;float:right;"><img src="images/alarm.png" align="absmiddle" />'.date('H:i:s').'</span></td>
                </tr>
                
</table>
              ';
        
                                
        /*if($passCurent >= $finWorkHrs){
         // header("location: ../../core/logout.php"); 
           echo 'here i am';
        }else{
            //echo $passCurent.'<br />'.$finWorkHrs;
        }
        */
            $date1 = new DateTime($curentTime);
            $date2 = new DateTime($workHrs);

           //echo  var_dump($date1 == $date2);
          // echo  var_dump($date1 < $date2);
          //$pasArg =  var_dump($date1 > $date2);
          if($date1 > $date2){
             header("location: ../../core/logout.php"); 
          }

     }
     }
 }
?>

<script>
var query = 'jquery';
var URL = 'https://ajax.googleapis.com/ajax/services/search/books?v=1.0&q=' + query;

$.ajax({
    type: 'GET',
    url: URL,
    dataType: 'jsonp',
    success: function( data, status ){
       // alert(' results found!');
       $('#netstatus').append('<img src="images/connected.png" width="16" height="16" />');
       $('#netstatus i').remove();
    },
    error: function() {
        //alert( 'Something goes wrong!' )
        $('#netstatus').append('<img src="images/nedisconnected.png" width="16" height="16" />');
    }
});
</script>