<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT cab_id,cab_code,status FROM `cabs` WHERE `cab_id` = '$id'");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
        
        $sqlAss = mysql_query("SELECT `driver_id` FROM `assigned_cabs` WHERE `cab_id` = $id AND `status` = 1");
        if(mysql_error()){
            $drId = 0;
            }else{
                $roDr = mysql_fetch_assoc($sqlAss);
                $drId = $roDr['driver_id'];
            }
?>
<script type="text/javascript">
function showView1(str)
{
	var uri = "../master/form/cabs-profile.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showEdit1(str)
{
	var uri = "../master/form/edit-cabs-record.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showImages1(str)
{
	var uri = "../master/form/cab-images-view.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

function showDriver1(str)
{
	var uri = "../master/form/vew-driver-profile.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showPayment(str)
{
	var uri = "../master/form/cab-payment-record.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showCabDriver(str)
{
	var uri = "../master/form/change-cab-driver.php?id="+str;
	var obj = document.getElementById("cabRecord");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<table width="100%" id="product-table">
  <tr>
    <th width="25%" class="table-header-repeat">
    <?php
	$sat = $roCab['status'];
	if($sat == 1){
		echo '<img src="images/green-cab.png" width="30" height="26" align="absmiddle">';
	}else{
		echo '<img src="images/red_car.png" width="32" height="32" align="absmiddle">';
	}
	?>
   CAB CODE : <?php echo $roCab['cab_code']; ?></th>
   <th align="right" class="table-header-repeat"><a href="#" onClick="showView1(this.id)" id="<?php echo $id; ?>">Details</a></th>
   <th  align="right" class="table-header-repeat"> <a href="#" onClick="showPayment(this.id)" id="<?php echo $id; ?>">Payment Status</a></th>
    <th align="right" class="table-header-repeat"><a href="#" onClick="showEdit1(this.id)" id="<?php echo $id; ?>">Edit</a></th>
    <th  align="right" class="table-header-repeat"><a href="#" onClick="showImages1(this.id)" id="<?php echo $id; ?>">Images</a></th>
    <th  align="right" class="table-header-repeat"> <a href="#" onClick="showDriver1(this.id)" id="<?php echo $drId; ?>">Driver</a></th>
    <th  align="right" class="table-header-repeat"><a href="#" id="<?php echo $id; ?>" onClick="showCabDriver(this.id)" class="table-header-repeat" >Change Driver</a></th>
    <th  align="right" class="table-header-repeat"><a href="../master/form/print_cab_record.php?id=<?php echo $drId; ?>" class="table-header-repeat" target="_blank" >Print Record</a></th>
  </tr>
  <tr>
    <td colspan="10"><div id="cabRecord"></div></td>
  </tr>
</table>

<script language="javascript">
	var uri = "../master/form/cabs-profile.php?id=<?php echo $id; ?>";
	var obj = document.getElementById("cabRecord");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>
<?php
}
mysql_close();
?>