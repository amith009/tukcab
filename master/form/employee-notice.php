<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<form action="">
<table width="500" border="0">
  <tr>
    <td>To [<?php echo $rows['emp_code']; ?> ]<?php echo $rows['emp_name']; ?></td>
  </tr>
  <tr>
    <td>Subject:</td>
    <td><input type="text" name="sub" class="required"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><textarea name="comm" style="width:400px; height:200px;"></textarea></td>
  </tr>
  <tr><td colspan="2"><input type="submit" name="SEND" class="myButton" /></td></tr>
</table>
</form>
<?php
}
?>