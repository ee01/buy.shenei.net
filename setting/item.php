<?php
/**
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 ϵͳ����
 *
 * @author ����<foxis@qq.com>
 * @since 2009��9��2�� 
 * @package www.tttuangou.net
 */
global $_LANG;
$config['item']=
array
(
	'member'=>array
	(
		'table_name'	=>TABLE_PREFIX. 'system_members',	//*���� 	���������
		'pri_field'		=>'uid',			//ѡ�� 	������������ֶ��� ����Ĭ��Ϊ "id"
		'name_field'	=>'username',			//ѡ�� 	�������Ƶ��ֶ��� ����Ĭ��Ϊ "id"
		'view_url'		=>'index.php?mod=member&code=view&id=%s',//*���� ����鿴�ĵ�ַ��ʽ
		'name'			=>$_LANG['member'],	//	�������������
		'photo_field'	=>"face",
		'photo_path'	=>"face",
	),
	
);

?>