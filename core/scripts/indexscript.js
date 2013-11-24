/********************************************************************************
 * This work is a proprietary creation of pplStuff.com and or its affiliates.	*
 * No part of this file is to be licensed to any being or software and is not	*
 * meant to be used without explicit permissions of the owners.					*
 *																				*
 * Author		:	Nilotpal Barpujari											*
 * Date			:	30-Oct-2011													*
 * Last Updated	:	20-Nov-2011													*
 ********************************************************************************/
$(document).ready(function(){

	//calculate document size for element resizing
	var docW = $(window).width();
	var docH = $(window).height();
	
	$("#bodycontents").css("width",docW-10); //content box has a padding of 5px on each side 
	$("#bodycontents").css("height",docH-83);
	
	//trap all hyperlink clicks and redirect to internal object
	$('a').click(function(event){
		event.preventDefault();
		var uri = $(this).attr('href');
		if(uri=="javascript: void(0);"||uri=="#") return;
		var myTitle = this;
		//create a new window and load the url contents into it
		var newWin = pss_window('bodycontents',$(myTitle).html());
		$(newWin).children(".pss-window-pane").html('<img src="images/loader.gif" alt="Loading"/>');
		$(newWin).children(".pss-window-pane").load(uri,function(response, status, xhr) {
			if (status == "error") {
				var msg = "Error: ";
				//$(newWin).html(msg + formatErrMsg(xhr.status));
				alertDisp(formatErrMsg(xhr.status),'statusType-error');
			}
		});
		//status icon
		var statIcon = document.createElement('a');
		statIcon.setAttribute('href','javascript:void(0)');
		statIcon.setAttribute('class','window-icon window-icon-active');
		//run through other children that may already exist and make them inactive
		$(".status-bar").children().removeClass('window-icon-active');
		statIcon.setAttribute('id','si_'+$(newWin).attr('id'));
		$(statIcon).html($(myTitle).html());
		$(statIcon).appendTo($('.status-bar'));
		//winObj click
		$(newWin).click(function(event){
			event.stopPropagation(); //dont tell mum that i was clicked
			//check if this is the top most window :start
			var lstChild = $("#bodycontents > div:last-child");
			if($(this).attr('id')===lstChild.attr('id')) return;
			//check if this is the top most window :end
			//remove active class from all children
			$( this ).appendTo( this.parentNode );
			$('.status-bar a').removeClass('window-icon-active');
			$('#si_'+$(newWin).attr('id')).addClass('window-icon-active');
			$(event.target).select();
		});
		//minimize button code
		$(newWin).children(".pss-window-title").children(".pss-window-title-button-min").click(function(event){
			event.stopPropagation(); //dont tell mum that i was clicked
			var thisId = $(newWin).attr('id');
			$(newWin).addClass('donotshow'); //hide the active window
			$("#si_"+thisId).removeClass('window-icon-active');
			//activate the last child of container :start
			//find last active child in DOM
			var lstChild;
			$('#bodycontents').children().each(function(){
				if(!$(this).hasClass('donotshow')){
					lstChild = $(this);
				}
			});
			var lstChildID = $(lstChild).attr('id');
			$("#si_"+lstChildID).addClass('window-icon-active');
			//activate the last child of container :end
		});
		//close button code
		$(newWin).children(".pss-window-title").children(".pss-window-title-button-close").click(function(){
			$(newWin).remove();
			$('#si_'+$(newWin).attr("id")).remove();
		});
		//status bar icon click
		$('#si_'+$(newWin).attr("id")).bind('click',function(event){
			var thisId = this.getAttribute('id');
			thisId = thisId.substring(3);
			var parentParent = $("#"+thisId).parent();
			if($("#"+thisId).is(':visible')){
				if($(this).hasClass('window-icon-active')){
					$("#"+thisId).addClass('donotshow'); //hide the active window
					$(this).removeClass('window-icon-active');
				}
				else{
					$("#"+thisId).appendTo(parentParent); //make the window top level
				}
				//activate the last child of container :start
				//find last active child in DOM
				var lstChild;
				$('#bodycontents').children().each(function(){
					if(!$(this).hasClass('donotshow')){
						lstChild = $(this);
					}
				});
				$(this).parent().children().removeClass('window-icon-active');
				var lstChildID = $(lstChild).attr('id');
				$("#si_"+lstChildID).addClass('window-icon-active');
				//activate the last child of container :end
			}
			else{
				$("#"+thisId).removeClass('donotshow'); //show the hidden window
				//var parentParent = $("#"+thisId).parent();
				$("#"+thisId).appendTo(parentParent); //make the window top level
				//remove active class from all children
				$(this).parent().children().removeClass('window-icon-active');
				$(this).addClass('window-icon-active');
				return; //we dont want to explore the DOM any further
			}
		});
		//drag :start
		var $div = $('#bodycontents');
	    $(newWin)
		  .drag("start",function( ev, dd ){
			 dd.limit = $div.offset();
			 dd.limit.bottom = dd.limit.top + $div.outerHeight() - $( this ).outerHeight();
			 dd.limit.right = dd.limit.left + $div.outerWidth() - $( this ).outerWidth();
			 $( this ).appendTo( this.parentNode );
			 //setting this as the active window
			 var thisId = $(this).attr('id');
			 $(".status-bar").children().removeClass('window-icon-active');
			 $("#si_"+thisId).addClass('window-icon-active');
		//},{ handle: $(newWin).children(".pss-window-title"),distance:10,no:$(newWin).children(".pss-window-pane") })
		})
		.drag(function( ev, dd ){
			 $( this ).css({
				top: Math.min( dd.limit.bottom, Math.max( dd.limit.top, dd.offsetY ) ),
				left: Math.min( dd.limit.right, Math.max( dd.limit.left, dd.offsetX ) )
			 });   
		});
		//drag :end
	});
	
	//Menu handlers : Start
	var $divs = $('div');
	var menuChild = $(".mainmenu li").find($divs); //find all dropdown portion of the menu
	menuChild.addClass('donotshow');
	var mainMenuLinks = $(".mainmenu li"); //menu parents
	//following function traverses through all parents and looks for child elements within
	//if a child exists then it adds a dropdown icon to the parent element
	for(var i=0;i<mainMenuLinks.length;i++){
		var obj = $(mainMenuLinks[i]).find($divs);
		if(obj.length>0)
			$(mainMenuLinks[i]).addClass('menuarrow');
	}
	
	//onHover of parent element show dropdown menu if exists
	$(".mainmenu li").mouseover(function(){
		$(this).find($divs).removeClass('donotshow'); //find dropdown menu for current parent element and make it visible
		if($(this).hasClass('menuarrow'))
			$(this).addClass('menuactive');
		return false;
	});
	
	//onMouseout hide the dropdown menu	
	$(".mainmenu li").mouseout(function(){
		$(this).find($divs).addClass('donotshow');
		$(this).removeClass('menuactive');
		return false;
	});
	
	//hide menu when user clicks on a menu item
	$(".menuchild a").click(function(event){
		$(this).parent().parent().parent().parent().parent().addClass('donotshow');
		$(this).parent().parent().parent().parent().parent().parent().removeClass('menuactive');
	});
	
	//display quick launch ID for the current menu item
	$(".menustrip .mainmenu ul li .menuchild a").mouseover(function(){
		$(".menustrip .mainmenu ul li .menuchild #qlText").html('Quick Launch: '+$(this).attr('ql'));
	});
	
	//clear quick launch ID onMouseout
	$(".menustrip .mainmenu ul li .menuchild a").mouseout(function(){
		$(".menustrip .mainmenu ul li .menuchild #qlText").html('');
	});
	//Menu handlers : End
	
	//Quick function launch :Start
	$("#quickfn").focus(function(){
		if($(this).val()=='Quick Launch'){
			$(this).val("");
			$(this).css("color","#000000");
		}
	});
	
	$("#quickfn").blur(function(){
		if($(this).val()==''){
			$(this).val("Quick Launch");
			$(this).css("color","#b1b1b1");
		}
	});
	
	$("#quickfn").keyup(function(event){
		//$.print(event);
		var qryString = $(this).val();
		qryString.replace(" ","%20");
		$("#bodycontents").load("scripts/fetchFunction.php?param="+qryString);
	});
});

//handles element resizing on window resize event
$(window).resize(function(){
	var docW = $(window).width();
	var docH = $(window).height();
	
	$("#bodycontents").css("width",docW-10);
	$("#bodycontents").css("height",docH-83);
});

//function to format HTTP request errors
function formatErrMsg(errCode){
	var errString = "";
	switch(errCode){
		case 0:
			errString = "Unknown Error";
			break;
		case 400:
			errString = "Bad request";
			break;
		case 404:
			errString = "Object not found";
	}
	return errString;
}