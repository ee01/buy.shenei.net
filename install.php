<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename install.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 

error_reporting(E_ALL ^ E_NOTICE);
@header('Content-Type: text/html; charset=gbk');

@set_time_limit(300);
@ini_set("memory_limit","128M");
@set_magic_quotes_runtime(0);

if(PHP_VERSION < '4.1.0') {
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
}
define('IN_TTTUANGOU', TRUE);
define('TTTUANGOU_ROOT', './');

$installfile = basename(__FILE__);
$sqlfile = './install/tttuangou.sql';
$testsqlfile = './install/tttg_test.sql';
$lockfile = './install/install.lock';
$installmarkfile = './install/install.mark';
$attachdir = './attachments';
$attachurl = 'attachments';
$quit = FALSE;

//$sqlfilemd5value = '814a960751cf74fb58292a8754d6deaf';
//if ('INSTALL_SQ'.'L_FILE_MD'.'5_VALUE' != $sqlfilemd5value && md5_file($sqlfile) != $sqlfilemd5value) exit("请上载正确的数据库文件。");

;


include './install/install.lang.php';
include './install/global.func.php';
include './setting/settings.php';
include './install/db_mysql.class.php';
include './setting/constants.php';
error_reporting(E_ALL ^ E_NOTICE);


$inslang = defined('INSTALL_LANG') ? INSTALL_LANG : '';
$version = SYS_VERSION.' '.$lang[$inslang];
$charset=$config['charset'];

@header('Content-Type: text/html; charset=' . $charset);

if(!defined('INSTALL_LANG') || !function_exists('instmsg') || !is_readable($sqlfile)) {
	exit("Please upload all files to install tttuangou system<br />&#x5b89;&#x88c5; 【天天团购】 &#x60a8;&#x5fc5;&#x987b;&#x4e0a;&#x4f20;&#x6240;&#x6709;&#x6587;&#x4ef6;&#xff0c;&#x5426;&#x5219;&#x65e0;&#x6cd5;&#x7ee7;&#x7eed;");
} elseif(!isset($config['db_host']) || !isset($config['auth_key'])) {
	instmsg('config_nonexistence');
} elseif(!ini_get('short_open_tag')) {
	instmsg('short_open_tag_invalid');
} elseif(is_file($lockfile)) {
	instmsg('lock_exists');
} elseif(!class_exists('dbstuff')) {
	instmsg('database_nonexistence');
}

if(function_exists('instheader')) {
	instheader();
}

if(empty($dbcharset) && in_array(strtolower($charset), array('gbk', 'big5', 'utf-8'))) {
	$dbcharset = str_replace('-', '', $charset);
}

$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
if(in_array($action, array('check', 'config'))) {
	if(is_writeable('./setting')) {
		$writeable['config'] = result(1, 0);
		$write_error = 0;
	} else {
		$writeable['config'] = result(0, 0);
		$write_error = 1;
	}
}

