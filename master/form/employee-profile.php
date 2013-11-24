<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="4">
  <tr class="row-active">
    <td width="144" align="left" >Access Id:</td>
    <td width="260" align="left"><?php echo $code = $rows['username']; ?></td>
    <td width="206" align="left" >Password</td>
    <td width="330" align="left"><?php echo $rows['password']; ?></td>
  </tr>
  <tr class="row-active">
    <td align="left" >Name </td>
    <td align="left"><?php echo $rows['emp_name']; ?></td>
    <td align="left" >Type</td>
    <td align="left"><?php $acs = $rows['access_level'];
       $sqlAcce = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = '$acs'");
       if(mysql_error()){
           echo 'No Found!';
       }else{
           $rowsEmp = mysql_fetch_assoc($sqlAcce);
           echo $rowsEmp['access_type'];
       }
    ?></td>
  </tr>
  <tr class="row-inactive">
    <td align="left" >Mobile No.</td>
    <td align="left"><?php echo $rows['mobile_no']; ?></td>
    <td align="left" >Alternet Mobile. </td>
    <td align="left"><?php echo $rows['alt_number']; ?></td>
  </tr>
  <tr class="row-active">
  <td align="left" >Phone No.</td>
	<td align="left"><?php echo $rows['ph_number']; ?></td>
    <td align="left" >Reference Emp.Code </td>
    <td colspan="0" align="left"><?php echo $rows['reference']; ?></td>
  </tr>
  <tr class="row-inactive">
    <td align="left" >Sex</td>
    <td align="left"><?php $gen = $rows['gender'];
	if($gen == 1){
		echo 'Male';
	}else{
		echo 'Female';
	}
	 ?></td>
    <td align="left">Date of Birth</td>
    <td colspan="0" align="left"><?php echo $rows['dob']; ?></td>
  </tr>
   <tr class="row-active">
    <td align="left" >Email address</td>
    <td align="left"><?php echo $rows['email']; ?></td>
    <td align="left">Alternet Email address</td>
    <td colspan="0" align="left"><?php echo $rows['alt_email']; ?></td>
  </tr>
  <tr class="row-inactive">
    <td align="left" >Street 1</td>
    <td align="left"><?php echo $rows['emp_add1']; ?></td>
    <td align="left" >Street 2</td>
    <td align="left"><?php echo $rows['emp_add2']; ?></td>
  </tr>
  <tr class="row-active">
    <td align="left">City </td>
    <td align="left"><?php echo $rows['city']; ?></td>
    <td align="left" >State</td>
    <td align="left"><?php echo $rows['state']; ?></td>
  </tr>
  <tr class="row-inactive">
    <td align="left">Country </td>
    <td align="left"><?php echo $rows['country']; ?></td>
    <td align="left" >Pin </td>
    <td align="left"><?php echo $rows['zip']; ?></td>
  </tr>
  <tr class="row-active">
    <td align="left">Date of Joining </td>
    <td align="left"><?php echo $rows['doj']; ?></td>
    <td align="left" >Status </td>
    <td align="left"><?php $sat = $rows['emp_status']; 
    if($sat == 1){
        echo 'ACTIVE';
    }else{
        echo 'BLOCK';
    }
    ?></td>
  </tr>
   <tr class="row-inactive">
    <td align="left">Working Hrs. </td>
    <td align="left"><?php echo $rows['working_hrs']; ?></td>
    <td align="left" >&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> <td colspan="4"><strong>Sallery</strong>
  </td></tr>
  <tr class="row-active">
    <td colspan="4" valign="top" align="center">
    <?php
	$sqlSal = mysql_query("SELECT * FROM `employee_sallery` WHERE `emp_id` = '$code'");
	if(mysql_error()){
	echo '<tr><td colspan="8">Not Assign!</td></tr>';
	}else{
		?>
         <table width="100%" border="0" style="font-size:10px;">
  <tr>
    <th class="table-header-repeat">Sl.No.</th>
    <th class="table-header-repeat">Basic</th>
    <th class="table-header-repeat">VDA </th>
    <th class="table-header-repeat">HRA </th>
    <th class="table-header-repeat">PF </th>
    <th class="table-header-repeat">ESI </th>
    <th class="table-header-repeat">Vehicle</th>
    <th class="table-header-repeat">Mobile</th>
    <th class="table-header-repeat">Laptop</th>
    <th class="table-header-repeat">Bus Pass</th>
    <th class="table-header-repeat">Date</th>
  </tr>
        <?php
		$i = 1;
		while($roSal = mysql_fetch_assoc($sqlSal)){
			?>
  <tr align="center">
    <td><?php echo $i++; ?></td>
    <td><?php echo $basc = $roSal['basic']; ?></td>
    <td><?php echo $roSal['vda']; ?></td>
    <td><?php echo $roSal['hra']; ?></td>
    <td><?php 
		$pfCon= $roSal['pf'];
		if($pfCon == 1){
			echo 'YES';
		}else{
			echo 'NO';
	}
	 ?></td>
    <td><?php 
		$esiCon = $roSal['esi'];
		if($esiCon == 1){
			echo 'YES';
		}else{
			echo 'NO';
	}
	?></td>
    
    <td><?php $vech = $roSal['vehicle'];
    if($vech == 1){
        echo 'YES<br>'.$roSal['vehicle_allowance'].'<br><em>Date Issu.'.$roSal['vechDateIss'].'<em>';
        
        }else{
        echo 'NO';
	}
    ?></td>
    <td><?php $mob = $roSal['mobile']; 
    if($mob == 1){
        echo 'YES<br>'.$roSal['mobile_allowance'].'<br><em>Date Issu.'.$roSal['mobDateIss'].'<em>';
         }else{
        echo 'NO';
	}
    ?></td>
    <td><?php $lap = $roSal['laptop'];
    if($lap == 1){
        echo 'YES<br>'.$roSal['laptop_allowance'].'<br><em>Date Issu.'.$roSal['LapDateIss'].'<em>';
         }else{
        echo 'NO';
	}
    ?></td>
    <td><?php echo $roSal['bus_pass']; ?></td>
    <td><?php echo $roSal['date']; ?></td>
  </tr>
   <?php
	}//while close
	?>
</table>

            <?php
	}
	?>
    </td>
  </tr>
  <tr class="row-inactive"><td colspan="4" align="right">&nbsp;</td></tr>
</table>
<?php
}
?>