<?php
/**
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 ���õĶ�ȡ��д��
 *
 * @author ����<foxis@qq.com>
 * @package www.tttuangou.net
 */
if(!defined('CONFIG_PATH'))define("CONFIG_PATH",'./config/');

class ConfigHandler
{
	function ConfigHandler()
	{
		
	}
	function file($type=null)
	{
		return CONFIG_PATH.($type===null?'settings':$type).'.php';
	}
	
	function get()
	{
		global $_CONFIG;
		$func_num_args=func_num_args();
		if($func_num_args===0)
		{
			Return Obj::registry('config');
		}
		else
		{
			$func_args=func_get_args();
			$type=$func_args[0];
			if(isset($_CONFIG[$type])===false)
			{
				if(!@include(ConfigHandler::file($type)))return null;
				if(isset($config[$type]))
				{
					$_CONFIG[$type]=$config[$type];
				}
				else
				{
					$config=isset(${$type})?${$type}:
					$_CONFIG[$type]=${$type};
				}
			}
	
			if($func_num_args===1)Return $_CONFIG[$type];
	
			foreach($func_args as $arg)
			{
				$path_str.="['$arg']";
			}
			$config=eval('return $_CONFIG'.$path_str.";");
			Return $config;
		}
	}
	
	function set()
	{
		global $_CONFIG;
		$func_num_args=func_num_args();
		$func_args=func_get_args();
		$value=array_pop($func_args);
		$type=array_shift($func_args);
		
		$remark = '/'.'*********************************************
 *[tttuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * tttuangou '.$type.'����
 *
 * @author www.tttuangou.net
 *
 * @time '.date('Y-m-d H:i').'
 *********************************************'.'/
 
 ';

		$file=ConfigHandler::file($type);
		if($type===null)
		{
			$data="<?php \r\n {$remark} \r\n \$config=".var_export($value,true)."; \r\n ?>";
		}
		else
		{
			if(($config=$_CONFIG[$type])===null)
			{
				$config=array();
				@include($file);
				$config=$config[$type];
			}
			foreach($func_args as $arg)
			{
				$path_str.="['$arg']";
			}
			eval($value===null?'unset($config'.$path_str.');':'$config'.$path_str.'=$value;');
			$data="<?php \r\n {$remark} \r\n\$config['$type']=".var_export($config,true).";\r\n?>";
		}

		@$fp=fopen($file,'wb');
		if(!$fp)die($file."�ļ��޷�д��,�����Ƿ��п�дȨ�ޡ�");
		$len=fwrite($fp, $data);
		fclose($fp);

		if($len)$_CONFIG[$type]=$config;
		return $len;
	}
}

?>