<?php
/**
 * �ļ�����get_password.mod.php
 * �汾�ţ�1.0
 * ����޸�ʱ�䣺2009��10��27�� 10ʱ05��58��
 * ���ߣ�����<foxis@qq.com>
 * ��������: ȡ������ģ��
 */

class ModuleObject extends MasterObject
{
	

	function ModuleObject($config)
	{
		$this->MasterObject($config);
		
		if (MEMBER_ID>0) {
			}
		
		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();		
		switch ($this->Code) {
			case 'do_send':
				$this->DoSend();
				break;
			case 'do_reset';
				$this->DoReset();
				break;
				
			default:
				$this->Main();
		}				
		$body=ob_get_clean();
		
		$this->ShowBody($body);
	}

	function Main() 
	{
		$act_list = array('base'=>'ȡ������','reset'=>'��������',);
		$act = isset($act_list[$this->Code]) ? $this->Code : 'base';
		$act_name = $act_list[$act];
		
		Load::lib('form');
		$FormHandler = new FormHandler();		
		
		if('base' == $act) {
			
			;	
			
		} elseif ('reset' == $act) {
			
			extract($this->_resetCheck());
						
		}
		
		
		$this->Title = $act_list[$act];
		include($this->TemplateHandler->Template('get_password_main'));
	}
	
	function DoSend()
	{
		$to = $this->Post['to'];
		
		$sql="
		SELECT
			M.uid,MF.authstr,M.email
		FROM
			".TABLE_PREFIX. 'system_members'." M LEFT JOIN ".TABLE_PREFIX.'system_memberfields'." MF ON(M.uid=MF.uid)
		WHERE
			BINARY M.email='{$to}'";
		$query = $this->DatabaseHandler->Query($sql);
		$member=$query->GetRow();
		if ($member==false)$this->Messager("�û��Ѿ�������");
		$timestamp=time();
		if ($member['authstr']!='')
		{
			list($dateline, $operation, $idstring) = explode("\t", $member['authstr']);
			$inteval=600;			if ($dateline+$inteval>$timestamp)
			{
				$this->Messager("�벻Ҫ�ظ����ⷢ�ͣ����������Ѿ����͵����������У��������⣬�������Ա��ϵ��",-1,null);
			}
		}

		$idstring = random(6);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_memberfields');
		$member['authstr']="$timestamp\t1\t$idstring";
		$result=$this->DatabaseHandler->Update($member,"uid={$member['uid']}");
		if ($result==false)
		{
			$this->DatabaseHandler->Insert($member);
		}
		$onlineip=$_SERVER['REMOTE_ADDR'];
				$email_message="{$member['username']}�����ã�
��������� {$this->Config['site_name']} ���͵ġ�
���յ�����ʼ�������Ϊ��{$this->Config['site_name']}����������ַ���Ǽ�Ϊ�û����䣬
�Ҹ��û�����ʹ�� Email �������ù������¡�
----------------------------------------------------------------------
��Ҫ��
----------------------------------------------------------------------
�����û���ύ�������õ��������{$this->Config['site_name']}��ע���û�������������
��ɾ������ʼ���ֻ����ȷ����Ҫ�������������£��ż����Ķ������
���ݡ�
----------------------------------------------------------------------
��������˵��
----------------------------------------------------------------------
��ֻ�����ύ����������֮�ڣ�ͨ�������������������������룺
{$this->Config['site_url']}/index.php?mod=get_password&code=reset&uid={$member['uid']}&id={$idstring}
(������治��������ʽ���뽫��ַ�ֹ�ճ�����������ַ���ٷ���)

�����ҳ��򿪺������µ�������ύ��֮��������ʹ���µ������¼
{$this->Config['site_name']}�ˡ��������ڸ�����������ʱ�޸��������롣

�������ύ�ߵ� IP Ϊ $onlineip
����
{$this->Config['site_name']} �����Ŷ�.
{$this->Config['site_url']}";
			include(LIB_PATH.'mail.han.php');
			$subject="[{$this->Config['site_name']}] ȡ������˵��";
			send_mail($member['email'],$subject,
			$email_message,$this->Config['site_name'],'no-reply@tttuangou.net',
			array(),3,$html=false) ;
		$mail_service=strstr($member['email'], '@');		
		$message=array(
		"����Ϊ\"<b>{$subject}</b>\"���ʼ��Ѿ����͵�����׺Ϊ<b>\"{$mail_service}\"</b>�������У����� 3 ��֮���޸��������롣",
		"�ʼ����Ϳ��ܻ��ӳټ����ӣ������ĵȴ���",
		"�����ʼ��ṩ�̻Ὣ���ʼ����������ʼ���������������Խ��������ҵ����ʼ���",
		);
		$this->Messager($message,null,null);
	}
	
	function DoReset()
	{
		$this->_resetCheck();
		
		$uid=(int)($this->Get['uid']?$this->Get['uid']:$this->Post['uid']);		
		if($this->Post['password']!=$this->Post['confirm'] or $this->Post['password']=='')
		{
			$this->Messager('������������벻һ��,�������벻��Ϊ�ա�',-1,null);
		}
		$password=md5($this->Post['password']);
		$sql="UPDATE ".TABLE_PREFIX. 'system_members'." SET `password`='{$password}' WHERE uid='$uid'";
		$this->DatabaseHandler->Query($sql);
		$sql="UPDATE ".TABLE_PREFIX.'system_memberfields'." SET `authstr`='' WHERE uid='$uid'";
		$this->DatabaseHandler->Query($sql);
		$this->Messager("���������óɹ�,����Ϊ��ת���½����.","?mod=login");
	}
	
	function _resetCheck()
	{
		$uid=(int)($this->Post['uid'] ? $this->Post['uid'] : $this->Get['uid']);
		$id=$this->Post['id'] ? $this->Post['id'] : $this->Get['id'];
		if ($uid<1 or $id=='') $this->Messager("�������",null);

		$sql="
		SELECT
			M.uid,M.username,MF.authstr,M.email,M.secques
		FROM
			".TABLE_PREFIX. 'system_members'." M LEFT JOIN ".TABLE_PREFIX.'system_memberfields'." MF ON(M.uid=MF.uid)
		WHERE
			BINARY M.uid=$uid";
		$query = $this->DatabaseHandler->Query($sql);
		$member=$query->GetRow();
		if ($member==false)$this->Messager("�û��Ѿ�������",null,null);
		$timestamp=time();
		list($dateline, $operation, $idstring) = explode("\t", $member['authstr']);
		if($dateline < $timestamp - 86400 * 3 || $operation != 1 || $idstring != $id) 
		{
			$message=array(
				"������������󲻴��ڻ��Ѿ����ڣ��޷�ȡ�����롣",
				"�����������������룬��<a href='index.php?mod=get_password'>�����˴�</a>��"
			);
			$this->Messager($message,null,null);
		}
		$member['id'] = $id;
		
		return $member;
	}
	
}

?>
