<div class="formContainer">
<div class="title">Select Profile Theme</div>
<form method="post" id="frmArea" name="frmCreateArea" action="../master/php/profile-theme.php">
<table border="0" align="center">
	<tr>
		<td>
        <select name="them">
           <option value="1">Default Blue</option>
            <option value="2">Drak Night</option>
           <option value="3">Pinky Pink</option>
           <option value="4">Eco Nature</option>
           <option value="5">Sunsine</option>
           <option value="6">Shadow World</option>
        </select>
        </td>
	</tr>
	<tr>
		<td><input type="submit" value="Save" class="defaultButton"/></td>
	</tr>
</table>
</form>
</div>
<script language="javascript">
$("#frmArea").validate();
</script>