if(!$action) {

	$AIJUHE_license = str_replace('  ', '&nbsp; ', $lang['license']);

?>
<tr><td><b><?=$lang['current_process']?> </b><font color="#0000EE"><?=$lang['show_license']?></font></td></tr>
<tr><td><hr noshade align="center" width="100%" size="1"></td></tr>
<tr><td><br />
<table width="90%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr><td class="altbg1">
<table width="99%" cellspacing="1" border="0" align="center">
<tr><td><?=$AIJUHE_license?></td></tr>
</table></td></tr></table>
</td></tr>
<tr><td align="center">
<br /><form method="post" action="<?=$installfile?>">
<input type="hidden" name="action" value="check">
<input type="submit" name="submit" value="<?=$lang['agreement_yes']?>" style="height: 25">&nbsp;
<input type="button" name="exit" value="<?=$lang['agreement_no']?>" style="height: 25" onclick="javascript: window.close();">
</form></td></tr>
<?
	instfooter();

} elseif($action == 'check') {

?>
<tr><td><b><?=$lang['current_process']?> </b><font color="#0000EE"> <?=$lang['check_config']?></font></td></tr>
<tr><td><hr noshade align="center" width="100%" size="1"></td></tr>
<tr><td><br />
<?php

	$msg = '';
	$curr_os = PHP_OS;	
		
		$curr_path = __FILE__;
	if (preg_match('~(?:[\x7f-\xff][\x7f-\xff])+~',$curr_path)) {
		$msg .= "<li>{$lang['path_unsupport']}</li>";
		$quit = true;
	}

	if(!function_exists('mysql_connect')) {
		$curr_mysql = $lang['unsupport'];
		$msg .= "<li>$lang[mysql_unsupport]</li>";
		$quit = TRUE;
	} else {
		$curr_mysql = $lang['support'];
	}

	$curr_php_version = PHP_VERSION;
	if($curr_php_version < '4.0.6') {
		$msg .= "<li>$lang[php_version_406]</li>";
		$quit = TRUE;
	}

	if(@ini_get(file_uploads)) {
		$max_size = @ini_get(upload_max_filesize);
		$curr_upload_status = $lang['attach_enabled'].$max_size;
	} else {
		$curr_upload_status = $lang['attach_disabled'];
		$msg .= "<li>$lang[attach_disabled_info]</li>";
	}

	$curr_disk_space = intval(diskfreespace('.') / (1024 * 1024)).'M';

	$checkdirarray = array(
				'cache' => './cache',
				'images' => './images',
				'install' => './install',
				'errorlog' => './errorlog',
				'setting' => './setting',
			);

	foreach($checkdirarray as $key => $dir) {
		if(dir_writeable($dir)) {
			$writeable[$key] = result(1, 0);
		} else {
			$writeable[$key] = result(0, 0);
			$langkey = $key.'_unwriteable';
			$msg .= "<li>$lang[$langkey]</li>";
			$quit = TRUE;
		}
	}
			$setting_dir='./setting';
	$fp=opendir($setting_dir);
	while ($filename=readdir($fp)) 
	{
		if(preg_match("/\.php$/i",$filename)>0)
		{
			$_file=$setting_dir.'/'.$filename;
			@chmod($_file,0777);
			if(touch($_file)==false)
			{
				$writeable['setting_config'].=$_file.result(0, 0);
				$quit=true;
			}
		}
	}
	if(empty($writeable['setting_config']))$writeable['setting_config']=result(1, 0);

	if($quit) {
		$submitbutton = '<input type="button" name="submit" value=" '.$lang['recheck_config'].' " style="height: 25" onclick="window.location=\'?action=check\'">';
	} else {
		$submitbutton = '<input type="submit" name="submit" value=" '.$lang['new_step'].' " style="height: 25">';
		$msg = $lang['preparation'];
	}

?>
<tr><td align="center">
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273"><td style="color: #FFFFFF; padding-left: 10px" width="32%"><?=$lang['tips_message']?></td>
</tr><tr>
<td class="message"><?=$msg?></td>
</tr></table><br />
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr class="header"><td></td><td><?=$lang['env_required']?></td><td><?=$lang['env_best']?></td><td><?=$lang['env_current']?></td>
</tr><tr class="option">
<td class="altbg1"><?=$lang['env_os']?></td>
<td class="altbg2"><?=$lang['unlimited']?></td>
<td class="altbg1">UNIX/Linux/FreeBSD</td>
<td class="altbg2"><?=$curr_os?></td>
</tr><tr class="option">
<td class="altbg1"><?=$lang['env_php']?></td>
<td class="altbg2">5.x</td>
<td class="altbg1">5.2以上</td>
<td class="altbg2"><?=$curr_php_version?></td>
</tr><tr class="option">
<td class="altbg1"><?=$lang['env_attach']?></td>
<td class="altbg2"3><?=$lang['unlimited']?></td>
<td class="altbg1"><?=$lang['enabled']?></td>
<td class="altbg2"><?=$curr_upload_status?></td>
</tr><tr class="option">
<td class="altbg1"><?=$lang['env_mysql']?></td>
<td class="altbg2">5.x</td>
<td class="altbg1">5.2以上</td>
<td class="altbg2"><?=$curr_mysql?></td>
</tr><tr class="option">
<td class="altbg1"><?=$lang['env_diskspace']?></td>
<td class="altbg2">100M+</td>
<td class="altbg1">1000M+</td>
<td class="altbg2"><?=$curr_disk_space?></td>
</tr></table><br />
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr class="header"><td width="33%"><?=$lang['check_catalog_file_name']?></td><td width="33%"><?=$lang['check_need_status']?></td><td width="33%"><?=$lang['check_currently_status']?></td></tr>
<tr class="option">
<td class="altbg1">./setting</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['config']?></td>
</tr>
<tr class="option">
<td class="altbg1">./setting/目录下所有文件</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['setting_config']?></td>
</tr>
<tr class="option">
<td class="altbg1">./cache</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['cache']?></td>
</tr><tr class="option">
<td class="altbg1">./images</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['images']?></td>
</tr><tr class="option">
<td class="altbg1">./errorlog</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['errorlog']?></td>
</tr><tr class="option">
<td class="altbg1">./install</td>
<td class="altbg2"><?=$lang['writeable']?></td>
<td class="altbg1"><?=$writeable['install']?></td>
</tr></table></tr></td>
<tr><td align="center">
<br /><form method="post" action="<?=$installfile?>">
<input type="hidden" name="action" value="config">
<input type="button" name="submit" value=" <?=$lang['old_step']?> " style="height: 25" onclick="window.location='<?=$installfile?>'">&nbsp;
<?=$submitbutton?>
</form></td></tr>
<?php
	instfooter();

} elseif($action == 'config') {

?>
<tr><td><b><?=$lang['current_process']?> </b><font color="#0000EE"> <?=$lang['edit_config']?></font></td></tr>
<tr><td><hr noshade align="center" width="100%" size="1"></td></tr>
<tr><td><br />
<?php

	$inputreadonly = $write_error ? 'readonly' : '';
	$msg = '<li>'.$lang['config_comment'].'</li>';

	if($_POST['saveconfig']) {		
		$msg = '';
		if (!$_POST['db_host'] || !$_POST['db_user'] || !$_POST['db_name'] || !$_POST['site_admin_email']) {
			$msg .="<li>数据库配置和邮箱不能为空</li>";
			$quit = true;
		}
		
		if(!preg_match("~^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+([a-z]{2,4})|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$~i",$_POST['site_admin_email'])) {
			$msg .= "<li>请填写正确的邮箱地址</li>";
			$quit = true;
		}
		
		$config['template_path'] = setconfig(array_rand(array('default'=>1,)));
		$config['auth_key'] = setconfig(random(16)); 		$config['cookie_prefix'] = setconfig('TTtuangou_' . random(6) . '_'); 		$config['db_host'] = setconfig($_POST['db_host']);
		$config['db_user'] = setconfig($_POST['db_user']);
		$config['db_pass'] = setconfig($_POST['db_pass']);
		$config['db_name'] = setconfig($_POST['db_name']);
		$config['site_admin_email'] = setconfig($_POST['site_admin_email']);
		$config['db_table_prefix'] = setconfig($_POST['db_table_prefix'] ? $_POST['db_table_prefix'] : 'tttuangou_' . random(6) . '_');
		if(empty($config['db_name'])) {
			$msg .= '<li>'.$lang['dbname_invalid'].'</li>';
			$quit = TRUE;
		} else {
			if(!@mysql_connect($config['db_host'], $config['db_user'], $config['db_pass'])) {
				$errormsg = 'database_errno_'.mysql_errno();
				$msg .= '<li>'.$lang[$errormsg].'</li>';
				$quit = TRUE;
			} else {
				if(mysql_get_server_info() > '4.1') {
					mysql_query("CREATE DATABASE IF NOT EXISTS `{$config['db_name']}` DEFAULT CHARACTER SET $dbcharset");
				} else {
					mysql_query("CREATE DATABASE IF NOT EXISTS `{$config['db_name']}`");
				}
				if(mysql_errno()) {
					$errormsg = 'database_errno_'.mysql_errno();
					$msg .= "'<li>$errormsg ".$lang[$errormsg].'</li>';
					$quit = TRUE;
				}

				mysql_close();
			}
		}

		if(strstr($config['db_table_prefix'], '.')) {
			$msg .= '<li>'.$lang['tablepre_invalid'].'</li>';
			$quit = TRUE;
		}
		
				@unlink(".htaccess");
		$_rewrite=array (
		  'mode' => '',
		  'abs_path' => '/',
		  'arg_separator' => '/',
		  'var_separator' => '-',
		  'prepend_var_list' => 
		  array (
		    0 => 'mod',
		    1 => 'code',
		  ),
		  'var_replace_list' => 
		  array (
		    'mod' => 
		    array (
		    ),
		  ),
		  'value_replace_list' => 
			 array (
		    'mod' => 
		    array (
				'index' => array_rand(array('index'=>1,'default'=>1,'home'=>1,)),
				'list' => array_rand(array('list'=>1,'channel'=>1,)),
				'me' => array_rand(array('me'=>1,'myself'=>1,)),
		    ),
		  ),
		  'gateway' => '',
		);
		saveconfig($_rewrite,'./setting/rewrite.php','$_rewrite');
		
		if(!$quit) {
			if(!$write_error) {
				saveconfig($config);
				
				@include('./setting/link.php');
				if(!isset($config['link_list']['zzxgj'])) {
					$zzxgj_link_list = array(
						array (
						    'name' => _getaarrayrandval(array('站长工具','站长工具','比牛网站长工具',)),
						    'url' => 'http:/'.'/www.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('alexa排名','alexa排名查询')),
						    'url' => 'http:/'.'/alexa.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('whois查询','域名查询')),
						    'url' => 'http:/'.'/whois.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('同IP网站','同ip网站查询')),
						    'url' => 'http:/'.'/sameip.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('关键词排名','关键词排名查询')),
						    'url' => 'http:/'.'/keyword.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('友情链接分析','友情链接检查')),
						    'url' => 'http:/'.'/checklink.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('反向链接分析','关键词排名查询')),
						    'url' => 'http:/'.'/keyword.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('pr查询','google pr查询')),
						    'url' => 'http:/'.'/pr.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('收录查询','搜索引擎收录查询','网站收录查询','百度收录查询','网站收录','反向收录','网站收录查询',)),
						    'url' => 'http:/'.'/shoulu.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('ip地址查询','ip查询','ip地址')),
						    'url' => 'http:/'.'/ip.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('天天团购','天天团购系统','团购系统','免费团购系统','团购程序','团购网系统','开源团购系统','团购网',)),
						    'url' => 'http:/'.'/www.tttuangou.net',
						),
						array (
						    'name' => _getaarrayrandval(array('记事狗微博','开源微博系统','开源微博','微博','微博程序','微博系统',)),
						    'url' => 'http:/'.'/www.jishigou.net',
						),
						array (
						    'name' => _getaarrayrandval(array('网赚宝','智能采集器','伪原创系统','网赚必备工具','自动采集系统','智能采集和伪原创','PHP自动采集系统',)),
						    'url' => 'http:/'.'/www.wangzhuanbao.net',
						),
						array (
						    'name' => _getaarrayrandval(array('比牛站长工具','站长工具平台','站长工具','比牛网','站长网',)),
						    'url' => 'http:/'.'/www.biniu.com',
						),
						array (
						    'name' => _getaarrayrandval(array('爱聚合','关键词建站','关键词采集','自动伪原创','自动采集系统','智能采集','智能网赚系统','专题网赚系统',)),
						    'url' => 'http:/'.'/aijuhe.net',
						),
						array (
						    'name' => _getaarrayrandval(array('iJuhe英文站','英文建站系统','英文智能建站','英文网赚系统','英文建站','用中文建英文站','英文智能建站','英文自动采集',)),
						    'url' => 'http:/'.'/www.ijuhe.net',
						),

					);
					$config['link_list']['zzxgj'] = _getaarrayrandval($zzxgj_link_list);
					$config['link_list']['zzxgj1'] = _getaarrayrandval($zzxgj_link_list);
					$config['link_list']['zzxgj']['order'] = $config['link_list']['zzxgj1']['order'] = 100;
					if($config['link_list']['zzxgj']['url'] == $config['link_list']['zzxgj1']['url']) {
						unset($config['link_list']['zzxgj1']);
					}
					saveconfig($config['link_list'],'./setting/link.php','$config["link_list"]');
				}
			}
			redirect("$installfile?action=admin");
		}
	}
	
		unset($config['db_user'],$config['db_pass'],$config['db_name']);
	unset($config['site_admin_email'],$config['site_domain'],$config['site_url']);
	unset($config['cnzz_site_id'],$config['cnzz_auto_login']);
	$config['db_table_prefix'] = 'cenwor_';
?>
<tr><td align="center">
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273"><td style="color: #FFFFFF; padding-left: 10px" width="32%"><?=$lang['tips_message']?></td>
</tr><tr>
<td class="message"><?=$msg?></td>
</tr></table><br />
<form method="post" action="<?=$installfile?>">
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr class="header">
<td width="20%"><?=$lang['variable']?></td><td width="30%"><?=$lang['value']?></td><td width="50%"><?=$lang['comment']?></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['dbhost']?></td>
<td class="altbg2"><input type="text" name="db_host" value="<?=$config['db_host']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<?=$lang['dbhost_comment']?></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['dbuser']?></td>
<td class="altbg2"><input type="text" name="db_user" value="<?=$config['db_user']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<?=$lang['dbuser_comment']?></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['dbpw']?></td>
<td class="altbg2"><input type="password" name="db_pass" value="<?=$config['db_pass']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<?=$lang['dbpw_comment']?></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['dbname']?></td>
<td class="altbg2"><input type="test" name="db_name" value="<?=$config['db_name']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<?=$lang['dbname_comment']?></td>
</tr><tr>
<td class="altbg1">&nbsp;<span class="redfont"><?=$lang['email']?></span></td>
<td class="altbg2"><input type="text" name="site_admin_email" value="<?=$config['site_admin_email']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<span class="redfont"><?=$lang['email_comment']?></span></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['tablepre']?></td>
<td class="altbg2"><input type="text" name="db_table_prefix" value="<?=$config['db_table_prefix']?>" <?=$inputreadonly?> size="30"></td>
<td class="altbg1">&nbsp;<?=$lang['tablepre_comment']?></td>
</tr></table><br />
<input type="hidden" name="action" value="config">
<input type="hidden" name="saveconfig" value="1">
<input type="button" name="submit" value=" <?=$lang['old_step']?> " style="height: 25" onclick="window.location='?action=check'">&nbsp;
<input type="submit" name="submit" value=" <?=$lang['new_step']?> " style="height: 25">
</form></td></tr>
<?php
	instfooter();

} elseif($action == 'admin') {

?>
<tr><td><b><?=$lang['current_process']?> </b><font color="#0000EE"> <?=$lang['check_env']?></font></td></tr>
<tr><td><hr noshade align="center" width="100%" size="1"></td></tr>
<tr><td><br />
<?php

	$msg = '<li>'.$lang['add_admin'].'</li>';
	if(!@mysql_connect($config['db_host'], $config['db_user'], $config['db_pass'])) {
		$errormsg = 'database_errno_'.mysql_errno();
		$msg .= '<li>'.($lang[$errormsg] ? $lang[$errormsg] : mysql_error()) .'</li>';
		$quit = TRUE;
	} else {
		$curr_mysql_version = mysql_get_server_info();
		if($curr_mysql_version < '3.23') {
			$msg .= '<li>'.$lang['mysql_version_323'].'</li>';
			$quit = TRUE;
		}

		$sqlarray = array(
				'createtable' => 'CREATE TABLE `tttuangou_test_tb` (`test` TINYINT (3) UNSIGNED)',
				'insert' => 'INSERT INTO `tttuangou_test_tb` (`test`) VALUES (1)',
				'select' => 'SELECT * FROM `tttuangou_test_tb`',
				'update' => 'UPDATE `tttuangou_test_tb` SET `test`=\'2\' WHERE `test`=\'1\'',
				'delete' => 'DELETE FROM `tttuangou_test_tb` WHERE `test`=\'2\'',
				'droptable' => 'DROP TABLE `tttuangou_test_tb`'
			);

		foreach($sqlarray as $key => $sql) {
			mysql_select_db($config['db_name']);
			mysql_query($sql);
			if(mysql_errno()) {
				$errnolang = 'dbpriv_'.$key;
				$msg .= '<li>'.$lang[$errnolang].'</li>';
				$quit = TRUE;
			}
		}

				$result = (mysql_query("SELECT COUNT(*) FROM `{$config['db_table_prefix']}tttuangou_product`") && 
			mysql_query("SELECT COUNT(*) FROM `{$config['db_table_prefix']}tttuangou_order`"));
		if($result) {
			$msg .= '<li><font color="#FF0000">'.$lang['db_not_null'].'</font></li>';
			$alert = " onSubmit=\"return confirm('$lang[db_drop_table_confirm]');\"";
		}
	}

	if($_POST['submit']) {

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$install_test_data = $_POST['install_test_data'];
		
				$config['site_domain']=$_SERVER['HTTP_HOST'];
		$config['site_name']=$_POST['site_name'];
		$config['site_notice']=$_POST['site_notice'];
		$config['site_url']=rtrim(htmlspecialchars('http:/'.'/'.$_SERVER['HTTP_HOST'].preg_replace("/\/+/",'/',str_replace("\\",'/',dirname($_SERVER['PHP_SELF']))."/")),'/');
		saveconfig($config);		
		
		if($username && $email && $password1 && $password2) {
			if($password1 != $password2) {
				$msg .= '<li><font color="#FF0000">'.$lang['admin_password_invalid'].'</font></li>';
				$quit = TRUE;
			} elseif(strlen($username) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $username)) {
				$msg = $lang['admin_username_invalid'];
				$quit = TRUE;
			} elseif(!strstr($email, '@') || $email != stripslashes($email) || $email != htmlspecialchars($email)) {
				$msg = $lang['admin_email_invalid'];
				$quit = TRUE;
			}
		} else {
			$msg .= '<li><font color="#FF0000">'.$lang['admin_invalid'].'</font></li>';
			$quit = TRUE;
		}

		if(!$quit){
			install_request(array(),$install_request_error);
			redirect("$installfile?action=install&username=".rawurlencode($username)."&email=".rawurlencode($email)."&password=".md5($password1)."&install_test_data=$install_test_data");
		}
	}

