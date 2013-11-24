<?php

/*
 *Author: amit kumar
 * date: 30-01-2012
 * function: this file export all passing columm value into csv format..
 */
require_once "../../core/php/connection.php";
$tableName= $_GET['tabName'];
$startDat = $_GET['sDate'];
$endDat = $_GET['eDate'];
if($startDat == $endDat){
echo 'Invalid Date Range';
}else{
  $query = "SELECT * FROM $tableName WHERE DATE_FORMAT(`date_join`, '%Y-%m-%d')  BETWEEN '$startDat' AND '$endDat'";
  
  $result = mysql_query( $query );
  $count = mysql_num_rows( $result );
  if($count == 0){
  echo 'No record found!';
  }else{
  //
  // send response headers to the browser
  // following headers instruct the browser to treat the data as a csv file called export.csv
  //
  header( 'Content-Type: text/html' );
  header( 'Content-Disposition: attachment;filename=export.csv' );
  //
  // output header row (if atleast one row exists)
  //
  $rows = mysql_fetch_assoc( $result );
  if ( $rows )
  {
    echocsv( array_keys( $rows ) );
  }
  //
  // output data rows (if atleast one row exists)
  //
  while ( $rows )
  {
    echocsv( $rows );
    $rows = mysql_fetch_assoc( $result );
  }
 } 
 }
  function echocsv( $fields )
  {
    $separator = '';
    foreach ( $fields as $field )
    {
      if ( preg_match( '/\\r|\\n|,|"/', $field ) )
      {
        $field = '"' . str_replace( '"', '""', $field ) . '"';
      }
      echo $separator . $field;
      $separator = ',';
    }
    echo "\r\n";
 }
  
?>
