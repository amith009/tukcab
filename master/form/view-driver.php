<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT driver_id,driver_type FROM `drivers` WHERE `driver_id` = '$id' AND `status` = 1");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
	 $dt = $roCab['driver_type'];
	$sqlAs = mysql_query("SELECT cab_id FROM `assigned_cabs` WHERE `driver_id` = $id");
	if(mysql_error()){
	echo 'No Cab Assign For This Driver';
	}else{
	 $roCa = mysql_fetch_assoc($sqlAs);
            $cbId = $roCa['cab_id'];
?>
<script type="text/javascript">
function showViewDriver(str)
{
	var uri = "../master/form/vew-driver-profile.php?id="+str;
	var obj = document.getElementById("driver-content");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//asign cab function//
function showAssignCabDriver(str)
{
	var uri = "../master/form/assign-cab-driver.php?id="+str;
	var obj = document.getElementById("driver-content");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//edit driver function//
function showEditDriver(str)
{
	var uri = "../master/form/edit-driver.php?dt=<?php echo $dt; ?>&cbId=<?php echo $cbId; ?>&id="+str;
	var obj = document.getElementById("driver-content");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
  <table width="100%" border="0" id="product-table">
  <tr>
  <th class="table-header-repeat">
      <img src="images/001_38.png" width="24" height="24" align="absmiddle" />
 <a href="#" onClick="showViewDriver(this.id)" id="<?php echo $id; ?>"> View</a></th>
    <th class="table-header-repeat"><img src="images/001_45.png" width="24" height="24" align="absmiddle" />
    <a href="#" onClick="showEditDriver(this.id)" id="<?php echo $id; ?>">Edit</a></th>
    <!--th class="table-header-repeat"><img src="images/car_add.png" width="24" height="24" align="absmiddle" />
     <a href="#" onClick=" showAssignCabDriver(this.id)" id="<?php echo $id; ?>"> Asign Cab</a></th-->
    <!--/* <th><img src="images/document-revert.png" width="24" height="24" align="absmiddle" /><a href="#"> Make payment</a></th>
   <th><img src="images/001_29.png" width="24" height="24" align="absmiddle" />
    <a href="../master/form/delete-driver.php?id=<?php echo $id; ?>" onClick="return confirm('Would you like to delete this driver Record')" > Delete</a></th>*/-->
  </tr>
  <tr><td colspan="6" align="center" valign="top">
  <div id="driver-content"></div>
  </td></tr>
</table>
<script language="javascript">
	var uri = "../master/form/vew-driver-profile.php?id=<?php echo $id; ?>";
	var obj = document.getElementById("driver-content");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>
<?php
}
}
mysql_close();
?>