<?php error_reporting(0); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 

require "php/auth.php";
require_once "php/connection.php";
//include 'php/session-watch.php';
$eid = $_SESSION['EMP_ID'];
$date = date('Y-m-d');
 //profile image

 $img = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$eid'");
 $coimg = mysql_num_rows($img);

 $roEmp = mysql_fetch_assoc($img);
 $imgEmp = $roEmp['emp_img_content'];
 $type = $roEmp['access_level'];

 //end profile image
?>

<title>Welcome <?php  echo  $_SESSION['EMP_NAME'];  ?></title>

<link href="images/li.png" rel="shortcut icon" />
<link rel="stylesheet" href="css/screen.css" type="text/css" />
<link rel="stylesheet" href="css/buttons.css" type="text/css" />
<link href="css/vertical_menu.css" rel="stylesheet" type="text/css" />
<link href="css/redmond/jquery.ui.datepicker.css" rel="stylesheet" type="text/css"/>
<link href="css/dhtmlxchart.css" rel="stylesheet" type="text/css"/>
<link href="css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />

<!-- SCRIPT FILE GOES HERE-->
<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src='scripts/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='scripts/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript" src="scripts/pss-page-engine.js"></script>
<script type="text/javascript" src="scripts/events.js"></script>
<script type="text/javascript" src="scripts/pss_window.js"></script>
<script type="text/javascript" src="scripts/pss-widgets.js"></script>
<script type="text/javascript" src="scripts/xhrResposeHandler.js"></script>
<script type="text/javascript" src="scripts/widget-drag.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="scripts/pss-validator.js"></script>
<script type="text/javascript" src="scripts/pss-pager.js"></script>
<script type="text/javascript" src="scripts/ajax-form.js"></script>
<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/jquery.fixedheader.js"></script>
<script type="text/javascript" src="scripts/app.js"></script>
<script type="text/javascript" src="scripts/jquery-blink.js"></script>
<script type="text/javascript" src="scripts/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="scripts/smartpaginator.js"></script>
<script type="text/javascript" src="scripts/jquery.simplyCountable.js"></script>
<script type="text/javascript">

//--------------for Main content---
    function showMainAction(str)
    {
            var uri = str;
            var obj = document.getElementById("mainContent");
            var thisLoc = location.href;
            var hb = thisLoc.indexOf("#!");
            if(hb){
                    thisLoc = thisLoc.substring(thisLoc,hb);
                   location.href=thisLoc+"#!"+uri;
            }else
                    //location.href=location.href+"#!"+uri;
            alertDisp('Loading...','statusType-info',0);
            /*$(obj).load(uri,function(response, status, xhr) {
                    if (status == "error") {
                            alertDisp(formatErrMsg(xhr.status),'statusType-error');
                    }
                    hideAlert();
            });*/

            var linkRequest = $.ajax({
                      url: uri,
                      type: "GET",
                      dataType: "html"
                    });
                    linkRequest.done(function(data, textStatus, jqXHR){
                            alertDisp('Transaction Complete.','statusType-info');
                            $("#mainContent").html(data);
                    });
                    linkRequest.fail(function(data, textStatus, jqXHR){
                            alertDisp('Transaction Failed!','statusType-error');
                    });
    }
	/*for logout*/
	
	function cfnLogout(num){
            var ans = confirm('Your total number of bookings today: '+num+'\n\nSure you want to logout?');
            if(!ans) return false;
            showMainAction('logout.php');
    }
	 function deleteAction(str){
            //alert(str);
            var ans = confirm("Sure you want to delete?");
            if(ans==false){
                    return;
            }
            var linkRequest = $.ajax({
              url: str,
              type: "GET",
              dataType: "html"
            });
            linkRequest.done(function(data, textStatus, jqXHR){
                    $("#mainContent").html(data);
                    alertDisp('Deleted.','statusType-info');
            });
            linkRequest.fail(function(data, textStatus, jqXHR){
                    alertDisp('Delete Failed!','statusType-error');
            });
    }
    function showFromBooking()
			{
                            
				//alert(str);
                                var con = $('#cono').val();
                                if(con == "Type No."){
                                    alert("Please Enter 10 digit mobile no or 8 digit Phone No.");
                                    return false;
                                }
                                var strlen = $('#cono').val().length;
                                //alert(strlen);
                                if(strlen == 10 || strlen == 8){
                                    var uri = "../master/form/booking-form.php?ty=M&no="+con;
				var obj = document.getElementById("mainContent")
				$(obj).load(uri,function(response, status, xhr) {
					if (status == "error") {
						alertDisp(formatErrMsg(xhr.status),'statusType-error');
					}
                                        if (status == "success") {
                                            $('#cono').removeAttr("value");
					}
				});
                                   
                                }else{
				 alert("Please Enter correct contact no.");
                                }
			}
