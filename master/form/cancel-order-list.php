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
function showAction(str)
{
	var uri = "../master/form/order-action.php?mode=cabTy&type="+str;
	var obj = document.getElementById("cancelCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

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
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$order = $_POST['order'];
$area = $_POST['area'];
$services = $_POST['services'];
$cabtype = $_POST['cabtype'];
$boktype = $_POST['boktype'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$sermode = $_POST['sermode'];
if($boktype == 1){
    $valPass = " AND `onlineBook` = '$boktype'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
}
elseif($order != ""){
    /* BY ORDER NUMBER*/
    
    if($sermode == "OR"){
            $valPass = " AND `booking_code` = '$order'";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
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
        } else{
            $valPass = "";
            $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
        }
}

elseif($area != 0){
    $pasArea = "+".$area;
    $valPass = " AND `pickup_point` LIKE '%$pasArea%'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
}
elseif($services != 0){
    $valPass = " AND `service_type` = '$services'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
}
elseif($cabtype != 0){
    $valPass = " AND `cab_type` = '$cabtype'";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
}

else{
    $valPass = "";
    $valDate = " AND DATE_FORMAT(`required_date`, '%Y-%m-%d') BETWEEN '$date' AND '$date' ";
}
//end here
$pass = "SELECT * FROM `book_master` WHERE `status` = 3 $valPass $valDate ORDER BY `required_time` ASC";
$sql = mysql_query($pass);
$count = mysql_num_rows($sql);

echo'
<table width="100%" border="0" id="product-table">
  <tr>';
  if($empType == 1 || $empType == 6){
	 echo '<th width="7%" class="table-header-repeat">Sl. No.</th>';
  }
  echo '
    <th width="10%" class="table-header-repeat">Order No.</th>
    <th width="11%" class="table-header-repeat">Customer</th>
    <th width="7%" class="table-header-repeat">Pickup </th>
    <th width="10%" class="table-header-repeat">Type of Cab</th>
    <th width="9%" class="table-header-repeat">Srv. Type</th>
    <th width="15%" class="table-header-repeat">Date & Time</th>
    <th width="12%" class="table-header-repeat">Payment Mode</th>
    <th width="12%" class="table-header-repeat">Dropup Point</th>
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
  $i = 1;
  while($rows = mysql_fetch_assoc($sql)){
  $t = $i++;
   echo '<tr align="center" ';
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	echo '>';
	if($empType == 1 || $empType == 6){
		echo '<td>'.$t.'</td>';
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
		$p=$t++;
		$roCust = mysql_fetch_assoc($sqlCust);
		$cuMid = $roCust['cust_id']; //call for address
		
			?>
       <a href="#" onClick="keepAlive(this,'sub3<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub3<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub3<?php echo $p; ?>', 'none');">
		<?php echo $roCust['cust_name']; ?>	</a><br>
		<?php $mk = $roCust['mobile'];
                if($mk == 0){
                    echo $roCust['phone_no'];
                }else{
                echo $mk;
                }
                ?>
        <div id="sub3<?php echo $p; ?>" class="popup">
        <?php
		$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuMid'");
		$sqlMas = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuMid'");
		if(mysql_error()){
			//do nothing
		}else{
			$rop = mysql_fetch_assoc($sqlAdd);
			$rl = mysql_fetch_assoc($sqlMas);
			echo '<table width="100%"><tr class="row-active"><td>Mobile:</td><td>'.$rl['mobile'].', '.$rl['alt_mobile'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Phone No.</td><td>'.$rl['phone_no'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Email.</td><td>'.$rl['email'].'</td></tr>';
			echo '<tr class="row-active"><td>Address</td><td>';
			$ppO = $rows['pickup_point'];
			$adt = explode("+",$ppO);
			echo current($adt);
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
	$piUp = $rows['pickup_point'];
	$piUp = $rows['pickup_point'];
    $areIdh = strpbrk($piUp,"+");
    $areId =  substr($areIdh,1);
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
	}
	echo '</td>
    <td>';
	$cabTy = $rows['cab_type'];
	$sqlTy = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roTy = mysql_fetch_assoc($sqlTy);
		echo '<font style="color:red;"><b>'.$roTy['cab_type_name'].'</b></font>';
	}
	echo '</td>
    <td>';
	$srvTy = $rows['service_type'];
	$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTy'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roSrTy = mysql_fetch_assoc($sqlSrv);
		echo $roSrTy['service_type'];
	}
	echo '</td>
    <td>';
	if($datAccs == 1){ 
	 echo $tySrv;
	}else{
		echo $rows['required_date'];
	}
	
	echo '<br>'.$rows['required_time'];
	echo '</td>
    <td>';
	$pmo = $rows['payment_mode'];
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
	$dropUp = $rows['destination'];
	$sqlDroAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$dropUp'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roDrAre = mysql_fetch_assoc($sqlDroAre);
		echo $roDrAre['area_name'];
	}
	echo '</td>
    <td>';?>
     <form action=""> 
            <select name="srvType" onchange="showAction(this.value);" class="styledselect">
            <option value="VE-<?php echo $rows['booking_id']; ?>">Select Cab</option>
          <!-- <option value="VE-<?php echo $rows['booking_id']; ?>">View Order</option>-->
           <option value="ED-<?php echo $rows['booking_id']; ?>">Edit Order</option>
           <?php
		   $sat = $rows['status'];
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
	echo '</td>
  </tr>';
  
  }//while close
  ?>
</table>
