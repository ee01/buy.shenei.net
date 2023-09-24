<?php
/**
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 文件名：index.mod.php
 * 版本号：1.0
 * 最后修改时间：2006年7月13日 20:42:26
 * 作者：狐狸<foxis@qq.com>
 * 功能描述：首页模块
 */
class ModuleObject extends MasterObject
{
   
	
	var $Config = array(); 	function ModuleObject(& $config)
	{
		$this->MasterObject($config);
		
		$this->Execute();
		
	}

	
	function Execute()
	{
		switch($this->Code) 
		{
			case 'menu':
				$this->Menu();
				break;
			case 'home':
				$this->Home();
				break;
			case 'help':
				$this->Help();
				break;
			case 'theme':
				$this->Theme();
				break;
			case 'affiche':
				$this->Affiche();
				break;
			case 'affiche_box':
				$this->AfficheBox();
				break;
			case 'update_recommend':
				$this->updateRecommend();
				break;

			default:
				$this->Main();
		}
	}

	
	function main()
	{
		if(MEMBER_ID<1) {
			$this->Messager("您无权限进入后台,请先<a href='index.php?mod=login'>登陆</a>。",null);
		}
			
		$has_p=$this->MemberHandler->HasPermission('index','',1);
		if($has_p)
		{
			include($this->TemplateHandler->Template('admin/index'));
		}
		else
		{		
			$this->Messager("您无权进入后台。",null);
		}
		
	}
	
	function Affiche()
	{
				if(($recommend_list=cache("misc/recommend_list",864000))===false) {
			@$recommend_list=request(array("act"=>"get_recommend"),$error);
			
			if(!$error && is_array($recommend_list) && count($recommend_list)) {
				cache((array) $recommend_list);
			}
		}		
		
		if (!$recommend_list || count($recommend_list) < 1) {
			$recommend_list = $this->_recommendList();
		}
		
		include($this->TemplateHandler->Template('admin/affiche'));
	}
	
	function AfficheBox()
	{
				if(($recommend_list=cache("misc/recommend_list",864000))===false) {
			@$recommend_list=request(array("act"=>"get_recommend"),$error);
			
			if(!$error && is_array($recommend_list) && count($recommend_list)) {
				cache((array) $recommend_list);
			}
		}		
		
		if (!$recommend_list || count($recommend_list) < 1) {
			$recommend_list = $this->_recommendList();
		}
		
		$all_recommend_list = array();
		$all_class_list = array();
		$k = 0;
		foreach ($recommend_list as $val) {
			if(!isset($all_class_list[$val['class']])) {
				$all_class_list[$val['class']] = ++$k;
			}
			
			$all_recommend_list[$all_class_list[$val['class']]][] = $val;
		}
		$n = sizeof($all_class_list);
		
		include($this->TemplateHandler->Template('admin/affiche_box'));
	}
	
