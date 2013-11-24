<?php
session_start();
require_once "connection.php";
echo $eid = $_SESSION['EMP_ID'].'j';
$client = $_SERVER['REMOTE_ADDR'];
$time = date("H:i:s");
$date = date("Y-m-d");
//$sql = mysql_query("UPDATE `employee_login` SET `logout_time` = '$time', `status` = 0 WHERE `date` = '$date' AND `emp_id` = '$eid'");
$comm = "Session Expired!";
$sql = mysql_query("INSERT INTO `employee_logoff` (`emp_id`, `comment`, `date`) VALUES ('$eid', '$comm', NOW())");
//unregister client
//$sqlUnReg = mysql_query("DELETE FROM registered_clients WHERE remote_addr = '$client'");
if(mysql_error()){
	echo mysql_error();
        echo $_SESSION['EMP_ID'];
}else{
	//unset($_SESSION['EMP_ID']);
	//unset($_SESSION['EMP_NAME']);
	//unset($_SESSION['EMP_TYPE']);
	//unset($_SESSION['sessionTime']);
	//session_destroy();

?>
<html>
	<head>
		<title>Session Expired</title>
		<script language="javascript">
			/*window.setTimeout(function(){
				
			},1000);*/
                        function redirect(){
                            //window.location = 'index.php';
                            alert(1);
                            alert(window.location);
                        }
		</script>
		<link href="../../auth/css/login_stayle.css" rel="stylesheet" type="text/css"/>
	</head>
	<body><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div class="conte2">
                <table width="416" border="0" align="center" class="table_confirs" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">&nbsp;</td></tr>
                  <tr>
                    <td width="137" align="center" valign="middle">
                    <img src="../../auth/image/session.png" />
                    </td>
                    <td width="104" align="center" valign="top">
                        <span class="ipblock"><h1 style="color:#c43a3a; font-weight:bold;">Sorry!!</h1></span>
                        Your session is Expired!!<br />
                        Please login your account.

                    </td>

                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2" align="right"><a href="http://192.168.1.202/kkcabs-new/" style="color:#ffffff;">Click here<a/> for login again!</td></tr>
                </table>


</div>
            <script type="text/javascript">
                $("#sessionExp").css("width",$(document).width()).css("height",$(document).height());
            </script>
        </body>
</html>
<?php
}
?>