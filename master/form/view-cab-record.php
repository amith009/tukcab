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
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
	?>
<script type="text/javascript">
function showCabRecord(){
	
	var sat = document.getElementById("status").value;
        var cabTy = document.getElementById("cabType").value;
	var dateS = document.getElementById("dateS").value;
	var dateE = document.getElementById("dateE").value;
        
	//alert(mobile);
	var subA = $.ajax({
				url: '../master/form/cab-record-backEnd.php',
				type: 'POST',
				data: {datS : dateS, datE : dateE, pass:sat, cabType:cabTy},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#viewcabrecord").html(data);
	});
}
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<div class="formContainer" style="width:100%;">
    <table width="100%">
        <tr><th class="table-header" colspan="20">All Cab Records. <a href="#" id="showtoolbox">show</a></th></tr>
        
        <tr>
        <td  align="left" colspan="20">
            <div class="toolsbox">
                <form action="">
               <table>
                   <tr>
                    <td align="right" colspan="20">
                       <a href="#" id="../master/form/add-new-cab.php" onClick="showMainAction(this.id)" ><img src="images/001_01.png"/>&nbsp;Add New Cab</a> 
                    </td>
                    </tr>
                   <tr>
                       <td>
                           <a href="#" id="../master/form/view-cab-record.php" onClick="showMainAction(this.id)" class="NavButton">Clear</a>
                       </td>
                       <td>
                           <select id="status">
                               <option value="<?php
                               $check = $_GET['check'];
                                        if($check == "ACT"){
                                          echo "1";  
                                        }elseif($check == "TRA"){
                                            echo "0";
                                        }else{
                                            echo "1";
                                        }
                               ?>">Cab Status</option>
                               <option value="1">Active Cab</option>
                               <option value="0">Block Cab</option>
                           </select>
                       </td>
                       <td>
                           <input type="text" id="dateS" value="<?php echo $date; ?>" />
                       </td>
                       <td>
                           <input type="text" id="dateE" value="<?php echo $date; ?>" />
                       </td>
                       <td>
                           <select id="cabType">
                             <option value="0">All Cabs</option>
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
                       <td width="12%"><input type="button" onclick="showCabRecord()" value="Show" class="NavButton" /> <?php
                            //echo 'HER'.$_GET['check'];
                            ?></td>
                   </tr>
               </table>
          </form>
            </div>
            </td>
          </tr>
          
          <tr><td align="center" valign="top"><div id="viewcabrecord"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div>
          </td></tr>
        </table>
</div>
<script language="javascript">
	var uri = "../master/form/cab-record-backEnd.php?check=<?php echo $check; ?>";
	var obj = document.getElementById("viewcabrecord");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
        //date here
	$( "#dateS" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
		//date here
	$( "#dateE" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script>