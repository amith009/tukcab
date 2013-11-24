<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT * FROM `cabs` WHERE `cab_id` = '$id'");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
        $code = $roCab['cab_code'];
?>
 <fieldset>
        <legend>Cab Details</legend>
        <table width="100%" >
          <tr class="row-active">
            <td width="15%">Plate No.</td>
            <td width="30%"><?php echo $roCab['plate_no']; ?></td>
            <td width="17%">Date of Joining</td>
            <td width="38%"><?php echo $roCab['doj']; ?></td>
          </tr>
          <tr class="row-inactive">
            <td>Type .</td>
            <td><?php $cabTy = $roCab['cab_type'];
					$vt = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
					$cv = mysql_num_rows($vt);
					if($cv == 0){
						echo 'Not Added Yet!!';
					}else{
						$rv = mysql_fetch_assoc($vt);
							 echo $rv['cab_type_name'];
					}
					?>
            </select></td>
            <td>Mfd. Year </td>
            <td><?php echo $roCab['mfd_year']; ?></td>
          </tr>
          <tr class="row-active">
            <td>Fule Type .</td>
            <td><?php $fTy = $roCab['fuel_type']; 
              if($fTy == 1){
				  $ValFty =  'Petrol';
			  }elseif($fTy == 2){
				  $ValFty =  'Diesel';
			  }elseif($fTy == 3){
				  $ValFty =  'Gas';
			  }else{
				  $ValFty =  '<strong>N/A</strong>';
			  }
			  echo $ValFty;
               ?></td>
            <td>Body Color .</td>
            <td><?php $col = $roCab['color']; 
			if($col == 1){
				$valCo = 'Black';
			}
			elseif($col == 2){
				$valCo = 'White';
			}
			elseif($col == 3){
				$valCo = 'Red';
			}
			elseif($col == 4){
				$valCo = 'Blue';
			}
			elseif($col == 5){
				$valCo = 'Silver';
			}
			elseif($col == 6){
				$valCo = 'Golden';
			}
			elseif($col == 7){
				$valCo = 'Green';
			}
			elseif($col == 8){
				$valCo = 'Brown';
			}
			elseif($col == 9){
			    $valCo = 'Orange';
			}
			elseif($col == 10){
				$valCo = 'Yellow';
			}
			elseif($col == 11){
				$valCo = 'Grey';
			}
			elseif($col == 12){
				$valCo = 'Violet';
			}
			elseif($col == 13){
				$valCo = 'Other';
			}
			else{
				$valCo = '<strong>N/A</strong>';
			}
			echo $valCo;
            ?></td>
          </tr>
          <tr class="row-inactive">
            <td>Chassis No.</td>
            <td><?php echo $roCab['chassis_no']; ?></td>
            <td>Air condition . </td>
            <td><?php $ac = $roCab['cab_ac']; 
			if($ac == 1){
				$valAc = 'YES';
			}else{
				$valAc = 'NO';
			}
			echo $valAc;
			?></td>
          </tr>
          <tr class="row-active">
            <td>Meter.</td>
            <td><?php $mtr = $roCab['meter'];
                    if($mtr == 1){
                        echo 'YES';
                    }else{
                        echo 'NO';
                    }
            ?></td>
            <td>Sticker.</td>
            <td><?php $strm = $roCab['sticker'];
                    if($strm == 1){
                        echo 'YES';
                    }else{
                        echo 'NO';
                    }
            ?></td>
            
          </tr>
           <tr class="row-active">
            <td>Cab Top.</td>
            <td><?php $ctb = $roCab['cabTop'];
                    if($ctb == 1){
                        echo 'YES';
                    }else{
                        echo 'NO';
                    }
            ?></td>
            <td >&nbsp;</td>
          </tr>
          <tr class="row-active">
            <td>Engine No.</td>
            <td><?php echo $roCab['engine_no']; ?></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr class="row-inactive">
            <td>Meter.</td>
            <td><?php $mter = $roCab['meter_type'];
			if($mter == 1){
				$valMet = 'Simple Metter';
			}
			elseif($mter == 2){
				$valMet = 'Fire Metter';
			}
			elseif($mter == 3){
				$valMet = 'Metter With Printer';
			}
			else{
				$valMet = '<strong>N/A</strong>';
			}
			echo $valMet;
			 ?>
             </td>
            <td>Equipment.</td>
            <td><?php $eqp = $roCab['equipments'];
			if($eqp == 1){
				$valEq = 'Simple Music System';
			}
			elseif($eqp == 2){
			$valEq = 'Music System With LCD';
			}
			elseif($eqp == 3){
				$valEq = 'Music System Without LCD';
			}
			elseif($eqp == 4){
				$valEq = 'Only FM';
			}
			elseif($eqp == 5){
				$valEq = 'Need to Add';
			}
			elseif($eqp == 6){
				$valEq = 'Other';
			}
			else{
				$valEq ='<strong>N/A</strong>';
			}
			echo $valEq;
			 ?>
              </td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend>Insurance and Permit Details</legend>
        <table width="100%">
          <tr class="row-active">
            <td width="14%">Insurance No.</td>
            <td width="32%"><?php echo $roCab['insurance_no']; ?></td>
            <td width="16%">Insu Comp.</td>
            <td width="38%"><?php echo $roCab['insurance_comp']; ?></td>
          </tr>
          <tr class="row-inactive">
            <td>Issue Date .</td>
            <td><?php echo $roCab['insurance_issue_date']; ?></td>
            <td>Insu. Exp.</td>
            <td><?php echo $roCab['insurance_exp_date']; ?></td>
          </tr>
          <tr class="row-active">
            <td>Emission Test No:</td>
            <td><?php $emi = $roCab['eminiAv'];
			if($emi == "" || $emi == 0){
                            echo "Not Given";
                        }else{
                            echo $emi;
                        }
			 ?>
             </td>
            <td>Test Station Code</td>
            <td><?php echo $roCab['eminiNo']; ?></td>
          </tr>
          <tr class="row-inactive">
            <td >Issue Date.</td>
            <td><?php echo $roCab['eminIss']; ?></td>
            <td>Exp. Date .</td>
            <td><?php echo $roCab['eminExp']; ?></td>
          </tr>
        </table>
      </fieldset>
