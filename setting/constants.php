<?php

/*
+------------------------------------------------------------------------------
+ �������Ϣ
+------------------------------------------------------------------------------
*/
define('SYS_NAME',			$config['site_name']);		//system name
define('SYS_VERSION',		'1.0.1');
define('SYS_BUILD',			'build 20101109');
define('SYS_PATH',			'./');

//�������
define('GZIP',				(boolean) $config['gzip']);


//��ȫģʽ
//define('SYSTEM_SAFE_MODE',	(boolean) $config['safe_mode']);

/*
+------------------------------------------------------------------------------
+ ͼƬ��ص���Ϣ
+------------------------------------------------------------------------------
*/

define('SMALL_PIC_PREFIX',	's-');
define('WATERMARK_PIC_PREFIX',	'w-');
define('SMALL_PIC_WIDTH',	89);
define('SMALL_PIC_HEIGHT',	89);

define('TABLE_PREFIX',				$config['db_table_prefix']);


//Ucenter ����
@include_once(ROOT_PATH . './setting/ucenter.php');

define('UCENTER' , 			(boolean) $config['ucenter']['enable']);//��ʶUcenter�Ƿ��Ѿ�����
	
define('UC_CLIENT_ROOT', 	ROOT_PATH . './uc_client/');

if (true === UCENTER) {

define('UC_CONNECT', 		$config['ucenter']['uc_connect']);	// ���� UCenter �ķ�ʽ: mysql/NULL, Ĭ��Ϊ��ʱΪ fscoketopen()

//���ݿ���� (mysql ����ʱ, ����û������ UC_DBLINK ʱ, ��Ҫ�������±���)
define('UC_DBHOST',		 	$config['ucenter']['uc_db_host']);			// UCenter ���ݿ�����
define('UC_DBUSER', 		$config['ucenter']['uc_db_user']);				// UCenter ���ݿ��û���
define('UC_DBPW', 			$config['ucenter']['uc_db_password']);					// UCenter ���ݿ�����
define('UC_DBNAME', 		$config['ucenter']['uc_db_name']);				// UCenter ���ݿ�����
define('UC_DBCHARSET',		$config['ucenter']['uc_db_charset'] ? $config['ucenter']['uc_db_charset'] : 'gbk');				// UCenter ���ݿ��ַ���
define('UC_DBTABLEPRE', 	$config['ucenter']['uc_db_table_prefix']);			// UCenter ���ݿ��ǰ׺

//ͨ�����
define('UC_KEY', 			$config['ucenter']['uc_key']);				// �� UCenter ��ͨ����Կ, Ҫ�� UCenter ����һ��
define('UC_API', 			$config['ucenter']['uc_api']);	// UCenter �� URL ��ַ, �ڵ���ͷ��ʱ�����˳���
define('UC_CHARSET', 		$config['ucenter']['uc_charset'] ? $config['ucenter']['uc_charset'] : 'gbk');				// UCenter ���ַ���
define('UC_IP', 			$config['ucenter']['uc_ip']);					// UCenter �� IP, �� UC_CONNECT Ϊ�� mysql ��ʽʱ, ���ҵ�ǰӦ�÷�������������������ʱ, �����ô�ֵ
define('UC_APPID', 			$config['ucenter']['uc_app_id']);					// ��ǰӦ�õ� ID
	
}


?>