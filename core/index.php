<!DOCTYPE html>
<!--[if lt IE 7]>        <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>            <html class="no-js lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>            <html class="no-js lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js">                        <!--<![endif]-->

<?php 
require "php/auth.php";
require_once "php/connection.php";
//include 'php/session-watch.php';
$eid = $_SESSION['EMP_ID'];
$date = date('Y-m-d');
 //profile image

 $sql = mysql_query("SELECT emp_img_content,access_level,emp_name,email FROM `employee` WHERE `emp_id` = '$eid'");
 $num = mysql_num_rows($img);

 $roEmp = mysql_fetch_assoc($img);
 $imgEmp = $roEmp['emp_img_content']; 
 $type = $roEmp['access_level'];
 $name = $roEmp['emp_name'];
 $email = $roEmp['email'];

 //end profile image
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Welcome <?php echo $name; ?></title>
        <meta name="viewport" content="width=device-width">
		
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap-responsive.min.css">
        <link type="text/css" rel="stylesheet" href="assets/fontawesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/layout2.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/calendar.css"/>

        <link rel="stylesheet" href="assets/css/theme.css">

        <script type="text/javascript" src="assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="assets/js/html5.js"></script><![endif]-->
        <!--[if IE 7]>
    
        
        <![endif]-->
    </head>
    <body id="main" class="main">
        <!-- BEGIN WRAP -->
        <div id="wrap">

            <!-- BEGIN TOP BAR -->
            <div id="top">
                <!-- .navbar -->
                <div class="navbar navbar-inverse navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <a class="brand" href="index.html">KK CABS</a>
                            <!-- .topnav -->
                            <div class="btn-toolbar topnav">
                                <div class="btn-group">
                                    <a id="changeSidebarPos" class="btn btn-success" rel="tooltip"
                                       data-original-title="Show / Hide Sidebar" data-placement="bottom">
                                        <i class="icon-resize-horizontal"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-inverse" rel="tooltip" data-original-title="E-mail" data-placement="bottom">
                                        <i class="icon-envelope"></i>
                                        <span class="label label-warning">5</span>
                                    </a>
                                    <a class="btn btn-inverse" rel="tooltip" href="#" data-original-title="Messages"
                                       data-placement="bottom">
                                        <i class="icon-comments"></i>
                                        <span class="label label-important">4</span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-inverse" rel="tooltip" href="#" data-original-title="Document"
                                       data-placement="bottom">
                                        <i class="icon-file"></i>
                                    </a>
                                    <a href="#helpModal" class="btn btn-inverse" rel="tooltip" data-placement="bottom"
                                       data-original-title="Help" data-toggle="modal">
                                        <i class="icon-question-sign"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-inverse" data-placement="bottom" data-original-title="Logout" rel="tooltip"
                                       href="login.html"><i class="icon-off"></i></a></div>
                            </div>
                            <!-- /.topnav -->
                            <div class="nav-collapse collapse">
                                <!-- .nav -->
                                <ul class="nav">
                                    <li class="active"><a href="index.html">Dashboard</a></li>
                                     <li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            Orders <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
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
                                        </ul>
                                    </li>
                                     <li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            Cabs & Drivers <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
										
											<li><a href="#" id="../master/form/view-cab-record.php?check=ACT" onClick="showMainAction(this.id)"><img src="images/wightcar.png" width="16" height="16" align="absmiddle"/> &nbsp;Cabs</a></li>
											<li><a href="#" id="../master/form/view-driver-record.php" onClick="showMainAction(this.id)"><img src="images/alldrivers.png" align="absmiddle"/>&nbsp;Assign Drivers</a></li>
											<li><a href="#" id="../master/form/view-owner-record.php?did=3" onClick="showMainAction(this.id)"><img src="images/alldrivers.png" align="absmiddle"/>&nbsp;Owners</a></li>
											<li><a href="#" id="../master/form/current-drivers.php" onClick="showMainAction(this.id)" accessKey="j"><img src="images/curentdrivers.png" align="absmiddle"/>&nbsp;Current drivers</a></li>
											<li><a href="#" id="../master/form/make-payment.php" onClick="showMainAction(this.id)"><img src="images/actions/money.png"/>&nbsp;Make Payment</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            Employee <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                           	<li><a href="#" id="../master/form/view-employee.php?pas=1" onClick="showMainAction(this.id)"><img src="images/actions/employee.png" align="absmiddle"/>&nbsp;All Employees</a></li>
											<li><a href="#" id="../master/form/view-employee.php?pas=0" onClick="showMainAction(this.id)"><img src="images/user_male_delete.png" width="16" height="16" align="absmiddle" />&nbsp;Trash Employee</a></li>
											<li><a href="#" id="../master/form/employeeBookingOrder.php" onClick="showMainAction(this.id)"><img src="images/empreport.png" align="absmiddle" />&nbsp;Booking Report</a></li>
											<li><a href="#" id="../master/form/add-new-employee.php" onClick="showMainAction(this.id)"><img src="images/actions/001_01.png" align="absmiddle"/>&nbsp;Add Employee</a></li>
											<li><a href="#" id="../master/form/employee-login.php" onClick="showMainAction(this.id)"><img src="images/login-details.png" width="16" height="16" />&nbsp;Login Report</a></li>
                                        </ul>
                                    </li>
									<li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            Customers <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
											<li><a href="#" id="../master/form/view-customers-fronted.php" onClick="showMainAction(this.id)"><img src="images/allcustomers.png" align="absmiddle" />&nbsp;Customers</a></li>
											<li><a href="#" id="../master/form/create-customer-bill.php" onClick="showMainAction(this.id)"><img src="images/cusbill.png"  align="absmiddle" />&nbsp;Make bill</a></li>
											<li><a href="#" id="../master/form/sms-customers-fronted.php" onClick="showMainAction(this.id)"><img src="images/consulting.png" align="absmiddle" width="16" height="16" />&nbsp;Send SMS</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.nav -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.navbar -->
            </div>
            <!-- END TOP BAR -->


            <!-- BEGIN HEADER.head -->
            <header class="head">
                
                <!-- ."main-bar -->
                <div class="main-bar">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12">
                                <h3><i class="icon-home"></i> Dashboard</h3>
                            </div>
                        </div>
                        <!-- /.row-fluid -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
				<div class="search-bar">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="search-bar-inner">
                                <a id="menu-toggle" href="#menu" data-toggle="collapse"
                                   class="accordion-toggle btn btn-inverse visible-phone"
                                   rel="tooltip" data-placement="bottom" data-original-title="Show/Hide Menu">
                                    <i class="icon-sort"></i>
                                </a>

                               
								 <form class="main-search">
									<input type="text" id="cono" class="input-block-level" maxlength="12" placeholder="Mobile number" />
									
									<button id="searchBtn" type="submit"  onclick="showFromBooking()" class="btn btn-inverse">GO</button>
								</form>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.main-bar -->
            </header>
            <!-- END HEADER.head -->

            <!-- BEGIN LEFT  -->
            <div id="left">
                <!-- .user-media -->
                <div class="media user-media hidden-phone">
                    <a href="" class="user-link">
						<?php
						if($imgEmp == "" || $imgEmp == "employeeImages/"){
								  echo '<img src="images/user_png.png" align="absmiddle" class="media-object img-polaroid user-img" />';
							}else{
								   echo '<img src="'.$imgEmp.'"  align="absmiddle" class="media-object img-polaroid user-img" />';

						 }
						?>
                        <span class="label user-label">16</span>
                    </a>

                    <div class="media-body hidden-tablet">
                        <h5 class="media-heading"><?php echo $name;?></h5>
                        <ul class="unstyled user-info">
						<?php
						if($type == 1){
							  echo '<li><a href="">Administrator</a></li>';
							}
						elseif($type == 2){
							echo '<li><a href="">Manager</a></li>';
						}
						else{
							echo '<li><a href="">Not Assign</a></li>';
						 }
						?>
                            
                            <li>Last Access : <br/>
                                <small><i class="icon-calendar"></i> 16 Mar 16:32</small>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.user-media -->

                <!-- BEGIN MAIN NAVIGATION -->
                <ul id="menu" class="unstyled accordion collapse in">
                    <li class="accordion-group active">
                        <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#dashboard-nav">
                            <i class="icon-dashboard icon-large"></i>Free Cab List<span
                                class="label label-inverse pull-right">2</span>
                        </a>
                        <ul class="collapse in" id="dashboard-nav">
                           <div id="freeCabSList"></div>
                        </ul>
                    </li>
                    <li class="accordion-group ">
                        <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                            <i class="icon-tasks icon-large"></i> Last Call Record <span class="label label-inverse pull-right">2</span>
                        </a>
                        <ul class="collapse " id="component-nav">
                            <div id="lastRecordCall"></div>
                        </ul>
                    </li>
                    <li class="accordion-group ">
                        <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                            <i class="icon-pencil icon-large"></i> Address shortcut key <span class="label label-inverse pull-right">4</span>
                        </a>
							
                    </li>
                    
                    <li class="accordion-group ">
                        <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav">
                            <i class="icon-warning-sign icon-large"></i> App. Shortcut key <span
                                class="label label-inverse pull-right">7</span>
                        </a>
                        
                    </li>
                    
                </ul>
                <!-- END MAIN NAVIGATION -->

            </div>
            <!-- END LEFT -->

            <!-- BEGIN MAIN CONTENT -->
            <div id="content">
                <!-- .outer -->
                <div  class="container-fluid outer">
                    <div class="row-fluid">
                        <!-- .inner -->
                        <div class="span12 inner">
                            <div class=""></div>
                        </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.row-fluid -->
                </div>
                <!-- /.outer -->
            </div>
            <!-- END CONTENT -->
            <!-- #right -->
            <div id="right">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                           
                            <!-- .well well-small -->
                            <!-- .well well-small -->
                            <div class="well well-small dark">
								<h5>Orders Status</h5>
                                <span>Book</span><span class="pull-right"><small>20%</small></span>

                                <div class="progress progress-info mini">
                                    <div class="bar" style="width: 20%"></div>
                                </div>
                                <span>Dispatch</span><span class="pull-right"><small>40%</small></span>

                                <div class="progress progress-success mini">
                                    <div class="bar" style="width: 40%"></div>
                                </div>
                                <span>Cancel</span><span class="pull-right"><small>60%</small></span>

                                <div class="progress progress-warning mini">
                                    <div class="bar" style="width: 60%"></div>
                                </div>
                                <span>Missed</span><span class="pull-right"><small>80%</small></span>

                                <div class="progress progress-danger mini">
                                    <div class="bar" style="width: 80%"></div>
                                </div>
                            </div>
                            <!-- /.well well-small -->
                            <!-- .well well-small -->
                            <div class="well well-small dark">
								<div id="incomingStatus"></div>
                               
                                <button class="btn btn-success btn-block">In coming number</button>
                                <button class="btn btn-danger btn-block">miss numbers</button>
                                
                            </div>
                            <!-- /.well well-small -->
                            
                        </div>
                    </div>
                </div>

            </div>
            <!-- /#right -->

            <!-- #push do not remove -->
            <div id="push"></div>
            <!-- /#push -->
        </div>
        <!-- END WRAP -->

        <div class="clearfix"></div>

        <!-- BEGIN FOOTER -->
        <div id="footer">
            <p>2013 © KK Cabs</p>
        </div>
        <!-- END FOOTER -->

        <!-- #helpModal -->
        <div id="helpModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="helpModalLabel"><i class="icon-external-link"></i> Help</h3>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <div class="modal-footer">

                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
        <!-- /#helpModal -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>



        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script>window.jQuery.ui || document.write('<script src="assets/js/vendor/jquery-ui-1.10.0.custom.min.js"><\/script>')</script>


        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/lib/jquery.mousewheel.js"></script>

        <script src="assets/js/lib/jquery.sparkline.min.js"></script>

        <script src="assets/flot/jquery.flot.js"></script>
        <script src="assets/flot/jquery.flot.pie.js"></script>
        <script src="assets/flot/jquery.flot.selection.js"></script>
        <script src="assets/flot/jquery.flot.resize.js"></script>

        <script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
        <script src="assets/js/lib/jquery.tablesorter.min.js"></script>


        <script src="assets/js/main.js"></script>

        <script type="text/javascript">
            $(function() {
                dashboard();
            });
        </script>

        <script type="text/javascript" src="assets/js/style-switcher.js"></script>

    </body>
</html>