<?php
/*************************************************************************************************
 * �ļ�����http.han.php
 * �汾�ţ�v 1.0
 * ����޸�ʱ�䣺2005��7��31�� 11:11:53
 * ���ߣ�����<foxis@qq.com>
 * �������������ⲿ�ύ�ı������м���һ����
**************************************************************************************************/
class HttpHandler 
{
	function HttpHandler() 
	{
		
	}
	
	function &CheckVars(&$array,$reserve=false) 
	{
		foreach($array as $key=>$val) 
		{
			if($reserve) return ;
			if($key==false) continue;
			if(is_array($val)==false) 
			{
				$array[$key]=HttpHandler::CleanVal($val);
			}
			else 
			{
				$array[$key]=HttpHandler::CheckVars($val);
			}
		}		

		Return $array;
	}
	
	function CleanVal(&$val) 
	{
				if(MAGIC_QUOTES_GPC==0)$val = addslashes($val);

				Return $val;
	}
	function UnCleanVal(&$val)
	{
		$val=stripslashes($val);

		return $val;
	}
}

#����:

?>