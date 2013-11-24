<?php
/************************************************************************************
File Name: booking-form.php
T=table name -> drivers
##########
Create date = 29 NOV 2011
Time: 06:21 PM
Last Update:
Date: 07-12-2011
Time: 00:00
Author Name: amit kumar
***********************************************************************************/
session_start();
$empType = $_SESSION['EMP_TYPE'];
$empId = $_SESSION['EMP_ID'];
require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$time = date("H:i:s");
$nou = $_GET['no'];
//$nou = 9740460017;
$cb = strlen($nou);
if($cb == 1){
$no = "NULL";
$ty = NULL;
}
else{
  $subNo = substr($nou,0,2);
  if($subNo == "80"){
    $ty = "P";
    $no = substr($nou,2);
  }
  elseif(strlen($nou) == 12){
      $no = substr($nou,2);
      $ty = "M";
  }
  elseif(strlen($nou) == 8){
      $no = $nou;
      $ty = "P";
  }
  else{
      $no = $nou;
      $ty = "M";
  }
  //$ty = $_GET['ty'];
}


if($ty == "M"){
$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `mobile` = $no");
//echo mysql_error();
$countCust = mysql_num_rows($sqlCust);
}elseif($ty == "P"){
$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE  `phone_no` = $no");
//echo mysql_error().'l';
$countCust = mysql_num_rows($sqlCust);
  
}else{
  
}

if($no != "NULL"){
    $timeAss = date("H:i:s");
    $sat = $_GET['sat'];
	$lop = $_GET['pass'];
	if($lop == "lkf"){
		//do nothink because its allready recive
	}else{
  $sqlAdd = mysql_query("INSERT INTO `callrecordtoday` (`number`, `emp_id`, `recTime`, `status`) VALUES ('$no', '$empId', '$timeAss', '$sat')");
 // echo "DELETE FROM `coreconnection`.`callrecord` WHERE `callrecord`.`no` LIKE '$no'";
  $sqlDelNo = mysql_query("DELETE FROM `coreconnection`.`callrecord` WHERE `callrecord`.`no` LIKE '%$no%'");  
  
          if(mysql_error()){
              //echo mysql_error();
          }else{
              //echo 'H';
             $sqlDelCal = mysql_query("DELETE FROM `upcoming_call` WHERE `number` = $no");
              if(mysql_error()){
                  //echo mysql_error();
              }else{
                  //echo 'H';
              }
        }      
          }
}

