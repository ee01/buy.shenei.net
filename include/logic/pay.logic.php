<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename pay.logic.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 


class PayLogic{	
	var $DatabaseHandler;
	var $Config;
	
	function PayLogic(){
		$this->DatabaseHandler = &Obj::registry("DatabaseHandler");
		$this->Config = &Obj::registry("config");
	}
	
	function payType(){		$sql='select *  from '.TABLE_PREFIX.'tttuangou_payment where is_online = 1 order by pay_order asc ';
		$query = $this->DatabaseHandler->Query($sql);
		$pay=$query->GetAll();
				foreach($pay as $i => $value){
			if($value['pay_config']=='' && $value['is_cod']!=1){
				unset($pay[$i]);
			}
		}
		return $pay;
	}
	
	function payChoose($type){		$sql='select * from '.TABLE_PREFIX.'tttuangou_payment where pay_id   = '.intval($type);
		$query = $this->DatabaseHandler->Query($sql);
		$pay=$query->GetRow();
		return $pay;
	}
	
}

?>