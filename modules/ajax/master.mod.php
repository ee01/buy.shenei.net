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
	var $Get;
	var $Post;
	var $Cookie;
	var $Session;

	
	var $DatabaseHandler;
	
	var $MemberHandler;

	
	var $TemplateHandler;

	
	var $CookieHandler;


	
	var $Title='';

	
	var $Module='index';

	
	var $Code='';

	function MasterObject(&$config)
	{

		$config['v'] = SYS_VERSION;
		$this->Config=$config;
		

		$this->Get     =  &$_GET;

		$this->Post    =  &$_POST;

		$this->Cookie  =  &$_COOKIE;

		$this->Session =  &$_SESSION;

		$this->Request =  &$_REQUEST;

		$this->Server  = &$_SERVER;

		$this->Files   =   &$_FILES;

		$this->Module = $this->Post['mod']?$this->Post['mod']:$this->Get['mod'];
		$this->Code   = $this->Post['code']?$this->Post['code']:$this->Get['code'];	
		
		$GLOBALS['iframe'] = '';
		
				$ipbanned=ConfigHandler::get('access','ipbanned');
		if(!empty($ipbanned) && preg_match("~^({$ipbanned})~",$_SERVER['REMOTE_ADDR']))
		{
			die("您的IP已经被禁止访问。");
		}
			
		$this->TemplateHandler=new TemplateHandler($config);
		Obj::register('TemplateHandler',$this->TemplateHandler);

		

		$this->CookieHandler = new CookieHandler($this->Config, $_COOKIE);
		
		
		$this->DatabaseHandler = new MySqlHandler($this->Config['db_host'], $this->Config['db_port']);
		$this->DatabaseHandler->doConnect($this->Config['db_user'],
		$this->Config['db_pass'],
		$this->Config['db_name'],
		$this->Config['db_persist']);
		
		Obj::register('DatabaseHandler',$this->DatabaseHandler);
		Obj::register('CookieHandler',$this->CookieHandler);
		Obj::register('config',$this->Config);

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
	
	function initMemberHandler()
	{
		include_once LIB_PATH.'member.han.php';
		list($password,$secques,$uid)=explode("\t",authcode($this->CookieHandler->GetVar('auth'),'DECODE'));
		$this->MemberHandler=new MemberHandler($this);
		$member=$this->MemberHandler->FetchMember($uid,$password,$secques);
		Obj::register("MemberHandler",$this->MemberHandler);
		return $member;
	}

}
?>