
<?php
require_once "../../core/php/con-no-watch.php";
$CurDate = date("Y-m-d");
	$sqlBook = mysql_query("SELECT * FROM `book_master` WHERE `required_date` = '$CurDate'");
	if(mysql_error()){
		echo 'No Record Found';
		
	}else{
		$totalBook = mysql_num_rows($sqlBook);
	 if($totalBook == 0){
		 echo '<img src="images/warning.png" width="24" height="24" /><br>No Booking Today.';
	 }else{
		$sqlWai = mysql_query("SELECT * FROM `book_master` WHERE `required_date` = '$CurDate' AND `status` = 1");
		$countWai = mysql_num_rows($sqlWai);
		//for dispatch
		$sqlDis = mysql_query("SELECT * FROM `book_master` WHERE `required_date` = '$CurDate' AND `status` = 2");
		$countDis = mysql_num_rows($sqlDis);
		
		$sqlCen = mysql_query("SELECT * FROM `book_master` WHERE `required_date` = '$CurDate' AND `status` = 3");
		$countCen = mysql_num_rows($sqlCen);
		
	    //$plus = 138;
        //$minus = 29;

$waitPer = round(($countWai / $totalBook) * 100);
$disPer = round(($countDis / $totalBook) * 100);
$cenlPer = round(($countCen / $totalBook) * 100);
//$minuspercent = round(($minus / $totalnumber) * 100);
	echo '
<table width="450px" border="0" id="product-table" style="color:#ffffff;">
    <tr>
    <th colspan="2" align="center" style="background:#5B7778; color:#ffffff;">Todays Order Status</th>
  </tr>
  <tr align="left" valign="middle" bgcolor="#006699">
    <td width="150px">&nbsp;&nbsp;Waiting [ '.$countWai.' ]</td>
    <td width="300px">';
    
	 echo '<div class="rating"><div class="graphcont"><div class="graph"><strong class="bar" style="width:'.$waitPer.'%;">'.$waitPer.'%</strong></div></div></div>

<div class="clear"></div>
';
	echo '
    </td>
  </tr>
  <tr align="left" valign="middle" bgcolor="#009966">
    <td>&nbsp;&nbsp;Dispatch [ '.$countDis.' ]</td>
    <td>';
	 echo '<div class="rating"><div class="graphcont"><div class="graph"><strong class="bar" style="width:'.$disPer.'%;">'.$disPer.'%</strong></div></div></div>

<div class="clear"></div>
';
	echo '
    </td>
  </tr>
  <tr align="left" valign="middle" bgcolor="#CC3333">
    <td>&nbsp;&nbsp;Canceled [ '.$countCen.' ]</td>
    <td>';
	
	 echo '<div class="rating"><div class="graphcont"><div class="graph"><strong class="bar" style="width:'.$cenlPer.'%;">'.$cenlPer.'%</strong></div></div></div>

<div class="clear"></div>
';
	echo '
    </td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#CCCCCC"><font color="#333333"><b>Total Order :'.$totalBook.'</b></font></td>
  </tr>
</table>';
	}
	}
?>