if($countCust == 0){
	    $coAdd = "";
	    $current = 0;
}else{
	$roCust = mysql_fetch_assoc($sqlCust);
	$cusName = $roCust['cust_name'];
	$cusAlMob = $roCust['alt_mobile'];
	$cust_type = $roCust['cust_type'];
	$mobile = $roCust['mobile'];
	$phone_no = $roCust['phone_no'];
	$email = $roCust['email'];
	$alt_email = $roCust['alt_email'];
	$cuId = $roCust['cust_id'];
	$office = $roCust['office'];
	$rece = $roCust['recedence'];
	$current = $roCust['current'];
	$requ = $roCust['requirement'];
	$rate = $roCust['rate'];
	  //customer address details
	  $sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuId'");
	  $coAdd = mysql_num_rows($sqlAdd);
	  if($coAdd == 0){
		  //do nothing
	  }else{
		    $rowCuDe = mysql_fetch_assoc($sqlAdd);
		  	$off_address = $rowCuDe['cust_add_offi'];
			$off_address_l1 = $rowCuDe['aoffice_lq1'];
			$off_address_l2 = $rowCuDe['aoffice_lq2'];
			$off_address_l3 = $rowCuDe['aoffice_lq3'];
			$off_address_l4 = $rowCuDe['aoffice_lq4'];
			$off_landmark = $rowCuDe['aoffice_lm'];
			$res_address = $rowCuDe['cust_add_res'];
			$res_address_l1 = $rowCuDe['arecedence_lq1'];
			$res_address_l2 = $rowCuDe['arecedence_lq2'];
			$res_address_l3 = $rowCuDe['arecedence_lq3'];
			$res_address_l4 = $rowCuDe['arecedence_lq4'];
			$res_landmark = $rowCuDe['arecedence_lm'];
			$cur_address = $rowCuDe['cust_add_curr'];
			$cur_address_l1 = $rowCuDe['acurrent_lq1'];
			$cur_address_l2 = $rowCuDe['acurrent_lq2'];
			$cur_address_l3 = $rowCuDe['acurrent_lq3'];
			$cur_address_l4 = $rowCuDe['acurrent_lq4'];
			$cur_landmark = $rowCuDe['acurrent_lm'];
	  }
	  //end here
	
	
	
}
?>
<script language="javascript">
$(document).ready(function()
		{
		  //count for local address
		  $('#locResi').simplyCountable({
		    counter: '#counter1',
			countType: 'characters',
			maxCount: 60,
			countDirection: 'up'
		  });
		   //count for local address
		  $('#locOff').simplyCountable({
		    counter: '#counter2',
			countType: 'characters',
			maxCount: 60,
			countDirection: 'up'
		  });
		   //count for local address
		  $('#locCurr').simplyCountable({
		    counter: '#counter3',
			countType: 'characters',
			maxCount: 60,
			countDirection: 'up'
		  });
		  $('#comment').simplyCountable({
		    counter: '#counter4',
			countType: 'characters',
			maxCount: 250,
			countDirection: 'up'
		  });
		  
		});
	var isPickPointSelected = false;
	function toggleIndirectBooking(val){
		if(val==1){
			$(document.getElementById('indirectBk1')).removeClass('donotshow');
			$(document.getElementById('indirectBk2')).removeClass('donotshow');
		}
		else if(val==0){
			$(document.getElementById('indirectBk1')).addClass('donotshow');
			$(document.getElementById('indirectBk2')).addClass('donotshow');
		}
	}
	
	function toggleEndDate(val){
		if(val==5||val==6){
			$(document.getElementById('endDate1')).removeClass('donotshow');
			$(document.getElementById('endDate2')).removeClass('donotshow');
		}
		else{
			$(document.getElementById('endDate1')).addClass('donotshow');
			$(document.getElementById('endDate2')).addClass('donotshow');
		}
	}
	
	function updatePoint(obj,l){
		//alert($(document.getElementById('opCurr')).is(':checked'));
		if(l=='C' && $(document.getElementById('opCurr')).is(':checked'))
			document.getElementById('locPickup').value=obj.value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
		if(l=='R' && $(document.getElementById('opResi')).is(':checked'))
			document.getElementById('locPickup').value=obj.value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
		if(l=='O' && $(document.getElementById('opOff')).is(':checked'))
			document.getElementById('locPickup').value=obj.value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
	}
	
	$("#opCurr").click(function(){
		selectPickPoint('current');
		document.getElementById('locPickup').value=document.getElementById('locCurr').value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
	});
	
	$("#opResi").click(function(){
		selectPickPoint('residence');
		document.getElementById('locPickup').value=document.getElementById('locResi').value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
	});
	
	$("#opOff").click(function(){
		selectPickPoint('office');
		document.getElementById('locPickup').value=document.getElementById('locOff').value+'\n'+document.getElementById('pickupPnt')[document.getElementById('pickupPnt').selectedIndex].innerHTML;
	});
//time validation
    function formatTime(obj){
	if(obj.value=='') return;
	var timeVal = obj.value;
	var hr = timeVal.substr(0,2);
	if(hr>24){
		alert("Invalid Hour [must be between 0 & 24]");
		obj.value="";
		obj.focus();
	}
	var cln = timeVal.substr(2,1);
	var mn = '00';
	if(cln==':'){
		mn = timeVal.substr(3,2);
	}else{
		mn = timeVal.substr(2,2);
	}
	if(mn=='') mn='00';
	if(mn>59)
		alert('Invalid Time');
	obj.value = hr+":"+mn+":00";
	return false;
}

