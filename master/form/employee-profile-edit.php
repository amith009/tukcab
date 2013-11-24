<?php
require_once "../../core/php/connection.php";
session_start();
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
$empCode = $rows['username'];
$sqlSal = mysql_query("SELECT * FROM `employee_sallery` WHERE `emp_id` = '$empCode'");
if(mysql_error()){
    echo 'Unable To Track Employee Sallery Details';
}else{
    $rowsEm = mysql_fetch_array($sqlSal);
?>
<form method="post" id="frmCreateEmployee" name="frmCreateEmployee" action="../master/php/editEmployeeDetails.php" enctype="multipart/form-data" skip="true">
    <input type="hidden" value="<?php echo $id; ?>" name="empId" />
    
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="4">
        <tr class="row-active">
            <td align="left" >Access Id:</td>
            <td align="left"><input name="empCode" type="text" id="empCode" readonly="readonly" value="<?php echo $rows['username']; ?>"/></td>
            <td align="left" >Password</td>
            <td align="left"><input name="pws" type="text" class="required" id="pws"  value="<?php echo $rows['password']; ?>"/></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Name </td>
            <td align="left"><input name="empname" type="text" class="required"  value="<?php echo $rows['emp_name']; ?>"/></td>
            <td align="left" >Type</td>
            <td align="left">
                <select name="emptype" class="required">
                    <?php $empType =  $rows['access_level'];
                    $sqlAccCh = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = $empType");
                    if(mysql_error()){
                         echo '<option value="">Not Define</option>';
                    }else{
                        $rowsApp = mysql_fetch_assoc($sqlAccCh);
                        echo '<option value="'.$rowsApp['access_id'].'">'.$rowsApp['access_type'].'</option>';
                    }
                   
                    echo '<option disabled>------------</option>';
                    
                    $sqlAcc = mysql_query("SELECT * FROM `access_level` ORDER BY `access_type`");
                    if(mysql_error()){
                        echo '<option value="">No Record Found</option>';
                    }else{
                        while($roApp = mysql_fetch_assoc($sqlAcc)){
                            echo '<option value="'.$roApp['access_id'].'">'.$roApp['access_type'].'</option>';
                        }
                    }
                    ?>
                 </select>

                </select>
            </td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Mobile No.</td>
            <td align="left"><input name="empmob" type="text" maxlength="10" class="required number" value="<?php echo $rows['mobile_no']; ?>" /></td>
            <td align="left" >Alter net Mobile. </td>
            <td align="left"><input name="empaltMob" type="text" id="empaltMob" class="number"   value="<?php echo $rows['alt_number']; ?>" maxlength="10"/></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Phone No.</td>
            <td align="left"><input name="empNo" type="text" id="empNo" class="number" value="<?php echo $rows['ph_number']; ?>"/></td>
            <td align="left" >Reference Emp.Code </td>
            <td colspan="0" align="left"><input name="empRef" type="text" id="empRef" value="<?php echo $rows['reference']; ?>" /></td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Sex</td>
            <td align="left">
                <select name="empSex" id="empSex" class="required">
                    <?php
                    $sex = $rows['gender'];
                    if($sex == 1){
                    echo '<option value="1">Male</option>';
                    }else{
                        echo '<option value="2">Female</option>';
                    }
                    ?>
                    <option disabled>------------</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select></td>
            <td align="left">Date of Birth</td>
            <td colspan="0" align="left"><input name="empDob" type="text" id="empDob" class="required" value="<?php echo $rows['dob']; ?>" />
                <em>YYYY-MM-DD</em></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Email address</td>
            <td align="left"><input name="empEmal1" type="text" id="empEmal1" class="email" value="<?php echo $rows['email']; ?>"/></td>
            <td align="left">Alter net Email address</td>
            <td colspan="0" align="left"><input name="empEmail2" type="text" id="empEmail2" class="email" value="<?php echo $rows['alt_email']; ?>"/></td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Street 1</td>
            <td align="left"><input name="str1" type="text" size="44" class="required" value="<?php echo $rows['emp_add1']; ?>" /></td>
            <td align="left" >Street 2</td>
            <td align="left"><input name="str2" type="text" size="44" value="<?php echo $rows['emp_add2']; ?>" /></td>
        </tr>
        <tr class="row-active">
            <td align="left">City </td>
            <td align="left"><input name="city" type="text"   value="<?php echo $rows['city']; ?>"/></td>
            <td align="left" >State</td>
            <td align="left"><input name="state" type="text"  value="<?php echo $rows['state']; ?>" /></td>
        </tr>
        <tr class="row-inactive">
            <td align="left">Country </td>
            <td align="left"><input name="cont" type="text" value="<?php echo $rows['country']; ?>" /></td>
            <td align="left" >Pin </td>
            <td align="left"><input name="pin" type="text" size="15" value="<?php echo $rows['zip']; ?>" class="number" /></td>
        </tr>
        <tr class="row-active">
            <td align="left">Date of Joining </td>
            <td align="left"><input name="doj" type="text" id="doj" class="required" value="<?php echo $rows['doj']; ?>" />
                <em> YYYY-MM-DD</em></td>
            <td align="left" >Status </td>
            <td align="left"><select name="status">
                    <option value="1">ACTIVE</option>
                    <option value="0">BLOCK</option>
                </select></td>
        </tr>
        <tr>
            <td>Employee Image</td>
            <td><input type="file" name="img"  /></td>
            <td>Working Hrs.</td>
            <td><input name="whrs" type="text" class="required" value="<?php echo $rows['working_hrs']; ?>" /></td>
        </tr>
       <?php
       if($_SESSION['EMP_TYPE'] == "7"){
       //do nothink
       }else{
       ?>
        <tr class="row-inactive"> <td colspan="4"><strong>Salary</strong></td></tr>
        <tr class="row-active">
            <td>Basic</td><td><label for="basic"></label>
                <img src="images/rs.png" width="13" height="13" align="absmiddle" />
                <input type="text" name="basic" id="basic" style="text-align:right;" class="number required" value="<?php echo $rowsEm['basic']; ?>" /></td>
            <td>VDA</td><td>%      <input type="text" name="vda" id="vda" class="number" value="<?php echo $rowsEm['vda']; ?>" /></td></tr>
        <tr class="row-inactive">
            <td>HRA</td>
            <td>%      <input type="text" name="hra" id="hra" class="number" value="<?php echo $rowsEm['hra']; ?>" /></td>
            <td>ESI</td>
            <td><label for="esi"></label>
                <select name="esi" id="esi">
                    <?php
                    $si = $rowsEm['esi'];
                    if($si == 1){
                       echo '<option value="1">Yes</option>'; 
                    }else{
                        echo '<option value="0">No</option>';
                    }
                    ?>
                    <option disabled>-----------</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
        </tr>
        <tr class="row-active">
            <td>PF</td>
            <td><select name="pf" id="pf">
                    <?php
                    $pf = $rowsEm['pf'];
                    if($pf == 1){
                       echo '<option value="1">Yes</option>'; 
                    }else{
                        echo '<option value="0">No</option>';
                    }
                    ?>
                    <option disabled>-----------</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Bus Pass :</td>
            <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />  
                <input type="text" name="busPass" id="busPass" style="text-align:right;" class="number required" value="<?php echo $rowsEm['bus_pass']; ?>" /></td>
        </tr>
        <tr class="row-active">
            <td>Have a vehicle</td>
            <td><select name="vechCon" id="vechCon">
                     <?php
                    $vehicle = $rowsEm['vehicle'];
                    if($vehicle == 1){
                       echo '<option value="1">Yes</option>'; 
                    }else{
                        echo '<option value="0">No</option>';
                    }
                    ?>
                    <option disabled>-----------</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Vehicle allowance</td>
            <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
                <input type="text" name="vechAmnt" id="vechAmnt" style="text-align:right;" class="number required" value="<?php echo $rowsEm['vehicle_allowance']; ?>" /></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
            <td>Date of Issue.</td>
            <td><input name="vechIss" type="text" id="vechIss" value="<?php echo $rowsEm['vechDateIss']; ?>" />
                <em> YYYY-MM-DD</em></td></tr>
        <tr class="row-active">
            <td>Mobile allowance</td>
            <td><select name="mobilCon" id="mobilCon">
                    <?php
                    $mobile = $rowsEm['mobile'];
                    if($mobile == 1){
                       echo '<option value="1">Yes</option>'; 
                    }else{
                        echo '<option value="0">No</option>';
                    }
                    ?>
                    <option disabled>-----------</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Company Name / No</td>
            <td><input name="mobComp" type="text"  id="mobComp"  size="44" value="<?php echo $rowsEm['mobile_allowance']; ?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Date of Issue.</td>
            <td><input name="mobIss" type="text" id="mobIss" value="<?php echo $rowsEm['mobDateIss']; ?>"/>
                <em> YYYY-MM-DD</em></td>
        </tr>
        <tr class="row-active">
            <td>Laptop allowance</td>
            <td><select name="lapCon" id="lapCon">
                    <?php
                    $laptop = $rowsEm['laptop'];
                    if($laptop == 1){
                       echo '<option value="1">Yes</option>'; 
                    }else{
                        echo '<option value="0">No</option>';
                    }
                    ?>
                    <option disabled>-----------</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Company Name / No</td>
            <td><input name="lapComp" type="text"  size="44" value="<?php echo $rowsEm['laptop_allowance']; ?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Date of Issue.</td>
            <td><input name="lapIss" type="text" id="lapIss" value="<?php echo $rowsEm['LapDateIss']; ?>"/>
                <em> YYYY-MM-DD</em></td>
        </tr>
        <?php
       }
        ?>
        <tr class="row-inactive"><td colspan="4" align="right"><input  type="submit" class="myButton" value="Update Record" /></td></tr>
    </table>
</form>
<script language="javascript">
    $("#frmCreateEmployee").validate();
   $('#frmCreateEmployee').ajaxForm({
	type: "POST",
	success: function(data) {
		$("#mainContent").html(data);
	}
});
    //for callnder
    $( "#empDob" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    $( "#doj" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    $( "#lapIss" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    $( "#mobIss" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    $( "#vechIss" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    
</script>
<?php
}//salary else close
}
?>