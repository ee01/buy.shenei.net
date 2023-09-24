<?php

/**
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 ��ɫ��������
 *
 * @author ����<foxis@qq.com>
 */
class ModuleObject extends MasterObject
{


	
	var $ID = 0;

	
	var $IDS;

	
	var $ModuleList;

	
	function ModuleObject($config)
	{
		$this->MasterObject($config);

		if(isset($this->Get['id']))
		{
			$this->ID = (int)$this->Get['id'];
		}elseif(isset($this->Post['id']))
		{
			$this->ID = (int)$this->Post['id'];
		}

		$this->Execute();
	}

	
	function Execute()
	{
		switch($this->Code)
		{
			case 'list':
				$this->ListAction();
				break;
			case 'add':
				$this->Add();
				break;
			case 'doadd':
				$this->DoAdd();
				break;

			case 'delete':
				$this->DoDelete();
				break;
			case 'modify':
				$this->Modify();
				break;
			case 'domodify':
				$this->DoModify();
				break;
			default:
				$this->Main();
				break;
		}
	}

	
	function Main()
	{
		$this->ListAction();

	}

	
	function ListAction()
	{
				$sql="SELECT name,module from ".TABLE_PREFIX.'system_role_module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$this->ModuleList[$row['module']]=$row['name'];
		}
		
				$sql="
		SELECT distinct
			module,is_admin
		FROM
			".TABLE_PREFIX.'system_role_action';
		$query = $this->DatabaseHandler->Query($sql);
		while($row=$query->GetRow())
		{
			if($row['is_admin'])
			{
				$admin_module_list[$row['module']]=isset($this->ModuleList[$row['module']])?$this->ModuleList[$row['module']]:$row['module'];
			}
			else
			{
				$module_list[$row['module']]=isset($this->ModuleList[$row['module']])?$this->ModuleList[$row['module']]:$row['module'];
			}

		}
		
				$filter=$this->Get['filter'];

		$filter_list=array
		(
			'credit_require'=>array('name'=>"�л���Ҫ���",'where'=>"credit_require!=''"),
			'credit_update'=>array('name'=>"��Ի��ֽ��в���",'where'=>"credit_update!=''"),
			'message'=>array('name'=>"���Զ�����ʾ��Ϣ",'where'=>"message!=''"),
			'allow_all'=>array('name'=>"ȫ�������",'where'=>"allow_all=1"),
			'disallow_all'=>array('name'=>"����ֹ��",'where'=>"allow_all=-1"),
		);
		if(isset($filter_list[$filter]))
		{
			$where='where '.$filter_list[$filter]['where'];
			$filter_title=$filter_list[$filter]['name'];
		}
		else
		{
			if(
			$filter=='module'
			and (isset($module_list[$this->Get['name']]) or isset($admin_module_list[$this->Get['name']])))
			{
				$where="where module='{$this->Get['name']}'";

				$filter_title="�鿴ģ��&nbsp;<U>{$this->ModuleList[$this->Get['name']]}</U>&nbsp;�Ĳ���";

			}
			else
			{
				$filter_title='�鿴����';
			}

		}
		if(isset($this->Get['is_admin']))
		{
			$is_admin=(int)$this->Get['is_admin'];
			$where.=empty($where)?"where is_admin=$is_admin":"and is_admin=$is_admin";
		}

		$sql="
		SELECT
			*
		FROM
			".TABLE_PREFIX.'system_role_action'."
		$where
		ORDER BY `module` , `is_admin`";
		$query = $this->DatabaseHandler->Query($sql);
		while($row=$query->GetRow())
		{
			$action_list[]=$row;
		}
		
