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
 * @Date 2010-11-09 11:04:57 $
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

	
	var $Code='';
	
	
	var $ajhAuthKey = '';

	function MasterObject(&$config)
	{
		$config['v'] = SYS_VERSION;
				$this->Config=$config;		Obj::register('config',$this->Config);
		
				$this->ajhAuthKey = $this->Config['auth_key'] . $_SERVER['HTTP_USER_AGENT'] . '_IN_ADMIN_PANEL_' . date('Y-m-Y-m') . '_' . $this->Config['safe_key'];
		
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
		if($authcode=$this->CookieHandler->GetVar('auth'))
		{
			list($password,$secques,$uid)=explode("\t",authcode($authcode,'DECODE'));
		}
		$this->MemberHandler=new MemberHandler();
		$this->MemberHandler->FetchMember($uid,$password,$secques);
		
						$access=ConfigHandler::get('access');
		if(!empty($access['ipbanned']) && preg_match("~^({$access['ipbanned']})~",$_SERVER['REMOTE_ADDR']))
		{
			$this->Messager("您的IP已经被禁止访问",null);
		}
				if(!empty($access['admincp']) && !preg_match("~^({$access['admincp']})~",$_SERVER['REMOTE_ADDR']))
		{
			$this->Messager("您当前的IP在不在后台允许的IP里，无法访问后台。",null);
		}

		
		if(MEMBER_ID<1)
		{
			$this->Messager("您无权进入后台，请先<a href='index.php?mod=login'><b>登陆</b></a>。",null);
		}
		if($this->MemberHandler->HasPermission('index',"",1)==false)
		{
			$this->Messager($this->MemberHandler->GetError(),null);
		}
		if($this->MemberHandler->HasPermission($this->Module,$this->Code,1)==false)
		{
			$this->Messager($this->MemberHandler->GetError(),null);
		}
		
				if(!($this->Config['close_second_verify_enable']) && $this->Module!='login')
		{
			unset($ajhAuth,$_pwd,$_uid);
			if(($ajhAuth = $this->CookieHandler->GetVar('ajhAuth'))) {
				list($_pwd,$_uid) = explode("\t",authcode($ajhAuth,'DECODE',$this->ajhAuthKey));
			}
			if (!$ajhAuth || !$_pwd || $_pwd!=$this->MemberHandler->MemberFields['password'] || $_uid < 1 || $_uid!=MEMBER_ID) {
				$this->Messager(null,'admin.php?mod=login');
			}
		}
		
		$this->Title=$this->MemberHandler->CurrentAction['name'];		Obj::register("MemberHandler",$this->MemberHandler);
		
				define("FORMHASH",substr(md5(substr(time(), 0, -7).$_SERVER['HTTP_USER_AGENT'].$_SERVER['HTTP_HOST'].$this->Config['auth_key'].date('Y-m-d')),0,16));
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			if(($this->Post['FORMHASH']!=FORMHASH || strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])===false)) {
				$this->Messager("请求无效",null);	
			}	
		}

		$this->actionName();
				Obj::register('System',$this);	

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



	
	function Messager($message, $redirectto='',$time = 2,$return_msg=false,$js=null)
	{
		global $rewriteHandler,$__is_messager;
		$__is_messager=true;
		$this->MemberHandler->SaveActionToLog($this->Title);
		$to_title=($redirectto==='' or $redirectto==-1)?"返回上一页":"跳转到指定页面";
		if($redirectto===null)
		{
			$return_msg=$return_msg===false?"&nbsp;":$return_msg;
		}
		else
		{
			$redirectto=($redirectto!=='')?$redirectto:($from_referer=referer());
			if(strpos($redirectto,'mod=login')!==false or strpos($redirectto,'code=register')!==false)
			{
				$referer='&referer='.rawurlencode('index.php?'.$_SERVER['QUERY_STRING']);
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
					if(!$from_referer)$redirectto=$rewriteHandler->formatURL($redirectto,true);
					$redirectto.=($referer?$rewriteHandler->formatQueryString($referer,false):'');
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
		if($js!="")$js="<script language=\"JavaScript\" type=\"text/javascript\">{$js}</script>";
		$this->ShowHeader($title,array(),$url_redirect.$js);
		include_once $this->TemplateHandler->Template('admin/messager');
		$this->ShowFooter();
		exit;
	}
	
	
	function ShowHeader($title,$additional_file_list=array(),$additional_str="",$sub_menu_list=array(),$header_menu_list=array())
	{
		global $__is_messager;
		include($this->TemplateHandler->Template('admin/header'));
	}

	function ShowBody($body)
	{
		echo $body;
	}
	function actionName()
	{
		$action_name=trim($this->Get['action_name']);
		if(!empty($action_name))return $action_name;
		include(CONFIG_PATH.'admin_left_menu.php');
		foreach($menu_list as $_menu_list)
		{
			if(!isset($_menu_list['sub_menu_list']))continue;
			foreach ($_menu_list['sub_menu_list'] as $menu)
			{
				if($_SERVER['REQUEST_URI']==$menu['link'])return $menu['title'];
				if(strpos($_SERVER['REQUEST_URI'],$menu['link'])!==false)
				{
					$action_name=$menu['title'];
				}
			}
		}
		return $action_name;
	}
	function ShowFooter()
	{
		include($this->TemplateHandler->Template('admin/footer'));
	}
}
?>