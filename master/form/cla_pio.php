<?php
/************************************************************
  This file give asscess for are code tracking 
 * example 80 is banglore std code just put this std code in if condition 
 * 
 *  * */

echo '<br><br>';
require_once "../../core/php/con-no-watch.php";
		
			$call = mysql_query("SELECT * FROM `upcoming_call` ORDER BY `time` DESC");
			$cn = mysql_num_rows($call);
			echo '<table width="200">';
			if($cn == 0){
				echo '<tr><td colspan="2" align="center"><img src="images/001_11.png" width="24" height="24" /><br>No Calls</td></tr>';
			}else{
				while($ro = mysql_fetch_assoc($call)){
				$conname = $ro['number'];
				$no = strlen($conname);
				if($no > 10){
					$nw = substr($conname,-10);
				}
				else{
					$nw = $conname;
				}
                                $chTy = substr($nw,0,2);
                                if($chTy == "80" || $chTy == "40" || $chTy == "22" || $chTy == "11"){
                                  $ty = "P";
                                }else{
                                    $ty = "M";
                                }
				$custo = mysql_query("SELECT * FROM `cust_master` WHERE `mobile` = '$nw' OR `alt_mobile` = '$nw' OR `phone_no` = '$nw'");
				$chk = mysql_num_rows($custo);
				if($chk == 0){
					echo "<tr>";
			    	echo '<td>
					<a href="#" id="../master/form/booking-form.php?ty='.$ty.'&no='.$nw.'" onClick="showMainAction(this.id)" style="color:#333;"><b>'.$nw.'</b></a></td>';
					echo '<td>'.$ro['time'].'</td>'; echo "</tr>";
          		}else{
					$fr = mysql_fetch_assoc($custo);
					echo "<tr>";
				echo '<td><a href="#" id="../master/form/booking-form.php?ty='.$ty.'&no='.$nw.'" onClick="showMainAction(this.id)" style="color:#333;"><b>'.$fr['cust_name'].'</b> </a></td>';
					echo '<td>'.$ro['time'].'</td>';
		  		echo "</tr>";
				}
		  		
			}
			
			}
			echo "</table>";
?>
