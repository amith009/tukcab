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
/** VARIABLE DECLARATION **/
$date = date("Y-m-d");
$order = $_GET['order'];
$area = $_GET['area'];
$services = $_GET['services'];
$cabtype = $_GET['cabtype'];
$boktype = $_GET['boktype'];
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];
$sermode = $_GET['sermode'];
?>
<script type="text/javascript">
function showPayment(){
	var cabIdY = document.getElementById("cabId").value;
	var cabMonY = document.getElementById("cabMon").value;
	var cabYerY = document.getElementById("cabYer").value;
	
	var subA = $.ajax({
				url: '../master/form/backed-payment.php',
				type: 'POST',
				data: {cabId:cabIdY, cbaMonth:cabMonY, cabYear:cabYerY},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#payment").html(data);
	});
}

function gotoPage(start,end,cabtype){
	var uri = "../master/form/dispatch-call-back.php?startdate=<?php echo $startdate; ?>&enddate=<?php echo $enddate; ?>&s="+start+"&e="+end+"&cabtype="+cabtype;
	var obj = document.getElementById("dispatchCabList");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showAction(str)
{
	var uri = "../master/form/order-action.php?mode=cabTy&type="+str;
	var obj = document.getElementById("dispatchCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
}
</script>
<?php

if(isset($_GET['s']))
	$pStart = $_GET['s'];
else
	$pStart = 0;
	
$pageSize = 20;

if($boktype == 1){
    $valPass = " AND `onlineBook` = '$boktype'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
    $valOrderBy = " ORDER BY `required_time` DESC";
}
elseif($startdate == ""){
    $valPass = "";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$date' AND '$date' ";
    $valOrderBy = " ORDER BY `required_time` DESC";
}
elseif($order != ""){
    /* BY ORDER NUMBER*/
    
    if($sermode == "OR"){
            $valPass = " AND `booking_code` = '$order'";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
            $valOrderBy = " ORDER BY `required_time` DESC";
        }
   /* BY MOBILE NUMBER */
        elseif($sermode == "MO"){
          $sqlCust = mysql_query("SELECT `cust_id` FROM `cust_master` WHERE `mobile` = '$order' OR `alt_mobile` = '$order'");
            if(mysql_error()){
               $custId = 0; 
            }else{
                $rocu = mysql_fetch_assoc($sqlCust);
                $custId = $rocu['cust_id'];
            }
        $valPass = " AND `cust_id` = '$custId'";
        $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
        $valOrderBy = " ORDER BY `required_time` DESC"; 
        }
/* BY EMAIL ADDRESS*/
        elseif($sermode == "EM"){
            $sqlCustM = mysql_query("SELECT `cust_id` FROM `cust_master` WHERE `email` = '$order' OR `alt_email` = '$order'");
            if(mysql_error()){
               echo $custId = 0; 
            }else{
                $rocu = mysql_fetch_assoc($sqlCustM);
               echo  $custId = $rocu['cust_id'];
            }
            $valPass = " AND `cust_id` = '$custId'";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
            $valOrderBy = " ORDER BY `required_time` DESC";
        }
/* BY PHONE NUMBER */
        elseif($sermode == "PH"){
            $sqlCustM = mysql_query("SELECT `cust_id` FROM `cust_master` WHERE `phone_no` = '$order'");
            if(mysql_error()){
               $custId = 0; 
            }else{
                $rocu = mysql_fetch_assoc($sqlCustM);
                $custId = $rocu['cust_id'];
            }
            $valPass = " AND `cust_id` = '$custId'";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
            $valOrderBy = " ORDER BY `required_time` DESC";
        } else{
            $valPass = "";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
            $valOrderBy = " ORDER BY `required_time` DESC";
        }
}
/* BY AREA */
elseif($area != 0){
    $pasArea = "+".$area;
    $valPass = " AND `destination` = '$pasArea'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
    $valOrderBy = " ORDER BY `required_time` DESC";
}
/* BY SERVICES */
elseif($services != 0){
    $valPass = " AND `service_type` = '$services'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
    $valOrderBy = " ORDER BY `required_time` DESC";
}
/* BY CAB ID */
elseif($cabtype != 0){
    $valPass = " AND `cab_id` = '$cabtype'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
    $valOrderBay = "ORDER BY `required_date` ASC";
}
/* BY DATE */
elseif($startdate != $date){
    $valPass = "";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate'"; 
    $valOrderBy = " ORDER BY `required_time` DESC";
}

else{
    $valPass = "";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$date' AND '$date' ";
    $valOrderBy = " ORDER BY `required_time` DESC";
}
//end here

$sqlCount = mysql_query("SELECT count(1) cnt FROM `book_master` WHERE `status` = 2 $valPass $valDate");
$rowCount = mysql_fetch_assoc($sqlCount);
$resCount = $rowCount['cnt'];

$sqlQuery = "SELECT * FROM `book_master` WHERE `status` = 2 $valPass $valDate $valOrderBy LIMIT $pStart,$pageSize";
$sql = mysql_query($sqlQuery);
$count = mysql_num_rows($sql);
echo'
<table width="100%" border="0" id="product-table">
  <tr>';
  if($empType == 1 || $empType == 6){
	 echo '<th width="7%" class="table-header-repeat">Sl. No.</th>';
  }else{
  }
  echo '
    <th width="10%" class="table-header-repeat">Order No.</th>
    <th width="16%" class="table-header-repeat">Customer</th>
    <th width="10%" class="table-header-repeat">Cab Id</th>
    <th width="16%" class="table-header-repeat">Driver</th>
    <th width="11%" class="table-header-repeat">Cab Type</th>
    <th width="15%" class="table-header-repeat">Remark</th>
    <th width="9%"  class="table-header-repeat">Date / Time</th>
    <th width="12%" class="table-header-repeat">Pay. Mode</th>
    <th width="17%" class="table-header-repeat">Destination</th>
    <th width="7%" class="table-header-repeat">Action</th>
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
  //$i = 1;
  $i = $pStart+1;
  while($rows = mysql_fetch_assoc($sql)){
  $t = $i++;
  $bid = $rows['booking_id'];
  $sqlTrip = mysql_query("SELECT status FROM `trip_details` WHERE `booking_id` = $bid");
  $counttr = mysql_num_rows($sqlTrip);
  if($sqlTrip == TRUE){
	  $roTrp = mysql_fetch_assoc($sqlTrip);
	  $satTrip = $roTrp['status']; 
  }else{
	  $satTrip = 0;
  }
  $st = $satTrip;
  $sat = $rows['status'];
   echo '<tr align="center" ';
   if($st == 1){
	   echo 'class="green"';
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
    echo' <td>';
  $onp = $rows['onlineBook'];
  if($onp != 0){
  echo '<span style="color:#0000CC; font-weight:bold;"><img src="images/on.png" width="12" height="12">'.$rows['booking_code'].'</span>';
      
  }else{
  echo '<img src="images/off.png" width="12" height="12">'.$rows['booking_code'];
  }
  echo '</td>
    <td>';
 
	$cuId = $rows['cust_id'];
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuId'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$j = $t++;
		$roCust = mysql_fetch_assoc($sqlCust);
		$cuMid = $roCust['cust_id']; //call for address
		?>
        <a href="#" onClick="keepAlive(this,'cust1<?php echo $j; ?>');" onMouseOver="setVisibility(this,'cust1<?php echo $j; ?>', 'inline');" onMouseOut="setVisibility(this,'cust1<?php echo $j; ?>', 'none');">
        <?php echo $roCust['cust_name'].'<br>';	?>  </a>
		<?php $mk = $roCust['mobile'];
                if($mk == 0){
                    echo $roCust['phone_no'];
                }else{
                echo $mk;
                }
                $piUp = $rows['pickup_point'];
                $areIdh = strpbrk($piUp,"+");
                $areId =  substr($areIdh,1);
                $sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
                echo '<div style="color:#990000; font-size:11px;">';
                if(mysql_error()){
                    echo 'N/A';
                }else{
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
                }
                echo '</div>';
                ?>
      
         <div id="cust1<?php echo $j; ?>" class="popup">
         <?php
		$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuMid'");
		$sqlMas = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuMid'");
		if(mysql_error()){
			//do nothing
		}else{
			$rop = mysql_fetch_assoc($sqlAdd);
			$rl = mysql_fetch_assoc($sqlMas);
			echo '<table width="100%"><tr class="row-active"><td>Mobile:</td><td>'.$rl['mobile'].', '.$rl['alt_mobile'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Phone:</td><td>'.$rl['phone_no'].'</td></tr>';
			echo '<tr class="row-active"><td>Email:</td><td>'.$rl['email'].', '.$rl['alt_email'].'</td></tr>';
			echo '<tr class="row-active"><td>Address</td><td>';
			$ppO = $rows['pickup_point'];
			$adt = explode("+",$ppO);
			echo current($adt);
			//echo stristr($ppO,43); //43 is ASCII code for +
			echo '</td></tr>
			<tr class="row-inactive"><td >Requirement:</td><td>'.$rl['requirement'].'</td></tr>
			</table>';
		}
		?>
         </div>
        <?php
	}
	echo'</td>
    <td>';
	$cabId = $rows['cab_id'];
	$sqlCab = mysql_query("SELECT `cab_id`,`cab_code`,`cab_type`,`plate_no` FROM `cabs` WHERE `cab_id` = '$cabId'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roCab = mysql_fetch_assoc($sqlCab);
		echo $roCab['cab_code'];
	}
	echo '</td>
	<td>';
	$drId = $rows['driver_id'];
	$sqlDrv = mysql_query("SELECT `driver_id`,`driver_name`,`alt_mobile_no`,`mobile_no`,`email`,`phone_no` FROM `drivers` WHERE `driver_id` = '$drId'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roDr = mysql_fetch_assoc($sqlDrv);
		$p = $t++;
		?>
         <a href="#" onClick="keepAlive(this,'sub2<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub2<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub2<?php echo $p; ?>', 'none');">
		 <?php echo $roDr['driver_name']; ?></a><br />
         <?php echo $roDr['mobile_no']; ?>
          <div id="sub2<?php echo $p; ?>" class="popup">
         <table width="100%" border="0">
         <tr class="row-active">
                <td>Plate No.</td>
                <td><?php echo $roCab['plate_no']; ?></td>
              </tr>
              <tr class="row-inactive">
                <td>Mobile No.</td>
                <td><?php echo $roDr['mobile_no'].', '.$roDr['alt_mobile_no']; ?></td>
              </tr>
              <tr class="row-active">
                <td>Phone No.</td>
                <td><?php echo $roDr['phone_no']; ?></td>
              </tr>
              <tr class="row-active">
                <td>E-mail</td>
                <td><?php echo $roDr['email']; ?></td>
              </tr>
            </table>
          </div>
        <?php
	}
	echo '</td><td>';
	$cabTy = $roCab['cab_type'];
	$sqlTy = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roTy = mysql_fetch_assoc($sqlTy);
		echo '<font style="color:red;"><b>'.$roTy['cab_type_name'].'</b></font>';
	}
	echo '</td><td><font style="font-size:10px;">';
        $srvTy = $rows['service_type'];
	$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTy'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
            $roSrTy = mysql_fetch_assoc($sqlSrv);
         echo $roSrTy['service_type'].', ';
                
              if($srvTy == 5){
                  $rdate = $rows['required_date'];
                  $edate = $rows['end_date'];
                 $date1 = strtotime($rdate);
                 $date2 = strtotime($edate);
                  $datediff = $date2-$date1;
                  $coDat = floor($datediff/(60*60*24))+1;
                 echo "<font style=\"color:#996600;\"><b>".$coDat." days</b></font>";
              }elseif($srvTy == 6){
                   $rdate = $rows['required_date'];
                   $edate = $rows['end_date'];
                   $date1 = strtotime($rdate);
                   $date2 = strtotime($edate);
                   $datediff = $date2-$date1;
                   $coDat = floor($datediff/(60*60*24))+1;
                 echo "<font style=\"color:#990066;\"><b>".$coDat." days</b></font>";
              }
		
	}
        echo '<br/>'.$rows['remarks'];
        echo '</font></td>
    <td><span style="font-size:12px;">'.$rows['required_date'].'</span><br />'.$rows['required_time'].'</td>
    <td>';
	$pmo = $rows['payment_mode'];
	if($pmo == 1){
		echo 'Cash';
	}
	elseif($pmo == 2){
		echo 'Cheque';
	}
	elseif($pmo == 3){
		echo 'Credit Card';
	}
	else{
		echo 'N/A';
	}
	echo '</td>
    <td>';
	$dropUp = $rows['destination'];
	$sqlDroAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$dropUp'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roDrAre = mysql_fetch_assoc($sqlDroAre);
		echo $roDrAre['area_name'];
	}
	echo '</td>
    <td>';
	?>
     <form action=""> 
            <select name="srvType" onchange="showAction(this.value);" class="sel">
            <option value="VE-<?php echo $rows['booking_id']; ?>">Select Action</option>
           <!--<option value="VE-<?php //echo $rows['booking_id']; ?>">View Order</option>-->
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
               <option value="AT-<?php echo $rows['booking_id']; ?>">Add Trip Details</option>
               <?php  }  ?>
           <option value="CO-<?php echo $rows['booking_id']; ?>">Cancel Order</option>
           <?php
		   if($empType == 1 || $empType == 2 || $empType == 5 || $empType == 6 || $empType == 7){
			   ?>
               <option value="HI-<?php echo $rows['booking_code']; ?>">History</option>
               <?php
		   }
		   ?>
           <option disabled="disabled">--------------------</option>
           <option value="DL-<?php echo $rows['booking_id']; ?>">Delete Order</option>
            </select>
            </form>
	<?php
	echo '
	</td>
  </tr>';
  
  }//while close
  ?>
</table>
<?php
	if($empType == 1 || $empType == 6){
		echo 'Total Orders: '.$resCount.'&nbsp;&nbsp;';
	}
	$totPages = intval(($resCount/$pageSize));
	if(($resCount%$pageSize)!=0)
		$totPages++;
	//echo $totPages;
	$startRow = 0;
	if($cabtype == ""){
		$cabtype = 0;
	}
	for($i=0;$i<$totPages;$i++)
	{
		$sp = $i*$pageSize;
		if($pStart==$sp)
			echo '<a href="javascript:void(0);" class="NavButtonActive"><b>'.($i+1).'</b></a>&nbsp;';
		else
			echo '<a href="#" class="NavButton" onClick="gotoPage('.$sp.','.$pageSize.','.$cabtype.');">'.($i+1).'</a>&nbsp;';
	}
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
	if(oTop>$(document).height()+50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}
</script>