<script type="text/javascript">
function showDriverRecordForChange(str)
{
	var uri = "../master/form/vew-driver-profile.php?id="+str;
	var obj = document.getElementById("DriverRecord");
	
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
echo $str = $_GET['id'];

$sqlGh = mysql_query("SELECT `cab_owner` FROM `cabs` where `cab_id` = '$str'");
if(!mysql_error()){
$rowsOid = mysql_fetch_assoc($sqlGh);
$oid = $rowsOid['cab_owner'];

?>
<form name="frmCreateFreeCab" method="post" action="../master/php/cab-driver-change.php">
<table width="100%">
    <tr>
        <th align="center" class="table-header-repeat" width="15%">CHOSE DRIVER</th>
        <th align="center" class="table-header-repeat" width="85%">DRIVER DETAILS</th>
    </tr>
    <tr>
        <td valign="top" align="center"><select onchange="showDriverRecordForChange(this.value)" name="driverId">
                <option value="" class="required">Select Driver</option>
            <?php
                $sqlDriver = mysql_query("SELECT * FROM `drivers` WHERE `driver_owner` = '$oid '");
                if(!mysql_error()){
                   
                    while($rows = mysql_fetch_assoc($sqlDriver)){
                        
                        echo'<option value="'.$rows['driver_id'].'">'.$rows['driver_name'].'</option>';
                    }
                }
            ?>
            </select>
            <br />
            <br />
                <input type="hidden" value="<?php echo $str; ?>" name="cabid" />
                <input type="submit" value="Assign To Cab" class="defaultButton" />
           </td>
        <td align="center" valign="top">
            <div id="DriverRecord"><b>Select Driver to view record!</b></div>
        </td>
    </tr>
</table>
</form>
<?php
}
?>