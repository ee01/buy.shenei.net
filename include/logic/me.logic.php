<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename me.logic.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


class MeLogic{	
	var $DatabaseHandler;
	var $Config;
	
	function MeLogic(){
		$this->CookieHandler = &Obj::registry("CookieHandler");
		$this->DatabaseHandler = &Obj::registry("DatabaseHandler");
		$this->Config = &Obj::registry("config");
	}
	function MemberInfo($uid=''){
		if($uid=='')$uid=MEMBER_ID;
		$sql='select * from '.TABLE_PREFIX.'system_members where uid = '.$uid;
		$query = $this->DatabaseHandler->Query($sql);
		$self=$query->GetRow();
		return $self;
	}
	function moneyMe($uid=''){
		if($uid=='')$uid=MEMBER_ID;
		$sql='select money  from '.TABLE_PREFIX.'system_members where uid = '.$uid;
		$query = $this->DatabaseHandler->Query($sql);
		$self=$query->GetRow();
		return $self;
	}
	function moneyAdd($money,$user){
		$sql='update '.TABLE_PREFIX.'system_members set money = money + '.intval($money).' where uid = '.intval($user);
		$query = $this->DatabaseHandler->Query($sql);
		if($query!=''){
			return false;
		}else{
			return true;
		}
	}
	function moneypay($money,$user){
	$sql='update '.TABLE_PREFIX.'system_members set money = money - '.intval($money).' , totalpay = totalpay + '.intval($money).' where uid = '.intval($user);
	$query = $this->DatabaseHandler->Query($sql);
		if($query!=''){
			return false;
		}else{
			return true;
		}
	}
	function moneyLog($ary){
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_usermoney');
		$result=$this->DatabaseHandler->Insert($ary);
		return $result;
	}
	function ShowMoneyLog($user){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) from '.TABLE_PREFIX.'tttuangou_usermoney where userid = '.intval($user);
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=20;		$page_arr = page($num,$pagenum,$query_link,$_config);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_usermoney where userid = '.intval($user).' order by `mid` desc limit  '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$moneylog=$query->GetAll();
		$moneylog['page_arr']=$page_arr;
		return $moneylog;
	}
	function mailCron($ary){
		$keys=$values='';
		foreach($ary as $i => $valuez){
			$a=$i=='addtime'?"":',';
			$keys.='`'.$i.'`'.$a;
			$values.='\''.$valuez.'\''.$a;
		}
		$sql='insert into '.TABLE_PREFIX.'tttuangou_cron ('.$keys.') VALUES ('.$values.')';
		$this->DatabaseHandler->Query($sql);
	}
	function finder($uid,$productid){
		$sql='select finder,findtime from '.TABLE_PREFIX.'system_members where uid = '.intval($uid);
		$query = $this->DatabaseHandler->Query($sql); 
		$finder=$query->GetRow();
		if($finder!='' && $finder['findtime']+ (72*3600) > time()){
			$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_ticket where uid = '.intval($uid);
			$query = $this->DatabaseHandler->Query($sql); 
			$ticket=$query->GetRow();
			if($ticket['count(*)']==0){
				$ary=array(
					'buyid' => $uid,
					'buytime' => time(),
					'productid' =>  $productid,
					'finderid'=> $finder['finder'],
					'findtime'=> $finder['findtime'],
				);
				$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_finder');
				$result=$this->DatabaseHandler->Insert($ary);
				return true;
			};
		};
		return true;
	}
	
	function ticketCreate($userid,$productid,$orderid){
		$ticketNumber=$orderid.rand('100','999');
		$ticketPassword=rand('100000','999999');
		$ary=array(
			'uid'=> $userid,
			'productid'=>$productid,
			'orderid'=>$orderid,
			'number'=>$ticketNumber,
			'password'=>authcode($ticketPassword,ENCODE,$this->Config['auth_key']),			'status'=> 1
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_ticket');
		$result=$this->DatabaseHandler->Insert($ary);
		return true;
	}
	
	function mail($address,$city,$type){
		if(!check_email($address))return false;
		if($type==0){
			$sql='delete from '.TABLE_PREFIX.'tttuangou_email where email=\''.$address.'\'';
			$query = $this->DatabaseHandler->Query($sql); 
		}else{
			if($city==''){
				Load::logic('product');
				$this->ProductLogic = new ProductLogic();
				list(,$city,)=$this->ProductLogic->citychange();
			};
			$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_email where email = \''.$address.'\'';
			$query = $this->DatabaseHandler->Query($sql); 
			$result=$query->GetRow();
		
			$ary=array(
			'email' => $address,
			'city'  => $city,
			'time' => date('Y-m-d',time()),
			);
			$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_email');
			if($result['count(*)']==0){
				$result=$this->DatabaseHandler->Insert($ary);
			}else{
				$result=$this->DatabaseHandler->Update($ary,' email = \''.$address.'\'');
			}
		}
	}
	function ticketMy($type=''){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		if($type!=''){
			$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id  where uid = '.MEMBER_ID .' and display = 1 and t.`status` = '.intval($type);
		}else{
			$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id  where  uid = '.MEMBER_ID.' and display = 1 ';	
		};
		$query = $this->DatabaseHandler->Query($sql);
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=20;		$page_arr = page($num,$pagenum,$query_link,$_config);
		
		if($type!=''){
			$sql='select t.*,p.name,p.intro,p.perioddate from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id  where uid = '.MEMBER_ID .' and display = 1 and t.`status` = '.intval($type).' order by t.ticketid desc limit  '.($page-1)*$pagenum.','.$pagenum;
		}else{
			$sql='select t.*,p.name,p.intro,p.perioddate from '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id  where  uid = '.MEMBER_ID.' and display = 1  order by t.ticketid desc limit  '.($page-1)*$pagenum.','.$pagenum;
		};
		$query = $this->DatabaseHandler->Query($sql); 
		$ticket=$query->GetAll();
		$ticket['page_arr']=$page_arr;
		return $ticket;
	}
	
	function SendUseMail($id){
		$sql='select t.*,m.email,m.username,p.name,p.perioddate,s.userid from '.TABLE_PREFIX.'tttuangou_ticket t left join '.TABLE_PREFIX.'system_members m on t.uid=m.uid left join '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id left join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid = s.id  where t.ticketid = '.intval($id);
		$query = $this->DatabaseHandler->Query($sql);
		$ticket=$query->GetRow();
		if($ticket['userid']!=MEMBER_ID || $ticket=='')return false;
		$ary=array(
		'address'=> $ticket['email'],
		'username'=>$ticket['username'],
		'title'=>'购物券即将到期提示信息',
		'content'=>'温馨提示您购买的产品（'.$ticket['name'].'）消费券即将于'.$ticket['perioddate'].'到期请尽快消费以免过期，请点<a href="'.$this->Config['site_url'].'">这里</a>查看您的团购券！',
		'addtime'=>time()
		);
		$keys=$values='';
		foreach($ary as $i => $valuez){
			$a=$i=='addtime'?"":',';
			$keys.='`'.$i.'`'.$a;
			$values.='\''.$valuez.'\''.$a;
		}
		$sql='insert into '.TABLE_PREFIX.'tttuangou_cron ('.$keys.') VALUES ('.$values.')';
		$this->DatabaseHandler->Query($sql);
		return true;
	}

	function UserMsg($ary){		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_usermsg');
		$result=$this->DatabaseHandler->Insert($ary);
		return true;
	}
}

?>