function selectPickPoint(point){
	var newCust = document.getElementById('new_cust_marker');
	if(newCust.value==1) return;
	var p= document.getElementById('pickupPnt');
	switch(point){
		case 'current':
			if(!isPickPointSelected) p.selectedIndex=0;
			$("#landMark").val($("#c_landMark").val());
			$("#lq_1").val($("#c_al1").val());
			$("#lq_2").val($("#c_al2").val());
			$("#lq_3").val($("#c_al3").val());
			$("#lq_4").val($("#c_al4").val());
			break;
		case 'office':
			if(!isPickPointSelected) p.selectedIndex=2;
			$("#landMark").val($("#o_landMark").val());
			$("#lq_1").val($("#o_al1").val());
			$("#lq_2").val($("#o_al2").val());
			$("#lq_3").val($("#o_al3").val());
			$("#lq_4").val($("#o_al4").val());
			break;
		case 'residence':
			if(!isPickPointSelected) p.selectedIndex=1;
			$("#landMark").val($("#r_landMark").val());
			$("#lq_1").val($("#r_al1").val());
			$("#lq_2").val($("#r_al2").val());
			$("#lq_3").val($("#r_al3").val());
			$("#lq_4").val($("#r_al4").val());
			break;
	}
}

function pickPointSelected(){
	isPickPointSelected = true;
	$("#testValues").html("Selected");
}

function loadSubArea(val){
	var subA = $.ajax({
				url: '../master/php/load-sub-area.php',
				type: 'POST',
				data: {parent: val},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#childArea").html(data);
	});
}

var keepPopup = false;
function keepAlive(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}

function setVisibility(obj, id, visibility) {
	if(keepPopup) return;
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
	if(oTop>$(document).height()-50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}

function saveForm(){
	var sendArr = $("#frmCreateBooking").serialize();
	var saveFrm = $.ajax({
							url: '../master/php/booking-form-save.php',
							type: 'GET',
							data: sendArr,
							dataType: "html",
							cache: false
						});
		saveFrm.done(function(data, textStatus, jqXHR){
			alertDisp('Successfully saved','statusType-info');
		});
		saveFrm.fail(function(data, textStatus, jqXHR){
			alertDisp('Unable to save data!','statusType-error');
		});
}
$("#frmCreateBooking").submit(function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});
</script>
<form method="post" name="frmCreateBooking" action="../master/php/booking-form.php" id="frmCreateBooking">
<table width="100%" border="0" class="main-home-frame" id="product-table">
    <tr>
        <th colspan="20" class="table-header-repeat">
            -: New Booking Form :-
        </th>
    </tr>
