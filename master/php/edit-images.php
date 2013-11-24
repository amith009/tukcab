<?php

/*Author: Amit Kumar
 * Date= 31-12-2011
 * This file function to update cab images record 
 * table name is:cab_images
 * track trhough the cab code
 * if not exisit add as new or else Update record
 * image save location is : 
 * 
 *  */
require_once "../../core/php/connection.php";
$cabId = $_POST['cabId'];
//Trak if all ready exists
$sqlCabCod = mysql_query("SELECT `cab_code` FROM `cabs` WHERE `cab_id` = '$cabId'");
if(mysql_error()){
  echo 'unable to read Cab Record!';
}else{
    $roCab = mysql_fetch_assoc($sqlCabCod);
   $cabCode = $roCab['cab_code'];
   $code = $cabCode;
 //echo 'here';
      $sqlImg = mysql_query("SELECT * FROM `cab_images` WHERE `ci_code` = '$code'");
      $countCab = mysql_num_rows($sqlImg);
   // exit(0);
      
      
    if($countCab == 0){
        //insert as new record
       	echo $f1_name = $_FILES['imgf']['name'];
        if($f1_name != ""){
            	move_uploaded_file($_FILES["imgf"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgf"]["name"]);
	 $imgf_content = $f1_name==''?'':'cab_images/'.$code.$_FILES["imgf"]["name"];
           
       echo   $valIn .= ", `ci_front_image`";
         echo $datIn .= ", '".$imgf_content."'";   
        }
       
	//end here
	//image back file
	$f2_name = $_FILES['imgb']['name'];
        if($f2_name != ""){
	move_uploaded_file($_FILES["imgb"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgb"]["name"]);
	  $imgb_content = $f2_name==''?'':'cab_images/'.$code.$_FILES["imgb"]["name"];
          
          $valIn .= ", `ci_back_image`";
         $datIn .= ", '".$imgb_content."'";
        }	
//end here
	//image left file
        $f3_name = $_FILES['imgl']['name'];
        if($f3_name != ""){
	
	move_uploaded_file($_FILES["imgl"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgl"]["name"]);
	  $imgl_content = $f3_name==''?'':'cab_images/'.$code.$_FILES["imgl"]["name"];
          
          $valIn .= ", `ci_left_image`";
         $datIn .= ", '".$imgl_content."'";
        }	
	//end here
	//image front file
        $f4_name = $_FILES['imgr']['name'];
        if($f4_name != ""){
	
	move_uploaded_file($_FILES["imgr"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgr"]["name"]);
	  $imgr_content = $f4_name==''?'':'cab_images/'.$code.$_FILES["imgr"]["name"];
          
          
          $valIn .= ", `ci_right_image`";
         $datIn .= ", '".$imgr_content."'";
        }
	//end here
	//image inteor front file
        $f5_name = $_FILES['imgif']['name'];
        if($f5_name != ""){
	 
	move_uploaded_file($_FILES["imgif"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgif"]["name"]);
	  $imgif_content = $f5_name==''?'':'cab_images/'.$code.$_FILES["imgif"]["name"];
          
           $valIn .= ", `ci_interior_front_image`";
         $datIn .= ", '".$imgif_content."'";
        }
	//end here
	//image intero back file
        $f6_name = $_FILES['imgib']['name'];
        if($f6_name != ""){
	
	move_uploaded_file($_FILES["imgib"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgib"]["name"]);
	  $imgib_content = $f6_name==''?'':'cab_images/'.$code.$_FILES["imgib"]["name"];
          
             $valIn .= ", `ci_interior_back_image`";
             $datIn .= ", '".$imgib_content."'";
	//end here
        }
       echo 'MERE';
      //insert function goes here
        $sqlIns = "INSERT INTO `cab_images` (`ci_code` $valIn ) VALUES ('$cabCode' $datIn )";
		//echo mysql_error();
		//exit(0);
        $resultIn = mysql_query($sqlIns);
        
        if(mysql_error()){
            echo 'Unable to Add Record!!';
        }else{
           header("location: ../form/view-cab-details.php?id=".$cabId);    
        }
    }else{
      //update cab 
        $f1_name = $_FILES['imgf']['name'];
        
            	move_uploaded_file($_FILES["imgf"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgf"]["name"]);
	  $imgf_content = $f1_name==''?'':'cab_images/'.$code.$_FILES["imgf"]["name"];
             
            
	//end here
	//image back file
	 $f2_name = $_FILES['imgb']['name'];
        if($f2_name != ""){
            echo 'here';
	move_uploaded_file($_FILES["imgb"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgb"]["name"]);
	  $imgb_content = $f2_name==''?'':'cab_images/'.$code.$_FILES["imgb"]["name"];
          
           $valUp .= ", `ci_back_image` = '".$imgb_content."'";
        }	
//end here
	//image left file
        $f3_name = $_FILES['imgl']['name'];
        if($f3_name!= ""){
	
	move_uploaded_file($_FILES["imgl"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgl"]["name"]);
	  $imgl_content = $f3_name==''?'':'cab_images/'.$code.$_FILES["imgl"]["name"];
          
          $valUp .= ", `ci_left_image` =  '".$imgl_content."'";
        }	
	//end here
	//image front file
        $f4_name = $_FILES['imgr']['name'];
        if($f4_name != ""){
	
	move_uploaded_file($_FILES["imgr"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgr"]["name"]);
	  $imgr_content = $f4_name==''?'':'cab_images/'.$code.$_FILES["imgr"]["name"];       
          $valUp .= ", `ci_right_image` = '".$imgr_content."'";
        }
	//end here
	//image inteor front file
        $f5_name = $_FILES['imgif']['name'];
        if($f5_name != ""){
	 
	move_uploaded_file($_FILES["imgif"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgif"]["name"]);
	  $imgif_content = $f5_name==''?'':'cab_images/'.$code.$_FILES["imgif"]["name"];
          
           $valUp .= ", `ci_interior_front_image` = '".$imgif_content."'";
        }
	//end here
	//image intero back file
        $f6_name = $_FILES['imgib']['name'];
        if($f6_name != ""){
	
	move_uploaded_file($_FILES["imgib"]["tmp_name"],
  "../../core/cab_images/".$code.$_FILES["imgib"]["name"]);
	  $imgib_content = $f6_name==''?'':'cab_images/'.$code.$_FILES["imgib"]["name"];
          
             $valUp .= ", `ci_interior_back_image` = '".$imgib_content."'";
	//end here
        }
        $valUp .= "";
      //file deleting  
     
      //end file deleting
       //update record querey
      echo  $sqlUp = "UPDATE `cab_images` SET `ci_front_image` = '$imgf_content' $valUp WHERE `ci_code` = '$cabCode'";
        $resultUp = mysql_query($sqlUp);
        echo mysql_error();
        //exit(0);
        if($resultUp == TRUE){
          header("location: ../form/view-cab-details.php?id=".$cabId);
        }else{
            echo 'Unable to Update record';
        }
    }
}
    ?>