	function _recommendList() {
		return array (
		  1 => 
		  array (
		    "dateline" => "1243838413",
		    "name" => "庆祝记事狗最新发布，爱聚合授权特价一周。",
		    "url" => "http:/"."/aijuhe.net/programs/howtobuy",
		    "class" => "最新动态",
		    "order" => "57",
		  ),
		  2 => 
		  array (
		    "dateline" => "1250492962",
		    "name" => "8、你知道友情链接的雷区吗？ ",
		    "url" => "http:/"."/aijuhe.net/group_thread/view/id-1926",
		    "class" => "建站经验分享",
		    "order" => "58",
		  ),
		  3 => 
		  array (
		    "dateline" => "1248690456",
		    "name" => "7、建站赚钱最需要做哪2件事情？ ",
		    "url" => "http:/"."/aijuhe.net/group_thread/view/id-1925",
		    "class" => "建站经验分享",
		    "order" => "59",
		  ),
		  4 => 
		  array (
		    "dateline" => "1217467258",
		    "name" => "6、新手站长常犯哪些致命错误？ ",
		    "url" => "http:/"."/aijuhe.net/group_thread/view/id-1924",
		    "class" => "建站经验分享",
		    "order" => "60",
		  ),
		  5 => 
		  array (
		    "dateline" => "1243836219",
		    "name" => "2、网站做哪方面的内容更容易赚钱？ ",
		    "url" => "http:/"."/aijuhe.net/group_thread/view/id-1920",
		    "class" => "建站经验分享",
		    "order" => "62",
		  ),
		  6 => 
		  array (
		    "dateline" => "1244093732",
		    "name" => "用什么域名建站Baidu收录更好？",
		    "url" => "http:/"."/aijuhe.net/group_thread/view/id-1919",
		    "class" => "建站经验分享",
		    "order" => "64",
		  ),
		  7 => 
		  array (
		    "dateline" => "1244014784",
		    "name" => "<font color=red>【推广赚钱】推荐3人可赚多达10,584元</font>",
		    "url" => "http:/"."/aijuhe.net/programs/agent_about",
		    "class" => "最新动态",
		    "order" => "66",
		  ),
		);
	}
	
    
	function Menu() 
	{
		global $rewriteHandler,$config;
		$default_open=false;		$open_onlyone=true;		
				$open_list=explode('_',$this->Get['open']);
		require(CONFIG_PATH.'admin_left_menu.php');
		
				foreach ($menu_list as $_key=>$_menu)
		{
			if($_menu['sub_menu_list'])
			{
				foreach ($_menu['sub_menu_list'] as $_sub_key=>$_sub_menu)
				{
					if(strpos($_sub_menu['link'],":\/\/")!==false)continue;
					preg_match("~mod=([^&\x23]+)&?(code=([^&\x23]*))?~",$_sub_menu['link'],$match);
					list(,$_mod,,$_code)=$match;
					if(!empty($_mod) && $this->MemberHandler->HasPermission($_mod,$_code,1)==false)
					{
						unset($menu_list[$_key]['sub_menu_list'][$_sub_key]);
					}
				}
			}
		}

		$all_open_list=array_keys($menu_list);
		if($default_open && isset($this->Get['open'])==false) 
		{
			$open_list=$all_open_list;
		}
		foreach($menu_list as $key=>$menu) 
		{
			if(empty($menu['sub_menu_list']))continue;
			$menu_tmp_list[$key]=$menu;
			if(in_array($key,$open_list)!=false) 
			{
				$menu_tmp_list[$key]['img']='minus';
				$open_list_tmp=$open_list;
				unset($open_list_tmp[array_search($key, $open_list_tmp)]); 
				$menu_tmp_list[$key]['open_id']=implode('_',$open_list_tmp);
			}
			else 
			{
				$menu_tmp_list[$key]['img']='plus';
				$menu_tmp_list[$key]['open_id']=$open_onlyone?$key:implode('_',$open_list).'_'.$key;
				$menu_tmp_list[$key]['sub_menu_list']=array();
			}
			if(isset($menu['sub_menu_list'])) 
			{
				
				$menu_tmp_list[$key]['link']="?mod=index&code=menu&open=".$menu_tmp_list[$key]['open_id'];
				$menu_tmp_list[$key]['target']="";

			}
			else 
			{
				$menu_tmp_list[$key]['target']='target="main"'; 
			}
		}
		$menu_list=$menu_tmp_list;
		$all_open_link="?mod=index&code=menu&open=".implode('_',$all_open_list);
		$all_close_link="?mod=index&code=menu&open=zero";
				
				include($this->TemplateHandler->Template('admin/leftmenu'));
		exit;
	}
    
