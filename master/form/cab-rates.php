<link rel="stylesheet" href="http://192.168.1.202/kkcabs-new/core/css/screen.css" type="text/css" />
<script type="text/javascript" src="http://192.168.1.202/kkcabs-new/core/scripts/jquery164.js"></script>
<script type="text/javascript">
function callrate(str)
{
    
	var uri = "http://192.168.1.202/kkcabs-new/master/form/view-cab-rate.php?ratype="+ str;
	var obj = document.getElementById("cabratedetails");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}


</script>
<?php
$con = mysql_connect('localhost','root','THIPARAMBIL');
	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	$db = mysql_select_db('easybooking',$con);
?>
<body style="margin:0;padding:0;">
<table width="100%">
<tr><th class="title" align="left">CAB RATE</th>
    <th class="title" align="right">
        <select name="cabType" onchange="callrate(this.value)">
         <option value="0">Select cab type</option>
             <?php
            $sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `status` = '1' ORDER BY `cab_type_name` ASC");
            if(mysql_error()){
                    echo '<option value="ALL">No Cab Found</option>';
            }else{
                    while($rocb = mysql_fetch_assoc($sqlcab)){
                        $cbTypeId = $rocb['cab_type_id'];
                         if($cbTypeId == "24" || $cbTypeId == "19" || $cbTypeId == "18" || $cbTypeId == "1"){
                                    }else{
                    echo '<option value="'.$rocb['cab_type_id'].'">'.$rocb['cab_type_name'].'</option>';
                                    }
                    }
            }
            ?>
         </select>
    </th></tr>

<tr>
    <td align="center" colspan="2">
        <div id="cabratedetails">
            <br />
            <hr /><br />
            <img src="http://192.168.1.202/kkcabs-new/core/images/cancel.png" /><br />
            <b style="color:#ccc;">Please select Cab type to view rate details.</b>
            <br />
        </div>
    </td>
</tr>

<tr>
    <td class="title" colspan="2" align="right" style="font-size:10px;float:right;"><span id="spanYear">&copy;2012</span> <a href="http://www.kkcabs.com">KK Cabs</a>. All rights reserved.</div></td>
</tr>
</table>
</body>