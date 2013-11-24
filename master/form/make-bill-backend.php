<?php
require_once "../../core/php/connection.php";
 $value = $_GET['id'];
$BunchId = explode(',', $value);
$totaOr = count($BunchId);
$m = 1;
for($i = 0; $i < $totaOr; $i++){
$id = $BunchId[$i];
$sqlBook = mysql_query("SELECT * FROM `book_master` WHERE `booking_code` = $id");
$count = mysql_num_rows($sqlBook);
if($count == 0){
	echo '<img src="images/cancel.png" width="24" height="24"><br><strong>No Record Found!</strong>';
}else{
	$rows = mysql_fetch_assoc($sqlBook);
	$custId = $rows['cust_id'];
	$cabID = $rows['cab_id'];
	$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$custId'");
	$rowsCust = mysql_fetch_assoc($sqlCust);
     $sat = $rows['status'];
     $t = $m++;
 
	  }//else close

?>
<script language="javascript">
$("#frmMakeBill").validate();

		$( "#date<?php echo $t; ?>" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script>
<?php
}//for close
?>
    