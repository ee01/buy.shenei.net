<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename load.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 

class Load
{
	function functions($name)
	{
		return include_once(FUNCTION_PATH.$name.'.func.php');
	}
	function logic($name)
	{
		return include_once(LOGIC_PATH.$name.'.logic.php');
	}
	function lib($name)
	{
		return include_once(LIB_PATH.$name.'.han.php');
	}
}
?>