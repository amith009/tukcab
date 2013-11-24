<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";

?>
<script type="text/javascript">
        function addOrderBill(){
        
	var dp = document.getElementById("dateorp").value;
	var pa = document.getElementById("part").value;
	var kh = document.getElementById("khm").value;
	var am = document.getElementById("amnt").value;
        var bil = document.getElementById("bilid").value;
	var subA = $.ajax({
				url: '../master/php/add-bill-order.php',
				type: 'POST',
				data: {dateps:dp, partcul:pa, kml:kh, amunt:am, bilId:bil },
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#dispalyBill").html(data);
	});
}
</script>
<?php
$id = $_GET['bilid'];
$custName = $_GET['custName'];
$custNo = $_GET['custNo'];
$cabType = $_GET['cabType'];
$custAdd = $_GET['custAdd'];
$date = $_GET['dat'];
$adv = $_GET['advn'];
$status = 1;
$query = "INSERT INTO `billCustomer` (`refId`, `custName`, `custNo`, `advance`, `CabType`, `custAdd`, `issueDate`, `status`) VALUES ('$id', '$custName', '$custNo', '$adv', '$cabType', '$custAdd', '$date', '$status')";
$result = mysql_query($query);

if(mysql_error()){
    echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Try Again!!</b></div>';
}else{
    echo '<table width="100%" cellspacing="0" border="0">';
    echo '<tr><td align="center" valign="top">
            <table width="100%">';
     echo '<tr><td align="center" valign="top">
            <table width="100%">
                <tr><td align="left" valign="top"><b>Customer Name :</b></td><td align="left" valign="top">'.$custName.'</td><td align="left" valign="top"><b>Date:</b></td><td align="left" valign="top">'.$date.'</td></tr>
                <tr><td align="left" valign="top"><b>Address :</b></td><td align="left" valign="top">'.$custAdd.'</td><td align="left" valign="top"><b>Cab Type:</b></td><td align="left" valign="top">'.$cabType.'</td></tr>
            </table>
            </td></tr>';
      
     echo '<tr><td align="center" valign="top">
	 <table width="100%" id="product-table"><tr>
         <th width="20%" class="table-header-repeat">Booking Date</th>
         <th width="40%" class="table-header-repeat">Particulars</th>
         <th width="15%"class="table-header-repeat">Km./Hrs.</th>
         <th width="15%"class="table-header-repeat">Rate</th>
         <th width="10%"class="table-header-repeat">Action</th>
         </tr></table></td></tr>';
   
     echo '<tr><td align="center" valign="top"><div id="dispalyBill"></div></td></tr>';
     echo '<tr><td align="center" valign="top">
                <form id="frmorderbill">
                <input type="hidden" value="'.$id.'" id="bilid" />
                    <table width="100%">
                    <tr>
                        <td width="20%" align="center" ><input type="text" id="dateorp" /></td>
                        <td width="40%" align="center" ><input type="text" id="part" /></td>
                        <td width="15%" align="center" ><input type="text" id="khm" /></td>
                        <td width="15%" align="center"><input type="text" id="amnt" /></td>
                        <td width="10%" align="center"><input type="button" class="NavButton" Value=" Add " onclick="addOrderBill()" /></td>
                    </tr>
                    </table></form>';
     echo '</td></tr>';
    
    echo '<tr><td align="right"><br />';
     ?>
     <a href="#" onClick="window.open('http://192.168.1.202/kkcabs-new/master/form/print-bill-customer.php?bid=<?php echo $id; ?>','Print Bill for Customer','width=500, height=700')" class="NavButton">Print Bill</a>
<?php    
echo '</td></tr>';
     echo '';
     echo '</table>';
}
?>
<script language="javascript">
	var uri = "../master/php/add-bill-order.php";
	var obj = document.getElementById("dispalyBill");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
$("#frmorderbill").validate();

		$( "#dateorp" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});	

</script>

