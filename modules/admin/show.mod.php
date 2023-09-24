<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename show.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


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
			case 'modify':
				$this->Main();
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
		$this->Modify();
	}
	
	function Modify()
	{
		$show=ConfigHandler::get('show');
		$cache = ConfigHandler::get('cache');
		$time = ConfigHandler::get('time');
		
		
				$fp=opendir($this->Config['template_root_path']);
		while ($template=readdir($fp)) 
		{
			if($template=='..' || $template=='.' || $template=='.svn' || $template=='_svn')continue;
			if(is_dir($this->Config['template_root_path'].'/'.$template))
			{
				$tpl_name=$template;
				@include($this->Config['template_root_path'].'/'.$template.'/tplinfo.php');
				$template_list[$template]=array("name"=>$tpl_name,"value"=>$template);
				$template_name_list[$template]=$tpl_name;
			}
		}
		array_multisort($template_name_list,SORT_DESC,$template_list);
		$template_select=FormHandler::Select('template_path',$template_list,$this->Config['template_path']);
		
		include($this->TemplateHandler->Template('admin/show'));
	}
	
	function DoModify()
	{
		ConfigHandler::set('show',$this->Post['show']);
		ConfigHandler::set('cache',$this->Post['cache']);
		ConfigHandler::set('time',$this->Post['time']);
		
		clearcache();
		
				if($this->Post['template_path']!="" && 
		$this->Post['template_path']!=$this->Config['template_path'])
		{
			include(CONFIG_PATH.'settings.php');
			$config['template_path']=$this->Post['template_path'];
			ConfigHandler::set($config);
		}
		$this->Messager("���óɹ�");
	}
	
	function cache_time($min=0,$max=0)
	{
		$list = array(
			180 => array('name'=>'������','value'=>'180',),
			300 => array('name'=>'�����','value'=>'300',),
			600 => array('name'=>'ʮ����','value'=>'600',),
			1800 => array('name'=>'��Сʱ','value'=>'1800',),
			3600 => array('name'=>'һСʱ','value'=>'3600',),
			7200 => array('name'=>'��Сʱ','value'=>'7200',),
			14400 => array('name'=>'��Сʱ','value'=>'14400',),
			28800 => array('name'=>'��Сʱ','value'=>'28800',),
			43200 => array('name'=>'(12Сʱ)����','value'=>'43200',),
			86400 => array('name'=>'(24Сʱ)һ��','value'=>'86400',),
			172800 => array('name'=>'(48Сʱ)����','value'=>'172800',),
			345600 => array('name'=>'����','value'=>'345600',),
			604800 => array('name'=>'һ����','value'=>'604800',),
			1209600 => array('name'=>'������','value'=>'1209600',),
			1814400 => array("name"=>"������",'value'=>1814400),
			2592000 => array('name'=>'һ����','value'=>'2592000',),
			5184000 => array('name'=>'������','value'=>'5184000',),
			7776000 => array("name"=>"������",'value'=>7776000),
			15552000 => array('name'=>'(6����)����','value'=>'15552000',),
			31104000 => array('name'=>'(12����)һ��','value'=>'31104000',),
			62208000 => array('name'=>'(24����)����','value'=>'62208000',),
		);
		if(0==$min && 0==$max) return $list;
		
		$_min = min((int) $min,(int) $max);
		$_max = max((int) $min,(int) $max);
		$cache_time = array();
		foreach ($list as $k=>$v) {
			if($k >= $_min && $k <= $_max) {
				$cache_time[$k] = $v;
			}
		}

		return $cache_time;	
	}
}
?>
