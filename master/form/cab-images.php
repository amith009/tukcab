<?php
$cabID = $_GET['cbId'];
$jod = $_GET['doj'];
//$cabID = 'INA2';
//$jod = '2011-11-30';
require_once "../../core/php/link-access.php";
?>
<script type="text/javascript">
 	function uploadImages(){
		if(appWin)
			appWin.open('<?php echo $link; ?>/master/form/add-cab-images.php?id=<?php echo $cabID; ?>&doj=<?php echo $jod; ?>&ac=n','Cab Images',500,400)	
		else
			window.open('<?php echo $link; ?>/master/form/dadd-cab-images.php?id=<?php echo $cabID; ?>&doj=<?php echo $jod; ?>&ac=n','Cab Images');
	}
 </script>
<fieldset><legend>Second Step.</legend>
<p align="center">
<a href="#" onclick="uploadImages(); return false;">Add images</a>
<br />
<a href="#" onClick="../form/add-new-driver.php?cbId=<?php echo $cabID; ?>&doj=<?php echo $jod; ?>"><strong><h2>Skip This Proccess</h2></strong></a>
</p>
  </fieldset>
</form>