</script>
</head>
<body> 
    <?php
    $active = $_GET['act'];
   
   ?>
<!-- HEADER-->
<div id="header">
	<div class="apptitle"><img src="images/home_title.png" alt="KK Cabs"/></div>
	<div class="profile">
	
          <table width="100%" border="0">
            <tr align="center" valign="middle">
              
              <td width="12%">
                 <?php
                     //profile image
                     $img = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$eid'");
                     $coimg = mysql_num_rows($img);

                     $roEmp = mysql_fetch_assoc($img);
                     $imgEmp = $roEmp['emp_img_content'];
                     $type = $roEmp['access_level'];
                     if($imgEmp == "" || $imgEmp == "employeeImages/"){
                              echo '<img src="images/user_png.png"  width="25" height="25" align="absmiddle"  />';
                        }else{
                               echo '<img src="'.$imgEmp.'" width="25" height="25" align="absmiddle" style="border:3px solid #ffffff;" />';

                     }
                     //end profile image
                 ?>
  
            </td>
        <td width="36%" align="left">
            
            <a href="#" id="../master/form/proffile-setting.php?id=<?php echo $eid; ?>" onClick="showMainAction(this.id)"><?php echo  $_SESSION['EMP_NAME'];  ?></a>         
        </td>
                
          <td width="15%">
		  <div id="settings"><img src="images/my-account.png" alt="setting" title="settings" /></div>
			
		  </td>
         <td width="15%">
            <a  href="#" id="logout.php" <?php if($type == 1 || $type == 6){ echo 'onClick="showMainAction(this.id)"'; }else{?> onClick="cfnLogout(<?php echo $countAwr; ?>);" <?php } ?> ><img src="images/logout.png" alt="logout" title="logout"/></a>
	</td>
        </tr>
    </table>
    </div>
	
</div>
<!--END HEADER-->
<!--LEFT SIDE-->
<div id="left-sidebar">
<div class="demo-container clear">
<div class="dcjq-vertical-mega-menu">
<ul id="mega-1" class="menu">
<li id="menu-item-0"><a href="#" id="../master/form/main-home.php" onClick="showMainAction(this.id)" class="tip" title="HOME" accessKey="z"><img src="images/home.png" /></a></li>
<?php
		if($type == 1 || $type == 6){
		?>
<li id="menu-item-1"><a href="#"><img src="images/master.png" /></a>
<ul>

	<li><a href="#" id="../master/form/view-area.php" onClick="showMainAction(this.id)"><img src="images/mainarea.png" align="absmiddle"/>&nbsp;View Areas</a></li>
	<li><a href="#" id="../master/form/view-sub-area-fronted.php" onClick="showMainAction(this.id)">
	<img src="images/subarea.png" align="absmiddle" />&nbsp;View Sub Area</a></li>
	<li><a  href="#" id="../master/form/view-cab-type.php" onClick="showMainAction(this.id)"> <img src="images/actions/car.png" align="absmiddle"/>&nbsp;View Cab Types</a></li>
	<li><a href="#" id="../master/form/view-services.php" onClick="showMainAction(this.id)"><img src="images/services.png" align="absmiddle"/>&nbsp;View All Services</a></li>
        <li>&nbsp;</li>
</ul>
</li>
<?php
                }
