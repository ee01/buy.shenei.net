<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename product.logic.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


class ProductLogic
{	
	var $DatabaseHandler;
	var $Config;
	var $nowdate;

	function ProductLogic(){
		$this->DatabaseHandler = &Obj::registry("DatabaseHandler");
		$this->CookieHandler = &Obj::registry("CookieHandler");
		$this->Config = &Obj::registry("config");
		$this->nowdate= date('Y-m-d H:i:s',time());
	}
	
	function productGet($id,$city, $type = 0){
		if($type == 1) {
			$where_type = 'is_seckill = 1 and';
		}elseif($type == 2) {
			$where_type = 'is_seckill = 0 and';
		}else{
			$where_type = '';
		}
		$sql='select p.*,s.sellername,s.sellerphone,s.selleraddress,sellerurl,sellermap,totalnum from '.TABLE_PREFIX.'tttuangou_product p LEFT join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id where '.$where_type.' overtime <= \''.$this -> nowdate.'\' and p.id = '.intval($id).'  and city = '.intval($city);
		$query = $this->DatabaseHandler->Query($sql);
		$product=$query->GetRow();
		if(empty($product))return false;
		$product['agio'] = round(10/($product['price']/$product['nowprice']),1);
		$overtime=strtotime($product['overtime']);
		$product['time']=$overtime-time();
		$product['num']=$product['totalnum'];
		$product['success']=$product['successnum']-$product['num'];
		return $product;
	}
	
	function productNow($city, $type = 0){
		$product=array();
		$sql_All='select p.*,s.sellername,s.sellerphone,selleraddress,sellerurl,sellermap,totalnum from '.TABLE_PREFIX.'tttuangou_product p LEFT join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id where overtime > \''.$this -> nowdate.' \' and display = 1 and city = '.intval($city);
		$sql_GroupBuy='select p.*,s.sellername,s.sellerphone,selleraddress,sellerurl,sellermap,totalnum from '.TABLE_PREFIX.'tttuangou_product p LEFT join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id where is_seckill = 0 and begintime <= \''.$this -> nowdate.'\' and overtime > \''.$this -> nowdate.' \' and display = 1 and city = '.intval($city);
		$sql_SecKill='select p.*,s.sellername,s.sellerphone,selleraddress,sellerurl,sellermap,totalnum from '.TABLE_PREFIX.'tttuangou_product p LEFT join '.TABLE_PREFIX.'tttuangou_seller s on p.sellerid=s.id where is_seckill = 1 and overtime > \''.$this -> nowdate.' \' and display = 1 and city = '.intval($city);
		if($type == 1) {
			$query = $this->DatabaseHandler->Query($sql_SecKill);
			$product=$query->GetRow();
		}elseif($type == 2) {
			$query = $this->DatabaseHandler->Query($sql_GroupBuy);
			$product=$query->GetRow();
		}else{
			$query = $this->DatabaseHandler->Query($sql_SecKill);
			$product=$query->GetRow();
			if(empty($product)) {
				$query = $this->DatabaseHandler->Query($sql_All);
				$product=$query->GetRow();
			}
		}
		if(empty($product))return false;
		$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_order where (status<>0 or pay <>0) and productid='.$product['id'];
		$query = $this->DatabaseHandler->Query($sql);
		$ordernum=$query->result();
		$product['ordernum']=$ordernum;
		$product['agio'] = round(10/($product['price']/$product['nowprice']),1);
		$overtime=strtotime($product['overtime']);
		$begintime=strtotime($product['begintime']);
		$product['time']=$overtime-time();
		$product['time0']=$begintime-time();
		$product['last']=$overtime-$begintime;
		$product['num']=$product['totalnum'];
		$product['success']=$product['successnum']-$product['num'];
		return $product;
	}
	
	function productCheck($id,$city=''){		if($city!=''){
			$sql='select * from '.TABLE_PREFIX.'tttuangou_product where begintime <= \''.$this -> nowdate.'\' and overtime > \''.$this -> nowdate.' \' and id = '.$id.' and city = '.intval($city);
		}else{
			$sql='select * from '.TABLE_PREFIX.'tttuangou_product where begintime <= \''.$this -> nowdate.'\' and overtime > \''.$this -> nowdate.' \' and id = '.$id;
		}
		$query = $this->DatabaseHandler->Query($sql);
		$product=$query->GetRow();
		return ($product==''?false:$product);
	}
	
