<?php
/*******************************************************************************
File Name: vie-cab-record.php
Work and function: in this file user cab view cab record
T=table name -> cabs
##########
Create date = 28 NOV 2011
Time: 04:58
Last Update:
Date: 28 NOV 2011
Time: 00:00
Author Name: amit kumar
******************************************************************************/
?>
<script type="text/javascript">
function showCustomer(str)
{
	var uri = "../master/form/cab-record-backEnd.php?mode=cabTy&pas=1&type="+str;
	var obj = document.getElementById("waitCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
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
function changeCabStatus(cabi){
	
	var uri = "../master/form/cab-change-status.php?id="+cabi;
	var obj = document.getElementById("changeCabStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
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
session_start();
$date = date("Y-m-d");
$startDate = $_POST['datS'];
$endDate = $_POST['datE'];
$cabType = $_POST['cabType'];
$status = $_POST['pass'];

if($status == 0){
    $passStatus = "0";
    $valuePass = "";
     $datePass = "AND DATE_FORMAT(`dol`, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'";
}
elseif($cabType != 0){
    $passStatus = $status;
    $valuePass = "AND `cab_type` = '".$cabType."'";
    $datePass = "";
}
elseif($startDate != $date){
   $passStatus = $status;
   $valuePass = "";
   $datePass = "AND DATE_FORMAT(`doj`, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'";
   
}
else{
    $passStatus = "1";
    $valuePass = "";
    $datePass = "";
}
$query = "SELECT * FROM `cabs` WHERE `status` = $passStatus  $valuePass $datePass  ORDER BY `cab_code` ASC";
$sqlCab = mysql_query($query);
$countCab = mysql_num_rows($sqlCab);

echo'
<table width="100%" border="0" id="product-table">
  <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Cab Code</th>
    <th class="table-header-repeat">Plate No.</th>
    <th class="table-header-repeat">Cab Type.</th>
    <th class="table-header-repeat">Model Year</th>
    <th class="table-header-repeat">Permit</th>
    <th class="table-header-repeat">Assign Driver</th>
    <th class="table-header-repeat">Attching Type</th>
    <th class="table-header-repeat">Action</th>
   
  </tr>
  <tr><td colspan="10" align="center" cellspasing="0"><div id="changeCabStatus"></div></td></tr>
  ';
  if($countCab == 0){
	  echo ' <tr>
    <td align="center" colspan="10"><img src="images/cancel.png" width="24" height="24"><br><span style="color:#CCCCCC; font-size:20px;">Click Show to view Record!</span></td>
  </tr>';
  
  }else{
	  $i = 1;
	  while($rowCab = mysql_fetch_assoc($sqlCab)){
      $t = $i++;
     $sat = $rowCab['status'];
	
  echo '<tr align="center" ';
   if($sat == 0){
	   echo 'class="block_rwo"';
   }else{
	   if($t %2 == 0){
		   echo 'class="row-active"';
	   }else{
		   echo 'class="row-inactive"';
	   }
   }
  echo ' >
    <td>'.$t.'</td>
    <td>'.$rowCab['cab_code'].'</td>
    <td><a href="#" id="../master/form/view-cab-details.php?id='.$rowCab['cab_id'].'" onClick="showMainAction(this.id)">'.$rowCab['plate_no'].'</a></td>
    <td>';
	$cabTy = $rowCab['cab_type'];
	$sqlType = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
	if($sqlType == TRUE){
		$rowTyp = mysql_fetch_assoc($sqlType);
		echo $rowTyp['cab_type_name'];
	}else{
		echo 'Not Assign';
	}
	echo '</td>
    <td>'.$rowCab['mfd_year'].'</td>
    <td>';
	//permit details
        $cabCode = $rowCab['cab_code'];
        $sqlPer = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$cabCode'");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $p = $t++;
            ?>
<a href="#" onClick="keepAlive(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $p; ?>', 'none');">Show</a>
<div id="sub1<?php echo $p; ?>" class="popup">
    <table width="100%" cellspacing="0">
        
        <tr>
            <th class="table-header-repeat">Permit Type</th>
            <th class="table-header-repeat">Validate</th>
        </tr>
        <?php
        $rowsPerm = mysql_fetch_assoc($sqlPer);
           echo '<tr class="row-active">';
           echo '<td>';
           $natio = $rowsPerm['roadPerType'];
           if($natio == 1){
               echo 'National';
           }else{
               echo '<span style="color:#990000;">National</span>';
           }
           echo '</td>';
           echo '<td>';
           $daNat = $rowsPerm['roadPerExp'];
           if($daNat == ""){
               echo 'N/A';
           }else{
               echo $daNat;
           }
           echo '</td>';
           echo '</tr>'; 
           echo '<tr class="row-inactive">';
           echo '<td>';
           $state = $rowsPerm['rodSatePer'];
           if($state == 1){
               echo 'State';
           }else{
               echo '<span style="color:#990000;">State</span>';
           }
           echo '</td>';
           echo '<td>';
           $datSat = $rowsPerm['rodSateExp'];
           if($datSat == ""){
               echo 'N/A';
           }else{
               echo $datSat;
           }
           echo '</td>';
           echo '</tr>'; 
           echo '<tr class="row-active">';
           echo '<td>';
           $tripu = $rowsPerm['rodTriuPer'];
           if($tripu == 1){
               echo 'Tirupati';
           }else{
               echo '<span style="color:#990000;">Tirupati</span>';
           }
           echo '</td>';
           echo '<td>';
           $datTrip = $rowsPerm['rodTriuExp'];
           if($datTrip == ""){
               echo 'N/A';
           }else{
               echo $datTrip;
           }
           echo '</td>';
           echo '</tr>';
           echo '<tr class="row-inactive">';
           echo '<td>';
           $rodTax = $rowsPerm['rodTax'];
           if($rodTax == 1){
               echo 'Road Tax';
           }else{
               echo '<span style="color:#990000;">Road Tax</span>';
           }
           echo '</td>';
           echo '<td>';
           $datRod = $rowsPerm['taxExp'];
           if($datRod == ""){
               echo 'N/A';
           }else{
               echo $datRod;
           }
           echo '</td>';
           echo '</tr>';
        
        ?>
    </table>
</div>        
<?php
        }
	echo '</td>
    <td>';
	//assign driver tracking
	$cabId = $rowCab['cab_id'];
	$sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
	if($sqlDriv == TRUE){
		$roDass = mysql_fetch_assoc($sqlDriv);
		$drId = $roDass['driver_id'];
		 //get driver name 
		 $sqlDrDet = mysql_query("SELECT driver_id,driver_name,driver_type 	 FROM `drivers` WHERE `driver_id` = '$drId'");
		 if($sqlDrDet == TRUE){
			 $roDD = mysql_fetch_assoc($sqlDrDet);
			 echo $roDD['driver_name'];
		 }else{
			 echo 'Record not found';
		 }
	}else{
		echo 'Not Assign';
	}
	//end here
	echo '</td>';
	echo '<td>';
	if($sqlDrDet == TRUE){
		$at = $roDD['driver_type'];
		if($at == 1){
			echo 'Company Cab';
		}
		elseif($at == 2){
			echo 'Owner Cum Driver';
		}
		elseif($at == 3){
			echo 'Owner';
		}
		elseif($at == 4){
			echo 'Driver';
		}
		else{
			echo 'Other';
		}
	}else{
	
	}
	echo '</td>';
	//echo '<td>'.$rowCab['doj'].'</td>';
        
        echo '<td>';
		
        if($sat == "1"){
          ?>
		  <a href="#" style="float:right;" id="../master/form/add-new-driver.php?cbId=<?php echo $rowTyp['cab_id']; ?>&doj=<?php echo $rowTyp['doj']; ?>&dt=4&pass=yes" onClick="showMainAction(this.id)" ><img src="images/001_55.gif" /></a>
<img src="images/block-cab.png" width="22" height="22" id="<?php echo "0".$rowCab['cab_id']; ?>" onClick="changeCabStatus(this.id)" style="cursor: pointer;" />
<?php
        }else{
            if($_SESSION['EMP_TYPE'] == "7" || $_SESSION['EMP_TYPE'] == "5"){
                //do nothink
            }else{
        ?>
<img src="images/active-cab.png" width="22" height="22" id="<?php echo "1".$rowCab['cab_id']; ?>" onClick="changeCabStatus(this.id)" style="cursor: pointer;" />

        <?php
            }
          }
        echo '</td>';
        echo '</tr>';
 
  }//while close here
  }//else close here
  echo'
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
</table>
';
?>