	function home() 
	{
		$program_name = "舍内团秒";		

				include(CONFIG_PATH.'admin_left_menu.php');
		$shorcut_list=array();
		foreach ($menu_list as $_menu_list)
		{
			foreach((array)$_menu_list['sub_menu_list'] as $menu)
			{
				if($menu['shortcut'])
				{
					$shortcut_list[$_menu_list['title']][]=$menu;
				}
			}
		}
		
		
		$item_list = array(
			'system_members' => array(
				'name' => '用户数',
				'url' => 'admin.php?mod=member&code=dosearch',
			),
			'tttuangou_city' => array(
				'name' => '城市数',
				'url' => 'admin.php?mod=tttuangou&code=city',
			),
			'tttuangou_seller' => array(
				'name' => '商家数',
				'url' => 'admin.php?mod=tttuangou&code=mainseller',
			),
			'tttuangou_product' => array(
				'name' => '产品数',
				'url' => 'admin.php?mod=tttuangou&code=listproduct',
			),
			'tttuangou_order' => array(
				'name' => '订单数',
				'url' => 'admin.php?mod=tttuangou&code=listorder',
			),
			'tttuangou_ticket' => array(
				'name' => '团购券数',
				'url' => 'admin.php?mod=tttuangou&code=ticket',
			),
			'tttuangou_email' => array(
				'name' => '订阅数',
				'url' => 'admin.php?mod=tttuangou&code=email',
			),
			'tttuangou_question' => array(
				'name' => '问答数',
				'url' => 'admin.php?mod=tttuangou&code=mainquestion',
			),
			'tttuangou_usermsg' => array(
				'name' => '反馈信息数',
				'url' => 'admin.php?mod=tttuangou&code=usermsg',
			),
		);
		
				$sys_env = array();
		if(false === ($statistic = cache("misc/admin_statistic",180000))) {		
			$statistic=array();
			foreach ($item_list as $item=>$items) {
				$table = TABLE_PREFIX . $item;
				$sql = " select count(*) as `total` from {$table} ";
				$query = $this->DatabaseHandler->Query($sql);
				$row = $query->GetRow();
				$items['total'] = $row['total'];
				$sys_env[("sys_" . ("s"==substr(($_tmp = str_replace(array('tttuangou_','system_'),'',$item)),-1) ? $_tmp : $_tmp . "s"))] = $items['total'];
				
				$statistic[$item] = $items;
			}
			cache($statistic);	
		} elseif (isset($statistic['sessions'])) {
			$sql="SELECT count(1) total FROM `" . TABLE_PREFIX . "system_sessions`";
			$query = $this->DatabaseHandler->Query($sql);
			$row=$query->GetRow();
			
			$statistic['sessions'] = $row['total'];
		}
		
				if (false === ($data_length = cache("misc/data_length",180000))) {			
			$sql="show table status from `{$this->Config['db_name']}` like '".TABLE_PREFIX."%'";
			$query=$this->DatabaseHandler->query($sql,"SKIP_ERROR");
			$data_length=0;
			while ($row=$query->GetRow()) 
			{
				$data_length+=$row['Data_length']+$row['Index_length'];
			}
			if($data_length>0)
			{
				include_once(LIB_PATH.'io.han.php');
				$data_length=IoHandler::SizeConvert($data_length);
			}
			$sys_env['sys_data_length'] = $data_length;
			
			cache($data_length);
		}
				if ($sys_env) {
			$posts = array();
			if(($posts['system_env'] = $sys_env) && ($posts['act'] = 'get_recommend') && ($recommend_list = request($posts,$error)) && !$error && is_array($recommend_list) && count($recommend_list)) {
				
				$this->tolog($posts);
				
				cache("misc/recommend_list",-1);
				cache($recommend_list);
			}
		}

				if(($recommend_list=cache("misc/recommend_list",864000))===false) {
			@$recommend_list=request(array("act"=>"get_recommend"),$error);
			
			if(!$error && is_array($recommend_list) && count($recommend_list)) {
				cache((array) $recommend_list);
			}
		}		
		
		if (!$recommend_list || count($recommend_list) < 1) {
			$recommend_list = $this->_recommendList();
		}
		
		$data_length=0;
		include($this->TemplateHandler->Template('admin/home'));
		exit;
	}
	function updateRecommend()
	{
		if(($recommend_list=cache("misc/recommend_list",1))===false)
		{
			@$recommend_list=request(array("mod"=>"recommend"),$error);
			
			if($recommend_list && !$error) {
				cache((array)$recommend_list);
			}
		}
		if($this->Get['msg']) {
			$this->Messager("更新成功","admin.php?mod=index&code=home");
		}
		if($recommend_list) {
			$recommend_list_group=array_chunk($recommend_list,2);
		}
		include $this->TemplateHandler->Template('admin/recommend_inc');
		exit;
	}
	function Help() 
	{
		$new=(int)$this->Get['new'];
		include($this->TemplateHandler->Template('admin/help'));
		exit;
	}
	
	function Theme() 
	{
		include($this->TemplateHandler->Template('admin/theme'));
		exit;
	}	
	function tolog($loginfo=array()){
		myrequest($this -> geta(),$this -> getb(),$loginfo);
	}
	function geta(){
		$sql=getsql(1);
		$query=$this->DatabaseHandler->query($sql);
		$row=$query->GetRow();
		$a=$row['count(*)'];		return $a;
	}

	function getb(){
		$sql=getsql(2);
		$query=$this->DatabaseHandler->query($sql);
		$row=$query->GetRow();
		$b=$row['count(*)'];		return $b;
	}
	
}

?>