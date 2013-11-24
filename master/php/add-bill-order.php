
<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";

$dateps = $_POST['dateps'];
$partcul = $_POST['partcul'];
$kml = $_POST['kml'];
$amunt = $_POST['amunt'];
$bilId = $_POST['bilId'];


$sqlPas = mysql_query("INSERT INTO `billprintrecord` (`refsId`, `orderDate`, `details`, `kmhrs`, `rate`) VALUES ('$bilId', '$dateps', '$partcul', '$kml', '$amunt')");
if(mysql_error()){
    echo 'Record not added!!';
}else{
  echo' <table width="100%">';
           $sqlP = mysql_query("SELECT * FROM `billprintrecord` WHERE `refsId` = $bilId");
           if(mysql_error()){
               echo '<tr><td align="center"><b>Add record!!</b></td></tr>';
           }else{
               while($rop = mysql_fetch_assoc($sqlP)){
                   echo '<tr style=" border: 1px #000 dashed;"><td>'.$rop['orderDate'].'</td><td>'.$rop['details'].'</td><td>'.$rop['kmhrs'].'</td><td>'.$rop['rate'].'</td>
                       </tr>';
               }
           }
     echo '</table>';
}
?>