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
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$tySrv = $_GET['type'];
$mode = $_GET['mode'];
$email = $_GET['emId'];
$mob = $_GET['mob'];
$datE = $_GET['datE'];
$datS = $_GET['datS'];
//as per cab type
if($mode == "cabTy"){
	
	if($tySrv == "ALL"){
            $sat = 1;
	     $valSrv = "";
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		 $datAccs = 0;
		}else{
                    $sat = 1;
	     $valSrv = "AND `cab_type` = ".$tySrv;
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		 $datAccs = 0;
        }
}
elseif($mode == "ONL"){
    $sat = 1;
    $valDat = "OR `CustEmail` = '$email' OR `cust_no` = '$mob' OR DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN '$datE' AND '$datS'";
}
//for services
elseif($mode == "srvTy"){
    $sat = 1;
	if($tySrv == "ALL"){
		$valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		$datAccs = 0;
	    $valSrv = "";
		}else{
		$valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
                $valSrv = "AND `service_type` = ".$tySrv;
		$datAccs = 0;
        }
}
elseif($mode == "srvOrder"){
    $sat = 1;
	if($tySrv == "ALL"){
		$valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
	    $valSrv = "";
		$datAccs = 0;
		}else{
		$valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
	    $valSrv = "AND `booking_code` = ".$tySrv;
		$datAccs = 0;
        }
}
//as per pickup point
elseif($mode == "pkUp"){
	$sat = 1;
	if($tySrv == "ALL"){
	     $valSrv = "";
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		 $datAccs = 0;
		}else{
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		 $calVal = substr($tySrv,0,1);
	     $valSrv = "AND `pickup` LIKE '%".$calVal."%'";
		 $datAccs = 0;
        }
		
}
//as per cab type
elseif($mode == "srCab"){
    $sat = 1;
	//echo $tySrv;
	if($tySrv == "ALL"){
	     $valSrv = "";
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
		 $datAccs = 0;
		}else{
		 $valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
	     $valSrv = "AND `cab_type` = '".$tySrv."'";
		 $datAccs = 0;
        }
		
}
elseif($mode == "srDat"){
    $sat = 1;
	       $valDat = "";
		 $valSrv = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$tySrv."'";
		 $datAccs = 1;
}
else{
    $sat = 1;
	$calVal = "";
	$valSrv = " ";
	$valDat = "AND DATE_FORMAT(`date`, '%Y-%m-%d') = '".$date."'";
	$datAccs = 0;
}

