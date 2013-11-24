<?php
/*********************************************************************************************

File Name: waiting-order-list.php
Work and function: display list all free cab avilable.
T=table name -> waith order list here
##########
Create date = 30 NOV 2011
Time: 08:05
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
session_start();
$empType = $_SESSION['EMP_TYPE'];

require_once "../../core/php/connection.php";

$StrDat = $_GET['dateStr'];

$EndDat = $_GET['dateEnd'];
$type = $_GET['type'];
if($StrDat == ""){
    $StrDat = $date;
}
if($EndDat == ""){
    $EndDat = $date;
}
$date = date("Y-m-d");

if($type == "ALL"){
	$valPass = "WHERE `required_date` BETWEEN '".$StrDat."' AND '".$EndDat."' AND bm.status = 2";
}

else{
	$valPass = "WHERE c.cab_id = ".$type." AND `required_date` BETWEEN '".$StrDat."' AND '".$EndDat."' AND bm.status = 2";
}
?>
<script type="text/javascript">
//Start date here
function showCabDetails(str)
{
	var uri = str;
	var obj = document.getElementById("tripCountStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<?php
echo '
<table width="100%" border="0" id="product-table">
  <tr>';
if($empType == 1 || $empType == 6){
	 echo '
    <th class="table-header-repeat">Sl. No.</th>';
  }else{
  }echo '
    <th width="34%" class="table-header-repeat">Cab Code</th>
    <th width="27%" class="table-header-repeat">No. of Trips</th>
  </tr>';
//echo "SELECT bm.cab_id FROM `book_master` bm,`cabs` c $valPass AND bm.cab_id=c.cab_id GROUP BY bm.cab_id ORDER BY c.cab_code";
  $sqlCab = mysql_query("SELECT bm.cab_id FROM `book_master` bm,`cabs` c $valPass AND bm.cab_id=c.cab_id GROUP BY bm.cab_id ORDER BY c.cab_code");
  
  $countCab = mysql_num_rows($sqlCab);
  if($countCab == 0){
	  echo '<tr><td colspan="3" align="center">No Record Found</td></tr>';
  }else{
	  $i = 1;
	  while($rowsCab = mysql_fetch_assoc($sqlCab)){
        $t = $i++;
        $cabId = $rowsCab['cab_id'];
	
  echo '<tr align="center" ';
   
	   if($t %2 == 0){
		   echo 'class="row-active"';
	   }else{
		   echo 'class="row-inactive"';
	   }
   
  echo ' >';
  if($empType == 1 || $empType == 6){
	 echo '<td width="7%">'.$t.'</td>';
  }else{
  }
    echo '<td>';
	echo '<a href="#" id="../master/form/view-cab-trip.php?id='.$cabId.'&sDate='.$StrDat.'&eDate='.$EndDat.'" onClick="showCabDetails(this.id)">';
        //echo "SELECT `cab_code`,`cab_id`,`status` FROM `cabs` WHERE `cab_id` = $cabId AND `status` = 1 ORDER BY `cab_code` ASC";
        $sqlCb = mysql_query("SELECT `cab_code`,`cab_id`,`status` FROM `cabs` WHERE `cab_id` = $cabId AND `status` = 1");
        if(mysql_error()){
            echo 'N/A';
        }else{
            $roPk = mysql_fetch_assoc($sqlCb);
            echo $roPk['cab_code'];
            $cid = $roPk['cab_id'];
        }
        echo '</a>';
	echo '</td>
    <td>';
	$coSql = mysql_query("SELECT cab_id FROM `book_master` WHERE `cab_id` = ".$cabId." AND `required_date` BETWEEN '".$StrDat."' AND '".$EndDat."' AND `status` = 2");
        if(mysql_error()){
            echo 'N/A';
        }else{
           echo mysql_num_rows($coSql);
        }
        echo '</td>
  </tr>
  ';
	}//order else close
      } //else close
echo '</table>';
      ?>

