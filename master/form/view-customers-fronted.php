<?php
/*********************************************************************************************

File Name: view-area.php
Work and function: in this file user driver record and payment status
T=table name -> area
##########
Create date = 29 NOV 2011
Time: 01:42
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
?>
<script type="text/javascript">
	var pageSize = 40;
	var curPage = 1;
	var totPage = 0;
	function gotoPage(num){
		if(num==0) return;
		curPage = parseInt(num);
		pssPager("pager").paginate('../master/form/view-customer.php','Y',(num-1)*pageSize,pageSize);
	}
	function gotoPrevPage(){
		gotoPage(curPage-1);
	}
	function gotoNextPage(){
		totPage = $("#pageSelect").children().length;
		if(curPage>=totPage) return;
		gotoPage(curPage+1);
	}
	function setVisibility(id, visibility) {
	document.getElementById(id).style.display = visibility;
	}
	function showSearchCancel(){
       var das = document.getElementById("dateS").value;
       var dae = document.getElementById("dateE").value;
       var bot = document.getElementById("botyp").value;
       var subW = $.ajax({
				url: '../master/form/view-customer.php',
				type: 'GET',
				data: {boktype : bot, startdate : das, enddate : dae, pageSize: 40, start:0},
				dataType: "html",
				cache: false
			});
	subW.done(function(data, textStatus, jqXHR){
		$("#pager").html(data);
	});
       
   } 
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<div class="formContainer" style="width:99%;">
<table width="100%" border="0" align="center" >
 <tr>
 <th colspan="10" align="center" class="table-header">customer record <a href="#" id="showtoolbox">Show</a></th></tr>
    <tr><td align="left" valign="top" >
	<div class="toolsbox">
		<form>
            <table width="100%">
                <tr>
                    <td>
                        <a href="#" id="../master/form/view-customer-fronted.php" onClick="showMainAction(this.id)" class="NavButton">ALL</a>
						<input type="hidden" id="botyp" value="pass" />
					</td>
					<td><input type="text" class="textsearch" id="dateS" value="<?php echo date('Y-m-d'); ?>" /></td>
					<td><input type="text" class="textsearch" id="dateE" value="<?php echo date('Y-m-d'); ?>" /></td>
					<td><input type="button" class="NavButton" onclick="showSearchCancel()" value="SHOW" /></td>
                </tr>
            </table>
            </form>
            </div>
	</div>
	</td>
	</tr>
	<tr><td align="center" valign="top"><div id="pager"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div></td></tr>
</table>
</div>
<script type="text/javascript">
	pssPager("pager").paginate('../master/form/view-customer.php?botyp=null&dateS=null&dateE=null','Y',0,pageSize);
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