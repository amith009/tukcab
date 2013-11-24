<?php

/***********************************************************
 * Author Amit Kuamr.
 * Date: 03-01-12
 * functions: this is fronted file for generated reporting for monthelly and yearelly reports
 */
//sassion_start();
require_once "../../core/php/connection.php";
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
<?php
$startDat = $_GET['satDat'];
$endDate = $_GET['enDat'];
$cabId = $_GET['cabId'];
if($cabId == "0"){
    $val = "";
   
}else{
  $val = " AND `al_log_code` = '$cabId'";
  
}
//echo $mm;
//$sqlCabPay = "SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$startDat' AND '$endDate' AND `al_log_type` = 'AFC' $val GROUP BY `al_log_code` ORDER BY `al_log_code`";
$sqlCabPay = "SELECT m.cab_id, m.cab_code, m.status, c.al_id, c.al_emp_id, c.al_log_type, c.al_log_code, c.al_comment, c.al_date
                FROM cabs m, app_log c WHERE m.cab_id = c.al_log_code AND c.al_log_type = 'AFC' AND m.status = 1 AND DATE_FORMAT(c.al_date, '%Y-%m-%d') BETWEEN '$startDat' AND '$endDate' GROUP BY c.al_log_code ORDER BY m.cab_code ASC";
$resCab = mysql_query($sqlCabPay);

if($resCab == TRUE){
    $i = 1;
    echo '<table width="100%" id="product-table">';
     echo '<tr>';
     echo '<th class="table-header-repeat">Sl No.</th>';
     echo '<th class="table-header-repeat">Cab Code.</th>';
     echo '<th class="table-header-repeat">Date</th>';
      echo '<th class="table-header-repeat">Login Time</th>';
     echo '<th class="table-header-repeat">Opp Id</th>';
             
     echo '</tr>';
     $countRe = mysql_num_rows($resCab);
     if($countRe == 0){
        echo '<tr><td align="center" colspan="9"><div><img src="images/001_11.png" width="24" height="24"><br><b>No Record Found!</b></div></td></tr>';
     }
     $i=1;
 while($rwoPay = mysql_fetch_assoc($resCab)){
          $t = $i++;
     echo '<tr align="center" ';
   
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   
	echo '>';
     echo '<td align="center" valign="top">';
     
     echo $t;
     echo '</td>';
     echo '<td align="center" valign="top">';
     $p = $t++;
     ?>
<a href="#" onClick="keepAlive(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $p; ?>', 'none');">
		<?php echo  $rwoPay['cab_code']; ?>
		</a>
		
<div id="sub1<?php echo $p; ?>" class="popup" style="overflow: auto; height: 200px; width: 400px;">
    <?php
    $cabId =  $rwoPay['al_log_code'];
    $sqlFreCab = mysql_query("SELECT * FROM `app_log` WHERE DATE_FORMAT(`al_date`, '%Y-%m-%d') BETWEEN '$startDat' AND '$endDate' AND `al_log_type` = 'AFC' AND `al_log_code` = '$cabId'");
    $totalPas = mysql_num_rows($sqlFreCab);
    ?>
    <table width="100%" cellspacing="0" id="product_short">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Opp. Id</th>
             <th>Area/Comnt.</th>
        </tr>
     <?php
     if(mysql_error()){
         echo '<tr><td colspan="5" align="center">No Record Found</td></tr>';
     }else{
         $c=0;
         echo '<tr><td colspan="5" style="background-color:#CCCCCC;"> TOTAL: '.$totalPas.'</td>';
         while($rowSub = mysql_fetch_assoc($sqlFreCab)){
            echo '<tr align="center" ';
            $h=$c++;
	if($h %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   
	echo '>';
             echo '<td>'.substr($rowSub['al_date'],0,10).'</td><td>'.substr($rowSub['al_date'],10).'</td><td>';
             $empId = $rowSub['al_emp_id'];
             $sqlEmp = mysql_query("SELECT emp_name FROM `employee` WHERE `emp_id` = '$empId'");
             $roEmpSub = mysql_fetch_assoc($sqlEmp);
             echo $roEmpSub['emp_name'];
             echo '</td>';
             echo '<td>';
             $areId =  $rowSub['al_comment'];
             if(is_numeric($areId)){
                $sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
                if(mysql_error()){
                        echo $areId;
                }else{
                        $roAre = mysql_fetch_assoc($sqlAre);
                        
                        echo $roAre['area_name'];
                }
             }else{
                echo $areId; 
             }
             echo '</td>';
             echo '</tr>'; 
         }
     }
     ?>
    </table>
</div>
<?php
     
     echo '</td>';
     echo '<td>'.substr($rwoPay['al_date'],0,10).'</td><td>'.substr($rwoPay['al_date'],10).'</td><td>';
     $empId = $rwoPay['al_emp_id'];
     $sqlEmp = mysql_query("SELECT emp_name FROM `employee` WHERE `emp_id` = '$empId'");
     $roEmp = mysql_fetch_assoc($sqlEmp);
     echo $roEmp['emp_name'];
     echo '</td>';
     echo '</tr>';           
     
 }//while close
}


?>

