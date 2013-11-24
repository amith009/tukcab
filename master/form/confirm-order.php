<?php
require_once "../../core/php/connection.php";
 $orId = $_GET['id'];
 $sqlOnl = mysql_query("SELECT * FROM `online_record` WHERE `booking_id` = $orId");
 if(mysql_error()){
     echo 'No Record Found!!';
 }else{
     $rowsOr = mysql_fetch_assoc($sqlOnl);
?>
<script>
 function ConfirOrder(ordr)
	{
		var uri = "../master/php/confirm-order.php?id=" + ordr;
		var obj = document.getElementById("statusOrderConfirm");
		
		$(obj).load(uri,function(response, status, xhr) {
			if (status == "error") {
				//alert(formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
		});
	}
        
         function SaveOnlineCustomer(ordr)
	{
		var uri = "../master/php/SaveOnlineCustomer.php?id=" + ordr;
		var obj = document.getElementById("statusOrderConfirm");
		
		$(obj).load(uri,function(response, status, xhr) {
			if (status == "error") {
				//alert(formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
		});
	}
         
        //for send mail function
function openWinEmail(ordrP){
    //alert("HERE");
    var uri = "../master/php/email-cancel-order.php?id=" + ordrP;
		var obj = document.getElementById("statusOrderConfirm");
		
		$(obj).load(uri,function(response, status, xhr) {
			if (status == "error") {
				//alert(formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
		});
    
}
		
</script>
<table width="100%" id="product-table">
    <tr><th colspan="2" class="table-header-repeat">Online Order Confirmation!</th></tr>
    <tr><td colspan="2" valign="top" align="center">
            <div id="statusOrderConfirm">Order Status Waiting</div>
        </td></tr>
    <tr class="row-active">
        <td align="right"><b>Online Order No:</b></td>
        <td><?php echo $rowsOr['booking_code']; ?></td>
    </tr>
    
    <tr class="row-inactive" align="right">
        <td><b>Customer Name:</b></td>
        <td align="left"><?php echo $rowsOr['custName']; ?></td>
    </tr>
    <tr class="row-active">
        <td align="right"><b>Contact no:</b></td>
        <td><?php echo $rowsOr['cust_no']; ?></td>
    </tr>
    <tr class="row-inactive">
        <td align="right"><b>Email Address:</b></td>
        <td><?php echo $rowsOr['CustEmail']; ?></td>
    </tr>
     <tr class="row-active">
        <td align="right"><b>User IP :</b></td>
        <td><?php echo $rowsOr['sysIp']; ?></td>
    </tr>
    <tr class="row-inactive">
        <td align="right"><b>Date:</b></td>
        <td><?php echo $rowsOr['date']; ?></td>
    </tr>
    <tr class="row-active">
        <td align="right"><b>Time:</b></td>
        <td><?php echo $rowsOr['time']; ?></td>
    </tr>
    <tr class="row-inactive">
        <td align="right"><b>Pickup Point:</p></td>
        <td><?php echo $rowsOr['address'].'<br>'; 
        $piAi = $rowsOr['pickup'];
        $sqlPic = mysql_query("SELECT * FROM `area` WHERE `status` = 1 AND `area_id` = $piAi");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $roPi = mysql_fetch_assoc($sqlPic);
            echo $roPi['area_name'];
        }
        ?></td>
    </tr>
    <tr class="row-active">
        <td align="right"><b>Drop Point:</b></td>
        <td><?php $drAi = $rowsOr['dropPoint'];
        $sqlDare = mysql_query("SELECT * FROM `area` WHERE `status` = 1 AND `area_id` = $drAi");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $roDrp = mysql_fetch_assoc($sqlDare);
            echo $roDrp['area_name'];
        }
        ?></td>
    </tr>
    <tr class="row-inactive">
        <td align="right"><b>Cab Type:</b></td>
        <td><?php $cabTyp =  $rowsOr['cabType'];
        $sqlCt = mysql_query("SELECT * FROM `cab_types` WHERE `status` = 1 AND `cab_type_id` = $cabTyp");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $rowsSer = mysql_fetch_assoc($sqlCt);
            echo $rowsSer['cab_type_name'];
        }
        ?></td>
    </tr>
    <tr class="row-active">
        <td align="right"><b>No of Cab:</b></td>
        <td><?php echo $rowsOr['nocab']; ?></td>
    </tr>
    <tr class="row-inactive">
        <td align="right"><b>Service Type:</b></td>
        <td><?php $srty = $rowsOr['servicesType'];
        $sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `status` = 1 AND `service_id` = $srty");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $rowsSer = mysql_fetch_assoc($sqlSrv);
            echo $rowsSer['service_type'];
        }
        $custMob = $rowsOr['cust_no'];
        
        $msgCust = "Dear Customer cab you are Trying to book is not avilable. please try after some time For further bookings and enquiry, call 08041519999";
        ?></td>
    </tr>
    <tr class="row-active">
        <td colspan="2" align="center">
             <INPUT type="button" value="Send SMS to Customer" class="defaultButton" onClick="window.open('http://69.167.136.130/alerts/api/web2sms.php?workingkey=21248369no151xhms14&sender=KKCABS&to=<?php echo $custMob; ?>&message=<?php echo $msgCust; ?>','SEND SMS','width=400,height=200')" />           
            <a href="#" onClick="ConfirOrder(this.id)" id ="<?php echo $orId; ?>" class="defaultButton">Confirm Order</a>
            <a href="#" onClick="showMainAction(this.id)" id ="../master/form/DeleteOnlineOrder.php?id=<?php echo $orId; ?>" class="defaultButton">Delete Order</a>
            <a href="#" onClick="SaveOnlineCustomer(this.id)" id ="<?php echo $orId; ?>" class="defaultButton">Save Customer</a>
            
            <INPUT type="button" value="Send Email To Customer" class="defaultButton" onClick="window.open('http://192.168.1.202/kkcabs-new/master/php/email-cancel-order.php?id=<?php echo $orId ; ?>','SEND SMS','width=400,height=200')" /> 
        </td>
    </tr>
</table>
<?php
 }
?>
