<script language="javascript">
function showFreeCabs(obj, id, visibility) {
	if(keepPopup) return;
        //alert(12342);
	var o = document.getElementById(id);
	if(visibility=='none'){
		o.style.display = visibility;
		return;
	}
	var point = $(obj).offset();
	var oHeight = $(o).height();
	var oTop = point.top+oHeight;
	if(oTop>$(document).height()+10)
		oTop = point.top-oHeight;
	else
		oTop = point.top;
	$(o).css("top",oTop);
	$(o).css("left",point.offsetLeft);
	o.style.display = visibility;
}
</script>
<?php
require_once "../../core/php/connection.php";

	 echo '<table  width="200">';
		$sqAre = mysql_query("SELECT * FROM `area`");
		$countf = mysql_num_rows($sqAre);
		if($countf == 0){
			echo '<tr><td colspan="2">No Cabs..</td></tr>';
			
		}else{
                    $i = 1;
			while($rowsf = mysql_fetch_assoc($sqAre)){
				
				 $arId= $rowsf['area_id'];
						$cuCab = mysql_query("SELECT * FROM `free_cabs` WHERE `status` = 0 AND `location` = $arId");
						$coCab = mysql_num_rows($cuCab);
						if($coCab == 0){
							//do nothink
						}else{
							echo '<tr align="left"><td>';
							$roCab = mysql_fetch_assoc($cuCab);
							$cabId = $roCab['cab_id'];
							$arNam = mysql_query("SELECT * FROM `area` WHERE `area_id` = '$arId'");
							$roAr = mysql_fetch_assoc($arNam);
                                                        $p = $i++;
                                                        ?>
<a href="#" onMouseOver="showFreeCabs(this,'sub9<?php echo $p; ?>', 'inline');" onMouseOut="showFreeCabs(this,'sub9<?php echo $p; ?>', 'none');"><?php echo $roAr['area_name']; ?>	</a>
            <div id="sub9<?php echo $p; ?>" class="popup">
            <?php
            $CabShow = mysql_query("SELECT cab_id FROM `free_cabs` WHERE `status` = '0' AND `location` = '$arId'");
            if(mysql_error()){
                echo 'N/A';
            }else{
               while($roCabSh = mysql_fetch_assoc($CabShow)){
                   $cabId = $roCabSh['cab_id'];
                   $sqlCabDet = mysql_query("SELECT `cab_code` FROM `cabs` WHERE `cab_id` = $cabId");
                   $rop = mysql_fetch_assoc($sqlCabDet);
                   echo $rop['cab_code'].'<br/>';
               } 
            }
            ?>
         </div>
        <?php

        echo '</td><td align="left">';
        $toCab = mysql_query("SELECT * FROM `free_cabs` WHERE `status` = '0' AND `location` = '$arId'");
        $anCab = mysql_num_rows($toCab);
        echo $anCab;
        echo '</td></tr>';
}
		}
	}
	echo '</table>';
?>
