<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$id'");

$roAdd = mysql_fetch_assoc($sqlAdd);
?>
<form method="post" name="frmCreateCustomer"  id="frmCust" action="../master/php/customer-profile-edit.php">
<table width="990">
  <tr align="left" valign="top">
    <td>
    <table width="100%">
  <tr class="row-active">
    <td width="11%">Name <input type="hidden" value="<?php echo $id;?>" name="id"></td>
    <td width="39%" colspan="3"><input type="text" name="custName" class="required" value="<?php echo $rows['cust_name']; ?>" /></td>
    
  </tr>
  <tr class="row-inactive">
    <td>Login ID </td>
    <td><input name="login" type="text" class="required" value="<?php echo $rows['cust_username']; ?>" /></td>
    <td>Password </td>
    <td><input name="pws" type="text" value="<?php echo $rows['cust_password']; ?>"></td>
  </tr>
  <tr class="row-active">
    <td>Mobile No </td>
    <td><input name="mob" type="text" class="required number" value="<?php echo $rows['mobile']; ?>" maxlength="10" /></td>
    <td>Alternet Mobile No.</td>
    <td><input name="mob2" type="text" id="mob2" class="number" value="<?php echo $rows['alt_mobile']; ?>" maxlength="10" /></td>
  </tr>
  <tr class="row-inactive">
    <td>E-mail </td>
    <td><input name="email1" type="text" id="email1" class="email" value="<?php echo $rows['email']; ?>" /></td>
    <td>Alternate E-mail</td>
    <td><input name="email2" type="text" id="email2" class="email" value="<?php echo $rows['alt_email']; ?>" /></td>
  </tr>
   <tr class="row-active">
    <td>Phone No.</td>
    <td><input name="ph" type="text" id="ph" class="number" value="<?php echo $rows['phone_no']; ?>" maxlength="10" /></td>
    <td>Requirement</td>
    <td><input name="req" type="text"  value="<?php echo $rows['requirement']; ?>" /></td>
  </tr>
  <tr><td>Status :</td><td>
      <select name="status">
          <option value="1">ACTIVE</option>
          <option value="0">BLOCK</option>
      </select>
  </td>
  <td>Priority :</td><td>
      <select name="rate">
          <option value="1">1 star</option>
          <option value="2">2 star</option>
          <option value="3">3 star</option>
          <option value="4">4 star</option>
          <option value="5">5 star</option>
      </select>
  </td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr class="row-inactive">
        <td width="11%">&nbsp;</td>
        <td width="30%"><strong>Current Address </strong></td>
        <td width="28%"><strong>Office Address </strong></td>
        <td width="28%"><strong>Residence address </strong></td>
      </tr>
      <tr class="row-active">
        <td>Address Type</td>
        <td><textarea name="curr"><?php echo $roAdd['cust_add_curr']; ?></textarea></td>
        <td><textarea name="off"><?php echo $roAdd['cust_add_offi']; ?></textarea></td>
         <td><textarea name="res" id="res"><?php echo $roAdd['cust_add_res']; ?></textarea></td>
      </tr>
      <tr class="row-inactive">
        <td>Land Mark</td>
        <td><input type="text" name="lmC" value="<?php echo $roAdd['acurrent_lm']; ?>" /></td>
        <td><input type="text" name="lmO" value="<?php echo $roAdd['off_landmark']; ?>" /></td>
        <td><input type="text" name="lmR" value="<?php echo $roAdd['arecedence_lm']; ?>" /></td>
      </tr>
      <tr class="row-active">
        <td>Location 1</td>
        <td><input type="text" name="lqC1" value="<?php echo $roAdd['acurrent_lq1']; ?>" /></td>
        <td><input type="text" name="lqO1" value="<?php echo $roAdd['aoffice_lq1']; ?>" ></td>
        <td><input type="text" name="lqR1" value="<?php echo $roAdd['arecedence_lq1']; ?>" ></td>
      </tr>
      <tr class="row-inactive">
        <td>Location 2</td>
        <td><input type="text" name="lqC2" value="<?php echo $roAdd['acurrent_lq2']; ?>"></td>
        <td><input type="text" name="lqO2" value="<?php echo $roAdd['aoffice_lq2']; ?>"></td>
        <td><input type="text" name="lqR2" value="<?php echo $roAdd['arecedence_lq2']; ?>"></td>
      </tr>
      <tr class="row-active">
        <td>Location 3</td>
        <td><input name="lqC3" type="text" id="lqC3" value="<?php echo $roAdd['acurrent_lq3']; ?>"></td>
        <td><input type="text" name="lqO3" value="<?php echo $roAdd['aoffice_lq3']; ?>" ></td>
        <td><input type="text" name="lqR3" value="<?php echo $roAdd['arecedence_lq3']; ?>" ></td>
      </tr>
      <tr class="row-inactive">
        <td>Location 4</td>
        <td><input type="text" name="lqC4" value="<?php echo $roAdd['acurrent_lq4']; ?>" ></td>
        <td><input type="text" name="lqO4" value="<?php echo $roAdd['aoffice_lq4']; ?>" ></td>
        <td><input type="text" name="lqR4" value="<?php echo $roAdd['arecedence_lq4']; ?>" ></td>
      </tr>
    </table></td>
  </tr>
  <tr align="left"><td colspan="4" align="right"><input type="submit"  value="Save" class="myButton" /> </td></tr>
</table>
<?php
}
?>
<script language="javascript">
	
		$("#frmCust").validate();

</script>