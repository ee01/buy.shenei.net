<?php 
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename list.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 
 


class ModuleObject extends MasterObject{
	var $city;
	var $cityname;
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
function Execute(){		$this -> config=ConfigHandler::get('product');
		list($this->cityary,$this->city,$this->cityname)=$this->ProductLogic->citychange();
		ob_start();
		switch($this->Code){
			case 'problem':
				$this->Problem();
				break;
			case 'info':
				$this->Info();
				break;
			case 'tobuy':
				$this->Tobuy();
				break;
			case 'backlist':
				$this->Backlist();
				break;
			case 'history':
				$this->History();
				break;
			case 'sendemail':
				$this->Sendemail();
				break;
			case 'question':
				$this->Question();
				break;
			case 'doquestion':
				$this->Doquestion();
				break;
			case 'finder':
				$this->Finder();
				break;
			case 'ckticket':
				$this-> Ckticket();
				break;
			case 'dockticket':
				$this -> Dockticket();
				break;
			default:
				$this->Main();				break;
		};
	}
function Main(){
	$t1=$t2=$t3=$t4=3;	extract($this->Get);
	if($type=='')$t1=2;
	if($type=='1')$t2=2;
	if($type=='0')$t3=2;
	if($type=='2')$t4=2;
	$ticket=$this->MeLogic->ticketMy($type);
	include($this->TemplateHandler->Template("tttuangou_myticket"));
}
function Problem(){
		$this -> Title ='��������';
		$p4='class="current"';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template("tttuangou_problem"));
	}
function Question(){
		$this -> Title ='�����ʴ�';
		$p5='class="current"';
		$action='?mod=list&code=doquestion';
		$num=12;
		$page=intval($_GET['page'])==false?'1':$_GET['page'];
		$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_question where reply!=""';
		$query = $this->DatabaseHandler->Query($sql); 
		$total=$query->GetRow();
		$page_arr =page($total['count(*)'],$num,"index.php?mod=list&code={$this->Code}",$_config);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_question where reply!="" order by time desc limit '.$num*($page-1).','.$num;
		$query = $this->DatabaseHandler->Query($sql); 
		$question=$query->GetAll();
		include($this->TemplateHandler->Template("tttuangou_question"));
	}
function Doquestion(){
		extract($this->Post);
		if(MEMBER_ID<1)$this->Messager('�������ȵ�¼���ܷ����������ʣ�');
		if($question=='')$this->Messager('���ⲻ����Ϊ��Ŷ��');
		if($a=filter($question))$this->Messager($a);
		$ary=array(
			userid => MEMBER_ID,
			username => MEMBER_NAME,
			content => $question,
			time => time()
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_question');
		$result=$this->DatabaseHandler->Insert($ary);
		$this->Messager("���ʳɹ�����ȴ�����Ա�Ļظ���","?mod=list&code=question");
		exit;
	}
function Tobuy(){
		$this -> Title ='�Ź�ָ��';
		$p3='class="current"';
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template("tttuangou_tobuy"));			
	}
function Backlist(){
		$type = strtolower($this->Get['type']);
		if($type=='seckills' or $type==1) {
			$type = 1;
			$TITLE = '��ɱ';
			$where_type = ' and is_seckill = 1';
			$p2_1='class="current"';
		}elseif($type=='groupbuy' or $type==2) {
			$type = 2;
			$TITLE = '�Ź�';
			$where_type = ' and is_seckill = 0';
			$p2_2='class="current"';
		}else{
			$type = 0;
			$TITLE = '����';
			$where_type = '';
			$p2='class="current"';
			$p2_1='class="current"';
			$p2_2='class="current"';
		}
		$this -> Title ='��ʷ'.$TITLE;
//		$p2='class="current"';
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_product where overtime <= \''.$nowdate.' \' and city = '.$this -> city . $where_type;
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=20;		$page_arr = page($num,$pagenum,$query_link,$_config);
		$nowdate=date('Y-m-d H:i:s',time());
		$sql='select * from '.TABLE_PREFIX.'tttuangou_product  where overtime <= \''.$nowdate.' \' and city = '.$this -> city . $where_type.' order by overtime desc limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql);
		$product=$query->GetAll();
		foreach ($product as $i =>$value){
			if($value['totalnum']=='0'){
				$result=$this->ProductLogic->ProductSelled($value['id']);
				$ary=array(
					'totalnum' => $result,
				);
				$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_product');
				$this->DatabaseHandler->Update($ary,'id='.$value['id']);
			};
		};
		$question=$this->OrderLogic->questionlist();
		include($this->TemplateHandler->Template("tttuangou_back"));
	}