<tr><td colspan="4" valign="top" align="center"> 
<?php
if($countCust == 0){
	//do nothing
}else{
	$curDate = date("Y-m-d");
	//echo "SELECT * FROM `book_master` WHERE `cust_id` = $cuId AND date_format(CONCAT_WS(' ',`required_date`,`required_time`),'%Y-%m-%d %H:%i:%s') > current_timestamp()";
$sqlBok = mysql_query("SELECT * FROM `book_master` WHERE `cust_id` = $cuId AND DATE_FORMAT(`required_date`, '%Y-%m-%d') >= '$curDate'");
 if(mysql_error()){
	 //echo 'here';
 }else{
  $i = 1;
     $countBok = mysql_num_rows($sqlBok);
	 if($countBok == 0){
		//echo 'No Record';
	 }else{
		  echo '
	 <table width="100%" border="0">
	  <tr>';
	  if($empType == 1 || $empType == 6){
		echo '<th class="table-header-repeat">Sl No.</th>';
	  }
	  echo'
		<th class="table-header-repeat">Order No.</th>
        <th class="table-header-repeat">Time</th>
        <th class="table-header-repeat">Date</th>
        <th class="table-header-repeat">Location</th>
		<th class="table-header-repeat">Cab Code</th>
		<th class="table-header-repeat">Driver</th>
		<th class="table-header-repeat">Status</th>
		
	  </tr>';
	  while($rowsBok = mysql_fetch_array($sqlBok)){
		  $bid = $rowsBok['booking_id'];
                  $boCode = $rowsBok['booking_code'];
                  
	$sqlApp = mysql_query("SELECT * FROM `app_log` WHERE ( `al_log_type` = 'DIS' OR `al_log_type` = 'CEL' OR `al_log_type` = 'BOK')  AND `al_log_code` = '$boCode'");
	if(mysql_error()){
		$disTime = "";
	}else{
		$roApp = mysql_fetch_assoc($sqlApp);
	}
       $stau = $rowsBok['status'];
		   $t = $i++;
		   echo '<tr align="center" ';
		   
			if($stau == 1){
				echo 'class="blue"';
			}
			elseif($stau == 2){
				echo 'class="green"';
			}
			else{
				echo 'class="redM"';
			}
			
			echo '>';
	if($empType == 1 || $empType == 6){
	 echo '<td width="7%">'.$t.'</td>';
  }else{
  }
  echo'
    <td>'.$rowsBok['booking_code'];
	echo '<br>';
	$emId = $roApp['al_emp_id'];
	$sqlEmp = mysql_query("SELECT username FROM `employee` WHERE `emp_id` = $emId");
	if(mysql_error()){
		echo '-';
	}else{
		$roEmp = mysql_fetch_assoc($sqlEmp);
		echo $roEmp['username'];
	}
	echo '</td>
             <td>'.$rowsBok['required_time'].'</td>
    <td>'.$rowsBok['required_date'].'</td>
   <td>';
	$p = $t;
	$piUp = $rowsBok['pickup_point'];
	?>
    <a href="#" onClick="keepAlive(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $p; ?>', 'none');">
    <?php
	$areIdh = strpbrk($piUp,"+");
        $areId =  substr($areIdh,1);
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$areId' AND `status` = 1");
	if(mysql_error()){
		echo 'Not Found!';
	}else{
		$roAre = mysql_fetch_assoc($sqlAre);
		echo $roAre['area_name'];
	}
	?>
    </a>
      <div id="sub1<?php echo $p; ?>" class="popup">
        <?php
		$sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$cuId'");
		$sqlMas = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cuId'");
		if(mysql_error()){
			//do nothing
		}else{
			$rop = mysql_fetch_assoc($sqlAdd);
			$rl = mysql_fetch_assoc($sqlMas);
			echo '<table width="100%"><tr class="row-active"><td>Mobile:</td><td>'.$rl['mobile'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Alt Mobile:</td><td>'.$rl['alt_mobile'].'</td></tr>';
			echo '<tr class="row-inactive"><td>Phone No:</td><td>'.$rl['phone_no'].'</td></tr>';
			echo '<tr class="row-active"><td>Address</td><td>';
			$ppO = $rowsBok['pickup_point'];
			$adt = explode("+",$ppO);
			echo current($adt);
			echo '</td></tr></table>';
		}
		?>
        </div>
    <?php
	echo '</td>
    <td>';
	$cabId = $rowsBok['cab_id'];
	$sqlCab = mysql_query("SELECT `cab_id`,`cab_code`,`cab_type`,plate_no FROM `cabs` WHERE `cab_id` = '$cabId'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roCab = mysql_fetch_assoc($sqlCab);
		echo $roCab['cab_code'].'<br>'.$roCab['plate_no'];
	}
	echo '</td>
    <td>';
	$drId = $rowsBok['driver_id'];
	$sqlDrv = mysql_query("SELECT `driver_id`,`driver_name`,`alt_mobile_no`,`mobile_no`,`email`,`phone_no` FROM `drivers` WHERE `driver_id` = '$drId'");
	if(mysql_error()){
		echo '<strong>-</strong>';
	}else{
		$roDr = mysql_fetch_assoc($sqlDrv);
		echo $roDr['driver_name'].'<br>'.$roDr['mobile_no'];
	}
	   echo' </td>
    
    
        <td>';
		$disTime = $roApp['al_date'];
	$satu = $rowsBok['status'];
	if($satu == 1){
		echo 'Waiting';
	}elseif($satu == 2){
		echo 'Dispatched';
	}
	elseif($satu == 3){
		echo 'Cancelled';
	}
	echo '<br><em style="color:#fff;">Time '.substr($disTime,11).'</em>';
	echo '</td>
  </tr>';
	  }//while close
	  echo '</table>';
	 }
    }//else close
}
?>
</td></tr>

<tr>
    <td colspan="20" align="left">
        <span style="float:left;">
            Revenue :
        <?php
        $PassDate = date('Y-m');
        $sqlBokDis = mysql_query("SELECT * FROM `book_master` WHERE `cust_id` = $cuId AND `status` = '2' AND DATE_FORMAT(`required_date`, '%Y-%m') >= '$PassDate'");
        $countBokDis = mysql_num_rows($sqlBokDis);
        
        
        if($countBokDis < 10){
            $rateCust = "1";
        }
        elseif($countBokDis < 20){
           $rateCust = "2"; 
        }
        elseif($countBokDis < 30){
           $rateCust = "3"; 
        }
        elseif($countBokDis < 40){
           $rateCust = "4"; 
        }
        elseif($countBokDis < 50){
           $rateCust = "5"; 
        }
        else{
          $rateCust = "0";  
        }
       $sqlRaup = mysql_query("UPDATE `cust_master` SET `rate` = '$rateCust' WHERE `cust_id` = '$cuId'");
       //$sqlRateRead = mysql_fetch_();
            $sut = $roCust['rate'];
		if($sut == 0){
			$retHtml = '<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />';
		}
                elseif($sut == 1){
                    $retHtml = '<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />';
                }
                elseif($sut == 2){
                    $retHtml = '<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />';
                }
                elseif($sut == 3){
                    $retHtml = '<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />';
                }
                elseif($sut == 4){
                    $retHtml = '<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sblank.png" width="16" height="16" />';
                }
                elseif($sut == 5){
                    $retHtml = '<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />
								<img src="images/sactive.png" width="16" height="16" />';
                }
                else{
			$retHtml = '<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />
						<img src="images/sblank.png" width="16" height="16" />';
		}
                echo $retHtml;
                if($retHtml !=0){
                    $sqlRaup = mysql_query("UPDATE `cust_master` SET `rate` = '$retHtml' WHERE `cust_id` = '$cuId'");
                }
                
        ?>
        </span>
        <span style="float:right;">
            Total No of Active Booking is : 
            <?php
            
            echo $countBokDis;
            //echo '-'.$cuId;
            ?>&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
    </td>
</tr>

  <tr class="row-inactive">
    <td>Customer Name <div id="testValues" style="display:none;">Test</div></td>
    <td><input type="text" name="custName" value="<?php if($countCust == 0){}else{echo $cusName;} ?>" class="required"/></td>
    <td>Booking Type</td>
    <!--<td><select name="CustType" onchange="toggleIndirectBooking(this.value);">-->
	<td><select name="CustType">
    <option value="0">Direct Booking</option>
    <option value="1">Indirect Booking</option>
    </select>
    </td>
     <tr class="row-active donotshow" id="indirectBk1">
        <td>Organization Name :</td>
        <td><input name="comp" type="text" class="input" /></td>
        <td>Contact Person Name:</td>
        <td><input name="coname" type="conam" class="input" id="coname" /></td>
	</tr>
    <tr class="row-inactive donotshow" id="indirectBk2">
        <td>Contact No.</td>
        <td><input name="cono" type="text" class="input" placeholder="**********" /></td>
        <td>E-mail Address</td>
        <td><input name="coemil" type="text" placeholder="example@someone.com" class="email"  /></td>
    </tr>
  <tr class="row-active">
    <td><input type="hidden" name="MO" value="0" />
    <input type="checkbox" <?php if($ty == "P"){}else{echo 'checked="true"';} ?> name="MO" value="1" id="mob_num"/><label for="mob_num">Mobile Number</label></td>
    <td><input type="text" name="custMob" value="<?php if($countCust == 0){if($ty == "M"){echo $no;}}else{ echo $roCust['mobile'];} ?>" maxlength="10" class="number"   /></td>
    <td>
    <input type="hidden" name="EM" value="0" />
    <input type="checkbox" checked="true" name="EM" value="1" id="email_addr"/><label for="email_addr">Email Address</label></td>
    <td><input type="text" name="CustEmail" placeholder="example@someone.com" class="email" value="<?php if($countCust == 0){}else{echo $email;} ?>" /></td>
  </tr>
  <tr class="row-inactive">
     <td>
	 <input type="hidden" value="<?php if($countCust == 0){ echo "BLNK";}else{echo $cuId;} ?>" name="custId" />
     <input type="hidden" name="AMO" value="0" />
     <input type="checkbox" name="AMO" value="1" id="alt_num"/><label for="alt_num">Alternate Number</label></td>
    <td><input type="text" name="custAltMob" value="<?php if($countCust == 0){}else{echo $cusAlMob;} ?>" maxlength="10" class="number" /></td>
    <td>
    <input type="hidden" name="EMA" value="0" />
    <input type="checkbox" name="EMA" value="1" id="alt_email" /><label for="alt_email">Alternate Email</label></td>
    <td><input type="text" name="CustEmailAlt" placeholder="example@someone.com" value="<?php if($countCust == 0){}else{echo $alt_email;} ?>" /></td>
  </tr>
  <tr class="row-active">
     <td>Phone Number</td>
    <td><input type="text" name="custPh" value="<?php if($countCust == 0){if($ty == "P"){echo $no;}}else{echo $phone_no;} ?>" maxlength="20"    /></td>
    <td>Service Type:</td>
    <td>
    <select name="srvType" onchange="toggleEndDate(this.value);">
    <?php
	$sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `status` = 1");
	if(mysql_error()){
		echo '<option value="0">No Record Found</option>';
	}else{
		while($rows = mysql_fetch_assoc($sqlSrv)){
			echo '<option value="'.$rows['service_id'].'">'.$rows['service_type'].'</option>';
		}
	}
	?>
    </select>
    </td>
  </tr>
  <tr class="row-inactive">
    <td>Pickup Point </td>
    <td>
    <select id="pickupPnt" name="pickUp" class="required" onclick="pickPointSelected();" onchange="loadSubArea(this.value);">
    <?php
	$noAreaCur = false;
	$noAreaOff = false;
	$noAreaRes = false;
	if($countCust == 0){
		echo '<option value="">Select Pickup Point</option>'; //397 - ID for unspecified location
	}else{
		$sqlMan = mysql_query("SELECT * FROM `area` WHERE `area_id` = $current  AND `status` = 1");
		if($sqlMan == FALSE){
			echo '<option value=""></option>';
			$noAreaCur = true;
		}else{
			$roAc = mysql_fetch_assoc($sqlMan);
			echo '<option value="'.$roAc['area_id'].'">'.$roAc['area_name'].'</option>';
		}
		//for residence
		$sqlMan2 = mysql_query("SELECT * FROM `area` WHERE `area_id` = $rece  AND `status` = 1" );
		if($sqlMan2 == FALSE){
			echo '<option value=""></option>';
			$noAreaRes = true;
		}else{
			$roAc2 = mysql_fetch_assoc($sqlMan2);
			echo '<option value="'.$roAc2['area_id'].'">'.$roAc2['area_name'].'</option>';
		}
		
		//for office
		$sqlMan3 = mysql_query("SELECT * FROM `area` WHERE `area_id` = $office  AND `status` = 1");
		if($sqlMan3 == FALSE){
			echo '<option value=""></option>';
			$noAreaOff = true;
		}else{
			$roAc3 = mysql_fetch_assoc($sqlMan3);
			echo '<option value="'.$roAc3['area_id'].'">'.$roAc3['area_name'].'</option>';
		}
	}
	if($noAreaCur == false AND $noAreaOff==false AND $noAreaRes==false)
		$noAreaFound = true;
	else
		echo '<option disabled>---------------------------------</option>';
	$sqlAre = mysql_query("SELECT * FROM `vw_area` WHERE `status` = 1");
	if(mysql_error()){
		echo '<option value="397">No Record Found</option>';
	}else{
		while($roAre = mysql_fetch_assoc($sqlAre)){
			echo '<option value="'.$roAre['area_id'].'">'.$roAre['area_name'].'</option>';
		}
	}
	?>
    </select>
    </td>
    <td>Drop Point</td>
    <td><select name="dropUp" class="sel">
      <?php
	echo '<option value="397">Select Dropup Point</option>';
	$sqlAre = mysql_query("SELECT * FROM `vw_area` WHERE `status` = 1");
	if(mysql_error()){
		echo '<option value="397">No Record Found</option>';
	}else{
		while($roAre = mysql_fetch_assoc($sqlAre)){
			echo '<option value="'.$roAre['area_id'].'">'.$roAre['area_name'].'</option>';
		}
	}
	?>
    </select></td>
  </tr>
  <tr>
    <td>Sub Area</td>
    <td>
    <select id="childArea">
    <option disabled>Select Pickup Location</option>
    </select>
    </td>
  <td>Req Date</td>
  <td><input type="text" name="rdate" id="f_date_c" value="<?php echo $date; ?>" readonly/>
    <em>YYYY-MM-DD</em>
    <script language="JavaScript" type="text/javascript">
		$( "#f_date_c" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: 0,
			maxDate: "+1M +60D"
		});
    </script></td></tr>
  <tr>
    <td>Req. Time</td>
    <td><label for="input_time">
    <input name="rtime" type="text" class="text input_mask mask_time" id="input_time" onFocus="fnErase(this);" onChange="fnReqTimeEdit();" onBlur="formatTime(this); fnRestoreReqTime(this);" value="<?php echo $time; ?>"/>   <em>24 Hrs. Format.</em>
      </label></td>
    <td class="donotshow" id="endDate1">End Date</td>
    <td class="donotshow" id="endDate2"><input type="text" id="f_date_b" name="edate" value="<?php echo "0000-00-00"; ?>" /><em>YYYY-MM-DD</em>
    <script language="javascript">
		$( "#f_date_b" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: 0,
			maxDate: "+1M +60D"
		});
