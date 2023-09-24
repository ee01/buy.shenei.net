<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename tttuangou.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 



class ModuleObject extends MasterObject{
	var $city;
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
		$this->Execute();
	}
	

function Execute(){
	switch($this->Code){
		case 'varshow':
			$this->Varshow();
			break;
		case 'varedit':
			$this->Varedit();
			break;
		case 'addcity':
			$this->Addcity();
			break;
		case 'doaddcity':
			$this->Doaddcity();
			break;
		case 'doeditcity':
			$this->Doeditcity();
			break;
		case 'deletecity':
			$this->Deletecity();
			break;
		case 'editcity':
			$this->Editcity();
			break;
		case 'city':
			$this->Listcity();
			break;
		case 'deleteseller':
			$this->Deleteseller();
			break;
		case 'addseller':
			$this->Addseller();
			break;
		case 'doaddseller':
			$this->Doaddseller();
			break;
		case 'editseller':
			$this->Editseller();
			break;
		case 'doeditseller':
			$this->Doeditseller();
			break;
		case 'addmap':
			$this->Addmap();
			break;
		case 'mainseller':
			$this->Mainseller();
			break;
		case 'addproduct':
			$this->Addproduct();
			break;
		case 'doaddproduct':
			$this->Doaddproduct();
			break;
		case 'productorder':
			$this->Productorder();
			break;
		case 'editproduct':
			$this->Editproduct();
			break;
		case 'doeditproduct':
			$this->Doeditproduct();
			break;
		case 'deleteproduct':
			$this->Deleteproduct();
			break;
		case 'deleteproduct':
			$this->Editproduct();
			break;
		case 'refundproduct':
			$this->Refundproduct();
			break;
		case 'listproduct':
			$this->Listproduct();
			break;
		case 'deleteorder':
			$this->Deleteorder();
			break;;
		case 'confirmorder':
			$this->Confirmorder();
			break;
		case 'doconfirmorder':
			$this->Doconfirmorder();
			break;
		case 'listorder':
			$this->Listorder();
			break;
		case 'mailcallpay':
			$this->Mailcallpay();
			break;
		case 'setmail':
			$this->Setmail();
			break;
		case 'dosetmail':
			$this->Dosetmail();
			break;
		case 'addmail':
			$this->Addmail();
			break;
		case 'doaddmail':
			$this->Doaddmail();
			break;
		case 'editmail':
			$this->Editmail();
			break;
		case 'doeditmail':
			$this->Doeditmail();
			break;
		case 'deletemail':
			$this->Deletemail();
			break;
		case 'sendmail':
			$this->Sendmail();
			break;
		case 'dosendmail':
			$this->Dosendmail();
			break;
		case 'mail':
			$this->mail();
			break;
		case 'deleteemail':
			$this->Deleteemail();
			break;
		case 'email':
			$this->Email();
			break;
		case 'onlinepay':
			$this->Onlinepay();
			break;
		case 'setpay':
			$this->setpay();
			break;
		case 'dosetpay':
			$this->Dosetpay();
			break;
		case 'mainpay':
			$this->Mainpay();
			break;
		case 'ticket':
			$this->Ticketz();
			break;
		case 'warnofticket':
			$this->Warnofticket();
			break;
		case 'deleteticket':
			$this->Deleteticket();
			break;
		case 'replyquestion':
			$this->Replyquestion();
			break;
		case 'doreplyquestion':
			$this->Doreplyquestion();
			break;
		case 'deletequestion':
			$this->Deletequestion();
			break;
		case 'mainquestion':
			$this->Mainquestion();
			break;
		case 'yesfinder':
			$this->Yesfinder();
			break;;
		case 'nofinder':
			$this->Nofinder();
			break;
		case 'deletefinder':
			$this->Deletefinder();
			break;
		case 'mainfinder':
			$this->Mainfinder();
			break;
		case 'usermsg':
			$this->Usermsg();
			break;
		case 'readusermsg':
			$this->Readusermsg();
			break;
		case 'deleteusermsg':
			$this->Deleteusermsg();
			break;
			
	};
}
	function Varshow(){
		$action='?mod=tttuangou&code=varedit';
		$product=ConfigHandler::get('product');
		include($this->TemplateHandler->Template("admin/tttuangou_var"));
	}
	function Varedit(){
		extract($this->Post);
		$set=ConfigHandler::get('product');
		$set['default_successnum']=$default_successnum;
		$set['default_oncemax']=$default_oncemax;
		$set['default_imgwidth']=$default_imgwidth;
		$set['default_payfinder']=$default_payfinder;
		$set['default_city']=$default_city;
		$set['default_emailcheck']=$default_emailcheck;
		$set['default_googlemapkey']=$default_googlemapkey;
		$set['aboutme']=$aboutme;
		$set['privacy']=$privacy;
		$set['contat']=$contat;
		$set['joinus']=$joinus;
		$set['terms']=$terms;
		ConfigHandler::set('product',$set);
		$this->Messager("操作成功",'?mod=tttuangou&code=varshow');
	}
	function Listcity(){
		$city_list=$this->ProductLogic->getcitylist();
		include($this->TemplateHandler->Template("admin/tttuangou_listcity"));
	}
	
	function Addcity(){
		$action="admin.php?mod=tttuangou&code=doaddcity";
		include($this->TemplateHandler->Template("admin/tttuangou_addcity"));
	}
	function Doaddcity(){
		if($this->Post['cityname']=='')$this->Messager("操作失败，地区名称不可以为空");
		$ary=array(
				'cityname'=>$this->Post['cityname'],
				'shorthand'=>$this->Post['shorthand'],
				'display'=>$this->Post['display']
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_city');
		$result=$this->DatabaseHandler->Insert($ary);
		$this->Messager("操作成功","?mod=tttuangou&code=city");
	}
	function Editcity(){
		$action="admin.php?mod=tttuangou&code=doeditcity";
		$city=$this->ProductLogic->getcity($this->Get['id']);
		include($this->TemplateHandler->Template("admin/tttuangou_editcity"));
	}
	function Doeditcity(){
		$display=$this->Post['display']==''?0:1;
		$ary=array(
				'cityname'=>$this->Post['cityname'],
				'shorthand'=>$this->Post['shorthand'],
				'display'=>$display
		);
		$cityid=$this->Post['cityid'];
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_city');
		$result=$this->DatabaseHandler->Update($ary,'cityid='.$cityid);
		$this->Messager("操作成功","?mod=tttuangou&code=city");
	}
	function Deletecity(){
		$id=$this->Get['id'];
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_city');
		$result=$this->DatabaseHandler->Delete('','cityid='.$id);
		$this->Messager($return ? $return : "操作成功","?mod=tttuangou&code=city");
	}
	function Mainseller(){
			$city=$this->ProductLogic->getcity();
			$newcity=array();
			for($i=0;$i<count($city);$i++){
				$newcity[$city[$i]['cityid']]=$city[$i]['cityname'];
			}
			
			$keyword=$this->Post['keyword']==''?$this->Get['keyword']:$this->Post['keyword'];
			$area=$this->Post['city']==''?$this->Get['city']:$this->Post['city'];
			$addsql='';
			if($keyword!='' || ($area !='false' && $area !='')){
				$addsql=' where 1 ';
				if($keyword!='')$addsql.=' and sellername like \'%'.$keyword.'%\' ';
				if($area!='' && $area !='false')$addsql.=' and area = '.$area.' ';
			}
			$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
			$sql='SELECT count(*) from '.TABLE_PREFIX.'tttuangou_seller '.$addsql;
			$query = $this->DatabaseHandler->Query($sql); 
			$num=$query->GetRow();
			$num=$num['count(*)'];
			if($num==0 && $addsql!='')$this->Messager("无法找到匹配的商家","?mod=tttuangou&code=mainseller");
			$pagenum=10;			$page_arr = page($num,$pagenum,$query_link,$_config);		
			
			$sql='SELECT * from '.TABLE_PREFIX.'tttuangou_seller '.$addsql.' limit '.($page-1)*$pagenum.','.$pagenum;
			$query = $this->DatabaseHandler->Query($sql);
			$seller=$query->GetAll();
			include($this->TemplateHandler->Template('admin/tttuangou_seller'));
	}		
	function Addseller(){
			extract($this->Post);
			$city=$this->ProductLogic->getcity();
			$action='?mod=tttuangou&code=doaddseller';
						$sql='select uid,username from '.TABLE_PREFIX.'system_members where  role_id = 6  ';
			$query = $this->DatabaseHandler->Query($sql);
			$user=$query->GetAll();
			include($this->TemplateHandler->Template('admin/tttuangou_selleradd'));
	}
	function Addmap(){
		extract($this->Get);
		extract($this->Post);
		$this -> config=ConfigHandler::get('product');
		if($this->config['default_googlemapkey']=='')die('您还没有填写正确的google地图接口密钥。<a href="http:/'.'/code.google.com/intl/zh-CN/apis/maps/signup.html" target="_blank">立刻免费申请</a><br /><br />如果您已经有正确的googlemap密钥请写入配置文件中！');
				$x=34.3797125804622;
		$y=103.623046875;
		$z=4;
		if($id!=''){
			$xyz=explode(',',$id);
			$x=$xyz[0];
			$y=$xyz[1];
			$z=$xyz[2];
		}
		@header('Content-Type: text/html; charset=utf8');
		include($this->TemplateHandler->Template('admin/tttuangou_googlemap'));
	}
		
	function Doaddseller(){
		extract($this->Get);
		extract($this->Post);
		if($sellername=='' || $sellerphone == '' || $selleraddress=='' || $userid ==''){
			$this->Messager("请将参数都填写完整!");
		}
		$ary=array(
			'userid'=> intval($userid),
			'sellername'=>$sellername,
			'sellerphone'=>$sellerphone,
			'selleraddress'=>$selleraddress,
			'sellerurl'=>$sellerurl,
			'sellermap'=>$map,
			'area'=>$area,
			'time'=> time()
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_seller');
		$result=$this->DatabaseHandler->Insert($ary);
		if($result==0)$this->Messager("出现错误，一个用户只能对应一个商家");
				$ary=array(
			'role_id' => 6		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_members');
		$result=$this->DatabaseHandler->Update($ary,'uid='.$userid);
		$this->Messager("操作成功",'?mod=tttuangou&code=mainseller');
	}
		
	function Editseller(){
		extract($this->Get);
		extract($this->Post);
		$city=$this->ProductLogic->getcity();
				$sql='select uid,username from '.TABLE_PREFIX.'system_members  where role_id = 6  ';
		$query = $this->DatabaseHandler->Query($sql);
		$user=$query->GetAll();
		$action='?mod=tttuangou&code=doeditseller';
		$sql='select * from '.TABLE_PREFIX.'tttuangou_seller where userid = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$seller=$query->GetRow();
		include($this->TemplateHandler->Template('admin/tttuangou_selleredit'));
		}
		
	function Doeditseller(){
		extract($this->Post);
		$ary=array(
			'userid'=> $userid,
			'sellername'=>$sellername,
			'sellerphone'=>$sellerphone,
			'selleraddress'=>$selleraddress,
			'sellerurl'=>$sellerurl,
			'area'=>$area,
			'time'=> time()
		);
		if($map!='')$ary['sellermap']=$map;
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_seller');
		$result=$this->DatabaseHandler->Update($ary,'id='.intval($id));

		$ary=array(
			'role_id' => 6		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'system_members');
		$result=$this->DatabaseHandler->Update($ary,'uid='.$userid);

		$this->Messager("操作成功","?mod=tttuangou&code=mainseller");
		}
		
	function Deleteseller(){
		extract($this->Get);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_product where sellerid = '.intval($id);
		$query = $this->DatabaseHandler->Query($sql);
		$user=$query->GetAll();
		if(!empty($user))$this->Messager("您必须先删除该商家的产品！才能删除该商家",'?mod=tttuangou&code=mainseller');
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_seller');
		$result=$this->DatabaseHandler->Delete('','id='.intval($id));
		$this->Messager("删除成功",'?mod=tttuangou&code=mainseller');
		}

	function Listproduct(){
		$keyword=$this->Post['keyword']==''?$this->Get['keyword']:$this->Post['keyword'];
		$addsql='';
		if($keyword!='')$addsql=' where name LIKE \'%'.$keyword.'%\'';
				$nowdate=date('Y-m-d',time());
		$sql='update '.TABLE_PREFIX.'tttuangou_product set status=0 where overtime <=\''.$nowdate.'\' and `status` = 1 ';
		$query = $this->DatabaseHandler->Query($sql);
				$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_product '.$addsql;
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		if($num==0 && $addsql!='')$this->Messager("无法找到匹配的产品","?mod=tttuangou&code=listproduct");
		$pagenum=10;		$page_arr = page($num,$pagenum,$query_link,$_config);
		$sql='SELECT name,id,is_seckill,nowprice,display,city,begintime,overtime,status,successnum,totalnum FROM '.TABLE_PREFIX.'tttuangou_product '.$addsql.' order by overtime desc limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$product_list=$query->GetAll();
		include($this->TemplateHandler->Template("admin/tttuangou_listproduct"));
	}
	function Addproduct(){
				$city=$this->ProductLogic->getcity();
				$sql='SELECT * FROM '.TABLE_PREFIX.'tttuangou_seller';
		$query = $this->DatabaseHandler->Query($sql); 
		$seller=$query->GetAll();
		if(empty($seller)){$this->Messager("请先添加一个商家，才能添加产品。");}
		$action="admin.php?mod=tttuangou&code=doaddproduct";
		$product=ConfigHandler::get('product');
		$default_successnum=$product['default_successnum'];
		$default_oncemax=$product['default_oncemax'];
		include($this->TemplateHandler->Template("admin/tttuangou_addproduct"));
	}
	function Doaddproduct(){
		extract($this->Get);
		extract($this->Post);
				if(!($name && $price && $nowprice && $city && $begintime && $overtime)){
			$this->Messager("请将基本信息填写完整，然后添加。");
		};
		
		if(!(intval($price) && intval($nowprice) && $price>$nowprice) ){
			$this->Messager("价格必须是数字，而且原始价格必须大于团购价格。");
		};
		$begintimeary=explode('-',$begintime);
		$overtimeary=explode('-',$overtime);
		$error=0;
		if($begintimeary[0]>$overtimeary[0])$error=1;
		if($begintimeary[0]==$overtimeary[0]){
			if($begintimeary[1]>$overtimeary[1]){
				$error=1;
			}elseif($begintimeary[1]==$overtimeary[1]){
				if($begintimeary[2]>$overtimeary[2])$error=1;
			};
		};
		if($error)$this->Messager("团购开始时间必须小于结束时间哦！");
				if($_FILES['img']['name']!=''){
			$img=upload_image(IMAGE_PATH.'/product/','img',$this -> config['default_imgwidth'],$this -> config['default_imgheight']);
			if($img=='imgerror')$this->Messager('图片格式错误');
		};
		$this->Post['display']=$this->Post['display']==''?0:1;
		$this->Post['successnum']=$this->Post['is_seckill']==1?0:$this->Post['successnum'];
		
		if ($useotherprice) {
			$otherprice = array ();
			for ( $i = 1,$j = 1; $i < $txtTRLastIndex; $i++ ) {
				if ( $this->Post['name'.$i] && $this->Post['price'.$i] && $this->Post['nowprice'.$i] ) {
					$otherprice[$j]['name'] = $this->Post['name'.$i];
					$otherprice[$j]['price'] = $this->Post['price'.$i];
					$otherprice[$j]['nowprice'] = $this->Post['nowprice'.$i];
					$otherprice[$j]['earnest'] = $this->Post['earnest'.$i];
					$j++;
				}
			}
			$otherprice = serialize($otherprice);
		}else{
			$otherprice = "";
		}
		
		$ary=array(
				'is_seckill'=>$this->Post['is_seckill'],
				'sellerid'=>$this->Post['sellerid'],
				'city'=>$this->Post['city'],
				'name'=>$this->Post['name'],
				'price'=>$this->Post['price'],
				'nowprice'=>$this->Post['nowprice'],
				'earnest'=>$this->Post['earnest'],
				'otherprice'=>$otherprice,
				'img'=>$img,
				'intro'=>$this->Post['intro'],
				'content'=>$this->Post['content'],
				'cue'=>$this->Post['cue'],
				'theysay'=>$this->Post['theysay'],
				'wesay'=>$this->Post['wesay'],
				'begintime'=>$this->Post['begintime'],
				'overtime'=>$this->Post['overtime'],
				'perioddate'=>$this->Post['perioddate'],
				'successnum'=>$this->Post['successnum'],
				'maxnum'=>$this->Post['maxnum'],
				'oncemax'=>$this->Post['oncemax'],
				'display'=>$this->Post['display'],
				'addtime'=>date('Y-m-d',time()),
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_product');
		$result=$this->DatabaseHandler->Insert($ary);
		$this->ProductLogic->AddSellerProNum($this->Post['sellerid']);
		$this->Messager("操作成功","?mod=tttuangou&code=listproduct");
	}
	function Productorder(){
		Load::logic('order');
		$this->OrderLogic = new OrderLogic();
		$order=$this->OrderLogic->orderPaylist($this->Get['id']);
		include($this->TemplateHandler->Template("admin/tttuangou_productorder"));
		exit;
	}
	function Editproduct(){
		$action="admin.php?mod=tttuangou&code=doeditproduct";
				$sql='SELECT * FROM '.TABLE_PREFIX.'tttuangou_seller';
		$query = $this->DatabaseHandler->Query($sql); 
		$seller=$query->GetAll();
				$city=$this->ProductLogic->getcity();
		$id=$this->Get['id'];
		$sql='SELECT * FROM '.TABLE_PREFIX.'tttuangou_product where id = '.$id;	
		$query = $this->DatabaseHandler->Query($sql); 
		$product=$query->GetRow();
		
		$product['otherprice'] = unserialize($product['otherprice']);
		$pricenum = count($product['otherprice']);
		
		include($this->TemplateHandler->Template("admin/tttuangou_editproduct"));
	}
	function Doeditproduct(){
		extract($this->Get);
		extract($this->Post);
				if(!($name && $price && $nowprice && $city && $begintime && $overtime)){
			$this->Messager("请将基本信息填写完整，然后添加。");
		};
		if(!(intval($price) && intval($nowprice) && $price>$nowprice) ){
			$this->Messager("价格必须是数字，而且原始价格必须大于团购价格。");
		};
		$begintimeary=explode('-',$begintime);
		$overtimeary=explode('-',$overtime);
		$error=0;
		if($begintimeary[0]>$overtimeary[0])$error=1;
		if($begintimeary[0]==$overtimeary[0]){
			if($begintimeary[1]>$overtimeary[1]){
				$error=1;
			}elseif($begintimeary[1]==$overtimeary[1]){
				if($begintimeary[2]>$overtimeary[2])$error=1;
			};
		};
		if($error)$this->Messager("团购开始时间必须小于结束时间哦！");
		extract($this->Get);
		extract($this->Post);
				if(!($name && $price && $nowprice && $city && $begintime && $overtime)){
			$this->Messager("请将基本信息填写完整，然后添加。");
		};
		if(!(intval($price) && intval($nowprice) && intval($earnest) && $price>$nowprice) ){
			$this->Messager("价格必须是数字，而且原始价格必须大于团购价格。");
		};
		$begintimeary=explode('-',$begintime);
		$overtimeary=explode('-',$overtime);
		$error=0;
		if($begintimeary[0]>$overtimeary[0])$error=1;
		if($begintimeary[0]==$overtimeary[0]){
			if($begintimeary[1]>$overtimeary[1]){
				$error=1;
			}elseif($begintimeary[1]==$overtimeary[1]){
				if($begintimeary[2]>$overtimeary[2])$error=1;
			};
		};
		if($error)$this->Messager("团购开始时间必须小于结束时间哦！");

				if($_FILES['img']['name']!=''){
			$img=upload_image(IMAGE_PATH.'/product/','img',$this -> config['default_imgwidth'],$this -> config['default_imgheight']);
			if($img=='imgerror')$this->Messager('图片格式错误');
		};
		$this->Post['display']=$this->Post['display']==''?0:1;
		$this->Post['successnum']=$this->Post['is_seckill']==1?0:$this->Post['successnum'];
		
		if ($useotherprice) {
			$otherprice = array ();
			for ( $i = 1,$j = 1; $i < ($txtTROriginalNum + $txtTRLastIndex); $i++ ) {
				if ( $this->Post['name'.$i] && $this->Post['price'.$i] && $this->Post['nowprice'.$i] ) {
					$otherprice[$j]['name'] = $this->Post['name'.$i];
					$otherprice[$j]['price'] = $this->Post['price'.$i];
					$otherprice[$j]['nowprice'] = $this->Post['nowprice'.$i];
					$otherprice[$j]['earnest'] = $this->Post['earnest'.$i];
					$j++;
				}
			}
			$otherprice = serialize($otherprice);
		}else{
			$otherprice = "";
		}
		
		$ary=array(
				'is_seckill'=>$this->Post['is_seckill'],
				'sellerid'=>$this->Post['sellerid'],
				'city'=>$this->Post['city'],
				'name'=>$this->Post['name'],
				'price'=>$this->Post['price'],
				'nowprice'=>$this->Post['nowprice'],
				'earnest'=>$this->Post['earnest'],
				'otherprice'=>$otherprice,
				'intro'=>$this->Post['intro'],
				'content'=>$this->Post['content'],
				'cue'=>$this->Post['cue'],
				'theysay'=>$this->Post['theysay'],
				'wesay'=>$this->Post['wesay'],
				'content'=>$this->Post['content'],
				'begintime'=>$this->Post['begintime'],
				'overtime'=>$this->Post['overtime'],
				'perioddate'=>$this->Post['perioddate'],
				'successnum'=>$this->Post['successnum'],
				'maxnum'=>$this->Post['maxnum'],
				'oncemax'=>$this->Post['oncemax'],
				'display'=>$this->Post['display'],
				'img'=>$img,
		);
		$this->Post['display']=$this->Post['display']==''?0:1;
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_product');
		$result=$this->DatabaseHandler->Update($ary,'id='.$id);
		$this->Messager("操作成功","?mod=tttuangou&code=listproduct");
	}
	function Deleteproduct(){
		$id=intval($this->Get['id']);
		$sql='select sellerid from '.TABLE_PREFIX.'tttuangou_product where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql); 
		$product=$query->GetRow();
		
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_product');
		$result=$this->DatabaseHandler->Delete('','id='.$id);
		$this->ProductLogic->DelSellerProNum($product['sellerid']);
		$this->Messager("操作成功",'?mod=tttuangou&code=listproduct');
	}
	function Refundproduct(){
		extract($this->Get);
		extract($this->Post);
		$id=intval($id);
				$sql='SELECT status,nowprice,earnest,otherprice,name FROM '.TABLE_PREFIX.'tttuangou_product where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql); 
		$product=$query->GetRow();
		$product['otherprice'] = unserialize($product['otherprice']);
		if($product['status']==0){
						$sql='select o.*,m.username,m.email,p.sellerid from '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'system_members m on o.userid= m.uid LEFT join '.TABLE_PREFIX.'tttuangou_product p on o.productid=p.id where o.productid = '.$id.' and o.pay = 1 and o.status = 1';
			$query = $this->DatabaseHandler->Query($sql); 
			$order=$query->GetAll();
			if($order==''){
				$this->Messager("没有订单，不需要退款",'?mod=product');
			}else{
				foreach($order as $i => $value){
					$ary=array(
						'address'=> $value['email'],
						'username'=>$value['username'],
						'title'=>'团购失败提示信息',
						'content'=>'非常抱歉！您团购的产品（'.$product['name'].'）因为购买人数不足而失败了！货款已经返还您的账户请点<a href="'.$this->Config['site_url'].'">这里</a>查看详细！',
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
				
					if ($value['priceradio']) {
						$price=$value['productnum']*$product['otherprice'][$value['priceradio']]['earnest'];
					}else{
						$price=$value['productnum']*$product['earnest'];
					}
					
					$this->ProductLogic->delSellerTotMoney($value['sellerid'],$price);
					$this->MeLogic->moneyAdd($price,$value['userid']);
					$ary=array(
						'userid' => $value['userid'],
						'type' => 1,
						'name' => '失败团购返款账户',
						'intro' => '返还您团购金额'.$price.'元',
						'money' => $price,
						'time' => time(),
					);
					$this->MeLogic->moneyLog($ary);
				};
			};
			$this->ProductLogic->productTypedit($id,3);
						$ary=array(
				'status' => 3,
			);
			$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_order');
			$result=$this->DatabaseHandler->Update($ary,'productid='.$id);		
			$this->Messager("返款成功",'?mod=tttuangou&code=listproduct');		
		};
		$this->Messager("错误不能退款",'?mod=tttuangou&code=listproduct');
	}

	function Listorder(){
				$keyword=$this->Post['keyword']==''?$this->Get['keyword']:$this->Post['keyword'];
		$searchtype=$this->Post['type']==''?$this->Get['type']:$this->Post['type'];
		$status=$this->Post['status']==''?$this->Get['status']:$this->Post['status'];
		$addsql='';
		if($keyword!='' || ($status!='false' && $status!='')){
			$addsql=' where 1 ';
			$type=$searchtype==1?'o.orderid':'m.username';
			if($keyword!='')$addsql.= ' AND '.$type.' LIKE \'%'.$keyword.'%\'';
			if($status!='false' && $status!='')$addsql.= ' AND o.pay = '.$status.' ';
		}
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id left join '.TABLE_PREFIX.'system_members m on m.uid=o.userid '.$addsql;
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		if($addsql!='' && $num['count(*)']==0)$this->Messager("无法搜索到匹配的订单",'?mod=tttuangou&code=listorder');
		$num=$num['count(*)'];
		$pagenum=10;		$page_arr = page($num,$pagenum,$query_link,$_config);
		$sql='SELECT o.*,p.name,p.nowprice,p.earnest,p.otherprice,m.uid,m.username,m.phone,m.qq FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id left join '.TABLE_PREFIX.'system_members m on m.uid=o.userid '.$addsql.' order by buytime DESC  limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$list=$query->GetAll();
		foreach($list as $i => $value){
			$order[$i]=$value;
			$order[$i]['otherprice'] = unserialize($order[$i]['otherprice']);
			if($order[$i]['priceradio']) {
				$order[$i]['money']=$order[$i]['otherprice'][$value['priceradio']]['earnest']*$value['productnum'];
			}else{
				$order[$i]['money']=$value['earnest']*$value['productnum'];
			}
		};
		include($this->TemplateHandler->Template("admin/tttuangou_listorder"));
	}
	
	function Mailcallpay(){
		$id=$this->Get['id'];
		$sql='select o.*,m.email,m.username,p.name,p.perioddate from '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'system_members m on o.userid=m.uid left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.orderid = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
		$ary=array(
		'address'=> $order['email'],
		'username'=>$order['username'],
		'title'=>'订单支付温馨提示',
		'content'=>'温馨提示您团购的产品（'.$order['name'].')即将结束,而您还没有付款，想拥有现在是好机会啊，请点<a href="'.$this->Config['site_url'].'">这里完成付款立刻拥有该商品</a>！',
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
		$this->Messager("邮件通知成功!");
	}
	
	function Confirmorder(){
		$id=$this->Get['id'];
		$sql='SELECT o.*,p.name,p.nowprice FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where o.orderid = '.$id ;
		$query = $this->DatabaseHandler->Query($sql); 
		$order=$query->GetRow();
		$action='?mod=tttuangou&code=doconfirmorder';
		include($this->TemplateHandler->Template("admin/tttuangou_confirmorder"));
	}
	function Doconfirmorder(){
		extract($this->Post);
		if($type=='' || intval($money)=='' || $number=='')$this->Messager("您必须详细记录所有交易信息!");
		if($money<=0)$this->Messager("错误，交易金额必须是一个大于0的整数!");
		$money=intval($money);
		$order=$this->OrderLogic->orderGet($orderid);
		if($order['pay']==1)$this->Messager("错误，该订单已经支付过了!");
		$this->MeLogic->moneyAdd($money,$order['userid']);
		$ary=array(
			'userid' => $order['userid'],
			'type' => 1,
			'name' => '充值(后台)',
			'intro' => '您充值了'.$money.'元，由管理员（'.MEMBER_NAME.'）确认收到货款',
			'money' => $money,
			'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
		$product = $this->ProductLogic->productCheck($order['productid']);
		if($product == false){
			$this->Messager("错误~该产品不存在或已结束团购!");
		};
		$product['otherprice'] = unserialize($product['otherprice']);
		if($product['maxnum']!=0){
			$surplusnum=$this->ProductLogic->productNum($product['maxnum'],$order['productid']);
			if($surplusnum<=$product['productnum']){
				$this->Messager("该产品被人抢先购买了，钱已经充值到个人账户！");
			};
		};
		if ($order['priceradio']) {
			$price=$product['otherprice'][$order['priceradio']]['earnest']*$order['productnum'];
		}else{
			$price=$product['earnest']*$order['productnum'];
		}
		$result=$this->MeLogic->moneyMe($order['userid']);
		if($price<=$result['money']){
			$result=$this->MeLogic->moneypay($price,$order['userid']);
			$this->ProductLogic->AddSellerTotMoney($product['sellerid'],$price);
		}else{
			$this->Messager("余额不足，不够支付本次消费！");
		};	
		$result=$this->OrderLogic->orderType($orderid,1,1,1);
		$this->Ticket($orderid);
		$this->Messager("订单修改成功！","?mod=tttuangou&code=listorder");
	}
	
	function Deleteorder(){
		$id=$this->Get['id'];
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_order');
		$result=$this->DatabaseHandler->Delete('','orderid='.$id);
		$this->Messager($return ? $return : "操作成功","?mod=tttuangou&code=listorder");
	}
	function Warnofticket(){
		extract($this->Get);
		extract($this->Post);
		$id=intval($id);
				$sql='select t.*,m.email,m.username,p.name,p.perioddate from '.TABLE_PREFIX.'tttuangou_ticket t left join '.TABLE_PREFIX.'system_members m on t.uid=m.uid left join '.TABLE_PREFIX.'tttuangou_product p on t.productid = p.id where t.ticketid = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$ticket=$query->GetRow();
		
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
		$this->Messager("您已经成功提醒了该用户！",'?mod=tttuangou&code=ticket');
	}
	
	function Ticket($orderid){
		$sql='SELECT p.name,p.nowprice,p.earnest,p.otherprice,o.productid,p.id,p.successnum,o.orderid,o.userid as ouid,o.productnum,o.priceradio FROM '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'tttuangou_product p on o.productid = p.id where  o.orderid = '.$orderid;
		$query = $this->DatabaseHandler->Query($sql);
		$order=$query->GetRow();
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
			'userid' => $order['ouid'],
			'type' => 0,
			'name' => '团购商品',
			'intro' => '购买了商品['.$order['name'].'] 单价：'.$nowprice.'元     一共购买了'.$order['productnum'].'个',
			'money' => $money,
			'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
		$sql='SELECT count(*) from  '.TABLE_PREFIX.'tttuangou_order where productid = '.$order['id'].' and pay = 1';
		$query = $this->DatabaseHandler->Query($sql);
		$num=$query->GetRow();
		$num=$num['count(*)'];
		if($num<$order['successnum']){
			$this->Messager('您已经成功团购该产品，但团购差'.($order['successnum']-$num).'人达成 ，快去邀请好友参加团购，还能获得丰厚获取奖励!','?mod=tttuangou&code=listorder');
		}
		if($num==$order['successnum']){
			$sql='select o.*,m.username,m.email from '.TABLE_PREFIX.'tttuangou_order o left join '.TABLE_PREFIX.'system_members m on o.userid= m.uid where o.productid = '.$order['id'].' and o.pay = 1 and o.status = 1';
			$query = $this->DatabaseHandler->Query($sql);
			$orderPayed=$query->GetAll();
			foreach($orderPayed as $i => $value){
				$this->ProductLogic->productTypedit($order['productid'],2);
				$usreid=intval($value['userid']);
				$ary=array(
				'address'=> $value['email'],
				'username'=>$value['username'],
				'title'=>'团购成功提示信息',
				'content'=>'恭喜您在本站团购的产品('.$order['name'].')在'.date('Y-m-d H:i',time()).'团购成功，请点<a href="'.$this->Config['site_url'].'">这里</a>查看您的团购券！',
				'addtime'=>time()
				);
				$this->MeLogic->mailCron($ary);
				$this->MeLogic->finder($usreid,$order['id']);
				for($i=1;$i<=$value['productnum'];$i++){
					$result=$this->MeLogic->ticketCreate($usreid,$order['id'],$value['orderid']);
					if($result=='')$i--;
				};
			};
			$this->Messager("团购成功，您还可以推荐您的朋友来购买哦！",'?mod=tttuangou&code=listorder');
		};
		$this->MeLogic->finder(intval($order['ouid']),intval($order['productid']));
		$this->ProductLogic->productTypedit($order['productid'],2);
		for($i=1;$i<=$order['productnum'];$i++){
			$result=$this->MeLogic->ticketCreate($order['ouid'],$order['productid'],$order['orderid']);
			if($result=='')$i--;
		};
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_ticket');
		$result=$this->DatabaseHandler->Insert($ary);
		$this->Messager("团购成功，您还可以推荐您的朋友来购买哦！",'?mod=tttuangou&code=listorder');
	}

function Mail(){
		$sql='select mid,name,intro,title from '.TABLE_PREFIX.'tttuangou_mail ';
		$query = $this->DatabaseHandler->Query($sql);
		$mail=$query->GetAll();
		include($this->TemplateHandler->Template('admin/tttuangou_mail'));
	}
	
function Setmail(){
	$set=ConfigHandler::get('product');
	$action='?mod=tttuangou&code=dosetmail';
	include($this->TemplateHandler->Template('admin/tttuangou_mailset'));
	}

function Dosetmail(){
	extract($this->Post);
	$set=ConfigHandler::get('product');
	$set['default_mailtype']=$default_mailtype;
	$set['default_server']=$server;
	$set['default_port']=$port;
	$set['default_user']=$user;
	$set['default_pwd']=$password;
	ConfigHandler::set('product',$set);
	$this->Messager("操作成功",'?mod=tttuangou&code=mail');
	}

function Addmail(){
	$action='?mod=tttuangou&code=doaddmail';
	include($this->TemplateHandler->Template('admin/tttuangou_addmail'));
	}
	
function Doaddmail(){
	extract($this->Post);
	$ary=array(
		'name' => $name,
		'intro' => $intro,
		'title' => $title,
		'content' => $content,
	);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_mail');
	$result=$this->DatabaseHandler->Insert($ary);
	$this->Messager("操作成功",'?mod=tttuangou&code=mail');
	}
function Editmail(){
	extract($this->Get);
	$action='?mod=tttuangou&code=doeditmail';
	$sql='select * from '.TABLE_PREFIX.'tttuangou_mail where mid = '.intval($id);
	$query = $this->DatabaseHandler->Query($sql);
	$mail=$query->GetRow();
	include($this->TemplateHandler->Template('admin/tttuangou_editmail'));
}

function Doeditmail(){
	extract($this->Post);
	$ary=array(
		'name' => $name,
		'intro' => $intro,
		'title' => $title,
		'content' => $content,
	);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_mail');
	$result=$this->DatabaseHandler->Update($ary,'mid='.$mid);
	$this->Messager("操作成功","?mod=tttuangou&code=mail");
}

function Deletemail(){
	extract($this->Get);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_mail');
	$result=$this->DatabaseHandler->Delete('','mid='.$id);
	$this->Messager("操作成功",'?mod=tttuangou&code=mail');
}

function Sendmail(){
	extract($this->Get);
	extract($this->Post);
	$action='?mod=tttuangou&code=dosendmail';
	$sql='select * from '.TABLE_PREFIX.'tttuangou_mail where mid = '.$id;
	$query = $this->DatabaseHandler->Query($sql);
	$mail=$query->GetRow();
	$sql='SELECT * FROM '.TABLE_PREFIX.'tttuangou_city';
	$query = $this->DatabaseHandler->Query($sql); 
	$city_list=$query->GetAll();
	include($this->TemplateHandler->Template('admin/tttuangou_sendmail'));
}

function Dosendmail(){
	extract($this->Get);
	extract($this->Post);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_email ';
	if(intval($city)!=0){
		$sql.=' where city = '.$city;
	};
	$query = $this->DatabaseHandler->Query($sql);
	$email=$query->GetAll();
	
	$sql='select * from '.TABLE_PREFIX.'tttuangou_mail where mid = '.$mid;
	$query = $this->DatabaseHandler->Query($sql);
	$mail=$query->GetRow();
	
	foreach($email as $value){
			$ary=array(
				'address'=> $value['email'],
				'username'=>'尊敬的用户',
				'title'=>$mail['title'],
				'content'=>$mail['content'],
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
	}
	
	$this->Messager("邮件已写入计划任务表，将适时发送！",'?mod=tttuangou&code=mail');
	exit;
}

function Email(){
		extract($this->Get);
		extract($this->Post);
				$city=$this->ProductLogic->getcity();
		foreach($city as $i => $value){
			$mycity[$value['cityid']]=$value['cityname'];
		};

		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_email';
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=15;		$page_arr = page($num,$pagenum,$query_link,$_config);

				$sql='select * from '.TABLE_PREFIX.'tttuangou_email limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql);
		$mail=$query->GetAll();
		include($this->TemplateHandler->Template('admin/tttuangou_email'));
	}	
function Deleteemail(){
	extract($this->Get);
	extract($this->Post);
	$id=intval($id);
	$sql='delete from '.TABLE_PREFIX.'tttuangou_email where id = '.$id;
	$query = $this->DatabaseHandler->Query($sql);
	$this->Messager("删除成功",'?mod=tttuangou&code=email');
	}

function Mainpay(){
	extract($this->Get);
	extract($this->Post);
	$sql='select * from '.TABLE_PREFIX.'tttuangou_payment order by pay_order asc';
	$query = $this->DatabaseHandler->Query($sql);
	$pay=$query->GetAll();
	include($this->TemplateHandler->Template('admin/tttuangou_paylist'));
	}
function Onlinepay(){
	extract($this->Get);
	extract($this->Post);
	$sql='update '.TABLE_PREFIX.'tttuangou_payment  set  is_online = if(is_online>0, 0, 1) where pay_id = '.$id;
	$query = $this->DatabaseHandler->Query($sql);
	$this->Messager("修改成功!");
	}
function Setpay(){
	extract($this->Get);
	extract($this->Post);
	$sql='select * from '.TABLE_PREFIX.'tttuangou_payment where pay_id = '.$id;
	$query = $this->DatabaseHandler->Query($sql);
	$pay=$query->Getrow();
	$cfg_value=unserialize($pay['pay_config']);
	$action='?mod=tttuangou&code=dosetpay';
	include($this->TemplateHandler->Template('admin/pay_'.$pay['pay_code']));
	}
function Dosetpay(){
	extract($this->Get);
	extract($this->Post);
		$ary=array(
		'pay_desc' => $pay_desc,
		'pay_order' => $pay_order,
		'pay_config' => serialize($cfg_value), 
	);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_payment');
	$result=$this->DatabaseHandler->Update($ary,'pay_id='.$mid);
	$this->Messager("修改成功","?mod=tttuangou&code=mainpay");
	}

function Ticketz(){
		$keyword=$this->Post['keyword']==''?$this->Get['keyword']:$this->Post['keyword'];
		$searchtype=$this->Post['type']==''?$this->Get['type']:$this->Post['type'];
		$time=$this->Post['time']==''?$this->Get['time']:$this->Post['time'];
		$used=$this->Post['used']==''?$this->Get['used']:$this->Post['used'];
		$addsql='';
		if($keyword!='' || $time!='' || $used!='' ){
			$addsql=' where 1 ';
			$type=$searchtype==1?'t.number':'m.username';
			if($keyword!='')$addsql.= ' and '.$type.' LIKE \'%'.$keyword.'%\'';
			if($time!='')$addsql.= ' and p.perioddate = \''.$time.'\'';
			if($used!='false')$addsql.= ' and t.status = '.$used.'';
		}
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p ON t.productid=p.id left join '.TABLE_PREFIX.'system_members m on t.uid = m.uid '.$addsql;
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		if($addsql!='' && $num==0)$this->Messager("符合该条件的团购券找不到",'?mod=tttuangou&code=ticket');
		$pagenum=30;		$page_arr = page($num,$pagenum,$query_link,$_config);

		$sql='SELECT t.*,p.name,m.username,p.perioddate FROM '.TABLE_PREFIX.'tttuangou_ticket t LEFT JOIN '.TABLE_PREFIX.'tttuangou_product p ON t.productid=p.id left join '.TABLE_PREFIX.'system_members m on t.uid = m.uid '.$addsql.' order by ticketid DESC limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql);
		$ticket=$query->GetAll();

		include($this->TemplateHandler->Template('admin/tttuangou_ticket'));
	}
function Deleteticket(){
	extract($this->Get);
	$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_ticket');
	$result=$this->DatabaseHandler->Delete('','ticketid='.intval($ticketid));
	$this->Messager("删除成功",'?mod=tttuangou&code=ticket');
	}

function Mainquestion(){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_question';
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=30;		$page_arr = page($num,$pagenum,$query_link,$_config);

		$sql='select * from '.TABLE_PREFIX.'tttuangou_question order by time desc limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$question=$query->GetAll();
		include($this->TemplateHandler->Template("admin/tttuangou_question"));
	}
function Replyquestion(){
		extract($this->Get);
		extract($this->Post);
		$sql='select * from '.TABLE_PREFIX.'tttuangou_question where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$action='?mod=tttuangou&code=doreplyquestion'; 
		$reply=$query->GetROW();
		if($reply==''){
			$this->Messager("找不到该提问!");
		};
		include($this->TemplateHandler->Template("admin/tttuangou_reply"));
	}
function Doreplyquestion(){
		extract($this->Get);
		extract($this->Post);
		$id=intval($id);
		if($id==false)$this->Messager("参数错误!");
		$ary=array(
			'reply' => $reply,
		);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_question');
		$result=$this->DatabaseHandler->Update($ary,'id='.$id);
		$this->Messager("操作成功","?mod=tttuangou&code=mainquestion");
		exit;
	}
	
	function Deletequestion(){
		$id=intval($this->Get['id']);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_question');
		$result=$this->DatabaseHandler->Delete('','id='.$id);
		$this->Messager($return ? $return : "操作成功","?mod=tttuangou&code=mainquestion");
	}

	function Mainfinder(){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_finder';
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=15;		$page_arr = page($num,$pagenum,$query_link,$_config);

		$sql='select f.*,p.name from '.TABLE_PREFIX.'tttuangou_finder f left join '.TABLE_PREFIX.'tttuangou_product p on p.id=f.productid   order by id desc limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$finder=$query->GetAll();
		if(!empty($finder)){
			$sql='select uid,truename,username,lastip from '.TABLE_PREFIX.'system_members';
			$query = $this->DatabaseHandler->Query($sql); 
			$user=$query->GetAll();
			$newuser=array();
			foreach($user as $value){
				$newuser[$value['uid']]=$value;
			};
		}
		unset($user);
		include($this->TemplateHandler->Template("admin/tttuangou_finder"));
	}
	
	function Yesfinder(){
		extract($this->Get);
		$this -> config=ConfigHandler::get('product');
				$sql='select * from '.TABLE_PREFIX.'tttuangou_finder where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql); 
		$finder=$query->GetRow();
		if($finder=='' || $finder['status']!=1){
			$this->Messager('返利出现错误！');
		};
		if(!empty($finder)){
			$sql='select uid,truename,username,lastip from '.TABLE_PREFIX.'system_members';
			$query = $this->DatabaseHandler->Query($sql); 
			$user=$query->GetAll();
			$newuser=array();
			foreach($user as $value){
				$newuser[$value['uid']]=$value;
			};
		}
		$this->MeLogic->moneyAdd($this->config['default_payfinder'],$finder['finderid']);
		$ary=array(
			'userid' => $finder['finderid'],
			'type' => 1,
			'name' => '邀请返利',
			'intro' => '您获得来自邀请的好友<a href=http://u.shenei.net/?'.$finder['buyid'].' target=_blank>'.$newuser[$finder['buyid']]['username'].'</a>的购买返利'.$this->config['default_payfinder'].'元',
			'money' => $this->config['default_payfinder'],
			'time' => time(),
		);
		$this->MeLogic->moneyLog($ary);
				$sql='update '.TABLE_PREFIX.'tttuangou_finder set status = 2 where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql); 
				$sql='select username,email from '.TABLE_PREFIX.'system_members where uid = '.$finder['finderid'];
		$query = $this->DatabaseHandler->Query($sql); 
		$mail=$query->GetRow();
				$sql='select username,email from '.TABLE_PREFIX.'system_members where uid = '.$finder['buyid'];
		$query = $this->DatabaseHandler->Query($sql); 
		$finder=$query->GetRow();
				$set=ConfigHandler::get('product');
		$mail['title']=$mail['username'].'：您邀请好友购买商品获得'.$this->config['default_payfinder'].'元返利！';
		$mail['content']=$mail['username'].'：感谢您对我们的支持，您的好友'.$finder['username'].'通过您的邀请并顺利购买商品。<br/>您因此获得'.$this->config['default_payfinder'].'元返利。快来看看<a href="'.$this->Config[site_url].'">今日最新团购</a>';
		sendmail($mail['truename'],$mail['email'],$mail['title'],$mail['content'],$set);
		$this->Messager("已经通过验证，并返利".$this->config['default_payfinder']."元！");
	}
	
	function Nofinder(){
		extract($this->Get);
				$sql='update '.TABLE_PREFIX.'tttuangou_finder set status = 0 where id = '.$id;
		$query = $this->DatabaseHandler->Query($sql);
		$this->Messager("取消成功！"); 
	}
	
	function Deletefinder(){
		extract($this->Get);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_finder');
		$result=$this->DatabaseHandler->Delete('','id='.intval($id));
		$this->Messager("操作成功",'?mod=tttuangou&code=mainfinder');
	}
	
	function Usermsg(){
		$page=intval($_REQUEST['page'])==false?1:intval($_REQUEST['page']);
		$sql='SELECT count(*) FROM '.TABLE_PREFIX.'tttuangou_usermsg';
		$query = $this->DatabaseHandler->Query($sql); 
		$num=$query->GetRow();
		$num=$num['count(*)'];
		$pagenum=15;		$page_arr = page($num,$pagenum,$query_link,$_config);
		$sql='select `id`,`name`,`time`,`type`,`readed` FROM '.TABLE_PREFIX.'tttuangou_usermsg order by `time` desc limit '.($page-1)*$pagenum.','.$pagenum;
		$query = $this->DatabaseHandler->Query($sql); 
		$usermsg=$query->GetAll();
		include($this->TemplateHandler->Template("admin/tttuangou_usermsg"));
	}
	
	function Readusermsg(){
		$sql='select *  from  '.TABLE_PREFIX.'tttuangou_usermsg where `id` = '.intval($this->Get['id']);
		$query = $this->DatabaseHandler->Query($sql); 
		$msg=$query->GetRow();
		if($msg['readed']==0){
			$ary=array(
				'readed'=>1,
			);
			$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_usermsg');
			$result=$this->DatabaseHandler->Update($ary,'id='.$msg['id']);
		}
		if($msg=='')$this->Messager("该信息不存在!");
		include($this->TemplateHandler->Template("admin/tttuangou_readusermsg"));
	}
	function Deleteusermsg(){
		extract($this->Get);
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_usermsg');
		$result=$this->DatabaseHandler->Delete('','id='.intval($id));
		$this->Messager("操作成功",'?mod=tttuangou&code=usermsg');
	}
}
?>