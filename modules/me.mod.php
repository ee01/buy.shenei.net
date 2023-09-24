<?php 
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename me.mod.php $
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
		$this->ID = (int) ($this->Post['id'] ? $this->Post['id'] : $this->Get['id']);
		$this->CacheConfig = ConfigHandler::get('cache');			$this->ShowConfig = ConfigHandler::get('show');    		$this->Execute();
	}
	
function Execute(){	include_once ROOT_PATH . './setting/constants.php';
	$this -> Title ='�ҵ�����';
	if(MEMBER_ID < 1 && $this->Code!='register' && $this->Code!='doregister' && $this->Code!='sendcheckmail'){
		$this->Messager("��������ע����½!");
	};
	$this -> config=ConfigHandler::get('product');
	list($this->cityary,$this->city,$this->cityname)=$this->ProductLogic->citychange();
	ob_start();
	switch($this->Code){
		case 'cancel':
			$this->Cancel();
			break;
		case 'info':
			$this->Info();
			break;
		case 'doinfo':
			$this->Doinfo();
			break;
		case 'money':
			$this->Money();
			break;
		case 'addmoney':
			$this->Addmoney();
			break;
		case 'readdmoney';
			$this->Readdmoney();
			break;
		case 'doaddmoney':
			$this->Doaddmoney();
			break;
		case 'order':
			$this->Order();
			break;
		case 'printticket':
			$this->Printticket();
			break;
		case 'register':
			$this->Register();
			break;
		case 'doregister':
			$this->Doregister();
			break;
		case 'face':
			$this->Face();
			break;
		case 'sendcheckmail':
			$this->Sendcheckmail();
		default:
			$this->Main();
			break;
	};
}
function Main(){
	extract($this->Get);
	$t1=$t2=$t3=$t4=3;	extract($this->Get);
	extract($this->Post);
	if($type=='')$t1=2;
	if($type=='1')$t2=2;
	if($type=='0')$t3=2;
	if($type=='2')$t4=2;
	$ticket=$this->MeLogic->ticketMy($type);
	$page_arr=$ticket['page_arr'];
	unset($ticket['page_arr']);
	include($this->TemplateHandler->Template("tttuangou_myticket"));
}
function Order(){
	$this->OrderLogic->UpOrder();
	$t1=$t2=$t3=3;	extract($this->Get);
	if($type!=''){
		if($type==payed){
			$pay=1;
			 $t2=2;
		}else{
			$pay=0;
			 $t3=2;
		};
	}else{
		$t1=2;
	};
	$order=$this->OrderLogic->GetOrderList(MEMBER_ID,$pay);
	$page_arr=$order['page_arr'];
	unset($order['page_arr']);
	include($this->TemplateHandler->Template("tttuangou_myorder"));
}

