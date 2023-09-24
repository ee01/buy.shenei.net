<?php

/**
 * 更新内容
 *
 * @author 狐狸<foxis@qq.com>
 * @package www.tttuangou.net
 */
if (class_exists('TaskCore')==false) {
	include_once(TASK_PATH.'task_core.task.php');
}
class TaskItem extends TaskCore
{
	
	var $num=1;
	
	function TaskItem()
	{
		$this->TaskCore();
	}
	
	function run()
	{

		
				$num=2;
		$sql='select * from '.TABLE_PREFIX.'tttuangou_cron order by addtime ASC limit 0,'.$num;
		$query = $this->DatabaseHandler->Query($sql);
		$mail=$query->GetAll();
		if(empty($mail))return false;
		require("./setting/product.php");
		foreach($mail as $i => $value){
			sendmail($value['username'],$value['address'],$value['title'],$value['content'],$set);
						$sql='delete from '.TABLE_PREFIX.'tttuangou_cron where id = '.$value['id'];
			$this->DatabaseHandler->Query($sql);
		}
	
				$this->log("成功发送邮件到 {$value['address']}");		
	}
	
}
?>