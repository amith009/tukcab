 <?php
/*
File Name: view-driver-record.php
Work and function: in this file user driver record and payment status
T=table name -> cabs
##########
Create date = 29 NOV 2011
Time: 04:58
Last Update:
Date: 28 NOV 2011
Time: 00:00
Author Name: amit kumar
*/
?>
<script type="text/javascript">
var keepPopup = false;
function keepAliveCab(obj,id){
	keepPopup = true;
	var o = document.getElementById(id);
	$(o).dblclick(function(){
		keepPopup = false;
		o.style.display='none';
	});
}

function setVisibilityCab(obj, id, visibility) {
	if(keepPopup) return;
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
        var oWidth = $(obj).width();
	if(oTop>$(document).height()-50)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
        //alert(point.left);
	$(o).css("top",oTop);
	$(o).css("left",point.left+oWidth);
	o.style.display = visibility;
}
</script>
<?php
require_once "../../core/php/connection.php";
$curentDate = date("Y-m-d");
session_start();
$empType = $_SESSION['EMP_TYPE'];
$type = $_GET['type'];

   if($type == "ALL"){
   $val = "";
   }else{
   
   $val = "AND location = ".$type;
   }
   
//pre fetch list of areas --Nilotpal
echo '<select name="area" id="areaEdit" style="display:none;">
      <option value="0">SELECT AREA</option>';
                    $are = mysql_query("SELECT * FROM `area` WHERE `status` = '1' ORDER BY  `area_name`");
                    $care = mysql_num_rows($are);
                    if($care == 0){
                        echo '<option>No Record Found</option>!';
                    }else{
                        while($ra = mysql_fetch_assoc($are)){
      echo '<option value="'.$ra['area_id'].'">'.$ra['area_name'].'</option>';
                        }//while close
                    }
echo '</select><input type="text" id="editTime" size="8" maxlength="8" style="display:none;"/>';
//Nilotpal :Ends
    