function Cancel(){
		extract($this->Get);
	$this->OrderLogic->orderType($orderid,'0');
	$this->Messager("���Ѿ��ɹ�ȡ���ö�����","?mod=me&code=order");
}
function Info(){
	$city=$this->ProductLogic->getcity();
	$action='?mod=me&code=doinfo';
//	$sql='select * from '.TABLE_PREFIX.'system_members where uid = '.MEMBER_ID;
	$sql="
		 SELECT
			 *
		 FROM
			 ".TABLE_PREFIX.'system_members'." M LEFT JOIN ".TABLE_PREFIX.'system_memberfields'." MF ON(M.uid=MF.uid)
		 WHERE
			 M.uid=".MEMBER_ID;
	$query = $this->DatabaseHandler->Query($sql); 
	$order=$query->GetRow();
	include($this->TemplateHandler->Template("tttuangou_myinfo"));
}
function Doinfo(){
	extract($this->Post);
	$ary = array();
	if($newpwd==$confirmpwd && $newpwd!=''){
		$ary['password']=md5($newpwd);
	};
	$ary['showemail']=$showemail==''?'0':'1';
	$this->MeLogic->mail($email,$city,$ary['showemail']);
	if($phone!=''){
		$ary['phone']=$phone;
	};
	$sql='select `email` from '.TABLE_PREFIX.'system_members where uid = '.MEMBER_ID;
	$query = $this->DatabaseHandler->Query($sql); 
	$user=$query->GetRow();
	$ary['qq']=$qq?intval($qq):'';
	if($user['email']!=$email){
		$ary['email']=$email;
		if($this -> config['default_emailcheck']){
			$ary['checked']=0;
		}
	}
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_members');
	$result=$this->DatabaseHandler->Update($ary,'uid = '.MEMBER_ID);
	$ary2['uid']=MEMBER_ID;
	$ary2['address']=$address;
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_memberfields');
	$result2=$this->DatabaseHandler->Replace($ary2);
	$this->Messager("�����޸ĳɹ���","?mod=me&code=info");
}
function Printticket(){
	extract($this->Get);
	$order=$this->OrderLogic->GetTicket($id);
	$pwd=authcode($order['password'],DECODE,$this->Config['auth_key']);
	if($order=='' || $pwd == '')$this->Messager("��ȡ�Ź�ȯ���ִ���","?mod=me");
	include($this->TemplateHandler->Template("tttuangou_printticket"));
}
function Money(){
	$money=$this->MeLogic->moneyMe();
	$usermoney=$this->MeLogic->ShowMoneyLog(MEMBER_ID);
	$page_arr=$usermoney['page_arr'];
	unset($usermoney['page_arr']);
	include($this->TemplateHandler->Template("tttuangou_mymoney"));
}
function Addmoney(){
	$money=$this->MeLogic->moneyMe();
	$pay=$this->PayLogic->payType(intval($id),$this->city);
	$action='?mod=me&code=doaddmoney';
	include($this->TemplateHandler->Template("tttuangou_addmoney"));
}
function Topay($mod,$returnurl,$pay){
	$payment=unserialize($pay['pay_config']);
	$returnurl.='&pay='.$mod;
	include_once('./modules/'.$mod.'.pay.php');
	$bottom=payTo($payment,$returnurl,$pay);
	return $bottom;
}
function Doaddmoney(){
	$this->Post['money']=ceil($this->Post['money']);
	if($this->Post['paytype']=='')$this->Messager("��û��ѡ��֧����ʽ����û���ʺϵ�֧���ӿڣ�");
	if(!is_numeric($this->Post['money']) || $this->Post['money']<=0)$this->Messager("��ֵ��������ڵ���0��");
	$pay=$this->PayLogic->payChoose(intval($this->Post['paytype']));
	$pay['orderid']=time().rand(10000,99999);
	$pay['price']=intval($this->Post['money']);
	$pay['name']='�˻���ֵ';
	$returnurl = $this->Config['site_url'].'/index.php?mod=me&code=readdmoney';
	$bottom=$this -> Topay($pay['pay_code'],$returnurl,$pay);
	include($this->TemplateHandler->Template('tttuangou_doaddmoney'));
	exit;
}
function Readdmoney(){
	$pay_code = !empty($_REQUEST['pay']) ? trim($_REQUEST['pay']) : $this->Messager("����");
	include_once('./modules/'.$pay_code.'.pay.php');
	$msg=addmymoney();
	if(is_array($msg)){
		$this -> Dopay($msg['price'],$msg['orderid']);
	}else{
		$this->Messager($msg);
	};
}

