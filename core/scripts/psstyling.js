/*
	pplStuff styling library
	Author: Nilotpal
	© 2011, pplStuff Solutions
*/
var pss = function( el ) {
		this.el = document.getElementById( el );
		this.css = function( property, value ) {
		this.el.style[ property ] = value;
		return this;
	},
	this.rplce = function(str){
		this.el.innerHTML = str;
	},
	//wrap function creates a wrapping border around the calling element
	this.wrap = function(){
		var that = this;
		var thatEl = this.el;
		//create the wrapper 'span' tag
		var myWrapper = document.createElement("span");
		myWrapper.setAttribute("class","p-wrapper");
		//replace calling element with new wrapper
		this.el.parentNode.replaceChild(myWrapper, this.el);
		//re-add caller inside wrapper
		myWrapper.appendChild(thatEl);
		//add event listeners for functionality
		thatEl.addEventListener('focus',function(){that.addShadow();},false);
		thatEl.addEventListener('blur',function(){that.removeShadow();},false);
	},
	this.addShadow = function(){
		this.el.parentNode.setAttribute("class",this.el.parentNode.getAttribute("class")+" p-wrapper-shadow");
	},
	this.removeShadow = function(){
		this.el.parentNode.setAttribute("class","p-wrapper");
	};
	if ( this instanceof pss ) {
		return this.pss;
	} else {
		return new pss( el );
	}
};