<?php
require_once "../../core/php/connection.php";

$cabid = $_GET['cabid'];
$cabDet = mysql_query("SELECT cab_id FROM `cabs` where `cab_code` = '$cabid' and `status` = '1'");
                     $cobNo = mysql_num_rows($cabDet);
                    
                    if($cobNo == 1){
                    $rowCabId = mysql_fetch_assoc($cabDet);
                    $cabIdPas = $rowCabId['cab_id'];
$sqlCab = mysql_query("SELECT driver_id FROM `assigned_cabs` where `cab_id` = '$cabIdPas' and `status` = '1'");
                    if($sqlCab == true){
                        $rowCab = mysql_fetch_assoc($sqlCab);
                        $drivId = $rowCab['driver_id'];
                        $sqlDrv = mysql_query("SELECT mobile_no,email,driver_name,driver_type,driver_owner  FROM `drivers` where `driver_id` = '$drivId'");
                        $countDriv = mysql_num_rows($sqlDrv);
                        if($countDriv == 1){
                            $rowsDrv = mysql_fetch_assoc($sqlDrv);
                            $drvMob = $rowsDrv['mobile_no'];
                            $drvEmail = $rowsDrv['email'];
                            $drType = $rowsDrv['driver_type'];
                            $drOwn = $rowsDrv['driver_owner'];
                            if($drOwn != ''){
                            $sqlOwn = mysql_query("SELECT mobile_no,email,driver_name  FROM `drivers` where `driver_id` = '$drOwn'");
                            if(mysql_num_rows($sqlOwn) == 1){
                                $rowsOwn = mysql_fetch_assoc($sqlOwn);
                                $ownNo = $rowsOwn['mobile_no'];
                                $ownEmail = $rowsOwn['email'];
                                
                             }
                            } 
                            ?>
<table>
   
    <tr>
        <td>
            <table>
                <tr>
                    <td align="center" valign="top">
                        <img src="../../core/images/bill_header.png" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            www.kkcbas.com
        </td>
    </tr>
</table>
<?php
                        }
                    }

        }else{
            echo 'Driver Assign record not found';
        }
 ?>
