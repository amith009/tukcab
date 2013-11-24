<script type="text/javascript">
function changeStatus(str)
{
	var uri = "../master/php/employee-status.php?str="+str;
        //alert(1);
	var obj = document.getElementById("empStatus");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
</script>
<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
$pass = $_GET['pas'];
require_once "../../core/php/connection.php";

$sqlEmp = mysql_query("SELECT * FROM `employee` WHERE `emp_status` = $pass  $val ORDER BY `emp_name` ASC");
$countEmp = mysql_num_rows($sqlEmp);
echo '<div class="formContainer" style="width:99%;">
<div class="title">Employee Records
<div class="action_tool">
    <table>
        <tr>
            <td>
                <a href="#" id="../master/form/add-new-employee.php" onClick="showMainAction(this.id)"><img src="images/001_01.png"/>&nbsp;Add New Employee</a>
            </td>
        </tr>
    </table>
    
</div>
</div>
<table border="0" width="100%" id="product-table">
<tr><td colspan="9" align="center"><div id="empStatus"></div></td></tr>    
<tr>
    <th class="table-header-repeat">Sl. No.</th>
    <th class="table-header-repeat">Emp. Code</th>
    <th class="table-header-repeat">Name</th>
    <th class="table-header-repeat">Contact No.</th>
    <th class="table-header-repeat">Email Address</th>
    <th class="table-header-repeat">Date of Joining</th>
    <th class="table-header-repeat">Access Mode</th>
    <th class="table-header-repeat">Status</th>
  </tr>
  
';
if($countEmp == 0){
	echo "<tr><td colspan=\"8\" align=\"center\"><div class=\"error\"><img src=\"images/001_11.png\" width=\24\" height=\"24\" /><h2>No Record Found!!</h2></div></td></tr>";
}else{
	$i=1;
	while($rowEmp = mysql_fetch_assoc($sqlEmp)){
	$t= $i++;
	$al = $rowEmp['access_level'];
        if($empType == $al || $al == 1 || $al == 6){
            //do nothing
        
        }
       else{
  echo '<tr ';
	if($t %2 == 0){
		echo 'class="row-active"';
	}else{
		echo 'class="row-inactive"';
	}
	echo '>';
	echo'
    <td>'.$t.'</td>
    <td>'.$rowEmp['username'].'</td>
    <td><a href="#" id="../master/form/view-employee-record.php?id='.$rowEmp['emp_id'].'" onClick="showMainAction(this.id)">'.$rowEmp['emp_name'].'</a></td>
    <td>'.$rowEmp['mobile_no'].'</td>
    <td>'.$rowEmp['email'].'</td>
    <td>'.$rowEmp['doj'].'</td>
    <td>';
	$al = $rowEmp['access_level'];
	$sqlAcc = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = '$al'");
	$counAcc =mysql_num_rows($sqlAcc);
	if($counAcc == 0){
		echo 'No Record!!';
	}else{
		$row = mysql_fetch_assoc($sqlAcc);
		echo $row['access_type'];
	}
	echo '</td><td>';
	
        $empId = $rowEmp['emp_id'];
        ?>
<select onchange="changeStatus(this.value)" class="styledselect">
    <option value="0-<?php echo $empId; ?>">Status</option>
    <option value="1-<?php echo $empId; ?>">Active</option>
    <option value="0-<?php echo $empId; ?>">Block</option>
    <option value="2-<?php echo $empId; ?>">Deactivate</option>

          
</select>
<?php
	echo '
	</td>
  </tr>
  <tr>
';
        }
        
	}//while close
	echo '</table></div>';
}//else close
?>
