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
   function showSearchPriority(){
      
       var peo = document.getElementById("peority").value;
       var das = document.getElementById("dateS").value;
       var dae = document.getElementById("dateE").value;
      
       var subW = $.ajax({
				url: '../master/form/view-customer.php',
				type: 'GET',
				data: {peority : peo, startdate : das, enddate : dae},
				dataType: "html",
				cache: false
			});
	subW.done(function(data, textStatus, jqXHR){
		$("#pager").html(data);
	});
       
   } 
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}

var pageSize = 10;
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
</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<div class="formContainer" style="width:99%;">
<div class="title">Customer Record</div>
<!--<table width="100%" border="0" align="center" >
    <tr><td align="left" valign="top" class="toolsbox">
            <form>
            <table width="100%">
                <tr>
                    <td>
                        <a href="#" id="../master/form/customer-record-fronted.php" onClick="showMainAction(this.id)" class="NavButton">ALL</a>
                    </td>
                    
                    <td>
                        <select id="botyp" class="textsearch">
                             <option value="0">Priority.</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Star</option>
                           <option value="3">3 Star</option>
                            <option value="4">4 Star</option>
                            <option value="5">5 Star</option>
                        </select>
                    </td>
                      
                    <td><input type="text" class="textsearch" id="dateS" value="<?php echo date('Y-m-d'); ?>" /></td>
                    <td><input type="text" class="textsearch" id="dateE" value="<?php echo date('Y-m-d'); ?>" /></td>
                    <td><input type="button" class="NavButton" onclick="showSearchPriority()" value="SHOW" /></td>
                </tr>
            </table>
            </form>
        </td> </tr>
          <tr><td colspan="6" align="left" valign="top">
                
                    <div id="pager"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div>
             <script type="text/javascript">
                            pssPager("pager").paginate('../master/form/view-customer.php','Y',0,pageSize);
                    </script>
			
          </td></tr>
        </table>-->
<div id="pager"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div>
             <script type="text/javascript">
                            pssPager("pager").paginate('../master/form/view-customer.php','Y',0,pageSize);
                    </script>
</div>
<script language="javascript">
	var uri = "../master/form/view-customer.php?startdate=<?php echo $date; ?>&enddate=<?php echo $date; ?>&peority=0";
	var obj = document.getElementById("pager");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	//date here
	$( "#dateE" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
		//date here
	$( "#dateS" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
</script>