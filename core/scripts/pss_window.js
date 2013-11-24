var winCount = 0;
function pss_window(parent,title){
	//creating the window frame
	var window = document.createElement('div');
	window.setAttribute('id','psswindow_'+winCount);
	winCount++;
	window.setAttribute('class','pss-window pss-window-active');
	//creating the window titleBar
	var winTitle = document.createElement('div');
	winTitle.setAttribute('class','pss-window-title');
	var winTitleText = document.createElement('span');
	winTitleText.setAttribute('class','pss-window-title-text');
	/*var btnReload = document.createElement('span');
	btnReload.setAttribute('class','pss-window-title-button-reload');*/
	var btnClose = document.createElement('span');
	btnClose.setAttribute('class','pss-window-title-button-close');
	/*var btnMaximize = document.createElement('span');
	btnMaximize.setAttribute('class','pss-window-title-button-max');*/
	/*var btnMinimize = document.createElement('span');
	btnMinimize.setAttribute('class','pss-window-title-button-min');*/
	winTitle.appendChild(winTitleText);
	winTitle.innerHTML = title;
	winTitle.appendChild(btnClose);
	//winTitle.appendChild(btnMaximize);
	//winTitle.appendChild(btnMinimize);
	//winTitle.appendChild(btnReload);
	//creating the content pane
	var winPane = document.createElement('div');
	winPane.setAttribute('class','pss-window-pane');
	window.appendChild(winTitle);
	window.appendChild(winPane);
	var p = document.getElementById(parent);
	p.appendChild(window);
	return window;
}