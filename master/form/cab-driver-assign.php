<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT * FROM `assigned_cabs` WHERE `cab_id` = '$id'");
$count = mysql_num_rows($sqlCab);
if($count == 0){
	include 'assign-cab-driver.php';		

}else{
	$roCab = mysql_fetch_assoc($sqlCab);
	 $driverId = $roCab['driver_id'];
	 $sqlDriv = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$driverId'");
	 if($sqlDriv == TRUE){
		 $roDr = mysql_fetch_assoc($sqlDriv);
		echo ' <table width="500" border="0" id="product-table">
				  <tr>
					<td>Driver Name</td>
					<td>'.$roDr['driver_name'].'</td>
				  </tr>
				  <tr>
					<td>Attaching Type</td>
					<td>';
								$at =$roDr['driver_type'];
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
					echo '</td>
				  </tr>
				  <tr>
					<td>Contact Number</td>
					<td>'.$roDr['mobile_no'].'</td>
				  </tr>
				  <tr>
					<td>Email Address</td>
					<td>'.$roDr['email'].'</td>
				  </tr>
				</table>
';
	 }else{
         echo '<h2>No Record Found</h2>';
	 }
}
?>