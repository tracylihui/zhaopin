<?php
//导入公共配置文件
$conf1 = require("./public_config.php");

//定义当前应用的配置信息
$conf2 = array(
	//'配置项'=>'配置值'
	'USER_AUTH_KEY'=>'adminuser', //指定后台用户的session下标键值
	'OUTPUT_ENCODE' =>  false,
);

//合并配置信息，并返回
return array_merge($conf1,$conf2);
