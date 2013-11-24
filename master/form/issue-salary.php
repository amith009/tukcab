<?php
/*********************************************************************************************

File Name: issue-salary.php
Work and function: issue employ salary
T=table name -> issueEmployeeSalary
##########
Create date = 5 FEB 2012
Last Update:
Date: __ NOV 20__
Author Name: amit kumar

***********************************************************************************************/
require_once "../../core/php/connection.php";
$empId = $_GET['empId'];
$month = $_GET['salM'];
$year = $_GET['salY'];
$sqlEmp = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$empId'");
if(mysql_error()){
    echo 'Employee Record Not Found!!';
}else{
    $rows = mysql_fetch_assoc($sqlEmp);
    $empCode = trim($rows['username']);
    echo "SELECT * FROM `employee_sallery` WHERE `emp_id` = '$empCode'";
    $sqlSal = mysql_query("SELECT * FROM `employee_sallery` WHERE `emp_id` = '$empCode'");
        if(mysql_error()){
            echo 'Employee Record Not Found!!';
        }else{
            $rowsSal = mysql_fatch_assoc($sqlSal);
            echo $rowsSal['basic'];
        }
}
?>