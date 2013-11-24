<?php
require_once "../../core/php/connection.php";
session_start();
$empType = $_SESSION['EMP_TYPE'];
$id = $_GET['id'];
$passFor = date("Y-m-d");
?>

<script type="text/javascript">
        function showLoginactivity(){
	
	var sDat = document.getElementById("sdate").value;
	var eDat = document.getElementById("edate").value;
	
	var subA = $.ajax({
				url: '../master/form/employee-activity.php',
				type: 'GET',
				data: {startDate:sDat, endDate:eDat},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#employee-activity").html(data);
	});
}
</script>
<div class="formContainer" style="width:99%;">
<div class="title" style="margin-bottom: 5px;">Employee Booking Record</div>
<table width="100%" border="0">
   
  <tr>
    <td><form>
        <!--Employee ID : 
        <select id="empId">
            <?php
            echo '<option value="ALL">Show All</option>'; 
            $sqlEmp = mysql_query("SELECT access_level,emp_id,username,emp_status FROM `employee` WHERE `emp_status` = 1");
            if(mysql_error()){
              echo '<option>No record Found</option>'; 
            }else{
                while($rop = mysql_fetch_assoc($sqlEmp)){
                    $CurEmpType = $rop['access_level'];
                    if($empType == $CurEmpType){
                      //do nothink  
                    }
                    elseif($CurEmpType == "1" || $CurEmpType == "6"){
                        //do nothink
                    }
                    else{
                   echo '<option value="'.$rop['emp_id'].'">'.$rop['username'].'</option>'; 
                    }
                }
            }
            ?>
        </select>-->
       Show result between <input type="text" id="sdate" onChange="showLogin(this.value);" value="<?php echo $passFor; ?>"> date to 
        <input type="text" id="edate" onChange="showLogin(this.value);" value="<?php echo $passFor; ?>">date
        <input type="button" onclick="showLoginactivity()" value="Show Record" class="NavButton"/>
        </form>
        </td>
  </tr>
  <tr>
    <td>
    <div id="employee-activity"></div>
    </td>
  </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/employee-activity.php?emplId=ALL&startDate=<?php echo date("Y-m-d"); ?>&endDate=<?php echo date("Y-m-d"); ?>";
	var obj = document.getElementById("employee-activity");
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
			dateFormat: "yy-mm-dd"
		});
                $( "#edate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
                
</script>
