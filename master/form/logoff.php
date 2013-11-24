<script type="text/javascript">
function showLogoff(){
	
	var code = document.getElementById("code").value;
	var comm = document.getElementById("comm").value;
	
	var subA = $.ajax({
				url: '../master/php/logoff.php',
				type: 'POST',
				data: {cod:code, com:comm},
				dataType: "html",
				cache: false
			});
	subA.done(function(data, textStatus, jqXHR){
		$("#messageLog").html(data);
                
	});
}
</script>
        
<div class="overlay" id="overlay" style="display:block;"></div>
 
                <div class="box" id="box">
                 <h1>Application Logoff</h1>
                 <p>
                 <from id="frmCust">
                     <table>
                         <tr><td>&nbsp;</td></tr>
                         <tr>
                             <td colspan="2" align="center">
                                 <div id="messageLog">Please enter fields!</div>
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 Your Access Code :
                             </td>
                             <td>
                                 <input type="text" name="code" id="code" class="required"/>
                             </td>
                         </tr>
                         
                         <tr>
                             <td valign="top">
                                 Comment :
                             </td>
                             <td>
                                 <textarea name="comm" cols="40" id="comm" rows="4"></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2" align="right">
                                 <input type="button" value="Cancel" onClick="window.location.reload()" class="defaultButton" />
                                 <input type="submit" value="Confirm" class="defaultButton" onclick="showLogoff()" />
                             </td>
                         </tr>
                     </table>
                 </from>
                 </p>
                </div>

<script language="javascript">
$("#frmCust").validate();
</script>