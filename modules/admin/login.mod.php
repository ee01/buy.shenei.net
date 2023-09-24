<?php
/**
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 ��̨��½
 *
 * @author ����<foxis@qq.com>
 * @package www.tttuangou.com
 */

class ModuleObject extends MasterObject
{

	
	var $Username = '';

	
	var $Password = '';
	

	
	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->Username = isset($this->Post['username'])?trim($this->Post['username']):"";
		$this->Password = isset($this->Post['password'])?trim($this->Post['password']):"";

		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		$load_file=array("vivian_reg.css",'validate.js');
		switch($this->Code)
		{
			case 'logout':
				$this->LogOut();
				break;
			case 'dologin':
				$this->DoLogin();
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
		if(MEMBER_ID < 1) 
		{
			$this->Messager("������ǰ̨����<a href='index.php?mod=login'><b>��½</b></a>",null);
		}
		$loginperm = $this->_logincheck();
		if(!$loginperm) {
			$this->Messager("�ۼ� 5 �δ����ԣ�15 �������������ܵ�¼��",null);
		}
		$this->Title="�û���½";
		if ($this->CookieHandler->GetVar('referer')=='')
		{
			$this->CookieHandler->Setvar('referer',referer());
		}
		$action="admin.php?mod=login&code=dologin";

		$question_select=FormHandler::Select('question',ConfigHandler::get('member','question_list'),0);
		$role_type_select=FormHandler::Radio('role_type',ConfigHandler::get('member','role_type_list'),'normal');
		ob_clean();

		include($this->TemplateHandler->Template("admin/login"));
	}


	
	function DoLogin()
	{
		if(MEMBER_ID < 1) 
		{
			$this->Messager("������ǰ̨����<a href='index.php?mod=login'><b>��½</b></a>",null);
		}
		if($this->Username=="" || $this->Password=="")
		{
			$this->Messager("�޷���½,�û��������벻��Ϊ��");
		}
		$check=$this->MemberHandler->CheckMember($this->Username,$this->Password);
		$loginperm = $this->_logincheck();
		if(!$loginperm) {
			$this->Messager("�ۼ� 5 �δ����ԣ�15 �������������ܵ�¼��",null);
		}
		$Auth=false;
		switch($check)
		{

			case -1:
				$this->_loginfailed($loginperm);
				$this->Messager("�޷���½,�û��������,������������ 5 �γ��ԡ�",-1);
				break;
			case 0:
				$this->_loginfailed($loginperm);
				$this->Messager("�޷���½,�û������ڣ������������� 5 �γ��ԡ�",-1);
				break;
			case 1:
				{
					$UserFields=$this->MemberHandler->GetMemberFields();
					$authcode=authcode("{$UserFields['password']}\t{$UserFields['uid']}",'ENCODE',$this->ajhAuthKey);
					$this->CookieHandler->SetVar('ajhAuth',$authcode);
		
					$this->Messager("��½�ɹ������ڽ����̨",'admin.php');
				}
				break;
		}

		$this->Messager('��¼ʧ��',null);
	}

	
	function _updateLoginFields($uid)
	{
		$timestamp=time();
		$last_ip=getenv('REMOTE_ADDR');
		$sql="
		UPDATE
			".TABLE_PREFIX. 'system_members'."
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
		$this->CookieHandler->SetVar('ajhAuth','');
		
		$this->Messager('���Ѿ��ɹ��˳��˺�̨',null);
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