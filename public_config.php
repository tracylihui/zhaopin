<?php
return array(
	//'配置项'=>'配置值'
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'zhaopin',    // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => 'admin',      // 密码
    'DB_PORT'               => '3306',        	// 端口
    'DB_PREFIX'             => 'tb_',    		// 数据库表前缀
	
	//'URL_HTML_SUFFIX'=>'.html',
	
	//开启Smarty模板的支持
	//使用的模板引擎名
	
	//url不区分大小写
	'URL_CASE_INSENSITIVE' => true,
	//模板引擎相关的设置
	'SESSION_OPTIONS' => array('path'=>'tmp'),
	
	'SHOW_PAGE_TRACE' => false,
	//'SHOW_ERROR_MSG'=> true,
	//自定义跳转页面
	'TMPL_ACTION_SUCCESS' => 'Public:jump',
	'TMPL_ACTION_ERROR' => 'Public:jump',
	
);
