<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename ajax.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
@set_time_limit(30);
@ini_set("arg_seperator.output", "&amp;");
@set_magic_quotes_runtime(0);
@header('Content-Type: text/html; charset=gbk');
define('ROOT_PATH','./');

if(!$_SERVER['HTTP_USER_AGENT']) {
	exit('Access Denied');
}

if (is_file(ROOT_PATH . 'cache/site_enable.php') && @$site_enable_msg=file_get_contents(ROOT_PATH . 'cache/site_enable.php')) {
	die($site_enable_msg);
}
if(is_file(ROOT_PATH . 'cache/upgrade.lock') && filemtime(ROOT_PATH . 'cache/upgrade.lock')+600>time()) {
	die("系统升级中...");
}
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

define('DEBUG',false);

define('MOD_PATH',ROOT_PATH.'modules/ajax/');
define('IMAGE_PATH',ROOT_PATH.'images/');
define('CACHE_PATH',ROOT_PATH.'cache/');
define('INCLUDE_PATH',ROOT_PATH."include/");
define('DB_DRIVER_PATH',INCLUDE_PATH."db/");
define('LIB_PATH',INCLUDE_PATH."lib/");
define('FUNCTION_PATH',INCLUDE_PATH."function/");
define('LOGIC_PATH',INCLUDE_PATH."logic/");
define('TASK_PATH',INCLUDE_PATH."task/");
define('CONFIG_PATH',ROOT_PATH."setting/");
class initialize
{
	var $Module='';

	
	function init()
	{
		$config=array();
		require_once LIB_PATH . 'config.han.php';
		
		require_once LIB_PATH . 'cookie.han.php';

				require_once(CONFIG_PATH.'settings.php');
		
		require_once CONFIG_PATH . 'constants.php';
		require_once CONFIG_PATH . 'credits.php';
		
		require_once FUNCTION_PATH . 'common.func.php';
		error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
		define('MY_QUERY_ERROR', 10);
		if(function_exists('set_error_handler') && PHP_VERSION< 5)
		{
			set_error_handler('error');
		}
		require_once FUNCTION_PATH . 'cache.func.php';
		require_once FUNCTION_PATH . 'global.func.php';
		require_once INCLUDE_PATH. 'load.php';
		require_once LIB_PATH . 'template.han.php';
		require_once LIB_PATH . 'http.han.php';
		require_once MOD_PATH . 'master.mod.php';
		require_once DB_DRIVER_PATH . 'database.db.php';
		require_once DB_DRIVER_PATH . "{$config['db_type']}.db.php";

		@header("Cache-Control: no-cache, must-revalidate"); 		@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 		
		require_once MOD_PATH.$this->SetEvent($config['default_module']).'.mod.php';
		error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
		$_GET  =HttpHandler::checkVars($_GET);
		$_POST =HttpHandler::checkVars($_POST);
		$_GET  =array_iconv($config['charset'],'UTF-8',$_GET);
		$_POST =array_iconv($config['charset'],'UTF-8',$_POST);
		$moduleobject=new ModuleObject($config);
		
	}

	
	function SetEvent()
	{
		$modss = array('check'=>1,'getseller'=>1,'member'=>1);	
		
		$mod = (isset($_POST['mod']) ? $_POST['mod'] : $_GET['mod']);

		if(!isset($modss)) {
			include(INCLUDE_PATH.'error_404.php');
			exit;
		}
		
		$_POST['mod'] = $_GET['mod'] = $mod;			
		
		Return $mod;
	}
}
$init=new initialize;
$init->init();


?>