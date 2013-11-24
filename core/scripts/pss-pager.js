/********************************************************************************************************
 This work is a proprietary creation of pplStuff.com and or its affiliates.
 No part of this file is to be licensed to any being or software and is not
 meant to be used without explicit permissions of the owners.
 
 Author			:	Nilotpal Barpujari
 Date			:	03-Dec-2011
 Last Updated	:	

 Change log:
 *********************************************************************************************************/
 
 var pssPager = function(el){
	this.table = document.getElementById(el);
	this.startRange = 0;
	this.endRange = 0;
	this.paginate= function(uri,getHeaders,start,pageSize){
		this.startRange += start;
		var fetchUri = uri+'?headers='+getHeaders+'&start='+this.startRange+'&pageSize='+pageSize;
		$(this.table).load(fetchUri,function(data){
			//bindHref(this);
		});
	};
	if ( this instanceof pssPager ) {
		return this.pssPager;
	} else {
		return new pssPager( el );
	}
 }