<?php 
require_once "../../core/php/connection.php";
$eid = $_SESSION['EMP_ID'];
$tymp = $_GET['typem'];
$yy = date("Y");
$jan = $yy.'-01';
$feb = $yy.'-02';
$mar = $yy.'-03';
$apr = $yy.'-04';
$may = $yy.'-05';
$jun = $yy.'-06';
$jul = $yy.'-07';
$aug = $yy.'-08';
$sep = $yy.'-09';
$oct = $yy.'-10';
$nov = $yy.'-11';
$dec = $yy.'-12';

	 /* JAN*/
	 $sqlJan = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$jan'");
	 $countJan = mysql_num_rows($sqlJan);
	 /* FEB*/
	 $sqlFeb = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$feb'");
	 $countFeb = mysql_num_rows($sqlFeb);
	 /* MARCH */
	 $sqlMar = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$mar'");
	 $countMar = mysql_num_rows($sqlMar);
	 /* APR*/
	 $sqlApr = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$apr'");
	 $countApr = mysql_num_rows($sqlApr);
	 /* MAY*/
	 $sqlMay = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$may'");
	 $countMay = mysql_num_rows($sqlMay);
	 /* JUN*/
	 $sqlJun = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$jun'");
	 $countJun = mysql_num_rows($sqlJun);
	 /* JUL*/
	 $sqlJul = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$jul'");
	 $countJul = mysql_num_rows($sqlJul);
	 /* Aug*/
	 $sqlAug = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$aug'");
	 $countAug = mysql_num_rows($sqlAug);
	 /* SEP*/
	 $sqlSep = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$sep'");
	 $countSep = mysql_num_rows($sqlSep);
	 /* OCT*/
	 $sqlOct = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$oct'");
	 $countOct = mysql_num_rows($sqlOct);
	 /* NOV*/
	 $sqlNov = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$nov'");
	 $countNov = mysql_num_rows($sqlNov);
	 /* DEC*/
	 $sqlDec = mysql_query("SELECT DATE_FORMAT(`al_date`,'%Y-%m'),al_emp_id,al_log_type FROM `app_log` WHERE `al_emp_id` = '$eid' AND `al_log_type` = '$tymp' AND DATE_FORMAT(`al_date`,'%Y-%m') = '$dec'");
	 $countDec = mysql_num_rows($sqlDec);
	 
?>
<div class="mainGraphArea">
<div class="title">Your <?php 
if($tymp == "BOK"){
echo 'Booking ';
}
elseif($tymp == "DIS"){
echo 'Dispatch';
}
elseif($tymp == "CEL"){
echo 'Cancel';
}
else{
echo 'Booking';
}

$totalbookinyear = $countJan+$countFeb+$countMar+$countMar+$countApr+$countMay+$countJun+$countJul+$countAug+$countSep+$countOct+$countNov+$countDec;

$jan = round(($countJan / $totalbookinyear) * 100);
$feb = round(($countFeb / $totalbookinyear) * 100);
$mar = round(($countMar / $totalbookinyear) * 100);
$apr = round(($countApr / $totalbookinyear) * 100);
$may = round(($countMay / $totalbookinyear) * 100);
$jun = round(($countJun / $totalbookinyear) * 100);
$jul = round(($countJul / $totalbookinyear) * 100);
$aug = round(($countAug / $totalbookinyear) * 100);
$sep = round(($countSep / $totalbookinyear) * 100);
$oct = round(($countOct / $totalbookinyear) * 100);
$nov = round(($countNov / $totalbookinyear) * 100);
$dec = round(($countDec / $totalbookinyear) * 100);

?> order status for the year <?php echo $yy; ?></div>
<br /><br />
<table id="product-table" class="graphtable" style="width:100%">
    <tr>
        <th class="table-header-repeat">Employee order status for the year <?php echo date('Y'); ?></th>
    </tr>
	<tr>
        <td class="values" >
		
            <label>January:<span style="background-color: #e21717; width:<?php echo $jan; ?>%;"><?php echo $countJan; ?></span></label>
            <label>February:<span style="background-color: #e29d17;  width:<?php echo $feb; ?>%;"><?php echo $countFeb; ?></span></label>
            <label>March:<span style="background-color: #b5e217;  width:<?php echo $mar; ?>%;"><?php echo $countMar; ?></span></label>
            <label>April:<span style="background-color: #17e29d;  width:<?php echo $apr; ?>%;"><?php echo $countApr; ?></span></label>
            <label>May:<span style="background-color: #17e0e2;  width:<?php echo $may; ?>%;"><?php echo $countMay; ?></span></label>
            <label>June:<span style="background-color: #1785e2;  width:<?php echo $jun; ?>%;"><?php echo $countJun; ?></span></label>
            <label>July:<span style="background-color: #7717e2;  width:<?php echo $jul; ?>%;"><?php echo $countJul; ?></span></label>
            <label>August:<span style="background-color: #e017e2;  width:<?php echo $aug; ?>%;"><?php echo $countAug; ?></span></label>
            <label>September:<span style="background-color: #636397;  width:<?php echo $sep; ?>%;"><?php echo $countSep; ?></span></label>
            <label>October:<span style="background-color: #f399bd;  width:<?php echo $oct; ?>%;"><?php echo $countOct; ?></span></label>
            <label>November:<span style="background-color: #7c7256;  width:<?php echo $nov; ?>%;"><?php echo $countNov; ?></span></label>
            <label>December:<span style="background-color: #1b1b1a;  width:<?php echo $dec; ?>%;"><?php echo $countDec; ?></span></label>
			
        </td>
    </tr>
    <tr>
        <td align="right">
            <div class="barDown">
				<a href="#" id="../master/form/employee_status.php?typem=BOK" onClick="showMainAction(this.id)" class="acc-stats" style="color:#fff;">BOOKING</a> | 
				<a href="#" id="../master/form/employee_status.php?typem=DIS" onClick="showMainAction(this.id)" class="acc-stats" style="color:#fff;">DISPATCH</a> |
				<a href="#" id="../master/form/employee_status.php?typem=CEL" onClick="showMainAction(this.id)" class="acc-stats" style="color:#fff;">CANCEL</a>
			</div>
        </td>
    </tr>
</table>