?>

<li id="menu-item-3"><a href="#"><img src="images/order.png" /></a>
	<ul>
		<li><a href="#" id="../master/form/booked-order-list.php" onClick="showMainAction(this.id)" accessKey="w"><img src="images/waiting.png" align="absmiddle" />&nbsp;Waiting Orders</a></li>
		<li><a href="#" id="../master/form/OnlineRecordFronted.php" onClick="showMainAction(this.id)" accessKey="o"><img src="images/online.png" align="absmiddle" />&nbsp;Online Order</a></li>
		<li><a href="#" id="../master/form/dispatch-order-list.php" onClick="showMainAction(this.id)" accessKey="k"><img src="images/dispatch.png" align="absmiddle"/>&nbsp;Trip Details</a></li>
		<li><a href="#" id="../master/form/order-cancel-list.php" onClick="showMainAction(this.id)" accessKey="t"><img src="images/canceld.png" align="absmiddle"/>&nbsp;Canceled Orders</a></li>
        <li><a href="#" id="../master/form/free-cab-list.php" onClick="showMainAction(this.id)" accessKey="n"><img src="images/green-cab.png" width="16" height="16" align="absmiddle"/>&nbsp;Free Cabs</a></li>
		<li><a href="#" id="../master/form/add-free-cab.php" onClick="showMainAction(this.id)"><img src="images/car_add.png" width="16" height="16" align="absmiddle"/>&nbsp;Add Free Cabs</a></li>
		<?php
		if($type == 1 || $type == 2 || $type == 5 || $type == 6 || $type == 7){
		?><li><a href="#" id="../master/form/trip-count-front.php" onClick="showMainAction(this.id)"><img src="images/trip.png" align="absmiddle"/>&nbsp;Trip Count</a></li>
		<?php } ?>
        <li>&nbsp;</li>
        </ul>
