<?php
   require_once "../../core/php/connection.php";
 session_start();
$sDate = $_GET['startDate'];
$eDate = $_GET['endDate'];
$curDate = date('Y-m-d');
$empType = $_SESSION['EMP_TYPE'];

if($passEmpId == 'ALL'){
   $passQuery = ""; 
}else{
    $passQuery = " AND `emp_id` = '".$passEmpId."' "; 
}
   $query = "SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' AND `al_log_type` = 'BOK' OR `al_log_type` = 'DIS' OR `al_log_type` = 'CEL' GROUP BY `al_emp_id`";
    $sqlEmp = mysql_query($query);
?>
<script type="text/javascript">
var keepPopup = false;
function keepAlive(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}
function showAction(str)
{
	var uri = "../master/form/order-action.php?mode=cabTy&type="+str;
	var obj = document.getElementById("waitCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
}
function setVisibility(obj, id, visibility) {
	if(keepPopup) return;
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
	if(oTop>$(document).height()-50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}
</script>
<table width="100%" border="0" id="product-table">
  <tr>
    <th width="10%" class="table-header-repeat">Sl.No.</th>
    <th width="30%" class="table-header-repeat">Emp. Name</th>
    <th width="20%" class="table-header-repeat">Booked</th>
    <th width="20%" class="table-header-repeat">Dispatched</th>
    <th width="20%" class="table-header-repeat">Canceled</th>
  </tr>
  <?php
  $i = 1;
  $bok = 0;
  $dis = 0;
  $cel = 0;
   while($rows = mysql_fetch_assoc($sqlEmp)){
    $empId = $rows['al_emp_id'].'<br />';
	 // check for if employee is active or not
	 $sqlEmpsat = mysql_query("SELECT `emp_status`,`emp_id`,`access_level` FROM `employee` WHERE `emp_id` = '$empId'");
	 $rowSat = mysql_fetch_assoc($sqlEmpsat);
	 
	 //echo $rowSat['emp_id'].'-'.$rowSat['emp_status'].'<br />';
	 $empstatus = $rowSat['emp_status'];
	 //$accesslevel = $rowSat['access_level'];
	 $empMode = $rowSat['access_level'];
	 if($empstatus == 1){
			if($empMode == 1 || $empMode == 6 || $empMode == $empType){
				//echo 'do nothink';
			}else{
	$empid = $rowSat['emp_id'];
	$empQuery = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$empid'");
	$rowsEmp = mysql_fetch_assoc($empQuery);
	echo '<tr ';
       if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
       echo '>';
       echo '<td align="center">'.$t.'</td>';
       echo '<td>';
       echo '<b>[ '.$rowsEmp['username'].' ]</b> ';
           
           $f = $t++;
       echo "
  <a href=\"#\" onClick=\"keepAlive(this,'sub1".$f."');\" onMouseOver=\"setVisibility(this,'sub1".$f."', 'inline');\" onMouseOut=\"setVisibility(this,'sub1".$f."', 'none');\">
  ".$rowsEmp['emp_name']."
  </a>";
        echo '<div id="sub1'.$f.'" class="popup">';
        echo '<table width="100%" id="product_short"><tr><th colspan="2">Employee Details</th></tr>';
        echo '<tr><td rowspan="4">';
        $imgEmpl = $rowsEmp['emp_img_content'];
         
         if($imgEmpl == "" || $imgEmpl == "employeeImages/"){
              echo '<img src="images/user_png.png"  width="100" height="120" align="absmiddle"  />';
         }else{
               echo '<img src="'.$imgEmpl.'" width="100" height="120" align="absmiddle" style="background-color:#fff; padding:2px; margin-top:0px;" />';
        }
        echo '</td><td>'.$rowsEmp['emp_name'].'</td></tr>';
        echo '<tr><td>';
        $empTypel =  $rowsEmp['access_level'];
        $sqlAccCh = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = $empTypel");
        if(mysql_error()){
             echo 'Not Define';
        }else{
            $rowsApp = mysql_fetch_assoc($sqlAccCh);
            echo $rowsApp['access_type'];
        }
        echo '</td></tr>';
        echo '<tr><td>'.$rowsEmp['mobile_no'].'</td></tr>';
        echo '<tr><td>'.$rowsEmp['email'].'</td></tr>';
        echo '</table>';
        echo '</div>';
       
       
       echo '</td>';
       echo '<td align="center">';
       $sqlBok = mysql_query("SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' AND `al_log_type` = 'BOK' AND `al_emp_id` = '$empid'");
      if($empMode == 1 || $empMode == 6 || $empMode == $empType){
             //do nothink  
           }else{
               echo $b = mysql_num_rows($sqlBok);
                    $bok = $b+$bok;
           }
       
       echo '</td>';
       echo '<td align="center">';
       $sqlDis = mysql_query("SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' AND `al_log_type` = 'DIS' AND `al_emp_id` = '$empid'");
      if($empMode == 1 || $empMode == 6 || $empMode == $empType){
             //do nothink  
           }else{
               echo $d = mysql_num_rows($sqlDis);
               $dis = $d + $dis;
           }
       echo '</td>';
       echo '<td align="center">';
       $sqlCel = mysql_query("SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' AND `al_log_type` = 'CEL' AND `al_emp_id` = '$empid'");
       if($empMode == 1 || $empMode == 6 || $empMode == $empType){
             //do nothink  
           }else{
               echo $c = mysql_num_rows($sqlCel);
               $cel = $c+$cel;
           }
       echo '</td>';
       echo '</tr>';
       }
			}
			}
	 
   
   //echo '<tr><th colspan="2" align="right" class="table-header-repeat">TOTAL : </th><th class="table-header-repeat">'.$bok.'</th><th class="table-header-repeat">'.$dis.'</th><th class="table-header-repeat">'.$cel.'</th></tr>';
  ?>
           
</table>
