<div class="formContainer">
<div class="title">Add Service</div>
<form method="post" id="frmSrv" name="frmSrvices" action="../master/php/add-services.php">
<table border="0" align="center" id="product-table">
	<tr>
		<td>Service Name:</td><td><input type="text" name="srvName" class="required"/></td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>
			<select name="staus" class="required">
				<option value="1">Active</option>
				<option value="0">Blocked</option>
			</select>
		</td>
	</tr>
	<tr>
		<td></td><td><input type="submit" value="Save" class="NavButton"/></td>
	</tr>
</table>
</form>
</div>
<script language="javascript">
$("#frmSrv").validate();
</script>