<fieldset>
  <legend>Payment Details</legend>
  <?php
		$cabCode = $roCab['cab_code'];
		$sqlDep = mysql_query("SELECT * FROM `cab_deposite` WHERE `cd_cab_code` = '$cabCode'");
		if(mysql_error()){
			echo 'No Record Found';
		}else{
			$roDep = mysql_fetch_assoc($sqlDep);
		?>
  <table width="100%">
    <tr class="row-active">
      <td width="14%">Deposite Amount .</td>
      <td width="32%"><?php echo $roDep['cd_deposite_amount']; ?></td>
      <td width="16%">Refundable:</td>
      <td width="38%"><?php $ref = $roDep['cd_deposite_refed']; 
	  if($ref == 1){
		  echo 'YES';
	  }else{
		  echo 'NO';
	  }
	  ?></td>
    </tr>
    <tr class="row-inactive">
      <td>Active Amount:</td>
      <td><?php echo $roDep['cd_call_center_charge']; ?></td>
      <td>Services Tax:</td>
      <td><?php $srid = $roDep['cd_service_charge']; 
      if($srid == 0){
			echo 'Not Included';
		}else{
			echo 'Yes Included';
		}
      ?></td>
    </tr>
    <tr class="row-active">
      <td>Sticker Charge:</td>
      <td><?php 
	  
	  $roPer = $roDep['cd_sticker_charge'];
		if($roPer == 0){
			echo 'No Charge';
		}else{
			echo $roPer;
		}
			 ?>
      </td>
      <?php
	  if($roPer == 0){
	  }else{
	  ?>
      <td>Sticker Amount Pay:</td>
      <td><?php echo $roDep['cd_sticker_charge_paid']; ?></td>
      <?php
	  }
	  ?>
    </tr>
  </table>
  <?php
		}
		?>
  </fieldset>
          <fieldset><legend>Road Permit Details:</legend>
              <?php
              $sqlPer = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$cabCode'");
              if(mysql_error()){
                  echo '<p align="center"><h3>Record Nt Updated</h3></p>';
              }else{
                  $roRod = mysql_fetch_assoc($sqlPer);
                  
              ?>
            <table width="100%">
                <tr><th class="table-header-repeat">Permit Type </th><th class="table-header-repeat">Permit Type</th><th class="table-header-repeat">Date of Issue</th><th class="table-header-repeat">Date Expire </th></tr>
                <tr class="row-active">
                    <td>National Permit</td>
                    <td><?php $ptN = $roRod['roadPerType']; 
                                if($ptN == 1){
                                    echo 'YES';
                                }
                    ?></td>
                    <td>
                        <?php
                          if($ptN == 1){
                            echo $roRod['roadPerIssue'];
                             }
                        ?>                        
                    </td>
                    <td><?php
                          if($ptN == 1){
                            echo $roRod['roadPerExp'];
                             }
                        ?>   </td>
                </tr>
                <tr class="row-inactive">
                    <td>Sate Permit</td>
                    <td><?php $ptS = $roRod['rodSatePer']; 
                                if($ptS == 1){
                                    echo 'YES';
                                }
                    ?></td>
                    <td><?php
                          if($ptS == 1){
                            echo $roRod['rodSateIsse'];
                             }
                        ?> </td>
                    <td><?php
                          if($ptS == 1){
                            echo $roRod['rodSateExp'];
                             }
                        ?> </td>
                </tr>
                <tr class="row-active">
                    <td>Tirupati Permit</td>
                    <td><?php $ptT = $roRod['rodTriuPer']; 
                                if($ptT == 1){
                                    echo 'YES';
                                }
                    ?></td>
                    <td><?php
                          if($ptT == 1){
                            echo $roRod['rodTriuIsse'];
                             }
                        ?> </td>
                    <td><?php
                          if($ptT == 1){
                            echo $roRod['rodTriuExp'];
                             }
                        ?> </td>
                </tr>
                 <tr class="row-inactive">
                    <td>Road Tax</td>
                    <td><?php $roT = $roRod['rodTax']; 
                                if($roT == 1){
                                    echo 'YES';
                                }
                    ?></td>
                    <td><?php
                          if($roT == 1){
                            echo $roRod['taxIssue'];
                             }
                        ?> </td>
                    <td><?php
                          if($roT == 1){
                            echo $roRod['taxExp'];
                             }
                        ?> </td>
                </tr>
            </table>
              <?php
              }
              ?>
        </fieldset>
 
<?php
}
?>