</li>
<?php
if($type == 1 || $type == 6 || $type == 5 || $type == 2 || $type == 7){
?>
<li id="menu-item-4"><a href="#"><img src="images/cabs.png" /></a>
	<ul>
		<?php
		if($type == 1 || $type == 5 || $type == 6 || $type == 7){
		?>
		<li><a href="#" id="../master/form/view-cab-record.php?check=ACT" onClick="showMainAction(this.id)"><img src="images/wightcar.png" width="16" height="16" align="absmiddle"/> &nbsp;Cabs</a></li>
		<li><a href="#" id="../master/form/view-driver-record.php" onClick="showMainAction(this.id)"><img src="images/alldrivers.png" align="absmiddle"/>&nbsp;Assign Drivers</a></li>
		<li><a href="#" id="../master/form/view-owner-record.php?did=3" onClick="showMainAction(this.id)"><img src="images/alldrivers.png" align="absmiddle"/>&nbsp;Owners</a></li>
		<?php
		}
		?>
		<?php
		if($type == 1 || $type == 2 || $type == 5 || $type == 6 || $type == 7){
		?><li><a href="#" id="../master/form/current-drivers.php" onClick="showMainAction(this.id)" accessKey="j"><img src="images/curentdrivers.png" align="absmiddle"/>&nbsp;Current drivers</a></li>
		<?php
			}
		?>
		<?php
                if($type == 1 || $type == 5 || $type == 6 || $type == 7){
                ?>
                <li><a href="#" id="../master/form/make-payment.php" onClick="showMainAction(this.id)"><img src="images/actions/money.png"/>&nbsp;Make Payment</a></li>
		<?php } ?>
		
                <li>&nbsp;</li>
        </ul>
</li>

<li id="menu-item-5"><a href="#"><img src="images/employee.png" /></a>
	<ul>
		<li><a href="#" id="../master/form/view-employee.php?pas=1" onClick="showMainAction(this.id)"><img src="images/actions/employee.png" align="absmiddle"/>&nbsp;All Employees</a></li>
		<?php
			if($type == 1 || $type == 6){
			?>
			<li><a href="#" id="../master/form/view-employee.php?pas=0" onClick="showMainAction(this.id)"><img src="images/user_male_delete.png" width="16" height="16" align="absmiddle" />&nbsp;Trash Employee</a></li>
			<li><a href="#" id="../master/form/employeeBookingOrder.php" onClick="showMainAction(this.id)"><img src="images/empreport.png" align="absmiddle" />&nbsp;Booking Report</a></li>
				<?php
			}
		?>
		<li><a href="#" id="../master/form/add-new-employee.php" onClick="showMainAction(this.id)"><img src="images/actions/001_01.png" align="absmiddle"/>&nbsp;Add Employee</a></li>
		<li><a href="#" id="../master/form/employee-login.php" onClick="showMainAction(this.id)"><img src="images/login-details.png" width="16" height="16" />&nbsp;Login Report</a></li>
		<li>&nbsp;</li>
	</ul>   

</li>

<li id="menu-item-6"><a href="#"><img src="images/customers.png" /></a>
	<ul>
            <?php
                if($type == 1 || $type == 6){
                ?>
				<li><a href="#" id="../master/form/view-customers-fronted.php" onClick="showMainAction(this.id)"><img src="images/allcustomers.png" align="absmiddle" />&nbsp;Customers</a></li>
                <?php
                }
                if($type == 1 || $type == 5 || $type == 6 || $type == 7){
                ?>
                <li><a href="#" id="../master/form/create-customer-bill.php" onClick="showMainAction(this.id)"><img src="images/cusbill.png"  align="absmiddle" />&nbsp;Make bill</a></li>
				<li><a href="#" id="../master/form/sms-customers-fronted.php" onClick="showMainAction(this.id)"><img src="images/consulting.png" align="absmiddle" width="16" height="16" />&nbsp;Send SMS</a></li>
                <?php
                }
                ?>
                <li>&nbsp;</li>
        </ul>
</li>
<?php
                if($type == 1 || $type == 6){
                ?>
<li id="menu-item-7"><a href="#"><img src="images/statistics.png" /></a>
	<ul>
		<li><a href="#" id="../master/form/cabPyametsFronted.php" onClick="showMainAction(this.id)"><img src="images/cabpayment.png" align="absmiddle" />&nbsp;Cab Payments</a> </li>
		<li><a href="#" id="../master/form/deposit-summary.php" onClick="showMainAction(this.id)"><img src="images/deposite.png" align="absmiddle" />&nbsp;Deposit Summary</a></li>
		<li><a href="#" id="../master/form/cabLoginReportFronted.php" onClick="showMainAction(this.id)"><img src="images/cablogin.png" align="absmiddle" />&nbsp;Cab Login Record</a></li>
                <li><a href="#" id="../master/form/make-expense-forented.php" onClick="showMainAction(this.id)"><img src="images/bill.png"  align="absmiddle"/>&nbsp;Expense</a></li>
                <li>&nbsp;</li>
        </ul>
</li>
<?php
                }
}
?>
<li id="menu-item-8"><a href="#"><img src="images/tools.png" /></a>
	<ul>
		<li><a href="#" onClick="window.open('http://192.168.1.202/kkcabs-new/master/form/calc.php','KK SCRIPT','width=250,height=200')"><img src="images/Calculator.png" align="absmiddle"/>&nbsp;Calculator</a></li>
		<li><a href="#" onClick="window.open('http://192.168.1.202/kkcabs-new/master/form/map.php','KK SCRIPT','width=750,height=500')"><img src="images/map.png" align="absmiddle"/>&nbsp;Maps</a></li>
		
		<li><a href="#" onClick="window.open('http://192.168.1.202/kkcabs-new/master/form/welcome-note.php','KK SCRIPT','width=500,height=600')" ><img src="images/script.png" align="absmiddle" />&nbsp;KK Script</a></li>
		<li><a href="#" onClick="window.open('http://192.168.1.202/kkcabs-new/master/form/cab-rates.php','Cab Rates','width=500,height=600')"><img src="images/rate-card.png" align="absmiddle" />&nbsp;Cab Rates</a></li>
                <li>&nbsp;</li>
        </ul>
