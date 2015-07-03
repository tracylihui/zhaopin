<?php
//导入公共配置
$conf1=require("./public_config.php");
$conf2= array(
	//当前应用的设置	
	'USER_AUTH_KEY'=>'loginuser',//指定前台用户的session下标键值
	'PASSNUM'=>'5',//前台审核通过的分数界限
	'HOTNUM'=>'3',//热门展现的分界值
	'JHNUM'=>'5',//精华展现的分界值
	'ZXNUM'=>'3',//真相分类下展现的分界值
	'CYNUM'=>'3',//穿越分类下展现的分界值
);

//返回合并的配置文件
return array_merge($conf1,$conf2);