function History(){
	extract($this->Get);
//	$p2='class="current"';
	$nowdate=date('Y-m-d',time());
	$product=$this->ProductLogic->productGet(intval($id),$this->city);
	if(!$product)$this->Messager("��Ʒ�����ڣ�");
	$sellermap=explode(',',$product['sellermap']);
	$this -> Title =$product['name'];
	$question=$this->OrderLogic->questionlist();
	if($product['is_seckill']==1) {
		$TITLE = '��ɱ';
		$p2_1='class="current"';
	}else{
		$TITLE = '�Ź�';
		$p2_2='class="current"';
	}
	include($this->TemplateHandler->Template("tttuangou_history"));
	}
function Sendemail(){
		extract($this->Post);
		if(!check_email($email))$this->Messager("�����ַ����");
		if(isset($del)){
			$this->MeLogic->mail($email,$city,0);
		}else{
			$this->MeLogic->mail($email,$city,1);
		}
		$this->Messager("�����ɹ���","?");
	}
function Finder(){
		$this -> Title ='�����н�';
		if(MEMBER_ID<1)$this->Messager("������ע����¼��",'?mod=login');
		include($this->TemplateHandler->Template("tttuangou_finder"));
	}
function Ckticket(){
	$this -> Title ='���Ѿ��ѯ';
	$action='?mod=list&code=dockticket';
	include($this->TemplateHandler->Template("tttuangou_ckticket"));
	}
function Dockticket(){
	extract($this->Get);
	extract($this->Post);
	if($number=='')$this->Messager('����','null');
	$sql='select * from '.TABLE_PREFIX.'tttuangou_ticket where number = \''.$number.'\'';
	$query = $this->DatabaseHandler->Query($sql);
	$ticket=$query->GetRow();
	if($submit=='��ѯ'){
		if(empty($ticket)){
			$this->Messager('���Ϊ'.$number.'�ĸ��Ź�ȯ�����ڣ�','null');
		}else{
			if($ticket['status']==1){
				$msg='���Ź�ȯ��û�б�ʹ��';
			}elseif($ticket['status']==0){
				$msg='���Ź�ȯ�Ѿ���ʹ��,ʹ��ʱ����'.$ticket['usetime'];
			}else{
				$msg='���Ź�ȯ�ѹ���';
			}
			$this->Messager($msg,'null');
		};
	}else{
		if(empty($ticket)){
			$this->Messager('���Ϊ'.$number.'�ĸ��Ź�ȯ�����ڣ�','null');
		}elseif($ticket['status']==0){
			$msg='���Ź�ȯ�Ѿ���ʹ��'.$ticket['usetime'];
		}elseif($ticket['status']!=1){
			$msg='���Ź�ȯ�Ѿ�����';
		};
		if($msg!='')$this->Messager($msg,'null');
		$sql='select s.userid from '.TABLE_PREFIX.'tttuangou_product p left join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id  where p.id = '.$ticket['productid'];
		$query = $this->DatabaseHandler->Query($sql);
		$product=$query->GetRow();
		if($product['userid']!=MEMBER_ID)$this->Messager('ֻ���̼Ҳ��ܹ�ʹ��ʹ������ȯ��');
		if($check==1)$password=authcode($password,DECODE,$this->Config['auth_key']);
		if($password==authcode($ticket['password'],DECODE,$this->Config['auth_key'])){
			if($check==1){
				$ary=array(
					'status'=>'0',
					'usetime' => date('Y-m-d H:i:s',time()),
				);
				$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_ticket');
				$result=$this->DatabaseHandler->Update($ary,'ticketid='.$ticket['ticketid']);
				$this->Messager('����ȯ��ȷ���Ѿ��ɹ�ʹ�ã�','?mod=list&code=ckticket');			}else{
				$this->Messager('<a href="?mod=list&code=dockticket&check=1&number='.$number.'&password='.urlencode($ticket['password']).'">������ȯ������û�б�ʹ�ã�ȷ��������������Ź�ȯ����ʹ��һ�Σ�ȷ�������ǲ�������� !</a>','null');
			}
			
		};
		$this->Messager('���Ϊ'.$number.'������ȯ�������','null');
		exit;
	}
	exit;
	}
}