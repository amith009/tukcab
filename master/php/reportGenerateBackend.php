<?php
  
 /**
  * Author : amit kumar
  * Date: 28-01-2012
  * FUNCTION:
 In This file you will get all type of reports as per select mode
 format for only number of cab join and owenr type and employee summery loging record and booking status as per employee.
 and order summery as per booking, cancel and Dispatch. and customer join record only track mobile numbers and email address.
 */
   
require_once "../../core/php/connection.php";
$filname = "Report".date("Y-m-d");
// send response headers to the browser
  // following headers instruct the browser to treat the data as a csv file called export.csv
  //
  header( 'Content-Type: text/csv' );
  header( 'Content-Disposition: attachment;filename=export.csv' );
  //
$startDat = $_GET['dateStr'];
$endDat = $_GET['dateEnd'];
$mode = $_GET['type'];
echo $ct = $_GET['ct'].'<br>'; //custom type
echo $acs = $_GET['acs']; //access id pas as per cab code or employee
