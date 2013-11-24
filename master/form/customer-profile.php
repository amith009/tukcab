<?php
require_once "../../core/php/connection.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM `cust_master` WHERE `cust_id` = '$id'");

if(mysql_error()){
	echo 'Try Again!!';
}else{
$rows = mysql_fetch_assoc($sql);
?>
<table width="100%" id="product-table">
  <tr align="left" valign="top">
    <td>
    <table width="100%">
  <tr class="row-active">
    <td width="11%">Name </td>
    <td width="39%"><?php echo $rows['cust_name']; ?></td>
    <td width="19%">Type </td>
    <td width="31%"><?php $ty = $rows['cust_type']; 
	if($ty == 0){
		echo 'Direct Customer';
	}else{
		echo 'Indirect Customer';
	}
	?></td>
  </tr>
  <tr class="row-inactive">
    <td>Login ID </td>
    <td><?php echo $rows['cust_username']; ?></td>
    <td>Password </td>
    <td>*********</td>
  </tr>
  <tr class="row-active">
    <td>Mobile No </td>
    <td><?php echo $rows['mobile']; ?></td>
    <td>Alternet Mobile No.</td>
    <td><?php echo $rows['alt_mobile']; ?></td>
  </tr>
  <tr class="row-inactive">
    <td>E-mail </td>
    <td><?php echo $rows['email']; ?></td>
    <td>Alternate E-mail</td>
    <td><?php echo $rows['alt_email']; ?></td>
  </tr>
   <tr class="row-active">
    <td>Phone No.</td>
    <td><?php echo $rows['phone_no']; ?></td>
    <td>Requirement</td>
    <td><?php echo $rows['requirement']; ?></td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td>
    <?php
        $sqlAdd = mysql_query("SELECT * FROM `cust_detail` WHERE `cust_id` = '$id'");
    if(mysql_error()){
        echo 'Address not found..';
    }else{
        
        $roAdd = mysql_fetch_assoc($sqlAdd);
    ?>
    <table width="100%" border="0">
      <tr class="row-inactive">
        <td width="11%">&nbsp;</td>
        <td width="30%"><strong>Current Address </strong></td>
        <td width="28%"><strong>Office Address </strong></td>
        <td width="28%"><strong>Residence address </strong></td>
      </tr>
      <tr class="row-active">
        <td>Address</td>
        <td><?php echo $roAdd['cust_add_curr']; ?></td>
        <td><?php echo $roAdd['cust_add_offi']; ?></td>
         <td><?php echo $roAdd['cust_add_res']; ?></td>
      </tr>
      <tr class="row-inactive">
        <td>Land Mark</td>
        <td><?php echo $roAdd['acurrent_lm']; ?></td>
        <td><?php echo $roAdd['aoffice_lm']; ?></td>
        <td><?php echo $roAdd['arecedence_lm']; ?></td>
      </tr>
      <tr class="row-active">
        <td>Location 1</td>
        <td><?php echo $roAdd['acurrent_lq1']; ?></td>
        <td><?php echo $roAdd['aoffice_lq1']; ?></td>
        <td><?php echo $roAdd['arecedence_lq1']; ?></td>
      </tr>
      <tr class="row-inactive">
        <td>Location 2</td>
        <td><?php echo $roAdd['acurrent_lq2']; ?></td>
        <td><?php echo $roAdd['aoffice_lq2']; ?></td>
        <td><?php echo $roAdd['arecedence_lq2']; ?></td>
      </tr>
      <tr class="row-active">
        <td>Location 3</td>
        <td><?php echo $roAdd['acurrent_lq3']; ?></td>
        <td><?php echo $roAdd['aoffice_lq3']; ?></td>
        <td><?php echo $roAdd['arecedence_lq3']; ?></td>
      </tr>
      <tr class="row-inactive">
        <td>Location 4</td>
        <td><?php echo $roAdd['acurrent_lq4']; ?></td>
        <td><?php echo $roAdd['aoffice_lq4']; ?></td>
        <td><?php echo $roAdd['arecedence_lq4']; ?></td>
      </tr>
    </table>
    <?php
    }
    ?>
    </td>
  </tr>
</table>
<?php
}
?>