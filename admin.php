<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename admin.php $
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

if (version_compare( phpversion() , '5.1.0', '>=')){ 
    date_default_timezone_set('PRC'); } else { 
    putenv("tz=WAUST-8WAUDT"); } 
$time_start = microtime_float();

if(is_file('./cache/upgrade.lock') && filemtime('./cache/upgrade.lock')+600>time()) {
	die("系统升级中...");
}
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

define('DEBUG',false);

define('ROOT_PATH','./');
define('MOD_PATH',ROOT_PATH.'modules/admin/');
define('IMAGE_PATH',ROOT_PATH.'images/');
define('CACHE_PATH',ROOT_PATH.'cache/');
define('INCLUDE_PATH',ROOT_PATH."include/");
define('DB_DRIVER_PATH',INCLUDE_PATH."db/");
define('LIB_PATH',INCLUDE_PATH."lib/");
define('FUNCTION_PATH',INCLUDE_PATH."function/");
define('TASK_PATH',INCLUDE_PATH."task/");
define('LOGIC_PATH',INCLUDE_PATH."logic/");
define('CONFIG_PATH',ROOT_PATH."setting/");
class initialize
{
	var $Module='';

	
	function init()
	{
		$config=array();
		error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
		include_once(LIB_PATH.'config.han.php');
				require_once(CONFIG_PATH.'settings.php');

		require_once FUNCTION_PATH . 'common.func.php';
		error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
		define('MY_QUERY_ERROR', 10);
		if(function_exists('set_error_handler') && PHP_VERSION< 5)
		{
			set_error_handler('error');
		}

		require_once CONFIG_PATH . 'constants.php';
		require_once CONFIG_PATH . 'credits.php';

		require_once FUNCTION_PATH . 'cache.func.php';
		require_once FUNCTION_PATH . 'global.func.php';
		require_once INCLUDE_PATH. 'load.php';
		require_once LIB_PATH . 'config.han.php';
		require_once LIB_PATH . 'http.han.php';
		require_once LIB_PATH . 'template.han.php';
		require_once LIB_PATH . 'form.han.php';
		require_once MOD_PATH . 'master.mod.php';

		@header('Content-Type: text/html; charset='.$config['charset']);
		$_GET  =HttpHandler::checkVars($_GET);
		$_POST =HttpHandler::checkVars($_POST);
		require_once MOD_PATH.$this->SetEvent().'.mod.php';
		error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
		$moduleobject=new ModuleObject($config);		
		$moduleobject->MemberHandler->SaveActionToLog($moduleobject->Title);
		
	}

	
	function SetEvent()
	{
		$modss = array ( 'cache' => 1, 'db' => 1, 'index' => 1, 'link' => 1, 'login' => 1, 'member' => 1, 'report' => 1, 'rewrite' => 1, 'robot' => 1, 'role' => 1, 'role_action' => 1, 'role_module' => 1, 'sessions' => 1, 'setting' => 1, 'show' => 1, 'task' => 1, 'tttuangou' => 1, 'ucenter' => 1, 'upgrade' => 1, );
		
		$mod =isset($_GET['mod'])? $_GET['mod']:$_POST['mod'];
		if($mod=="")$mod="index";
		$mod_exists=(isset($modss[$mod]) && is_file(MOD_PATH.$mod.'.mod.php'));
		if($mod_exists==false) {
			include(INCLUDE_PATH.'error_404.php');
			exit;
		}
		$_POST['mod'] = $_GET['mod'] = $mod;
		
		Return $mod;
	}
}
ob_start("my_output");
$init=new initialize;
$init->init();
unset($init);
ob_end_flush();
function my_output(&$buffer,$mode=5)
{

	if(GZIP===true && function_exists('ob_gzhandler') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))$buffer=ob_gzhandler($buffer,$mode);
	return $buffer;
}
function microtime_float()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
?>