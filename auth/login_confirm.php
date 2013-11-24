<?php
	require "../core/php/auth.php";
	require_once "../core/php/connection.php";
        date_default_timezone_set('Asia/Kolkata'); //time stamp
		$eid = $_SESSION['EMP_ID'];
		$ename = $_SESSION['EMP_NAME'];
	
		$type = $_SESSION['EMP_TYPE'];
                if($type == 1){
                        $val ="";
                }else{
                        $val = "AND `opp_b_id` = '".$eid."' OR `opp_d_id` = '".$eid."' OR `opp_u_id` = '".$eid."'";
                }
                $countPass = $_GET['cpas'];
                if($countPass == 0 || $countPass ==""){
                        $pass = 1;
                }else{
                $pass = $countPass+1;
                }
                
                $sysIP = $_SERVER["REMOTE_ADDR"];
                
                $sqlAcc = mysql_query("SELECT `access_code`,`date`,workin_time FROM `employee_login` WHERE `emp_id` = '$eid' AND `status` = '1' and `ip_address` = '$sysIP'");
		if($sqlAcc != TRUE){
                    header('location: access_fail.php');
                }
                $rowsAcc = mysql_fetch_assoc($sqlAcc);
                
                $code = $rowsAcc['access_code'];
                $worHrs = $rowsAcc['workin_time'];
                
                
                
?>
<html>
<meta http-equiv="refresh" content="10;url=http://192.168.1.202/kkcabs-new/" />
<head>
<style>
.fdsqwa{position:absolute;left:0;border:0.2px solid white;z-index:23;}</style>
<link href="css/login_stayle.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="conte">
<table width="600" border="0" align="center" style="margin-top:230px; margin-left:-10px; margin-right:-10px;">
  <tr bgcolor="#0D75A8">
    <td width="43%" align="right" bgcolor="#0D75A8"><div id="fdswqa1" class="fdsqwa">
    <img src="image/hjj.png" width="247" height="312" style="margin-top:-36px;" />
    
    </div></td>
    <td width="57%" align="left" valign="top">
    <div id="fdswqa2" class="fdsqwa">
    <form id="loginForm" name="loginForm" method="post"  action="scripts/validate_login.php"style="margin-top:-20px;">

                <table width="235" border="0" bgcolor="#0D75A8">
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="left"><em>Account login.</em><hr id="hr_black" /></td>
              </tr>
              <tr>
                <td width="93"><strong>Login Id:</strong></td>
                <td width="132"> <input name="login" type="text" id="input_text" placeholder="USER ID"  /></td>
              </tr>
              <tr>
                <td><strong>Password:</strong></td>
                <td><input name="password" type="password"  id="input_text" placeholder="PASSWORD" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Call Ext. <b>201</b> for Reset Password</td>
                <td align="right"><input name="Submit" type="submit" class="submit" value="Login" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table>
        </form>            
        </div>
     </td>
  </tr>
</table>

</div>

<div class="conte2">
<table width="416" border="0" align="center" class="table_confirs" cellspacing="0" cellpadding="0">
  <tr>
    <td width="137" rowspan="4" align="center" valign="middle">
    <?php
		 //$eid = $_SESSION['ID'];
		 //profile image
		 $img = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$eid'");
		 $coimg = mysql_num_rows($img);
		 if($coimg == 0){
			  echo '<img src="images/user_png.png" width="101" height="100"  />';
		 }else{
			 $ro = mysql_fetch_assoc($img);
			 $hj = $ro['emp_img_content'];
			 if ($hj != "") {
				echo '<img src="../core/'.$hj.'" width="101" height="100" border="4"  />';
			} else {
				echo '<img src="../core/images/user_png.png" width="101" height="100"  />';
			}
			
		 }
		 //end profile image
	?>
    </td>
    <td width="104"><strong>Code :</strong></td>
    <td width="161"><?php echo $ro['username']; ?></td>
  </tr>
  <tr>
    <td height="38"><strong>Name :</strong></td>
    <td><?php echo $ename; ?></td>
  </tr>
 <tr>
    <td height="38"><strong>Designation :</strong></td>
    <td><?php  $empType =  $ro['access_level'];
		$sqlAccCh = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = $empType");
		if(mysql_error()){
			 echo 'Not Define';
		}else{
			$rowsApp = mysql_fetch_assoc($sqlAccCh);
			echo $rowsApp['access_type'];
		} ?></td>
  </tr>
  <tr>
    <td height="39"><strong>Working Hrs.</strong></td>
    <td>
        <?php echo $worHrs; ?>
    </td>
  </tr>
  
  </tr>
  <tr>
    <td colspan="3" align="right">
    <form action="login_confirh_exe.php" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Type Confirm code:</strong></td>
    <input type="hidden" name="eid" value="<?php echo $eid; ?>">
    <td><input type="password" name="pws" required placeholder="***************"  ></td>
    <td><input type="submit" name="submit" value="Confirm" class="submit"></td>
  </tr>
  <tr><td colspan="5">
         
  <div class="passcode">
       <?php echo $code; ?>
	</div>
	<input type="hidden" value="<?php echo $code; ?>" name="passCode"/>
	<input type="hidden" value="<?php echo $pass; ?>" name="pass"/>
  </td></tr>
