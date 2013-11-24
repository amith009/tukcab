<?php
	session_start();
	$type = $_SESSION['EMP_TYPE'];
?>
<script type="text/javascript">
var keepPopup = false;
function keepAlive(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}

function setVisibility(obj, id, visibility) {
	if(keepPopup) return;
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
	if(oTop>$(document).height()+50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}
//--------------Call assign cabfile---
	<?php
		if($type==1){
	?>
	
	var t = self.setInterval('showGraph()',10000);
	function showGraph(str)
	{
		var uri = "../master/form/graph-view-order.php";
		var obj = document.getElementById("graph-view");
		
		$(obj).load(uri,function(response, status, xhr) {
			if (status == "error") {
				//alert(formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
		});
	}
	<?php
		}
	?>
	
	//online upcoming order
	var t = self.setInterval('showCall()',3000);
	function showCall(str)
	{
		var uri = "../master/form/online-upcomin-order.php";
		var obj = document.getElementById("upCominOrderOnline");
		
		$(obj).load(uri,function(response, status, xhr) {
			if (status == "error") {
				//alert(formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
			//bindHref(this);
		});
	}
</script>

<table>
    <tr>
        <td colspan="2" valign="top"><div id="upCominOrder"></div></td>
    </tr>
    <tr>
        <td colspan="2"><div id="upCominOrderOnline"></div></td>
    </tr>
    
    <tr>
    <?php
        if($type==1 || $type==6 || $type==5){
    ?>
        <td width="450px">
            <div id="graph-view"> </div>
        </td>
        <?php
        }
    ?>
        <td valign="top" align="left">
            <table width="100%" id="dashboard" >
                <tr><td align="left"><a href="#" id="../master/form/booking-form-fornted.php?no=n" onClick="showMainAction(this.id)" class="tip" title="Booking Form" accessKey="b"><img src="images/booking.png" width="24" height="24" class="myicons" align="absmiddle" /> New Booking</a></td></tr>
                <tr><td align="left"><a href="#" id="../master/form/add-free-cab.php" onClick="showMainAction(this.id)" class="tip" title="Add Free Cab" accessKey="c"><img src="images/addfrecab.png" width="24" height="24" class="myicons" align="absmiddle" /> Add Free Cab</a></td></tr>
                <tr><td align="left"><a href="#" id="../master/form/booked-order-list.php"  onClick="showMainAction(this.id)" accessKey="w"><img src="images/waitinglist.png" width="24" height="24" class="myicons" align="absmiddle"  /> Waiting Orders </a></td></tr>
                <tr><td align="left"><a href="#" id="../master/form/free-cab-list.php" onClick="showMainAction(this.id)" class="tip" title="Add Free Cab" accessKey="n"><img src="images/freecablist.png" width="24" height="24" class="myicons" align="absmiddle" /> Free Cab List</a></td></tr>
            </table>
        </td>
    </tr>
    
</table>
<script language="javascript">
	<?php
		if($type==1 || $type==6 || $type==5){
	?>
	var uri = "../master/form/graph-view-order.php";
	var obj = document.getElementById("graph-view");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
	<?php
		}
	?>
	//upcoming order
	var uri = "../master/form/upcomin-order.php";
	var obj = document.getElementById("upCominOrder");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	},5000);
	//online upcoming order
	var uri = "../master/form/online-upcomin-order.php";
	var obj = document.getElementById("upCominOrderOnline");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
	
</script>