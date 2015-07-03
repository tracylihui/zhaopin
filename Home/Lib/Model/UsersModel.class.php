<?php
//自定义用户信息Model类

class UsersModel extends Model{

	//自动验证机制
	protected $_validate = array(
		array('username','','帐号名称已经存在！',0,'unique',1), //验证用户名
		//array('pass','checkPass','密码错误！',0,'callback',1), //验证密码
		array('age','/^\d{1,2}$/','年龄不合法！',0,'regex',3), //验证age
		array('email','email','Email地址错误！'), //验证email
		//array('pass','repass','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
		//array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式

	);	
	//自动填充机制
	protected $_auto = array ( 
		//array('pass','md5',1,'function'), //对pass字段在新增的时候使md5函数处理
		array('addtime','time',1,'function'), //对addtime字段在新增的时候使time函数处理(补上添加时间)
	);
	
}