<?php
require_once "../../core/php/connection.php";
?>
<script type="text/javascript">
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
function showActionEmp(str)
{
	var uri = "../master/php/employee-login-status-change.php?type="+str;
	var obj = document.getElementById("employeeloginstatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
}
</script>
<?php
$passEmpId = $_GET['emplId'];
$sDate = $_GET['startDate'];
$eDate = $_GET['endDate'];
$curDate = date('Y-m-d');

if($passEmpId == 'ALL'){
   $passQuery = "";
   $valuePass = "AND `status` = '1'";
}else{
    $passQuery = " AND `emp_id` = '".$passEmpId."' ";
    $valuePass = "";
}
//echo "SELECT * FROM `login_details` WHERE  DATE_FORMAT(`login_date`, '%Y-%m-%d') = '$curDate' ORDER BY `login_time` DESC";
$sql = mysql_query("SELECT * FROM `employee_login` WHERE  DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN  '$sDate' AND  '$eDate' $passQuery $valuePass ORDER BY `logoff_id` DESC");
$count = mysql_num_rows($sql);
if(mysql_error()){
	echo 'Try Again!!';
}else{
?>
<table width="100%" border="0">
    <tr>
        <td colspan="10" align="center" valign="top">
            <div id="employeeloginstatus"></div>
        </td>
    </tr>
  <tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Emp. Code</th>
    <th class="table-header-repeat">Name</th>
    <th class="table-header-repeat">Date</th>
    <th class="table-header-repeat">Access Code</th>
    <th class="table-header-repeat">Login Time</th>
    <th class="table-header-repeat">Logout Time</th>
    <th class="table-header-repeat">Hours Assign</th>
    <th class="table-header-repeat">Action</th>
  </tr>
  <?php
  if($count == 0){
	  echo '<tr><td colspan="10" align="center"><img src="images/001_11.png" width="24" height="24"><br>No Record Found!!</td></tr>';
  }
  $i = 1;
  while($rows = mysql_fetch_assoc($sql)){
  $t = $i++;
?>
   <tr <?php
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	?> >
    <td><?php echo $t;
    $p = $t++;
    ?></td>
    <td><?php 
        $empId = $rows['emp_id'];
	$empDet = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$empId'");
	if(mysql_error()){
		echo '-';
	}else{
		$rowEm = mysql_fetch_assoc($empDet);
                ?>
         <a href="#" onClick="keepAlive(this,'sub1<?php echo $p; ?>');" onMouseOver="setVisibility(this,'sub1<?php echo $p; ?>', 'inline');" onMouseOut="setVisibility(this,'sub1<?php echo $p; ?>', 'none');">
        <?php
        echo $rowEm['username'];
        ?>
         </a>
        <div id="sub1<?php echo $p; ?>" class="popup" style="overflow:auto; height: 200px; width: 300px;">
            <?php
            $sqlPass = mysql_query("SELECT * FROM `employee_logoff` WHERE DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN  '$sDate' AND  '$eDate' AND `emp_id` = '$empId' AND `status` = 0");
            ?>
            <table width="100%" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat">Sl. No.</th>
                    <th class="table-header-repeat">Comment</th>
                    <th class="table-header-repeat">Log off time</th>
                </tr>
                <tr>
                    <td colspan="4"><?php echo 'Total: '.mysql_num_rows($sqlPass); ?></td>
                </tr>
                <?php
                if(mysql_error()){
                    echo '<tr><td colspan="4" align="center">Record not found.</td></tr>';
                }
                else{
                $c = 1;
                while($rowser = mysql_fetch_assoc($sqlPass)){
                    $h = $c++;
                ?>
                <tr  <?php
                    if($c %2 == 0){
		echo 'class="row-active"';
                }else{
		echo 'class="row-inactive"';
                }
                    ?>
                <tr>
                    <td>
                       <?php echo $h; ?> 
                    </td>
                    <td>
                       <?php echo $rowser['comment']; ?>  
                    </td>
                    <td>
                        <?php echo $rowser['date']; ?>  
                    </td>
                </tr>
                <?php
                }//while close
                }//else close
                ?>
            </table>
        </div>
         <?php
		
	}
	?></td>
    <td>
      <?php
	echo $rowEm['emp_name'];
	?>
    </td>
    <td><?php echo $rows['date']; ?></td>
    <td><?php echo $rows['access_code']; ?></td>
    <td><?php echo $rows['login_time']; ?></td>
    <td><?php echo $rows['log_off']; ?></td>
    <td><?php echo $rows['workin_time']; ?></td>
    <td>
        <select onchange="showActionEmp(this.value);" class="styledselect">
            <option>Select</option>
            <option value="0-<?php echo $rows['logoff_id']; ?>">Make Offline</option>
            <option value="1-<?php echo $rows['logoff_id']; ?>">Make Online</option>
        </select>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
}
?>