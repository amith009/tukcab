 <?php
/*
File Name: view-driver-record.php
Work and function: in this file user driver record and payment status
T=table name -> cabs
##########
Create date = 29 NOV 2011
Time: 04:58
Last Update:
Date: 28 NOV 2011
Time: 00:00
Author Name: amit kumar
*/

require_once "../../core/php/connection.php";
    $type = $_GET['type'];

	echo'<table width="100%" border="0">
				  <tr>
					<th>Sl. No.</th>
					<th>Cab Code</th>
					<th>Cab Type</th>
					<th>Model Year</th>
					<th>Road Permit</th>
					<th>Driver Name</th>
					<th>Location</th>
					<th>Time</th>
				  </tr>';
				  $i =1;
	while($rowCab = mysql_fetch_assoc($sqlFr)){
		 $t = $i++;
		 $cabId = $rowCab['cab_id'];
		//cab record
	    $sqlCr = mysql_query("SELECT cab_id,cab_code,road_permit,status,mfd_year,cab_type FROM `cabs` WHERE `cab_type` = '$type'");
		   if(mysql_error()){
			   //do nothink
		   }else{
			$rowCd = mysql_fetch_assoc($sqlCr);
			$sat = $rowCd['status'];
				echo '<tr ';
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
					<td>'.$rowCd['cab_code'].'</td>
					<td>';
						$cabTy = $rowCd['cab_type'];
						$sqlType = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
						if($sqlType == TRUE){
							$rowTyp = mysql_fetch_assoc($sqlType);
							echo $rowTyp['cab_type_name'];
						}else{
							echo 'Not Assign';
						}
						echo '</td>
					<td>'.$rowCd['mfd_year'].'</td>
					 <td>';
						$cabPer = $rowCd['road_permit'];
						if($cabPer == 1){
							echo 'National';
						}
						elseif($cabPer == 2){
							echo 'State';
						}
						elseif($cabPer == 3){
							echo 'National With Triupati';
						}
						else{
							echo 'Not Given';
						}
						echo '</td>
					 <td>';
							//assign driver tracking
							//$cabId = $rowCab['cab_id'];
							$sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
							if($sqlDriv == TRUE){
								$roDass = mysql_fetch_assoc($sqlDriv);
								$drId = $roDass['driver_id'];
								 //get driver name 
								 $sqlDrDet = mysql_query("SELECT driver_id,driver_name,mobile_no	 FROM `drivers` WHERE `driver_id` = '$drId'");
								 if($sqlDrDet == TRUE){
									 $roDD = mysql_fetch_assoc($sqlDrDet);
									 echo $roDD['driver_name'].'<br><strong>MOB:</strong>'.$roDD['mobile_no'];
								 }else{
									 echo 'Record not found';
								 }
							}else{
								echo 'Not Assign';
							}
							//end here
							echo '</td>
							<td>';
							$arId = $rowCab['location'];
							$sqlAre = mysql_query("SELECT are_id,area_name FROM `area` WHERE `area_id` = '$arId'");
							if($sqlAre == TRUE){
								$roAre = mysql_fetch_assoc($sqlAre);
								echo $roAre['area_name'];
							}else{
								echo 'N/A';
							}
							echo '</td>
					<td>'.$rowCab['time'].'</td>
				  </tr>';
		   }
		//end here
		
		}//while close
		echo '</table>';
	
?>