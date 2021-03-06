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
   function showSearchDis(){
       var or = document.getElementById("order").value;
       var ar = document.getElementById("area").value;
       var sr = document.getElementById("srv").value;
       var ct = document.getElementById("cabType").value;
       var bt = document.getElementById("btype").value;
       var das = document.getElementById("dateS").value;
       var dae = document.getElementById("dateE").value;
       var bot = document.getElementById("botyp").value;
       var subW = $.ajax({
				url: '../master/form/dispatch-call-back.php',
				type: 'GET',
				data: {order : or, area : ar, services: sr, cabtype : ct, boktype : bt, startdate : das, enddate : dae, sermode:bot},
				dataType: "html",
				cache: false
			});
	subW.done(function(data, textStatus, jqXHR){
		$("#dispatchCabList").html(data);
	});
       
   } 
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}

$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<div class="formContainer" style="width:99%;">

<table width="100%" border="0" align="center" >
    <tr><th colspan="10" align="center" class="table-header">Trip Details <a href="#" id="showtoolbox">Show</a></th></tr>
    <tr><td align="left" valign="top">
            <div class="toolsbox">
            <form>
            <table width="100%">
                <tr>
                    <td>
                        <a href="#" id="../master/form/dispatch-order-list.php" onClick="showMainAction(this.id)" class="NavButton">ALL</a>
                    </td>
                    <td><input type="text" class="textsearch" id="order" placeholder="Type Here" /></td>
                    <td>
                        <select id="botyp" class="textsearch">
                             <option value="0">Mode.</option>
                            <option value="OR">Order No.</option>
                            <option value="MO">Mobile No.</option>
                            <option value="PH">Phone No.</option>
                            <option value="EM">Email.</option>
                        </select>
                    </td>
                       <td><select  class="textsearch" id="area" >
                               <option value="">Area</option>
                                            <?php
                                $sqlAre = mysql_query("SELECT * FROM `area` WHERE `status` = 1 ORDER BY `area_name`");
                                if(mysql_error()){
                                    echo '<option>No Record Found</option>';
                                }else{
                                    while($roAre = mysql_fetch_assoc($sqlAre)){
                                        echo '<option value="'.$roAre['area_id'].'">'.$roAre['area_name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                       </td>
                       <td><select id="srv" class="textsearch">
                            <option value="">Service</option>
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
                             </select></td>
                </tr>
                <tr>
                             <td>
                                 <select id="cabType"  class="textsearch">
                                <option value="">Cab Code</option>
                                <?php
                                            $sqlcab = mysql_query("SELECT cab_id,cab_code FROM `cabs` WHERE `status` = 1 ORDER BY `cab_code` ASC");
                                            if(mysql_error()){
                                                    echo '<option value="ALL">No Cab Found</option>';
                                            }else{
                                                    while($rocb = mysql_fetch_assoc($sqlcab)){	
                                                    echo '<option value="'.$rocb['cab_id'].'">'.$rocb['cab_code'].'</option>';
                                                    }
                                            }

                                            ?>
                                </select>
                             </td>
                             <td>
                                 <select class="textsearch" id="btype">
                                     <option value="0">Application</option>
                                     <option value="1">Online</option>
                                 </select>
                             </td>
                             <td><input type="text" class="textsearch" id="dateS" value="<?php echo date('Y-m-d'); ?>" /></td>
                            <td><input type="text" class="textsearch" id="dateE" value="<?php echo date('Y-m-d'); ?>" /></td>
                            <td><input type="button" class="NavButton" onclick="showSearchDis()" value="SHOW" /></td>
                </tr>
            </table>
            </form>
            </div>
        </td> </tr>
          <tr><td colspan="6" align="left" valign="top">
			<div id="dispatchCabList"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div>
          </td></tr>
        </table>
</div>
<script language="javascript">
	var uri = "../master/form/dispatch-call-back.php?startdate=<?php echo $date; ?>&enddate=<?php echo $date; ?>&s=0&e=20";
	var obj = document.getElementById("dispatchCabList");
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