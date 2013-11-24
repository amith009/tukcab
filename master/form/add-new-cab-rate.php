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
$id = $_GET['id'];
require_once "../../core/php/connection.php";
?>
<form method="post" name="frmCreateCustomer"  id="frmCust" action="../master/php/add-new-cab-rate.php">
<table width="100%" id="product-table">
    <tr>
        <th class="table-header-repeat" colspan="2">Add new cab rate for 
        <?php
            $rtp = $_GET['ratype'];
            $sqlAdf = mysql_query("SELECT * FROM `cab_rate_title` WHERE `crt_id` = '$rtp'");
            if(mysql_error()){
                echo 'Not Found';
            }else{
                $rowsType = mysql_fetch_assoc($sqlAdf);
                echo $rowsType['crt_title'];
        ?>
        <input type="hidden" name="rty" value="<?php echo $rtp; ?>" />
        </th>
    </tr>
   
  <tr align="left" valign="top">
    <td>Cab Type</td>
    <td>
        <select name="cbType">
         <option value="0">All Cabs</option>
             <?php
            $sqlcab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` ORDER BY `cab_type_name` ASC");
            if(mysql_error()){
                    echo '<option value="ALL">No Cab Found</option>';
            }else{
                    while($rocb = mysql_fetch_assoc($sqlcab)){	
                        $cbTypeId = $rocb['cab_type_id'];
                         if($cbTypeId == "24" || $cbTypeId == "19" || $cbTypeId == "18"){
                                    }else{
                                        echo '<option value="'.$rocb['cab_type_id'].'">'.$rocb['cab_type_name'].'</option>';
                                    }
                    }
            }
            ?>
         </select>
    </td>
    
  </tr>
  <?php
    $sqldetl = mysql_query("SELECT * FROM `cab_rate_details` where `crt_id` = '$rtp'");
    if(mysql_error()){
        echo 'Record Not found';
    }else{
        while($rowsDet = mysql_fetch_assoc($sqldetl)){
            echo '<tr><td><input type="checkbox" value="" name="track[]"  /><input type="hidden" value="'.$rowsDet['crd_id'].'" name="crtid[]" />&nbsp;'.$rowsDet['crd_title'].'</td><td><input type="text" value="" name="values[]" /></td></tr>';
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
  <tr align="left"><td colspan="4" align="right"><input type="submit"  value="Save" class="myButton" /> </td></tr>
  <?php
        }
    }
  ?>
</table>
</form>
<script language="javascript">
$("#frmCust").validate();
</script>