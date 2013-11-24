<div class="formContainer">
<div class="title">Add Cab Type</div>
<form method="post" name="frmCreateCabType" id="frmType" action="../master/php/create-cab-type.php">
<table border="0" align="center" id="product-table">
	<tr>
		<td align="right">Cab Name:</td><td><input type="text" name="cabName" class="required"/></td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>
			<select name="cabStatus">
				<option>Active</option>
				<option>Blocked</option>
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
$("#frmType").validate();
</script>