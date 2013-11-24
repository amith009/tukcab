<?php
//require_once "../../core/php/link-access.php";
$cabId = $_GET['id'];
//$doj = $_GET['doj'];
?>
<form method="post" name="frmCreateCab" id="frmCreateCab" enctype="multipart/form-data" action="../master/php/edit-images.php" skip="true">
<input type="hidden" name="cabId" value="<?php echo $cabId; ?>" />
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>Add Images for<?php echo $cabId; ?></strong> </td>
  </tr>
   <tr>
    <td width="17%">Front View.</td>
    <td width="33%"><input name="imgf" type="file" class="text_input" id="imgf" class="required" /></td>
    <td width="20%">Back View</td>
    <td width="30%"><input name="imgb" type="file" class="text_input" id="imgb" /></td>
  </tr>
  <tr>
     <td>Right View</td>
    <td><input name="imgr" type="file" class="text_input" id="imgr" /></td>
    <td>Left View.</td>
    <td><input name="imgl" type="file" class="text_input" id="imgl" /></td>
  </tr>
  <tr>
     <td>Interior Front View.</td>
    <td><input name="imgif" type="file" class="text_input" id="imgif" /></td>
    <td>Interior Back View.</td>
    <td><input name="imgib" type="file" class="text_input" id="imgib" /></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC" align="right"><input type="submit" name="submit" value="Save  Images" class="NavButton" /></td>
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