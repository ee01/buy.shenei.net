<?php 
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename alipay.pay.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 
 


function payTo($payment,$returnurl,$pay){
		$charset = 'gbk';
//		$service = 'create_partner_trade_by_buyer';	//纯担保交易
//		$service = 'trade_create_by_buyer';	//双功能（担保、即时）
		$service = 'create_direct_pay_by_user';	//即时到账
        $agent = 'C4335319945672464113';

        $parameter = array(
            'agent'             => $agent,
            'service'           => $service,
            'partner'           => $payment['alipay_partner'],
            '_input_charset'    => $charset,            'notify_url'        => "$returnurl",            'return_url'        => "$returnurl",            
            'subject'           => $pay['name'],            'out_trade_no'      => $pay['orderid'],            'price'             => $pay['price'],			'body'				=> $pay['name'],
            'quantity'          => 1,
            'payment_type'      => 1,
            
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            
            'seller_email'      => $payment['alipay_account']
        );
        ksort($parameter);
        reset($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val){
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        };
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        $button = ' <input type="submit" class="formbutton" onclick="window.open(\'https:/'.'/www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="立即支付">';
		return $button;
}

function payRe(){
	$error='';
	if (!empty($_POST)){
		   foreach($_POST as $key => $data){
		   $_GET[$key] = $data;
		   };
		};
	$DatabaseHandler = Obj::registry('DatabaseHandler');
		$sql='select * from '.TABLE_PREFIX.'tttuangou_order where orderid  = '.addslashes($_GET['out_trade_no']).' and userid ='.MEMBER_ID;
	$query = $DatabaseHandler->Query($sql);
	$order=$query->GetRow();
	if($order=='')return "无法继续付款，无法找到订单!";
	if($order['pay']==1)return "请勿重复使用已支付的订单!";
		$sql='select * from '.TABLE_PREFIX.'tttuangou_payment where pay_code   =\''.addslashes($_GET['pay']).'\'';
	$query = $DatabaseHandler->Query($sql);
	$pay=$query->GetRow();
	$payment=unserialize($pay['pay_config']);
	
	ksort($_GET);
	reset($_GET);
	$sign = '';
	foreach ($_GET AS $key=>$val){
		 if ($key != 'sign' && $key != 'sign_type' && $key != 'code' && $key != 'mod' && $key != 'pay' && $val != ""){
		      $sign .= "$key=$val&";
		 };
	};

	$sign = substr($sign, 0, -1) . $payment['alipay_key'];
	if (md5($sign) != $_GET['sign']){
	      return "支付失败!<br/>";
	}
		return $ary=array('price'=> $_GET['total_fee'] ,'orderid'=>$_GET['out_trade_no']);
}

function addmymoney(){
	if (!empty($_POST)){
		foreach($_POST as $key => $data){
		   $_GET[$key] = $data;
		};
	};
		$DatabaseHandler = Obj::registry('DatabaseHandler');
	$sql='select * from '.TABLE_PREFIX.'tttuangou_addmoney where id   =\''.addslashes($_GET['out_trade_no']).'\'';
	$query = $DatabaseHandler->Query($sql);
	$pay=$query->GetRow();
	if(!empty($pay))return '支付失败';
	$sql='select * from '.TABLE_PREFIX.'tttuangou_payment where pay_code   =\''.addslashes($_GET['pay']).'\'';
	$query = $DatabaseHandler->Query($sql);
	$pay=$query->GetRow();
	$payment=unserialize($pay['pay_config']);
	
	ksort($_GET);
	reset($_GET);
	$sign = '';
	foreach ($_GET AS $key=>$val){
		 if ($key != 'sign' && $key != 'sign_type' && $key != 'code' && $key != 'mod' && $key != 'pay'){
		      $sign .= "$key=$val&";
		 };
	};
	$sign = substr($sign, 0, -1) . $payment['alipay_key'];
	if (md5($sign) != $_GET['sign']){
	     return  "支付失败!<br/>";
	}
	return $ary=array('price'=> $_GET['total_fee'] ,'orderid'=>$_GET['out_trade_no']);
}