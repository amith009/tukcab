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
session_start();
require_once "../../core/php/connection.php";
$empTyp = $_SESSION['EMP_TYPE'];
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

//end popup here
function showChangeStatus(str)
{
	var uri = "../master/form/change-cab-status.php?type="+str;
	var obj = document.getElementById("ChangeCabStatus");
	//alert(str);
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		else{
			var respType = response.substring(0,7);
			if(respType=='ERROR: '){
				alertDisp(response.substring(7),'statusType-error');
			}else if(respType=='SUCCE: '){
				alertDisp(response.substring(7),'statusType-info');
			}
			//reload the parent contents
			var uri = "../master/form/view-current-driver.php?type=ALL";
			var obj = document.getElementById("driver-status");
			$(obj).load(uri,function(response, status, xhr) {
				if (status == "error") {
					//alert(formatErrMsg(xhr.status));
					alertDisp(formatErrMsg(xhr.status),'statusType-error');
				}
				//bindHref(this);
			});
		}
	});
}
	
</script>
<?php

$type = $_GET['type'];
		if($type == "ALL"){
			$val = "";
		}else{
			$passVal = substr($type,0,2);
			$idTrack = substr($type,2);
			if($passVal == "TY"){
				$val = "AND `cab_type` = '".$idTrack."'";
			}
			
			else{
				$val = "";
			}
		}

$sqlCab = mysql_query("SELECT * FROM `cabs` WHERE `status` = 1 $val ORDER BY `cab_code` ASC");
$countCab = mysql_num_rows($sqlCab);

