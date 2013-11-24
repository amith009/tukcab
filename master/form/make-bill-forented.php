<?php
require_once "../../core/php/connection.php";
?>
<script language="javascript">
//--------------for Main content---
			function showMakeBill(str)
				{
					var uri = "../master/form/make-bill-backend.php?id="+str;
					var obj = document.getElementById("MakeBillArea");
					alertDisp('Loading...','statusType-info',0);
					$(obj).load(uri,function(response, status, xhr) {
						if (status == "error") {
							alertDisp(formatErrMsg(xhr.status),'statusType-error');
						}
						hideAlert();
					});
				}
</script>
<div class="formContainer" style="width: auto;">
    <div class="title" style="width: auto;">Make Bills</div>
<table width="100%" border="0">
  <tr>
    <td width="32%">Select Order No:</td>
    <td width="68%">
    <form id="frmMakeBillFront" method="POST">
    <input type="text" name="textfield" onChange="showMakeBill(this.value)" value="" class="required"></td>
     </form>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
    <div id="MakeBillArea"><img src="images/cancel.png" width="24" height="24"><br>
      <strong>Type Order Number</strong></div>
    </td>
  </tr>
</table>
</div>
<script language="javascript">
$("#frmMakeBillFront").validate();
</script>