</script>
    </td>
  </tr>
  <tr class="row-active">
      <td><input type="radio" name="PP" value="3" id="opResi"/><label for="opResi">Residence</label></td>
      
      <td><input type="radio" name="PP" value="1" id="opOff" /><label for="opOff">Office</label></td>
	<td>
            <input type="radio" name="PP" value="2" checked="true" id="opCurr" /><label for="opCurr">Current</label></td>
  
    <td>Selected Pickup Point</td>
  </tr>
  <tr class="row-inactive">
   <td>
		<textarea cols="22" rows="3" id="locResi" name="recedn" onfocus="selectPickPoint('residence')" onchange="updatePoint(this,'R');"><?php if($coAdd == 0){}else{echo $res_address;} ?></textarea>
		<br /><em>You have <span id="counter1"></span> characters left.</em>
	</td>
	<td>
		<textarea cols="22" rows="3" id="locOff" name="office" onfocus="selectPickPoint('office')" onchange="updatePoint(this,'O');"><?php if($coAdd == 0){}else{echo $off_address;} ?></textarea>
		<br /><em>You have <span id="counter2"></span> characters left.</em>
	</td>
	<td>
		<textarea cols="22" rows="3" name="current" id="locCurr" onfocus="selectPickPoint('current')" onchange="updatePoint(this,'C');"><?php if($coAdd == 0){}else{echo $cur_address;} ?></textarea>
		<br /><em>You have <span id="counter3"></span> characters left.</em>
	</td>
    <td><textarea cols="22" rows="3" id="locPickup" name="finalPickUp" readonly="readonly"></textarea></td>
  </tr>
  <tr class="row-active">
    <td>Requirement </td>
    <td><input type="text" name="req" value="<?php if($countCust == 0){}else{echo $requ;} ?>" /></td>
    <td>Land Mark </td>
    <td><input type="text" name="lm" id="landMark"/></td>
  </tr>
  <tr class="row-inactive">
    <td>Type of Cab.</td>
    <td><select name="typeCab">
      <?php
	$sqlTypeCab = mysql_query("SELECT * FROM `cab_types` WHERE `status` = 1 ORDER BY `cab_type_code`");
	if(mysql_error()){
		echo '<option value="0">No Record Found</option>';
	}else{
		while($roTyCa = mysql_fetch_assoc($sqlTypeCab)){
                    $cbTypeId = $roTyCa['cab_type_id'];
                    if($cbTypeId == "24" || $cbTypeId == "19" || $cbTypeId == "1"){
                        
                    }else{
			echo '<option value="'.$roTyCa['cab_type_id'].'">'.$roTyCa['cab_type_name'].'</option>';
                    }
		}
	}
	?>
    </select></td>
    <td>Location Qualifier - 1</td>
    <td><input type="text" name="lq1" id="lq_1"/></td>
  </tr>
  <tr class="row-active">
    <td>No. Cab :</td>
    <td><input name="noCab" type="text" value="1" size="10"  /></td>
    <td>Location Qualifier - 2</td>
    <td><input type="text" name="lq2" id="lq_2"/></td>
  </tr>
  <tr class="row-inactive">
    <td>Payment Mode :</td>
    <td><select name="pmo" id="pmo">
      <option value="1">Cash</option>
      <!--<option value="2">Cheque</option>
      <option value="3">Credit</option> -->
	  <option value="3">Credit Card</option>
    </select></td>
    <td>Location Qualifier - 3</td>
    <td><input type="text" name="lq3" id="lq_3"/></td>
  </tr>
  <tr class="row-active">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Location Qualifier - 4</td>
    <td><input type="text" name="lq4" id="lq_4"/></td>
  </tr>
  <tr class="row-inactive">
    <td colspan="4">Comment <em>MAX 250 Characters.</em></td>
  </tr>
  <tr class="row-active">
    <td colspan="4">
		<textarea name="comment" id="comment" style="width:100%; height:50px;"></textarea>
		<br /><em>You have <span id="counter4"></span> characters left.</em>
    </td>
  </tr>
  <tr class="row-inactive">
    <!--<td colspan="4" align="right"><input type="submit" class="myButton" value="Book Cab Now" /></td>-->
	<td><input type="button" value="Save" class="myButton" onClick="saveForm();"/></td><td colspan="2"></td><td align="right"><input type="submit" class="defaultButton" value="Book Cab Now" /></td>
  </tr>
