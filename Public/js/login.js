function showLoginForm(aid){
	var ob=$("#apply-form");
	ob.css("display","block");
	//取得屏幕的高和宽
	var window_height=$(window).height();
	var window_width=$(window).width();
	//取得登陆框本身的宽和高
	var login_width=ob.width();
	var login_height=ob.height();
	//开始定位(屏幕中间)
	var height=(window_height-login_height)/2+100;
	var width=(window_width-login_width)/2;
	ob.offset({left:width,top:height});
	$("#applyform").find("input:hidden").val(aid);//把登陆位置信息写入到登陆框隐藏域中
	
}
function closeLoginForm(){
		$("#apply-form").slideUp('fast');
		

	}

