<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename member.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 


class ModuleObject extends MasterObject
{
	
	var $Config = array(); 	
	
	var $ID;
	

	function ModuleObject(& $config)
	{
		$this->MasterObject($config);
		$this->ID=$this->Post['id']?(int)$this->Post['id']:(int)$this->Get['id'];

		$this->Execute();
	}

	
	function Execute()
	{
		switch ($this->Code)
		{
			
			case 'check_username':
				$this->CheckUsername();
				break;
			case 'check_email':
				$this->CheckEmail();
				break;
									
			default:
				$this->Main();
				break;
		}

	}
	
	
	function Main()
	{
		response_text("正在建设中……");
	}

	
	
	function CheckUsername()
	{
		$username=trim($this->Post['username'] ? $this->Post['username'] : $this->Post['check_value']);
		
		if (strlen($username) < 3 || strlen($username) > 15) {
			response_text("用户名长度请控制在3~15");
		}
		if (($filter_msg = filter($username))) {
			response_text("用户名 ".$filter_msg);
		}
		if (preg_match('~[\~\`\!\@\#\$\%\^\&\*\(\)\=\+\[\{\]\}\;\:\'\"\,\<\.\>\/\?]~',$username)) {
			response_text("用户名不能包含特殊字符");
		}
		$censoruser = ConfigHandler::get('user','forbid');
		$censoruser .= "topic
login
member
profile
tag
get_password
report
weather
master
url";

		$censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($censoruser = trim($censoruser)), '/')).')$/i';
		if($censoruser && @preg_match($censorexp, $username)) {
			response_text("用户名<b>{$username}</b>被保留，禁止注册");
		}
		
		$response= "对不起，您输入的用户名 <B>{$username}</B> 不能注册或已经被他人使用，请选择其他名字后再试。";
		
		$this->DatabaseHandler->SetTable(TABLE_PREFIX. 'system_members');
		$is_exists=$this->DatabaseHandler->Select('',"username='{$username}'");
		
		if($is_exists) {
			response_text($response);
		}
		
		if(true === UCENTER)
		{
			include_once(UC_CLIENT_ROOT . './client.php');
			$uc_result = uc_user_checkname($username);
			
			if($uc_result < 0) {
				response_text($response);
			}
		}
		exit ;
	}
	
	function CheckEmail()
	{
		$email=trim($this->Post['email'] ? $this->Post['email'] : $this->Post['check_value']);
		if (strlen($email) < 5) {
			response_text("请输入正确的Email地址");
		}
		
		$host=strstr($email,'@');
		if (stristr($this->Config["reg_email_forbid"],$host)!==false)
		{
			$response= "由于您邮件服务提供商会过滤本站程序发送的有效邮件，请重新填写一个EMAIL地址。";
			response_text($response);
		}
		include(LIB_PATH."validate.han.php");
		$this->ValidateHandler=new ValidateHandler();
		if ($this->ValidateHandler->IsValid($email,"email")==false)
		{
			$response= "您输入的EMAIL地址格式无效" ;
			response_text($response);
		}

		$response = "对不起，您输入的EMAIL地址 <b>$email</b> 不能注册或已经被他人使用" ;			
		if($this->Config["reg_email_doublee"]!= "1")
		{
		
			$this->DatabaseHandler->SetTable(TABLE_PREFIX. 'system_members');
			$is_exists=$this->DatabaseHandler->Select('',"email='{$email}'");
			if($is_exists!==false) response_text($response);
		}
		
		if(true === UCENTER)
		{
			include_once(UC_CLIENT_ROOT . './client.php');
			
			$uc_result = uc_user_checkemail($email);
			
			if($uc_result < 0) {
				response_text($response);
			}
		}
		exit ;
	}
	
	
}


?>