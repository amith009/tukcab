<?php
require_once "../../core/php/connection.php";
$type = $_GET['type'];
$orId = substr($type,3);
$sqlOrd = mysql_query("SELECT * FROM `book_master` WHERE `booking_id` = '$orId'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
	$roOd = mysql_fetch_assoc($sqlOrd);
	
	?>
    <form action="../master/php/add-complain.php" name="frmComplain" id="frmComplain" method="post">
    <table width="500" border="0" id="product-table">
  <tr>
    <td bgcolor="#A6A6A6"><strong>ORDER ID :</strong> <?php echo $roOd['booking_code']; ?></td>
  </tr>
  <tr>
    <td>Comment about Order.<input type="hidden" name="bid" value="<?php echo $orId; ?>"></td>
  </tr>
  <tr>
    <td><textarea name="comm" style="width:500px; height:200px;" class="required"></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#A6A6A6"><input type="submit" class="mybutton" value="Add Complain" /></td>
  </tr>
</table>
</form>
    <?php
}
?>
<script language="javascript">
$("#frmComplain").validate();

</script>