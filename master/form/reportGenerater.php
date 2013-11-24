
<script type="text/javascript">
function showReportOptions(val){
	//hide all layers
	$("#repOptionLayer").children().each(function(){
		$(this).hide();
	});
	$("#layer_"+val).show();
}

function showReportAction(){
    //alert(1);
	var dtSt = document.getElementById("dateStart").value;
	var dtEn = document.getElementById("dateEnd").value;
	var ty = document.getElementById("mode").value;	
	var ac = document.getElementById("accId").value;
	var pt = document.getElementById("pt").value
	
	var subA = $.ajax({
				url: '../master/php/reportGenerateBackend.php',
				type: 'GET',
				data: {dateStr:dtSt, dateEnd:dtEn, type:ty, acs:ac, ct:pt},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#ReportAction").html(data);
	});
        subA.fail(function(data, textStatus, jqXHR){
            alert(textStatus);
        });
}
// by  cab code here

</script>
<?php
require_once "../../core/php/connection.php";
?>
<table width="100%" cellspacing="0">
   
    <tr>
        <td align="left" valign="top" width="20%">
            <form>
                <table style="border-right: 1px solid #121212;" width="100%" cellspacing="0">
                    <tr><th><b>Search Option.</b></th></tr>
                    <tr><td>
                            <select id="mode" onchange="showReportOptions(this.value)">
                                <option value="ALL">SELECT SUMMERY</option>
                                <option value="CP">Cab summary</option>
                                <option value="EL">Employee summary</option>
                                <option value="OS">Order summary</option>
                                <option value="CJ">Customer summary</option>
                            </select>
                        </td></tr>
                    <tr><td>Start Date.</td></tr>
                    <tr><td><input type="text" id="dateStart" value="<?php echo date("Y-m-d"); ?>" class="required" /></td></tr>
                    <tr><td>End Date.</td></tr>
                    <tr><td><input type="text" id="dateEnd" value="<?php echo date("Y-m-d"); ?>" class="required" /></td></tr>
					<tr><td>
					<div id="repOptionLayer">
					<div id="layer_CP" style="display:none;">
					<select id="accId">
					<?php
					$sqlCabD = mysql_query("SELECT cab_id,cab_code FROM `cabs` ORDER BY `cab_code` ASC");
					if(mysql_error()){
					 echo '<option value="0">No Record Found</option>'; 
					}else{
					echo '<option value="0">Select Cab Code</option>';
					  while($rowCab = mysql_fetch_assoc($sqlCabD)){
						echo '<option value="'.$rowCab['cab_id'].'">'.$rowCab['cab_code'].'</option>'; 
					 }
					}
					?>
					</select><br>
					<input type="radio" value="FC" id="pt" />Free Cab Record.
					<br>
				   <input type="radio" value="JO" id="pt" />Join Cab Record.
				   <br>
				   <input type="radio" value="LC" id="pt" />Leave Cab Record.
					</div>
					<div id="layer_EL" style="display:none;">
					<select id="accId">
				<?php
					$sqlEmp = mysql_query("SELECT emp_id,username FROM `employee` ORDER BY `username` ASC");
					if(mysql_error()){
					 echo '<option value="0">No Record Found</option>'; 
					}else{
					echo '<option value="0">Select Employee Code</option>';
					  while($rowEmp = mysql_fetch_assoc($sqlEmp)){
						echo '<option value="'.$rowEmp['emp_id'].'">'.$rowEmp['username'].'</option>'; 
					 }
					}
				?>
				</select><br>
				<input type="radio" value="LO" name="pt" />Login Record.
				
					</div>
					<div id="layer_OS" style="display:none;">
					 <select id="accId">
					  <option value="1">Waiting Order</option>
					  <option value="2">Dispatch Order</option>
					  <option value="3">Cancel Order</option>
					 </select>
					</div>
					<div id="layer_CJ" style="display:none;">
					
					</div>
					</div>
					</td></tr>
					<tr><td align="right"><input type="button" value="Search" onclick="showReportAction()" class="NavButton" /></td></tr>
                </table>
            </form>
        </td>
        <td width="80%" valign="top" >
            <div id="ReportAction" style="margin-left:-10px;"></div>
        </td>
    </tr>
     <tr><th colspan="2">&nbsp;</th> </tr>
</table>
<script language="javascript">
	
    var uri = "../master/php/reportGenerateBackend.php?type=ALL&dateStr=<?php echo date("Y-m-d"); ?>&dateEnd=<?php echo date("Y-m-d"); ?>";
	var obj = document.getElementById("ReportAction");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	//date here
	$( "#dateStart" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
		//date here
	$( "#dateEnd" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script>