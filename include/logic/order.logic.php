<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename order.logic.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


class OrderLogic{	
	var $DatabaseHandler;
	var $Config;
	
	function OrderLogic(){
		$this->DatabaseHandler = &Obj::registry("DatabaseHandler");
		$this->Config = &Obj::registry("config");
	}
	function orderGet($orderid,$uid=''){
		$sql='select * from '.TABLE_PREFIX.'tttuangou_order where orderid='.$orderid.' and status = 1';
		if($uid!='')$sql.=' and userid = '.$uid;
		
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
		return $order;
	}
	function GetOrderId(){
		$id=date('Ymd',time()).str_pad(rand('1','99999'),5,'0',STR_PAD_LEFT);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_order where orderid = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
		if(empty($order)){
			return $id;
		}
		$this->getorderid();
	}
	function GetOrderList($user,$pay=''){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		if($pay==''){
			$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.userid = '.intval($user) .' order by o.buytime desc';
		}else{
			$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.userid = '.intval($user) .' and o.pay='.intval($pay).'  order by o.buytime desc';
		}
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=20;		$page_arr = page($num,$pagenum,$query_link,$_config);
		if($pay==''){
			$sql='SELECT o.*,p.name,p.nowprice,p.earnest,p.otherprice,p.intro,p.img FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.userid = '.intval($user) .' order by o.buytime desc limit  '.($page-1)*$pagenum.','.$pagenum;
		}else{
			$sql='SELECT o.*,p.name,p.nowprice,p.earnest,p.otherprice,p.intro,p.img FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.userid = '.intval($user) .' and o.pay='.intval($pay).'  order by o.buytime desc limit  '.($page-1)*$pagenum.','.$pagenum;
		}
		$query = $this->DatabaseHandler->Query($sql); 
		$order=$query->GetAll();
		foreach ($order as $i => $value){
			$order[$i]['otherprice'] = unserialize($order[$i]['otherprice']);
			
			if($order[$i]['priceradio']) {
				$order[$i]['name2'] = $order[$i]['otherprice'][$value['priceradio']]['name'];
				$order[$i]['price'] = $value['productnum']*$order[$i]['otherprice'][$value['priceradio']]['earnest'];
			}else{
				$order[$i]['name2'] = $order[$i]['name'];
				$order[$i]['price'] = $value['productnum']*$value['earnest'];
			}
			
			$order[$i]['time']=date('Y-m-d',$value['buytime']);
		};
		$order['page_arr']=$page_arr;
		return $order;
	}
	function orderCheck($id){
		$sql='select * from '.TABLE_PREFIX.'tttuangou_order where orderid='.$id.' and status = 1 and pay =0';
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
		return $order;
	}
	function orderGetByUser($productid,$uid){
		$sql='select * from '.TABLE_PREFIX.'tttuangou_order where productid = '.intval($productid).' and userid ='.intval($uid).' and status = 1';
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
		return $order;
	}
	function orderEdit($orderid,$ary=array()){
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_order');
		$result=$this->DatabaseHandler->Update($ary,'orderid='.$orderid);
		return $result;
	}
	function orderCreater($ary=array()){
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_order');
		$result=$this->DatabaseHandler->Insert($ary);
		return $result;
	}
	function orderType($id,$type,$paytime='',$pay=''){
		$ary=array(
			'status'=>$type,
	 	);
		if($paytime!='')$ary['paytime']=time();
		if($pay!=''){
			$ary['pay']=1;
			$sql='update '.TABLE_PREFIX.'tttuangou_product p left join '.TABLE_PREFIX.'tttuangou_order o on p.id=o.productid set p.totalnum = p.totalnum + 1 where o.orderid = '.$id;
			$this->DatabaseHandler->Query($sql);
		}
	 	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_order');
		$result=$this->DatabaseHandler->Update($ary,'orderid='.$id);
		return $result;
	}
	
	function orderPaylist($productid){
		$sql='select o.*,m.username,m.email,p.nowprice,p.earnest,p.otherprice,p.successnum from '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'system_members m on o.userid= m.uid left join '.TABLE_PREFIX.'tttuangou_product p on o.productid=p.id where o.productid = '.intval($productid).' and o.pay = 1';
		$query = $this->DatabaseHandler->Query($sql);
		$orderPayed=$query->GetAll();
		
		foreach($orderPayed as $i => $value){
			$orderPayed[$i]['otherprice'] = unserialize($orderPayed[$i]['otherprice']);
			if($orderPayed[$i]['priceradio']) {
				$orderPayed[$i]['money']=$orderPayed[$i]['otherprice'][$value['priceradio']]['earnest']*$value['productnum'];
			}else{
				$orderPayed[$i]['money']=$value['earnest']*$value['productnum'];
			}
		};
		
		return $orderPayed;
	}
	
	function questionlist(){
		$sql='select `id`,`content` from '.TABLE_PREFIX.'tttuangou_question where reply !="" order by time desc limit 0,6';
		$query = $this->DatabaseHandler->Query($sql);
		$question=$query->GetAll();
		return $question;
	}
	function UpOrder(){
		$sql='update '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id set o.status=2 where '.date('Y-m-d',time()).' > p.overtime and  o.pay = 0 and o.status = 1 and o.userid = '.MEMBER_ID;
		$query = $this->DatabaseHandler->Query($sql);
		return true;
	}
	function GetTicket($id,$seller=0){
		if($seller==0){
			$sql='select t.*,p.name,p.intro,p.nowprice,p.earnest,p.otherprice,s.sellerurl,p.perioddate,s.selleraddress,o.priceradio from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id left join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id left join '.TABLE_PREFIX.'tttuangou_order o on t.orderid = o.orderid where uid = '.MEMBER_ID .' and ticketid = '.intval($id);	
		}else{
			$sql='select t.*,p.name,p.intro,p.nowprice,p.earnest,p.otherprice,s.sellerurl,p.perioddate,s.selleraddress,o.priceradio from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id left join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id left join '.TABLE_PREFIX.'tttuangou_order o on t.orderid = o.orderid where  ticketid = '.intval($id);	
		}
		$query = $this->DatabaseHandler->Query($sql); 
		$ticket=$query->GetRow();
		
		$ticket['otherprice'] = unserialize($ticket['otherprice']);
		if ($ticket['priceradio']) {
			$ticket['name2'] = $ticket['otherprice'][$ticket['priceradio']]['name'];
			$ticket['nowprice'] = $ticket['otherprice'][$ticket['priceradio']]['nowprice'];
			$ticket['earnest'] = $ticket['otherprice'][$ticket['priceradio']]['earnest'];
		}
		
		return $ticket;
	}
}
?>