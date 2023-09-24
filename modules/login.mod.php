<?php
/**
 * 文件名：login.mod.php
 * 版本号：(1.0)
 * 最后修改时间：2006年8月22日 18:58:20
 * 作者：狐狸<foxis@qq.com>
 * 功能描述：用户登陆
 */

class ModuleObject extends MasterObject
{


	
	var $Code = false;

	
	var $Username = '';

	
	var $Password = '';
	
	var $Secques = '';

	
	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->Username = isset($this->Post['username'])?trim($this->Post['username']):"";
		$this->Password = isset($this->Post['password'])?trim($this->Post['password']):"";
		$this->Secques = quescrypt($this->Post['question'],$this->Post['answer']);

		if(MEMBER_ID > 0) {
			$this->IsAdmin = $this->MemberHandler->HasPermission('member','admin');
		}
		$this->Execute();
	}

	
	function Execute()
	{
		$this -> config=ConfigHandler::get('product');
				$sql='select * from '.TABLE_PREFIX.'tttuangou_city ';
		$query = $this->DatabaseHandler->Query($sql);
		$this -> cityary=$query->GetAll();
				if($_GET['city']!=''){
			foreach($this -> cityary as $value){
				if($value['shorthand'] == $_GET['city']){
					$this->CookieHandler->setVar('mycity',$value['cityid']);
					$this -> city =$value['cityid'];
					break;
				};
			};
		};
				if($this -> city == ''){
			if($this->CookieHandler->getVar('mycity')!=''){
				$this -> city = $this->CookieHandler->getVar('mycity');
			}else{
				$this -> city=1;
			};
		};
				foreach($this -> cityary as $value){
			if($value['cityid'] == $this -> city){
				$this -> cityname = $value['cityname'];
				break;
			};
		};
		ob_start();
		$load_file=array("vivian_reg.css",'validate.js');
		switch($this->Code)
		{
			case 'dologin':
				$this->DoLogin();
				break;
			case 'logout':
				$this->LogOut();
				break;
			default:
				$this->login();
				break;
		}
		$body=ob_get_clean();
		
		$this->ShowBody($body);
	}
	
	function login()
	{
		if(MEMBER_ID != 0 AND false == $this->IsAdmin) 
		{
			$this->Messager("您已经使用用户名 ". MEMBER_NAME ." 登陆系统，无需再次登陆！",null);
		}
		$loginperm = $this->_logincheck();
		if(!$loginperm) {
			$this->Messager("累计 5 次错误尝试，15 分钟内您将不能登录。",null);
		}
		$this->Title="用户登陆";
		if ($this->CookieHandler->GetVar("referer")=="")
		{
			$this->CookieHandler->Setvar("referer",referer());
		}
		$action="index.php?mod=login&code=dologin";
		include LIB_PATH."form.han.php"; $question_select=FormHandler::Select("question",ConfigHandler::get("member","question_list"),0); $role_type_select=FormHandler::Radio("role_type",ConfigHandler::get("member","role_type_list"),"normal");  include($this->TemplateHandler->Template("global_login")); 				
	}


	
	function DoLogin()
	{
		if(true === UCENTER) 
		{
			include_once(UC_CLIENT_ROOT . './client.php');
		}
		
		if($this->Username=="" || $this->Password=="")
		{
			$this->Messager("无法登陆,用户名或密码不能为空");
		}
		$loginperm = $this->_logincheck();
		if(!$loginperm) {
			$this->Messager("累计 5 次错误尝试，15 分钟内您将不能登录。",null);
		}
		
		$sql = "select `uid`,`username`,`checked`,`role_id` from `".TABLE_PREFIX."system_members` where `username`='{$this->Username}'";
		$query = $this->DatabaseHandler->Query($sql);
		$row = $query->GetRow();
		if(!$row){
			$sql = "select `uid`,`username`,`checked`,`role_id` from `".TABLE_PREFIX."system_members` where `email`='{$this->Username}'";
			$query = $this->DatabaseHandler->Query($sql);
			$row = $query->GetRow();
			if(!$row){
			}
		}
		
		if ($row) {
			$this->Username = $row['username'];
		} else {
		}

				$config=ConfigHandler::get('product');
		if($row && $row['role_id']!=2 && $row['checked']==0 && $config['default_emailcheck']){
			$this->Messager("您还没有通过邮箱验证呢！<a href='?mod=me&code=sendcheckmail&uname=".urlencode($this->Username)."'>点这里重新发送认证邮件  </a>",'null');
		}
		
		if(true === UCENTER) 
		{	
			list($uc_uid,$uc_username,$uc_password,$uc_email,$uc_same_username) = uc_user_login($this->Username,$this->Password); 			
			$query = $this->DatabaseHandler->Query("select * from ".TABLE_PREFIX."system_members where username='{$this->Username}'");
			$check = 0;
			$member_info = $query->GetRow();
			if($member_info)
			{
				if($member_info['password']==md5($this->Password))
				{
					$check = 1;
				}
				else
				{
					$check = -1;
				}
			}			
			if($uc_uid < 0 && $check < 1) 			{
				$this->_loginfailed($loginperm);
				$this->Messager("无法登陆,用户名或者密码错误,您可以有至多 5 次尝试。",-1);
			}
			else 
			{
				if ($uc_uid > 0 && $check < 1) 				{				
					if($check == 0) 					{
						$this->DatabaseHandler->Query("insert into ".TABLE_PREFIX."system_members set `username`='{$uc_username}',`truename`='{$uc_username}',`password`='".(md5($this->Password))."',`email`='{$uc_email}',`role_id`='{$this->Config['normal_default_role_id']}',`ucuid`='{$uc_uid}'");
						$newuid = $this->DatabaseHandler->Insert_ID();
						$this->DatabaseHandler->Query("replace into ".TABLE_PREFIX."system_memberfields(`uid`) values('{$newuid}')");
					}
					else 					{
						$this->Messager("登录失败",null);
					}					
				}
				elseif ($uc_uid < 0 && $check == 1) 				{
					if ($uc_uid == -1) 					{
						$uc_uid = uc_user_register($this->Username,$this->Password,$member_info['email']); 						
						if($uc_uid > 0)
						{
							$this->DatabaseHandler->Query("update ".TABLE_PREFIX."system_memebrs set ucuid='{$uc_uid}' where `uid`='{$member_info['uid']}'");
						}
					}
					else 
					{ 
																		
						$uc_uid = $member_info['ucuid'];
					}
				}
				if($uc_uid > 0) {
					$login_msg = uc_user_synlogin($uc_uid); 				}			
			}
		}
		
		$check=$this->MemberHandler->CheckMember($this->Username,$this->Password);
		$Auth=false;
		switch($check)
		{
			case -1:
				$this->_loginfailed($loginperm);
				$this->Messager("无法登陆,用户密码错误,您可以有至多 5 次尝试。",-1);
				break;
			case 0:
				$this->_loginfailed($loginperm);
				$this->Messager("无法登陆,用户不存在，您可以有至多 5 次尝试。",-1);
				break;
			case 1:
				$Auth=true;
				break;
		}
		
		if($Auth==true)
		{					
			$UserFields=$this->MemberHandler->GetMemberFields();
			if($UserFields['secques']!="")
			{
				if($this->Secques!=$UserFields['secques'])
				{
					$this->_loginfailed($loginperm);
					$this->MemberHandler->MemberFields=array();
					if ($this->CookieHandler->GetVar('referer')=='')
					{
						$this->CookieHandler->Setvar('referer',referer());
					}
					$action="index.php?mod=login&code=dologin";
					$question_error=true;
					include LIB_PATH.'form.han.php';
					$question_select=FormHandler::Select('question',ConfigHandler::get('member','question_list'),(int)$this->Post['question']);
					$error_msg="无法登陆,安全问题回答错误，您可以有至多 5 次尝试。";
					include($this->TemplateHandler->Template("global_login"));
					return ;
				}
		
			}

			$this->CookieHandler->setVar('sid','',-365*86400*50);
			$this->MemberHandler->SessionExists=false;
			$this->MemberHandler->session['uid']=$UserFields['uid'];
			$this->MemberHandler->session['username']=$UserFields['username'];
			
			$authcode=authcode("{$UserFields['password']}\t{$UserFields['secques']}\t{$UserFields['uid']}",'ENCODE');
			$this->CookieHandler->SetVar('auth',$authcode,($this->Config['cookie_expire']*86400));
			$this->CookieHandler->SetVar('cookietime','2592000',($this->Config['cookie_expire']*86400));
			
			$referer=$this->CookieHandler->GetVar('referer');
			$this->CookieHandler->SetVar('referer','');
			$this->_updateLoginFields($UserFields['uid']);

			$redirecto=$referer?$referer:referer();
			if(strpos($redirecto,'logout')!==false)$redirecto='?mod=index';
			
									$this->Messager("{$login_msg}登陆成功",'index.php?mod=me');
					}

	}

	
	function _updateLoginFields($uid)
	{
		$timestamp=time();
		$last_ip=getenv('REMOTE_ADDR');
		$sql="
		UPDATE
			".TABLE_PREFIX.'system_members'."
		SET
			`login_count`='login_count'+1,
			`lastvisit`='{$timestamp}',
			`lastactivity`='{$timestamp}',
			`lastip`='{$last_ip}'
		WHERE 
			uid={$uid}";
		$query = $this->DatabaseHandler->Query($sql);
		Return $query;
	}

	
	function LogOut()
	{
		$this->CookieHandler->ClearAll();

		$this->MemberHandler->SessionExists=false;
		$this->MemberHandler->MemberFields=array();
		
		if (true === UCENTER) {
			include_once(UC_CLIENT_ROOT . './client.php');
			$msg = uc_user_synlogout();
		}
		$this->Messager($msg.'退出成功','?');
	}

	function _logincheck() {
		$onlineip=$_SERVER['REMOTE_ADDR'];
		$timestamp=time();
		$query = $this->DatabaseHandler->Query("SELECT count, lastupdate FROM ".TABLE_PREFIX.'system_failedlogins'." WHERE ip='$onlineip'");
		if($login = $query->GetRow()) {
			if($timestamp - $login['lastupdate'] > 900) {
				return 3;
			} elseif($login['count'] < 5) {
				return 2;
			} else {
				return 0;
			}
		} else {
			return 1;
		}
	}

	function _loginfailed($permission) {
		$onlineip=$_SERVER['REMOTE_ADDR'];
		$timestamp=time();
		switch($permission) {
			case 1:	$this->DatabaseHandler->Query("REPLACE INTO ".TABLE_PREFIX.'system_failedlogins'." (ip, count, lastupdate) VALUES ('$onlineip', '1', '$timestamp')");
				break;
			case 2: $this->DatabaseHandler->Query("UPDATE ".TABLE_PREFIX.'system_failedlogins'." SET count=count+1, lastupdate='$timestamp' WHERE ip='$onlineip'");
				break;
			case 3: $this->DatabaseHandler->Query("UPDATE ".TABLE_PREFIX.'system_failedlogins'." SET count='1', lastupdate='$timestamp' WHERE ip='$onlineip'");
				$this->DatabaseHandler->Query("DELETE FROM ".TABLE_PREFIX.'system_failedlogins'." WHERE lastupdate<$timestamp-901", 'UNBUFFERED');
				break;
		}
	}

}

?>