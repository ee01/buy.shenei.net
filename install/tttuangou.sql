DROP TABLE IF EXISTS `myth_system_failedlogins`;
CREATE TABLE `myth_system_failedlogins` (
`ip` char(15) NOT NULL default '',
`count` tinyint(1) unsigned NOT NULL default '0',
`lastupdate` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`ip`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_log`;
CREATE TABLE `myth_system_log` (
`id` int(10) unsigned NOT NULL auto_increment,
`uid` int(10) unsigned NOT NULL default '0',
`username` char(15) NOT NULL default 0xd3cebfcd,
`action_id` smallint(4) unsigned NOT NULL default '0',
`module` char(50) NOT NULL default 'index',
`action` char(100) NOT NULL default '',
`item_id` int(10) unsigned NOT NULL default '0',
`item_title` char(100) NOT NULL default '',
`ip` char(15) NOT NULL default '',
`time` int(10) unsigned NOT NULL default '0',
`uri` char(100) NOT NULL default '',
`extcredits1` smallint(4) NOT NULL default '0',
`extcredits2` smallint(4) NOT NULL default '0',
`extcredits3` smallint(4) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `action_id` (`action_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_memberfields`;
CREATE TABLE `myth_system_memberfields` (
`uid` mediumint(8) unsigned NOT NULL default '0',
`nickname` varchar(30) NOT NULL default '',
`site` varchar(75) NOT NULL default '',
`alipay` varchar(50) NOT NULL default '',
`icq` varchar(12) NOT NULL default '',
`yahoo` varchar(40) NOT NULL default '',
`taobao` varchar(40) NOT NULL default '',
`location` varchar(30) NOT NULL default '',
`customstatus` varchar(30) NOT NULL default '',
`medals` varchar(255) NOT NULL default '',
`avatar` varchar(255) NOT NULL default '',
`avatarwidth` tinyint(1) unsigned NOT NULL default '0',
`avatarheight` tinyint(1) unsigned NOT NULL default '0',
`bio` text NOT NULL default '',
`signature` text NOT NULL default '',
`sightml` text NOT NULL default '',
`ignorepm` text NOT NULL default '',
`groupterms` text NOT NULL default '',
`authstr` varchar(20) NOT NULL default '',
`question` varchar(255) NOT NULL default '',
`answer` varchar(255) NOT NULL default '',
`address` varchar(40) NOT NULL default '',
`postcode` varchar(6) NOT NULL default '',
`validate_true_name` varchar(50) NOT NULL default '',
`validate_card_type` varchar(10) NOT NULL default '',
`validate_card_id` varchar(50) NOT NULL default '',
`validate_remark` varchar(100) NOT NULL default '',
PRIMARY KEY  (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_members`;
CREATE TABLE `myth_system_members` (
`uid` int(10) NOT NULL auto_increment,
`username` varchar(45) NOT NULL default '',
`password` varchar(32) NOT NULL default '',
`secques` varchar(24) NOT NULL default '',
`gender` tinyint(1) NOT NULL default '0',
`adminid` tinyint(1) NOT NULL default '0',
`regip` varchar(45) NOT NULL default '',
`regdate` int(10) NOT NULL default '0',
`lastip` varchar(45) NOT NULL default '',
`lastvisit` int(10) NOT NULL default '0',
`lastactivity` int(10) NOT NULL default '0',
`lastpost` int(10) NOT NULL default '0',
`oltime` int(10) NOT NULL default '0',
`pageviews` int(10) NOT NULL default '0',
`credits` int(10) NOT NULL default '0',
`extcredits1` int(10) NOT NULL default '0',
`extcredits2` int(10) NOT NULL default '0',
`email` varchar(150) NOT NULL default '',
`bday` date NOT NULL default '0000-00-00',
`sigstatus` tinyint(1) NOT NULL default '0',
`tpp` tinyint(1) NOT NULL default '0',
`ppp` tinyint(1) NOT NULL default '0',
`styleid` int(10) NOT NULL default '0',
`dateformat` varchar(30) NOT NULL default '',
`timeformat` tinyint(1) NOT NULL default '0',
`pmsound` tinyint(1) NOT NULL default '0',
`showemail` tinyint(1) default '0',
`newsletter` tinyint(1) NOT NULL default '0',
`invisible` tinyint(1) NOT NULL default '0',
`timeoffset` varchar(12) NOT NULL default '',
`newpm` tinyint(1) NOT NULL default '0',
`accessmasks` tinyint(1) NOT NULL default '0',
`face` varchar(180) NOT NULL default '',
`tag_count` int(10) NOT NULL default '0',
`role_id` tinyint(1) NOT NULL default '0',
`role_type` varchar(18) NOT NULL default '',
`new_msg_count` tinyint(1) NOT NULL default '0',
`tag` varchar(255) NOT NULL default '',
`own_tags` int(10) NOT NULL default '0',
`login_count` int(10) NOT NULL default '0',
`truename` varchar(48) NOT NULL default '',
`phone` varchar(45) NOT NULL default '',
`last_year_rank` int(10) NOT NULL default '0',
`last_month_rank` int(10) NOT NULL default '0',
`last_week_rank` int(10) NOT NULL default '0',
`this_year_rank` int(10) NOT NULL default '0',
`this_month_rank` int(10) NOT NULL default '0',
`this_week_rank` int(10) NOT NULL default '0',
`last_year_credit` int(10) NOT NULL default '0',
`last_month_credit` int(10) NOT NULL default '0',
`last_week_credit` int(10) NOT NULL default '0',
`this_year_credit` int(10) NOT NULL default '0',
`this_month_credit` int(10) NOT NULL default '0',
`this_week_credit` int(10) NOT NULL default '0',
`view_times` int(10) NOT NULL default '0',
`use_tag_count` int(10) NOT NULL default '0',
`create_tag_count` int(10) NOT NULL default '0',
`image_count` int(10) NOT NULL default '0',
`noticenum` int(10) NOT NULL default '0',
`ucuid` int(10) NOT NULL default '0',
`invite_count` int(10) NOT NULL default '0',
`invitecode` varchar(48) NOT NULL default '',
`province` varchar(48) NOT NULL default '',
`city` varchar(48) NOT NULL default '',
`topic_count` int(10) NOT NULL default '0',
`at_count` int(10) NOT NULL default '0',
`follow_count` int(10) NOT NULL default '0',
`fans_count` int(10) NOT NULL default '0',
`email2` varchar(150) NOT NULL default '',
`qq` varchar(30) NOT NULL default '',
`msn` varchar(150) NOT NULL default '',
`aboutme` varchar(255) NOT NULL default '',
`at_new` int(10) NOT NULL default '0',
`comment_new` int(10) NOT NULL default '0',
`fans_new` int(10) NOT NULL default '0',
`topic_favorite_count` int(10) NOT NULL default '0',
`tag_favorite_count` int(10) NOT NULL default '0',
`disallow_beiguanzhu` tinyint(1) NOT NULL default '0',
`validate` tinyint(1) NOT NULL default '0',
`favoritemy_new` int(10) NOT NULL default '0',
`money` int(10) NOT NULL default '0',
`checked` tinyint(1) NOT NULL default '0',
`finder` int(10) NOT NULL default '0',
`findtime` int(10) NOT NULL default '0',
`totalpay` int(10) default '0',
PRIMARY KEY  (`uid`),
UNIQUE KEY `username` (`username`),
KEY `email` (`email`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_onlinetime`;
CREATE TABLE `myth_system_onlinetime` (
`uid` mediumint(8) unsigned NOT NULL default '0',
`thismonth` smallint(4) unsigned NOT NULL default '0',
`total` mediumint(8) unsigned NOT NULL default '0',
`lastupdate` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_report`;
CREATE TABLE `myth_system_report` (
`id` int(10) unsigned NOT NULL auto_increment,
`uid` mediumint(8) NOT NULL default '0',
`username` char(15) NOT NULL default '',
`ip` char(15) NOT NULL default '',
`type` tinyint(1) NOT NULL default '0',
`reason` tinyint(1) NOT NULL default '0',
`content` text NOT NULL default '',
`url` text NOT NULL default '',
`dateline` int(10) NOT NULL default '0',
`process_user` char(15) NOT NULL default '',
`process_time` int(10) NOT NULL default '0',
`process_result` tinyint(1) NOT NULL default '0',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_robot`;
CREATE TABLE `myth_system_robot` (
`name` char(50) NOT NULL default '',
`times` int(10) unsigned NOT NULL default '0',
`first_visit` int(10) NOT NULL default '0',
`last_visit` int(10) NOT NULL default '0',
`agent` char(255) NOT NULL default '',
`disallow` tinyint(1) NOT NULL default '0',
PRIMARY KEY  (`name`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_robot_ip`;
CREATE TABLE `myth_system_robot_ip` (
`ip` char(15) NOT NULL default '',
`name` char(50) NOT NULL default '',
`times` int(10) unsigned NOT NULL default '0',
`first_visit` int(10) NOT NULL default '0',
`last_visit` int(10) NOT NULL default '0',
PRIMARY KEY  (`ip`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_robot_log`;
CREATE TABLE `myth_system_robot_log` (
`name` char(50) NOT NULL default '',
`date` date NOT NULL default '0000-00-00',
`times` int(10) unsigned NOT NULL default '0',
`first_visit` int(10) unsigned NOT NULL default '0',
`last_visit` int(10) unsigned NOT NULL default '0',
UNIQUE KEY `name` (`name`,`date`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_role`;
CREATE TABLE `myth_system_role` (
`id` tinyint(1) unsigned NOT NULL auto_increment,
`name` varchar(50) NOT NULL default '',
`creditshigher` int(10) NOT NULL default '0',
`creditslower` int(10) NOT NULL default '0',
`privilege` text NOT NULL default '',
`type` enum('normal','admin') NOT NULL default 'normal',
`rank` tinyint(1) unsigned NOT NULL default '0',
`discuz_group_id` tinyint(1) unsigned NOT NULL default '10',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_role_action`;
CREATE TABLE `myth_system_role_action` (
`id` smallint(4) unsigned NOT NULL auto_increment,
`name` varchar(100) NOT NULL default '',
`module` varchar(50) NOT NULL default 'index',
`action` varchar(150) NOT NULL default '',
`describe` varchar(255) NOT NULL default '',
`message` varchar(255) NOT NULL default '',
`allow_all` tinyint(1) NOT NULL default '0',
`credit_require` varchar(255) NOT NULL default '',
`credit_update` varchar(255) NOT NULL default '',
`php_code` text NOT NULL default '',
`log` tinyint(1) unsigned NOT NULL default '0',
`is_admin` tinyint(1) unsigned default '0',
PRIMARY KEY  (`id`),
UNIQUE KEY `action` (`module`,`name`,`is_admin`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_role_module`;
CREATE TABLE `myth_system_role_module` (
`module` varchar(50) NOT NULL default '',
`name` varchar(100) NOT NULL default '',
UNIQUE KEY `module` (`module`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_system_sessions`;
CREATE TABLE `myth_system_sessions` (
`sid` char(6) NOT NULL default '',
`ip1` tinyint(1) unsigned NOT NULL default '0',
`ip2` tinyint(1) unsigned NOT NULL default '0',
`ip3` tinyint(1) unsigned NOT NULL default '0',
`ip4` tinyint(1) unsigned NOT NULL default '0',
`uid` mediumint(8) unsigned NOT NULL default '0',
`username` varchar(100) NOT NULL default '',
`groupid` smallint(4) unsigned NOT NULL default '0',
`styleid` smallint(4) unsigned NOT NULL default '0',
`invisible` tinyint(1) NOT NULL default '0',
`action` tinyint(1) unsigned NOT NULL default '0',
`lastactivity` int(10) unsigned NOT NULL default '0',
`lastolupdate` int(10) unsigned NOT NULL default '0',
`pageviews` smallint(4) unsigned NOT NULL default '0',
`seccode` mediumint(6) unsigned NOT NULL default '0',
`fid` smallint(4) unsigned NOT NULL default '0',
`tid` mediumint(8) unsigned NOT NULL default '0',
`bloguid` mediumint(8) unsigned NOT NULL default '0',
UNIQUE KEY `sid` (`sid`),
KEY `uid` (`uid`),
KEY `bloguid` (`bloguid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_task`;
CREATE TABLE `myth_task` (
`id` smallint(4) unsigned NOT NULL auto_increment,
`available` tinyint(1) NOT NULL default '0',
`type` enum('user','system') NOT NULL default 'user',
`name` char(50) NOT NULL default '',
`filename` char(50) NOT NULL default '',
`lastrun` int(10) unsigned NOT NULL default '0',
`nextrun` int(10) unsigned NOT NULL default '0',
`weekday` tinyint(1) NOT NULL default '0',
`day` tinyint(1) NOT NULL default '0',
`hour` tinyint(1) NOT NULL default '0',
`minute` char(36) NOT NULL default '',
PRIMARY KEY  (`id`),
KEY `nextrun` (`available`,`nextrun`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_task_log`;
CREATE TABLE `myth_task_log` (
`id` int(10) NOT NULL auto_increment,
`task_id` int(10) unsigned NOT NULL default '0',
`exec_time` float unsigned NOT NULL default '0',
`message` text NOT NULL default '',
`error` int(10) NOT NULL default '0',
`dateline` int(10) NOT NULL default '0',
`ip` varchar(16) NOT NULL default '0',
`username` varchar(15) NOT NULL default '',
`uid` mediumint(8) unsigned NOT NULL default '0',
`agent` varchar(255) NOT NULL default '',
PRIMARY KEY  (`id`),
KEY `uid` (`uid`),
KEY `task_id` (`task_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_addmoney`;
CREATE TABLE `myth_tttuangou_addmoney` (
`id` varbinary(30) NOT NULL,
`money` float NOT NULL,
`userid` int(10) NOT NULL default '0',
`paytime` datetime NOT NULL,
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_city`;
CREATE TABLE `myth_tttuangou_city` (
`cityid` int(10) NOT NULL auto_increment,
`cityname` varchar(50) NOT NULL default '',
`shorthand` varchar(20) NOT NULL default '',
`display` tinyint(1) default '0',
UNIQUE KEY `cityid` (`cityid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_cron`;
CREATE TABLE `myth_tttuangou_cron` (
`id` int(10) NOT NULL auto_increment,
`address` varchar(100) default NULL,
`username` varchar(50) default NULL,
`title` varchar(100) default NULL,
`content` text NOT NULL default '',
`addtime` int(10) default NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_email`;
CREATE TABLE `myth_tttuangou_email` (
`id` int(10) NOT NULL auto_increment,
`email` varchar(100) NOT NULL default '',
`city` smallint(3) NOT NULL default '0',
`time` date NOT NULL default '0000-00-00',
UNIQUE KEY `id` (`id`),
UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_finder`;
CREATE TABLE `myth_tttuangou_finder` (
`id` int(10) NOT NULL auto_increment,
`buyid` varchar(50) NOT NULL default '',
`buytime` int(10) NOT NULL default '0',
`productid` int(10) NOT NULL default '0',
`finderid` int(10) NOT NULL default '0',
`findtime` int(10) NOT NULL default '0',
`status` smallint(2) NOT NULL default '1',
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_mail`;
CREATE TABLE `myth_tttuangou_mail` (
`mid` int(10) NOT NULL auto_increment,
`name` varchar(100) NOT NULL default '',
`intro` varchar(200) NOT NULL default '',
`title` varchar(100) NOT NULL default '',
`content` text NOT NULL default '',
PRIMARY KEY  (`mid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_order`;
CREATE TABLE `myth_tttuangou_order` (
`orderid` bigint(11) NOT NULL default '0',
`productid` int(10) NOT NULL default '0',
`productnum` int(10) NOT NULL default '0',
`userid` int(10) NOT NULL default '0',
`buytime` int(10) NOT NULL default '0',
`paytype` int(10) default '1',
`pay` tinyint(1) default '0',
`paytime` int(10) NOT NULL default '0',
`status` tinyint(1) default '1',
UNIQUE KEY `orderid` (`orderid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_payment`;
CREATE TABLE `myth_tttuangou_payment` (
`pay_id` tinyint(1) unsigned NOT NULL auto_increment,
`pay_code` varchar(20) NOT NULL default '',
`pay_name` varchar(120) NOT NULL default '',
`pay_desc` text NOT NULL default '',
`pay_order` tinyint(1) unsigned NOT NULL default '0',
`pay_config` text NOT NULL default '',
`is_cod` tinyint(1) unsigned NOT NULL default '0',
`is_online` tinyint(1) unsigned NOT NULL default '0',
PRIMARY KEY  (`pay_id`),
UNIQUE KEY `pay_code` (`pay_code`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_product`;
CREATE TABLE `myth_tttuangou_product` (
`id` int(10) NOT NULL auto_increment,
`is_seckill` tinyint(1) default '0',
`sellerid` int(10) NOT NULL default '0',
`city` int(10) NOT NULL default '0',
`name` varchar(200) NOT NULL default '',
`price` int(10) NOT NULL default '0',
`nowprice` int(10) NOT NULL default '0',
`img` varchar(200) NOT NULL default '',
`intro` varchar(200) NOT NULL default '',
`content` text NOT NULL default '',
`cue` text NOT NULL default '',
`theysay` text NOT NULL default '',
`wesay` text NOT NULL default '',
`begintime` datetime NOT NULL default '0000-00-00 00:00:00',
`overtime` datetime NOT NULL default '0000-00-00 00:00:00',
`perioddate` date NOT NULL default '0000-00-00',
`successnum` smallint(6) NOT NULL default '0',
`maxnum` int(10) default '0',
`oncemax` int(10) default '0',
`totalnum` int(10) default '0',
`display` tinyint(1) NOT NULL default '0',
`addtime` date NOT NULL default '0000-00-00',
`status` smallint(1) NOT NULL default '1',
UNIQUE KEY `id` (`id`),
KEY `city` (`city`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_question`;
CREATE TABLE `myth_tttuangou_question` (
`id` int(10) NOT NULL auto_increment,
`userid` int(10) NOT NULL default '0',
`username` varchar(100) NOT NULL default '',
`content` text NOT NULL default '',
`reply` text NOT NULL default '',
`time` int(10) NOT NULL default '0',
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_addmoney`;
CREATE TABLE `myth_tttuangou_addmoney` (
`id` varbinary(30) NOT NULL,
`money` float NOT NULL,
`userid` int(10) NOT NULL default '0',
`paytime` datetime NOT NULL,
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_seller`;
CREATE TABLE `myth_tttuangou_seller` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`userid` int(10) NOT NULL default '0',
`sellername` VARCHAR(100) DEFAULT NULL,
`sellerphone` VARCHAR(100) DEFAULT NULL,
`selleraddress` VARCHAR(200) DEFAULT NULL,
`sellerurl` VARCHAR(100) DEFAULT NULL,
`sellermap` VARCHAR(100) DEFAULT NULL,
`area` SMALLINT(6) DEFAULT NULL,
`productnum` int(10) DEFAULT '0',
`successnum` int(10) DEFAULT '0',
`money` int(10) DEFAULT '0',
`time` int(10) NOT NULL default '0',
UNIQUE KEY `userid` (`userid`),
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_ticket`;
CREATE TABLE `myth_tttuangou_ticket` (
`ticketid` int(10) NOT NULL auto_increment,
`uid` int(10) NOT NULL default '0',
`productid` int(10) NOT NULL default '0',
`orderid` int(10) NOT NULL default '0',
`number` varchar(20) NOT NULL default '',
`password` varchar(50) NOT NULL default '',
`usetime` datetime NOT NULL,
`status` tinyint(1) default '1',
UNIQUE KEY `ticketid` (`ticketid`),
UNIQUE KEY `number` (`number`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_usermoney`;
CREATE TABLE `myth_tttuangou_usermoney` (
`mid` int(10) NOT NULL auto_increment,
`userid` int(10) NOT NULL default '0',
`type` tinyint(1) NOT NULL default '0',
`name` varchar(100) NOT NULL default '',
`intro` varchar(200) NOT NULL default '',
`money` int(10) NOT NULL default '0',
`time` int(10) NOT NULL default '0',
UNIQUE KEY `mid` (`mid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `myth_tttuangou_usermsg`;
CREATE TABLE `myth_tttuangou_usermsg` (
`id` int(10) NOT NULL auto_increment,
`name` varchar(100) NOT NULL default '',
`phone` varchar(50) NOT NULL default '',
`elsecontat` varchar(200) NOT NULL default '',
`content` text NOT NULL default '',
`time` int(10) NOT NULL default '0',
`type` smallint(6) NOT NULL default '0',
`readed` tinyint(1) NOT NULL default '0',
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

INSERT INTO `myth_system_role` VALUES  ('1',0xd3cebfcd,'0','0',0x35302c35312c35322c35342c3536,'normal','2','7'), ('2',0xb9dcc0edd4b1,'0','0',0x35302c35312c35322c35332c35342c35352c35362c38382c39322c31322c31332c39312c39332c3131312c3131352c3132352c3132362c3135342c3135352c3136312c372c382c392c3133372c31302c31312c3133382c3130312c3130322c3133392c3139372c37392c38392c36382c3130332c3130352c38342c39302c3130372c3132332c3133322c3133332c3133342c3130362c3130382c3136392c3131302c3133352c3133362c3135382c3135392c3137322c3231362c3231372c3231382c3231392c3137332c3137342c3137352c3137362c3137372c3137382c3137392c3138302c3138312c3138322c3138332c3138342c3138352c3138362c3138372c3138382c3138392c3139302c3139312c3139322c3139332c3139342c3139352c3139362c3139382c3139392c3230302c3230312c3230322c3230332c3230342c3230352c3230362c3230372c3230382c3230392c3231302c3231312c3231322c3231332c3231342c323135,'admin','1','1'), ('3',0xc6d5cda8bbe1d4b1,'0','1000',0x35302c35312c35322c35332c35342c35352c3536,'normal','2','10'), ('4',0xbdfbd1d4d7e9,'0','0',0x35302c35312c35322c3536,'normal','0','10'), ('5',0xb5c8d1e9d6a4bbe1d4b1,'0','0',0x35302c35312c35322c35332c3536,'normal','0','8'), ('6',0xbacfd7f7c9ccbcd2,'0','0',0x35302c35312c35322c35332c35342c35352c35362c313830,'normal','0','10'), ('7',0xcfb5cdb3ceacbba4c8cbd4b1,'0','0',0x35302c35312c35322c35332c35352c35362c38382c39322c31332c3132352c3132362c382c3133372c3133392c38392c3133332c3133352c3135382c3231382c3137332c3137352c3137382c3138322c3138362c3139302c3139322c3139362c3139392c3230382c3231302c3231332c323134,'admin','0','10');

INSERT INTO `myth_system_role_module` VALUES  (0x726f6c655f616374696f6e,0xb6afd7f7c8a8cfdeb9dcc0ed), (0x726f6c65,0xbdc7c9abc9e8d6c3), (0x6c6f67696e,0xb5c7c2bd), (0x696e646578,0xcad7d2b3), (0x6d656d626572,0xbbe1d4b1), (0x73657474696e67,0xcfb5cdb3c9e8d6c3), (0x6c696e6b,0xd3d1c7e9c1b4bdd3c9e8d6c3), (0x726f6c655f6d6f64756c65,0xb6afd7f7c4a3bfe9c9e8d6c3), (0x6462,0xcafdbeddbfe2b9dcc0ed), (0x73686f77,0xbde7c3e6d3ebcfd4cabec9e8d6c3), (0x726f626f74,0xd6a9d6ebc5c0d0d0bcc7c2bc), (0x746167,0x544147b9dcc0ed), (0x7265706f7274,0xbed9b1a8b9dcc0ed), (0x74747475616e676f75,0xcceccceccdc5b9ba), (0x7563656e746572,0x5563656e746572d5fbbacf), (0x6361636865,0xbbbab4e6b9dcc0ed), (0x75706772616465,0xcfb5cdb3c9fdbcb6), (0x7461736b,0xbcc6bbaec8cecef1);

INSERT INTO `myth_system_role_action` VALUES  ('88',0xbdf8c8ebbaf3cca8,0x696e646578,0x2a,'','','0','','','','0','1'), ('92',0xb2e9bfb455524cb5d8d6b7c9e8d6c3,0x73657474696e67,0x6d6f646966795f72657772697465,'','','0','','','','0','1'), ('7',0xccedbcd3d0c2bdc7c9ab,0x726f6c65,0x646f616464,'','','0','','','','0','1'), ('8',0xb2e9bfb4bdc7c9abc1d0b1ed,0x726f6c65,0x6c697374,'','','0','','','','0','1'), ('9',0xd0deb8c4bdc7c9abc8a8cfde,0x726f6c65,0x646f6d6f64696679,'','','0','','','','0','1'), ('10',0xccedbcd3d0c2b6afd7f7,0x726f6c655f616374696f6e,0x646f616464,'','','0','','','','0','1'), ('11',0xcbf9d3d0b6afd7f7c1d0b1ed,0x726f6c655f616374696f6e,0x6c697374,'','','0','','','','0','1'), ('12',0xd0deb8c4bbfdb7d6c9e8d6c3,0x73657474696e67,0x646f6d6f646966795f63726564697473,'','','0','','','','0','1'), ('13',0xb2e9bfb4bacbd0c4c9e8d6c3,0x73657474696e67,0x6d6f646966795f6e6f726d616c,'','','0','','','','0','1'), ('79',0xd0deb8c4b6afd7f7b5c4c4a3bfe9,0x726f6c655f6d6f64756c65,0x646f6d6f64696679,'','','0','','','','0','1'), ('50',0xb5c7c2bdcfb5cdb3,0x6c6f67696e,0x646f6c6f67696e7c,'','','1','','','','0','0'), ('51',0xcdcbb3f6cfb5cdb3,0x6c6f67696e,0x6c6f676f7574,'','','1','','','','0','0'), ('52',0xc1d0b1edbbe1d4b1,0x6d656d626572,0x6c697374,'','','1','','','','0','0'), ('53',0xc7b0cca8d0deb8c4b8f6c8cbd0c5cfa2,0x6d656d626572,0x6d6f646966797c646f6d6f64696679,'','','0','','','','0','0'), ('54',0xd7a2b2e1bbe1d4b1,0x6d656d626572,0x72656769737465727c646f72656769,'','','0','','','','0','0'), ('55',0xcbd1cbf7bbe1d4b1,0x6d656d626572,0x736561726368,'','','0','','','','0','0'), ('56',0xc7b0cca8b2e9bfb4bbe1d4b1,0x6d656d626572,0x76696577,'','','1','','','','0','0'), ('68',0xbaf3cca8b1e0bcadbbe1d4b1d0c5cfa2,0x6d656d626572,0x646f6d6f64696679,'','','0','','','','0','1'), ('138',0xb7d6c4a3bfe9b6afd7f7c1d0b1ed,0x726f6c655f616374696f6e,0x6c6973745f616374696f6e,'','','0','','','','0','1'), ('84',0xb1e0bcadd3d1c7e9c1b4bdd3,0x6c696e6b,0x646f6d6f64696679,'','','0','','','','0','1'), ('89',0xb6afd7f7b5c4c4a3bfe9c1d0b1ed,0x726f6c655f6d6f64756c65,0x6d6f64696679,'','','0','','','','0','1'), ('90',0xcce1bdbbcafdbeddbfe2b1b8b7dd,0x6462,0x646f6578706f7274,'','','0','','','','0','1'), ('91',0xd0deb8c4bacbd0c4c9e8d6c3,0x73657474696e67,0x646f6d6f646966795f6e6f726d616c,'','','0','','','','0','1'), ('93',0xd0deb8c455524cb5d8d6b7c9e8d6c3,0x73657474696e67,0x646f6d6f646966795f72657772697465,'','','0','','','','0','1'), ('101',0xd0deb8c4b6afd7f7c9e8d6c3,0x726f6c655f616374696f6e,0x646f6d6f64696679,'','','0','','','','0','1'), ('102',0xc9beb3fdb6afd7f7,0x726f6c655f616374696f6e,0x64656c657465,'','','0','','','','0','1'), ('103',0xbaf3cca8ccedbcd3d0c2d3c3bba7,0x6d656d626572,0x646f616464,'','','0','','','','0','1'), ('105',0xbaf3cca8c9beb3fdd3c3bba7,0x6d656d626572,0x64656c6574657c646f64656c657465,'','','0','','','','0','1'), ('106',0xd0deb8c4bde7c3e6cfd4cabec9e8b6a8,0x73686f77,0x646f6d6f64696679,'','','0','','','','0','1'), ('107',0xbde2d1b9cbf5cafdbeddb1b8b7ddb0fc,0x6462,0x696d706f72747a6970,'','','0','','','','0','1'), ('108',0xbfaab9d8d6a9d6ebcdb3bcc6,0x726f626f74,0x646f6d6f64696679,'','','0','','','','0','1'), ('110',0xc9beb3fd544147,0x746167,0x64656c657465,'','','0','','','','0','1'), ('111',0xd0deb8c4c4dac8ddb9fdc2cbc9e8d6c3,0x73657474696e67,0x646f6d6f646966795f66696c746572,'','','0','','','','0','1'), ('115',0xd0deb8c44950b7c3cecabfd8d6c6,0x73657474696e67,0x646f6d6f646966795f616363657373,'','','0','','','','0','1'), ('123',0xd6b4d0d0cafdbeddbfe2d3c5bbaf,0x6462,0x646f6f7074696d697a65,'','','0','','','','0','1'), ('125',0xb2e9bfb4c4dac8ddb9fdc2cbc9e8d6c3,0x73657474696e67,0x6d6f646966795f66696c746572,'','','0','','','','0','1'), ('126',0xb2e9bfb44950b7c3cecabfd8d6c6,0x73657474696e67,0x6d6f646966795f616363657373,'','','0','','','','0','1'), ('132',0xb5bcc8ebcafdbeddbbd6b8b4,0x6462,0x646f696d706f7274,'','','0','','','','0','1'), ('133',0xb2e9bfb4cafdbeddbfe2b1b8b7dd,0x6462,0x696d706f7274,'','','0','','','','0','1'), ('134',0xc9beb3fdcafdbeddbfe2b1b8b7dd,0x6462,0x646f64656c657465,'','','0','','','','0','1'), ('135',0xb2e9bfb45543d5fbbacfc5e4d6c3,0x7563656e746572,0x7563656e746572,'','','0','','','','0','1'), ('136',0xbfaac6f4c9e8d6c35563656e746572,0x7563656e746572,0x646f5f73657474696e67,'','','0','','','','0','1'), ('137',0xb2e9bfb4bdc7c9abc8a8cfde,0x726f6c65,0x6d6f64696679,'','','0','','','','0','1'), ('139',0xb2e9bfb4b6afd7f7c9e8d6c3,0x726f6c655f616374696f6e,0x6d6f64696679,'','','0','','','','0','1'), ('154',0xc9e8d6c3534d5450,0x73657474696e67,0x646f5f6d6f646966795f736d7470,'','','0','','','','0','1'), ('155',0xbfaac6f4d1e9d6a4c2eb,0x73657474696e67,0x646f5f6d6f646966795f736563636f6465,'','','0','','','','0','1'), ('158',0xc7e5bfd5bbbab4e6,0x6361636865,0x2a,'','','0','','','','0','1'), ('159',0xcfb5cdb3c9fdbcb6,0x75706772616465,0x2a,'','','0','','','','0','1'), ('161',0xc9e8d6c3baf3cca8bfecbdddb7bdcabd,0x73657474696e67,0x646f5f6d6f646966795f73686f7274637574,'','','0','','','','0','1'), ('172',0xbed9b1a8b9dcc0ed,0x7265706f7274,0x62617463685f70726f63657373,'','','0','','','','0','1'), ('216',0xb1e0bcadbcc6bbaec8cecef1,0x7461736b,0x646f62617463686d6f646966797c646f6d6f64696679,'','','0','','','','0','1'), ('169',0xbdfbd6b9cbd1cbf7d2fdc7e6,0x726f626f74,0x646973616c6c6f77307c646973616c6c6f7731,'','','0','','','','0','1'), ('173',0xb2e9bfb4cfb5cdb3b6a8d2e5,0x74747475616e676f75,0x76617273686f77,'','','0','','','','0','1'), ('174',0xb1e0bcadcfb5cdb3b6a8d2e5,0x74747475616e676f75,0x76617265646974,'','','0','','','','0','1'), ('175',0xb2e9bfb4d6a7b8b6c1d0b1ed,0x74747475616e676f75,0x6d61696e706179,'','','0','','','','0','1'), ('176',0xc6f4d3c3bbf2cda3d3c3c4b3d6a7b8b6bdd3bfda,0x74747475616e676f75,0x6f6e6c696e65706179,'','','0','','','','0','1'), ('177',0xc9e8d6c3c4b3d6a7b8b6bdd3bfda,0x74747475616e676f75,0x7365747061797c646f736574706179,'','','0','','','','0','1'), ('178',0xb2e9bfb4b3c7cad0c1d0b1ed,0x74747475616e676f75,0x63697479,'','','0','','','','0','1'), ('179',0xccedbcd3d0c2b5c4b3c7cad0,0x74747475616e676f75,0x616464636974797c646f61646463697479,'','','0','','','','0','1'), ('180',0xd0deb8c4b3c7cad0c9e8d6c3,0x74747475616e676f75,0x65646974636974797c646f6564697463697479,'','','0','','','','0','1'), ('181',0xc9beb3fdb3c7cad0,0x74747475616e676f75,0x64656c65746563697479,'','','0','','','','0','1'), ('182',0xb2e9bfb4c9ccbcd2c1d0b1ed,0x74747475616e676f75,0x6d61696e73656c6c6572,'','','0','','','','0','1'), ('183',0xccedbcd3d0c2b5c4c9ccbcd2,0x74747475616e676f75,0x61646473656c6c65727c646f61646473656c6c6572,'','','0','','','','0','1'), ('184',0xd0deb8c4c9ccbcd2d0c5cfa2,0x74747475616e676f75,0x6564697473656c6c65727c646f6564697473656c6c6572,'','','0','','','','0','1'), ('185',0xc9beb3fdc9ccbcd2d0c5cfa2,0x74747475616e676f75,0x64656c65746573656c6c6572,'','','0','','','','0','1'), ('186',0xb2e9bfb4b2fac6b7c1d0b1ed,0x74747475616e676f75,0x6c69737470726f64756374,'','','0','','','','0','1'), ('187',0xccedbcd3d0c2b5c4b2fac6b7,0x74747475616e676f75,0x61646470726f647563747c646f61646470726f64756374,'','','0','','','','0','1'), ('188',0xd0deb8c4b2fac6b7d0c5cfa2,0x74747475616e676f75,0x6564697470726f647563747c646f6564697470726f64756374,'','','0','','','','0','1'), ('189',0xc9beb3fdb2fac6b7d0c5cfa2,0x74747475616e676f75,0x64656c65746570726f64756374,'','','0','','','','0','1'), ('190',0xb2e9bfb4b2fac6b7b5c4d6a7b8b6cfeacfb8,0x74747475616e676f75,0x70726f647563746f72646572,'','','0','','','','0','1'), ('191',0xb2fac6b7b5c4cdcbbfeeb2d9d7f7,0x74747475616e676f75,0x726566756e6470726f64756374,'','','0','','','','0','1'), ('192',0xb2e9bfb4b6a9b5a5c1d0b1ed,0x74747475616e676f75,0x6c6973746f72646572,'','','0','','','','0','1'), ('193',0xc8b7c8cfb6a9b5a5b8b6bfee,0x74747475616e676f75,0x636f6e6669726d6f72646572,'','','0','','','','0','1'), ('194',0xc9beb3fdd2bbb8f6b6a9b5a5,0x74747475616e676f75,0x64656c6574656f72646572,'','','0','','','','0','1'), ('195',0x5bb6a9b5a55dd3cabcfecda8d6aab8b6bfee,0x74747475616e676f75,0x6d61696c63616c6c706179,'','','0','','','','0','1'), ('196',0xb2e9bfb4cdc5b9bac8afc1d0b1ed,0x74747475616e676f75,0x7469636b6574,'','','0','','','','0','1'), ('197',0xc9beb3fdcdc5b9bac8af,0x726f6c655f616374696f6e,0x64656c6574657469636b6574,'','','0','','','','0','1'), ('198',0x5bcdc5b9bac8af5db7a2cbcdb5bdc6dacce1d0d1,0x74747475616e676f75,0x7761726e6f667469636b6574,'','','0','','','','0','1'), ('199',0xb2e9bfb4b7b5c0fbc1d0b1ed,0x74747475616e676f75,0x6d61696e66696e646572,'','','0','','','','0','1'), ('200',0xbaf3cca8b7b5c0fbb2d9d7f7,0x74747475616e676f75,0x79657366696e646572,'','','0','','','','0','1'), ('201',0xc8a1cffbb7b5c0fbb2d9d7f7,0x74747475616e676f75,0x6e6f66696e646572,'','','0','','','','0','1'), ('202',0xb2e9bfb4d3cabcfec1d0b1ed,0x74747475616e676f75,0x6d61696c,'','','0','','','','0','1'), ('203',0xccedbcd3d3cabcfed1f9cabd,0x74747475616e676f75,0x6164646d61696c7c646f6164646d61696c,'','','0','','','','0','1'), ('204',0xc9e8d6c3d3cabcfeb7a2cbcdb2cecafd,0x74747475616e676f75,0x7365746d61696c7c646f7365746d61696c,'','','0','','','','0','1'), ('205',0xb7a2cbcdd3cabcfe,0x74747475616e676f75,0x73656e646d61696c,'','','0','','','','0','1'), ('206',0xd0deb8c4d3cabcfec9e8d6c3,0x74747475616e676f75,0x656469746d61696c7c646f656469746d61696c,'','','0','','','','0','1'), ('207',0xc9beb3fdd3cabcfe,0x74747475616e676f75,0x64656c6574656d61696c,'','','0','','','','0','1'), ('208',0xb2e9bfb4b6a9d4c4c1d0b1ed,0x74747475616e676f75,0x656d61696c,'','','0','','','','0','1'), ('209',0xc9beb3fdd3cabcfeb6a9d4c4,0x74747475616e676f75,0x64656c657465656d61696c,'','','0','','','','0','1'), ('210',0xb2e9bfb4cecab4f0c1d0b1ed,0x74747475616e676f75,0x6d61696e7175657374696f6e,'','','0','','','','0','1'), ('211',0xbbd8b8b4cce1ceca,0x74747475616e676f75,0x7265706c797175657374696f6e7c646f7265706c797175657374696f6e,'','','0','','','','0','1'), ('212',0xc9beb3fdcce1ceca,0x74747475616e676f75,0x64656c6574657175657374696f6e,'','','0','','','','0','1'), ('213',0xb2e9bfb4b7b4c0a1d0c5cfa2c1d0b1ed,0x74747475616e676f75,0x757365726d7367,'','','0','','','','0','1'), ('214',0xb2e9bfb4c4b3ccf5b7b4c0a1d0c5cfa2,0x74747475616e676f75,0x72656164757365726d7367,'','','0','','','','0','1'), ('215',0xc9beb3fdc4b3ccf5b7b4c0a1d0c5cfa2,0x74747475616e676f75,0x64656c657465757365726d7367,'','','0','','','','0','1'), ('217',0xd6b4d0d0bcc6bbaec8cecef1,0x7461736b,0x72756e,'','','0','','','','0','1'), ('218',0xb2e9bfb4bcc6bbaec8cecef1d6b4d0d04c4f47,0x7461736b,0x6c6f675f6c697374,'','','0','','','','0','1'), ('219',0xc9beb3fdbcc6bbaec8cecef1d6b4d0d04c4f47,0x7461736b,0x6c6f675f64656c657465,'','','0','','','','0','1');

INSERT INTO `myth_tttuangou_payment` VALUES  ('1',0x616c69706179,0xd6a7b8b6b1a6,0xb0a2c0efb0cdb0cdc6eccfc2b5c4d6a7b8b6b1a6,'1','','0','1'), ('2',0x74656e706179,0xb2c6b8b6cda8,0xccdad1b6c6eccfc2d4dacfdfd6a7b8b6c6bdcca8a3accda8b9fdb9fabcd2c8a8cdfeb0b2c8abc8cfd6a4a3acd6a7b3d6b8f7b4f3d2f8d0d0cdf8c9cfd6a7b8b6a3acc3e2d6a7b8b6cad6d0f8b7d1,'0','','0','1'), ('3',0x62616e6b,0xd2f8d0d0bbe3bfee2fd7aad5ca,0xd6d0b9fad2f8d0d00d0acad5bfeec8cbd0c5cfa2a3bad6d0b9fac8cbc3f1d2f8d0d00d0ad5cabac5bbf2b5d8d6b72034343434343434340d0abfaabba7d0d020b0aeb5cfc9fa0d0a0d0ad7a2d2e2cac2cfeea3bab0ecc0edb5e7bbe3cab1a3acc7ebd4dab5e7bbe3b5a5a1b0bbe3bfeed3c3cdbea1b1d2bbc0b8b4a6d7a2c3f7c4fab5c4b6a9b5a5bac5a1a3,'3',0x4e3b,'1','1'), ('4',0x6b7561697169616e,0xbfecc7aed6a7b8b6,0xbfecc7aecac7b9fac4dac1eccfc8b5c4b6c0c1a2b5dac8fdb7bdd6a7b8b6c6f3d2b5,'2','','0','1');

INSERT INTO `myth_task` VALUES  ('1','1','system',0xd6b4d0d0d3cabcfeb7a2cbcdbcc6bbaec8cecef1,0x6d61696c5f73656e642e7461736b2e706870,'1279264404','1279265760','-1','-1','-1',0x3130093336093532);