echo'
<table width="100%" id="product-table">
<tr><td colspan="10" align="center"><div id="ChangeCabStatus" style="display:none;"></div></td></tr>
  <tr>';
  if($empTyp == 1 || $empTyp == 6){
	  echo '<th class="table-header-repeat">Sl. No.</th>';
  }
  echo '
    <th class="table-header-repeat">Cab Code</th>
    <th class="table-header-repeat">Plate No.</th>
    <th class="table-header-repeat">Cab Type.</th>
    <th class="table-header-repeat">Assign Driver</th>
    <th class="table-header-repeat">Contact No.</th>
	<th class="table-header-repeat">Location</th>';
	if($empTyp == 1 || $empTyp == 6 ){
		echo '<th class="table-header-repeat">Action</th>';
	}
  echo '
  </tr>
  ';
  if($countCab == 0){
	  echo ' <tr>
    <td align="center" colspan="10"><img src="images/001_11.png" width="24" height="24"> <h2>No Record Found!!</h2></td>
  </tr>';
  
  }else{
	  $i = 1;
	  while($rowCab = mysql_fetch_assoc($sqlCab)){
      $t = $i++;
     $sat = $rowCab['status'];
     $cabCode = $rowCab['cab_code'];
     $chDat = date("Y-m");
     $sqlPay = mysql_query("SELECT `cp_cab_code` FROM `cab_payment` WHERE `cp_cab_code` = '$cabCode' AND DATE_FORMAT(`cp_payment_date`,'%Y-%m') <= '$chDat'");
     $counPay = mysql_num_rows($sqlPay);
  echo '<tr align="center" ';
   if($counPay == 0){
	   echo 'class="block_rwo"';
   }else{
	   if($t %2 == 0){
		   echo 'class="row-active"';
	   }else{
		   echo 'class="row-inactive"';
	   }
   }

  echo ' >';
  if($empTyp == 1 || $empTyp == 6){
	  echo '<td>'.$t.'</td>';
  }
  echo '<td>';
  $curentDate = date("Y-m-d"); //current date
  ?>
<a href="#" onClick="keepAlive(this,'sub2<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub2<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub2<?php echo $p; ?>', 'none');">
		<?php echo $cabCode = $rowCab['cab_code']; ?></a>
<div id="sub2<?php echo $p; ?>" class="popup">
            <table width="100%">
                <tr class="row-inactive"><td>Model Year:</td><td><?php echo $rowCab['mfd_year']; ?></td></tr>
                <tr class="row-active"><td>Insurance Exp:</td><td><?php   
                $insDate = $rowCab['insurance_exp_date'];
                        if($insDate <= $curentDate){
                            echo '<font style="color:red;">'.$insDate.'</font>';
                        }else{
                            echo $insDate;
                        }
                ?></td></tr>
                <tr class="row-active"><td>Emin. Exp:</td><td><?php   
                $emnDate = $rowCab['eminExp'];
                        if($emnDate <= $curentDate){
                            echo '<font style="color:red;">'.$emnDate.'</font>';
                        }else{
                            echo $emnDate;
                        }
                ?></td></tr>
                <tr  bgcolor="#ccc"><td colspan="2" align="center">Permit Expire Details:</td></tr>
                <?php
                    $sqlPerU = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$cabCode'");
                    if(mysql_error()){
                        echo '<tr><td colspan="2">No Record Found<td></tr>';
                    }else{
                        $roPret = mysql_fetch_assoc($sqlPerU);
                        
                        ?>
                <tr class="row-inactive"><td>National:</td><td><?php 
                $natDate = $roPret['roadPerExp'];
                if($natDate <= $curentDate){
                    echo '<font style="color:red;">'.$natDate.'</font>';
                }else{
                    echo $natDate;
                }
                ?></td></tr>
                <tr class="row-active"><td>State:</td><td><?php 
                $satDate = $roPret['rodSateExp'];
                if($satDate <= $curentDate){
                    echo '<font style="color:red;">'.$satDate.'</font>';
                }else{
                    echo $satDate;
                }
                ?></td></tr>
                <tr class="row-inactive"><td>Tirupati:</td><td><?php 
                $trDate = $roPret['rodTriuExp'];
                if($trDate <= $curentDate){
                    echo '<font style="color:red;">'.$trDate.'</font>';
                }else{
                    echo $trDate;
                }
                ?></td></tr>
                <tr class="row-active"><td>Road Tax:</td><td><?php 
                $taxDate = $roPret['taxExp'];
                if($taxDate <= $curentDate){
                    echo '<font style="color:red;">'.$taxDate.'</font>';
                }else{
                    echo $taxDate;
                }
                ?></td></tr>
                      <?php
                    }                    
                    ?>
            </table>
        </div>
<?php    
    
    echo '</td>
    <td>'.$rowCab['plate_no'].'</td>
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
    
   
    <td>';
	//assign driver tracking
	$cabId = $rowCab['cab_id'];
	$sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId'  AND `status` = 1");
	if($sqlDriv == TRUE){
		$roDass = mysql_fetch_assoc($sqlDriv);
		$drId = $roDass['driver_id'];
		 //get driver name 
		 $sqlDrDet = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$drId' AND `status` = 1");
		 if($sqlDrDet == TRUE){
			 $roDD = mysql_fetch_assoc($sqlDrDet);
			 if($sat == 0){
				 echo '-';
			 }else{
                             $f = $p++;
                             ?>
<a href="#" onClick="keepAlive(this,'sub4<?php echo $f; ?>');" onMouseOver="setVisibility(this,'sub4<?php echo $f; ?>', 'inline');" onMouseOut="setVisibility(this,'sub4<?php echo $f; ?>', 'none');">
			 <?php echo $roDD['driver_name']; ?></a>
   <div id="sub4<?php echo $f; ?>" class="popup"> 
       <table width="100%" style="font-size:10px;">
           <tr><td rowspan="5" valign="top">
                   <?php $dimg = $roDD['image_file']; 
                   if(file_exists($dimg) || $dimg != ""){
                       echo '<img src="'.$dimg.'" width="80" height="90" />';
                   }else{
                       echo '<img src="images/user_png.png" width="80" height="90" />';
                   }
                   ?>
               </td><td colspan="2" class="row-active"><b style="font-size:12px;"><?php echo $roDD['driver_name']; ?></b></td></tr>
              <tr class="row-inactive"><td>DL Exp. Date:</td>
              <td><?php 
                $dlDate = $roDD['dl_exp_date'];
                if($dlDate <= $curentDate){
                    echo '<font style="color:red;">'.$dlDate.'</font>';
                }else{
                    echo $dlDate;
                }
                ?></td>
              </tr>
              <tr class="row-active"><td>Badge Exp. Date:</td>
              <td><?php 
                $badDate = $roDD['badge_exp_date'];
                if($badDate <= $curentDate){
                    echo '<font style="color:red;">'.$badDate.'</font>';
                }else{
                    echo $badDate;
                }
                ?></td>
              </tr>
              <tr class="row-inactive"><td>Languages Know:</td>
              <td><?php echo $roDD['insaurance_comp'];  //here insaurance_comp colon name indicate languages  
                ?></td>
              </tr>
       </table>
   </div>
		      <?php
                         }
		 }else{
			 echo 'Record not found';
		 }
	}else{
		echo 'Not Assign';
	}
	//end here
	echo '</td><td>';
	if($sat == 0){
		echo '-';
	}else{
	if($sqlDrDet == TRUE){
		echo $roDD['mobile_no'];
	}else{
	echo '-';
	}
	}//else close here
	echo '</td><td>';
	$areId = $roDD['prefered_area'];
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
	}
	echo '</td>';
	if($empTyp == 1 || $empTyp == 6){
	echo '
	<td>';
	$satDr = mysql_query("SELECT driver_id,status FROM `drivers` WHERE `driver_id` = '$drId'");
	if(mysql_error()){
		echo 'N/A';
	}else{
		$rowDr = mysql_fetch_assoc($satDr);
	echo '
	<select onchange="showChangeStatus(this.value)" class="styledselect">';
	echo '<option value="1">Change Status</option>';
	
	echo '<option value="1'.$rowDr['driver_id'].'">Active Cab</option>';
	
	echo '<option value="0'.$rowDr['driver_id'].'">Block Cab</option>';
	
	echo '
	</select>';
	}//else close here
	echo '
	</td>';
	}
	echo '
  </tr>';
 
  }//while close here
  }//else close here
  echo'
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
</table>
';
?>
