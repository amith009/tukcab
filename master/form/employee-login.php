<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$passFor = date("Y-m-d");
?>

<script type="text/javascript">
        function showLoginRecord(){
	var emId = document.getElementById("empId").value;
	var sDat = document.getElementById("sdate").value;
	var eDat = document.getElementById("edate").value;
	
	var subA = $.ajax({
				url: '../master/form/employee-backend-login.php',
				type: 'GET',
				data: {emplId:emId, startDate:sDat, endDate:eDat},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#employee-status-login").html(data);
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title" style="margin-bottom: 5px;">Employee Login Record</div>
<table width="100%" border="0" id="product-table">
   
  <tr>
    <td><form>
        Employee ID : 
        <select id="empId">
            <?php
            echo '<option value="ALL">Show All</option>'; 
            $sqlEmp = mysql_query("SELECT * FROM `employee` WHERE `emp_status` = 1");
            if(mysql_error()){
              echo '<option>No record Found</option>'; 
            }else{
                while($rop = mysql_fetch_assoc($sqlEmp)){
                   echo '<option value="'.$rop['emp_id'].'">'.$rop['username'].'</option>'; 
                }
            }
            ?>
        </select>
        Date : <input type="text" id="sdate" onChange="showLogin(this.value);" value="<?php echo $passFor; ?>"> TO
        <input type="text" id="edate" onChange="showLogin(this.value);" value="<?php echo $passFor; ?>">
        <input type="button" onclick="showLoginRecord()" value="Show Record" class="NavButton"/>
        </form>
        </td>
  </tr>
  <tr>
    <td>
    <div id="employee-status-login"></div>
    </td>
  </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/employee-backend-login.php?emplId=ALL&startDate=<?php echo date("Y-m-d"); ?>&endDate=<?php echo date("Y-m-d"); ?>";
	var obj = document.getElementById("employee-status-login");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
	//for date
	$( "#sdate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
                $( "#edate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
		});
                
</script>
