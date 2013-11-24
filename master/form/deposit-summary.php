<?php
    require_once "../../core/php/connection.php";
    if(isset($_GET['cid']))
        $cid = $_GET['cid'];
    else
        $cid = 'ALL';
    if(isset($_GET['f']))
        $filtered = $_GET['f'];
    else
        $filtered = false;
?>
    <?php
        if($cid=='ALL')
            $qry = "SELECT `cd_cab_code`,`cd_deposite_amount`,`cd_received_deposite`,`cd_sticker_charge`,`cd_sticker_charge_paid` FROM cab_deposite ORDER BY `cd_cab_code`";
        else
            $qry = "SELECT `cd_cab_code`,`cd_deposite_amount`,`cd_received_deposite`,`cd_sticker_charge`,`cd_sticker_charge_paid` FROM cab_deposite WHERE `cd_cab_code` = '$cid'";
        $res = mysql_query($qry);
        if(mysql_num_rows($res)==0){
            echo '<tr><td colspan="8">No records found.</td></tr>';
        }
        else{
            $slnum = 1;
            $rowColor = 'class="row-active"';
            $totPaid = 0;
            $toPay = 0;
            $tot1 = 0;
            $tot2 = 0;
            $tot3 = 0;
            $tot4 = 0;
            $tot5 = 0;
            $tot6 = 0;
            $strOp = '';
            $flCabCode = '<option value="ALL">All</option>';
            while($row=mysql_fetch_assoc($res)){
                if($slnum%2==0)
                    $rowColor = 'class="row-active"';
                else
                    $rowColor = 'class="row-inactive"';
                $totPaid = $row['cd_received_deposite']+$row['cd_sticker_charge_paid'];
                $toPay = $row['cd_deposite_amount']+$row['cd_sticker_charge']-$totPaid;
                $tot1 += $row['cd_deposite_amount'];
                $tot2 += $row['cd_received_deposite'];
                $tot3 += $row['cd_sticker_charge'];
                $tot4 += $row['cd_sticker_charge_paid'];
                $tot5 += $totPaid;
                $tot6 += $toPay;
                $flCabCode .= '<option value="'.$row['cd_cab_code'].'">'.$row['cd_cab_code'].'</option>';
                $strOp .='<tr '.$rowColor.'><td>'.$slnum.'</td><td>'.$row['cd_cab_code'].'</td><td align="right">'.$row['cd_deposite_amount'].'</td><td align="right">'.$row['cd_received_deposite'].'</td><td align="right">'.$row['cd_sticker_charge'].'</td><td align="right">'.$row['cd_sticker_charge_paid'].'</td><td align="right">'.$totPaid.'</td><td align="right">'.$toPay.'</td></tr>';
                $slnum++;
            }
            if(!$filtered){
                echo '<div class="formContainer" style="width: 99%;">
                      <div class="title">Cab Deposit Summary</div>
                      <table id="product-table"><tr><td><b>Filters</b></td><td>Cab Code: <select onChange="filterCabs(this.value);">'.$flCabCode.'</select></td></tr></table>';
                echo '<div id="cabDepositSummary">';
            }
            echo '<table width="100%" id="product-table">
                        <tr>
                            <th class="table-header-repeat">Sl. No.</th>
                            <th class="table-header-repeat">Cab Code</th>
                            <th class="table-header-repeat">Initial Deposit</th>
                            <th class="table-header-repeat">Initial Deposit Paid</th>
                            <th class="table-header-repeat">Sticker Amount</th>
                            <th class="table-header-repeat">Sticker Amount Paid</th>
                            <th class="table-header-repeat">Total Paid</th>
                            <th class="table-header-repeat">To Pay</th>
                        </tr><tr><td>Total</td><td></td><td align="right">'.$tot1.'</td><td align="right">'.$tot2.'</td><td align="right">'.$tot3.'</td><td align="right">'.$tot4.'</td><td align="right">'.$tot5.'</td><td align="right">'.$tot6.'</td></tr>'.$strOp;
            if(!$filtered)
                echo '</div>';
        }
    ?>
</table>
</div>
<script language="javascript">
    function filterCabs(val){
        $("#cabDepositSummary").load('../master/form/deposit-summary.php?f=true&cid='+val);
    }
</script>