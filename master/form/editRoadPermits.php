<?php
require_once "../../core/php/connection.php";
$cabId = $_GET['id'];
$sqlCab = mysql_query("SELECT `cab_code` FROM `cabs` WHERE `cab_id` = $cabId");
if(mysql_error()){
    echo 'Unable to Read Cab Code';
}else{
    $rows = mysql_fetch_assoc($sqlCab);
    $code = $rows['cab_code'];
    
    $sqlRe = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$code'");
    $roPer = mysql_fetch_assoc($sqlRe);
?>
<form method="post" name="frmCreateCab" id="frmCreateCab" action="../master/php/editRoadPermit.php">
    <input type="hidden" value="<?php echo $cabId; ?>" name="cabId" />
            <table width="100%" id="product-table">
                <tr><td colspan="4" align="left"><div class="title">Update Road Permit</div></td></tr>
                <tr><th class="table-header-repeat">&nbsp; </th><th class="table-header-repeat">Permit Type</th><th class="table-header-repeat">Date of Issue</th><th class="table-header-repeat">Date Expire </th></tr>
                <tr class="row-active">
                    <td><select name="perNat" class="required">
                            <?php
                            $nat = $roPer['roadPerType'];
                            if($nat == 1){
                                echo '<option value="1">Yes</option>';
                            }else{
                               echo '<option value="0">No</option>'; 
                            }
                            ?>
                            <option disabled >----------------</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>National Permit</td>
                    <td><input name="dateNatIss" type="text" id="dateNatIss" value="<?php echo $roPer['roadPerIssue']; ?>" />
     <script language="javascript">
		$( "#dateNatIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateNatExp" type="text" id="dateNatExp" value="<?php echo $roPer['roadPerExp']; ?>" />
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
                            <?php
                            $sat = $roPer['rodSatePer'];
                            if($sat == 1){
                                echo '<option value="1">Yes</option>';
                            }else{
                               echo '<option value="0">No</option>'; 
                            }
                            ?>
                            <option disabled >----------------</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>Sate Permit</td>
                    <td><input name="dateSatIss" type="text" id="dateSatIss" value="<?php echo $roPer['rodSateIsse']; ?>" />
     <script language="javascript">
		$( "#dateSatIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateSatExp" type="text" id="dateSatExp" value="<?php echo $roPer['rodSateExp']; ?>" />
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
                            <?php
                            $tre = $roPer['rodTriuPer'];
                            if($tre == 1){
                                echo '<option value="1">Yes</option>';
                            }else{
                               echo '<option value="0">No</option>'; 
                            }
                            ?>
                            <option disabled >----------------</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>Tirupati Permit</td>
                    <td><input name="dateTrnIss" type="text" id="dateTrnIss" value="<?php echo $roPer['rodTriuIsse']; ?>" />
     <script language="javascript">
		$( "#dateTrnIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateTrnExp" type="text" id="dateTrnExp" value="<?php echo $roPer['rodTriuExp']; ?>" />
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
                             <?php
                            $tax = $roPer['rodTax'];
                            if($tax == 1){
                                echo '<option value="1">Yes</option>';
                            }else{
                               echo '<option value="0">No</option>'; 
                            }
                            ?>
                            <option disabled >----------------</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> </td>
                    <td>Road Tax</td>
                    <td><input name="dateRodIss" type="text" id="dateRodIss" value="<?php echo $roPer['taxIssue']; ?>"  />
     <script language="javascript">
		$( "#dateRodIss" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td>
                    <td><input name="dateRodExp" type="text" id="dateRodExp" value="<?php echo $roPer['taxExp']; ?>" />
     <script language="javascript">
		$( "#dateRodExp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
			//minDate: 0,
			//maxDate: "+1M +60D"
		});
   </script></td></tr>
                <tr><td colspan="4" align="right"><input type="submit" vaue="Update Record" class="NavButton" /></td></tr>
            </table>
        </form>
<?php

}
?>
