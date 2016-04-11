	<!--
	
	winWidth = 400; // sets a default width for browsers who do not understand screen.width below
	winheight = 400; // ditto for height
	
	if (screen){ // weeds out older browsers who do not understand screen.width/screen.height
	   winWidth = screen.width;
	   winHeight = screen.height;
	}
	
	// this function calls a popupWindow where
	// win is the page address i.e. '../page.htm'
	// and must be specified when the function is called
	
	function popupWindow(win){
		
		newWindow = window.open(win,'newWin','toolbar=no,location=no,scrollbars=no,resizable=yes,width='+winWidth+',height='+winHeight+',left=0,top=0');
		newWindow.focus();
	}
	// -->


var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}