<?php 
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename magseller.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 
 


 class ModuleObject extends MasterObject{
	var $city;
	var $config;

	function ModuleObject($config){
		$this->MasterObject($config);		Load::logic('product');
		$this->ProductLogic = new ProductLogic();
		Load::logic('pay');
		$this->PayLogic = new PayLogic();
		Load::logic('me');
		$this->MeLogic = new MeLogic();
		Load::logic('order');
		$this->OrderLogic = new OrderLogic();
		$this -> config =$config;
		$this->MasterObject($config);		$this->ID = (int) ($this->Post['id'] ? $this->Post['id'] : $this->Get['id']);
		$this->CacheConfig = ConfigHandler::get('cache');			$this->ShowConfig = ConfigHandler::get('show');    		$this->Execute();
	}
	
function Execute(){	include_once ROOT_PATH . './setting/constants.php';
	$this -> Title ='商家团购管理';
	if(MEMBER_ID < 1)$this->Messager("您必须先注册或登陆!");
	$this -> config=ConfigHandler::get('product');
	list($this->cityary,$this->city,$this->cityname)=$this->ProductLogic->citychange();
	ob_start();
	switch($this->Code){
		case 'ticket':
			$this->Ticket();
			break;
		case 'sendmail':
			$this->Sendmail();
			break;
		default:
			$this->Main();
			break;
	};
}

function Main(){
	$this->ProductLogic->ProductUp();
	$sql='select p.* from '.TABLE_PREFIX.'tttuangou_product p LEFT JOIN '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id where s.userid = '.MEMBER_ID;
	$query = $this->DatabaseHandler->Query($sql); 
	$product=$query->GetAll();
	include($this->TemplateHandler->Template("seller_manage"));
	}
	
function Ticket(){
	extract($this->Get);
	extract($this->Post);
	$productid=intval($id);
	$p1=$p2=$p3=2;
	$p1=1;
		$sql='select p.name,p.perioddate,p.otherprice,o.priceradio,t.* from '.TABLE_PREFIX.'tttuangou_ticket t left join '.TABLE_PREFIX.'tttuangou_product p on t.productid=p.id left join '.TABLE_PREFIX.'tttuangou_order o on t.orderid=o.orderid where t.productid='.$productid;
	if($use==1){
		$p3=1;
		$p1=2;
		$sql.=' and t.status =0';
	}elseif($use=='0'){
		$p2=1;
		$p1=2;
		$sql.=' and t.status =1';
	}
		$query = $this->DatabaseHandler->Query($sql); 
		$ticket=$query->GetAll();
		
		foreach($ticket as $i => $value){
			$ticket[$i]['otherprice'] = unserialize($ticket[$i]['otherprice']);
			if($ticket[$i]['priceradio']) {
				$ticket[$i]['name2']=$ticket[$i]['otherprice'][$value['priceradio']]['name'];
			}
			$ticket[$i]['pwd']=authcode($ticket[$i]['password'],DECODE,$this->Config['auth_key']);
		};
		
		include($this->TemplateHandler->Template("tttuangou_ticketlist"));
	}
function Sendmail(){
	extract($this->Get);
	$result=$this->MeLogic->SendUseMail($id);
	if($result){
		$this->Messager("您已经成功提醒了该用户！",'?mod=magseller');
	}else{
		$this->Messager("您没有改权限或者团购券不存在！",'?mod=magseller');
	}
}
}


