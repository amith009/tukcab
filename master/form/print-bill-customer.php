<!DOCTYPE html >
<?php
session_start();
$empType = $_SESSION['EMP_TYPE'];
require_once "../../core/php/connection.php";
$bid = $_GET['bid']; // bill number

//Track Customer and bill content
$sqlBill = mysql_query("SELECT * FROM `billCustomer` WHERE `refId` = '$bid'");

if(mysql_error()){
 echo 'Record Not Found';
 echo mysql_error;
}else{
	$rowsCust = mysql_fetch_assoc($sqlBill);
?>
<html>
<head>
	<title>Customer Bill - <?php ?></title>
	<link href="http://192.168.1.202/kkcabs-new/core/css/default.css" rel="stylesheet" type="text/css"/>
</head>
    
<body>
<div class="pt_bill">
	<div class="header_content">
		<div class="header">
			<img src="http://192.168.1.202/kkcabs-new/core/images/bill_header.png" width="100%"/>
		</div>
		
		<div class="head">
			<table width="100%">
				<tr>
				<td align="left" valign="top"><b>Customer Name :</b></td>
					<td align="left" valign="top"><?php echo $rowsCust['custName']; ?></td>
					<td align="left" valign="top"><b>Date:</b></td>
					<td align="left" valign="top"><?php echo $rowsCust['issueDate']; ?></td>
				</tr>
				<tr>
					<td align="left" valign="top"><b>Contact No :</b></td>
					<td align="left" valign="top"><?php echo $rowsCust['custNo']; ?></td>
					<td align="left" valign="top"><b>Cab Type:</b></td>
					<td align="left" valign="top"><?php echo $rowsCust['CabType']; ?></td>
				</tr>
				<tr>
					<td align="left" valign="top"><b>Address :</b></td>
					<td align="left" valign="top" colspan="3"><?php echo $rowsCust['custAdd']; ?></td>
					
				</tr>
			</table>
		</div>
		
		<div class="rows">
			<table width="100%"><tr>
				 <th width="20%" align="center">Booking Date</th>
				 <th width="40%" align="left">Particulars</th>
				 <th width="20%" align="center">Km./Hrs.</th>
				 <th width="20%" align="right">Rate</th>
				 </tr>
			 </table>			
		</div>
		<?php
			$sqlRec = mysql_query("SELECT * FROM `billprintrecord` WHERE `refsId` = '$bid'");
			if(mysql_error()){
				echo mysql_error();
			}else{
			$rate = 0;
				while($rowsRec = mysql_fetch_assoc($sqlRec)){
					?>
					<div class="rows">
						<table width="100%">
						<tr>
							 <td width="20%" align="center"><?php echo $rowsRec['orderDate']; ?></td>
							 <td width="40%" align="left"><?php echo $rowsRec['details']; ?></td>
							 <td width="20%" align="center"><?php echo $rowsRec['kmhrs']; ?></td>
							 <td width="20%" align="right">
								 <img src="http://192.168.1.202/kkcabs-new/core/images/rs.png" width="10px" align="absmiddle" />
								 <?php
								 echo $curRate = $rowsRec['rate'];
									$rate = $curRate+1;
								 ?>
								 
							 </td>
						 </tr>
						 </table>			
					</div>
					<?php
				}
			}
		?>
	</div>
	
	<div class="content">
	</div>
	
	<div class="footer_content">
		
		<div class="total-rows">
			<table width="100%">
				<tr><td><b>Total Amount : </b><img src="http://192.168.1.202/kkcabs-new/core/images/rs.png" width="10px" align="absmiddle" /></td><td><?php echo $rate; ?></td></tr>
				<tr><td><b>Advance Amount : </b><img src="http://192.168.1.202/kkcabs-new/core/images/rs.png" width="10px" align="absmiddle" /></td><td><?php echo $adv = $rowsCust['advance']; ?></td></tr>
				<tr><td><b>Balance Amount : </b><img src="http://192.168.1.202/kkcabs-new/core/images/rs.png" width="10px" align="absmiddle" /></td><td><?php echo $bal = $rate - $adv;  ?></td></tr>
			</table>
		</div>
		
		<div class="note">
			<span><b>Note :</b> Payment cheque / DD in favour of KKCABS. </span>
		</div>
		
		<div class="signature">
			<span>FOR KKCABS</span>
		</div>
		<div class="footer">
			<span>www.kkcabs.com</span>
		</div>
	</div>
</div>
</body>

</html>
<?php
}
?>

