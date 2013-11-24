<?php
require_once "../../core/php/con-no-watch.php";
date_default_timezone_set('Asia/Kolkata'); //time stamp
  session_start();
$empType = $_SESSION['EMP_TYPE'];  
/*FUNCTION FOR TIME STAMP WITH #) MIN SUBSTRACTION
 * Function name : subtractTime()  and passing Hrs Min and Sec value
 * 
 * */

function subtractTime($hours=0, $minutes=0, $seconds=0)

{

$totalHours = date("H") + $hours;

$totalMinutes = date("i") + $minutes;

$totalSeconds = date("s") + $seconds;


$timeStamp = mktime($totalHours, $totalMinutes, $totalSeconds);

$myTime = date("H:i:s ", $timeStamp);

return $myTime;

}
echo '<div class="title" align="center" style="background:#5B7778; color:#ffffff; font-size:12px;">Online Waiting orders for the '.date("l, d S F, Y").'</div>
    <table width="100%" border="0" class="main-home-frame" id="product-table">
	
      <tr align="center" valign="middle">
        <td>
        <table width="100%" border="0">
          <tr>';
 if($empType == 1 || $empType == 6){
	 echo '<th width="70" class="table-header-repeat">Sl.No.</th>';
  }
            
          echo '
            <th width="125" class="table-header-repeat">Order No.</th>
            <th width="110" class="table-header-repeat">Time</th>
            <th width="130" class="table-header-repeat">Srv.Type</th>
            <th width="125" class="table-header-repeat">Cab Type</th>
            <th width="150" class="table-header-repeat">Pick Up</th>
            <th width="150" class="table-header-repeat">Drop Up</th>
            <th width="125" class="table-header-repeat">Acion</th>
          </tr>
   </table>
        </td>
      </tr>
      <tr>
        <td valign="top">
        <div style="overflow:auto; width:100%; height:200px;">';
	echo   '<table width="100%" border="0">';	
		 $curDate = date("Y-m-d");
  $sqlBok = mysql_query("SELECT * FROM `online_record` WHERE `status` = 1  ORDER BY `time` ASC LIMIT 10");
  $countRow = mysql_num_rows($sqlBok);
  if($countRow == 0){
	  echo '<tr><td align="center" valign="top" colspan="8"><img src="images/001_11.png" width="24" height="24"><br><font color="#CC3333;"><b> No Record Found!!</b></font></td></tr>';
  }else{
       $curTime = date("H");
       $va = subtractTime(0,30,0);

	$i = 1;
	while($roBo = mysql_fetch_assoc($sqlBok)){
		$t = $i++;
                
       $sat = $roBo ['status'];
       $reqTime = $roBo ['time'];
      
       $hrs = substr($reqTime,0,2); //hours
       $min = substr($reqTime,3,2); // minuts
      
       $sec = substr($reqTime,6); // secound
       
       
       $nowTime = $hrs.':30:'.$sec;
   echo '<tr align="center" ';
   if($nowTime <= $va){
       echo 'class="redMV"';
   }else{
   if($sat == 3){
	   echo 'class="redM"';
   }else{
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
   }
   }
	echo '>';
	
    if($empType == 1 || $empType == 6){
	 echo '<td width="70">'.$t.'</td>';
  }else{
  }
  echo '
        <td width="125">'.$roBo['booking_code'].'</td>
        <td width="110">'.$roBo['time'].'</td>
        <td width="130">';
		$srvTye = $roBo['servicesType'];
		$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTye'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roSrTy = mysql_fetch_assoc($sqlSrv);
		echo $roSrTy['service_type'];
	}
		echo '</td>
        <td width="125">';
		$cabTye = $roBo['cabType'];
		$sqlTy = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTye'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roTy = mysql_fetch_assoc($sqlTy);
		echo $roTy['cab_type_name'];
	}
		 echo '</td>
        <td width="150">';
	    $areId =  $roBo['pickup'];;
		$sqlPicAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
			if(mysql_error()){
				echo 'Not Found!';
			}else{
				    $roPiAre = mysql_fetch_assoc($sqlPicAre);		
					
					$adt = $roBo['address'];;
					echo $adt.'<br>'.$roPiAre['area_name'];			
					}		
			
		echo '</td><td width="150">';
		$droUp =  $roBo['dropPoint']; 
		$sqlDroAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$droUp'");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roDrAre = mysql_fetch_assoc($sqlDroAre);
		echo $roDrAre['area_name'];
		
	}
		echo '</td>
                <td width="125">';
				?>
                <img src="images/document-revert.png" width="20" height="20" align="absmiddle">
                     

                <a href="#" id="../master/form/confirm-order.php?id=<?php echo $roBo['booking_id']; ?>" onClick="showMainAction(this.id)">Confirm Order</a>
                <?php
                
				echo '</td>

		
      </tr>';
      
	}
	echo '</table>';
  }
echo '    
    </div>
        </td>
      </tr>
    </table>';
  ?>