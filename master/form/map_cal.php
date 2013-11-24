<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--<link href="css/main_style.css" rel="stylesheet" type="text/css" />-->
</head>

<body>
<div class="zform">
<?php
$to = $_GET['amnt'];
?>
<fieldset><legend>Map Calculator.</legend>
<form action="map_cal_exe.php" method="post">
<table width="38%" border="0">
  <tr>
    <td>KM :</td>
    </tr><tr>
    <td><input name="km" type="text" class="input_nf" placeholder="KM Distence" style="text-align:right; height:32px; padding-left:32px; font-size:14px; width:100px" /></td>
  </tr>
  <tr>
    <td>Starting 5 KM :</td>
    </tr><tr>
    <td><input name="sk" type="text" class="input_nf" value="100" style="text-align:right; background:url(../../core/images/rs.png) no-repeat left; height:32px; padding-left:32px; font-size:14px; width:100px" /></td>
  </tr>
  <tr>
    <td>After 5 KM :</td>
    </tr><tr>
    <td><input  name="ak" type="text" class="input_nf" style="text-align:right; background:url(../../core/images/rs.png) no-repeat left; height:32px; padding-left:32px; font-size:14px; width:100px" /></td>
  </tr>
  
  <tr>
    <td><input type="submit" name="submit" value="Calculate" /></td>
  </tr>
  <tr>
    <td>Amount :</td>
    </tr><tr>
    <td>
    <?php
	if($to == "n"){
		$tp = '0.00';
	}else{
		$tp = $to;
	}
	?>
    <input type="text" class="input_nf" value="<?php printf("%.2f",$tp); ?>" style="text-align:right; background:url(../../core/images/rs.png) no-repeat left; height:32px; padding-left:32px; font-size:14px; width:100px"  /></td>
  </tr>
</table>

</form>
</fieldset>
</div>
</body>
</html>