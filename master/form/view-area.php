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
	var pageSize = 10;
	var curPage = 1;
	var totPage = 0;
	function gotoPage(num){
		if(num==0) return;
		curPage = parseInt(num);
		pssPager("pager").paginate('../master/form/fetch-area-data.php','Y',(num-1)*pageSize,pageSize);
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
<div class="formContainer" style="width:99%;">
<div class="title">View Area
<div class="action_tool">
    <table>
        <tr>
            
            <td>
                <a href="#" id="../master/form/create-area.php" onClick="showMainAction(this.id)"><img src="images/001_01.png"/>&nbsp;Create Area</a>
            </td>
            
        </tr>
    </table>
    
</div>
    </div>
<div id="pager"></div>
</div>
<script type="text/javascript">
	pssPager("pager").paginate('../master/form/fetch-area-data.php','Y',0,pageSize);
</script>