</table>
</form>
<?php
if($countCust == 0){
	echo '<input type="hidden" id="new_cust_marker" value="1">';
}
elseif(isset($noAreaFound)){
	if($noAreaFound==true){
		echo '<input type="hidden" id="new_cust_marker" value="0">';
	}
}
else{
?>
<input type="hidden" id="new_cust_marker" value="0">
<input type="hidden" id="o_landMark" value="<?php echo $off_landmark; ?>"/>
<input type="hidden" id="o_al1" value="<?php echo $off_address_l1; ?>"/>
<input type="hidden" id="o_al2" value="<?php echo $off_address_l2; ?>"/>
<input type="hidden" id="o_al3" value="<?php echo $off_address_l3; ?>"/>
<input type="hidden" id="o_al4" value="<?php echo $off_address_l4; ?>"/>

<input type="hidden" id="r_landMark" value="<?php echo $res_landmark; ?>"/>
<input type="hidden" id="r_al1" value="<?php echo $res_address_l1; ?>"/>
<input type="hidden" id="r_al2" value="<?php echo $res_address_l2; ?>"/>
<input type="hidden" id="r_al3" value="<?php echo $res_address_l3; ?>"/>
<input type="hidden" id="r_al4" value="<?php echo $res_address_l4; ?>"/>

<input type="hidden" id="c_landMark" value="<?php echo $cur_landmark; ?>"/>
<input type="hidden" id="c_al1" value="<?php echo $cur_address_l1; ?>"/>
<input type="hidden" id="c_al2" value="<?php echo $cur_address_l2; ?>"/>
<input type="hidden" id="c_al3" value="<?php echo $cur_address_l3; ?>"/>
<input type="hidden" id="c_al4" value="<?php echo $cur_address_l4; ?>"/>
<?php
}
?>
<script language="javascript">
	$("#frmCreateBooking").validate();	
	var reqTime = '';
	var reqTimeChanged = false;
	function fnErase(obj){
		reqTime = obj.value;
		obj.value='';
	}
	function fnReqTimeEdit(){
		reqTimeChanged = true;
	}
	function fnRestoreReqTime(obj){
		if(reqTimeChanged){
			reqTimeChanged = false;
			return;
		}
		obj.value = reqTime;
	}
	
</script>