		$action = 'admin.php?mod=role_action&code=batch_modify';
		include $this->TemplateHandler->Template('admin/role_action_list');

	}

	function _makeAllowList()
	{
		$list=array();
		$list[]=array('name'=>"ȫ������",'value'=>'1');
		$list[]=array('name'=>"��ɫ����",'value'=>'0');
		$list[]=array('name'=>"ȫ����ֹ",'value'=>-1);
		Return $list;
	}

	
	function Modify()
	{
		$title="�޸�";
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_role_action');

		$action_info=$this->DatabaseHandler->Select($this->ID);
		if(!$action_info) $this->Messager("��Ҫ�༭�Ķ����Ѿ���������",null);

		$this->FormHandler = new FormHandler;
		$allow_all_radio=$this->FormHandler->Radio('allow_all',$this->_makeAllowList(),$action_info['allow_all']);
		$log_radio=$this->FormHandler->YesNoRadio('log',$action_info['log']);
		$action_type=array("0"=>array("name"=>"ǰ̨Ȩ��","value"=>0),1=>array('name'=>"��̨Ȩ��","1"));
		$action_type_radio=$this->FormHandler->Radio("is_admin",$action_type,$action_info['is_admin']);
				$sql="SELECT name,module as value from ".TABLE_PREFIX.'system_role_module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$module_list[]=$row;
		}
		$module_select=$this->FormHandler->Select('module',$module_list,$action_info['module']);

		preg_match_all("~([a-z0-9]{3,15})>=([\+\-0-9]+)~",$action_info['credit_require'],$require,2);
		foreach($require as $val)
		{
			$require_list[$val[1]]=$val[2];
		}


		preg_match_all("~([a-z0-9]{3,15})([\+\-][0-9]+)~",$action_info['credit_update'],$update,2);
		foreach($update as $val)
		{
			$update_list[$val[1]]=$val[2];
		}
		

				
		
		$sql = "select * from `".TABLE_PREFIX."system_role` order by `type`";
		$query = $this->DatabaseHandler->Query($sql);
		$_tmp_arr = $_tmp_arr_checked = $role_list = array();
		while ($row = $query->GetRow()) 
		{
			$role_list[] = $row;
			
			$_tmp_arr[$row['id']] = array(
				'name' => $row['name'],
				'value' => $row['id'],
			);
			
			if($action_info['allow_all'] > 0 || false!==strpos(",{$row['privilege']},",",{$this->ID},")) {
				$_tmp_arr_checked[$row['id']] = $row['id'];
			}
			if($action_info['allow_all'] < 0) {
				unset($_tmp_arr_checked[$row['id']]);
			}			
		}
		$role_ids_chekbox = $this->FormHandler->Checkbox('role_ids[]',$_tmp_arr,$_tmp_arr_checked);
		
		if ($action_info['allow_all']==-1) {
			$disallow_checked = ' checked ';
		} else {
			${"allow_all_{$action_info['allow_all']}_checked"} = " checked ";
		}
		

		foreach($this->Config as $key=>$val)
		{
			if(strpos($key,'credit')!==false)
			{
				if($val=='')
				{
					$credit=array(
					'name'=>"�û����ֶ�δ����",
					'disabled'=>'disabled',
					'require_value'=>'0',
					'update_value'=>'0');
				}
				else
				{
					$credit=array(
					'name'=>$val,
					'disabled'=>'',
					'require_value'=>$require_list[$key]!=""?$require_list[$key]:0,
					'update_value'=>$update_list[$key]!=""?$update_list[$key]:0);
				}
				$credit_list[$key]=$credit;
			}
		}

		$action="admin.php?mod=role_action&code=domodify";
		include $this->TemplateHandler->Template('admin/role_action_info');
	}

	
	function DoModify()
	{
		$require_list=$update_list=array();
		if($this->Post['update_value']!=false)
		{
			foreach($this->Post['update_value'] as $key=>$val)
			{
				if($val==0)continue;
				$num=(preg_match("~[+-][0-9]+~",$val)==false)?'+'.$val:$val;
				$update_list[]=$key.'='.$key.$num;
			}
			$this->Post['credit_update']=implode(',',$update_list);
		}
	
		if($this->Post['require_value']!=false)
		{
			foreach($this->Post['require_value'] as $key=>$val)
			{
				if($val==0)continue;
								$require_list[]=$key.'>='.ltrim($val,'+-');
			}
			$this->Post['credit_require']=implode(' AND ',$require_list);
		}

		
		$query = $this->DatabaseHandler->Query("select `id`,`privilege` from `".TABLE_PREFIX."system_role`");
		$all_role_ids = array();
		while ($row = $query->GetRow()) 
		{
			$all_role_ids[$row['id']]=$row['privilege'];
		}

		if(1==$this->Post['allow_all']) {
			$this->Post['role_ids'] = array_keys($all_role_ids);
		} elseif (-1==$this->Post['allow_all']) {
			$this->Post['role_ids'] = array();
		}
		
		foreach ($all_role_ids as $role_id=>$role_privilege) {
			$_tmp_arr = explode(',',$role_privilege);
			$role_privilege_list = array();
			foreach ($_tmp_arr as $_tmp_id) {
				$_tmp_id = (int) $_tmp_id;
				if($_tmp_id > 0) {
					$role_privilege_list[$_tmp_id] = $_tmp_id;
				}
			}
			if (@in_array($role_id,$this->Post['role_ids'])) {
				$role_privilege_list[$this->Post['id']] = $this->Post['id'];
			} else {
				unset($role_privilege_list[$this->Post['id']]);
			}
			asort($role_privilege_list);			
			$role_privilege_new = implode(',',$role_privilege_list);
			
			if($role_privilege_new!=$role_privilege) {
				$this->DatabaseHandler->Query("update `".TABLE_PREFIX."role` set `privilege`='{$role_privilege_new}' where `id`='{$role_id}'");
			}
		}
		
		

		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_role_action');

		$result=$this->DatabaseHandler->Update($this->Post);
		if($result!==false)
		{
			cache('role_action/'.$this->Post['module'],0);
			cache('role_action/admin__'.$this->Post['module'],0);
			$this->Messager("�༭�ɹ�");
		}
		else
		{
			$this->Messager("�༭ʧ��");
		}
	}

	
	function Add()
	{
		$title="���";

		$this->FormHandler = new FormHandler;
		$allow_all_radio=$this->FormHandler->Radio('allow_all',$this->_makeAllowList(),0);
		$log_radio=$this->FormHandler->YesNoRadio('log',0);
		$action_type=array("0"=>array("name"=>"ǰ̨Ȩ��","value"=>0),1=>array('name'=>"��̨Ȩ��","1"));
		$action_type_radio=$this->FormHandler->Radio("is_admin",$action_type,0);

				$sql="SELECT name,module as value from ".TABLE_PREFIX.'system_role_module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$module_list[]=$row;
		}
		$module_select=$this->FormHandler->Select('module',$module_list);

		foreach($this->Config as $key=>$val)
		{
			if(strpos($key,'credit')!==false)
			{
				if($val=='')
				{
					$credit=array(
					'name'=>"�û����ֶ�δ����",
					'disabled'=>'disabled',
					'require_value'=>'0',
					'update_value'=>'0');
				}
				else
				{
					$credit=array(
					'name'=>$val,
					'disabled'=>'',
					'require_value'=>$require_list[$key]!=""?$require_list[$key]:0,
					'update_value'=>$update_list[$key]!=""?$update_list[$key]:0);
				}
				$credit_list[$key]=$credit;
			}
		}

		$action="admin.php?mod=role_action&code=doadd";
		include $this->TemplateHandler->Template('admin/role_action_info');
	}

	
	function DoAdd()
	{

		$require_list=$update_list=array();
		if($this->Post['update_value']!=false)
		{
			foreach($this->Post['update_value'] as $key=>$val)
			{
				if($val==0)continue;
				$num=(preg_match("~[+-][0-9]+~",$val)==false)?'+'.$val:$val;
				$update_list[]=$key.'='.$key.$num;
			}
			$this->Post['credit_update']=implode(',',$update_list);
		}
		if($this->Post['require_value']!=false)
		{
			foreach($this->Post['require_value'] as $key=>$val)
			{
				if($val==0)continue;
								$require_list[]=$key.'>='.ltrim($val,'+-');
			}
			$this->Post['credit_require']=implode(' AND ',$require_list);
		}

				
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_role_action');

		$result=$this->DatabaseHandler->Insert($this->Post);
		if($result!=false)
		{
			cache('role_action/'.$this->Post['module'],0);
			cache('role_action/admin__'.$this->Post['module'],0);
			$this->Messager("��ӳɹ�","admin.php?mod=role_action&code=modify&id={$result}");
		}
		else
		{
			$this->Messager("���ʧ��");
		}

	}

	
	function DoDelete()
	{
		$sql="select module from ".TABLE_PREFIX."system_role_action where id=".$this->ID;
		$query = $this->DatabaseHandler->Query($sql);
		$action=$query->GetRow();
		
		if($action==false)$this->Messager("Ȩ���Ѿ�������");
		
		$sql="delete from ".TABLE_PREFIX."system_role_action where id=".$this->ID;
		$query = $this->DatabaseHandler->Query($sql);
		
		cache('role_action/'.$action['module'],0);
		cache('role_action/admin__'.$action['module'],0);
		$this->Messager("ɾ���ɹ�");
	}

}

?>