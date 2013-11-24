<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee_sallery` WHERE `emp_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<form id="frmAddIncrement" method="post" name="frmAddIncrement" action="../master/php/add-increment.php"> 
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table width="1000" border="0" id="product-table">
  <tr class="row-active">
    <td width="242">Basic :</td>
    <td width="748">
      <img src="images/rs.png" width="13" height="13">
    <input type="text" name="basic" id="basic" style="text-align:right;" value="<?php echo $rows['basic']; ?>" class="required number"></td>
  </tr>
  <tr class="row-inactive">
    <td>HRA</td>
    <td>
    %
    <input type="text" name="hra" id="hra" value="<?php echo $rows['hra']; ?>" class="number"></td>
  </tr>
  <tr class="row-active">
    <td>VDA</td>
    <td>
    %
    <input type="text" name="vda" id="vda" value="<?php echo $rows['vda']; ?>" class="number"></td>
  </tr>
  <tr class="row-active">
    <td>PF</td>
    <td>
      <select name="pf" id="pf" class="required">
       <option value=" ">Select</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select></td>
  </tr>
  <tr class="row-inactive">
    <td>ESI</td>
    <td>
      <select name="esi" id="esi" class="required">
      <option value=" ">Select</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select></td>
  </tr>
  <tr class="row-active">
    <td>Date </td>
    <td><input type="text" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" ></td>
  </tr>
  <tr class="row-active">
    <td>Status</td>
    <td><select name="status" id="status" class="required">
      <option value=" ">Select</option>
      <option value="1">Active</option>
      <option value="0">Block</option>
    </select></td>
  </tr>
  <tr class="row-inactive">
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" class="myButton" id="submit" value=" Upgrade Sallery "></td>
  </tr>
</table>
</form>
<?php
}
?>
<script language="javascript">
$("#frmAddIncrement").validate();

//for callnder

		$( "#date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script>