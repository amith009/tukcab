<?php
/*
  File Name: add-new-employee.php
  ##########
  Create date = 10 Dec 2011
  Time: 12:24
  Last Update:
  Date: 28 NOV 2011
  Time: 12:24
  Author Name: amit kumar
 */
require_once "../../core/php/connection.php";
require_once "../../core/php/link-access.php";
session_start();
//employee login id generate here
$sqlEmp = mysql_query("SELECT * FROM `employee` ORDER BY `emp_id` DESC");
if ($sqlEmp == TRUE) {
    $rowEmp = mysql_fetch_assoc($sqlEmp);
    $cv = $rowEmp['username'];
    $pl = substr($cv, 4) + 1;
    $EmpLogin = "KKE0" . $pl;
} else {
    $EmpLogin = "KKE01";
}
$empType = $_SESSION['EMP_TYPE'];
?> 
<div class="formContainer" style="width:99%;">
<div class="title" style="margin-bottom: 5px;">Add New Employee</div>
<form method="post" id="frmEmployee" name="frmCreateEmployee" action="../master/php/add-new-employee.php" enctype="multipart/form-data" skip="true">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="4" id="product-table">
        <tr class="row-active">
            <td align="left" >Access Id:</td>
            <td align="left"><input name="empId" type="text" id="empId" readonly="readonly" value="<?php echo $EmpLogin; ?>"/></td>
            <td align="left" >Password</td>
            <td align="left"><input name="pws" type="text" class="required" id="pws" value="<?php echo rand(9999, 999999); ?>"/></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Name </td>
            <td align="left"><input name="empname" type="text" class="required"/></td>
            <td align="left" >Type</td>
            <td align="left">
                <select name="emptype" class="required">
                    <option value="">Select</option>
                    <?php
                    $sqlAcc = mysql_query("SELECT * FROM `access_level` WHERE `access_type`!='Executive Administrator' ORDER BY `access_type`");
                    if(mysql_error()){
                        echo '<option value="">No Record Found</option>';
                    }else{
                        while($roApp = mysql_fetch_assoc($sqlAcc)){
                            $acLop = $roApp['access_id'];
                            if($acLop == "1" || $acLop == "6"){
                                //do nothink
                            }else{
                            echo '<option value="'.$roApp['access_id'].'">'.$roApp['access_type'].'</option>';
                            }
                        }
                    }
                    ?>
                 </select>
            </td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Mobile No.</td>
            <td align="left"><input name="empmob" type="text" maxlength="10" class="required number" /></td>
            <td align="left" >Alternet Mobile. </td>
            <td align="left"><input name="empaltMob" type="text" id="empaltMob" class="number" maxlength="10"/></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Phone No.</td>
            <td align="left"><input name="empNo" type="text" id="empNo" class="number"/></td>
            <td align="left" >Reference Emp.Code </td>
            <td colspan="0" align="left"><input name="empRef" type="text" id="empRef" /></td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Sex</td>
            <td align="left"><select name="empSex" id="empSex" class="required">
                    <option value="">Select sex</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select></td>
            <td align="left">Date of Birth</td>
            <td colspan="0" align="left"><input name="empDob" type="text" id="empDob" class="required"/>
                <em>YYYY-MM-DD</em></td>
        </tr>
        <tr class="row-active">
            <td align="left" >Email address</td>
            <td align="left"><input name="empEmal1" type="text" id="empEmal1" class="email"/></td>
            <td align="left">Alternet Email address</td>
            <td colspan="0" align="left"><input name="empEmail2" type="text" id="empEmail2" class="email"/></td>
        </tr>
        <tr class="row-inactive">
            <td align="left" >Street 1</td>
            <td align="left"><input name="str1" type="text" size="44" class="required" /></td>
            <td align="left" >Street 2</td>
            <td align="left"><input name="str2" type="text" size="44" /></td>
        </tr>
        <tr class="row-active">
            <td align="left">City </td>
            <td align="left"><input name="city" type="text" value="BANGALORE" /></td>
            <td align="left" >State</td>
            <td align="left"><input name="state" type="text" value="KARNATAKA" /></td>
        </tr>
        <tr class="row-inactive">
            <td align="left">Country </td>
            <td align="left"><input name="cont" type="text" value="INDIA" /></td>
            <td align="left" >Pin </td>
            <td align="left"><input name="pin" type="text" size="15" value="560" class="number" /></td>
        </tr>
        <tr class="row-active">
            <td align="left">Date of Joining </td>
            <td align="left"><input name="doj" type="text" id="doj" class="required" value="<?php echo date("Y-m-d"); ?>"/>
                <em> YYYY-MM-DD</em></td>
            <td align="left" >Status </td>
            <td align="left"><select name="status" class="required">
                    <option value="">Select status</option>
                    <option value="1">ACTIVE</option>
                    <option value="0">BLOCK</option>
                </select></td>
        </tr>
        <tr>
            <td>Employee Image</td>
            <td><input type="file" name="img"  /></td>
            <td>Working Hrs.</td>
            <td><input name="whrs" type="text" class="required" /></td>
        </tr>
        <?php
        if($empType == "7"){
            //do nothink
        }else{
        ?>
        <tr class="row-inactive"> <td colspan="4"><strong>Salary</strong></td></tr>
        <tr class="row-active">
            <td>Basic</td><td><label for="basic"></label>
                <img src="images/rs.png" width="13" height="13" align="absmiddle" />
                <input type="text" name="basic" id="basic" style="text-align:right;" class="number required" /></td>
            <td>VDA</td><td>%      <input type="text" name="vda" id="vda" class="number" /></td></tr>
        <tr class="row-inactive">
            <td>HRA</td>
            <td>%      <input type="text" name="hra" id="hra" class="number" /></td>
            <td>ESI</td>
            <td><label for="esi"></label>
                <select name="esi" id="esi">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
        </tr>
        <tr class="row-active">
            <td>PF</td>
            <td><select name="pf" id="pf">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Bus Pass :</td>
            <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />      <input type="text" name="busPass" id="busPass" style="text-align:right;" class="number required" /></td>
        </tr>
        <tr class="row-active">
            <td>Have a vehicle</td>
            <td><select name="vechCon" id="vechCon">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Vehicle allowance</td>
            <td><img src="images/rs.png" width="13" height="13" align="absmiddle" />
                <input type="text" name="vechAmnt" id="vechAmnt" style="text-align:right;" class="number required" /></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
            <td>Date of Issue.</td>
            <td><input name="vechIss" type="text" id="vechIss" value="<?php echo date("Y-m-d"); ?>"/>
                <em> YYYY-MM-DD</em></td></tr>
        <tr class="row-active">
            <td>Mobile allowance</td>
            <td><select name="mobilCon" id="mobilCon">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Company Name / No</td>
            <td><input name="mobComp" type="text"  id="mobComp"  size="44" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Date of Issue.</td>
            <td><input name="mobIss" type="text" id="mobIss" value="<?php echo date("Y-m-d"); ?>"/>
                <em> YYYY-MM-DD</em></td>
        </tr>
        <tr class="row-active">
            <td>Laptop allowance</td>
            <td><select name="lapCon" id="lapCon">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
            <td>Company Name / No</td>
            <td><input name="lapComp" type="text"  size="44" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Date of Issue.</td>
            <td><input name="lapIss" type="text" id="lapIss" value="<?php echo date("Y-m-d"); ?>"/>
                <em> YYYY-MM-DD</em></td>
        </tr>
        <?php
        }
        ?>
        <tr class="row-inactive"><td colspan="4" align="right"><input  type="submit" class="myButton" value="Save"/></td></tr>
    </table>
</form>
</div>
<script language="javascript">
    $("#frmEmployee").validate();
   $('#frmEmployee').ajaxForm({
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