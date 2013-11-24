<?php
require_once "../../core/php/con-no-watch.php";
$CurDate = date("Y-m-d");
	$sqlBook = mysql_query("SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$CurDate' AND al_log_type not in('AFC','UBO','ACD','ADN','SPC') order by al_id DESC LIMIT 20");
	if(mysql_error()){
		echo 'No Record Found';
	}else{
		
echo '
<table width="100%" border="0" id="product-table">
  <tr>
    <td bgcolor="#CCCCCC" style="text-align:center;"><img src="images/actions/cancelled_order.png" width="16" height="16" align="absmiddle" /> <b>Order Actions</b></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
  <tr>
    <th width="25%" class="table-header-repeat">Sl No.</th>
    <th width="25%" class="table-header-repeat">Order No.</th>
    <th width="25%" class="table-header-repeat">Employee</th>
    <th width="25%" class="table-header-repeat">Action Take</th>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td>
    
    <table width="100%" border="0">';
$i = 1;
   while($rowApp = mysql_fetch_assoc($sqlBook)){
       echo '<tr>';
       echo '<td width="25%">'.$i++.'</td>';
       echo '<td width="25%">'.$rowApp['al_log_code'].'</td>';
      echo '<td width="25%">';
      $empId = $rowApp['al_emp_id'];
      $sqlEmp = mysql_query("SELECT emp_name,username FROM `employee` WHERE `emp_id`= $empId");
      if(mysql_error()){
          echo '-';
      }else{
          $roEmp = mysql_fetch_assoc($sqlEmp);
          echo '['.$roEmp['username'].']'.$roEmp['emp_name'];
      }
      echo '</td>';
      echo '<td width="25%">';
      $typSrv = $rowApp['al_log_type'];
      if($typSrv == "DIS"){
          echo 'Dispatch';
      }elseif($typSrv == "BOK"){
          echo 'Booked';
      }
      elseif($typSrv == "CHC"){
          echo "Change Cab";
      }
      elseif($typSrv == "CEL"){
          echo "Cancel";
      }else{
          echo $typSrv;
      }
      
      echo '</td>';
       echo '</tr>';
   }
	
   echo '</table>
   
    </td>
  </tr>
  
</table>';
        }
	//main else close
?>