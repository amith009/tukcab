<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<script type="text/javascript">
function showView(str)
{
	var uri = "../master/form/customer-profile.php?id="+str;
	var obj = document.getElementById("waitCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showEdit(str)
{
	var uri = "../master/form/customer-profile-edit.php?id="+str;
	var obj = document.getElementById("waitCabList");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<table width="100%" border="0" id="product-table">
  <tr bgcolor="#A6A6A6">
    <td>
    <table width="100%" border="0">
  <tr>
    <th width="57%" align="left" valign="middle" class="table-header-repeat">
   <strong> <?php
	echo $rows['cust_name'];
	?></strong>
    </th>
    <th width="17%" align="right" class="table-header-repeat"><a href="#" onClick="showView(this.id)" id="<?php echo $id; ?>">View Profile</a></th>
    <th width="12%" align="right" class="table-header-repeat"><a href="#" onClick="showEdit(this.id)" id="<?php echo $id; ?>">Edit Profile</a></th>
    <th width="14%" align="right" class="table-header-repeat"><a href="../master/php/customer-profile-del.php?id=<?php echo $id; ?>">Delete Profile</a></th>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td><div id="waitCabList"></div></td>
  </tr>
</table>


<script language="javascript">
	var uri = "../master/form/customer-profile.php?id=<?php echo $id; ?>";
	var obj = document.getElementById("waitCabList");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>
<?php
}//else close
?>