<?php
	require_once "../../core/php/connection.php";
	$headers = $_GET['headers'];
	$start = $_GET['start'];
	$pageSize = $_GET['pageSize'];
	
	if($pageSize==0||$pageSize<0) die ("Page Size must be > 0");
	
	//count total number of pages in table matching the request
	$sql = mysql_query("SELECT count(1) rows FROM area");
	$res = mysql_fetch_array($sql);
	$totRows = $res['rows'];
	$totPages = ceil($totRows/$pageSize);
	
	$end = $pageSize;
	
	$curPage = floor($start/$pageSize)+1;
	
	//echo $curPage.' - '.$totRows.' - '.$pageSize.' - '.$totPages; exit(0);
	
	$sql = mysql_query("SELECT * FROM `vw_area` LIMIT ".$start.",".$end);
	$count =  mysql_num_rows($sql);
	
	$retHtml = '';

	$retHtml .= '<table width="100%"  id="product-table"><tr><td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" id="areaDispContent">
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
		<th class="table-header-repeat">Area Name</th>
		<th class="table-header-repeat">Status</th>
		<th class="table-header-repeat">Action</th>
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
		<td>'.$rows['area_name'].'</td>
		<td>';
		$sut = $rows['status'];
		if($sut == 1){
			$retHtml .= '<img src="images/001_09.png" width="22" height="22" />';
		}else{
			$retHtml .= '<img src="images/001_02.png" width="22" height="22" />';
		}
		$retHtml .='</td>
		<td>';
		
		$retHtml .= '<a href="#" id="../master/form/edit-area.php?type='.$rows['area_id'].'" onClick="showMainAction(this.id)" winTitle="Edit Area">
		<img src="images/001_45.png" width="16" height="16">
		</a>
		';
		
		
		$retHtml .='
		</td>
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