<?php
/*********************************************************************************************

File Name: booked-order-list.php
Work and function: display list all expences list.
T=table name -> expence
##########
Create date = 3 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
$date = date("Y-m-d");
require_once "../../core/php/connection.php";
?>
<script type="text/javascript">
function addExpence(str)
{
    
	var uri = "../master/form/add-new-expence.php?fun="+ str;
	var obj = document.getElementById("expenseReport");
	
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
//for employee salary
function addSalary()
{
        var eid = document.getElementById("empid").value;
        var em = document.getElementById("emon").value;
	var ey = document.getElementById("eyer").value;
        
	var subA = $.ajax({
				url: '../master/form/issue-salary.php',
				type: 'GET',
				data: {empId : eid, salM : em, salY : ey },
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#expenseReport").html(data);
	});
}
//search function
function showSearchExpence(){
	//alert(1);
	var startD = document.getElementById("startDate").value;
        var endD = document.getElementById("endDate").value;
	var srvTy = document.getElementById("actiTy").value;
        
	var subA = $.ajax({
				url: '../master/php/expenceReoprtsBackend.php',
				type: 'GET',
				data: {sDat : startD, eDat : endD, srTy : srvTy },
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#expenseReport").html(data);
	});
}
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<table width="100%" cellspacing="0" id="product-table">
    <tr><th class="table-header-repeat">Company Expense Record. <a href="#" id="showtoolbox">show</a></th>
    
    </tr>
    <tr><td align="left">
            <div class="toolsbox">
            <table width="100%" cellspacing="0" style="margin-top:-5px;border-top: 1px dashed #fff; font-size: 12px; text-decoration: none;">
                <tr>
                    <td width="80%" align="left">
                        <form>
                            
                            <select id="actiTy" class="required">
                                <option value="CAB">Cab Record</option>
                                <option value="COM">Company Record</option>
                                <!--<option value="EMP">Employee Salary</option>-->
                                <option value="PAL">Profit and Loss</option>
                            </select> 
                        <input type="text" value="<?php echo $date; ?>" id="startDate" class="required" />
                        <script language="javascript">
                            $( "#startDate" ).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: "yy-mm-dd"
                            });
                        </script>
                        <input type="text" value="<?php echo $date; ?>" id="endDate" class="required" />
                        <script language="javascript">
                            $( "#endDate" ).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: "yy-mm-dd"
                            });
                        </script>
                        <input type="button" value="Display" class="NavButton" onclick="showSearchExpence()" />
                        </form>
                        </td>
                         <!--td  align="left" width="40%">
                             <div class="title">Issue salary</div>
                             <form>
                             
                             <select  class="required" id="empid">
                                 <option value="NA">Emp. Code</option>
                                <?php
                                $sqlEmp = mysql_query("SELECT username,emp_id FROM `employee` WHERE `emp_status` = 1 AND `access_level` != 6");
                                if(mysql_error()){
                                    echo '<option value="NA">No record Found!</option>';
                                }else{
                                    while($rowEmp = mysql_fetch_assoc($sqlEmp)){
                                        echo '<option value="'.$rowEmp['emp_id'].'">'.$rowEmp['username'].'</option>'; 
                                    }
                                }
                                ?>
                           </select>
                             <select id="emon">
                                 <option value="">Month</option>
                                 <option value="01">JAN</option>
                                 <option value="02">FEB</option>
                                 <option value="03">MAR</option>
                                 <option value="04">APR</option>
                                 <option value="05">MAY</option>
                                 <option value="06">JUN</option>
                                 <option value="07">JUL</option>
                                 <option value="08">AUG</option>
                                 <option value="09">SEP</option>
                                 <option value="10">OCT</option>
                                 <option value="11">NOV</option>
                                 <option value="12">DEC</option>
                             </select>
                             <select id="eyer">
                                 <option value="">Year</option>
                                 <option value="2012">2012</option>
                                 <option value="2013">2013</option>
                                 <option value="2014">2014</option>
                                 <option value="2015">2015</option>
                                 <option value="2016">2016</option>
                                 <option value="2017">2017</option>
                                 <option value="2018">2018</option>
                                 <option value="2019">2019</option>
                                 <option value="2020">2020</option>
                             </select>
                           <input type="button" value="Issue" class="NavButton" onclick="addSalary()" />

                             </form>
                        </td-->
                        <td  align="right">
                             <img src="images/001_01.png" width="16" height="16" align="absmiddle"/>
                             <a href="#" onclick="addExpence(this.id)" id="add" > New Expenses</a>
                        </td>
                        
                </tr>
            </table>
            </div>
        </td></tr>
    <tr>
        <td align="left" valign="top">
            <div id="expenseReport"><div>
        </td>
    </tr>
</table>

<script language="javascript">
    $("#expenceReportform").validate();
	var uri = "../master/php/expenceReoprtsBackend.php?sDat=<?php echo $date; ?>&eDat=<?php echo $date; ?>";
	var obj = document.getElementById("expenseReport");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>