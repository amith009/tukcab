<?php
require_once "../../core/php/connection.php";
$srvId = $_GET['id'];
$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvId'");
if(mysql_error()){
	echo 'Try Again!';
}else{
$rows = mysql_fetch_assoc($sqlSrv);
?>
<div class="formContainer">
<div class="title">Edit Service</div>
<form method="post" id="frmSrv" name="frmEditSrv" action="../master/php/edit-services.php">
<input type="hidden" name="id" value="<?php echo $srvId; ?>">
<table border="0" align="center" id="product-table">
	<tr>
		<td>Service Name:</td><td><input type="text" name="srvName" class="required" value="<?php echo $rows['service_type']; ?>"/></td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>
			<select name="staus">
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
}//else close here
?>
<script language="javascript">
$("#frmSrv").validate();
</script>