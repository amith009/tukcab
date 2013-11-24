<script type="text/javascript">
function showOwnerAction(str)
{
	var uri = str;
	var obj = document.getElementById("owneraction");
	
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
/*
File Name: view-owner-record.php
Work and function: in this file user owner record and payment status
T=table name -> cabs
##########
Create date = 12 OCT 2012
Time: 20:58
Last Update:
Date: -- -- ----
Time: 00:00
Author Name: amit kumar
*/

require_once "../../core/php/connection.php";
$drty = $_GET['did'];
if($drty == ''){
	$drt = 3;
}else{
	$drt = $drty;
}
$sqlDriv = mysql_query("SELECT * FROM `drivers` where `driver_type` = '$drt' AND `status` != '5'");

$countDriv = mysql_num_rows($sqlDriv);
echo '<div class="formContainer" style="width:100%;" id="owneraction">

<table width="100%" id="product-table">
<tr>
    <th class="table-header" colspan="20">
	<span style="float:left;">All ';
	if($drt == 1){
		echo 'company cab';
	}
	elseif($drt == 2){
		echo 'Owner cum driver';
	}
	elseif($drt == 3){
		echo 'Owner';
	}
	elseif($drt == 4){
		echo 'driver';
	}
	
	else{
		echo 'N/A';
	}
	echo ' Records</span> 
	<span style="float:right;">
	<a href="#" id="../master/form/view-owner-record.php?did=1" onClick="showMainAction(this.id)" >Company Cab</a>
	<a href="#" id="../master/form/view-owner-record.php?did=2" onClick="showMainAction(this.id)" >Owner Cum Driver</a>
	<a href="#" id="../master/form/view-owner-record.php?did=3" onClick="showMainAction(this.id)" >Owner</a>
	<a href="#" id="../master/form/view-owner-record.php?did=4" onClick="showMainAction(this.id)" >Driver</a>
	</span>
	</th>
</tr>
  <tr>
    <th class="table-header-repeat">Sl. No.</th>    
    <th class="table-header-repeat">Name</th>
	<th class="table-header-repeat">Attched Type</th>
	<th class="table-header-repeat">Cabs.</th>				
    <th class="table-header-repeat">Prefered Location</th>
    <th class="table-header-repeat">Action</th>
  </tr>';
  if($countDriv == 0){
	  echo ' <tr>
    <td align="center" colspan="10"><img src="images/001_11.png" width="24" height="24"> <h2>No Record Found!!</h2></td>
   
  </tr>';
  }else{
	  $i = 1;
	  while($rowDr = mysql_fetch_assoc($sqlDriv)){
	
		$k = $i++;
		$sat = $rowDr['status'];
		
		 echo '<tr  ';
		   if($sat == 0){
			   echo 'class="block_rwo"';
		   }
		   
		   else{
			   if($t %2 == 0){
				   echo 'class="row-active"';
			   }else{
				   echo 'class="row-inactive"';
			   }
		   }

		  echo ' >';
			echo '<td align="center">'.$k.'</td>';
			
			echo '<td align="center">';
					$driImg = $rowDr['image_file'];
			   if($driImg == ""){
				   $drImg = 'images/user_png.png';
			   }else{
				   $drImg = $driImg; 
			   }
			   echo ' <img src="'.$drImg.'" width="64" height="64" border="1" /><br />';
			echo $rowDr['driver_name'].'</td>';			
			echo '<td align="center">';
			$at = $rowDr['driver_type'];
			if($at == 1){
					echo 'company cab';
				}
				elseif($at == 2){
					echo 'Owner cum driver';
				}
				elseif($at == 3){
					echo 'Owner';
				}
				elseif($at == 4){
					echo 'driver';
				}				
				else{
					echo 'N/A';
				}			
			echo '</td><td>';
			
				$drId = $rowDr['driver_id'];
				$sqlOwner = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `driver_id` = '$drId' AND `status` = 1");
					if(mysql_error()){
					 echo 'No Cab Assign for this Driver!!';
					}else{
						while($roAsOw = mysql_fetch_assoc($sqlOwner)){						
						  $drt =  $roAsOw['cab_code'];
						if($drt !=  ""){
							echo $drt;
						}else{
						$sqlOwnerCum = mysql_query("SELECT cab_id,cab_code,status FROM `cabs` WHERE `cab_owner` = '$drId'");
						if(mysql_error()){
						 echo 'No Cab Assign for this Driver!!';
						}else{
							while($roAsDr = mysql_fetch_assoc($sqlOwnerCum)){
							$cabId = $roAsDr['cab_id'];
							$sqlCabRec = mysql_query("SELECT `cab_code` FROM `cabs` WHERE `cab_id` = '$cabId'");
							 if(!mysql_error()){
							  $rowsCabRc = mysql_fetch_assoc($sqlCabRec);
							  echo $rowsCabRc['cab_code'];
							 }
							}
						}
						}
						}
					}
						
			
			echo '</td><td align="center">';
			$aid = $rowDr['prefered_area'];
				$sqlArea = mysql_query("select area_name from`area` where `area_id`=$aid");
				if(!mysql_error()){
					$Roar = mysql_fetch_assoc($sqlArea);
					$arname=$Roar['area_name'];
					if($arname == "" || $arname == null){
					 echo 'N/A';
					}else{
					echo $arname;
					}
				}
			echo '</td>';
			echo 	'<td align="center">
						<select onchange="showOwnerAction(this.value)" class="styledselect">';
							echo '<option value="1">Select action</option>';
							if($at == 3){	
							echo '<option value="../master/form/view_owner_under_drivers.php?&oid='.$rowDr['driver_id'].'">View Drivers</option>';
							echo '<option value="../master/form/add-owner-driver.php?&oid='.$rowDr['driver_id'].'">Add Driver</option>';
							echo '<option  disable >-----------------</option>';
							}
							if($sat == 1){
								echo '<option value="../master/form/change-owner-status.php?&sta=0&oid='.$rowDr['driver_id'].'">Block Cab</option>';
							}else{
								echo '<option value="../master/form/change-owner-status.php?&sta=1&oid='.$rowDr['driver_id'].'">Active Cab</option>';
							}
							echo '<option value="../master/form/change-owner-status.php?&sta=5&oid='.$rowDr['driver_id'].'">Deactive record</option>';
							echo '
							</select></td>';
		 echo '</tr>';
		 
		}//while close
	}
echo '<tr><td align="center" colspan="10">&nbsp;</td></tr></table></div>';
?>
