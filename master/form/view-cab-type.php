<?php
require_once "../../core/php/connection.php";
$sql = mysql_query("SELECT * FROM `cab_types` ORDER BY `cab_type_name` ASC");
$count =  mysql_num_rows($sql);

echo '<div class="formContainer" style="width:99%;">
<div class="title">View Cab Types
<div class="action_tool">
    <table>
        <tr>
            
            <td>
                <a href="#" id="../master/form/create-cab-type.php" onClick="showMainAction(this.id)"><img src="images/001_01.png"/>&nbsp;Create Cab Type</a>
           <a href="#" id="../master/form/cab-rate-forented.php" onClick="showMainAction(this.id)"><img src="images/add.png" width="16" height="16"> Add Cab rate </a>

</td>
            
        </tr>
    </table>
    
</div>
</div>
<table width="100%" id="product-table">';
if($count == 0){
  echo '<tr>
    <td colspan="10" align="center">
	
		<img src="images/001_11.png" width="24" height="24"><br>NO RECORDS FOUND!!';
	
    echo '</td>
  </tr>';
  }else{
      echo'
  
   <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Cab Code</th>
    <th class="table-header-repeat">Cab Name</th>
    <th class="table-header-repeat">Active Cab</th>
    <th class="table-header-repeat">Block. Cab</th>
    <th class="table-header-repeat">Total. Cab</th>
    <th class="table-header-repeat">Status</th>
    <th class="table-header-repeat">Action</th>
  </tr>';
  $i = 1;
  while($rows = mysql_fetch_assoc($sql)){
  $t = $i++;
  echo '<tr ';
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	echo '>';
    echo '<td>'.$t.'</td>
    <td>'.$rows['cab_type_code'].'</td>
    <td>'.$rows['cab_type_name'].'</td>';
	echo '<td>';
	$cTy = $rows['cab_type_id'];
	$sqlCab = mysql_query("SELECT cab_id,cab_type,status FROM `cabs` WHERE `cab_type` = '$cTy' AND `status` =1");
	if($sqlCab == TRUE){
		echo $b = $couCab = mysql_num_rows($sqlCab);
	}else{
		echo $b = 0;
	}
	echo'</td>';
		echo '<td>';
	
	$sqlCabBl = mysql_query("SELECT cab_id,cab_type,status FROM `cabs` WHERE `cab_type` = '$cTy' AND `status` =0");
	if($sqlCabBl == TRUE){
		echo $c = $couCabBl = mysql_num_rows($sqlCabBl);
	}else{
		echo $c= 0;
	}
	echo'</td>';
	echo '<td>'.$a=$b+$c.'</td>';
	echo '
    <td>';
	$sut = $rows['status'];
	if($sut == 1){
		echo '<img src="images/001_09.png" width="22" height="22" />';
	}else{
		echo '<img src="images/001_02.png" width="22" height="22" />';
	}
	echo'</td>
    <td>';
	?>
    <a href="#" id="../master/form/edit-cab-type.php?id=<?php echo $rows['cab_type_id']; ?>" onClick="showMainAction(this.id)">
    <img src="images/001_45.png" width="16" height="16">
    </a>
    <a href="#" id="../master/php/delete-cab-type.php?id=<?php echo $rows['cab_type_id']; ?>" onClick="showMainAction(this.id)">
    <img src="images/001_29.png" width="16" height="16"> </a>

    <?php
    echo '</td>
  </tr>';
  }//while close
	}
echo '</table></div>';
?>
