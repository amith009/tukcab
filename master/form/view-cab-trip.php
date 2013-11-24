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
/*********************************************************************************************

File Name: waiting-order-list.php
Work and function: display list all free cab avilable.
T=table name -> waith order list here
##########
Create date = 30 NOV 2011
Time: 08:05
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$cabId = $_GET['id'];
$sDate = $_GET['sDate'];
$eDate = $_GET['eDate'];
$date = date('Y-m-d');
$sqlOrder = mysql_query("SELECT * FROM `book_master` WHERE `cab_id` = $cabId AND `required_date` = '$date' AND `status` = 2 ORDER BY `required_time` DESC");
//$sqlOrder = mysql_query("SELECT * FROM `book_master` WHERE `cab_id` = $cabId AND DATA_FORMAT(`required_date`,'%Y-%m-%d') BETWEEN '$sDate' AND '$eDate' AND `status` = 2 ORDER BY `required_time` DESC");
$countOrder = mysql_num_rows($sqlOrder);
$sqlCab = mysql_query("SELECT cab_code FROM `cabs` where cab_id = $cabId");
$rowscab = mysql_fetch_assoc($sqlCab);

echo '<table width="100%" border="0" align="center" id="product-table">
    <tr><td colspan="40" class="blue-left">Trip details for '.$rowscab['cab_code'].'
	<a style="float:right;margin-right:20px;" href="../master/form/export_csv.php?id='.$cabId.'&sDate='.$sDate.'&eDate='.$eDate.'" target="_blank"><img src="images/arrow-step-over.png" /> Export</a>
	</td></tr>
  <tr>';
if($empType == 1 || $empType == 6){
	 echo '
    <th class="table-header-repeat">Sl. No.</th>';
  }else{
  }echo '
    <th class="table-header-repeat">Order no.</th>
    <th class="table-header-repeat">Date / Time</th>
    <th class="table-header-repeat">Pickup</th>
    <th class="table-header-repeat">Srv. Type</th>
    <th class="table-header-repeat">Pay Mode</th>
    <th class="table-header-repeat">Drop Off</th>
    <th class="table-header-repeat">Amount</th>
  </tr>';
  
  if($countOrder == 0){
	  echo '<tr><td colspan="10">No Record Found</td></tr>';
	}else{
  $i = 1;
  $totalAmount = 0;
  while($rowsOrd = mysql_fetch_assoc($sqlOrder)){ 
   $t = $i++;
   $cuMid = $rowsOrd['cust_id'];
   echo '<tr align="center" ';
  
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	echo '>';
	if($empType == 1 || $empType == 6){
	 echo '<td width="7%">'.$t.'</td>';
  }else{
  }
    echo '
    <td>'.$rowsOrd['booking_code'].'</td>
    <td>'.$rowsOrd['required_date'].'<br>'.$rowsOrd['required_time'].'</td>
    </td>
    <td>';
	$piUp = $rowsOrd['pickup_point'];
	 $areIdh = strpbrk($piUp,"+");
        $areId =  substr($areIdh,1);
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
	if(mysql_error()){
		$areName = 'Not Found!';
	}else{
		$roAre = mysql_fetch_assoc($sqlAre);
		$areName = $roAre['area_name'];
	}
        $p = $t++;
        ?>
      <a href="#" onClick="keepAlive(this,'sub11<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub11<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub11<?php echo $p; ?>', 'none');">
		<?php echo $areName; ?>
		</a>
		
        <div id="sub11<?php echo $p; ?>" class="popup">
        <?php
		$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuMid'");
		$sqlMas = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuMid'");
		if(mysql_error()){
			//do nothing
		}else{
			$rop = mysql_fetch_assoc($sqlAdd);
			$rl = mysql_fetch_assoc($sqlMas);
			echo '<table width="100%">';
			echo '<tr class="row-inactive"><td valign="top">Customer: </td><td>'.$rl['cust_name'].'</td></tr>';
                        echo '<tr class="row-active"><td valign="top">No: </td><td>'.$rl['mobile'].'</td></tr>';
			echo '<tr class="row-inactive"><td valign="top">Address</td><td>';
			$ppO = $rowsOrd['pickup_point'];
			$adt = explode("+",$ppO);
			echo current($adt);
			
			echo '</td></tr>
			
			</table>';
		}
		?>
        </div>
        <?php
	echo '</td>
     <td>';
	$srvTy = $rowsOrd['service_type'];
	$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTy'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roSrTy = mysql_fetch_assoc($sqlSrv);
		echo $roSrTy['service_type'];
	}
	echo '</td>
   <td>';
	$pmo = $rowsOrd['payment_mode'];
	if($pmo == 1){
		echo 'Cash';
	}
	elseif($pmo == 2){
		echo 'Cheque';
	}
	elseif($pmo == 3){
		echo 'Credit';
	}
	else{
		echo 'N/A';
	}
	echo '</td>
  <td>';
	$dropUp = $rowsOrd['destination'];
	$sqlDroAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$dropUp'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roDrAre = mysql_fetch_assoc($sqlDroAre);
		echo $roDrAre['area_name'];
	}
	echo '</td>
    <td>';
	$orId = $rowsOrd['booking_id'];
	$sqlTrip = mysql_query("SELECT * FROM `trip_details` WHERE `booking_id` = '$orId' AND `status` = 0");
	$count = mysql_num_rows($sqlTrip);
	if($count == 0){
		$amount = 0;
	}else{
		$rowsTr = mysql_fetch_assoc($sqlTrip);
		$amount = $rowsTr['amount'];
	}
	$totalAmount = $amount+$totalAmount;
	printf("%.2f",$amount);
	echo '</td>
  </tr>
  ';
    }//while close
  echo '<tr><th colspan="7" align="right" class="table-header-repeat" ><strong>Total Amount</strong></th><th align="center" class="table-header-repeat"><img src="images/rs.png" width="13" height="13" />';
  printf("%.2f",$totalAmount); echo '</th></tr>';
  echo '</table>';
	}
?>
