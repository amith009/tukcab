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
 ?> 
<form  name="frmCreateDriver" id="frmCreateDriver" method="post" action="../master/php/new-driver.php" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $_GET['cbId']; ?>" name="cabId" />
<table width="100%" align="center">
<tr bgcolor="#CCCCCC">
  <td colspan="4">
    <strong>
    <?php
$owner = $_GET['owner'];
$dt = $_GET['dt'];
if($dt == 1){
	echo ' Company Driver Details';
}
elseif($dt == 2){
	echo ' Owner Cum Driver Details';
}
elseif($dt == 3){
	echo ' Owner Details';
}

elseif($dt == 4){
	echo ' Driver Details';
	if($owner == 0){
		//do nothing
	}else{
		$sqlOwner = mysql_query("SELECT driver_id,driver_name FROM `drivers` WHERE `driver_id` = $owner");
		if(mysql_error()){
			//do nothink
		}else{
			$rowsOwner = mysql_fetch_assoc($sqlOwner);
			echo 'Under Owner '.$rowsOwner['driver_name'];
		}
	}
}

else{
	echo 'Driver Type Not Selected!';
}
?>
<input type="hidden"  name="attType" value="<?php echo $dt; ?>" />
    &nbsp;</strong></td></tr>
  <tr class="row-inactive">
    <td width="21%">Name</td>
    <td width="30%"><input name="drivNam" type="text" class="required"  /></td>
    <td width="16%">Status :</td>
    <td width="33%"><select name="status">
      <option value="1">ACTIVE</option>
      <option value="0">BLOCK</option>
    </select></td>
  </tr>
  <tr class="row-active">
    <td>Mobile No. <em style="float:right;">+91-</em></td>
    <td><input name="mob" type="text" maxlength="10" class="number required"  /></td>
    <td>Address Line 1</td>
    <td><input type="text" name="addLine1" /></td>
  </tr>
  <tr class="row-inactive">
   <td>Alternet No.<em style="float:right;">+91-</em></td>
    <td><input name="mob2" type="text" id="mob2" maxlength="10" class="number"/></td>
    <td>Address Line 2</td>
    <td><input type="text" name="addLine2" /></td>
  </tr>
  <tr class="row-active">
    <td>Phone No.:</td>
    <td><input name="ph" type="text" id="ph" class="number" /></td>
    <td>City</td>
    <td><input name="city" type="text" id="city" value="Bangalore" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>State</td>
    <td><input name="state" type="text" id="state" value="Karnataka" /></td>
  </tr>
  <tr class="row-inactive"> 
    <td>E-mail Address</td>
    <td><input name="email" type="text" class="email"  /></td>
    <td>Country:</td>
    <td><input name="country" type="text" id="country" value="India" /></td>
  </tr>
  <tr class="row-active">
    <td>Refrence By.</td>
    <td><input name="ref" type="text" /></td>
    <td>Pin</td>
    <td><input name="pin" type="text" class="number" id="pin" value="560" /></td>
  </tr>
  <tr class="row-inactive">
    <td><span class="name">Date of Joining</span></td>
    <td><input type="text" name="jodadt" id="jodadt" value="<?php echo $_GET['doj']; ?>"  />
      <script language="JavaScript" type="text/javascript">
		$( "#jodadt" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  if($dt == 3){
	  //do not display next rows
  }else{
  ?>
  <tr class="row-active">
    <td>Image</td>
    <td><input name="img" type="file" class="text_input" id="img" /></td>
    <td class="name">Date of Birth</td>
    <td><input type="text" name="dob" id="dob" />      <script language="javascript">
		$( "#dob" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script><em>YYYY-MM-DD</em>
    
    </td>
  </tr>
  <tr class="row-inactive"> 
    <td colspan="4" bgcolor="#39789F">
    </td>
  </tr>
  <tr class="row-active">
    <td>Prefer Location:</td>
    <td><select name="area" id="area">
      <option value="0">SELECT AREA</option>
      <?php
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr class="row-active">
    <td>Driving Licence No :</td>
    <td><input name="dl" type="text" /></td>
    <td>Badge Number :</td>
    <td><input name="bdge" type="text" /></td>
  </tr>
  <tr class="row-inactive">
    <td>Date of Issue.</td>
    <td><input type="text" name="dldoi" id="dldoi"  /> 
    <script language="javascript">
		$( "#dldoi" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script><em>YYYY-MM-DD</em>
    </td>
    <td >Date of Issue.</td>
    <td><input type="text" name="badgeIss" id="badgeIss" />
      <script language="JavaScript" type="text/javascript">
		$( "#badgeIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>
  </tr>
  <tr class="row-active">
    <td align="left" valign="top">Date of Exp.</td>
    <td><input type="text" name="dlex" id="dlex" />
      <script language="JavaScript" type="text/javascript">
		$( "#dlex" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>
    <td>Date of Exp.</td>
    <td><input type="text" name="badgeExp" id="badgeExp" />
      <script language="JavaScript" type="text/javascript">
		$( "#badgeExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>
  </tr>
  <!--
  <tr class="row-inactive">  <td>Insurance no.</td>
    <td><input name="inno" type="text" id="inno" /></td>
      <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>-->
  <tr class="row-active">
    <td align="left" valign="top">Languages Know:</td>
    <td><input name="inco" type="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   <!-- <td>Insurance Exp. Date</td>
    <td><input name="insdatEx" type="text" id="insdatEx" />
      <script language="JavaScript" type="text/javascript">
		$( "#insdatEx" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
      </script>
      <em>YYYY-MM-DD</em></td>-->
    </tr>
    <?php
  }//else close for driver condition
	?>
    <tr class="row-inactive">
  <td colspan="4"><input name="submit" type="submit"  value="Save" /> </td></tr>
</table>
</form>
<script language="javascript">
$("#frmCreateDriver").validate();
</script>