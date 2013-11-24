<script type="text/javascript">
			function showFromBooking(str)
			{
				//alert(str);
				var uri = "../master/form/booking-form.php?ty=M&no="+str;
				var obj = document.getElementById("bookingStatus")
				$(obj).load(uri,function(response, status, xhr) {
					if (status == "error") {
						alertDisp(formatErrMsg(xhr.status),'statusType-error');
					}
				});
			}
                        //end here
                        function showFromBookingPh(str)
			{
				//alert(str);
				var uri = "../master/form/booking-form.php?ty=P&no="+str;
				var obj = document.getElementById("bookingStatus")
				$(obj).load(uri,function(response, status, xhr) {
					if (status == "error") {
						alertDisp(formatErrMsg(xhr.status),'statusType-error');
					}
				});
			}
			
			function getPrevFormValues(){
				var allVals = $.cookie('frmCreateBooking');
				var valArr = allVals.split("&");
				for(i=0;i<valArr.length;i++){
					var kv = valArr[i].split("=");
					if(document.getElementsByName(kv[0])[0].type.toLowerCase()=="radio"){
						if(document.getElementsByName(kv[0])[0].value == decodeURIComponent(kv[1])){
							document.getElementsByName(kv[0])[0].checked=true;
						}
					}
					else
						document.getElementsByName(kv[0])[0].value = decodeURIComponent(kv[1]).replace(/\+/g,' ');;
				}
			}
			</script>
<table width="100%" id="product-table">
  <tr>
  
    <td width="86%" align="center" colsapn="10">
        <form onsubmit="javascript:void(0);">
            <strong>Enter mobile number</strong>
            <input type="text" onChange="showFromBooking(this.value)" value="" maxlength="12" /> &nbsp;&nbsp;
            <input type="submit" onclick="return false;" value="Go" class="NavButton"/>&nbsp;&nbsp;
            <!--input type="button" value="Fetch Back" class="NavButton" onClick="getPrevFormValues();"/-->
        </form>
    </td>
    
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"> <div id="bookingStatus"></div></td>
   
  </tr>
</table> 
 <script language="javascript">
	var uri = "../master/form/booking-form.php?ty=M&no=0";
	var obj = document.getElementById("bookingStatus");
	$(obj).load(uri,function(response, status, xhr) {
		if (status == "error") {
			alertDisp(formatErrMsg(xhr.status),'statusType-error');
		}
		//bindHref(this);
	});
	</script>