</table>

    </form>
</td>  </tr>
</table>


</div>

<script language="javascript" type="text/javascript">
var fdsera=document.layers?1:0;var fdsrea=document.all?1:0;FdszXa=24;var fdsrta=document.getElementById&&!document.all?1:0;var fdstra=10;var fdstya=new Array();Fdszxa=FdszXa+6; fDszxa=FdszXa+Fdszxa; fdSzxa=FdszXa+Fdszxa+fDszxa; fdsZxa=fdSzxa/fDszxa*FdszXa; fdszXa=fDszxa*FdszXa/12*Fdszxa; fdszxA=FdszXa+Fdszxa/fdsZxa-16*fdSzxa; FdsXza=fdszXa*(FdszXa-5)/fDszxa+fdSzxa; Fdsxza=FdsXza/fdszxA+FdszXa*fDszxa-fdSzxa;fDsxza=(Fdsxza+FdszXa/fDszxa*fdSzxa+Fdszxa*fdsZxa)/fdszXa+FdsXza-Fdsxza-1;fdSxza=Math.floor(fDsxza)   ;fdsXza=fdSxza-58;var fdsyta=new Array();
if (fdsera){
for (fdswqa=1;fdswqa<=fdsXza;fdswqa++){fdstya[fdswqa]=eval("document.fdswqa"+fdswqa+".clip");fdsyta[fdswqa]=eval("document.fdswqa"+fdswqa);fdstya[fdswqa].width=window.innerWidth/fdsXza;fdstya[fdswqa].height=window.innerHeight;fdsyta[fdswqa].left=(fdswqa-1)*fdstya[fdswqa].width;}}
else if (fdsrea||fdsrta){var fdsyua=fdsrta?window.innerWidth/fdsXza*0.94:document.body.clientWidth/fdsXza,fdsiua=0;
for (fdswqa=1;fdswqa<=fdsXza;fdswqa++){fdstya[fdswqa]=fdsrta?document.getElementById("fdswqa"+fdswqa).style:eval("document.all.fdswqa"+fdswqa+".style");fdstya[fdswqa].width=fdsrta?window.innerWidth/fdsXza*0.96:document.body.clientWidth/fdsXza;fdstya[fdswqa].height=fdsrta?window.innerHeight-1: document.body.offsetHeight;fdstya[fdswqa].left=(fdswqa-1)*parseInt(fdstya[fdswqa].width);}}
function fdsuya(){window.scrollTo(0,0);
if (fdsera){fdstya[1].right-=fdstra;fdstya[2].left+=fdstra;
if (fdstya[2].left>window.innerWidth/fdsXza);clearInterval(fdsuia);}
else if (fdsrea||fdsrta){fdsyua-=fdstra;fdstya[1].clip="rect(0 "+fdsyua+" auto 0)";fdsiua+=fdstra;fdstya[2].clip="rect(0 auto auto "+fdsiua+")";
if (fdsyua<=0){clearInterval(fdsuia);
if (fdsrta){fdstya[1].display="none";fdstya[2].display="none";}}}}
function fdsioa(){fdsuia=setInterval("fdsuya()",106);}fdsioa();
</script>
</body>

</html>