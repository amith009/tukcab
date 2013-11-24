<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<script language="javascript">
function toggleEndDate(val){
		if(val==4){
			$(document.getElementById('endDate1')).removeClass('donotshow');
			$(document.getElementById('endDate2')).removeClass('donotshow');
		}
		else{
			$(document.getElementById('endDate1')).addClass('donotshow');
			$(document.getElementById('endDate2')).addClass('donotshow');
		}
	}
</script>
<div class="formContainer" style="width: 98%;">
<div class="title"><?php echo '['.$rows['username'].'] '.$rows['emp_name']; ?></div>
    <table width="100%" align="center" id="product-table">
  <tr class="row-active">
    <td width="50%" colspan="2" rowspan="4" align="center" valign="middle">
	<?php
		$img = $rows['emp_img_content'];
		if($img != ""|| $img != "employeeImages/"){
		echo '<img src="'.$img.'" width="150" height="175" style="border:5px solid #ffffff;" />';
		}else{
		echo '<img src="../core/images/user_png.png" />';
		}
		?>
	</td>
  </tr>
  <tr align="left" valign="top" class="row-inactive">
    
    <td>Password </td>
    <td>*********<a href="#" id="4" onclick="toggleEndDate(this.id);" style=" font-size:10px; color:#C30;">( change )</a>
    <div class="donotshow" id="endDate1">
    <form method="post" name="frmChange" id="frmChange" action="../master/php/change_action.php">
    <input type="text" class="required" name="pws" value="<?php echo $rows['password']; ?>" maxlength="10" /><br />&nbsp;&nbsp;
    <em>max 10 Characters only</em><br />
    <input type="submit" value="Save" />
    <input type="button" value="Cancel" onclick="toggleEndDate(this.id);"  id="3"/>
    </form>
    </div>
    </td>
  </tr>
  <tr class="row-active">
    
    <td valign="top">Alternet Mobile No.</td>
    <td  valign="top"><?php echo $rows['mobile_no'].'<br /> '.$rows['alt_number']; ?></td>
  </tr>
  <tr class="row-inactive">
    
    <td  valign="top">E-mail</td>
    <td  valign="top"><?php echo $rows['alt_email'].'<br /> '.$rows['email']; ?></td>
  </tr>
   <tr class="row-active">
    <td>Phone No.</td>
    <td><?php echo $rows['ph_number']; ?></td>
    <td>Reference</td>
    <td><?php echo $rows['reference']; ?></td>
  </tr>
  <tr  class="row-inactive"><td>Address line 1:</td><td><?php echo $rows['emp_add1']; ?></td><td>Address Line 2</td><td><?php echo $rows['emp_add2']; ?></td></tr>
  <tr  class="row-active"><td>City:</td><td><?php echo $rows['city']; ?></td><td>State </td><td><?php echo $rows['state']; ?></td></tr>
  <tr  class="row-inactive"><td>Country:</td><td><?php echo $rows['country']; ?></td><td>State </td><td><?php echo $rows['zip']; ?></td></tr>
</table>
</div>
 <script language="javascript">
$("#frmChange").validate();
</script>
<?php
}
?>