<?php
/**
 * �ļ�����report.mod.php
 * �汾�ţ�1.0
 * ����޸�ʱ�䣺2009��9��28�� 14ʱ10��42��
 * ���ߣ�����<foxis@qq.com>
 * ��������: �ٱ�ģ��
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
			case 'batch_process':
				$this->BatchProcess();
				break;			
			
			default:
				$this->Main();
				break;
		}
	}

	function Main()
	{
		$report_config = ConfigHandler::get('report');
		
		$per_page_num = min(500,max((int) $_GET['per_page_num'],(int) $_GET['pn'],20));
		$where_list = array();
		$query_link = 'admin.php?mod=report';
		
		$keyword = trim($this->Get['keyword']);
		if ($keyword) {
			$_GET['highlight'] = $keyword;

			$where_list['keyword'] = build_like_query('content',$keyword);
			$query_link .= "&keyword=".urlencode($keyword);
		}
		$username = trim($this->Get['username']);
		if ($username) {
			$where_list['username'] = "`username`='{$username}'";
			$query_link .= "&username=".urlencode($username);
		}
		
		$where = $where_list ? " where " . implode(" and ",$where_list) : "";
		
		$sql = " select count(*) as `total_record` from `".TABLE_PREFIX."system_report` {$where} ";
		$query = $this->DatabaseHandler->Query($sql);
		extract($query->GetRow());
		
		$page_arr = page($total_record,$per_page_num,$query_link,array('return'=>'array',),'20 50 100 200,500');		

		$sql = " select * from `".TABLE_PREFIX."system_report` {$where} order by `id` desc {$page_arr['limit']} ";
		$query = $this->DatabaseHandler->Query($sql);
		$report_list = array();
		while ($row = $query->GetRow()) 
		{
			$row['dateline'] = my_date_format2($row['dateline']);			
			$row['type_show'] = $report_config['type_list'][$row['type']];
			$row['reason_show'] = $report_config['reason_list'][$row['reason']];
			
			$row['process_result_show'] = $report_config['process_result_list'][$row['process_result']];
			if($row['process_time']) {
				$row['process_time'] = my_date_format($row['process_time']);
				$row['process_result_show'] = "[{$row['process_time']}]" . $row['process_result_show'];
			}
			
			
			$report_list[] = $row;
		}
		
		
		include($this->TemplateHandler->Template('admin/report'));
	}
	
	function BatchProcess()
	{
		$timestamp = time();
		$process_result = (int) ($this->Post['process_result']);
		$act = (string) ($this->Post['act'] ? $this->Post['act'] : $this->Get['act']);
		$ids = (array) ($this->Post['ids'] ? $this->Post['ids'] : $this->Get['ids']);
		if (!$ids) {
			$this->Messager("��ָ��Ҫ�����Ķ���",-1);
		}
		
		if ('delete' == $act) {
			$sql = "delete from `".TABLE_PREFIX." system_report` where `id` in ('".implode("','",$ids)."')";
			$this->DatabaseHandler->Query($sql);
			
		} elseif ('process' == $act && $process_result>-1) {
			$sql = "update `".TABLE_PREFIX." system_report` set `process_result`='{$process_result}',`process_time`='{$timestamp}' where `id` in ('".implode("','",$ids)."')";
			$this->DatabaseHandler->Query($sql);
			
		} else {
			$this->Messager("��ָ��Ҫִ�еĲ���",-1);
			
		}
		
		$this->Messager("�����ɹ�");
	}
		
}

?>
