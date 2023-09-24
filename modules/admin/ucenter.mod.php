<?php
/**
 * �ļ����� ucenter.mod.php
 * �汾�ţ� 1.0
 * ����ʱ�䣺 2008��9��19�� 11ʱ32��07��
 * �޸�ʱ�䣺2009��3��21�� 11ʱ45��46��
 * ���ߣ� ����<foxis@qq.com>
 * ���������� ����Ucenter
 */

class ModuleObject extends MasterObject
{

	
	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->Execute();
	}

	
	function Execute()
	{
		switch($this->Code)
		{	
			case 'do_setting':
				$this->DoSetting();
				break;
			
			case 'merge':
				$this->DoMerge();
				break;
			
			default:
				$this->Main();
				break;
		}

	}


	

	function Main()
	{
		if(!is_file(UC_CLIENT_ROOT . './client.php')){
			$this->Messager('Ucenter�Ŀͻ����ļ� <b>' . UC_CLIENT_ROOT . './client.php' . "</b> �����ڣ�����",null);
		}
		if(!is_file(ROOT_PATH . './api/uc.php')){
			$this->Messager('Ucenter��api�ļ� <b>' . UC_CLIENT_ROOT . './client.php' . "</b> �����ڣ�����",null);
		}
				$ucenter = ConfigHandler::get('ucenter');

		
		$uc_enable_radio = FormHandler::YesNoRadio('ucenter[enable]',(bool) $ucenter['enable']);
		
		${"uc_connect_{$ucenter['uc_connect']}_checked"} = " checked ";				
		
		include $this->TemplateHandler->Template('admin/ucenter');
	}
	
	function DoSetting()
	{
		if(!is_file(UC_CLIENT_ROOT . './client.php')) {
			$this->Messager('Ucenter�Ŀͻ����ļ� <b>' . UC_CLIENT_ROOT . './client.php' . "</b> �����ڣ�����");
		}
		if(!is_file(ROOT_PATH . './api/uc.php')) {
			$this->Messager('Ucenter��api�ļ� <b>' . UC_CLIENT_ROOT . './uc.php' . "</b> �����ڣ�����");
		}

		$_POST['ucenter']['uc_charset'] = $_POST['ucenter']['uc_db_charset'] = 'gbk';
		
		if(!$_POST['ucenter']['uc_key']) {
			$this->Messager("����дUcenterͨ����Կ������鿴"."������"."��</b>"."</a>");
		}
		
		if(!$_POST['ucenter']['uc_api']) {
			$this->Messager("����дUcenter��ַ������鿴"."������"."��</b>"."</a>");
		}
		
		if(!$_POST['ucenter']['uc_app_id']) {
			$this->Messager("����д��ǰӦ��ID������鿴"."������"."��</b>"."</a>");
		}
					
		if('������Ucenter�����ݿ�����' == $_POST['ucenter']['uc_db_password']) {
			$ucenter_config = ConfigHandler::get('ucenter');
			$_POST['ucenter']['uc_db_password'] = $ucenter_config['uc_db_password'];
		}
		
		if('mysql' == $_POST['ucenter']['uc_connect'])
		{
			$_POST['ucenter']['uc_db_name'] = "`".trim($_POST['ucenter']['uc_db_name'],'`')."`";
			$_POST['ucenter']['uc_db_table_prefix'] = $_POST['ucenter']['uc_db_name'] . '.' . (false !== ($_tmp_pos = strpos($_POST['ucenter']['uc_db_table_prefix'],'.')) ? substr($_POST['ucenter']['uc_db_table_prefix'],$_tmp_pos + 1) : $_POST['ucenter']['uc_db_table_prefix']);			

			if((@$dl = mysql_connect($_POST['ucenter']['uc_db_host'],$_POST['ucenter']['uc_db_user'],$_POST['ucenter']['uc_db_password'])) && mysql_query("SHOW COLUMNS FROM {$_POST['ucenter']['uc_db_table_prefix']}members",$dl)) {
				;
			} else {
				
				$this->Messager("�޷�����Ucenter���ݿ⣬��������д��Ucenter���ݿ�������Ϣ");
			}
		}
		
		ConfigHandler::set('ucenter',$_POST['ucenter']);
		
		unset($ucenter);
		$ucenter = ConfigHandler::get('ucenter');
				
		if($ucenter['enable'] && 'mysql' == $ucenter['uc_connect']) {
			include_once(UC_CLIENT_ROOT . './lib/db.class.php');
		
			$uc_db = new db();
			@$uc_db->connect($ucenter['uc_db_host'],$ucenter['uc_db_user'],$ucenter['uc_db_password'],$ucenter['uc_db_name'],$ucenter['uc_db_charset'],1,$ucenter['uc_db_table_prefix']);
			
			if(!($uc_db->link) || !($uc_db->query("SHOW COLUMNS FROM {$ucenter['uc_db_table_prefix']}members",'SILENT'))) {
				$ucenter['enable'] = 0;
				ConfigHandler::set('ucenter',$ucenter);
				
				$this->Messager("�޷�����Ucenter���ݿ⣬��������д��Ucenter���ݿ�������Ϣ�Ƿ���ȷ.");
			}
		
			$this->Messager("Ucenter���ñ���ɹ�,������Ѿ������ݿ���й�������,<a href='admin.php?mod=ucenter&code=merge&confirm=1'><b>���˽����û���������</b></a>",null);
		}
		
		$this->Messager("���óɹ�",'admin.php?mod=ucenter');
	}
	
	function DoMerge()
	{
		$start = max(0,(int) $this->Get['start']);
		$limit = 500;		
		
		$ucenter = ConfigHandler::get('ucenter');
		
		if(!$ucenter['enable'] || !$this->Get['confirm'] || 'mysql' != $ucenter['uc_connect'])
		{
			$this->Messager("������ò���ȷ�������Ѿ����й��û�����������",null);
		}
		
		include_once(UC_CLIENT_ROOT . './lib/db.class.php');
		
		$db = new db();
		$db->connect($this->Config['db_host'],$this->Config['db_user'],$this->Config['db_pass'],$this->Config['db_name'],$this->Config['charset'],$this->Config['db_persist'],$this->Config['db_table_prefix']);	
		$query = $db->query("select * from ".TABLE_PREFIX."system_members where ucuid=0 limit {$limit}");
		if($db->num_rows($query) < 1)
		{
			$this->Messager("�û����ݺϲ��ɹ�",null);
		}
		
		$uc_db = new db();
		$uc_db->connect($ucenter['uc_db_host'],$ucenter['uc_db_user'],$ucenter['uc_db_password'],$ucenter['uc_db_name'],$ucenter['uc_db_charset'],1,$ucenter['uc_db_table_prefix']);				
		while ($data = $db->fetch_array($query)) 
		{
			$ucuid = -1;
			$salt = rand(100000, 999999);
			$password = md5($data['password'].$salt);
			$data['username'] = addslashes($data['username']);
			
			$uc_user = $uc_db->fetch_first("SELECT * FROM {$ucenter['uc_db_table_prefix']}members WHERE username='{$data[username]}'"); 			if(!$uc_user) 			{
				$uc_db->query("INSERT LOW_PRIORITY INTO {$ucenter['uc_db_table_prefix']}members SET username='$data[username]', password='$password',email='$data[email]', regip='$data[regip]', regdate='$data[regdate]', salt='$salt'", 'SILENT');				
				$ucuid = $uc_db->insert_id();
				$uc_db->query("INSERT LOW_PRIORITY INTO {$ucenter['uc_db_table_prefix']}memberfields SET uid='$ucuid'",'SILENT');
			}
			else
			{
				if($uc_user['password'] == md5($data['password'].$uc_user['salt'])) 				{
					$ucuid = $uc_user['uid'];
				}
				else 				{
					$uc_db->query("REPLACE INTO {$ucenter['uc_db_table_prefix']}mergemembers SET appid='".UC_APPID."', username='$data[username]'", 'SILENT');
				}
			}

			$db->query("update ".TABLE_PREFIX."system_members set ucuid={$ucuid} where uid={$data['uid']}");
		}		
		
		$next = ($start + $limit);
		$this->Messager("[{$start}-{$next}]���ڽ����û����ݵĺϲ��У����Ժ򡭡�",'admin.php?mod=ucenter&code=merge&confirm=1&start='.$next);	
	}

}

?>