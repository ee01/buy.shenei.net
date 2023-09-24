<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename master.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 

class MasterObject
{
	
	var $Config=array();
	var $Get,$Post,$Files,$Request,$Cookie,$Session;

	
	var $DatabaseHandler;
	
	var $MemberHandler;

	
	var $TemplateHandler;


	
	var $CookieHandler;

	
	var $Title='';
	
	var $MetaKeywords='';
	
	var $MetaDescription='';

	
	var $Position='';
	
	
	var $Module='index';
	
	
	var $Lang=array();

	
	var $Code='';

	function MasterObject(&$config)
	{
		$config['v'] = SYS_VERSION;
				$this->Config=$config;		Obj::register('config',$this->Config);
		
				$this->Get     = &$_GET;
		$this->Post    = &$_POST;
		$this->Cookie  = &$_COOKIE;
		$this->Session = &$_SESSION;
		$this->Request = &$_REQUEST;
		$this->Server  = &$_SERVER;
		$this->Files   = &$_FILES;
		$this->Module = trim($this->Post['mod']?$this->Post['mod']:$this->Get['mod']);
		$this->Code   = trim($this->Post['code']?$this->Post['code']:$this->Get['code']);

		$GLOBALS['iframe'] = '';
		
				require_once LIB_PATH . 'cookie.han.php';
		$this->CookieHandler = new CookieHandler($this->Config, $_COOKIE);
		Obj::register('CookieHandler',$this->CookieHandler);

				$this->TemplateHandler=new TemplateHandler($config);
		Obj::register('TemplateHandler',$this->TemplateHandler);
		
				require_once DB_DRIVER_PATH . 'database.db.php';
		require_once DB_DRIVER_PATH . "mysql.db.php";
		$this->DatabaseHandler = new MySqlHandler($this->Config['db_host'],$this->Config['db_port']);
		$this->DatabaseHandler->Charset($this->Config['charset']);
		$this->DatabaseHandler->doConnect($this->Config['db_user'],$this->Config['db_pass'],$this->Config['db_name'],$this->Config['db_persist']);
		$this->DatabaseHandler->SetCacheHandler($this->CacheHandler);
		Obj::register('DatabaseHandler',$this->DatabaseHandler);
		
				require_once LIB_PATH . 'member.han.php';
		$uid = 0;$password = '';$secques = '';
		if($authcode=$this->CookieHandler->GetVar('auth'))
		{
			list($password,$secques,$uid)=explode("\t",authcode($authcode,'DECODE'));
		}
		$this->MemberHandler=new MemberHandler();
		$this->MemberHandler->FetchMember($uid,$password,$secques);
		if($this->MemberHandler->HasPermission($this->Module,$this->Code)==false)
		{
			$this->Messager($this->MemberHandler->GetError(),null);
		}
		
		$this->Title=$this->MemberHandler->CurrentAction['name'];		Obj::register("MemberHandler",$this->MemberHandler);
		
				$ipbanned=ConfigHandler::get('access','ipbanned');
		if(!empty($ipbanned) && preg_match("~^({$ipbanned})~",$_SERVER['REMOTE_ADDR'])) {
			$this->Messager("您的IP已经被禁止访问。",null);
		}
		unset($ipbanned);
				if(MEMBER_ID<1 && (int)$this->Config['robot']['turnon']==1)
		{
			include_once LOGIC_PATH.'robot.logic.php';
			$RobotLogic=new RobotLogic();
			define("ROBOT_NAME",$RobotLogic->isRobot());
			if(ROBOT_NAME!==false)
			{
								if ($this->Config['robot']['list'][ROBOT_NAME]['disallow']) {
					exit('Access Denied');
				}			
				
				$RobotLogic->statistic();
								if(isset($this->Config['robot']['list'][ROBOT_NAME]['show_ad']) 
				&& (int)$this->Config['robot']['list'][ROBOT_NAME]['show_ad']==0)
				{
					unset($this->Config['ad']);
				}
				include_once LOGIC_PATH.'robot_log.logic.php';
				$RobotLogLogic=new RobotLogLogic(ROBOT_NAME);
				$RobotLogLogic->statistic();				
				unset($RobotLogLogic);
			}			
			unset($RobotLogic);
		}
		unset($this->Config['robot']);
		
				define("FORMHASH",substr(md5(substr(time(), 0, -7).$_SERVER['HTTP_HOST'].$this->Config['auth_key'].$_SERVER['HTTP_USER_AGENT']),0,16));
		if($_SERVER['REQUEST_METHOD']=="POST") {
			if($this->Post["FORMHASH"]!=FORMHASH || strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"])===false) { 
				$this->Messager("请求无效",null); 
			}

		}
		
				@Obj::register('System',$this);

				if(!$this->Config['task_disable'] && ($cronnextrun=ConfigHandler::get('task','nextrun'))!=false)
		{
			$timestamp	=time();
			if($cronnextrun && $cronnextrun <= $timestamp) 
			{
				require_once(LOGIC_PATH.'task.logic.php');
				$TaskLogic=new TaskLogic();
				$TaskLogic->run();
			}
		}
		
	}
	function _test()
	{
		;
		
		exit;
	}

	
	function Messager($message, $redirectto='',$time = -1,$return_msg=false,$js=null)
	{
		global $rewriteHandler;
		if ($time===-1)$time=is_numeric($this->Config['msg_time'])?$this->Config['msg_time']:2;
		if($this->MemberHandler)$this->MemberHandler->SaveActionToLog($this->Title);
		$to_title=($redirectto==='' or $redirectto==-1)?"返回上一页":"跳转到指定页面";
		if($redirectto===null)
		{
			$return_msg=$return_msg===false?"&nbsp;":$return_msg;
		}
		else
		{
			$redirectto=($redirectto!=='')?$redirectto:($from_referer=referer());
			if(str_exists($redirectto,'mod=login','code=register','/login','/register'))
			{
				$referer='&referer='.urlencode('index.php?'.$_SERVER['QUERY_STRING']);
				$this->CookieHandler->Setvar('referer','index.php?'.$_SERVER['QUERY_STRING']);
			}
			if (is_numeric($redirectto)!==false and $redirectto!==0)
			{
				if($time!==null){
					$url_redirect="<script language=\"JavaScript\" type=\"text/javascript\">\r\n";
					$url_redirect.=sprintf("window.setTimeout(\"history.go(%s)\",%s);\r\n",$redirectto,$time*1000);
					$url_redirect.="</script>\r\n";
				}
				$redirectto="javascript:history.go({$redirectto})";
			}
			else
			{
				if($rewriteHandler)
				{
					$redirectto .= $referer;
					if(!$from_referer && !$referer) {
						$redirectto=$rewriteHandler->formatURL($redirectto,true);
					}
				}
				if($message===null)
				{
					$redirectto=rawurldecode(HttpHandler::UnCleanVal(($redirectto)));
					header("Location: $redirectto"); #HEADER跳转
				}
				if($time!==null)
				{
					$url_redirect = $redirectto?'<meta http-equiv="refresh" content="' . $time . '; URL=' . $redirectto . '">':null;
				}
			}
		}
		$title="消息提示:".(is_array($message)?implode(',',$message):$message);

		$title=strip_tags($title);
		if($js!="") {
			$js="<script language=\"JavaScript\" type=\"text/javascript\">{$js}</script>";
		}
		$additional_str = $url_redirect.$js;
		
		include_once $this->TemplateHandler->Template('messager');
		exit;
	}
	
	
	function ShowBody($body)
	{
		echo $body;
	}
	
}
?>