//$sqlFr = mysql_query("SELECT * FROM `free_cabs` WHERE `status` = 0 $val");
$sqlFr = mysql_query("SELECT a.* FROM free_cabs a,area b WHERE a.status=0 AND a.location=b.area_id $val ORDER BY b.area_name");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/alert.png" width="32" height="32"><br>No Record Found</div>';
}else{
	echo'<table width="100%" id="product-table">
				  <tr>
					<th class="table-header-repeat">Sl. No.</th>
					<th class="table-header-repeat">Cab Code</th>
					<th class="table-header-repeat">Cab Type</th>
					<th class="table-header-repeat">Model Year</th>
					<th class="table-header-repeat">Quick details</th>
					<th class="table-header-repeat">Opp.</th>
					<th class="table-header-repeat">Trips</th>
					<th class="table-header-repeat">Location</th>
					<th class="table-header-repeat">Time</th>
					<th class="table-header-repeat">Actions</th>
				  </tr>';
				  $i =1;
	while($rowCd = mysql_fetch_assoc($sqlFr)){
		 $t = $i++;
		 $cabId = $rowCd['cab_id'];
		//cab record
	    $sqlCr = mysql_query("SELECT * FROM `cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
		   if(mysql_error()){
			   echo '<div class="error_main"><img src="images/alert.png" width="32" height="32"><br>No Record Found</div>';
		   }else{
			$rowCab = mysql_fetch_assoc($sqlCr);
                        $cabCode = $rowCab['cab_code'];
			$sat = $rowCab['status'];
				echo '<tr ';
					   if($sat == 0){
						   echo 'class="block_rwo"';
					   }else{
						   if($t %2 == 0){
							   echo 'class="row-active"';
						   }else{
							   echo 'class="row-inactive"';
						   }
					   }
					
					  echo ' id="'.$rowCab['cab_code'].'_row">
					<td>'.$t.'</td>
					<td>';
                                         
                                          $cabCode = $rowCab['cab_code'];
                                          $passDate = date("Y-m");
                                            $sqlBaln = mysql_query("SELECT cp_balance FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m') = '$passDate' AND `cp_cab_code` = '$cabCode' ORDER BY `cp_cab_id` DESC");
                                             $contReco = mysql_num_rows($sqlBaln);   
                                          if($contReco == 0){
                                              $curMon = date("m")-1;
                                              $strCurMon = strlen($curMon);
                                              if($strCurMon == 1){
                                                $Mn = "0".$curMon;  
                                              }else{
                                                 $Mn = $curMon;
                                              }
                                              $LastDate = date('Y').'-'.$Mn;
                                              /** Last Month Blance*/
                                              $sqlLast = mysql_query("SELECT cp_balance FROM `cab_payment` WHERE DATE_FORMAT(`cp_payment_date`, '%Y-%m') = '$LastDate' AND `cp_cab_code` = '$cabCode' ORDER BY `cp_cab_id` DESC");
                                              
                                              if(mysql_error()){
                                                  echo mysql_error();
                                              }else{
                                              $rowsLast = mysql_fetch_assoc($sqlLast);
                                              $lastBal = $rowsLast['cp_balance'];
                                              
                                              /** Cab Call Center Charge **/
                                                  $sqlCc = mysql_query("SELECT cd_call_center_charge FROM `cab_deposite` WHERE `cd_cab_code` = '$cabCode'");
                                                  if(mysql_error()){
                                                      echo mysql_error();
                                                      exit();
                                                  }else{
                                                     $rowsCc = mysql_fetch_assoc($sqlCc); 
                                                     $ccAmnt = $rowsCc['cd_call_center_charge'];
                                                  } 
                                                  //** Final passamunt*/
                                                  $totalBaln = $lastBal+$ccAmnt;
                                              }
                                                  /** If record found in same month then show the current balance**/
                                                 }else{
                                                     
                                                     $rowsCur = mysql_fetch_assoc($sqlBaln);
                                                     $totalBaln = $rowsCur['cp_balance'];
                                                 }
                                          
                                          $tbl = $totalBaln;
                                                 if($tbl == "0.00"){
                                                    ?>
<a href="#" onClick="keepAliveCab(this,'sub3<?php echo $p+1; ?>');" onMouseOver="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'none');"><?php echo $rowCab['cab_code']; ?></a>
                                                    <?php
                                                 }else{
												  if($tbl >= $ccAmnt){
												  ?>
												  <a href="#" onClick="keepAliveCab(this,'sub3<?php echo $p+1; ?>');" onMouseOver="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'none');" style="color:#990000; font-weight: bold;"><?php echo $rowCab['cab_code']; ?></a>
												  <?php
												  }else{
                                                     ?>
<a href="#" onClick="keepAliveCab(this,'sub3<?php echo $p+1; ?>');" onMouseOver="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub3<?php echo $p+1; ?>', 'none');" style="color:#F88017; font-weight: bold;"><?php echo $rowCab['cab_code']; ?></a>
                                                     <?php
													 }
                                                 }
                                            ?>
                                                
                                            <?php
					echo '</td><td>';
						$cabTy = $rowCab['cab_type'];
						$sqlType = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `cab_type_id` = '$cabTy'");
						if($sqlType == TRUE){
							$rowTyp = mysql_fetch_assoc($sqlType);
							echo $rowTyp['cab_type_name'];
						}else{
							echo 'Not Assigned';
						}
						echo '</td>
					<td>'.$rowCab['mfd_year'].'</td>';
						$p = $t++;
						?>
			<td align="center">
					
                 <div id="sub1<?php echo $p; ?>" class="popup"> 
                          
                 <table width="100%">
                      <tr class="row-inactive"><td>Meter:</td><td>
                 <?php 
                  $ac = $rowCab['sticker']; 
					if($ac == 1){
						echo $valAc = 'YES';
						$passArg7 = 0;
					}else{
						$passArg7 = 1;
						echo '<font style="color:red;">NO</font>';
					}
					
                 ?></td></tr>
                <tr class="row-active"><td>Sticker:</td><td>
                    <?php
                    $strm = $rowCab['sticker'];
                    if($strm == 1){
                        echo 'YES';
						$passArg8 = 0;
                    }else{
                        echo '<font style="color:red;">NO</font>';
						$passArg8 = 1;
                    }
                 ?>
                   
                </td></tr>
                 <tr class="row-active">
            <td>Cab Top.</td>
            <td><?php $ctb = $rowCab['cabTop'];
                    if($ctb == 1){
                        echo 'YES';
						$passArg9 = 0;
                    }else{
                       echo '<font style="color:red;">NO</font>';
						$passArg9 = 1;
                    }
            ?></td>
          </tr>
                <tr class="row-inactive"><td>Model Year:</td><td>
				<?php echo $cabYear = $rowCab['mfd_year'];
						$curentYear = date("Y");
					 if(strtotime($cabYear) == strtotime($curentYear)){
                            
							$passYear = 1;
                        }else{
                           
							$passYear = 0;
                        }
				?>
				
				</td></tr>
                <tr class="row-active"><td>Insurance Exp:</td><td><?php   
                $insDate = $rowCab['insurance_exp_date'];
                       if(strtotime($insDate) <= strtotime($curentDate)){
                            echo '<font style="color:red;">'.$insDate.'</font>';
							$passArg1 = 1;
                        }else{
                            echo $insDate;
							$passArg1 = 0;
                        }
						//echo $at = strtotime($insDate) - strtotime($curentDate);
                ?></td></tr>
                <tr class="row-active"><td>Emin. Exp:</td><td><?php   
                $emnDate = $rowCab['eminExp'];
                        if(strtotime($emnDate) <= strtotime($curentDate)){
                            echo '<font style="color:red;">'.$emnDate.'</font>';
							$passArg2 = 1;
                        }else{
                            echo $emnDate;
							$passArg2 = 0;
                        }
                ?></td></tr>
                <tr  bgcolor="#ccc"><td colspan="2" align="center">Permit Expire Details:</td></tr>
                <?php
                    $sqlPerU = mysql_query("SELECT * FROM `cabroadpermit` WHERE `cabCode` = '$cabCode'");
                    if(mysql_error()){
                        echo '<tr><td colspan="2">No Record Found<td></tr>';
                    }else{
                        $roPret = mysql_fetch_assoc($sqlPerU);
                        
                        ?>
                <tr class="row-inactive"><td>National:</td><td><?php 
                $natDate = $roPret['roadPerExp'];
				if($natDate == "" || $natDate == "0000-00-00"){
					$passArg3 = 0;
				}else{
					if(strtotime($natDate) <= strtotime($curentDate)){
						echo '<font style="color:red;">'.$natDate.'</font>';
						$passArg3 = 1;
					}else{
						echo $natDate;
						$passArg3 = 0;
					}
				}
                ?></td></tr>
                <tr class="row-active"><td>State:</td><td><?php 
                $satDate = $roPret['rodSateExp'];
				if($satDate == "" || $satDate == "0000-00-00"){
					$passArg4 = 0;
				}else{
                if(strtotime($satDate) <= strtotime($curentDate)){
                    echo '<font style="color:red;">'.$satDate.'</font>';
					$passArg4 = 1;
                }else{
                    echo $satDate;
					$passArg4 = 0;
                }
				}
                ?></td></tr>
                <tr class="row-inactive"><td>Tirupati:</td><td><?php 
				
                $trDate = $roPret['rodTriuExp'];
				if($trDate == "" || $trDate == "0000-00-00"){
					$passArg5 = 0;
				}else{
					if(strtotime($trDate) <= strtotime($curentDate)){
						echo '<font style="color:red;">'.$trDate.'</font>';
						$passArg5 = 1;
					}else{
						echo $trDate;
						$passArg5 = 0;
					}
				}
                ?></td></tr>
                <tr class="row-active"><td>Road Tax:</td><td><?php 
                $taxDate = $roPret['taxExp'];
				if($taxDate == "0000-00-00" || $taxDate == ''){
				$passArg6 = 0;
				}else{
                if(strtotime($taxDate) <= strtotime($curentDate)){
                    echo '<font style="color:red;">'.$taxDate.'</font>';
					$passArg6 = 1;
                }else{
                    echo $taxDate;
					$passArg6 = 0;
                }
				}
                ?></td></tr>
                   <?php
                    }
                   ?>
            </table>
			</div> 
			<?php
			$lastArg =  $passArg1+$passArg2+$passArg3+$passArg4+$passArg5+$passArg6+$passArg7+$passArg8+$passArg9;
			if($passYear == 1){
				echo '<img src="images/award_star_silver_3.png" alt="New Cab" width="12" height="12"/>';
			}else{
				echo '&nbsp;&nbsp;&nbsp;';
			}
			if($lastArg == 0){
				//permit faield
				?>
				<a href="#" onClick="keepAliveCab(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub1<?php echo $p; ?>', 'none');"><img src="images/access_permit_blue.png" alt="History" width="22" height="22"/></a>
				<?php
			}
			else{
			?>
			<a href="#" onClick="keepAliveCab(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub1<?php echo $p; ?>', 'none');"><img src="images/access_permit_red.png" alt="History" width="22" height="22"/></a>
		<?php
		}
		?>
		<!--Driver details goes here-->
				
		<div id="subD<?php echo $p; ?>" class="popup">
		<?php 
			
			$sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId'  AND `status` = 1");
			if($sqlDriv == TRUE){
				$roDass = mysql_fetch_assoc($sqlDriv);
				$drId = $roDass['driver_id'];
				 //get driver name 
				 $sqlDrDet = mysql_query("SELECT * FROM `drivers` WHERE `driver_id` = '$drId' AND `status` = 1");
				 if($sqlDrDet == TRUE){
					 $roDD = mysql_fetch_assoc($sqlDrDet);
					 if($sat == 0){
						 echo '-';
					 }else{
		?>
		<table width="100%" style="font-size:10px;">
           <tr><td rowspan="5" valign="top">
                   <?php $dimg = $roDD['image_file']; 
                   if(file_exists($dimg) || $dimg != ""){
                       echo '<img src="'.$dimg.'" width="80" height="90" />';
                   }else{
                       echo '<img src="images/user_png.png" width="80" height="90" />';
                   }
                   ?>
               </td><td colspan="2" class="row-active"><b style="font-size:12px;"><?php echo $roDD['driver_name']; ?></b></td></tr>
              <tr class="row-inactive"><td>DL Exp. Date:</td>
              <td><?php 
                $dlDate = $roDD['dl_exp_date'];
                if($dlDate <= $curentDate){
                    echo '<font style="color:red;">'.$dlDate.'</font>';
                }else{
                    echo $dlDate;
                }
                ?></td>
              </tr>
              <tr class="row-active"><td>Badge Exp. Date:</td>
              <td><?php 
                $badDate = $roDD['badge_exp_date'];
                if($badDate <= $curentDate){
                    echo '<font style="color:red;">'.$badDate.'</font>';
                }else{
                    echo $badDate;
                }
                ?></td>
              </tr>
              <tr class="row-inactive"><td>Languages Know:</td>
              <td><?php echo $roDD['insaurance_comp'];  //here insaurance_comp colon name indicate languages  
                ?></td>
              </tr>
       </table>
		   <?php
				}
			}
	   }
	   ?>
		</div>
&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		if($badDate <= $curentDate || $dlDate <= $curentDate){
		?>
		<a href="#" onClick="keepAliveCab(this,'subD<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'subD<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'subD<?php echo $p; ?>', 'none');"><img src="images/001_111.png" alt="Driver details" width="22" height="22"/></a>	
		<?php
		}else{
		?>		
		<a href="#" onClick="keepAliveCab(this,'subD<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'subD<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'subD<?php echo $p; ?>', 'none');"><img src="images/001_568.png" alt="Driver details" width="22" height="22"/></a>		
		<?php
		}
		?>
		</td> 
			 
			 <!-- history goes here-->
			 
			  <td align="center">
			  <?php
				 $cabFreeTime = strtotime($rowCd['time']) + 1800;
				 //date('H:i:s',$cabFreeTime);
				$currentTime = date('H:i:s');
				 if($cabFreeTime < strtotime($currentTime)){
                   //echo strtotime('+ 30 minute',$cabFreeTime);
				   $passArgTime = 1;
                }else{
                   $passArgTime = 0;
                }
				if($passArgTime == 1){
				?>
				<a href="#" onClick="keepAliveCab(this,'sub2<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'sub2<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub2<?php echo $p; ?>', 'none');"><img src="images/view_more_text_red.png" alt="History" width="16" height="16"/></a>
				<?php
				}else{
			  ?>
			 <a href="#" onClick="keepAliveCab(this,'sub2<?php echo $p; ?>');" onMouseOver="setVisibilityCab(this,'sub2<?php echo $p; ?>', 'inline');" onMouseOut="setVisibilityCab(this,'sub2<?php echo $p; ?>', 'none');"><img src="images/view_more_text.png" alt="History" width="16" height="16"/></a>
				<?php
				}
				?>
        <div id="sub2<?php echo $p; ?>" class="popup">
        <?php
        $date = date("Y-m-d");
         $sqlApp = "SELECT al_comment,al_emp_id,al_date,al_id FROM `app_log` WHERE `al_log_code` = $cabId AND `al_log_type` = 'AFC' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$date' ORDER BY `al_id` DESC";
        $result = mysql_query($sqlApp);
         if(mysql_error()){
            echo 'No Record Found!!';
        }else{
            echo '<table width="100%"><tr><th class="table-header-repeat">Name</th><th class="table-header-repeat">Area</th><th class="table-header-repeat">Time</th></tr>';
            while($rowApp = mysql_fetch_assoc($result)){
                $empId =  $rowApp['al_emp_id'];
                $sqlEmp = mysql_query("SELECT `username` FROM `employee` WHERE `emp_id` = $empId");
                if(mysql_error()){
                    echo 'Employee Record Not Found';
                }else{
                    $rowEmp = mysql_fetch_assoc($sqlEmp);
                    echo '<tr><td>'.$rowEmp['username'].'</td><td>';
                    $areId = $rowApp['al_comment'];
                    $sqlAre = mysql_query("SELECT area_name FROM `area` WHERE `area_id` = '$areId'");
                    if(mysql_error()){
                        echo $areId;
                    }else{
                        $rowAre = mysql_fetch_assoc($sqlAre);
                        echo $rowAre['area_name'];
                    }
                    echo '</td><td>';
                    echo substr($rowApp['al_date'],11,5);
                    echo '</td></tr>';
                }
            }
           echo '</table>';

        }
        ?>
        </div>
        </td>
<?php echo '<td>'; 
    $sqlCabTrips = mysql_query("SELECT bm.cab_id FROM `book_master` bm,`cabs` c WHERE `required_date` BETWEEN '".date("Y-m-d")."' AND '".date("Y-m-d")."' AND bm.status = 2 AND bm.cab_id=c.cab_id AND c.cab_code = '".$cabCode."'");
    echo mysql_num_rows($sqlCabTrips).'</td>';
?>
<div id="sub3<?php echo $p; ?>" class="popup" style="width: 200px;height: 50px;">
<?php
//assign driver tracking
//$cabId = $rowCab['cab_id'];
 $sqlDriv = mysql_query("SELECT cab_id,driver_id,status FROM `assigned_cabs` WHERE `cab_id` = '$cabId' AND `status` = 1");
                if($sqlDriv == TRUE){
                        $roDass = mysql_fetch_assoc($sqlDriv);
                        $drId = $roDass['driver_id'];
                         //get driver name 
                         $sqlDrDet = mysql_query("SELECT driver_id,driver_name,mobile_no FROM `drivers` WHERE `driver_id` = '$drId'");
                         if($sqlDrDet == TRUE){
                                 $roDD = mysql_fetch_assoc($sqlDrDet);
                                
                                 echo $roDD['driver_name'].'<br><strong>MOB:</strong>'.$roDD['mobile_no'];
                                 $empType = $_SESSION['EMP_TYPE'];
                                 
									if($tbl == "0.00"){
										 //do nothink
									 }else{
									echo '<br><b>BAL:</b><font style="color:#990000; font-size:16px;">'.$tbl.'</font>'; 
									 }
                                 
                         }else{
                                 echo '<table><tr><td>Record not found</td></tr></table>';
                         }
                }else{
                        echo 'Not Assigned';
                }
                //end here
                echo '</div>
                <td id="'.$rowCab['cab_code'].'_area">';
                $arId = $rowCd['location'];
                $sqlAre = mysql_query("SELECT area_id,area_name FROM `area` WHERE `area_id` = '$arId'");
                if($sqlAre == TRUE){
                        $roAre = mysql_fetch_assoc($sqlAre);
                        echo $roAre['area_name'];
                }else{
                        echo 'N/A';
                }
                echo '</td>
				<td id="'.$rowCab['cab_code'].'_time">'.$rowCd['time'].'</td>
				<td><a href="#" id="'.$rowCab['cab_code'].'_edit" onClick="inlineEdit(\''.$rowCab['cab_code'].'\');" title="Edit"><img src="images/001_45.png" alt="Edit" width="16" height="16"/></a>
				<a href="#" id="'.$rowCab['cab_code'].'_delete" onClick="inlineEditDelete(\''.$rowCab['cab_code'].'\');" title="Delete"><img src="images/delete_32.png" alt="Delete"/></a>
				<a href="#" style="display:none;" id="'.$rowCab['cab_code'].'_editAccept" onClick="inlineEditAccept(\''.$rowCab['cab_code'].'\');" title="Save"><img src="images/001_19.png" alt="Accept" width="16" height="16"/></a>
				<a href="#" style="display:none;" id="'.$rowCab['cab_code'].'_editReject" onClick="inlineEditReject(\''.$rowCab['cab_code'].'\');" title="Cancel"><img src="images/001_29.png" alt="Reject" width="16" height="16"/></a>
				  </td>
				</tr>';
}
		//end here
		
		}//while close
		echo '</table>';
	}
	
?>

<script language="javascript">
	var isEditActive = false;
	var cabElem = '';
	var oldCabVal = '';
	var areaList = document.getElementById('areaEdit');
	
	var cabTime = '';
	var cabOldTime = '';
	var cabTimeBox = document.getElementById('editTime');
	function inlineEdit(cabID){
		if(!isEditActive){
			isEditActive=true;
			cabElem = document.getElementById(cabID+'_area');
			cabTime = document.getElementById(cabID+'_time');
			oldCabVal = cabElem.innerHTML;
			cabOldTime = cabTime.innerHTML;
			areaList.selectedIndex = 0;
			cabElem.innerHTML='';
			cabTime.innerHTML='';
			//current time
			var currentTime = new Date()
			var hours = currentTime.getHours()
			if(hours<10){
				hours = "0"+hours;
			}
			var minutes = currentTime.getMinutes()
			if (minutes < 10){
				minutes = "0" + minutes
			}
			//current time: ends
			$(areaList).clone().attr('id',cabID+'_locSel').css("display","block").appendTo(cabElem);
			//$(cabTimeBox).clone().attr('id',cabID+'_timeSel').css('display','block').val(hours+":"+minutes+":00").appendTo(cabTime);
                        $(cabTimeBox).clone().attr('id',cabID+'_timeSel').css('display','block').val(cabOldTime).appendTo(cabTime);
			document.getElementById(cabID+'_edit').style.display='none';
			document.getElementById(cabID+'_delete').style.display='none';
			document.getElementById(cabID+'_editAccept').style.display='inline';
			document.getElementById(cabID+'_editReject').style.display='inline';
		}
		else{
			alertDisp('Please accept or discard the previous edit first.','statusType-error');
		}
		return false;
	}
	function inlineEditDelete(cabID){
		var delReason = '';
                var doDelete = false;
                while(true){
                    delReason = prompt("Please enter delete reason:");
                    if(delReason==null)
                        break;
                    if(delReason!=""){
                        doDelete=true;
                        break;
                    }
                }
                if(doDelete){
                    var request = $.ajax({
                            url:"../master/form/inline-delete-free-cabs.php",
                            type: "GET",
                            data: {id: cabID,reason: delReason},
                            dataType: "JSON"
                    });
                    request.done(function(data){
                            if(data.error){
                                    alert(data.error);
                                    return false;
                            }
                            isEditActive=false;
                            document.getElementById(cabID+'_edit').style.display='inline';
                            document.getElementById(cabID+'_delete').style.display='inline';
                            document.getElementById(cabID+'_editAccept').style.display='none';
                            document.getElementById(cabID+'_editReject').style.display='none';
                            if(data.success){
                                    $("#"+cabID+"_row").fadeOut("slow");
                                    alertDisp('Free cab updated.','statusType-info');
                            }else{
                                    alertDisp('Can not update cab status!','statusType-error');
                            }
                    });
                }
	}
	function inlineEditReject(cabID){
		isEditActive=false;
		cabElem.innerHTML = oldCabVal;
		cabTime.innerHTML = cabOldTime;
		document.getElementById(cabID+'_edit').style.display='inline';
		document.getElementById(cabID+'_delete').style.display='inline';
		document.getElementById(cabID+'_editAccept').style.display='none';
		document.getElementById(cabID+'_editReject').style.display='none';
	}
	function inlineEditAccept(cabID){
		var loc = $("#"+cabID+"_locSel").val();
		var time = $("#"+cabID+"_timeSel").val();
		if(loc==0){
			alertDisp('Please select an area to be updated!','statusType-error');
			return;
		}
		if(time==''){
			alertDisp('Please specify the time!','statusType-error');
			return;
		}
		if(!validateTime(time)){
			alertDisp('Invalid Time');
			return false;
		}
		var request = $.ajax({
			url:"../master/form/inline-update-free-cabs.php",
			type: "GET",
			data: {id: cabID,cabLoc: loc,cabTime: time},
			dataType: "JSON"
		});
		request.done(function(data){
			if(data.error){
				alert(data.error);
				return false;
			}
			isEditActive=false;
			cabElem.innerHTML = data.area;
			cabTime.innerHTML = data.time;
			document.getElementById(cabID+'_edit').style.display='inline';
			document.getElementById(cabID+'_delete').style.display='inline';
			document.getElementById(cabID+'_editAccept').style.display='none';
			document.getElementById(cabID+'_editReject').style.display='none';
		});
	}
	
function  validateTime(time){
	time = time.substring(0,5);
	// regular expression to match required time format
	re = /^(\d{1,2}):(\d{2})([ap]m)?$/;

	if(time != '') {
		if(regs = time.match(re)) {
			if(regs[3]) {
				// 12-hour value between 1 and 12
				if(regs[1] < 1 || regs[1] > 12) {
					return false;
			}
			} else {
				// 24-hour value between 0 and 23
				if(regs[1] > 23) {
					return false;
				}
			}
			// minute value between 0 and 59
			if(regs[2] > 59) {
				return false;
			}
		}
	}
	return true;
}
</script>