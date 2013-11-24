<?php
require_once "../../core/php/connection.php";
require_once "../../core/php/link-access.php";

$submit = $_POST['submit'];
if(isset($submit)){
	$cabId = $_POST['cabId'];
	$doj = $_POST['doj'];
	
//image front file
	$f1_name = $_FILES['imgf']['name'];
	move_uploaded_file($_FILES["imgf"]["tmp_name"],
  "../../uploads/" . $_FILES["imgf"]["name"]);
	 $imgf_content = '../../uploads/'.$f1_name;
	//end here
	//image back file
	$f2_name = $_FILES['imgb']['name'];
	move_uploaded_file($_FILES["imgb"]["tmp_name"],
  "../../uploads/" . $_FILES["imgb"]["name"]);
	  $imgb_content = '../../uploads/'.$f2_name;
	//end here
	//image left file
	$f3_name = $_FILES['imgl']['name'];
	move_uploaded_file($_FILES["imgl"]["tmp_name"],
  "../../uploads/" . $_FILES["imgl"]["name"]);
	  $imgl_content = '../../uploads/'.$f3_name;
	//end here
	//image front file
	$f4_name = $_FILES['imgr']['name'];
	move_uploaded_file($_FILES["imgr"]["tmp_name"],
  "../../uploads/" . $_FILES["imgr"]["name"]);
	  $imgr_content = '../../uploads/'.$f4_name;
	//end here
	//image inteor front file
	 $f5_name = $_FILES['imgif']['name'];
	move_uploaded_file($_FILES["imgif"]["tmp_name"],
  "../../uploads/" . $_FILES["imgif"]["name"]);
	  $imgif_content = '../../uploads/'.$f5_name;
	//end here
	//image intero back file
	$f6_name = $_FILES['imgib']['name'];
	move_uploaded_file($_FILES["imgib"]["tmp_name"],
  "../../uploads/" . $_FILES["imgib"]["name"]);
	  $imgib_content = '../../uploads/'.$f6_name;
	//end here
}
?>