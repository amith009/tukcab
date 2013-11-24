<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: display list all expences list.
T=table name -> expence
##########
Create date = 3 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
$date = date("Y-m-d");
require_once "../../core/php/connection.php";
$id = $_GET['id'];
?>
<script type="text/javascript">
function addExpence(str)
{
    
	var uri = "../master/form/add-new-cab-rate.php?ratype="+ str;
	var obj = document.getElementById("cabrate");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}

function uprate(){
    var ct = document.getElementById("cbType").value;
    var rt = document.getElementById("rtype").value;
    
    var CabUp = $.ajax({
                    url : '../master/form/update-cab-rate.php',
                    type: 'POST',
                    data : {cabType : ct, rateType : rt},
                    dataType: "html",
                    cache: false
    });
    CabUp.done(function(data, textStatus, jqXHR){
		$("#cabrate").html(data);
              
	});
}
</script>
<table width="100%" cellspacing="0" id="product-table">
    <tr><th class="table-header-repeat" colspan="4">Company Cab Rate Chart.</th></tr>
    <tr>
        <td>
            Update rate for :
            <form>
                <select id="cbType">
                     <option value="0">All Cabs</option>
                         <?php
                        $sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` ORDER BY `cab_type_name` ASC");
                        if(mysql_error()){
                                echo '<option value="ALL">No Cab Found</option>';
                        }else{
                                while($rocb = mysql_fetch_assoc($sqlcab)){
                                    $cbTypeId = $rocb['cab_type_id'];
                                    if($cbTypeId == "24" || $cbTypeId == "19" || $cbTypeId == "18" || $cbTypeId == "1"){

                                    }else{
                                echo '<option value="'.$rocb['cab_type_id'].'">'.$rocb['cab_type_name'].'</option>';
                                    }
                                }
                        }
                        ?>
                 </select>
                <select id="rtype">
                     <option value="0">Select</option>
                     <?php
                        $sqlAdf = mysql_query("SELECT * FROM `cab_rate_title` WHERE `status` = '1'");
                        if(mysql_error()){
                           echo '<option value="0">Record not found</option>'; 
                        }else{
                            while($rowsTl = mysql_fetch_assoc($sqlAdf)){
                              echo '<option value="'.$rowsTl['crt_id'].'">'.$rowsTl['crt_title'].'</option>';  
                            }
                        }
                     ?>
                 </select>
                <input type="button" value="GO" onclick="uprate()" class="NavButton" /> 
            </form>
        </td>
    <td  align="right">
         Add new rate for :
         <select  onchange="addExpence(this.value)">
             <option value="0">Select</option>
             <?php
                $sqlAdf = mysql_query("SELECT * FROM `cab_rate_title` WHERE `status` = '1'");
                if(mysql_error()){
                   echo '<option value="0">Record not found</option>'; 
                }else{
                    while($rowsTl = mysql_fetch_assoc($sqlAdf)){
                      echo '<option value="'.$rowsTl['crt_id'].'">'.$rowsTl['crt_title'].'</option>';  
                    }
                }
             ?>
         </select>
    </td>

    </tr>

    <tr>
        <td align="left" valign="top" colspan="5">
            <div id="cabrate">Select your option.</div>
        </td>
    </tr>
</table>
