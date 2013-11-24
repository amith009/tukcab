<?php
session_start();
require_once "../../core/php/connection.php";
$them = $_POST['them'];
$eid = $_SESSION['EMP_ID'];
$sql = mysql_query("UPDATE `employee` SET `thaem_id` = '$them' WHERE `emp_id` = $eid");
if(mysql_error()){
	echo 'Try Again!';
}else{
	echo 'Theme has been changed.';
	?>
    <script language="javascript">
	location.reload(true);
    </script>
    
    <?php
}
?>