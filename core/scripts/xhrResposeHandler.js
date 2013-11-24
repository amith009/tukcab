/********************************************************************************
 * This work is a proprietary creation of pplStuff.com and or its affiliates.	*
 * No part of this file is to be licensed to any being or software and is not	*
 * meant to be used without explicit permissions of the owners.					*
 *																				*
 * Author		:	Nilotpal Barpujari											*
 * Date			:	22-Nov-2011													*
 * Last Updated	:																*
 ********************************************************************************/
 
/*
 pssSuccess function is called on successful completion on the AJAX request.
 whichWin	: object from which the AJAX call was initiated.
 whichForm	: the form that was submitted which triggered the AJAX call.
 data		: data returen by the server
*/
function pssSuccess(whichWin,whichForm,data){
	var respType = data.substring(0,7);
	if(respType=='ERROR: '){
		alertDisp(data.substring(7),'statusType-error');
		return;
	}else if(respType=='SUCCE: '){
		alertDisp(data.substring(7),'statusType-info');
	}
		$("#mainContent").html(data);
	/*if(whichForm.name=='frmCreateArea'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmEditArea'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateCabType'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateEmployee'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateCustomer'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateCab'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateDriver'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateStartPay'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateFreeCab'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateJmp'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCreateBooking'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmCancelOrder'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmAddIncrement'){
		$(whichWin).html(data);
	}
	
	if(whichForm.name=='frmAddTrip'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmComplain'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmAssinCab'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmSrvices'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmEditSrv'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmChange'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmEditBooking'){
		$(whichWin).html(data);
		setTimeout(function(){
			var p = $(whichWin).parent();
			$(p).remove();
			$('#si_'+$(p).attr("id")).fadeOut('medium',function(){
				$('#si_'+$(p).attr("id")).remove();
			});
		},1000);
	}
	if(whichForm.name=='frmNotice'){
		$(whichWin).html(data);
	}*/
}

function alertDisp(str,type,time){
	var tTime=0;
	if(time==null) tTime=3000;
	$("#statusDisp").html(str)
		.addClass(type)
		.css("left",$(document).width()/2-$("#statusDisp").width()/2)
		.fadeIn("fast");
	if(tTime!=0){
		setTimeout(function(){
			$("#statusDisp").fadeOut("fast")
				.removeClass(type);
		},tTime);
	}
}

function hideAlert(){
	$("#statusDisp").fadeOut("fast")
		.removeClass('statusType-error')
		.removeClass('statusType-info');
}

/*
pssError function gives access to AJAX errors
*/
function pssError(whichWin,whichForm,errObj){
	if(whichForm.name=='frmCreateArea'){
		alert(errObj.statusText);
	}
	if(whichForm.name=='frmEditArea'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmAddIncrement'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateCabType'){
		alert(errObj.statusText);
	}
	if(whichForm.name=='frmCreateEmployee'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateCustomer'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateCab'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateDriver'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateStartPay'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateFreeCab'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateJmp'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCreateBooking'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmCancelOrder'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmAddTrip'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmComplain'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmAssinCab'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmSrvices'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmEditSrv'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmNotice'){
		$(whichWin).html(data);
	}

	if(whichForm.name=='frmChange'){
		$(whichWin).html(data);
	}
	if(whichForm.name=='frmEditBooking'){
		$(whichWin).html(data);
	}
}

function pssComplete(whichForm,data){
	
}

function showHome(){
	//find all open windows and minimize
	//var allWin = $('.status-bar').children();
	//$('.status-bar').children().removeClass('window-icon-active');
	$('.status-bar').children().each(function(){
		var pID = ($(this).attr('id')).substring(3);
		//alert(pID);
		$("#"+pID).addClass('donotshow');
		$(this).removeClass('window-icon-active');
	});
	return false;
}