</li>

</ul>
</div>
</div>
		
		
</div>
<!--END LEFT SIDE-->
<!--RIGHT SIDE-->
<div id="right-sidebar">
<div id="displaysettingbox">
		<ul>
			<li><img src="images/employee.png" width="16" height="16" align="absmiddle" /> <a href="#" id="../master/form/proffile-setting.php?id=<?php echo $eid; ?>" onclick="showMainAction(this.id)" accessKey="p">My Account</a></li>
			<li><img src="images/email.png" width="16" height="16" align="absmiddle" /><a href="#" id="../master/form/mail-account.php"  onclick="showMainAction(this.id)" accessKey="m" >Mail Box</a></li>
			<?php if($type == 1 || $type == 6){
				?>
			 <li><img src="images/calculator.png" align="absmiddle"/><a href="#" id="../master/form/monthelly-report-fronted.php?m=<?php echo date('m'); ?>" onclick="showMainAction(this.id)" accessKey="l">&nbsp;Monthly Report</a></li>
			<?php
			}else{
				?>
			<li><img src="images/calculator.png" align="absmiddle"/><a href="#" id="../master/form/logoff.php" onclick="showMainAction(this.id)" accessKey="l">&nbsp;Log off</a></li>
		   
			 <?php
			 $sesSql = mysql_query("SELECT * FROM `employee_login` WHERE `emp_id` = '$eid' AND `status` = 0 AND DATE_FORMAT(`date`, '%y-%m-%d') = '$date' ORDER BY `logoff_id` DESC ");
			 if(mysql_error()){
				 // do notink
			 }else{
				 $countApp = mysql_num_rows($sesSql);
				 if($countApp < 1){
				   ?>
			<li><img src="images/emblem-symbolic-link.png" align="absmiddle" width="16"/><a href="#" id="../master/form/grant_logout.php" onclick="showMainAction(this.id)" accessKey="l">&nbsp;Grant my Logout</a></li>
					 <?php
				 }
				
			 }
			}
			?>
			<li>&nbsp;</li>
		</ul>
	</div>
    <div>
        <div class="title">10 Digit No.</div>
        <div class="right-content">
             <form>
                    <input type="text" id="cono" onfocus="if (this.value=='Type No.') this.value = ''" value="Type No." maxlength="12" class="inputbox" />
                    <input type="button" onclick="showFromBooking()" value="Go" class="NavButton"/>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" id="../master/form/booking-form-fornted.php?no=n" onClick="showMainAction(this.id)" accessKey="b"><img src="images/booking.png" width="20" height="20" align="absmiddle" /> </a>
            </form>
        </div>
    </div>
    <div class="incomingCall">
        <div class="title">Incoming Call</div>
        <div id="incomingStatus"></div>
    </div>
