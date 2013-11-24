<?php
require_once "../../core/php/con-no-watch.php";
//echo 'HERE2';
$sqlCall = mysql_query("SELECT * FROM `callrecordtoday` ORDER BY `callRecID` DESC LIMIT 20");
if(mysql_error()){
    echo 'No Record Found!';
}else{
   // echo 'No Record';
    $count = mysql_num_rows($sqlCall);
    
    if($count == 0){
        echo 'No Record';
    }else{
     //echo 'HERE 1';
    while($rows = mysql_fetch_assoc($sqlCall)){
        echo '<li>" ';
      $empId = $rows['emp_id'];
      if($empId == ""){
               $empId = 'NULL'; 
            }
            else{
       $sqlEmp = mysql_query("SELECT username FROM `employee` WHERE `emp_id` = $empId");
        if(mysql_error()){
         echo mysql_error();
        }else{
                        
           $rowsEmp = mysql_fetch_array($sqlEmp);
           echo $rowsEmp['username'];
            }
        }
        echo '-';
        $custNo = $rows['number'];
        $subNo = substr($custNo,0,2);
              if($subNo == "80"){
                $ty = "P";
                $no = $custNo;
              }else{
                  $no = $custNo;
                 $ty = "M";
              }
        echo '<a href="#" id="../master/form/booking-form.php?ty='.$ty.'&no='.$custNo.'&pass=lkf" onClick="showMainAction(this.id)" style="color:#333;">'; 
        
        $sqlCunam = mysql_query("SELECT * FROM `cust_master` WHERE `mobile` = '$custNo' OR `alt_mobile` ='$custNo' OR `phone_no` = '$custNo'");
        $countCf = mysql_num_rows($sqlCunam);
        
        if($countCf == 0){
            echo $custNo;
        }else{
            $rocv = mysql_fetch_assoc($sqlCunam);
            echo $rocv['cust_name'];
        }
        echo '</a><em style="color:#efefef;">['.$rows['recTime'].']</em></li>';
    }
    }
}


?>
