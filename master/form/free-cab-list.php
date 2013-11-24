<?php
/*********************************************************************************************

File Name: free-cab-list.php
Work and function: display list all free cab avilable.
T=table name -> free_cabs
##########
Create date = 29 NOV 2011
Time: 01:42
Last Update:
Date: __ NOV 20__
Time: 00:00
Author Name: amit kumar

***********************************************************************************************/
?>
<script type="text/javascript">
function showCabByArea(str){
	var uri = "../master/form/getcab-free.php?type="+str;
	var obj = document.getElementById("txtHintM")
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
}
$("#showtoolbox").click(function(){
		$(".toolsbox").slideToggle();
  });
</script>
<?php
require_once "../../core/php/connection.php";

	?>
<div class="formContainer" style="width:100%;">
    <table width="100%" border="0" cellspacing="0">
    <tr><th class="table-header">Free Cabs. <a href="#" id="showtoolbox">show</a></th></tr>
  <tr>
    <td width="13%" align="right" colspan="10">
        <div class="toolsbox">
            <table width="100%">
                <tr>
                    <td>
                       <select name="area" id="area" onchange="showCabByArea(this.value)">
                  <option value="ALL">ALL AREA</option>
      <?php
                    $are = mysql_query("SELECT * FROM `area` WHERE `status` = '1' ORDER BY  `area_name`");
                    $care = mysql_num_rows($are);
                    if($care == 0){
                        echo '<option>No Record Found</option>!';
                    }else{
                        while($ra = mysql_fetch_assoc($are)){
                            
                        ?>
      <option value="<?php echo $ra['area_id']; ?>"><?php echo $ra['area_name']; ?></option>
      <?php
                        }//while close
                    }
                    ?>
    </select> 
                    </td>
                </tr>
            </table>
        
        </div></td>
  </tr>
  <tr>
    <td colspan="2"><div id="txtHintM"></div></td>
  </tr>
</table>
</div>
<script language="javascript">
	var uri = "../master/form/getcab-free.php?type=ALL";
	var obj = document.getElementById("txtHintM")
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			//alert(formatErrMsg(xhr.status));
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
	});
</script>
