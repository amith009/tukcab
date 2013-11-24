<html>
    <head>
        
    
<link rel="stylesheet" href="http://192.168.1.202/kkcabs-new/core/css/screen.css" type="text/css" />
<script type="text/javascript" src="http://192.168.1.202/kkcabs-new/core/scripts/jquery164.js"></script>
<?php
session_start();
$con = mysql_connect('localhost','root','THIPARAMBIL');
	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	$db = mysql_select_db('easybooking',$con);
        
$empId = $_SESSION['EMP_ID'];
$sqlEmp = mysql_query("SELECT emp_id,emp_name FROM `employee` WHERE `emp_id` = '$empId'");
if(mysql_error()){
	$name = "___________";
}else{
	$rows = mysql_fetch_assoc($sqlEmp);
	$name = $rows['emp_name'];
}
?>
</head>
<body style="margin:0px">

<div class="formContainer">
<table width="100%" border="0" align="center"  id="product-table" style="font-size:16px; line-height:35px;margin:0px;">
  <tr>
    <th align="center" valign="middle" class="table-header-repeat">&nbsp;&nbsp;&nbsp;&nbsp; How to Attend a Call&nbsp;&nbsp;&nbsp;&nbsp; 
  </th>
  </tr>
  <tr>
    <td>
    <ol type="1" style="margin-left:20px;">
    <li><b>Opening Call :</b> Good Morining Welcome to KK Cabs, This is <?php echo $name; ?> how may i assist/help you.</li><br>
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
  <tr><td align="center"><font size="4"><strong>Call Center No:</strong> 08041519999<br /><b>Admin No:</b> 080 40733100<br />
  <strong>Web site:</strong> www.kkcabs.com</font></td></tr>
  <tr>
    <td align="right"><img src="http://192.168.1.202/kkcabs-new/core/images/logo.png" width="87" height="110" /></td>
  </tr>
</table>
</div>
    </body>
</html>
<?php
mysql_close();
?>