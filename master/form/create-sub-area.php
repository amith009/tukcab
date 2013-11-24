<?php
	session_start();
	require_once "../../core/php/connection.php";
	$res = mysql_query("SELECT area_id,area_name FROM vw_area");
?>
<div class="formContainer">
<div class="title">Create Sub Area</div>
<form method="post" name="frmCreateSubArea" action="../master/php/create-sub-area.php" id="frmCreateSubArea">

  <table border="0" align="center" id="product-table">
	<tr>
		<td style="text-align:right;">Main Area:</td>
		<td>
			<select name="parentArea" class="required">
			<option value="">Select Main Area</option>
				<?php
					if($res==FALSE){
						echo '<option disabled>No Area Found</option>';
					}
					else{
						while($row=mysql_fetch_array($res))
							echo '<option value="'.$row['area_id'].'">'.$row['area_name'].'</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="text-align:right;">Sub Area:</td><td><input type="text" name="subArea" class="required"/></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="Create" class="NavButton"/></td>
	</tr>
	</table>
</form>
</div>
<script language="javascript">
	$("#frmCreateSubArea").validate();
</script>