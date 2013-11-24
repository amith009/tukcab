<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: display list all free cab avilable.
T=table name -> booked master
##########
Create date = 30 NOV 2011
Time: 08:05
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
?>
<script type="text/javascript">
function showDriverStatus(str)
{
        var uri = "../master/form/view-current-driver.php?type="+str;
        var obj = document.getElementById("driver-status");

        $(obj).load(uri,function(response, status, xhr) {
                if (status == "error") {
                        //alert(formatErrMsg(xhr.status));
                        alertDisp(formatErrMsg(xhr.status),'statusType-error');
                }
        });
}
</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$sqlCabs = mysql_query("SELECT cab_id FROM `cabs` WHERE `status` = 1");
if(mysql_error()){
	echo 'No Record Found!!';
}else{
	$countCab = mysql_num_rows($sqlCabs);
	?>
<div class="formContainer" style="width:100%;">

<table width="100%" border="0" class="toolbox" id="product-table">
    <tr> <th class="table-header" colspan="20">Current Drivers</th></tr>
  <tr>
  <td width="804" align="left">Total Cab :<?php echo $countCab; ?> </td>
    <td width="111" align="right">
           <select name="customers" onchange="showDriverStatus(this.value)">
            <option value="ALL">BY CAB TYPE</option>
            <?php
			$sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` ORDER BY `cab_type_name` ASC");
			if(mysql_error()){
				echo '<option value="ALL">No Cab Found</option>';
			}else{
				while($rocb = mysql_fetch_assoc($sqlcab)){	
				echo '<option value="TY'.$rocb['cab_type_id'].'">'.$rocb['cab_type_name'].'</option>';
				}
			}
			?>
      </select>
    </td>
    <!--
    <th width="159" align="right">
    <select name="rodPer" onChange="showDriverStatus(this.value)">
      <option value="ALL">SELECT BY PERMIT</option>
      <option value="PR1">National</option>
      <option value="PR2">State</option>
      <option value="PR3">National with Triupati</option>
    </select>
    </th>-->
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top">
    <div id="driver-status"></div>
    </td>
  </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/view-current-driver.php?type=ALL";
	var obj = document.getElementById("driver-status");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
</script>
<?php
}
mysql_close();
?>
