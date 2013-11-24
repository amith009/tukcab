<form method="post" name="frmCreateCustomer"  id="frmCust" action="../master/php/add-new-customer.php">
<table width="100%" id="product-table">
  <tr align="left" valign="top">
    <td>
    <table width="100%">
  <tr>
    <td>Name </td>
    <td><input name="custName" type="text" id="custName" class="required"/></td>
    <td>Type </td>
    <td><select name="CustType" id="CustType">
      <option value="1">User</option>
      <option value="0">Orgnization</option>
    </select></td>
  </tr>
  <tr>
    <td>Login ID </td>
    <td><input name="login" type="text" class="required"/></td>
    <td>Password </td>
    <td><input name="pws" type="text" value="<?php echo rand(9999,999999); ?>"/></td>
  </tr>
  <tr>
    <td>Mobile No </td>
    <td><input name="mob" type="text" class="required number" maxlength="10"/></td>
    <td>Alternet Mobile No.</td>
    <td><input name="mob2" type="text" id="mob2" class="number" maxlength="10"/></td>
  </tr>
  <tr>
    <td>E-mail </td>
    <td><input name="email1" type="text" id="email1" class="required email"/></td>
    <td>Alternate E-mail</td>
    <td><input name="email2" type="text" id="email2" class="email"/></td>
  </tr>
   <tr>
    <td>Phone No.</td>
    <td><input name="ph" type="text" id="ph" class="number"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td>Current Address </td>
        <td>Office Address </td>
      </tr>
      <tr>
        <td><textarea name="add1" cols="33" rows="3" ></textarea></td>
        <td><textarea name="add2" cols="33" rows="3" ></textarea></td>
      </tr>
      <tr>
        <td><em>(Type Full Address with pin code)</em></td>
        <td><em>(Type Full Address with pin code)</em></td>
      </tr>
      <tr>
        <td>Residence address </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><textarea name="add3" cols="33" rows="3" ></textarea></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><em>(Type Full Address with pin code)</em></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr align="left"><td colspan="4" align="right"><input type="submit"  value="Save" class="myButton" /> </td></tr>
</table>
</form>
<script language="javascript">
$("#frmCust").validate();
</script>