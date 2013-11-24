<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";

?>
<script type="text/javascript">
function showSubArea()
{
	var uri = "../master/form/bill-customer-details.php";
	var obj = document.getElementById("billaction")	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

</script>
<div class="formContainer" style="width:99%;">
<div class="title" style="margin-bottom: 5px;">Create Bill for Customer</div>
<table width="100%">
   <tr>
        <td align="left" valign="top">
            <div id="billaction">Please wait..</div>
        </td>
    </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/bill-customer-details.php";
	var obj = document.getElementById("billaction");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	
</script>