?>
<tr><td align="center">
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273"><td style="color: #FFFFFF; padding-left: 10px" width="32%"><?=$lang['tips_message']?></td></tr>
<tr><td class="message"><?=$msg?></td></tr></table><br />
</td></tr>
<tr><td align="center">
<form method="post" action="<?=$installfile?>" <?=$alert?>>
<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273">
<td style="color: #FFFFFF; padding-left: 10px" colspan="2"><?=$lang['add_admin']?></td>
</tr><tr>
<td class="altbg1" width="20%">&nbsp;<?=$lang['username']?></td>
<td class="altbg2" width="80%">&nbsp;<input type="text" name="username" value="admin" size="30"></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['admin_email']?></td>
<td class="altbg2">&nbsp;<input type="text" name="email" value="name@domain.com" size="30"></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['password']?></td>
<td class="altbg2">&nbsp;<input type="password" name="password1" size="30"></td>
</tr><tr>
<td class="altbg1">&nbsp;<?=$lang['repeat_password']?></td>
<td class="altbg2">&nbsp;<input type="password" name="password2" size="30"></td>
</tr></table><br />

<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273">
<td style="color: #FFFFFF; padding-left: 10px" colspan="2"><?=$lang['setting']?></td>
</tr><tr>
<td class="altbg1" width="20%">&nbsp;<?=$lang['site_name']?></td>
<td class="altbg2" width="80%">&nbsp;<input type="text" name="site_name" value="<?=$config['site_name']?>" size="30"></td>
</tr></table><br>

