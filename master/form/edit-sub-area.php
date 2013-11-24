<?php
	session_start();
	require_once "../../core/php/connection.php";
	$id = $_GET['id'];
	$sqlSub = mysql_query("SELECT * FROM `sub_area` WHERE `sub_area_id` = $id");
	if(mysql_error()){
		echo 'ERROR: Unable to Sub area';
	}else{
		$rowsAre = mysql_fetch_assoc($sqlSub);
		$mainArID =  $rowsAre['area_id'];
	$res = mysql_query("SELECT area_id,area_name FROM vw_area");
?>
<div class="formContainer" style="width:99%;">
<div class="title">Edit Sub Area</div>
<form method="post" name="frmCreateSubArea" action="../master/php/edit-sub-area.php" id="frmCreateSubArea">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<table width="100%" id="product-table">
	<tr class="row-active">
		<td style="text-align:right;">Main Area:</td>
		<td>
			<select name="parentArea" class="required">
		
          <?php
			$sqlMain = mysql_query("SELECT area_id,area_name FROM area WHERE `area_id` = $mainArID");
			if(mysql_error()){
				//do nothink
			}else{
				$romain = mysql_fetch_assoc($sqlMain);
				echo '<option value="'.$romain['area_id'].'">'.$romain['area_name'].'</option>';
				echo '<option disabled>-------------------------</option>';
			}
			?>
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
	<tr class="row-inactive">
		<td style="text-align:right;">Sub Area:</td><td><input type="text" name="subArea" value="<?php echo $rowsAre['sub_area_name']; ?>" class="required"/></td>
	</tr>
	<tr class="row-active">
		<td colspan="2" style="text-align:right;"><input type="submit" value=" Update " class="myButton"/></td>
	</tr>
	</table>
</form>
</div>
<?php
	}
?>
<script language="javascript">
	$("#frmCreateSubArea").validate();
</script>