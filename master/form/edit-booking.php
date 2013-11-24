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

require_once "../../core/php/connection.php";
$date = date("Y-m-d");
$time = date("H:i:s");
$type = $_GET['type'];
$bid = substr($type,3);
$sqlOrder = mysql_query("SELECT * FROM `book_master` WHERE `booking_id` = '$bid'");
if(mysql_error()){
	echo 'ERROR: no Record Found!';
}else{
	$rowsOrd = mysql_fetch_assoc($sqlOrder);
	$cusId = $rowsOrd['cust_id'];
        $oldServiceType = $rowsOrd['service_type'];
        $oldPikupPoint = $rowsOrd['pickup_point'];
        //$oldPoint = substr($oldPikupPoint,0,1); //type of address[1=Office,2=Current,3=Residence]
        $oldPikupPoint = substr($oldPikupPoint,1);
        $oldReqTime = $rowsOrd['required_time'];
        $oldReqDate = $rowsOrd['required_date'];
        $oldEndDate = $rowsOrd['end_date'];
        $oldDropPoint = $rowsOrd['destination'];
        $oldCapType = $rowsOrd['cab_type'];
        $oldNumCabs = $rowsOrd['number_of_cab'];
        $oldPayMode = $rowsOrd['payment_mode'];
        $oldComments = $rowsOrd['remarks'];
$sqlCust = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$cusId'");

$countCust = mysql_num_rows($sqlCust);
if($countCust == 0){
	$coAdd = "";
	$current = 0;
}else{
	$roCust = mysql_fetch_assoc($sqlCust);
	$cusName = $roCust['cust_name'];
	$cusAlMob = $roCust['alt_mobile'];
	$cust_type = $roCust['cust_type'];
	$cust_no = $roCust['mobile'];
	$mobile = $roCust['mobile']; //check
	$phone_no = $roCust['phone_no'];
	$email = $roCust['email'];
	$alt_email = $roCust['alt_email'];
	$cuId = $roCust['cust_id'];
	$office = $roCust['office'];
	$rece = $roCust['recedence'];
	$current = $roCust['current'];
	$requ = $roCust['requirement'];
        $areIdh = strpbrk($oldPikupPoint,"+");
        $areId =  substr($areIdh,1);
        
        if($areId == $office){
          $oldPoint = 1;  
        }elseif($areId == $rece){
            $oldPoint = 3;  
        }else{
         $oldPoint = 2;
        }
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
</script>
<form method="post" name="frmCreateBooking" action="../master/php/edit-boking.php" id="frmCreateBooking">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" />
<input type="hidden" name="custId" value="<?php echo $cusId; ?>" />
<table width="100%" border="0" class="main-home-frame" id="product-table">
  <tr class="row-inactive">
    <td>Customer Name </td>
    <td><input type="text" name="custName" value="<?php if($countCust == 0){}else{echo $cusName;} ?>" class="required"/></td>
    <td>Booking Type</td>
    <td><select name="CustType" onchange="toggleIndirectBooking(this.value);">
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
  </tr>
  <tr class="row-active">
    <td><input type="hidden" name="MO" value="0" />
    <input type="checkbox" checked="true" name="MO" value="1" />Mobile Number</td>
    <td><input type="text" name="custMob" value="<?php echo $cust_no; ?>" maxlength="10" class="required number" /></td>
    <td>
    <input type="hidden" name="EM" value="0" />
    <input type="checkbox" checked="true" name="EM" value="1" />Email Address</td>
    <td><input type="text" name="CustEmail" placeholder="example@someone.com" class="email" value="<?php if($countCust == 0){}else{echo $email;} ?>" /></td>
  </tr>
  <tr class="row-inactive">
     <td>
     <input type="hidden" name="AMO" value="0" />
     <input type="checkbox" name="AMO" value="1" />Alternet Number</td>
    <td><input type="text" name="custAltMob" value="<?php if($countCust == 0){}else{echo $cusAlMob;} ?>" maxlength="10" class="number" /></td>
    <td>
    <input type="hidden" name="EMA" value="0" />
    <input type="checkbox" name="EMA" value="1" />Alternet Email</td>
    <td><input type="text" name="CustEmailAlt" placeholder="example@someone.com" value="<?php if($countCust == 0){}else{echo $alt_email;} ?>" /></td>
  </tr>
  <tr class="row-active">
     <td>Phone Number</td>
    <td><input type="text" name="custPh" value="<?php echo $phone_no; ?>" /></td>
    <td>Service Type:</td>
    <td>
    <select name="srvType" onchange="toggleEndDate(this.value);">
    <?php
	//fetch service type from book_master
        
        $sqlSrv = mysql_query("SELECT * FROM `service_type` WHERE `status` = 1");
	if(mysql_error()){
		echo '<option value="0">No Record Found</option>';
	}else{
		while($rows = mysql_fetch_assoc($sqlSrv)){
                    if($oldServiceType == $rows['service_id'])
                        echo '<option value="'.$rows['service_id'].'" selected="true">'.$rows['service_type'].'</option>';
                    else
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
		$sqlMan = mysql_query("SELECT * FROM `area` WHERE `area_id` = $current");
                //echo '<option value="">'.$oldPoint.'-'.$oldPikupPoint.'</option>';
		if($sqlMan == FALSE){
			echo '<option value=""></option>';
			$noAreaCur = true;
		}else{
                     $areIdh = strpbrk($oldPikupPoint,"+");
                     $areId =  substr($areIdh,1);
			$roAc = mysql_fetch_assoc($sqlMan);
                        if($areId==$roAc['area_id'])
                            echo '<option value="'.$roAc['area_id'].'" selected="true">'.$roAc['area_name'].'</option>';
                        else
                            echo '<option value="'.$roAc['area_id'].'">'.$roAc['area_name'].'</option>';
		}
		//for residence
		$sqlMan2 = mysql_query("SELECT * FROM `area` WHERE `area_id` = $rece");
		if($sqlMan2 == FALSE){
			echo '<option value=""></option>';
			$noAreaRes = true;
		}else{
                    $areIdh = strpbrk($oldPikupPoint,"+");
                     $areId =  substr($areIdh,1);
			$roAc2 = mysql_fetch_assoc($sqlMan2);
                        if($areId==$roAc2['area_id'])
                            echo '<option value="'.$roAc2['area_id'].'" selected="true">'.$roAc2['area_name'].'</option>';
                        else
                            echo '<option value="'.$roAc2['area_id'].'">'.$roAc2['area_name'].'</option>';
		}
		
		//for office
		$sqlMan3 = mysql_query("SELECT * FROM `area` WHERE `area_id` = $office");
		if($sqlMan3 == FALSE){
			echo '<option value=""></option>';
			$noAreaOff = true;
		}else{
                    $areIdh = strpbrk($oldPikupPoint,"+");
                     $areId =  substr($areIdh,1);
			$roAc3 = mysql_fetch_assoc($sqlMan3);
                        if($areId==$roAc3['area_id'])
                            echo '<option value="'.$roAc3['area_id'].'" selected="true">'.$roAc3['area_name'].'</option>';
                        else
                            echo '<option value="'.$roAc3['area_id'].'">'.$roAc3['area_name'].'</option>';
		}
	}
	if($noAreaCur == false AND $noAreaOff==false AND $noAreaRes==false)
		$noAreaFound = true;
	else
		echo '<option disabled>---------------------------------</option>';
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `status` = 1 ORDER BY `area_name`");
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
	echo '<option value="">Select Dropup Point</option>';
	$sqlAre = mysql_query("SELECT * FROM `area` WHERE `status` = 1 ORDER BY `area_name`");
	if(mysql_error()){
		echo '<option value="">No Record Found</option>';
	}else{
		while($roAre = mysql_fetch_assoc($sqlAre)){
                        if($oldDropPoint==$roAre['area_id'])
                            echo '<option value="'.$roAre['area_id'].'" selected="true">'.$roAre['area_name'].'</option>';
                        else
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
  <td>Req. Date</td>
  <td><input type="text" name="rdate" id="f_date_c" value="<?php echo $oldReqDate; ?>" />
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
    <input name="rtime" type="text" class="text input_mask mask_time" id="input_time" onClick="erase(this);" onBlur="formatTime(this);" value="<?php echo $oldReqTime; ?>"/>   <em>24 Hrs. Format.</em>
      </label></td>
      <?php
      if($oldServiceType == 5 || $oldServiceType == 6){
      ?>
    <td  >End Date</td>
    <td  >
        <input type="text" id="f_date_k" name="edate" value="<?php echo $oldEndDate; ?>" /><em>YYYY-MM-DD</em>
    <script language="javascript">
		$( "#f_date_k" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: 0,
			maxDate: "+1M +60D"
		});
</script>
    </td>
    <?php } ?>
  </tr>
  <tr class="row-active">
  <td><input type="radio" name="PP" value="3" id="opResi" <?php if($oldPoint==3){echo 'checked="true"';} ?>/>
    Residence</td>
      
    <td><input type="radio" name="PP" value="1" id="opOff" <?php if($oldPoint==1){echo 'checked="true"';} ?>/>
      Office</td>
	<td>
    <input type="radio" name="PP" value="2" id="opCurr" <?php if($oldPoint==2){echo 'checked="true"';} ?>/>
      Current</td>
  
    <td>Selected Pickup Point is</td>
  </tr>
  <tr class="row-inactive">
   <td><textarea cols="22" rows="3" id="locResi" name="recedn" onfocus="selectPickPoint('residence')" onchange="updatePoint(this,'R');"><?php if($coAdd == 0){}else{echo $res_address;} ?></textarea></td>
  <td><textarea cols="22" rows="3" id="locOff" name="office" onfocus="selectPickPoint('office')" onchange="updatePoint(this,'O');"><?php if($coAdd == 0){}else{echo $off_address;} ?></textarea></td>
   <td><textarea cols="22" rows="3" name="current" id="locCurr" onfocus="selectPickPoint('current')" onchange="updatePoint(this,'C');"><?php if($coAdd == 0){}else{echo $cur_address;} ?></textarea></td>
    <td><textarea cols="22" rows="3" id="locPickup" name="finalPickUp" readonly="readonly"></textarea></td>
  </tr>
  <tr class="row-active">
    <td>Rrequirement </td>
    <td><input type="text" name="req" value="<?php if($countCust == 0){}else{echo $requ;} ?>" /></td>
    <td>Land Mark </td>
    <td><input type="text" name="lm" id="landMark"/></td>
  </tr>
  <tr class="row-inactive">
    <td>Type of Cab</td>
    <td><select name="typeCab">
      <?php
	$sqlTypeCab = mysql_query("SELECT * FROM `cab_types` WHERE `status` = 1 ORDER BY `cab_type_code`");
	if(mysql_error()){
		echo '<option value="0">No Record Found</option>';
	}else{
		while($roTyCa = mysql_fetch_assoc($sqlTypeCab)){
                        if($oldCapType==$roTyCa['cab_type_id'])
                            echo '<option value="'.$roTyCa['cab_type_id'].'" selected="true">'.$roTyCa['cab_type_name'].'</option>';
                        else
                            echo '<option value="'.$roTyCa['cab_type_id'].'">'.$roTyCa['cab_type_name'].'</option>';
		}
	}
	?>
    </select></td>
    <td>Location Qualifier - 1</td>
    <td><input type="text" name="lq1" id="lq_1"/></td>
  </tr>
  <tr class="row-active">
    <td>Number of Cabs</td>
    <td><input name="noCab" type="text" value="<?php echo $oldNumCabs; ?>" size="10"  /></td>
    <td>Location Qualifier - 2</td>
    <td><input type="text" name="lq2" id="lq_2"/></td>
  </tr>
  <tr class="row-inactive">
    <td>Mode of Payment</td>
    <td><select name="pmo" id="pmo">
      <option value="1" <?php if($oldPayMode==1){echo ' selected="true"';} ?>>Cash</option>
      <!--<option value="2" <?php if($oldPayMode==2){echo ' selected="true"';} ?>>Cheque</option>-->
      <option value="3" <?php if($oldPayMode==3){echo ' selected="true"';} ?>>Credit Card</option>
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
    <input type="text" name="comment" style="width:780px; height:50px;" maxlength="250" value="<?php echo $oldComments; ?>"/>
    </td>
  </tr>
  <tr class="row-inactive">
    <td colspan="4" align="right"><input type="submit" class="myButton" value="Book Cab Now" /></td>
  </tr>
</table>
</form>
<?php
if($countCust == 0){
	echo '<input type="text" id="new_cust_marker" value="1">';
}
elseif(isset($noAreaFound)){
	if($noAreaFound==true){
		echo '<input type="text" id="new_cust_marker" value="0">';
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
}//else close
?>
<script language="javascript">
	$("#frmCreateBooking").validate();
        <?php
            if($oldPoint==1)
                echo '$("#opOff").click();';
            if($oldPoint==2)
                echo '$("#opCurr").click();';
            if($oldPoint==3)
                echo '$("#opResi").click();';
        ?>
        
        /*$("#opCurr").click(function(){
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
	});*/	
</script>