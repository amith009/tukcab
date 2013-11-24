<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
?>
<form name="frmNotice" id="frmNotice" method="post" action="#" >
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table width="1000" border="0" id="product-table">
  <tr>
    <td>Title :<input type="text" name="title" style="width:300px;" class="required"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><textarea name="remark" id="remark" style="width:600px; height:200px;"></textarea></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" class="myButton" value=" Send Notice" /></td>
  </tr>
</table>
</form>
<script language="javascript">
$("#frmNotice").validate();
</script>