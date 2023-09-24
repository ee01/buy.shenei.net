<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename upgrade.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


class ModuleObject extends MasterObject
{
	var $server="";
	
	function ModuleObject($config)
	{
		$this->MasterObject($config);
		include_once(LIB_PATH.'io.han.php');
		$this->Execute();
	}
	function Execute()
	{
		switch($this->Code)
		{
			case 'check':
				$this->check();
				break;
			case 'download':
				$this->download();
				break;
			case 'install':
				$this->install();
				break;
			case 'clear_cache':
				$this->clearCache();
			default:
				$this->Main();
				break;
		}
	}
	function Main()
	{
				$dir_list=array("api","backup","cache","errorlog","images","include","install","modules","setting","templates","./",);
		foreach ($dir_list as $dir)
		{
			$path=ROOT_PATH.$dir;
			if(is_writable($path)==false)$this->Messager("{$path}Ŀ¼����д���뽫�����Ըĳ�0777",null);
		}
		
				if(!function_exists("gzinflate"))$this->Messager("���ķ�������֧��GZ��ѹ������ִ��������",null);	
		
		
		$this->Messager("���ڼ���°汾...","admin.php?mod=upgrade&code=check");
	}
	
	
	function check()
	{
		@unlink(CACHE_PATH.'upgrade.lock');		$response=request(array('act'=>'check_upgrade',),$error);
		$this->Messager($response,null);
	}
	
	function download()
	{
		$size=$this->Post['size']?$this->Post['size']:$this->Get['size'];
		$hash=$this->Post['hash']?$this->Post['hash']:$this->Get['hash'];
		$version=$this->Post['version']?$this->Post['version']:$this->Get['version'];
		$build = $this->Post['build']?$this->Post['build']:$this->Get['build'];
		
		if (!$size || !$hash || !$version || !$build)$this->Messager("��������",null);

		$url="admin.php?mod=upgrade&code=download&version={$version}&build={$build}&size={$size}&hash={$hash}";
				if($this->Get['start'])
		{
			$this->Messager("�����������ؽ���...",$url,0);
		}
		
		$tmp_file=ROOT_PATH."./".$version.".zip";
		$tmp_exists=is_file($tmp_file);
		if($tmp_exists)$tmp_md5=md5_file($tmp_file);
		$offset=$tmp_exists?@filesize($tmp_file):0;
		
				if($offset>=$size && $tmp_md5!=$hash)
		{
			@unlink($tmp_file);
			$this->Messager(null,$url);
		}
		
		if($offset==$size && $tmp_md5==$hash)
		{
			$this->Messager("�������Ѿ��ɹ�����,���ڿ�ʼ����...","admin.php?mod=upgrade&code=install&step=check&version={$version}");
		}
		
				$length=rand(102400,102400*2);
		$request=array('act'=>'download_upgrade','version'=>$version,'build'=>$build,'hash'=>$hash,'offset'=>$offset,'length'=>$length);
		$data=request($request,$error);
		if($error)$this->Messager($data,null);
		
				$md5=$data['hash'];
		$data=$data['upgrade_data'];
		if ($md5!=md5($data)) {
			@unlink($tmp_file);
			$this->Messager("��������������ݳ���������������",null);
		}
		
		if(!$data && $tmp_exists==false)$this->Messager("����ʧ�ܣ����Ժ����ԡ�",null);
		
				$fp=fopen($tmp_file,$tmp_exists?"ab":"wb");
		if($fp==false)$this->Messager($tmp_file."�ļ��޷�д��");
		$write_length=fwrite($fp,$data,$length);
		fclose($fp);
		$percent=(number_format($offset/$size,2)*100)."%";
		$this->Messager("����������������������{$percent}",$url,0);

	}
	
