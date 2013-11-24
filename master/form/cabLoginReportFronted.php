<?php

/***********************************************************
 * Author Amit Kuamr.
 * Date: 03-01-12
 * functions: this is fronted file for generated reporting for monthelly and yearelly reports
 */
//sassion_start();
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
?>
<script type="text/javascript">
        function showPaymentViewAc(){
	var cabIdY = document.getElementById("cabCo").value;
	var sdat = document.getElementById("sdate").value;
	var edat = document.getElementById("edate").value;
	
	var subA = $.ajax({
				url: '../master/form/cabLoginReportBackend.php',
				type: 'GET',
				data: {cabId:cabIdY, satDat:sdat, enDat:edat},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#cabloginreport").html(data);
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title">Cab login record</div>
<?php
echo '<table width="100%" cellspacing="0"><tr><td class="toolbox">';
echo '<form> ';
echo '<table width="100%" cellspacing="0"><tr><td>';
echo '<select id="cabCo" class="require">';
$sqlCab = mysql_query("SELECT `cab_id`,`cab_code` FROM `cabs` WHERE `status` = 1 ORDER BY `cab_code`");
if(mysql_error()){
 echo '<option>No Record Found!!</option>';
}else{
     echo '<option value="0">CAB CODE</option>';
    while($rowsCab = mysql_fetch_assoc($sqlCab)){
        echo '<option value="'.$rowsCab['cab_id'].'">'.$rowsCab['cab_code'].'</option>';
    }
}
echo '</select></td>';
echo '<td><input type="text" value="'.$date.'" id="sdate" /></td>';
echo '<td><input type="text" value="'.$date.'" id="edate" /></td>';

        echo '<td><input type="button" onclick="showPaymentViewAc()" value="Submit" class="NavButton"/></td>';
echo '</tr></table></form></td></tr><tr><td><div id="cabloginreport"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div></td></tr></table>';
?>
</div>
<script language="javascript">
	var uri = "../master/form/cabLoginReportBackend.php?cabId=0&satDat=<?php echo $date; ?>&enDat=<?php echo $date; ?>";
	var obj = document.getElementById("cabloginreport");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
        $( "#sdate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
    $( "#edate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
    });
</script>