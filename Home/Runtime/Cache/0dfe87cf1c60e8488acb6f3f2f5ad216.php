<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>登录_学生用户_兼职招聘</title><link href="__PUBLIC__/css/login.css" rel="stylesheet" type="text/css" /><script src="__PUBLIC__/js/jquery-1.7.2.min.js" type="text/javascript"></script><script>$(function(){
    $("#login").addClass("current");    
    
    
    //input 按键事件
    $("input[name]").keyup(function(e){
          //禁止输入空格  把空格替换掉
          if($(this).attr('name')=="pass"&&e.keyCode==32){
              $(this).val(function(i,v){
                  return $.trim(v);
              });
          }
          if($.trim($(this).val())!=""){
              $(this).nextAll('span').eq(0).css({display:'none'}); 
          }
    });
    
    
    //错误信息
    var succ_arr=[];
    
    //input失去焦点事件
    $("input[name]").focusout(function(e){
        	
            var msg="";
             if($.trim($(this).val())==""){
                  if($(this).attr('name')=='name'){
                          succ_arr[0]=false;
                          msg="登入名为空";
                  }else if($(this).attr('name')=='pass'){
                           succ_arr[1]=false;
                           msg="密码为空";
                  }
                
            }else{
                  if($(this).attr('name')=='name'){
                          succ_arr[0]=true;
                         
                  }else if($(this).attr('name')=='pass'){
                           succ_arr[1]=true;
                           
                  }
            }
              var a=$(this).nextAll('span').eq(0);
             a.css({display:'block'}).text(msg);
    });  
    //Ajax用户注册
    $("button[type='button']").click(function(){
         $("input[name]").focusout();  //让所有的input标记失去一次焦点 来设置msg信息
         for (x in succ_arr){if(succ_arr[x]==false) return;}  
		 $.ajax({
			url:"__URL__/checkLogin",
			data:$("#login").serialize(),
			type:"post",
			dataType:"json",
			async:true,
			success:function(data){
				if(data.status=="n"){
					$("#error_msg").html(data.info);
				}else{
					parent.document.location.href = "__APP__/Index"; 
				}			
			}
		});  
    });   
});
</script></head><body><div id="home"><form id="login" class="current1" method="post"><h3>学生登入</h3><img class="avator" src="__PUBLIC__/image/avatar.png" width="96"  height="96"/><label>学号
      <input type="text" name="name" style="width:210px;" /><span>邮箱为空</span></label><label>密码
      <input type="password" name="pass"  style="width:210px;"/><span>密码为空</span></label><span id="error_msg" style="float:right; color:red;"></span><button type="button">登入</button><span style="float:left;">没有账号？<a href="__APP__/Register">立即注册</a></span><span style="float:right;font-size:10px;line-height:22px">推荐使用谷歌、火狐浏览器</span></form><div id="myinfo">西南大学勤工助学在线申请系统<a href="__ROOT__/admin.php/Public/login" style="float:right; font-size:12px;">用人单位登录</a></div></div></body></html>