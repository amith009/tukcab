<!DOCTYPE html>
<html>
<head>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function()
		{
		  $('#demo1').simplyCountable();
		  
		});
	</script>
</head>
<?php
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$sdat = $_GET['sdate'];
$edat = $_GET['esdate'];
$sqlCust = mysql_Query("SELECT mobile FROM `cust_master` where DATE_FORMAT(`date_join`, '%Y-%m-%d') BETWEEN '$sdat' AND '$edat' GROUP BY `mobile`");
$count = mysql_num_rows($sqlCust);
?>
<body>
	<div class="formContainer">
	<form method="post" id="frmSrv" name="frmSrvices" action="../master/php/send-sms-customer.php">
	<table border="0" align="center" id="product-table">
		<tr>
		<td>We found <?php echo $count;?> customer record between <?php echo $sdat;?> to <?php echo $edat;?></td>
		</tr>
		<tr>
			<td><textarea id="demo1" cols="60" rows="3" name="msg"></textarea><br />
			<em>You have <span id="counter"></span> characters left.</em>
		</td></tr>
		<tr>
			<td><input type="submit" value="Send" class="NavButton"/></td>
		</tr>
		<?php
		
		
		if(mysql_error()){
			echo mysql_error(); 
		}else{
			while($Rows = mysql_fetch_assoc($sqlCust)){
			$num = strlen($Rows['mobile']);
			if($num == 10){
				echo '<tr><td><input type="checkbox" value="'.$Rows['mobile'].'" name="i[]" checked/>'.$Rows['mobile'].'</td></tr>';
				}
			}
		}
		?>
		
	
	</table>
	</form>
</body>
</html>