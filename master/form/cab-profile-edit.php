<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT * FROM `cabs` WHERE `cab_id` = '$id'");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
?>
<form  method="post" name="frmCreateCab" id="frmCreateCab" action="../master/php/edit-cab.php">
         <input type="hidden" name="cabid" value="<?php echo $id; ?>" />

<table width="100%" >
     
          <tr class="row-active">
            <td width="15%">Plate No.</td>
            <td width="30%"><input name="plNo" type="text" class="required" value="<?php echo $roCab['plate_no']; ?>" /></td>
            <td width="17%">&nbsp;</td>
            <td width="38%">&nbsp;</td>
          </tr>
          <tr class="row-inactive">
            <td>Type .</td>
            <td><select name="cabType" class="required">
            <?php $cabTy = $roCab['cab_type'];
					$vt = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
					$cv = mysql_num_rows($vt);
					if($cv == 0){
						echo 'Not Added Yet!!';
					}else{
						$rv = mysql_fetch_assoc($vt);
							 echo '<option value="'.$cabTy.'">'.$rv['cab_type_name'].'</option>';
					}
					
                 echo '<option disabled>--------------</option>';
              
				$vt = mysql_query("SELECT * FROM `cab_types` WHERE `status`='1'");
				$cv = mysql_num_rows($vt);
				if($cv == 0){
					echo '<option value="0">Not Added Yet!!</option>';
				}else{
					while($rv = mysql_fetch_assoc($vt)){
						?>
						  <option value="<?php echo $rv['cab_type_id']; ?>">[ <?php echo $rv['cab_type_code']; ?> ] <?php echo $rv['cab_type_name']; ?></option>
						  <?php
					}
				}
				?>
            </select></td>
            <td>Mfd. Year </td>
            <td><input name="modYear" type="text" class="required number" maxlength="4" value="<?php echo $roCab['mfd_year']; ?>" /></td>
          </tr>
          <tr class="row-active">
            <td>Fule Type .</td>
            <td><select name="fulType" class="required">
            <?php $fTy = $roCab['fuel_type']; 
              if($fTy == 1){
				  $ValFty =  'Petrol';
			  }elseif($fTy == 2){
				  $ValFty =  'Diesel';
			  }elseif($fTy == 3){
				  $ValFty =  'Gas';
			  }else{
				  $ValFty =  '<strong>N/A</strong>';
			  }
			  echo '<option value="'.$fTy.'">'.$ValFty.'</option>';
               ?>
              <option disabled>----------------</option>
              <option value="1">Petrol</option>
              <option value="2">Diesel</option>
              <option value="3">Gas</option>
            </select></td>
            <td>Body Color .</td>
            <td><select name="color" class="required">
            <?php $col = $roCab['color']; 
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
			echo ' <option value="'.$col.'">'.$valCo.'</option>';
            ?>
              <option disabled>--------------</option>
              <option value="1">Black</option>
              <option value="2">White</option>
              <option value="3">Red</option>
              <option value="4">Blue</option>
              <option value="5">Silver</option>
              <option value="6">Golden</option>
              <option value="7">Green</option>
              <option value="8">Brown</option>
              <option value="9">Orange</option>
              <option value="10">Yellow</option>
              <option value="11">Grey</option>
              <option value="12">Violet</option>
              <option value="13">Other</option>
            </select></td>
          </tr>
          <tr class="row-inactive">
            <td>Chassis No.</td>
            <td><input name="chNo" type="text" value="<?php echo $roCab['chassis_no']; ?>" /></td>
            <td>Air condition . </td>
            <td><select name="airCon">
            <?php $ac = $roCab['cab_ac']; 
			if($ac == 1){
				$valAc = 'YES';
			}else{
				$valAc = 'NO';
			}
			echo '<option value="'.$ac.'">'.$valAc.'</option>';
			?>
              <option disabled>--------------</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select></td>
          </tr>
          <tr class="row-active">
            <td>Engine No.</td>
            <td><input name="engNo" type="text" value="<?php echo $roCab['engine_no']; ?>" /></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr class="row-inactive">
    <td>Meter:</td>
    <td>
        <select name="meter">
     <?php $mtr = $roCab['meter']; 
			if($mtr == 1){
				$valmtr = 'YES';
			}else{
				$valmtr = 'NO';
			}
			echo '<option value="'.$mtr.'">'.$valmtr.'</option>';
			?>
              <option disabled>--------------</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
      
    </select>
    </td>
    
    <td>Sticker:</td>
    <td>
        <select name="sticker">
            <?php $str = $roCab['sticker']; 
			if($str == 1){
				$valstr = 'YES';
			}else{
				$valstr = 'NO';
			}
			echo '<option value="'.$str.'">'.$valstr.'</option>';
			?>
              <option disabled>--------------</option>
      
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select>
    </td>
    
  </tr>
   <tr class="row-active">
    <td>Cab Top:</td>
    <td><select name="cabtop">
            
     <?php $cabt = $roCab['cabTop']; 
			if($cabt == 1){
				$valcbt = 'YES';
			}else{
				$valcbt = 'NO';
			}
			echo '<option value="'.$cabt.'">'.$valcbt.'</option>';
			?>
              <option disabled>--------------</option>
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select></td>
    
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    
  </tr>
          <tr class="row-inactive">
            <td>Meter.</td>
            <td><select name="mtrType">
            <?php $mter = $roCab['meter_type'];
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
			echo '<option value="'.$mter.'">'.$valMet.'</option>';
			 ?>
              <option disabled>----------------------</option>
              <option value="1">Simple Metter.</option>
              <option value="2">Fire Metter.</option>
              <option value="3">Metter With Printer.</option>
            </select></td>
            <td>Equipment.</td>
            <td><select name="eqment">
            <?php $eqp = $roCab['equipments'];
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
			echo '<option value="'.$eqp.'">'.$valEq.'</option>';
			 ?>
              <option disabled>---------------------</option>
              <option value="1">Simple Music System.</option>
              <option value="2">Music System With LCD.</option>
              <option value="3">Music System Without LCD.</option>
              <option value="4">Only FM.</option>
              <option value="5">Need to Add</option>
              <option value="6">Other.</option>
            </select></td>
          </tr>
     
          <tr class="row-active">
            <td width="14%">Insurance No.</td>
            <td width="32%"><input name="insNo" type="text" value="<?php echo $roCab['insurance_no']; ?>" /></td>
            <td width="16%">Insu Comp.</td>
            <td width="38%"><input name="insComp" type="text" value="<?php echo $roCab['insurance_comp']; ?>" /></td>
          </tr>
          <tr class="row-inactive">
            <td>Issue Date .</td>
            <td><input type="text" name="insIssDat" id="insIssDat" value="<?php echo $roCab['insurance_issue_date']; ?>" />
              <script language="javascript">
		$( "#insIssDat" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
  </script>
              <em>YYYY-MM-DD</em></td>
            <td>Insu Exp.</td>
            <td><input type="text" name="insExpDat" id="insExpDat" value="<?php echo $roCab['insurance_exp_date']; ?>" />
              <script language="javascript">
		$( "#insExpDat" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
  </script>
              <em>YYYY-MM-DD</em></td>
          </tr>
          <tr class="row-inactive">
    <td>Emission Test No:</td>
    <td><input name="emiNo" type="text" class="required" value="<?php echo $roCab['eminiAv']; ?>"  /><em>if no put 0</em></td>
    <td>Test Station Code</td>
    <td><input name="emisatCode" type="text" value="<?php echo $roCab['eminiNo']; ?>" /></td>
  </tr>
          <tr class="row-inactive">
            <td >Issue Date.</td>
            <td><input type="text" name="perIssDat" id="perIssDat" value="<?php echo $roCab['eminIss']; ?>" />
              <script language="javascript">
		$( "#perIssDat" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script>
              <em>YYYY-MM-DD</em></td>
            <td>Exp. Date .</td>
            <td><input type="text" name="perExpDat" id="perExpDat" value="<?php echo $roCab['eminExp']; ?>"  />
              <script language="javascript">
		$( "#perExpDat" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script>
              <em>YYYY-MM-DD</em></td>
          </tr>
       
        <tr class="row-active">
          <td width="139">Status :</td>
          <td width="303"><select name="status">
          <?php
		  $sat = $roCab['status'];
		  if($sat == 1){
			  $valSat = "Running";
		  }else{
			  $valSat = "Break Down";
		  }
		  echo '<option value="'.$sat.'">'.$valSat.'</option>';
		  ?>
          <option disabled>---------------</option>
            <option value="1">Running</option>
            <option value="0">Break Down</option>
          </select></td>
          <td width="203">Date of Joining.</td>
          <td width="317"><input name="doj" type="text" id="doj" value="<?php echo $roCab['doj']; ?>" />
            <script language="javascript">
		$( "#doj" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script>
            <em>YYYY-MM-DD</em></td>
        </tr>
        <tr class="row-inactive">
          <td colspan="4" align="right"><input name="submit" type="submit"  value="Save" class="myButton" /></td>
        </tr>
    
</table>
</form>
<script language="javascript">
$("#frmCreateCab").validate();
</script>
<?php
}
?>