	function install()
	{
		@set_time_limit(120);
		$version=$this->Post['version']?$this->Post['version']:$this->Get['version'];
		$step=$this->Get['step'];
		$status=(int)$this->Get['status'];		if(empty($version))$this->Messager("��������");
		$url="admin.php?mod=upgrade&code=install&version=$version";
		
				$upgrade_script="upgrade_to_".$version.".php";
		
				$upgrade_file=ROOT_PATH."./".$version.".zip";
		if (is_file($upgrade_file)==false)$this->Messager("�������Ѿ������ڣ�����������",null);
		include_once(FUNCTION_PATH.'zip.func.php');
		include_once(LIB_PATH.'io.han.php');
		
				if($step=='check')
		{
			$check_url=$url."&step=check";
			if($status===0)$this->Messager("���ڼ��Ŀ¼Ȩ��...",$check_url.'&status=1');
			$unzip=new SimpleUnzip($upgrade_file);
			$i=0;
			$unwrite_list=array();
			while (($file=$unzip->Entries[$i++])!==null)
			{
				$path=ROOT_PATH.$file->Path;
								clearstatcache();
				if(!is_dir($path)) {
					IoHandler::MakeDir($path,0777);
				}
				$new_file=str_replace('/'.'/','/',$path.'/'.$file->Name);
								if(is_file($new_file))
				{
					if(is_writable($new_file)==false)
					{
						$unwrite_list[]=$new_file;
					}
				}
				else
				{
					if(IoHandler::WriteFile($new_file,$file->Data)===false)
					{
						$unwrite_list[$path]=$path;
					}
				}
			}
			if ($unwrite_list) 
			{
				$msg="<b>�����ļ���Ŀ¼�޷�д�룬�����޷�������װ</b>:<br>";
				$msg.=implode("<br>",$unwrite_list);
				$this->Messager($msg,null);
			}
			$backup_url=$url."&step=backup";
			$this->Messager("Ŀ¼Ȩ��ͨ�������ڱ��ݾɵ�Ŀ¼���ļ�...",$backup_url);
		}
		
				if ($step=='backup') 
		{
			$original_path=ROOT_PATH;			$backup_path=ROOT_PATH.'backup/'.SYS_VERSION.'-'.SYS_BUILD.'/';			clearstatcache();
			if(!is_dir($backup_dir)) {
				IoHandler::MakeDir($backup_dir,0777);
			}
			$unzip=new SimpleUnzip($upgrade_file);
			$i=0;
			while (($file=$unzip->Entries[$i++])!==null)
			{
				$original_dir=$original_path.$file->Path;
								$backup_dir=$backup_path.$file->Path;
				clearstatcache();
				if(!is_dir($backup_dir)) {
					IoHandler::MakeDir($backup_dir,0777);
				}				
				
				$original_file=$original_dir.'/'.$file->Name;
				$backup_file=$backup_dir.'/'.$file->Name;
								$unbackup_file_list=array();
				if(is_file($original_file)!=false && filesize($original_file)>0 && copy($original_file,$backup_file)==false)
				{
					$unbackup_file_list[$backup_file]=$original_file;
				}
			}
			if ($unbackup_file_list) 
			{
				$msg="<b>�����ļ���Ŀ¼�޷����ݣ������޷�������װ</b>:<br><ul>";
				foreach ($unbackup_file_list as $backup_file=>$original_file)
				{
					$msg.="<li>".$original_file;
				}
				$msg.="</ul>";
				$this->Messager($msg,null);
			}
			$this->Messager("���ݳɹ������ڰ�װ�°汾...",$url);
		}
		
		@touch(CACHE_PATH.'upgrade.lock');		
		
		$unzip=new SimpleUnzip($upgrade_file);
		$i=0;
		$unwrite_file_list=array();
				while (($file=$unzip->Entries[$i++])!==null)
		{
			$path=ROOT_PATH.$file->Path;
						if(!is_dir($path)) {
				IoHandler::MakeDir($path,0777);
			}
			$new_file=str_replace('/'.'/','/',$path.'/'.$file->Name);
			$file_data = $file->Data;			
	
						@$s=IoHandler::WriteFile($new_file,$file_data);
			if($s===false) {
				$unwrite_file_list[$new_file]=1;
			}
			$name_list[$file->Name]=1;
		}
		if ($unwrite_file_list) 
		{
			$msg="<b>�����ļ���Ŀ¼�޷�д��,�����Ƿ��п�дȨ��</b>:<br><ul>";
			foreach ($unwrite_file_list as $unwrite_file=>$___)
			{
				$msg.="<li>".$unwrite_file;
			}
			$msg.="</ul>";
			$this->Messager($msg,null);
		}

				clearcache();

				if(isset($name_list[$upgrade_script])) {
			$this->Messager(null,$upgrade_script);
		}
		$this->Messager("�°汾��װ�ɹ�,������ջ���...","admin.php?mod=upgrade&code=clear_cache");
	}
	function clearCache()
	{
		clearcache();

		$msg="��������գ�������ɡ�<br>";
		$this->Messager($msg,null);
	}
}
?>