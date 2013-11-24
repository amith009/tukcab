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
function showSearch(){
	//alert(1);
	var mobile = document.getElementById("mobile").value;
        var emailId = document.getElementById("email").value;
	var dateM = document.getElementById("dateM").value;
	var dateS = document.getElementById("dateS").value;
	var mod = "ONL";
	var typ = "ALL";
	//alert(mobile);
	var subA = $.ajax({
				url: '../master/form/OnlineOrderBackend.php',
				type: 'GET',
				data: {mob : mobile, datE : dateM, mode: mod, type : typ, emId:emailId, datS : dateS},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#onlinerecordorder").html(data);
	});
}


//cab Type
function showCabType(str)
{
	var uri = "../master/form/OnlineOrderBackend.php?mode=cabType&type="+str;
	var obj = document.getElementById("onlinerecordorder");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//for services
function showServices(str)
{
	var uri = "../master/form/OnlineOrderBackend.php?mode=srvTy&type="+str;
	var obj = document.getElementById("onlinerecordorder");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

function gotoPage(start,end){
	var uri = "../master/form/OnlineOrderBackend.php?mode=ALL&type=ALL&s="+start+"&e="+end;
	var obj = document.getElementById("onlinerecordorder");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

//
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<div class="formContainer" style="width:100%;">

<table width="100%">
    <tr><th colspan="10" align="center" class="table-header">Online Orders <a href="#" id="showtoolbox">Show</a></th></tr>
    <tr>
        <td>
            <div class="toolsbox">
                <table width="97%" border="0" cellspacing="0">
                <tr>
                       <td width="14%">
                        <select id="sertype" onchange="showServices(this.value)">
                        <option value="ALL">BY SERVICE</option>
                       <?php
                                $sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `status` = 1");
                                if(mysql_error()){
                                    echo '<option value="All">No Record Found</option>';
                                }else{
                                    while($rows = mysql_fetch_assoc($sqlSrv)){
                                        echo '<option value="'.$rows['service_id'].'">'.$rows['service_type'].'</option>';
                                    }
                                }
                                ?>
                        </select>
                        </td>
                         <td width="11%">
                       <select id="cabtyp" onchange="showCabType(this.value)">
                        <option value="ALL">All Cabs</option>
                        <?php
                            $sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` ORDER BY `cab_type_name` ASC");
                            if(mysql_error()){
                                    echo '<option value="ALL">No Cab Found</option>';
                            }else{
                                    while($rocb = mysql_fetch_assoc($sqlcab)){	
                                    echo '<option value="'.$rocb['cab_type_id'].'">'.$rocb['cab_type_name'].'</option>';
                                    }
                            }

                       ?>
                        </select>
                      </td>
                </tr><tr>
             <td width="72%" align="center">
               <form>
                     <table width="100%">
                    <tr align="center">
                        <td width="15%">
                      <input type="text" value="" placeholder="Email" id="email">
                      </td>
                        <td width="29%">
                      <input type="text" value="" placeholder="Mobile Number" maxlength="10" id="mobile">
                     </td>
                             <td width="19%">
                    <input type="text" value="<?php echo $date; ?>" id="dateS"> <!--pass start date -->
                     </td>
                      <td width="19%">
                    <input type="text" value="<?php echo $date; ?>" id="dateM"><!-- pass end date-->
                     </td>
                      <td width="12%"><input type="button" onclick="showSearch()" value="Search" class="NavButton" /></td>
                      </tr>
                    </table>
          </form>
     </td>
     </tr>
          
        </table>
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top">
            <div id="onlinerecordorder"></div>
          </td>
    </tr>
</table>

</div>
<script language="javascript">
	var uri = "../master/form/OnlineOrderBackend.php?mode=ALL&type=ALL";
	var obj = document.getElementById("onlinerecordorder");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	//date here
	$( "#dateM" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
		//date here
	$( "#dateS" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script>