<div class="clear hr"></div>
<div id="responsecontainer"></div>
</div>
<!--END RIGHT SIDE-->
<!-- start content -->
<div id="content">
  <div id="mainContent">
		<div class="title-right" id="newcallrecord"></div>
		</div>
		<div class="freecablist">
			<div class="title">Free Cab List</div>
			<div id="freeCabSList"></div>
		 </div>
		 <div class="lastcalllist">
		 <div class="title">Last Call Record</div>
			<div id="lastRecordCall"></div>
		 </div>
		 <div class="scriptlist">
			<div class="title">Address shortcut key</div>
			<table>
				<tr><td>LAYOUT</td><td>lyt</td></tr>
				<tr><td>MAIN</td><td>man</td></tr>
				<tr><td>STAGE</td><td>stg</td></tr>
				<tr><td>VILLAGE</td><td>vlg</td></tr>
				<tr><td>STREET</td><td>str</td></tr>
				<tr><td>BLOCK</td><td>blk </td></tr>
				<tr><td>ROAD</td><td>rd</td></tr>
				<tr><td>CROSS</td><td>crs</td></tr>
				<tr><td>SECTOR</td><td>sct</td></tr>
				<tr><td>OPPOSITE</td><td>op</td></tr>
				<tr><td>NEAR</td><td>nr</td></tr>
				<tr><td>EXTENTION</td><td>ext</td></tr>
			</table>
		 </div>
        <div class="shortcutdetails">
            <div class="title">App. Shortcut key</div>
			<table>
				<tr><td>Booking from</td><td>Alt+b, Alt+B</td></tr>
				<tr><td>Add free cab</td><td>Alt+c, Alt+C</td></tr>
				<tr><td>List Free Cab</td><td>Alt+n, Alt+N</td></tr>
                                <?php
                                if($type == 1 || $type == 5 || $type == 6){
                                ?>
				<tr><td>Current Drivers</td><td>Alt+j, Alt+J</td></tr>
                                <?php
                                }
                                ?>
				<tr><td>Home page</td><td>Alt+z, Alt+Z</td></tr>
				<tr><td>Waiting Order</td><td>Alt+w, Alt+W </td></tr>
				<tr><td>Online Order</td><td>Alt+o, Alt+O </td></tr>
				<tr><td>Dispatch Order</td><td>Alt+k, Alt+K </td></tr>
				<tr><td>Canceled Order</td><td>Alt+t, Alt+T </td></tr>
				<tr><td>Mail Box</td><td>Alt+m, Alt+M</td></tr>
				<tr><td>My Profile</td><td>Alt+p, Alt+P</td></tr>
			</table>
        </div>
    <div id="onlineStatus"></div>
</div>
<!--ENF CONTENT-->
<!-- start footer -->        
<div id="footer"><!--  start footer-left -->
	<div id="footer-right">
	
	<span id="spanYear">&copy;2012</span> <a href="http://www.kkcabs.com">KK Cabs</a>. All rights reserved.Develope By Amit Kumar:amithsingh009@gmail.com</div>
	<!--  end footer-left -->
	<div id="footer-left">
	<ul>
	<li id="freecabIcon"><img src="../core/images/wightcar.png" width="22" height="22" /></li>
	<li id="scriptIcon"><img src="../core/images/cabs-drivers.png" width="22" height="22" /></li>
	<li id="lastcallIcon"><img src="../core/images/employee_book.png" width="22" height="22" /></li>
	<li id="shortcutIcon"><img src="../core/images/shortcut.png" width="22" height="22" /></li>
	</ul>
	</div>
	<div class="clear">&nbsp;</div>
	
	
</div>
<!--end footer -->
<script>
    var uri = "../master/form/main-home.php";
	var obj = document.getElementById("mainContent");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
       /* var coreuri = "../master/form/coreconnection.php";
	var obj = document.getElementById("incomingStatus");
        
	$(obj).load(coreuri,function(response, status, xhr) {
		if (status == "error") {
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});*/
	 //setting up access keys
        document.getElementById("../master/form/booking-form-fornted.php?no=n").accessKey = "b";
        document.getElementById("../master/form/main-home.php").accessKey = "z";
        document.getElementById("../master/form/add-free-cab.php").accessKey = "c";
        document.getElementById("../master/form/free-cab-list.php").accessKey = "n";
        <?php
        if($type == 1 || $type == 5 || $type == 6){
        ?>
        document.getElementById("../master/form/current-drivers.php").accessKey = "j";
        <?php
        }
        ?>
        //document.getElementById("../master/form/employee-activity.php").accessKey = "g";
        document.getElementById("../master/form/proffile-setting.php?id=<?php echo $eid; ?>").accessKey = "p";
        document.getElementById("../master/form/mail-account.php").accessKey = "m";
        document.getElementById("../master/form/booked-order-list.php").accessKey = "w";
         document.getElementById("../master/form/dispatch-order-list.php").accessKey = "k";
        document.getElementById("../master/form/logoff.php").accessKey = "l";
        document.getElementById("../master/form/OnlineRecordFronted.php").accessKey = "o";
        document.getElementById("../master/form/order-cancel-list.php").accessKey = "t";
</script>
</body>
</html>