	function productNum($maxnum,$id){		$sql='select sum(productnum) from '.TABLE_PREFIX.'tttuangou_order where productid = '.intval($id).' and pay = 1';
		$query = $this->DatabaseHandler->Query($sql);
		$result=$query->GetRow();
		$num=$result['sum(productnum)'];
		$surplusnum=$maxnum-$num;
		return $surplusnum;
	}
	
	function productBuyed($id){
		$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_order where productid = '.intval($id).' and userid= '.MEMBER_ID.' and pay=1 ';
		$query = $this->DatabaseHandler->Query($sql);
		$buy=$query->GetRow();
		return $buy['count(*)']==0?false:true;
	}
	
	function ProductSelled($id){
		$sql='select count(*) from '.TABLE_PREFIX.'tttuangou_order where productid = '.intval($id).' and pay = 1';
		$query = $this->DatabaseHandler->Query($sql);
		$result=$query->GetRow();
		return $result['count(*)'];
	}
	
	function productTypedit($id,$type){
		$ary=array(
			'status' => $type,
		);
		if($type==2){
			$sql='select sellerid from '.TABLE_PREFIX.'tttuangou_product where id = '.intval($id);
			$query = $this->DatabaseHandler->Query($sql); 
			$product=$query->GetRow();
			$this -> AddSellerSucNum($product['sellerid']);
		}
		$this->DatabaseHandler->SetTable(TABLE_PREFIX.'tttuangou_product');
		$result=$this->DatabaseHandler->Update($ary,'id='.intval($id));
	}
	
	function citychange(){
		$this -> config=ConfigHandler::get('product');
				$cityary=$this->getcity();
				if($_GET['city']!=''){
			foreach($cityary as $value){
				if($value['shorthand'] == $_GET['city']){
					$this->CookieHandler->setVar('mycity',$value['cityid']);
					$city =$value['cityid'];
					break;
				};
			};
		};
				if($city == ''){
			if($this->CookieHandler->getVar('mycity')!=''){
				$city = $this->CookieHandler->getVar('mycity');
			}else{
				$city=1;
			};
		};
				foreach($cityary as $value){
			if($value['cityid'] == $city){
				$cityname = $value['cityname'];
				break;
			};
		};
		$cityary=array(
			'0' => $cityary,
			'1'  => $city,
			'2'=> $cityname
		);
		return $cityary;
	}
	
	function getcity($id=''){
		if($id==''){
			$sql='select * from '.TABLE_PREFIX.'tttuangou_city where display=1';
			$query = $this->DatabaseHandler->Query($sql);
			$city=$query->GetAll();
		}else{
			$sql='select * from '.TABLE_PREFIX.'tttuangou_city where cityid = '.intval($id);
			$query = $this->DatabaseHandler->Query($sql);
			$city=$query->GetRow();
		}
		return $city;
	}
	
	function getcitylist(){
		$sql='select * from '.TABLE_PREFIX.'tttuangou_city';
		$query = $this->DatabaseHandler->Query($sql);
		$city=$query->GetAll();
		return $city;
	}
	
	function ProductUp(){		$sql='update '.TABLE_PREFIX.'tttuangou_product set status=0 where overtime <=\''.$this -> nowdate.'\' and `status` = 1 ';
		$query = $this->DatabaseHandler->Query($sql); 
		return true;
	}
	function AddSellerProNum($sellerid){
		$sql='update '.TABLE_PREFIX.'tttuangou_seller set productnum = productnum + 1 where id = '.intval($sellerid);
		$query = $this->DatabaseHandler->Query($sql); 
		return true;
	}
	function DelSellerProNum($sellerid){
		$sql='update '.TABLE_PREFIX.'tttuangou_seller set productnum = productnum - 1 where id = '.intval($sellerid);
		$query = $this->DatabaseHandler->Query($sql); 
		return true;
	}
	function AddSellerSucNum($sellerid){
		$sql='update '.TABLE_PREFIX.'tttuangou_seller set successnum = successnum + 1 where id = '.intval($sellerid);
		$query = $this->DatabaseHandler->Query($sql); 
		return true;
	}
	function AddSellerTotMoney($sellerid,$money){
		$sql='update '.TABLE_PREFIX.'tttuangou_seller set money = money + '.$money.' where id = '.intval($sellerid);
		$query = $this->DatabaseHandler->Query($sql); 
	}
function delSellerTotMoney($sellerid,$money){
		$sql='update '.TABLE_PREFIX.'tttuangou_seller set money = money - '.$money.' where id = '.intval($sellerid);
		$query = $this->DatabaseHandler->Query($sql); 
	}
}

?>