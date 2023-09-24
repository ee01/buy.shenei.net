<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename getseller.mod.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 

class ModuleObject extends MasterObject
{
	var $Config = array(); 	var $ID;

	function ModuleObject(& $config){
		$this->MasterObject($config);
		$this->initMemberHandler();
		$this->ID=$this->Post['id']?(int)$this->Post['id']:(int)$this->Get['id'];
		$this->Execute();
	}

	function Execute(){
		$this->Showseller();
	}

	function Showseller(){
		$id=$this->Get['city'];
		$sql='SELECT * FROM '.TABLE_PREFIX.'tttuangou_seller where area = '.intval($id);
		$query = $this->DatabaseHandler->Query($sql); 
		$seller=$query->GetAll();
		if(empty($seller)){echo '‘›Œﬁ…Ãº“';exit;}
		echo '<select name="sellerid" id="sellerid">';
		foreach($seller as $i => $value){
			echo '<option value="'.$value['id'].'">'.$value['sellername'].'</option>';
		}
		echo ' </select>';	
		exit;
	}
}
?>