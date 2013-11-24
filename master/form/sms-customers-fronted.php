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
   function showSearchCancel(){
       
       var das = document.getElementById("dateS").value;
       var dae = document.getElementById("dateE").value;
        var subW = $.ajax({
				url: '../master/form/sms-customers-backend.php',
				type: 'GET',
				data: {sdate : das, esdate : dae},
				dataType: "html",
				cache: false
			});
	subW.done(function(data, textStatus, jqXHR){
		$("#cancelCabList").html(data);
	});
       
   } 

</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<div class="formContainer" style="width:100%;">
<table width="100%" border="0" align="center" >
    <tr><th colspan="10" align="center" class="table-header">Send SMS tO Customer</th></tr> 
		<tr><td align="left" valign="top">
			 <form>
            <table width="100%">
			<tr>
				<td>Show customer between <input type="text" class="textsearch" id="dateS" value="<?php echo date('Y-m-d'); ?>" /></td>
				<td> to<input type="text" class="textsearch" id="dateE" value="<?php echo date('Y-m-d'); ?>" /></td>
				<td><input type="button" class="NavButton" onclick="showSearchCancel()" value="SHOW" /></td>
			</tr>
            </table>
            </form>
            
		</td></tr>
          <tr><td colspan="6" align="left" valign="top">
			<div id="cancelCabList"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div>
          </td></tr>
        </table>
</div>
<script language="javascript">
	var uri = "../master/form/sms-customers-backend.php?mode=ALL&sdate=<?php echo date('Y-m-d'); ?>&esdate=<?php echo date('Y-m-d'); ?>";
	var obj = document.getElementById("cancelCabList");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	//date here
	$( "#dateS" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
        $( "#dateE" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd"
        });
</script>