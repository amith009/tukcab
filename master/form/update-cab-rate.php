<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: cab rate adding 
##########
Create date = 3 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
$curdate = date("Y-m-d");
$cabType = $_POST['cabType'];
$rateType = $_POST['rateType'];
require_once "../../core/php/connection.php";
?>
<form method="post" name="frmCreateCustomer"  id="frmCust" action="../master/php/update-cab-rate.php">
<table width="100%" id="product-table">
    <tr>
        <th class="table-header-repeat" colspan="2">Update cab rate for 
        <?php
           
            $sqlAdf = mysql_query("SELECT * FROM `cab_rate_title` WHERE `crt_id` = '$rateType'");
            if(mysql_error()){
                echo 'Not Found';
            }else{
                $rowsType = mysql_fetch_assoc($sqlAdf);
                echo $rowsType['crt_title'];
        ?>
        <input type="hidden" name="cbType" value="<?php echo $cabType; ?>" />
        </th>
    </tr>
   
  <tr align="left" valign="top">
    <td>Cab Type</td>
    <td>
        <?php
             $sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `cab_type_id` = '$cabType'");
            if(mysql_error()){
                    echo '<option value="ALL">No Cab Found</option>';
            }else{
                    while($rocb = mysql_fetch_assoc($sqlcab)){	
                    echo $rocb['cab_type_name'];
                    }
            }
            ?>
       
    </td>
    
  </tr>
  <?php
    $sqldetl = mysql_query("SELECT * FROM `cab_rate_details` where `crt_id` = '$rateType'");
    if(mysql_error()){
        echo 'Record Not found';
    }else{
        while($rowsDet = mysql_fetch_assoc($sqldetl)){
            $crdid = $rowsDet['crd_id'];
            echo '<tr><td><input type="checkbox" checked="true" name="track[]"  /><input type="hidden" value="'.$rowsDet['crd_id'].'" name="crtid[]" />&nbsp;'.$rowsDet['crd_title'].'</td><td><input type="text" value="';
            $sqlreco = mysql_query("SELECT * FROM `cab_rate_record` WHERE `cab_type_id` = '$cabType' and crd_id = '$crdid'");
            if(mysql_error()){
                echo 'N/A';
            }else{
                $countDr = mysql_num_rows($sqlreco);
                if($countDr == 0){
                    echo "";
                }
                $rowsDr = mysql_fetch_assoc($sqlreco);
                echo $rowsDr['crr_value'];
            }
            echo '" name="values[]" /></td></tr>';
        }
        
  ?>
  <tr>
    <td>Status.</td>
    <td>
        <select name="status">
            <option value="1">Active</option>
            <option value="0">Block</option>
        </select>
    </td>
  </tr>
  <tr align="left"><td colspan="4" align="right"><input type="submit"  value="Update" class="myButton" /> </td></tr>
  <?php
        }
    }
  ?>
</table>
</form>
<script language="javascript">
$("#frmCust").validate();
</script>