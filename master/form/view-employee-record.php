<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$id'");
if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<script type="text/javascript">
function showView(str)
{
	var uri = "../master/form/employee-profile.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showEdit(str)
{
	var uri = "../master/form/employee-profile-edit.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showSend(str)
{
	var uri = "../master/form/employee-notice.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showIncrement(str)
{
	var uri = "../master/form/add-increment.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showLoginDetails(str)
{
	var uri = "../master/form/employee-login.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showNotice(str)
{
	var uri = "../master/form/add-notice.php?id="+str;
	var obj = document.getElementById("employee-status");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title" style="margin-bottom: 5px;">Employee Record</div>
<table width="100%" border="0" id="product-table">
  <tr >
    <td>
    <table width="100%" border="0">
  <tr>
    <th width="17%" align="left" valign="middle" class="table-header-repeat">
        <img src="<?php echo $rows['emp_img_content'];?>" width="30" height="30" align="ABSMIDDLE" />
        <strong> <?php echo $rows['emp_name'];?></strong> [ <?php echo $rows['username'];?>]
    </th>
    <th width="13%" align="right" class="table-header-repeat">
    <a href="#" onClick="showView(this.id)" id="<?php echo $id; ?>">View Profile</a></th>
    <th width="16%" align="right" class="table-header-repeat">
    <a href="#" onClick="showEdit(this.id)" id="<?php echo $id; ?>">Edit Record</a></th>
    <th width="14%" class="table-header-repeat"> 
	<a href="#" onClick="showLoginDetails(this.id)" id="<?php echo $id; ?>">Login details</a></th>
    <?php
    $empType = $_SESSION['EMP_TYPE'];
    if($empType == 7){
        //do nothink
    }else{
    ?>
    <th width="16%" class="table-header-repeat"> <a href="#" onClick="showIncrement(this.id)" id="<?php echo $rows['username']; ?>"> Add Increment</a></th>
    <?php
    }
    ?>
    <th width="12%" class="table-header-repeat">
    <a href="#" onClick="showNotice(this.id)" id="<?php echo $rows['username']; ?>"> Add Notice</a></th>
   <th  align="right" class="table-header-repeat"><a href="../master/form/print_emp_record.php?id=<?php echo $id; ?>" class="table-header-repeat" target="_blank" >Print Record</a></th>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td><div id="employee-status"></div></td>
  </tr>
</table>
</div>

<script language="javascript">
	var uri = "../master/form/employee-profile.php?id=<?php echo $id; ?>";
	var obj = document.getElementById("employee-status");
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