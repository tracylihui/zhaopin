# -----------------------------------------------------------
# Description:备份的数据表[结构] tb_apply,tb_article,tb_article_user,tb_comment,tb_student,tb_user
# Description:备份的数据表[数据] tb_apply,tb_article,tb_article_user,tb_comment,tb_student,tb_user
# Time: 2014-07-16 16:04:23
# -----------------------------------------------------------
# SQLFile Label：#1
# -----------------------------------------------------------


# 表的结构 tb_apply 
DROP TABLE IF EXISTS `tb_apply`;
CREATE TABLE `tb_apply` (
  `id` int(11) NOT NULL auto_increment COMMENT '编号id,主键',
  `sid` int(11) unsigned NOT NULL COMMENT '学生id',
  `aid` int(11) unsigned NOT NULL COMMENT '项目id',
  `reason` text NOT NULL COMMENT '理由',
  `addtime` int(11) unsigned NOT NULL COMMENT '申请时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 ;

# 表的结构 tb_article 
DROP TABLE IF EXISTS `tb_article`;
CREATE TABLE `tb_article` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT '帖子编号id 主键',
  `title` varchar(55) NOT NULL COMMENT '帖子标题',
  `content` text NOT NULL COMMENT '文章内容',
  `number` int(11) unsigned NOT NULL,
  `allow` tinyint(4) NOT NULL default '1' COMMENT '评论开关,0表示可评论,1表示未评论',
  `uid` int(11) unsigned NOT NULL COMMENT '发帖者id',
  `addtime` int(11) unsigned NOT NULL COMMENT '发帖时间戳',
  `time` varchar(55) NOT NULL,
  `grade` int(11) NOT NULL default '0' COMMENT '要求：年级',
  `sex` tinyint(1) NOT NULL default '2' COMMENT '要求：性别',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=294 DEFAULT CHARSET=utf8 ;

# 表的结构 tb_article_user 
DROP TABLE IF EXISTS `tb_article_user`;
CREATE TABLE `tb_article_user` (
  `aid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  KEY `articleid` (`aid`),
  KEY `userid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

# 表的结构 tb_comment 
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(11) NOT NULL auto_increment COMMENT '评论编号id,主键',
  `uid` int(10) unsigned NOT NULL COMMENT '评论者用户id',
  `aid` int(10) unsigned NOT NULL COMMENT '文章id',
  `content` text NOT NULL COMMENT '评论内容',
  `addtime` int(10) unsigned NOT NULL COMMENT '评论发表时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 ;

# 表的结构 tb_student 
DROP TABLE IF EXISTS `tb_student`;
CREATE TABLE `tb_student` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT '学号主键',
  `studentid` varchar(55) NOT NULL COMMENT '学号',
  `idnumber` varchar(55) NOT NULL COMMENT '身份证号',
  `name` varchar(55) NOT NULL COMMENT '姓名',
  `pass` varchar(32) NOT NULL COMMENT '会员密码',
  `sex` tinyint(1) NOT NULL default '0' COMMENT '会员性别,0表示为男,1表示女',
  `status` tinyint(1) NOT NULL default '1' COMMENT '帐号状态,1为正常,0为禁用',
  `nation` varchar(32) NOT NULL COMMENT '民族',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `political` varchar(32) NOT NULL COMMENT '政治面貌',
  `income` double NOT NULL COMMENT '收入',
  `academy` varchar(55) NOT NULL COMMENT '学院',
  `professional` varchar(55) NOT NULL COMMENT '专业',
  `grade` int(11) NOT NULL COMMENT '年级',
  `tel` varchar(55) NOT NULL COMMENT '电话',
  `orphan` tinyint(1) NOT NULL default '0' COMMENT '孤儿',
  `singleparent` tinyint(1) NOT NULL default '0' COMMENT '单亲',
  `divorce` tinyint(1) NOT NULL default '0' COMMENT '离异',
  `disability` tinyint(1) NOT NULL default '0' COMMENT '残疾',
  `martyr` tinyint(1) NOT NULL default '0' COMMENT '烈士子女',
  `dormitory` varchar(55) NOT NULL COMMENT '宿舍号',
  `reward` varchar(255) NOT NULL COMMENT '奖励',
  `support` varchar(255) NOT NULL COMMENT '资助',
  `freetime` varchar(255) NOT NULL COMMENT '空余',
  `addtime` int(10) unsigned default NULL COMMENT '注册时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4294967296 DEFAULT CHARSET=utf8 COMMENT='前台学生表' ;

# 表的结构 tb_user 
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `name` varchar(55) NOT NULL,
  `userpass` char(32) NOT NULL,
  `email` varchar(55) NOT NULL COMMENT '邮箱',
  `regdate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `isadmin` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ;



# 转存表中的数据：tb_apply 
INSERT INTO `tb_apply` VALUES ('150','1','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('151','2','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('152','3','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('153','4','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('154','5','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('155','6','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('156','7','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('157','8','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('158','9','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('159','10','282','这是我的申请理由','0');
INSERT INTO `tb_apply` VALUES ('160','11','282','这是我的申请理由','0');


# 转存表中的数据：tb_article 
INSERT INTO `tb_article` VALUES ('282','1','1','10','1','0','1405220690','暑假','0','0');
INSERT INTO `tb_article` VALUES ('283','2','2','2','1','35','1405220919','2','0','0');
INSERT INTO `tb_article` VALUES ('284','3','3','3','1','35','1405220939','3','0','0');
INSERT INTO `tb_article` VALUES ('285','一个项目','一个项目','2','1','35','1405231651','一个项目','0','0');
INSERT INTO `tb_article` VALUES ('286','a','a','0','1','35','1405240803','a','0','0');
INSERT INTO `tb_article` VALUES ('287','b','b','0','1','35','1405240811','b','0','0');
INSERT INTO `tb_article` VALUES ('288','c','c','0','1','35','1405240816','c','0','0');
INSERT INTO `tb_article` VALUES ('289','e','e','0','1','35','1405240824','d','0','0');
INSERT INTO `tb_article` VALUES ('290','q','q','0','1','35','1405240829','q','0','0');
INSERT INTO `tb_article` VALUES ('293','这是一个项目','这是一个项目','12','1','36','1405492250','2','2011','1');


# 转存表中的数据：tb_article_user 
INSERT INTO `tb_article_user` VALUES ('282','36');
INSERT INTO `tb_article_user` VALUES ('282','40');
INSERT INTO `tb_article_user` VALUES ('282','39');
INSERT INTO `tb_article_user` VALUES ('283','39');


# 转存表中的数据：tb_comment 
INSERT INTO `tb_comment` VALUES ('138','55','241','wfasda','1376990395');
INSERT INTO `tb_comment` VALUES ('139','56','241','fdsfhjdskf','1376990882');
INSERT INTO `tb_comment` VALUES ('140','55','242','dsafsd','1377004488');
INSERT INTO `tb_comment` VALUES ('141','55','266','妹子~~','1377061405');
INSERT INTO `tb_comment` VALUES ('142','55','256','hello','1377062918');
INSERT INTO `tb_comment` VALUES ('143','62','263','美女哈','1377063015');
INSERT INTO `tb_comment` VALUES ('144','62','264','美女','1377063055');
INSERT INTO `tb_comment` VALUES ('145','62','257','这是什么','1377063085');
INSERT INTO `tb_comment` VALUES ('146','62','256','我在这里发表了','1377068417');
INSERT INTO `tb_comment` VALUES ('147','62','256','&lt;h1&gt;dfgdfgdf&lt;/h1&gt;','1377068511');
INSERT INTO `tb_comment` VALUES ('148','76','258','谷歌','1377076403');
INSERT INTO `tb_comment` VALUES ('149','76','276','谷歌','1377076485');


# 转存表中的数据：tb_student 
INSERT INTO `tb_student` VALUES ('1','222011321062092','371102199502453856','李辉','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('2','222011321062091','371102199502453856','李辉1','21232f297a57a5a743894a0e4a801fc3','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('3','222011321062093','371102199502453856','李辉3','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('4','222011321062094','371102199502453856','李辉4','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('5','222011321062095','371102199502453856','李辉5','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('6','222011321062096','371102199502453856','李辉6','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('7','222011321062097','371102199502453856','李辉7','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('8','222011321062098','371102199502453856','李辉8','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('9','222011321062099','371102199502453856','李辉9','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('10','222011321062010','371102199502453856','李辉10','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');
INSERT INTO `tb_student` VALUES ('11','222011321062011','371102199502453856','李辉11','0cc175b9c0f1b6a831c399e269772661','1','1','汉族','山东省日照市莫某区某某','共青团员','3000','计算机与信息科学学院 软件学院','软件工程','2011','2147483647','0','0','0','0','0','橘园八舍222','没法撒大飒飒东风','没法撒大飒飒东风','没法撒大飒飒东风','');


# 转存表中的数据：tb_user 
INSERT INTO `tb_user` VALUES ('36','admin','管理员1','21232f297a57a5a743894a0e4a801fc3','111@qq.cm','0','1','1');
INSERT INTO `tb_user` VALUES ('39','admin2','管理员2','c84258e9c39059a89ab77d846ddab909','11111@qq.com','1405416308','1','0');
INSERT INTO `tb_user` VALUES ('40','admin3','管理员3','21232f297a57a5a743894a0e4a801fc3','1@qq','1405476639','1','0');
INSERT INTO `tb_user` VALUES ('41','admin4','管理员4','21232f297a57a5a743894a0e4a801fc3','1@qq','1405476648','1','0');
INSERT INTO `tb_user` VALUES ('42','admin5','管理员5','21232f297a57a5a743894a0e4a801fc3','1@qq.com','1405489881','1','1');
INSERT INTO `tb_user` VALUES ('43','admin6','113','21232f297a57a5a743894a0e4a801fc3','11@q','1405491161','1','0');
INSERT INTO `tb_user` VALUES ('44','admin7','11111','21232f297a57a5a743894a0e4a801fc3','1@q','1405491200','1','1');
INSERT INTO `tb_user` VALUES ('45','admin8','1231','21232f297a57a5a743894a0e4a801fc3','1@q','1405491249','1','1');
