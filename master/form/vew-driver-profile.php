<?php
/************************************************************************************
File Name: view-driver.php
T=table name -> drivers
##########
Create date = 29 NOV 2011
Time: 04:58
Last Update:
Date: 28 NOV 2011
Time: 00:00
Author Name: amit kumar
***********************************************************************************/

require_once "../../core/php/connection.php";
 $did = $_GET['id'];
 if($did == 0){
     echo 'No Driver Assign For This Cab!';
 }else{
 $sqlDri = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$did'");
 if(mysql_error()){
	 echo 'No Record found!!';
 }else{
	 $rodr = mysql_fetch_assoc($sqlDri);
       $oen = $rodr['driver_type'];
       $driImg = $rodr['image_file'];
       if($driImg == ""){
           $drImg = 'images/user_png.png';
       }else{
           $drImg = $driImg; 
       }
echo '<table width="100%" border="0" id="product-table">
 
  <tr class="row-active">
   
    <td colspan="2" rowspan="4" align="center">
        <img src="'.$drImg.'" width="111" height="120" border="1" />
    </td>
    <td><strong>Attching Type</strong></td>
   <td>';
	$at = $rodr['driver_type'];
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
	echo'</td>
  </tr>
  <tr class="row-inactive"><td><strong>Name :</strong></td><td>'.$rodr['driver_name'].'</td></tr>
  <tr class="row-active">';
  if($oen == 3){
	  echo '<td>&nbsp;</td><td>&nbsp;</td>';
  }else{
  echo '
    <td><strong><strong>Date of birth :</strong></strong></td>
    <td>'.$rodr['dob'].'</td>';
  }
	echo'</td></tr>
  <tr class="row-inactive"><td><strong>Date of joining</strong></td><td>'.$rodr['doj'].'</td></tr>
  
  <tr class="row-active">
    <td><strong>Mobile No.</strong></td>
    <td>'.$rodr['mobile_no'].'</td>
    <td><strong>Alternet Mobile No.</strong></td>
    <td>'.$rodr['alt_mobile_no'].'</td>
  </tr>
  <tr class="row-inactive">
    <td><strong>Phone No.</strong></td>
    <td>'.$rodr['phone_no'].'</td>
    <td><strong>E-mail address</strong></td>
    <td>'.$rodr['email'].'</td>
  </tr>
  <tr class="row-active">
    <td><strong>Address Line 1</strong></td>
    <td>'.$rodr['add_1'].'</td>
    <td><strong>Address Line 2</strong></td>
    <td>'.$rodr['add_2'].'</td>
  </tr>
  <tr class="row-inactive">
    <td><strong>City</strong></td>
    <td>'.$rodr['city'].'</td>
    <td><strong>State</strong></td>
    <td>'.$rodr['state'].'</td>
  </tr>
  <tr class="row-active">
    <td><strong>Country</strong></td>
    <td>'.$rodr['country'].'</td>
    <td><strong>Pin</strong></td>
    <td>'.$rodr['zip'].'</td>
  </tr>
  <tr class="row-inactive">';
   if($oen == 3){
	  echo '<td>&nbsp;</td><td>&nbsp;</td>';
  }else{
	  echo '
    <td><strong>Prefered Location</strong></td>
    <td>';
	$arId = $rodr['prefered_area'];
	$sqlAre = mysql_query("SELECT are_id,area_name FROM `area` WHERE `area_id` = '$arId'");
	if($sqlAre == TRUE){
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
	}else{
		echo 'N/A';
	}
	echo '</td>';
  }
  echo '
    <td><strong>Reference by</strong></td>
    <td>'.$rodr['reference_by'].'</td>
  </tr>';
   if($oen == 3){
	  
  }else{
	  echo '
   <tr class="row-active">';
    //<td><strong>Insurance No.</strong></td>
    //<td>'.$rodr['insaurance_no'].'</td>
          echo '
    <td><strong>Languages Know:</strong></td>
    <td colspan="4">'.$rodr['insaurance_comp'].'</td>
  </tr>';
         
  echo ' <tr class="row-inactive">';
    //<td><strong>Insaurance Exp. Date</strong></td>
    //<td>'.$rodr['insaurance_exp_date'].'</td>
  echo '
    <td><strong>Driving Exprience</strong></td>
    <td colspan="4">'.$rodr['experience'].'</td>
  </tr>
   <tr class="row-active">
    <td><strong>Driving Licence No.</strong></td>
    <td>'.$rodr['dl_no'].'</td>
    <td><strong>Badge No.</strong></td>
    <td>'.$rodr['badge_no'].'</td>
  </tr>
   <tr class="row-inactive">
    <td><strong>Dl. Issue Date</strong></td>
    <td>'.$rodr['dl_issue_date'].'</td>
    <td><strong>Badge Issue Date</strong></td>
    <td>'.$rodr['badge_iss_date'].'</td>
  </tr>
  <tr class="row-inactive">
    <td><strong>Dl. Expire Date</strong></td>
    <td>'.$rodr['badge_exp_date'].'</td>
    <td><strong>Badge Expire Date</strong></td>
    <td>'.$rodr['badge_exp_date'].'</td>
  </tr>
  ';
  }
  echo '
</table>';

 }
 }
 mysql_close();
?>