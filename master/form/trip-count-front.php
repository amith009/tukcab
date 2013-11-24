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
//Start date here
function showDateAction(){
    //alert(1);
	var dtSt = document.getElementById("dateStart").value;
	var dtEn = document.getElementById("dateEnd").value;
	var ty = document.getElementById("cabT").value;	
	var subA = $.ajax({
				url: '../master/form/trip-count-backend.php',
				type: 'GET',
				data: {dateStr:dtSt, dateEnd:dtEn, type:ty},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#tripCountStatus").html(data);
	});
        subA.fail(function(data, textStatus, jqXHR){
            alert(textStatus);
        });
}
// by  cab code here
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<div class="formContainer" style="width:100%;">
<table width="100%" border="0" align="center" >
    <tr><th colspan="10" align="center" class="table-header">Cab Trip Details <a href="#" id="showtoolbox">Show</a></th></tr>
    <tr><td align="left" valign="top" >
	<div class="toolsbox">
		<table width="100%" border="0" align="center"  cellspacing="0" class="toolbox">
		  <tr>
			<td width="30%"></td>
			<td width="59%" align="right"> <form> FROM :
			   
				<input type="text" value="<?php echo $date; ?>" id="dateStart">
				TO:
				
				<input type="text" value="<?php echo $date; ?>" id="dateEnd">
					   
				  <select  class="sel" id="cabT">
				   <option value="ALL">View All Cab</option>
					<?php
					$sqlCab = mysql_query("SELECT cab_id,cab_code,status FROM `cabs` WHERE `status` = 1 ORDER BY `cab_code` ASC");
					if(mysql_error()){
						echo '<option>No Record Found</option>';
					}else{
						while($roCab = mysql_fetch_assoc($sqlCab)){
							echo '<option value="'.$roCab['cab_id'].'">'.$roCab['cab_code'].'</option>';
						}
					}
					?>
				</select>
				<input type="button" value="Search" onclick="showDateAction()" class="NavButton" />
				</form></td>
		  </tr>		  
		</table>
		</div>
	</td>
	</tr>
	<tr>
		<td align="center" valign="top" colspan="4"><div id="tripCountStatus"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div></td>
	</tr>
	</table>
</div>
<script language="javascript">
	
        var uri = "../master/form/trip-count-backend.php?mode=ALL&type=ALL&dateStr=<?php echo date("Y-m-d"); ?>&dateEnd=<?php echo date("Y-m-d"); ?>";
	var obj = document.getElementById("tripCountStatus");
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