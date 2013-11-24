<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
require_once "../../core/php/connection.php";
require_once "../../core/php/link-access.php";
$id = $_GET['id'];
$ac = $_GET['ac'];
if($ac == "n"){
	//do nothing
}else{
	$submit = $_POST['submit'];
	if(isset($submit)){
		$did = $_POST['driverId'];
		$fna = $_FILES['img']['name'];
		$img_name = $_FILES['img']['tmp_name'];
		$uimg = move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../uploads/".$id.$_FILES["img"]["name"]);
	if($uimg == TRUE){
		 echo $img_content = 'uploads/'.$id.$img_name;
	}else{
	 echo 'hj';
	}
	}
}
?>
<form method="post" action="<?php echo $link; ?>/master/form/driver-images.php?id=<?php echo $id; ?>&ac=Up" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $id;?>" name="driverId" />
<input type="file" name="img" />
<input type="submit" value="Upload" name="submit" />
</form>
</body>
</html>