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
echo '<table width="100%" border="0" id="product-table">
	';
      
 $eid = $_SESSION['EMP_ID'];
 
 echo '<tr>
    <td align="center" bgcolor="#5B7778">
    <strong style="color:#ffffff;">Waiting for Dispatch for the '.date("l, d S F, Y").'</strong>
    </td>
  </tr><tr align="center" valign="middle">
        <td>
        <table width="100%" border="0">
          <tr>';
 if($empType == 1 || $empType == 6){
	 echo '<th width="70" class="table-header-repeat">Sl.No.</th>';
  }else{
  }
            
                    echo '
            <th width="125" class="table-header-repeat">Order No.</th>
            <th width="110" class="table-header-repeat">Time</th>
            <th width="130" class="table-header-repeat">Srv.Type</th>
            <th width="125" class="table-header-repeat">Cab Type</th>
            <th width="150" class="table-header-repeat">Pick Up</th>
            <th width="150" class="table-header-repeat">Drop Up</th>
            <th width="125" class="table-header-repeat">Action</th>
          </tr>
   </table>
        </td>
      </tr>
      <tr>
        <td>
        <div style="overflow:auto; width:100%; height:150px;">';
		
		 $curDate = date("Y-m-d");
  $sqlBok = mysql_query("SELECT * FROM `book_master` WHERE `status` = 1 AND `required_date` = '$curDate' ORDER BY `required_time` ASC LIMIT 10");
  if(mysql_error()){
	  echo '<tr><td align="center" colspan="8"><img src="images/001_11.png" width="24" height="24"><br><font color="#CC3333;"><b> No Record Found!!</b></font></td></tr>';
  }else{
       $curTime = date("H");
       $va = subtractTime(0,30,0);
echo   '<table width="100%" border="0">';
	$i = 1;
	while($roBo = mysql_fetch_assoc($sqlBok)){
		$t = $i++;
                
       $sat = $roBo ['status'];
       $reqTime = $roBo ['required_time'];
      
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
        <td width="110">'.$roBo['required_time'].'</td>
        <td width="130">';
		$srvTye = $roBo['service_type'];
		$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `service_id` = '$srvTye'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roSrTy = mysql_fetch_assoc($sqlSrv);
		echo $roSrTy['service_type'];
	}
		echo '</td>
        <td width="125">';
		$cabTye = $roBo['cab_type'];
		$sqlTy = mysql_query("SELECT * FROM `cab_types` WHERE `cab_type_id` = '$cabTye'");
	if(mysql_error()){
		echo 'Not Found';
	}else{
		$roTy = mysql_fetch_assoc($sqlTy);
		echo $roTy['cab_type_name'];
	}
		 echo '</td>
        <td width="150">';
	$piUp = $roBo['pickup_point'];
        $areIdh = strpbrk($piUp,"+");
        $areId =  substr($areIdh,1);
		$sqlPicAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId'");
			if(mysql_error()){
				echo 'Not Found!';
			}else{
				$roPiAre = mysql_fetch_assoc($sqlPicAre);
				$p = $t++;
		
		?>
		<a href="#" onClick="keepAlive(this,'sub<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub<?php echo $p; ?>', 'none');">
        <?php
				echo $roPiAre['area_name'];
				?>
        </a>
            <div id="sub<?php echo $p; ?>" class="popup">
        <?php
		$cuMid = $roBo['cust_id'];
		
		$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuMid'");
		$sqlMas = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuMid'");
		if(mysql_error()){
			//do nothing
		}else{
			$rop = mysql_fetch_assoc($sqlAdd);
			$rl = mysql_fetch_assoc($sqlMas);
			$of = $rl['office'];
			$cu = $rl['current'];
			$re = $rl['recedence'];
			echo '<b>'.$rl['cust_name'].'</b><br><em>Mob:</em> '.$rl['mobile'].', '.$rl['alt_mobile'].', '.$rl['phone_no'].'<br>';
			$ppO = $roBo['pickup_point'];
			$adt = explode("+",$ppO);
			echo current($adt);
			
		}
		?>
       </div>
        <?php
			}
		echo '</td><td width="150">';
		$droUp =  $roBo['destination']; 
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
                <img src="images/car_add.png" width="20" height="20" align="absmiddle">
                <a href="#" id="../master/form/assign-cab.php?type=AS-<?php echo $roBo['booking_id']; ?>" onClick="showMainAction(this.id)">Asign Cab</a>
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