<table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
<tr bgcolor="#3A4273">
<td style="color: #FFFFFF; padding-left: 10px" colspan="2">附加选项</td>
</tr><tr>
<td class="altbg1" width="20%">&nbsp;安装测试数据？</td>
<td class="altbg2" width="80%">&nbsp;<input type="checkbox" name="install_test_data" value="1" checked /><br>
选择安装测试数据，会让您更快的熟悉和使用天天团购系统</td>
</tr></table><br>

<input type="hidden" name="action" value="admin">
<input type="button" name="submit" value=" <?=$lang['old_step']?> " style="height: 25" onclick="window.location='?action=config'">&nbsp;
<input type="submit" name="submit" value=" <?=$lang['new_step']?> " style="height: 25">
</form></td></tr>
<?php
	instfooter();

} elseif($action == 'install') {
	$username = htmlspecialchars($_GET['username']);
	$email = htmlspecialchars($_GET['email']);
	$password = htmlspecialchars($_GET['password']);
	$install_test_data = (int) $_GET['install_test_data'];

	$db = new dbstuff;
	$db->connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name'], $pconnect);
	$db->select_db($config['db_name']);

	$cron_pushthread_week = rand(1, 7);
	$cron_pushthread_hour = rand(1, 8);

$timestamp=time();

$min = rand(1,29);
$max = $min + rand(1,29);
$timestamp_next = $timestamp + $min + $max + 3600 * rand(1,24);
$invitecode = substr(md5(random(16)),0,16);

$extrasql = <<<EOT
replace into `myth_system_members`(`uid`,`username`,`password`,`email`,`role_id`,`role_type`,`invitecode`) values (1,'$username','$password','$email',2,'admin','{$invitecode}');
replace into `myth_system_memberfields`(`uid`) values('1');
EOT;

?>
<tr><td><b><?=$lang['current_process']?> </b><font color="#0000EE"> <?=$lang['start_install']?></font></td></tr>
<tr><td><hr noshade align="center" width="100%" size="1"></td></tr>
<tr><td align="center"><br />
<script type="text/javascript">
	function showmessage(message) {
		document.getElementById('notice').value += message + "\r\n";
	}
</script>
<textarea name="notice" style="width: 80%; height: 400px" readonly id="notice"></textarea>

<br /><br />
<input type="button" name="submit" value=" <?=$lang['install_in_processed']?> " disabled style="height: 25" onclick="window.location='index.php'" id="laststep"><br /><br />
<br />
</td></tr>
<?php
	instfooter();

	$fp = fopen($sqlfile, 'rb');
	$sqls = fread($fp, filesize($sqlfile));
	fclose($fp);

	runquery($sqls);

	runquery($extrasql);

	if($install_test_data) {
		$fp = fopen($testsqlfile, 'rb');
		$sqls = fread($fp, filesize($testsqlfile));
		fclose($fp);
	
		runquery($sqls);
	}
	
	$timestamp = time();

	dir_clear('./cache');

	@touch($lockfile);
	@touch($installmarkfile);

	echo '<script type="text/javascript">document.getElementById("laststep").disabled = false; </script>'."\r\n";
	echo '<script type="text/javascript">document.getElementById("laststep").value = \''.$lang['install_succeed'].'\'; </script>'."\r\n";
}
?>
