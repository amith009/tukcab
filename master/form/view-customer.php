<script>
function openWin()
{
myWindow=window.open('../master/form/export-customer.php','Export customer record','width=250,height=200');
//myWindow.document.write("<p>This is 'myWindow'</p>");
myWindow.focus();
}
</script>
<?php
	require_once "../../core/php/connection.php";
	$headers = $_GET['headers'];
	$start = $_GET['start'];
	$pageSize = $_GET['pageSize'];
	$boktype = $_GET['boktype'];
	$startdate = $_GET['startdate'];
	$enddate = $_GET['enddate'];
	
	if($boktype == "pass"){		
		$val = "WHERE DATE_FORMAT(`date_join`, '%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' ";
	}else{
		$val = "";
	}
	//echo $val;
	if($pageSize==0||$pageSize<0) die ("Page Size must be > 0");
	
	//count total number of pages in table matching the request
	$sql = mysql_query("SELECT count(1) rows FROM cust_master $val");
	$res = mysql_fetch_array($sql);
	$totRows = $res['rows'];
	$totPages = ceil($totRows/$pageSize);
	
	$end = $pageSize;
	
	$curPage = floor($start/$pageSize)+1;
	
	//echo $curPage.' - '.$totRows.' - '.$pageSize.' - '.$totPages; exit(0);
	//echo "SELECT * FROM `cust_master` $val LIMIT ".$start.",".$end;
	$sql = mysql_query("SELECT * FROM `cust_master` $val LIMIT ".$start.",".$end);
	$count =  mysql_num_rows($sql);
	$ArgPass = mysql_Query("SELECT * FROM `cust_master` $val");
	$totalRec = mysql_num_rows($ArgPass);
	echo '<div style="float:left; font-weight:bold;">Total record:'.$totalRec.'</div>
	<!--div style="float:right;"><a href="#" onclick="openWin()"><img src="images/arrow-step-over.png" /> Export Record</a></div-->
	';
	$retHtml = '';

	$retHtml .= '<table width="100%"  id="product-table">
	<tr><td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" id="areaDispContent">
	  <tr>
		<td colspan="5" align="center">';
		if($count == 0){
			$retHtml .= '<img src="images/001_11.png" width="24" height="24"><br>NO RECORDS FOUND!!';
		}else{
		$retHtml .= '</td>
	  </tr>
	  <thead>
	   <tr>
		<th class="table-header-repeat">Sl. No.</th>
		<th class="table-header-repeat">Customer Name</th>
		<th class="table-header-repeat">Contact Number</th>
		<th class="table-header-repeat">Email Address</th>
		<th class="table-header-repeat">Priority</th>
	  </tr>
	  </thead><tbody>';
	  $i = $start+1;
	  while($rows = mysql_fetch_assoc($sql)){
	  $t = $i++;
	  $retHtml .= '<tr ';
		if($t %2 == 0){
			$retHtml .= 'class="row-active"';
		}else{
			$retHtml .= 'class="row-inactive"';
		}
		$retHtml .= '>';
		$retHtml .= '<td>'.$t.'</td>
		<td><a href="#" id="../master/form/view-customer-record.php?id='.$rows['cust_id'].'" onClick="showMainAction(this.id)">'.$rows['cust_name'].'</a></td>
                <td> Mob:'.$rows['mobile'].', '.$rows['alt_mobile'].'<br />PH: '.$rows['phone_no'].'</td>
                <td>'.$rows['email'].', '.$rows['alt_email'].'</td>
		<td align="center">';
		$sut = $rows['rate'];
		if($sut == 0 || $sut == ""){
			$retHtml .= '<img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
		}
                elseif($sut == 1){
                    $retHtml .= '<img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
                }
                elseif($sut == 2){
                    $retHtml .= '<img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
                }
                elseif($sut == 3){
                    $retHtml .= '<img src="images/sactive.png" width="22" height="22" />
                                   <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
                }
                elseif($sut == 4){
                    $retHtml .= '<img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
                }
                elseif($sut == 5){
                    $retHtml .= '<img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />
                                    <img src="images/sactive.png" width="22" height="22" />';
                }
                else{
			$retHtml .= '<img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />
                                    <img src="images/sblank.png" width="22" height="22" />';
		}
		$retHtml .='</td>		
	  </tr>';
	  }//while close
		}
	$retHtml .= '<tbody></table></td></tr></table>';
	//add this for pagination
	$retHtml .= '<div><input type="button" value="<<" onClick="gotoPrevPage();" class="NavButton"/>
	<select onchange="gotoPage(this.value);" id="pageSelect">';
	for($pg=1;$pg<=$totPages;$pg++){
		if($pg==$curPage)
			$retHtml .= '<option value="'.$pg.'" selected="selected">'.$pg.'</option>';
		else
			$retHtml .= '<option value="'.$pg.'">'.$pg.'</option>';
	}
	$retHtml .='</select><input type="button" value=">>" onClick="gotoNextPage();" class="NavButton"/></div>';
	//pagination ends
	echo $retHtml;
?>