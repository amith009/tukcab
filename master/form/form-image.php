<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="form-image.php" enctype="multipart/form-data">
<input type="file" name="img" />
<input type="submit" value="ok" />
</form>
</body>
</html>
<?php
$f1_name = $_FILES['img']['name'];
	move_uploaded_file($_FILES["img"]["tmp_name"],
  "../../core/cab_images/" . $_FILES["img"]["name"]);
	 $imgf_content = '../../core/cab_images/'.$f1_name;
?>