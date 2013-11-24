<link rel="stylesheet" href="http://192.168.1.202/kkcabs-new/core/css/screen.css" type="text/css" />
<script type="text/javascript" src="http://192.168.1.202/kkcabs-new/core/scripts/jquery164.js"></script>

<?php
$con = mysql_connect('localhost','root','THIPARAMBIL');
	if(!$con){
		echo "DB Connection failed.";
		exit(1);
	}
	$db = mysql_select_db('easybooking',$con);
  $cabId = $_GET['ratype'];
  
  $sqlCab = mysql_query("SELECT cab_type_id,cab_type_name FROM `cab_types` WHERE `cab_type_id` = '$cabId'");
  if(mysql_error()){
      echo mysql_error();
      exit(0);
      }else{
        $rowsCabTyp = mysql_fetch_assoc($sqlCab);
?>
<body style="margin:0;padding:0;">
<table width="100%" >
<tr><th align="center">Rate for the cab <?php echo $rowsCabTyp['cab_type_name']; ?> </th></tr>
<tr>
    <td>
        <table width="100%" id="product-table">
        <?php
        $sqlType = mysql_query("SELECT * FROM `cab_rate_title` WHERE `status` = 1");
        if(mysql_error()){
            echo 'Record not found.';
        }else{
            while($rowsTitle = mysql_fetch_assoc($sqlType)){
                $crtid = $rowsTitle['crt_id'];
                echo '<tr><th align="center" class="table-header-repeat"><b>'.$rowsTitle['crt_title'].'</b></th></tr>';
                //sub table content
                $sqlSub = mysql_query("SELECT * FROM `cab_rate_details` WHERE `crt_id` = $crtid and status = 1");
                if(mysql_error()){
                    //do nothink
                }else{
                    echo '<tr><td align="center"><table width="100%">';
                    while($rowsSub = mysql_fetch_assoc($sqlSub)){
                        $crdId = $rowsSub['crd_id'];
                        echo '<tr><td>'.$rowsSub['crd_title'].'</td><td>';
                            $sqlVal = mysql_query("SELECT * FROM `cab_rate_record` WHERE `crd_id` = '$crdId' AND `cab_type_id` = '$cabId' AND `status` = 1");
                            if(mysql_error()){
                                echo 'N/A';
                            }else{
                                $count = mysql_num_rows($sqlVal);
                                if($count == 0){
                                    echo 'N/A';
                                }
                                $rowVal = mysql_fetch_assoc($sqlVal);
                                echo $rowVal['crr_value'];
                            }
                         echo '</td></tr>';
                    }
                    echo '</table></td></tr>';
                }
            }
        }
        ?>
       </table>
    </td>
</tr>
</table>
</body>
<?php
      }
?>