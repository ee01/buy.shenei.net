<?php 
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename index.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 
 


class ModuleObject extends MasterObject{
	var $city;
	var $cityary;
	var $ProductLogic;
	var $PayLogic;
	var $MeLogic;
	var $OrderLogic;
	
function ModuleObject($config){
		$this->MasterObject($config);		Load::logic('product');
		$this->ProductLogic = new ProductLogic();
		Load::logic('pay');
		$this->PayLogic = new PayLogic();
		Load::logic('me');
		$this->MeLogic = new MeLogic();
		Load::logic('order');
		$this->OrderLogic = new OrderLogic();
		$this->ID = (int) ($this->Post['id'] ? $this->Post['id'] : $this->Get['id']);
		$this->CacheConfig = ConfigHandler::get('cache');			$this->ShowConfig = ConfigHandler::get('show');    		$this->Execute();
	}
	
function Execute(){
		$this -> config=ConfigHandler::get('product');
		list($this->cityary,$this->city,$this->cityname)=$this->ProductLogic->citychange();
		ob_start();
		if('buy' == $this->Code) {
			$this->buy();
		} elseif('pay' == $this ->Code){
			$this->Pay();
		}elseif('order' == $this ->Code){
			$this->Order();
		}elseif('doorder' == $this ->Code){
			$this->Doorder();
		}elseif('repay' == $this ->Code){
			$this->Repay();
		}elseif('confirm' == $this ->Code){
			$this->Confirm();
		}elseif('email' == $this ->Code){
			$this->Email();
		}elseif('aboutus'==$this ->Code){
			$this->Aboutus();
		}elseif('privacy'==$this ->Code){
			$this->Privacy();
		}elseif('contat'==$this ->Code){
			$this->Contat();
		}elseif('joinus'==$this ->Code){
			$this->Joinus();
		}elseif('terms'==$this ->Code){
			$this->Terms();
		}elseif('teamwork'==$this ->Code){
			$this->Teamwork();
		}elseif('doteamwork'==$this ->Code){
			$this->Doteamwork();
		}elseif('feedback'==$this ->Code){
			$this->Feedback();
		}elseif('dofeedback'==$this ->Code){
			$this->Dofeedback();
		}else{
			$this->Main();
		};
		$body=ob_get_clean();	
		$this->ShowBody($body);
	}
	
function Email(){
		$this->Title='邮件订阅';
		$city=$this->ProductLogic->getcity();
		$question=$this->OrderLogic->questionlist();
		$action='?mod=list&code=sendemail';
		include($this->TemplateHandler->Template('tttuangou_email'));
	}

function Main(){
		extract($this->Get);
		$type = strtolower($type);
		if($type=='seckills' or $type==1) {
			$type = 1;
			$type_ = 2;
			$TITLE = '秒杀';
			$TITLE_ = '团购';
			$where_type = ' and is_seckill = 1';
			$p1_1='class="current"';
		}elseif($type=='groupbuy' or $type==2) {
			$type = 2;
			$type_ = 1;
			$TITLE = '团购';
			$TITLE_ = '秒杀';
			$where_type = ' and is_seckill = 0';
			$p1_2='class="current"';
		}else{
			$type = 0;
			$TITLE = '团秒';
			$where_type = '';
			$p1='class="current"';
		}
//		$p1='class="current"';
		if($u!=''){
			$this->CookieHandler->setVar('finderid',$u);
			$this->CookieHandler->setVar('findtime',time());
		}
		$question=$this->OrderLogic->questionlist();
		$product = $this->ProductLogic->productNow($this->city,$type);
		if($product==''){
			$this->Title='暂无'.$TITLE;
			$city=$this->ProductLogic->getcity();
			$action='?mod=list&code=sendemail';
			include($this->TemplateHandler->Template('tttuangou_nothing'));
			exit;
		}
		$sellermap=explode(',',$product['sellermap']);
		$this->Title = $product['name'];
		
		if($this->Config['index_meta_keywords']) $this->MetaKeywords = $this->Config['index_meta_keywords'];
		if($this->Config['index_meta_description']) $this->MetaDescription = $this->Config['index_meta_description'];
		
		if($product['is_seckill']==1){
			include($this->TemplateHandler->Template('tttuangou_SecKill'));
		}else{
			include($this->TemplateHandler->Template('tttuangou_index'));
		}
	}
	
function Buy(){
	$this -> Title ='提交订单';
	$p1='class="current"';
	extract($this->Get);
	$editnum=intval($editnum)==''?1:$editnum;
	$nowdate=date('Y-m-d',time());
	if(intval($id)<=0)$this->Messager("产品编号错误!");
	if(MEMBER_ID < 1)$this->Messager("您必须先注册或登陆!");
	
	$self=$this->MeLogic->MemberInfo();
	if(!$self['phone'])$this->Messager("购买之前请先填写好手机号等联系信息!","?mod=me&code=info");
	
	$product = $this->ProductLogic->productCheck(intval($id),$this->city);
	if($product == '')$this->Messager("错误~该产品不存在或已结束团购!");
	if($product['maxnum']!=0){
		$surplusnum=$this->ProductLogic->productNum($product['maxnum'],$product['id']);
		if($surplusnum<=0)$this->Messager("该产品已卖光了，下次请早！");
	};
	
	$product['otherprice'] = unserialize($product['otherprice']);
	$pricenum = count($product['otherprice']);
	
	$action='?mod=index&code=order';
	if($surplusnum=='')$surplusnum=999;
	include($this->TemplateHandler->Template('tttuangou_buy'));
	}
function Order(){
	extract($this->Get);
	extract($this->Post);
	$p1='class="current"';
	$this->Title='订单';
	if(MEMBER_ID < 1)$this->Messager("您必须先注册或登陆!");
	$nowdate=date('Y-m-d',time());
	if($orderid!=''){
		$order=$this->OrderLogic->orderGet($orderid);
		if($order!=''){
			$id = $order['productid'];
			$num = $order['productnum'];
			$priceradio = $order['priceradio'];
 		}else{
 			$this->Messager("错误~无法找到该订单!");
 		};
	};
	$buyed=$this->ProductLogic->productBuyed(intval($id));
	if($buyed)$this->Messager("错误~您已经购买过该产品了!");
	$product=$this->ProductLogic->productCheck(intval($id),$this->city);
	if($product == '')$this->Messager("错误~该产品不存在或产品已结束团购!");
	
	$product['otherprice'] = unserialize($product['otherprice']);
	if(!$num)
		$num = $this->Post['num'.$priceradio];
	if($product['otherprice']) {
		$productname = $product['otherprice'][$priceradio]['name'];
		$productearnest=$product['otherprice'][$priceradio]['earnest'];
	}else{
		$productname = $product['name'];
		$productearnest = $product['earnest'];
	}
	$totalprice=$productearnest * $num;
	
	$action='?mod=index&code=doorder';
	$self=$this->MeLogic->moneyMe();
	if($self['money']>=$totalprice){
		$totalprice2=0;
	}else{
		$totalprice2 = $totalprice - $self['money'];
	};
	$pay=$this->PayLogic->payType(intval($id),$this->city);
	include($this->TemplateHandler->Template('tttuangou_order'));
	}

function Doorder(){
	extract($this->Get);
	extract($this->Post);
	if(MEMBER_ID < 1)$this->Messager("您必须先注册或登陆!");
	if($paytype=='')$this->Messager("您没有选择支付方式!",'?mod=index');
	if($id=='')$this->Messager("您还没有选择商品!",'?mod=index');
	$order=$this->OrderLogic->orderGetByUser($id,MEMBER_ID);
	if($order!=''){
		if($order != '' && $order['pay']==1){
			$this->Messager("您已经购买过该商品了!",'?mod=index');
		}else{
			$ary=array(
			'paytype' => $paytype,
			'productnum' => $num,
			'priceradio' => $priceradio,
			);
			$this->OrderLogic->orderEdit($order['orderid'],$ary);
			$this->Messager("正在为您跳转到付款页面","?mod=index&code=pay&orderid=".$order['orderid']);
		};
	};
	$orderid=$this->OrderLogic->GetOrderId();
	$ary=array(
		'orderid' => $orderid,
		'productid' => $id,
		'productnum' => $num,
		'priceradio' => $priceradio,
		'userid' => MEMBER_ID,
		'buytime' => time(),
		'paytype' => $paytype,
		'pay' => 0,
		'status' => 1
	);
	$result=$this->OrderLogic->orderCreater($ary);
	$this->Messager("正在跳转到付款页面","?mod=index&code=pay&orderid=".$orderid);
}

function Pay(){
	extract($this->Get);
	extract($this->Post);
	$p1='class="current"';
	$this->Title='选择支付方式';
	if(MEMBER_ID < 1)$this->Messager("您必须先注册或登陆!");
	if(intval($orderid)=='')$this->Messager("无法继续付款，无法找到订单!");
	$order=$this->OrderLogic->orderGet($orderid,MEMBER_ID);
	if($order=='')$this->Messager("无法继续付款，无法找到订单!",'?mod=me&code=order');
	$product = $this->ProductLogic->productCheck(intval($order['productid']),$this->city);
	if($product==false)$this->Messager("订单不存在或产品已过期!");
	
	$product['otherprice'] = unserialize($product['otherprice']);
	if($order['priceradio']) {
		$price=$product['otherprice'][$order['priceradio']]['earnest']*$order['productnum'];
	}else{
		$price=$order['productnum']*$product['earnest'];
	}
	
	$self=$this->MeLogic->moneyMe();
	if($self['money']>=$price){
		$this -> Dopay('0',$_GET['orderid'],$msg);
		exit;
	}else{
		$price = $price - $self['money'];
	};
	$pay=$this->PayLogic->payChoose(intval($order['paytype']));
	$pay['orderid']=$order['orderid'];
	$pay['price']=$price;
	$pay['name']=$product['name'];
	if($pay['is_cod']!=1){
			$returnurl = $this->Config['site_url'].'/index.php?mod=index&code=repay';
			$bottom=$this -> Topay($pay['pay_code'],$returnurl,$pay);
	};
	$pay['pay_desc']=nl2br($pay['pay_desc']);
	include($this->TemplateHandler->Template('tttuangou_pay'));
}

function Dopay($price,$orderid){
 	if($price=='' || $orderid==''){
		$this->Messager("首页验证支付失败!");
	};
		if($price>0){
		$pay=$this->MeLogic->moneyAdd(intval($price),MEMBER_ID);
		$ary=array(
				'userid' => MEMBER_ID,
				'type' => 1,
				'name' => '充值账户',
				'intro' => '您为账户充值'.$price.'元',
				'money' => $price,
				'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
	};
	$nowdate=date('Y-m-d',time());
	$order=$this->OrderLogic->orderCheck($orderid);
	if($order == '')$this->Messager("错误~该订单已经支付或不存在!");
	$order=$this->OrderLogic->orderGet($orderid,MEMBER_ID);
	$product=$this->ProductLogic->productCheck($order['productid'],$this->city);
	if($product == '')$this->Messager("错误~该产品不存在或已结束团购!");
	
	if($product['maxnum']!=0){
		$surplusnum=$this->ProductLogic->productNum($product['maxnum'],$product['id']);
		$action='?mod=index&code=order';
		if($surplusnum<=$product['productnum']){
			$this->Messager("该产品被人抢先购买了，您的款项已经返还到个人账户！");
		};
	};
	
	$product['otherprice'] = unserialize($product['otherprice']);
	if($order['priceradio']) {
		$price=$product['otherprice'][$order['priceradio']]['earnest']*$order['productnum'];
	}else{
		$price=$product['earnest']*$order['productnum'];
	}
	
	$result=$this->MeLogic->moneyMe();
	if($price<=$result['money']){
		$result=$this->MeLogic->moneypay($price,MEMBER_ID);
		$this->ProductLogic->AddSellerTotMoney($product['sellerid'],$price);
	}else{
		$this->Messager("您的余额不足，不够支付本次消费！");
	};
	$result=$this->OrderLogic->orderType($orderid,1,1,1);
	$this -> Ticket($orderid);
}

function Repay(){
	$pay_code = !empty($_REQUEST['pay']) ? trim($_REQUEST['pay']) : '';
	include_once('./modules/'.$pay_code.'.pay.php');
	$msg=payRe();
	if(is_array($msg)){
		$this -> Dopay($msg['price'],$msg['orderid']);
	}else{
		$this->Messager($msg);
	};
	exit;
}
function Topay($mod,$returnurl,$pay){
	$payment=unserialize($pay['pay_config']);
	$returnurl.='&pay='.$mod;
	include_once('./modules/'.$mod.'.pay.php');
	$bottom=payTo($payment,$returnurl,$pay);
	return $bottom;
	exit;
}

function Ticket($orderid){
		$sql='SELECT p.name,p.nowprice,p.earnest,p.otherprice,p.id,o.productid,p.successnum,o.orderid,o.productnum,o.priceradio FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.userid = '.MEMBER_ID.' and o.orderid = '.$orderid;
		$query = $this->DatabaseHandler->Query($sql);
		@$order=$query->GetRow();
		if($order=='')$this->Messager("错误，无法找到类似订单！");
		$order['otherprice'] = unserialize($order['otherprice']);
		if ($order['priceradio']) {
			$money=$order['otherprice'][$order['priceradio']]['earnest']*$order['productnum'];
			$nowprice=$order['otherprice'][$order['priceradio']]['nowprice'];
		}else{
			$money=$order['earnest']*$order['productnum'];
			$nowprice=$order['nowprice'];
		}
		$ary=array(
			'userid' => MEMBER_ID,
			'type' => 0,
			'name' => '团购商品',
			'intro' => '购买了商品['.$order['name'].'] 单价：'.$nowprice.'元     一共购买了'.$order['productnum'].'个',
			'money' => $money,
			'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
		$product=$this->ProductLogic->productNow($this->city);
		$num=$product['num'];
		if($num<$order['successnum']){
			$this->Messager('您已经成功团购该产品，但团购差'.($order['successnum']-$num).'人达成 ，快去邀请好友参加团购，还能获得丰厚获取奖励!','?mod=me&code=order');
		}
		if($num==$order['successnum']){
			$orderPayed=$this->OrderLogic->orderPaylist(intval($order['id']));
			foreach($orderPayed as $i => $value){
				$this->ProductLogic->productTypedit($order['productid'],2);
				$ary=array(
				'address'=> $value['email'],
				'username'=>$value['username'],
				'title'=>'团购成功提示信息',
				'content'=>'恭喜您在本站团购的产品('.$order['name'].')在'.date('Y-m-d H:i',time()).'团购成功，请点<a href="'.$this->Config['site_url'].'">这里</a>查看您的团购券！',
				'addtime'=>time()
				);
				$orderPayed=$this->MeLogic->mailCron($ary);
				$this->MeLogic->finder(intval($value['userid']),intval($order['id']));
				for($i=1;$i<=$value['productnum'];$i++){
					$result=$this->MeLogic->ticketCreate($value['userid'],$order['id'],$value['orderid']);
					if($result=='')$i--;
				};
			};
			$this->Messager("团购成功，您还可以推荐您的朋友来购买哦！",'?mod=me');
		};
		$this->MeLogic->finder(MEMBER_ID,intval($order['id']));
		$this->ProductLogic->productTypedit($order['productid'],2);
		for($i=1;$i<=$order['productnum'];$i++){
			$result=$this->MeLogic->ticketCreate(MEMBER_ID,$order['id'],$order['orderid']);
			if($result=='')$i--;
		};
		$this->Messager("团购成功，您还可以推荐您的朋友来购买哦！",'?mod=me');
	}

function Confirm(){
	extract($this->Get);
	if($pwd=='')$this->Messager("错误！");
	$pwd=authcode(urldecode($pwd),'DECODE',$this->Config['auth_key']);
	$sql='select * from '.TABLE_PREFIX.'system_members where truename = \''.$pwd.'\'';
	$query = $this->DatabaseHandler->Query($sql);
	$user=$query->GetRow();
	if($user=='' || $user['checked']==1)$this->Messager("用户不存在或已经通过验证！");
	$ary=array(
		'checked'=>1,
	);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_members');
	$result=$this->DatabaseHandler->Update($ary,'truename = \''.$pwd.'\'');
	$this->Messager("邮箱认证成功！","?");
}
	function Aboutus(){
		$this->Title='关于我们';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_about'));
	}
	function privacy(){
		$this->Title='隐私保护';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_privacy'));
	}
	function Contat(){
		$this->Title='联系我们';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_contact'));
	}
	function Joinus(){
		$this->Title='加入我们';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_join'));
	}
	function Terms(){
		$this->Title='用户协议';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_treaty'));
	}
	function Teamwork(){		$this->Title='商务合作';
		$action='?mod=index&code=doteamwork';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_teamwork'));
	}
	function Doteamwork(){
		if($this->Post['name']==''||$this->Post['phone']==''||$this->Post['content']=='')$this->Messager("缺少必要参数，请正确填写！");
		if($a=filter($this->Post['content']))$this->Messager($a);
		$ary=array(
			'name' => $this->Post['name'],
			'phone'=> $this->Post['phone'],
			'elsecontat'=> $this->Post['elsecontat'],
			'content'=> $this->Post['content'],
			'time'=> time(),
			'type'=> 2,
			'readed'=>0
		);
		$this->MeLogic->UserMsg($ary);
		$this->Messager("我们已经记录下您的合作信息，我们将尽快给您回复！","?");
	}
	function feedback(){		$this->Title='意见反馈';
		$action='?mod=index&code=dofeedback';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template('tttuangou_feedback'));
	}
	function Dofeedback(){
		if($this->Post['name']==''||$this->Post['phone']==''||$this->Post['content']=='')$this->Messager("缺少必要参数，请正确填写！");
		if($a=filter($this->Post['content']))$this->Messager($a);
		$ary=array(
			'name' => $this->Post['name'],
			'phone'=> $this->Post['phone'],
			'elsecontat'=> $this->Post['elsecontat'],
			'content'=> filter($this->Post['content']),
			'time'=> time(),
			'type'=> 1,
			'readed'=>0
		);
		$this->MeLogic->UserMsg($ary);
		$this->Messager("我们已经记录下您的合作信息，我们将尽快给您回复！","?");
	}
}
?>