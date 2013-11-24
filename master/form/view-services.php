<?php
/*********************************************************************************************

File Name: view-area.php
Work and function: in this file user driver record and payment status
T=table name -> area
##########
Create date = 29 NOV 2011
Time: 01:42
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
require_once "../../core/php/connection.php";
$sql = mysql_query("SELECT * FROM `service_type` ORDER BY `service_type` ASC");
$count =  mysql_num_rows($sql);

echo '<div class="formContainer" style="width:99%;">
<div class="title">View Services
<div class="action_tool">
    <table>
        <tr>
            
            <td>
                <a href="#" id="../master/form/add-services.php" onClick="showMainAction(this.id)"><img src="images/001_01.png"/>&nbsp;Create Service</a>
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
  </tr>
   <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Area Name</th>
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
    <td>'.$rows['service_type'].'</td>
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
    <a href="#" id="../master/form/edit-services.php?id=<?php echo $rows['service_id']; ?>" onClick="showMainAction(this.id)">
    <img src="images/001_45.png" width="16" height="16">
    </a>
    <a href="#" id="../master/php/delete-service.php?id=<?php echo $rows['service_id']; ?>" onClick="deleteAction(this.id)">
    <img src="images/001_29.png" width="16" height="16"> </a>
    
    <?php
	echo'
    </td>
  </tr>';
  }//while close
	}
echo '</table></div>';
?>
