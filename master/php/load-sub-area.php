<?php
	require_once "../../core/php/connection.php";
	$parent = $_POST['parent'];
	$res = mysql_query("SELECT sub_area_id,sub_area_name FROM sub_area WHERE area_id = $parent");
	$retVal='<option disabled>No Sub Area</option>';
	if($res==FALSE){
		$retVal='<option disabled>No Sub Area</option>';
	}
	else{
		$numRow = mysql_num_rows($res);
		if($numRow==0) $retVal='<option disabled>No Sub Area</option>';
		else
			$retVal='<option>Select Sub Area</option>';
		while($row=mysql_fetch_array($res)){
			$retVal .= '<option value="'.$row['sub_area_id'].'">'.$row['sub_area_name'].'</option>';
		}
		echo $retVal;
	}
?>