<?php
require_once "../../core/php/connection.php";
$tyId = $_GET['id'];
$sqlAre = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$tyId'");
if(mysql_error()){
	echo 'Try Again!';
}else{
$rows = mysql_fetch_assoc($sqlAre);
?>
<div class="formContainer">
<div class="title">Edit Cab Type</div>
<form method="post" name="frmCreateCabType" id="frmType" action="../master/php/edit-cab-type.php">
<input type="hidden" name="id" value="<?php echo $tyId; ?>" />
<table border="0" align="center" id="product-table">
	<tr>
		<td align="right">Cab Name:</td><td><input type="text" name="cabName" class="required" value="<?php echo $rows['cab_type_name']; ?>"/></td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>
			<select name="cabStatus">
				<option value="1">Active</option>
				<option value="0">Blocked</option>
			</select>
		</td>
	</tr>
	<tr>
		<td></td><td><input type="submit" value="Save" class="defaultButton"/></td>
	</tr>
</table>
</form>
</div>
<?php
}
?>
<script language="javascript">
$("#frmType").validate();
</script>