<?php 
/*
File Name: add-new-driver.php
Work and function: this is front end file for add-new-driver.php (location: php/)
##########
Create date = 28 NOV 2011
Time: 12:24
Last Update:
Date: 28 NOV 2011
Time: 12:24
Author Name: amit kumar
*/
require_once "../../core/php/connection.php";
require_once "../../core/php/link-access.php";
echo $id = $_GET['id'];
$cabId = $_GET['cbId'];
$sqlT = mysql_query("SELECT driver_id,status FROM `assigned_cabs` WHERE `cab_id` = $cabId");
$countC = mysql_num_rows($sqlT);
if($countC == 0){
include 'new-driver.php';
}else{

//$id = 108;
 $sqlDri = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$id' OR `driver_code` = '$id'");
 if(mysql_error()){
	 echo 'No Record found!!';
 }else{
	 $rodr = mysql_fetch_assoc($sqlDri);
     $oen = $rodr['driver_type'];
 ?> 
 
<form  name="frmCreateDriver" id="frmEditDriver" method="post" action="../master/php/edit-driver.php" skip="true">
<input type="hidden" value="<?php echo $rodr['driver_id']; ?>" name="id" />
<table width="100%" align="center" id="product-table">
  <tr class="row-active">
    <td width="171">Name</td>
    <td width="320"><input name="drivNam" type="text" value="<?php echo $rodr['driver_name']; ?>"  /></td>
    <td width="147">&nbsp</td>
    <td width="332">
        <input type="hidden" value="<?php echo $attTyp = $rodr['driver_type']; ?>" name="attType" />
        </td>
  </tr>
  <tr class="row-inactive">
    <td>Mobile No. <em style="float:right;">+91-</em></td>
    <td><input name="mob" type="text" maxlength="10" class="number"  value="<?php echo $rodr['mobile_no']; ?>" /></td>
    <td>Address Line 1</td>
    <td><input type="text" name="addLine1" value="<?php echo $rodr['add_1']; ?>" /></td>
  </tr>
  <tr class="row-active">
   <td>Alternet No.<em style="float:right;">+91-</em></td>
    <td><input name="mob2" type="text" id="mob2" maxlength="10" class="number" value="<?php echo $rodr['alt_mobile_no']; ?>"/></td>
    <td>Address Line 2</td>
    <td><input type="text" name="addLine2" value="<?php echo $rodr['add_2']; ?>" /></td>
  </tr>
  <tr class="row-inactive">
    <td>Phone No.:</td>
    <td><input name="ph" type="text" id="ph" class="number" value="<?php echo $rodr['phone_no']; ?>" /></td>
    <td>City</td>
    <td><input name="city" type="text" id="city"  value="<?php echo $rodr['city']; ?>"/></td>
  </tr>
  <tr class="row-active">
  <?php
  if($oen == 3){
	  echo '<td>&nbsp;</td><td>&nbsp;</td>';
  }else{
  ?>
    <td>Prefer Location:</td>
    <td>
    <select name="area" id="area">
     
      <?php
	 $prAre = $rodr['prefered_area']; 
	  $sqlPr = mysql_query("SELECT * FROM `area` WHERE `area_id` = $prAre");
	  if(mysql_error()){
		  echo '<option>Select Area</option>!';
	  }else{
		  $rop = mysql_fetch_assoc($sqlPr);
		  echo '<option value="'.$rop['area_id'].'">'.$rop['area_name'].'</option>';
		  echo '<option disabled="disabled">--------------------</option>!';
	  }
                    $are = mysql_query("SELECT * FROM `area` WHERE `status` = '1' ORDER BY  `area_name`");
                    $care = mysql_num_rows($are);
                    if($care == 0){
                        echo '<option>No Record Found</option>!';
                    }else{
                        while($ra = mysql_fetch_assoc($are)){
                            
                        ?>
      <option value="<?php echo $ra['area_id']; ?>"><?php echo $ra['area_name']; ?></option>
      <?php
                        }//while close
                    }
                    ?>
    </select></td>
    <?php
  }
	?>
    <td>State</td>
    <td><input name="state" type="text" id="state" value="<?php echo $rodr['state']; ?>" /></td>
  </tr>
  <tr class="row-inactive">
    <td>E-mail Address</td>
    <td><input name="email" type="text" class="email" value="<?php echo $rodr['email']; ?>"  /></td>
    <td>Country:</td>
    <td><input name="country" type="text" id="country" value="<?php echo $rodr['country']; ?>" /></td>
  </tr>
  <tr class="row-active">
  <?php
  if($oen == 3){
	  echo '<td>&nbsp;</td><td>&nbsp;</td>';
  }else{
  ?>
    <td>Select Owner</td>
    <td>
    <select name="ownId">
    <?php
	$oid = $rodr['driver_owner'];
	
	if($oid == 4){
	$sqlOr = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$oid'");
	if(mysql_error()){
		echo '<option value="0">Select Owner</option>';
	}else{
		$roRO = mysql_fetch_assoc($sqlOr);
		$idOr = $roRO['driver_name'];
	}
	}//if close 
	$sql = mysql_query("SELECT * FROM `drivers` WHERE `driver_type` = '3'");
	if($sql == TRUE){
	echo '<option value="">Select Owner</option>';
	while($rows = mysql_fetch_assoc($sql)){
		echo '<option value="'.$rows['driver_code'].'">'.$rows['driver_name'].'</option>';
	}
	}
	?>
    </select>
    </td>
    <?php
 }
	?>
    <td>Pin</td>
    <td><input name="pin" type="text" id="pin" class="number" value="<?php echo $rodr['zip']; ?>" /></td>
  </tr>
  <tr class="row-inactive">
    <td>Refrence By.</td>
    <td><input name="ref" type="text"  value="<?php echo $rodr['reference_by']; ?>"/></td>
    <?php
	if($oen == 3){
		echo '<td>&nbsp;</td><td>&nbsp;</td>';
	}else{
	?>
    <td>Date of Birth </td>
    <td><input type="text" name="dob" id="dob" value="<?php echo $rodr['dob']; ?>" />
    
     <script language="javascript">
		$( "#dob" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script><em>YYYY-MM-DD</em>
      </td>
      <?php
	}
	  ?>
  </tr>
  <tr class="row-active">
    <td>Images</td>
    <td><input type="file" name="img" /></td>
    <td class="name">Date of Joining</td>
    <td><input type="text" name="jod" id="jod" value="<?php echo $rodr['doj']; ?>"  />
    
     <script language="javascript">
		$( "#jod" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script><em>YYYY-MM-DD</em>
    
    </td>
  </tr>
  <?php
  if($oen == 3){
  }else{
  ?>
  <tr class="row-inactive">
    <td>Driving Licence No :</td>
    <td><input name="dl" type="text" value="<?php echo $rodr['dl_no']; ?>" /></td>
    <td>Badge Number :</td>
    <td><input name="bdge" type="text" value="<?php echo $rodr['badge_no']; ?>" /></td>
  </tr>
  <tr class="row-active">
    <td>Date of Issue.</td>
    <td><input type="text" name="dldoi" id="dldoi" value="<?php echo $rodr['dl_issue_date']; ?>"  />
      <script language="JavaScript" type="text/javascript">
		$( "#dldoi" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
      </script>
      <em>YYYY-MM-DD</em></td>
    <td>Date of Issue.</td>
    <td><input type="text" name="badIs" id="badIs" value="<?php echo $rodr['badge_iss_date']; ?>" />
      <script language="JavaScript" type="text/javascript">
		$( "#badIs" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>
  </tr>
  <tr class="row-active">
    <td>Date of Exp.</td>
    <td><input type="text" name="dlex" id="dlex" value="<?php echo $rodr['dl_exp_date']; ?>" />      <script language="javascript">
		$( "#dlex" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script><em>YYYY-MM-DD</em>
    </td>
    <td>Date of Exp.</td>
    <td><input type="text" name="badgEx" id="badgEx" value="<?php echo $rodr['badge_exp_date']; ?>" /> 
    <script language="javascript">
		$( "#badgEx" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script><em>YYYY-MM-DD</em>
    
      </td>
  </tr>
  <tr class="row-inactive">
    <td align="left" valign="top">Languages Know:</td>
    <td><input name="inco" type="text" value="<?php echo $rodr['insaurance_comp']; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <!--
    <td>Insurance no.</td>
    <td><input name="inno" type="text" id="inno" value="<?php echo $rodr['insaurance_no']; ?>" /></td>-->
  </tr>
  <!--
  <tr class="row-active">
    <td align="left" valign="top">Insurance Exp. Date</td>
    <td><input name="insdatEx" type="text" id="insdatEx" value="<?php echo $rodr['insaurance_exp_date']; ?>" />
        <script language="javascript">
		$( "#insdatEx" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script><em>YYYY-MM-DD</em>

    </td>
    <td align="left" valign="top">&nbsp;</td>
    <td>&nbsp;
    </td>
  </tr>-->
  <?php
  }
  ?>
  <tr class="row-inactive"><td colspan="4" align="right"><input name="submit" type="submit" class="myButton"  value="Update Record" /> </td></tr>
</table>
</form>
<?php
 }
 }
 mysql_close();
?>
<script language="javascript">
$("#frmEditDriver").validate();
$('#frmEditDriver').ajaxForm({
	type: "POST",
	success: function(data) {
		$("#mainContent").html(data);
	}
});
</script>