<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";
?>
<script type="text/javascript">
function showSubArea(str)
{
	var str2 = str.substring(0,str.indexOf(':'));
	var strArea = str.substring(str.indexOf(':')+1);
	var uri = "../master/form/view-sub-area-backend.php?arId="+str2;
	var obj = document.getElementById("viewSubArea");
	var mainVal = document.getElementById("areaName");
	if(strArea=='ALL')
		mainVal.innerHTML = "Sub Area";
	else
		mainVal.innerHTML = "Sub area under: "+strArea;
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

</script>
<div class="formContainer" style="width:99%;">
<div class="title">View Sub Area
<div class="action_tool">
    <table>
        <tr>
            
            <td>
                <a href="#" id="../master/form/create-sub-area.php?as=2" onClick="showMainAction(this.id)"><img src="images/001_01.png"/>&nbsp;Create Area</a>
            </td>
            
        </tr>
    </table>
    
</div>
</div>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <th width="79%" align="left">
    <div id="areaName">&nbsp;<strong>Sub Area </strong>
    </div>
    </th>
    <th width="21%">
    <select onChange="showSubArea(this.value)" class="styledselect">
    <?php
	$sqlMainArea = mysql_query("SELECT * FROM `area`");
	if(mysql_error()){
		echo '<option>No Record Found!</option>';
	}else{
		echo '<option value="ALL">Select Main Area</option>';
		while($rowsMain = mysql_fetch_assoc($sqlMainArea)){
			echo '<option value="'.$rowsMain['area_id'].':'.$rowsMain['area_name'].'">'.$rowsMain['area_name'].'</option>';
		}
	}
	?>
    </select>
    </th>
  </tr>
  <tr>
    <td colspan="2">
    <div id="viewSubArea"></div>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/view-sub-area-backend.php?arId=ALL";
	var obj = document.getElementById("viewSubArea");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	
</script>