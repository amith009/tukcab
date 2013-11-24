<?php
require_once "../../core/php/connection.php";
$areId = $_GET['type'];
$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
if(mysql_error()){
	echo 'Try Again!';
}else{
$rows = mysql_fetch_assoc($sqlAre);
?>
<div class="formContainer">
<div class="title" style="margin-bottom: 5px;">Edit Area</div>
<form method="post" id="frmArea" name="frmEditArea" action="../master/php/edit-area.php">
<input type="hidden" name="id" value="<?php echo $areId; ?>" align="center">
<table border="0" >
	<tr>
		<th class="table-header-repeat">Area Name:</th><th class="table-header-repeat"><input type="text" name="areaName" class="required" value="<?php echo $rows['area_name']; ?>"/></th>
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
		<td></td><td><input type="submit" value="Save" class="defaultButton"/></td>
	</tr>
</table>
</form>
</div>
<?php
}//else close here
?>
<script language="javascript">
$("#frmArea").validate();
</script>