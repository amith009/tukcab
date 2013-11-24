<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
//$id = "INA2";
?>
<form method="post" name="frmCreateDriver" action="../php/add-cab-driver.php">
<table width="500" border="0" id="product-table">
  <tr>
    <th colspan="2" class="table-header-repeat"><strong>Assign Driver for Cab <?php echo $id; ?></strong></th>
  </tr>
  <tr>
    <td>Select Driver:</td>
    <td>
    <select name="driId">
    <option value="0">Select Owner</option>
    <?php
	$sql = mysql_query("SELECT * FROM `drivers` WHERE `driver_type` != '3'");
	if($sql == TRUE){
	while($rows = mysql_fetch_assoc($sql)){
		echo '<option value="'.$rows['driver_id'].'">'.$rows['driver_name'].'</option>';
	}
	}
	?>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Assign driver" class="myButton" /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
</table>
</form>