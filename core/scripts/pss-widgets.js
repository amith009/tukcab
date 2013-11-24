/********************************************************************************************************
 This work is a proprietary creation of pplStuff.com and or its affiliates.
 No part of this file is to be licensed to any being or software and is not
 meant to be used without explicit permissions of the owners.
 
 Author			:	Nilotpal Barpujari
 Date			:	24-Oct-2011
 Last Updated	:	

 Change log:
 *********************************************************************************************************/
 
 var pss = function(elm){
	this.combobox = function(option){
		for(var i=0;i<elm.length;i++){
			var thisEl = elm[i];
			var wrap = document.createElement('div');
			wrap.setAttribute('class','pss-widget-wrap');
			wrap.setAttribute('style','width:'+selW+';height:'+selH+';float:left;');
			var cmbText = document.createElement('input');
			cmbText.setAttribute('type','text');
			cmbText.value = option;
			var cmbIcon = document.createElement('div');
			cmbIcon.setAttribute('style','float: right;margin-top: 5px;');
			cmbIcon.setAttribute('class','widget-icon widget-icon-triangle-1-s');
			var valContainer = document.createElement('div');
			valContainer.setAttribute('class','pss-widget-dropdown-container');
			//valContainer.setAttribute('style','width:'+selW+';height:'+selH+';');
			var vals = '';
			var v = $(elm[i]).children('option').each(function(){
				vals += $(this).html()+'<br/>';
			});
			//alert(vals);
			//valContainer.innerHTML = vals;
			elm[i].parentNode.replaceChild(wrap, elm[i]);
			wrap.appendChild(cmbText);
			wrap.appendChild(cmbIcon);
			//wrap.parentNode.appendChild(valContainer);
			document.body.appendChild(valContainer);
			var selW = $(wrap).width();
			var selH = $(wrap).height();
			$(valContainer).css('width',selW);
			//event listeners
			cmbText.addEventListener('click',function(){showDropDown(wrap,valContainer,vals);},false);
			cmbText.addEventListener('blur',function(){hideDropDown(valContainer);},false);
		}
	},
	this.showDropDown = function(obj,container,vals){
		$(container).css('top','54px');
		$(container).html(vals);
		$(container).slideDown('slow');
	},
	this.hideDropDown = function(container){
		$(container).slideUp('slow');
	};
	if ( this instanceof pss ) {
		return this.pss;
	} else {
		return new pss( elm );
	}
 };