//end here
$pass = "SELECT * FROM `online_record` WHERE `status` = '$sat' $valDat $valSrv ORDER BY `time` ASC";
$sql = mysql_query($pass);
$count = mysql_num_rows($sql);
echo'
<table width="100%" border="0"  id="product-table">

  <tr>';
  if($empType == 1 || $empType == 6){
	 echo '<th width="7%" class="table-header-repeat">Sl. No.</th>';
  }else{
  }
  echo '
    <th width="10%" class="table-header-repeat">Order No.</th>
    <th width="11%" class="table-header-repeat">Customer</th>
    <th width="7%" class="table-header-repeat">Pickup </th>
    <th width="10%" class="table-header-repeat">Type of Cab</th>
    <th width="9%" class="table-header-repeat">Srv. Type</th>
    <th width="15%" class="table-header-repeat">Time</th>
    <th width="12%" class="table-header-repeat">Dropup Point</th>
    <th width="15%" class="table-header-repeat">Action</th>
  </tr>';
  
  if($count == 0){
	  echo '<tr>
    <td colspan="10" align="center">
    <img src="images/001_11.png" width="24" height="24" />
    <br />
    <font color="#CC3300"><strong>No Record Found!!</strong></font>
    </td>
  </tr>';
  }else{
  }
  $i = 1;
  while($rows = mysql_fetch_assoc($sql)){
  $t = $i++;
  $sat = $rows['status'];
   echo '<tr align="center" ';
   if($sat == 3){
	   echo 'class="redM"';
   }else{
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   }
	echo '>';
	
    if($empType == 1 || $empType == 6){
	 echo '<td width="7%">'.$t.'</td>';
  }else{
  }
  echo' <td>'.$rows['booking_code'].'</td>
    <td>';
		$p = $i++;	
		?>
      <a href="#" onClick="keepAlive(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $p; ?>', 'none');">
		<?php echo $rows['custName']; ?>
		</a>
		<?php echo  $rows['cust_no'];?>
        <div id="sub1<?php echo $p; ?>" class="popup">
        <?php
                        echo '<table width="100%"><tr class="row-active"><td>Mobile:</td><td>'.$rows['cust_no'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Email:</td><td>'.$rows['CustEmail'].'</td></tr>';
                        echo '<tr class="row-active"><td valign="top">Address</td><td>';
			echo $rows['address'];
			echo '</td></tr></table>';
		
		?>
        </div>
        <?php
	
	echo'</td>
    <td>';
	$areId = $rows['pickup'];
        
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
	}
	echo '</td>
    <td>';
	$cabTy = $rows['cabType'];
	$sqlTy = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = $cabTy");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roTy = mysql_fetch_assoc($sqlTy);
		echo '<font style="color:red;"><b>'.$roTy['cab_type_name'].'</b></font>';
	}
	echo '</td>
    <td>';
	$srvTy = $rows['servicesType'];
	$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTy'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
            $roSrTy = mysql_fetch_assoc($sqlSrv);
         echo $roSrTy['service_type'].'<br>';
                
              if($srvTy == 5){
                  $rdate = $rows['date'];
                  $edate = $rows['end_date'];
                 $date1 = strtotime($rdate);
                 $date2 = strtotime($edate);
                  $datediff = $date2-$date1;
                  $coDat = floor($datediff/(60*60*24))+1;
                 echo "<font style=\"color:#996600;\"><b>".$coDat." day's</b></font>";
              }elseif($srvTy == 6){
                   $rdate = $rows['date'];
                   $edate = $rows['end_date'];
                   $date1 = strtotime($rdate);
                   $date2 = strtotime($edate);
                   $datediff = $date2-$date1;
                   $coDat = floor($datediff/(60*60*24))+1;
                 echo "<font style=\"color:#990066;\"><b>".$coDat." day's</b></font>";
              }
		
	}
	echo '</td>
    <td>';
	echo $rows['time'];
	echo '</td><td>';
    
	$dropUp = $rows['dropPoint'];
	$sqlDroAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$dropUp'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roDrAre = mysql_fetch_assoc($sqlDroAre);
		echo $roDrAre['area_name'];
	}
	echo '</td>
	
    <td>';
	?> <img src="images/document-revert.png" width="20" height="20" align="absmiddle">
<a href="#" id="../master/form/confirm-order.php?id=<?php echo $rows['booking_id']; ?>" onClick="showMainAction(this.id)">Confirm Order</a>
<!--     
<form action=""> 
            <select name="srvType" onchange="showAction(this.value);">
            <option value="VE-<?php echo $rows['booking_id']; ?>">Select Action</option>
           <option value="VE-<?php //echo $rows['booking_id']; ?>">View Order</option>
          <option value="ED-<?php echo $rows['booking_id']; ?>">Edit Order</option>
           <?php
		   
		   if($sat == 1){
			   ?>
               <option value="AS-<?php echo $rows['booking_id']; ?>">Assign Cab</option>
               <?php  }else{  ?>
               <option value="CC-<?php echo $rows['booking_id']; ?>">Change Cab</option>
               <?php
			   }
			  
		   if($sat != 1){
			   ?>
               <option value="AD-<?php echo $rows['booking_id']; ?>">Add Complain</option>
               <option value="AT-<?php echo $rows['booking_id']; ?>">Add Trip</option>
               <?php  }  ?>
           <option value="CO-<?php echo $rows['booking_id']; ?>">Cancel Order</option>
            <?php
		   if($empType == 1 || $empType == 2 || $empType == 5 || $empType == 6){
			   ?>
               <option value="HI-<?php echo $rows['booking_code']; ?>">History</option>
               <?php
		   }
		   ?>
           <option disabled="disabled">--------------------</option>
           <option value="DLO-<?php echo $rows['booking_id']; ?>">Delete Order</option>
            </select>
            </form>	-->
           <?php
	echo '
	</td>
  </tr>';
  
  }//while close
  ?>
</table>
