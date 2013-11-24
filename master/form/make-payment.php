<script type="text/javascript">
function showPayment(){
	var cabIdY = document.getElementById("cabId").value;
	var cabMonY = document.getElementById("cabMon").value;
	var cabYerY = document.getElementById("cabYer").value;
	
	var subA = $.ajax({
				url: '../master/form/backed-payment.php',
				type: 'POST',
				data: {cabId:cabIdY, cbaMonth:cabMonY, cabYear:cabYerY},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#payment").html(data);
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title">Cab Payment</div>
<table width="100%" align="center" id="product-table">
<tr><td width="30%" align="left" valign="top" style="border-right: 1px dashed #121212;"><form>
<table width="100%" border="0" cellspacing="0">
    <tr>
        <th colspan="2" class="table-header-repeat">Make Payment</th>
    </tr>
  <tr>
    <td>Cab Code :</td>
    <td>
    <select id="cabId">
    <?php
	require_once "../../core/php/connection.php";
	$sqlCab = mysql_query("SELECT cab_id,cab_code FROM `cabs`");
	$count = mysql_num_rows($sqlCab);
	if($count == 0){
		echo '<option></option>';
	}else{
		while($rows = mysql_fetch_assoc($sqlCab)){
			echo '<option value="'.$rows['cab_id'].'">'.$rows['cab_code'].'</option>';
		}
	}
	?>
    </select>
    </td>
  </tr>
  <tr> 
    <td>Month</td>
    <td><select id="cabMon">
    <?php
	for($i=1;$i<=12;$i++){
		if($i<10)
			echo '<option value="0'.$i.'">';
		else
			echo '<option value="'.$i.'">';
		$mm = $i;//month setup here
		  if($mm == "1"){
		echo 'January';
			}
			elseif($mm == "2"){
				echo 'February';
			}
			elseif($mm == "3"){
				echo 'March';
			}
			elseif($mm == "4"){
				echo 'April';
			}
			elseif($mm == "5"){
				echo 'May';
			}
			elseif($mm == "6"){
				echo 'June';
			}
			elseif($mm == "7"){
				echo 'July';
			}
			elseif($mm == "8"){
				echo 'August';
			}
			elseif($mm == "9"){
				echo 'September';
			}
			elseif($mm == "10"){
				echo 'October';
			}
			elseif($mm == "11"){
				echo 'November';
			}
			elseif($mm == "12"){
				echo 'December';
			}
			else{
			//do nithink
			}
		echo '</option>';
	}
	?>
   
    </select></th>
    </td>
  </tr>
  <tr>
    <td>Year</td>
    <td><select id="cabYer">
    <?php
	for($k=2011; $k<=2022; $k++){
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
	?>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="button" onclick="showPayment()" value="Submit" class="NavButton"/></td>
  </tr>
  </table>
  </form>
  </td>
 <td align="center" valign="top" width="70%">
  <div id="payment"><img src="images/cancel.png" width="24" height="24" /><br /><strong>Select Cab Code And Month</strong></div>
  </td></tr>
</table>
</div>