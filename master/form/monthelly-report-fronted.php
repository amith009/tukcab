<?php

/***********************************************************
 * Author Amit Kuamr.
 * Date: 03-01-12
 * functions: this is fronted file for generated reporting for monthelly and yearelly reports
 */
//sassion_start();
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
?>
<script type="text/javascript">
        function showPaymentViewAc(){
	var m = document.getElementById("mm").value;
	var y = document.getElementById("yy").value;
	
	
	var subA = $.ajax({
				url: '../master/form/monthelly-booking-status.php',
				type: 'GET',
				data: {mm:m, yy:y},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#bookingreports").html(data);
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title">Order Status Report</div>
<?php
echo '<table width="100%" cellspacing="0"><tr><td class="toolbox">';
echo '<form> ';
echo '<table width="100%" cellspacing="0"><tr><td><select id="mm" class="require">';
     echo '<option value="">MONTH</option>';
	for($i=1;$i<=12;$i++){
	if($i < 10){
	echo '<option value="0'.$i.'">';
	}else{
	echo '<option value="'.$i.'">';
	}
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
	echo '</select>';
echo '</td>';
echo '<td><select id="yy" class="require">';
 echo '<option value="">Year</option>';
	for($k=2011;$k<=2022;$k++){
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
        echo '</select></td>';

 echo '<td><input type="button" onclick="showPaymentViewAc()" value="Submit" class="NavButton"/></td>';
echo '</tr></table></form></td></tr><tr><td><div id="bookingreports"><p align="center"><img src="images/ajax-loader.gif" /><br>Please Wait..</p></div></td></tr></table>';
?>
</div>
<script language="javascript">
	var uri = "../master/form/monthelly-booking-status.php?mm=<?php echo date('m'); ?>&yy=<?php echo date('Y'); ?>";
	var obj = document.getElementById("bookingreports");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
       
</script>