function Dopay($price,$orderid){
 	if($price=='' || $orderid==''){
		$this->Messager("֧��ʧ��!");
	};
		if($price>0){
		$pay=$this->MeLogic->moneyAdd(intval($price),MEMBER_ID);
		$ary=array(
				'userid' => MEMBER_ID,
				'type' => 1,
				'name' => '��ֵ�˻�',
				'intro' => '��Ϊ�˻���ֵ'.$price.'Ԫ',
				'money' => $price,
				'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
	};
		$ary=array(
		'id' 	=> $orderid,
		'money' => $price,
		'userid'=> MEMBER_ID,
		'paytime'=> date('Y-m-d H:i:s'),
	);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_addmoney');	
	$result=$this->DatabaseHandler->Insert($ary);
	$this->Messager('��ֵ�ɹ���','?mod=me&code=money');
}

function Register(){
	$city=$this->ProductLogic->getcity();
	$action='?mod=me&code=doregister';
	include($this->TemplateHandler->Template("tttuangou_register"));
}
function Face(){
	$sql='select ucuid from '.TABLE_PREFIX.'system_members where uid = '.MEMBER_ID;
	$query = $this->DatabaseHandler->Query($sql);
	$usr=$query->GetRow();
	if(UCENTER) {
		include_once(UC_CLIENT_ROOT . './client.php');
		$face=uc_avatar($usr['ucuid']);
	} else {
		;
	}
	
	include($this->TemplateHandler->Template("tttuangou_face"));
}
function Doregister(){
	extract($this->Post);
	if($email=='' || $truename=='' || $pwd=='' || $phone==''){
		$this->Messager('�뽫������д����');
	};
		if(!check_email($email)){
		$this->Messager("�����ַ����");
	};
	$sql='select uid from '.TABLE_PREFIX.'system_members where email = \''.$email.'\'';
	$query = $this->DatabaseHandler->Query($sql); 
	$user=$query->GetRow();
	if($user!=''){
		$this->Messager("�����Ѿ���ע�ᡣ���������룡");
	};
	if (preg_match('~[\~\`\!\@\#\$\%\^\&\*\(\)\=\+\[\{\]\}\;\:\'\"\,\<\.\>\/\?]~',$truename)) {
		$this->Messager("�û������ܰ��������ַ�",-1);
	};
		if($pwd!=$ckpwd){
		$this->Messager("�����������벻һ�£�");
	};
	$sql='select uid from '.TABLE_PREFIX.'system_members where truename = \''.$truename.'\'';
	$query = $this->DatabaseHandler->Query($sql); 
	$user=$query->GetRow();
	if($user!='')$this->Messager("�û����Ѵ��ڡ����������룡");
		
	$ucuid = 0;
	$ucsynlogin = '';
	if(true === UCENTER) 	{
		include(UC_CLIENT_ROOT . './client.php');
		
		$uc_result = uc_user_register($this->Post['truename'],$this->Post['pwd'],$this->Post['email']);		
		if($uc_result < 0)
		{
			if($uc_result > -4) {
				$this->Messager("��������û�����Ч���ѱ�����ʹ��");
			}
			if($uc_result > -7) {
				$this->Messager("�������Email��ַ��Ч���ѱ�����ʹ��");
			}
			
			$this->Messager("���û�ע��ʧ��");
		} else {
			$ucuid = $uc_result;			$ucsynlogin = uc_user_synlogin($uc_result);		}		
	}
	
	$showemail=$showemail==false?0:1;
	$pwd=md5($pwd);
	$ary=array(
		'username' => $truename,
		'truename' => $truename,
		'password' => $pwd,
		'phone'	   => $phone,
		'qq'	   => intval($qq),
		'email'	   => $email,
		'showemail' => $showemail,
		'role_id' => $this->Config['normal_default_role_id'],
		'checked'  => $this->config['default_emailcheck']==1?0:1,
		'finder' => $this->CookieHandler->GetVar('finderid'),
		'findtime' => $this->CookieHandler->GetVar('findtime'),
		'ucuid' => $ucuid,
	);

	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_members');
	$result=$this->DatabaseHandler->Insert($ary);

	if($address) {
		if ($school!='' and !strstr($address,$school) and !strstr($address,'����') and !strstr($address,'ʦ��') and !strstr($address,'����') and !strstr($address,'ҽ�ƴ�') and !strstr($address,'ũ��') and !strstr($address,'��ҽ')) {
			$address = $school." ".$address;
		}
		$ary2=array(
			'uid' => $result,
			'address' => $address,
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_memberfields');
		$result2=$this->DatabaseHandler->Insert($ary2);
	}

	if(!$result)$this->Messager("ע��ʧ�ܣ�������������û����Ѵ��ڣ�");


	$this->CookieHandler->setVar('sid','',-365*86400*50);
	$this->MemberHandler->SessionExists=false;
	$this->MemberHandler->session['uid']=$result;
	$this->MemberHandler->session['username']=$truename;
			
	$authcode=authcode("{$pwd}\t{$UserFields['secques']}\t{$result}",'ENCODE');
	$this->CookieHandler->SetVar('auth',$authcode,($this->Config['cookie_expire']*86400));
	$this->CookieHandler->SetVar('cookietime','2592000',($this->Config['cookie_expire']*86400));
			
	$referer=$this->CookieHandler->GetVar('referer');
	$this->CookieHandler->SetVar('referer','');
		

		if($showemail == 1){
		$this->MeLogic->mail($email,$city,1);
	}
	
	if(!$this->config['default_emailcheck']) {
		$this->Messager("ע��ɹ�{$ucsynlogin}");
	}
	
		$this -> registmail($truename,$email);
	$this->Messager("��л����ע�ᣬ�����Ѿ����������䷢����һ���ʼ�������½���伤���˺ţ�{$ucsynlogin}");
}
function registmail($truename,$eamil){
		$key=authcode($truename,'ENCODE',$this->Config['auth_key']);
		$set=ConfigHandler::get('product');
		$mail['title']=$this -> Config['site_name'].'��ӭ����';
		$mail['content']=$this -> Config['site_name'].'��ӭ����ע�� ��<a href="'.$this ->Config['site_url'].'/?mod=index&code=confirm&pwd='.urlencode($key).'">�������Ｄ���˺�</a>�����߸��� <br/>'.$this ->Config['site_url'].'/?mod=index&code=confirm&pwd='.urlencode($key).'���������';
		sendmail($truename,$eamil,$mail['title'],$mail['content'],$set);
	}
function Sendcheckmail(){
	extract($this->Get);
	$uname=urldecode($uname);
		$sql='select * from '.TABLE_PREFIX.'system_members where username=\''.$uname.'\' and checked = 0';
	$query = $this->DatabaseHandler->Query($sql); 
	$user=$query->GetRow();
	if($user!=''){
		$this -> registmail($uname,$user['email']);
		$this->Messager("�Ѿ�����һ��ȷ���ż�����������ȥ�ˣ���ע����գ�",'?');
		}
	$this->Messager("���󣬸��û���ȷ������򲻴��ڣ�",'?');
	}

}