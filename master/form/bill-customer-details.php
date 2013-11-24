<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";

?>
<script type="text/javascript">
        function showCustomerAdd(){
	var cunam = document.getElementById("cusName").value;
	var cuno = document.getElementById("cusNo").value;
	var cbty = document.getElementById("cbTy").value;
	var addre = document.getElementById("addr").value;
        var dp = document.getElementById("datepa").value;
        var bil = document.getElementById("bilid").value;
        var ad = document.getElementById("adv").value;
	var subA = $.ajax({
				url: '../master/form/add-bill-record.php',
				type: 'GET',
				data: {custName:cunam, custNo:cuno, cabType:cbty, custAdd:addre, dat:dp, bilid:bil, advn:ad },
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#billaction").html(data);
	});
}
</script>
<form id="frmMakeBill">
    <input type="hidden" value="<?php echo rand(999,999999); ?>" id="bilid" />
	<table width="100%">
		<tr>
			<th align="left">Enter Customer Details .</th>
		</tr>
		<tr>
			<td align="left" valign="top">
				
				<table width="100%">
					<tr class="row-active">
						<td>Customer Name :</td>
						<td><input type="text" name="custName" id="cusName" class="required" /></td>
						<td>Date :</td>
						<td><input type="text" id="datepa" value="<?php echo date("Y-m-d"); ?>" class="required" /></td>
					</tr>
					<tr class="row-inactive">
						<td>Contact No.</td>
						<td><input type="text" name="custNo" id="cusNo" class="required number" /></td>
						<td>Cab Type :</td>
						<td>
						<select id="cbTy">
						<?php
						 $sqlCabTy = mysql_query("SELECT * FROM `cab_types` WHERE `status` = 1");
						  $countCabTy = mysql_num_rows($sqlCabTy);
						  if($countCabTy == 0){
							  echo '<option value=" ">No Record Found</option>';
						  }else{
							  while($rwsTy = mysql_fetch_assoc($sqlCabTy)){
								  echo '<option value="'.$rwsTy['cab_type_name'].'">'.$rwsTy['cab_type_name'].'</option>';
							  }
						  }
						
						?>
						</select>
						</td>
					</tr>
					<tr class="row-active">
						<td>Address:</td>
						<td>
							<textarea name="add" rows="3" cols="50" id="addr" class="required"></textarea>
						</td>
						<td>Advance pay :</td>
						<td><input type="text" name="adv" id="adv" class="required number" /></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><th align="right">
				<input type="button" class="NavButton" Value=" Next >> " onclick="showCustomerAdd()" />
			</th></tr>
	</table>
</form>
<script language="javascript">
$("#frmMakeBill").validate();

		$( "#datepa" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
</script>