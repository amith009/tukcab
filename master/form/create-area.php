<div class="formContainer">
<div class="title">Create New Area</div>
<form method="post" id="frmArea" name="frmCreateArea" action="../master/php/create-area.php">
<table border="0" align="center" id="product-table">
	<tr>
		<td>Area Name:</td><td><input type="text" name="areaName" class="required"/></td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>
			<select name="areaStaus" class="required">
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
$("#frmArea").validate();
</script>