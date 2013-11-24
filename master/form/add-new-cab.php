<?php 
require_once "../../core/php/connection.php"; ?>
<script src="../core/scripts/fileuploader.js" type="text/javascript"></script>
<form method="post" name="frmCreateCab" id="frmCreateCab" action="../master/php/add-new-cab.php" enctype="multipart/form-data" skip="true">
<fieldset style="border:#ccc 1px solid;"><legend>Cab Details</legend>
<table width="100%" cellspacing="0" id="product-table">
  <tr class="row-inactive">
    <td width="15%">Plate No:<em>*</em></td>
    <td width="31%"><input name="plNo" type="text" class="required" />
    </td>
    <td width="16%">Driver Type: <em>*</em></td>
    <td width="38%"><select name="attType" class="required">
      <option value="">Select Attaching Type</option>
      <option value="1">Company Cab [ KK ]</option>
      <option value="2">Owner Cum Driver [ OC ]</option>
      <option value="3">Owner [ OW ]</option>
      <option value="4">Driver [ DR ]</option>
    </select></td>
  </tr>
  <tr class="row-active">
    <td>Cab Type:</td>
    <td><select name="cabType" class="required">
    <option value="">Select Type: <em>*</em></option>
    <?php
	$vt = mysql_query("SELECT * FROM `cab_types` WHERE `status`='1'");
	$cv = mysql_num_rows($vt);
	if($cv == 0){
		echo '<option value="">Not Added Yet!!</option>';
	}else{
		while($rv = mysql_fetch_assoc($vt)){
                    $ctym =  $rv['cab_type_id'];
                    if($ctym == "18" || $ctym == "19" || $ctym == "21" || $ctym == "24" || $ctym == "25" || $ctym == "26" || $ctym == "28"){
                    //do nothink
                    }else{
			?>
            <option value="<?php echo $rv['cab_type_id']; ?>">[ <?php echo $rv['cab_type_code']; ?> ] <?php echo $rv['cab_type_name']; ?></option>
            
            <?php
                    }
		}
	}
	?>
    </select></td>
    <td>Mfd. Year: <em>*</em></td>
    <td><input name="modYear" type="text" class="required number" maxlength="4" /></td>
  </tr>
  <tr class="row-inactive">
    <td>Fuel Type:<em>*</em></td>
    <td><select name="fulType" class="required">
      <option value="">Select </option>
      <option value="1">Petrol</option>
      <option value="2">Diesel</option>
      <option value="3">Gas</option>
    </select></td>
    <td>Body Color: <em>*</em></td>
    <td><select name="color" class="required">
      <option value="">Select</option>
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
  <tr class="row-active">
    <td>Chassis No:</td>
    <td><input name="chNo" type="text" /></td>
    <td>Air condition:</td>
    <td><select name="airCon">
      <option value="0">Select</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select></td>
  </tr>
  <tr class="row-inactive">
    <td>Engine No:</td>
    <td><input name="engNo" type="text" /></td>
    
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    
  </tr>
  <tr class="row-inactive">
    <td>Meter:</td>
    <td>
        <select name="meter">
      <option value="0">Select</option>
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select>
    </td>
    
    <td>Sticker:</td>
    <td>
        <select name="sticker">
      <option value="0">Select</option>
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select>
    </td>
    
  </tr>
   
  <tr class="row-active">
    <td>Meter:</td>
    <td><select name="mtrType">
      <option value="0">Select</option>
      <option value="1">Simple Meter.</option>
      <option value="2">Fire Meter.</option>
      <option value="3">Meter With Printer.</option>
    </select></td>
    <td>Equipment:</td>
    <td><select name="eqment">
      <option value="0">Select</option>
      <option value="1">Simple Music System</option>
      <option value="2">Music System With LCD</option>
      <option value="3">Music System Without LCD</option>
      <option value="4">Only FM</option>
      <option value="5">Need to Add</option>
      <option value="6">Other</option>
    </select></td>
  </tr>
  </table>
  </fieldset>
  <fieldset style="border:#ccc 1px solid;"><legend>Insurance & Emission Details</legend>
  <table width="100%" id="product-table">
  <tr class="row-inactive">
    <td width="14%">Insurance No:</td>
    <td width="32%">
      <input name="insNo" type="text" /></td>
    <td width="16%">Insurance Comp:</td>
    <td width="38%"><input name="insComp" type="text" /></td>
  </tr>
  <tr class="row-active">
    <td>Issue Date:</td>
    <td><input type="text" name="insIssDat" id="insIssDat"  />
    <script language="javascript">
		$( "#insIssDat" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			autoSize: true
			/*minDate: new Date(1950, 1 - 1, 1),
			//maxDate: "+6M +1W",
			yearRange: '1950:2050'*/
		});
