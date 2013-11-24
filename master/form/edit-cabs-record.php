<?php
require_once "../../core/php/connection.php";
$cabId = $_GET['id'];
$sqlDri = mysql_query("SELECT `driver_id`,`status` FROM `assigned_cabs` WHERE `cab_id` = $cabId  AND `status` = 1");
if(mysql_error()){
	echo '<div style="text-align:center;"><b>No Driver Assign for this Cab!!</b></div>';
}else{
$roDR = mysql_fetch_assoc($sqlDri);
$driId = $roDR['driver_id'];
$sqlOwn = mysql_query("SELECT driver_type,driver_owner FROM `drivers` WHERE `driver_id` = $driId");
if(mysql_error()){
	echo '<div style="text-align:center;"><b>Driver Record Not Found!!</b></div>';
}else{
	$rown = mysql_fetch_assoc($sqlOwn);
	 $ownTy = $rown['driver_type'];
	$ownId = $rown['driver_owner'];
        
}
?>

<script type="text/javascript">
function showCabEdit(str){
	var uri = "../master/form/cab-profile-edit.php?id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//driver record tracking
function showDriverEdit(str)
{
	var uri = "../master/form/edit-driver.php?dt=2&cbId=<?php echo $cabId; ?>&id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
function showOwnerEdit(str)
{
	var uri = "../master/form/edit-driver.php?dt=3&cbId=<?php echo $cabId; ?>&id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//payment record tracking
function showPaymentEdit(str)
{
	var uri = "../master/form/edit-deposite.php?id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//Images record tracking
function showImagesEdit(str)
{
	var uri = "../master/form/add-cab-images.php?id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//Images record tracking
function showOwneType(str)
{
	var ans = confirm("Do you want to change Attaching Type?");
        if(ans){
            var uri = "../master/form/change-driver-type.php?str="+str+"&cbId=<?php echo $cabId; ?>";
            var obj = document.getElementById("cabEditStatus");

            $(obj).load(uri,function(response, status, xhr) {
                    if (status == "error") {
                            //alert(formatErrMsg(xhr.status));
                            alertDisp(formatErrMsg(xhr.status),'statusType-error');
                    }
            });
        }
}
//payment record tracking
function showPermitEdit(str)
{
	var uri = "../master/form/editRoadPermits.php?id="+str;
	var obj = document.getElementById("cabEditStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<table width="100%" border="0" >
  <tr>
    <td width="19%" align="left" valign="top">
        <table width="100%" border="0" cellspacing="0">
		<tr><td><img src="images/edit.png" width="22" height="22" align="absmiddle" /> EDIT CAB RECORD </td></tr>
            <tr>
                <td>
                   
                    <select name="attType" onchange="showOwneType(this.value)">
    <?php
	$attTyp = $ownTy;
	if($attTyp == 1){
		echo '<option value="1-'.$driId.'">Company Cab [ KK ]</option>';
	}
	elseif($attTyp == 2){
		echo ' <option value="2-'.$driId.'">Owner Cum Driver [ OC ]</option>';
	}
	elseif($attTyp == 3){
		echo '<option value="3-'.$driId.'">Owner [ OW ]</option>';
	}
	elseif($attTyp == 4){
		echo '<option value="4-'.$driId.'">Driver [ DR ]</option>';
	}
	else{
		echo '<option value="0-'.$driId.'">Select Attaching Type</option>';
	}
	echo '
      <option disable>-------------------</option>   
      <option value="1-'.$driId.'">Company Cab [ KK ]</option>
      <option value="2-'.$driId.'">Owner Cum Driver [ OC ]</option>
      <option value="3-'.$driId.'">Owner [ OW ]</option>
      <option value="4-'.$driId.'">Driver [ DR ]</option>
    </select>';
            ?>        
                </td>
            </tr>
      <tr>
        <td align="left">
		<ul class="greyarrow">
			<li><a href="#" onClick="showCabEdit(this.id)" id="<?php echo $cabId; ?>">Cab Edit</a></li>
			<li><a href="#" onClick="showDriverEdit(this.id)" id="<?php echo $driId; ?>">Driver Edit</a></li>
			 <?php
			  if($ownTy == 3 || $ownTy == 2 || $ownTy == 1){
				  //do nothing
			  }else{
			  ?>
			<li><a href="#" onClick="showOwnerEdit(this.id)" id="<?php echo $ownId; ?>">Owner Edit</a></li>
			 <?php
			  }
			  ?>
			<li><a href="#" onClick="showPaymentEdit(this.id)" id="<?php echo $cabId; ?>">Deposit Edit</a> </li>
			<li><a href="#" onClick="showImagesEdit(this.id)" id="<?php echo $cabId; ?>">Images Edit</a> </li>
			<li><a href="#" onClick="showPermitEdit(this.id)" id="<?php echo $cabId; ?>">Edit Road Permit</a></li>
		</ul>
		</td>
      </tr>
           
    </table></td>
    <td width="81%" align="left" valign="top">
    <div id="cabEditStatus" style="color:#121212; border:1px solid #666;"></div>
    </td>
  </tr>
</table>
<?php
}

?>
<script language="javascript">
	var uri = "../master/form/cab-profile-edit.php?id=<?php echo $id; ?>";
	var obj = document.getElementById("cabEditStatus");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>
