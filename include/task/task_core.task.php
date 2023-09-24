<?php

/**
 * TASK�������
 *
 * @author ����<foxis@qq.com>
 * @package www.tttuangou.net
 */
class TaskCore
{
	var $DatabaseHandler=null;
	
	var $log=array('message'=>'�ѳɹ�ִ��','error'=>0);
	
	function TaskCore()
	{
		$this->DatabaseHandler=&Obj::registry("DatabaseHandler");
	}
	
	function SqlError($sql,$file='',$line='')
	{
		$this->log['message']="<b>SQL��ѯ������</b>".
				"\r\n<br><br>�������:<br>[{$line}]{$file}<code>$sql</code>".
				"\r\n<br><br>������:".$this->DatabaseHandler->GetLastErrorNo().
				"\r\n<br><br>������Ϣ:<br>".$this->DatabaseHandler->GetLastErrorString()."<br>";

		$this->log['error']=E_USER_ERROR;
	}
	
	function log($message,$error=0)
	{
		$this->log['message']=$message;
		$this->log['error']=$error;
	}
	
	function request($url)
	{
		$config=&Obj::registry('config');
		if(strpos($url,':/'.'/')===false) {
			$url=$config['site_url'].'/'.$url;
		}
		
		if ((defined('ROBOT_NAME') && false!==ROBOT_NAME) || 			('remote_script' == $_REQUEST['request_from']) || 			(!$_SERVER['HTTP_USER_AGENT']) || 			(!$_COOKIE)) {
			@dfopen($url,-1,$post,$cookie,true,3);
			@usleep(rand(10000,100000)); 		} else {
			$GLOBALS['iframe'] .="<iframe src='{$url}' border=0 width=0 height=0></iframe>";
		}
	}
}
?>