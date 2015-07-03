<?php
//自定义用户信息Model类

class UserMessageMode extends Model{

	//自动验证机制
	protected $_validate = array(
		array('username','require','用户名不可以为空！'), //验证用户名
		array('pass','checkPass','密码错误！',0,'callback',1), //验证密码
		array('age','/^\d{1,2}$/','年龄不合法！',0,'regex',3), //验证age
		array('email','email','Email地址错误！'), //验证email
	);	
	//自动填充机制
	protected $_auto = array ( 
		array('pass','md5',1,'function'), //对pass字段在新增的时候使md5函数处理
		array('addtime','time',1,'function'), //对addtime字段在新增的时候使time函数处理(补上添加时间)
	);
	
}