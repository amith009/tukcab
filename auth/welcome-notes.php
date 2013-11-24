<html>
<META HTTP-EQUIV="REFRESH" CONTENT="1000">
<title></title>
<head>
<link href="css/login_stayle.css" rel="stylesheet" type="text/css">
<script language="javascript">
	window.setTimeout(function(){
		window.location = 'login_confirm.php?cpas=0';
	},10000);
</script>
</head>
<body class="conten-read">
<?php
/*date_default_timezone_set('Asia/Kolkata');
$givTim = $_GET['time'];
$cuTime = date("i");
if($givTim == $cuTime){*/
	echo '

<table width="600" border="0" align="center" class="content-read">
  <tr>
    <td align="center" valign="middle"><h2> &nbsp;&nbsp;&nbsp;&nbsp; How to Attend a Call&nbsp;&nbsp;&nbsp;&nbsp; </h2>
    <hr class="normal" />
    <hr class="fancy" />
  </td>
  </tr>
  <tr>
    <td>
    <ol type="1">
    <li><b>Opening Call :</b> Good Morining Welcome to KK Cabs, This is ________ how may i assist/help you.</li><br>
    <i>Or if is a regular customer.</i>
    <br>
    <li><b>Opening Call:</b> Good morning welcome to KK Cabs Ms/Mr.________ how may i assist/help you.</li>
    <li><b>Hold Procedure:</b>May i place your call on hold for a min/sec.</li>
    <li><b>Hold release procedure:</b>Thank you for being on hold.</li>
    <li><b>Transfer Procedure:</b>Please stay on line i will transfer your call to the concern dept.</li>
    <li><b>Closing Call:</b>Thank You for calling KK Cabs Have a great day.</li>
    </ol>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td align="right"><img src="../core/images/logo.png" width="87" height="110"></td>
  </tr>
   <tr><td>&nbsp;</td></tr>
</table>
';
/*    
}else{
	//echo 'here';
	header('location: login_confirm.php');
}*/
?>

</body>
