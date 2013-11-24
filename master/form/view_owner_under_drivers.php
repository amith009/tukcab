<?php
/*
File Name: view-driver-record.php
Work and function: in this file user driver record and payment status
T=table name -> cabs
##########
Create date = 28 NOV 2011
Time: 04:58
Last Update:
Date: 28 NOV 2011
Time: 00:00
Author Name: amit kumar
*/

$ownerId = $_GET['oid'];

require_once "../../core/php/connection.php";

//echo "SELECT * FROM `drivers` WHERE `driver_owner` = '$ownerId' ORDER BY `cab_code` ASC";

$sqlDriv = mysql_query("SELECT * FROM `drivers` WHERE `driver_owner` = '$ownerId' ORDER BY `driver_name` ASC");
$countDriv = mysql_num_rows($sqlDriv);
echo '<div class="formContainer" style="width:100%;">

<table width="100%" id="product-table">
<tr>
    <th class="table-header" colspan="20">Assign driver records under owner</th>
</tr>
  <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Cab Code</th>
    <th class="table-header-repeat">Name</th>
    <th class="table-header-repeat">Contact No.</th>
    <th class="table-header-repeat">Email address</th>
    <th class="table-header-repeat">Prefered Location</th>
    <th class="table-header-repeat">Date of Joing</th>
  </tr>';
  if($countDriv == 0){
	  echo ' <tr>
    <td align="center" colspan="8"><img src="images/001_11.png" width="24" height="24"> <h2>No Record Found!!</h2></td>
   
  </tr>';
  }else{
	  $i = 1;
	  while($rowDr = mysql_fetch_assoc($sqlDriv)){
		  $t = $i++;
		  $drId = $rowDr['driver_id'];
		  $sat = $rowDr['status'];
		   echo '<tr  ';
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
			<td>';
			//cab assign for driver
		  $sqlAss = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `driver_id` = '$drId' AND `status` = 1");
			if($sqlAss== TRUE){
				$roDass = mysql_fetch_assoc($sqlAss);
				$cabId = $roDass['cab_id'];
				
				 //get cab code
				 $sqlCab = mysql_query("SELECT cab_id,cab_code,status FROM `cabs` WHERE `cab_id` = '$cabId' ORDER BY `cab_code` ASC");
				 if($sqlCab == TRUE){
					 $roCab = mysql_fetch_assoc($sqlCab);
								 
								 //echo  $roCab['cab_code'];
								 echo '<a href="#" id="../master/form/view-cab-details.php?id='.$roCab['cab_id'].'" onClick="showMainAction(this.id)">'.$roCab['cab_code'].'</a>';
								 
						 }
					 }
			echo '</td>
			<!--td><a href="#" id="../master/form/view-driver.php?id='.$rowDr['driver_id'].'" onClick="showMainAction(this.id)">'.$rowDr['driver_name'].'</a></td-->
			<td>'.$rowDr['driver_name'].'</td>
			
			<td><strong>Mob:</strong> '.$rowDr['mobile_no'].', '.$rowDr['alt_mobile_no'].'<br><strong>Ph: </strong>'.$rowDr['phone_no'].'</td>
			<td>'.$rowDr['email'].'</td>
			<td>';
			$arId = $rowDr['prefered_area'];
			$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = $arId");
			if(mysql_error()){
				echo 'N/A';
			}else{
				$roAre = mysql_fetch_assoc($sqlAre);
				$arname=$roAre['area_name'];
					if($arname == "" || $arname == null){
					 echo 'N/A';
					}else{
					echo $arname;
					}
			}
			echo '</td>
			 <td>'.$rowDr['doj'].'</td>
		  </tr>';
		 }//while close
  }//else close
echo ' <tr>
    <td align="center" class="10">&nbsp;</td>
   
  </tr>
</table></div>
';
?>
</div>