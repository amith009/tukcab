<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";

$orDate = $_GET['dateps'];
$part = $_GET['partcul'];
$km = $_GET['kml'];
$rate = $_GET['amunt'];
$bil = $_GET['bilId'];

echo '<table width="100%">';
// track added record
$queryDip = "SELECT * FROM `billPrintRecord` WHERE `refsId` = '$bil'";
$resultDisp = mysql_query($queryDip);
if(mysql_error()){
    echo '<tr><td colspan="5" align="center" valign="top"><img src="images/alert.png"  /><b>Record Not Found!</b></td></tr>';
}else{
while($rowsDisp = mysql_fetch_assoc($resultDisp)){
echo '<tr>
            <td width="20%" align="center">'.$rowsDisp['orderDate'].'</td>
            <td width="40%" align="center">'.$rowsDisp['details'].'</td>
            <td width="15%" align="center">'.$rowsDisp['kmhrs'].'</td>
            <td width="15%" align="center">'.$rowsDisp['rate'].'</td>
            <td width="10%" align="center">
            <img src="images/001_45.png" width="22px" height="22px" />
            <img src="images/001_29.png" width="22px" height="22px" />
            </td>
        </tr>';
}
}
echo ' </table>';
?>
