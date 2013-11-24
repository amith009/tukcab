<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";
$arId = $_GET['arId'];
if($arId == "ALL"){
	$valPass = "";
}else{
	$valPass = "WHERE `area_id` = ".$arId;
}
?>
<table width="100%" id="product-table">
  <tr>
    <th width="13%" class="table-header-repeat">Sl. Name</th>
    <th width="68%" class="table-header-repeat">Sub Area Name</th>
    <th width="19%" class="table-header-repeat">Action</th>
  </tr>
  <?php
  $sqlSub = mysql_query("SELECT * FROM `sub_area` $valPass");
  if(mysql_error()){
	  echo '<tr><td colspan="3" align="center"><img src="images/cancel.png" width="24" height="24"><br>
	  <strong>Select Main Area First!</strong></td></tr>';
  }else{
	  $i = 1;
	  while($rowsSub = mysql_fetch_assoc($sqlSub)){
		  $t = $i++;
  echo '<tr align="center" ';
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	echo '>';
	?>

  <td width="13%" align="center"><?php echo $t; ?></td>
    <td width="68%"><?php echo $rowsSub['sub_area_name']; ?></td>
    <td width="19%" align="center">
     <a href="#" id="../master/form/edit-sub-area.php?id=<?php echo $rowsSub['sub_area_id']; ?>" onClick="showMainAction(this.id)">
      <img src="images/001_45.png" width="22" height="22">
        
      </a>
       <a href="#" id="../master/php/delete-sub-area.php?id=<?php echo $rowsSub['sub_area_id']; ?>" onClick="deleteAction(this.id)">
      <img src="images/001_29.png" width="22" height="22">
      </a>
    </td>
    </tr>
  <?php
	  }//while close
  }
  ?>
</table>
