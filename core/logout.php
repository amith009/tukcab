
<?php
session_start(); 
require_once "php/connection.php";
$eid = $_SESSION['EMP_ID'];
$client = $_SERVER['REMOTE_ADDR'];
$time = date("H:i:s");
$date = date("Y-m-d");
$emp_type = $_SESSION['EMP_TYPE'];
if($emp_type == 1 || $emp_type == 6){
    
unset($_SESSION['EMP_ID']);
	unset($_SESSION['EMP_NAME']);
	unset($_SESSION['EMP_TYPE']);
	unset($_SESSION['sessionTime']);
	session_destroy();
	?>
    <script type="text/javascript">
        window.location.replace("../auth/index.html");
    </script>
<?php
}else{
   
      $sesSql = mysql_query("SELECT * FROM `employee_login` WHERE `emp_id` = '$eid' AND `status` = 1 AND DATE_FORMAT(`date`, '%Y-%m-%d') = '$date' ORDER BY `logoff_id` DESC ");
    
     if(mysql_error()){
         echo 'Session Destory!!';
     }else{
        $sesRows = mysql_fetch_assoc($sesSql);
               
        $curentTime = date("Y-m-d H:i:s");
        
        $workHrs = $sesRows['workin_time'];
        $timestamp_from_array = $sesRows['date'].' '.$sesRows['login_time'];
        
         if($empType == 1 || $empType == 6){
            
         }else{
             $curentTime = date( "Y-m-d H:i:s");
        echo '
                <table width="100%" style="font-size:12px;" align="center" valign="top">
                
                    <tr >
                   <td class="green" align="center"><b>YOUR LOGIN TIME</b><br />'.$timestamp_from_array.'</td> </tr>
                    <td class="redM" align="center"><b>ASSIGN HOURS</b><br />'.$workHrs.'</td></tr>
                        <tr><td class="blue" align="center"><img src="images/alarm.png" align="absmiddle" />&nbsp;<b style="font-size:16px;">'.date('H:i:s').'</span></td></tr>
                </table>
              ';
        $date1 = new DateTime($curentTime);
            $date2 = new DateTime($workHrs);

           //echo  var_dump($date1 == $date2);
          // echo  var_dump($date1 < $date2);
          //$pasArg =  var_dump($date1 > $date2);
          if($date1 > $date2){
        
  $sql = mysql_query("UPDATE `employee_login` SET `logout_time` = '$time', `status` = 0 WHERE `date` = '$date' AND `emp_id` = '$eid'");
  if(mysql_error()){
      echo 'Please Contact your Administrator';
      exit(0);
  }
          unset($_SESSION['EMP_ID']);
	unset($_SESSION['EMP_NAME']);
	unset($_SESSION['EMP_TYPE']);
	unset($_SESSION['sessionTime']);
	session_destroy();
	?>
    <script type="text/javascript">
        window.location.replace("../auth/index.html");
    </script>
    <?php
           
        }else{
            ?>
    <script type="text/javascript">
       // alert('Your Logout Time Is Not Over!!');
       // window.location.reload();
    </script>
    <?php
        }
     }
     
  }
}


?>