</script>
      <em>YYYY-MM-DD</em></td>
    <td>Insurance Exp:</td>
    <td><input type="text" name="insExpDat" id="insExpDat"  />
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
      <td>Emission Test No:<em>*</em></td>
    <td><input name="emiNo" type="text" class="required"  /><em>if no put 0</em></td>
    <td>Test Station Code</td>
    <td><input name="emisatCode" type="text"  /></td>
  </tr>
  <tr class="row-active">
  <td >Issue Date:</td>
  <td><input type="text" name="perIssDat" id="perIssDat" />
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
  <td>Exp. Date:</td>
  <td><input type="text" name="perExpDat" id="perExpDat" />
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
  </table>
  </fieldset>
   <fieldset style="border:#ccc 1px solid;"><legend>CAB IMAGES</legend>
    <table width="100%" border="0" cellpadding="4" cellspacing="4" id="product-table">
  <tr class="row-inactive">
    <td width="17%">Front View</td>
    <td width="29%"><input name="imgf" type="file" class="text_input" id="imgf" /></td>
    <td width="24%">Back View</td>
    <td width="30%"><input name="imgb" type="file" class="text_input" id="imgb" /></td>
  </tr>
  <tr class="row-active">
     <td>Right View</td>
    <td><input name="imgr" type="file" class="text_input" id="imgr" /></td>
    <td>Left View</td>
    <td><input name="imgl" type="file" class="text_input" id="imgl" /></td>
  </tr>
  <tr class="row-inactive">
     <td>Interior Front View.</td>
    <td><input name="imgif" type="file" class="text_input" id="imgif" /></td>
    <td>Interior Back View.</td>
    <td><input name="imgib" type="file" class="text_input" id="imgib" /></td>
  </tr>
</table>
    </fieldset>
  <table width="100%" >
  <tr >
    <td colspan="4">
   
    <fieldset style="border:#ccc 1px solid;"><legend>Payment Details </legend>
    <table width="100%" id="product-table">
      <tr class="row-inactive">
          <td width="14%">Deposit Amount: <em>*</em></td>
        <td width="32%"><img src="images/rs.png" width="13" height="13" align="absmiddle" />
        <input name="depAmnt" type="text" class="number" style="text-align:right;" /><em>if no put 0.00</em></td>
        <td width="25%">Refundable:</td>
        <td width="29%"><select name="dopRef">
          <option value="0">Select</option>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select></td>
      </tr>
      <tr class="row-active">
          <td>Active Amount:<em>*</em></td>
        <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
        <input name="activAmnt" type="text" class="number required" style="text-align:right;"/></td>
        <td>Services Tax:</td>
        <td><select name="srvTax">
          <option value="0">Select</option>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select> 
        </td>
      </tr>
  <tr class="row-active">
    <td>Cab Top:</td>
    <td><select name="cabtop">
      <option value="0">Select</option>
      <option value="1">Yes</option>
      <option value="2">No</option>
      
    </select></td>
    
    <td >Cab Top Amount</td>
    <td ><img src="images/rs.png" width="13" height="13" align="absmiddle" />
	<input type="text"  name="cabtopamt" class="number"/></td>
    
  </tr>
  <tr class="row-inactive">
    <td> Sticker Charge:</td>
    <td><select name="stkrSrv">
      <option>Select</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select></td>
    <td >Sticker Amount:</td>
    <td>
    <img src="images/rs.png" width="13" height="13" align="absmiddle" />
    <input name="stkrAmnt" type="text" class="number" style="text-align:right;" /></td>
  </tr>
   <tr class="row-inactive"><td width="139">Status:</td>
    <td width="303"><select name="status">
      <option value="1">Running</option>
      <option value="0">Break Down</option>
    </select></td>
    <td width="203">Date of Joining: <em>*</em></td>
    <td width="317"><input name="doj" type="text" id="doj" value="<?php echo date("Y-m-d"); ?>" />
     <script language="javascript">
		$( "#doj" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script>
   <em>YYYY-MM-DD</em>
    </td></tr>
  
</table>
    </fieldset>
        <fieldset><legend>Road Permit Details:</legend>
            <table width="100%" id="product-table">
                <tr><td>&nbsp; </td><td>Permit Type</td><td>Date of Issue</td><td>Date Expire </td></tr>
                <tr class="row-active">
                    <td><select name="perNat" class="required">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>National Permit</td>
                    <td><input name="dateNatIss" type="text" id="dateNatIss" />
     <script language="javascript">
		$( "#dateNatIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateNatExp" type="text" id="dateNatExp" />
     <script language="javascript">
		$( "#dateNatExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td></tr>
                <tr class="row-inactive">
                    <td><select name="satNat" class="required">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>State Permit</td>
                    <td><input name="dateSatIss" type="text" id="dateSatIss" />
     <script language="javascript">
		$( "#dateSatIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateSatExp" type="text" id="dateSatExp" />
     <script language="javascript">
		$( "#dateSatExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td></tr>
                <tr class="row-active">
                    <td><select name="trnNat" class="required">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>Tirupati Permit</td>
                    <td><input name="dateTrnIss" type="text" id="dateTrnIss" />
     <script language="javascript">
		$( "#dateTrnIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateTrnExp" type="text" id="dateTrnExp" />
     <script language="javascript">
		$( "#dateTrnExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td></tr>
                <tr class="row-active">
                    <td><select name="rodTax" class="required">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>Road Tax</td>
                    <td><input name="dateRodIss" type="text" id="dateRodIss" />
     <script language="javascript">
		$( "#dateRodIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateRodExp" type="text" id="dateRodExp" />
     <script language="javascript">
		$( "#dateRodExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td></tr>
            </table>
        </fieldset>
    </td>
  </tr>
  <tr>
    <td colspan="4" align="right"><input type="submit"  value="Save" class="myButton" /> </td>
  </tr>
</table>
</form>
<script language="javascript">
$("#frmCreateCab").validate();
$('#frmCreateCab').ajaxForm({
	type: "POST",
	success: function(data) {
		$("#mainContent").html(data);
	}
});
</script>