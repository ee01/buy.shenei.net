<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename admin_left_menu.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 
 $menu_list = array (
  1 => 
  array (
    'title' => '���������ҳ',
    'link' => '?mod=admin&code=home',
  ),
  2 => 
  array (
    'title' => 'ϵͳ����',
    'link' => '?mod=admin&code=home',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=setting&code=modify_normal',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => 'URL��ַ����',
        'link' => 'admin.php?mod=setting&code=modify_rewrite',
        'shortcut' => false,
      ),
      4 => 
      array (
        'title' => '���ݹ�������',
        'link' => 'admin.php?mod=setting&code=modify_filter',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '������������',
        'link' => 'admin.php?mod=link',
        'shortcut' => false,
      ),
      11 => 
      array (
        'title' => 'IP���ʿ���',
        'link' => 'admin.php?mod=setting&code=modify_access',
        'shortcut' => true,
      ),
      15 => 
      array (
        'title' => '�޸Ĺ���Ա����',
        'link' => 'admin.php?mod=member&code=modify&id=1',
        'shortcut' => true,
      ),
      17 => 
      array (
        'title' => '���ÿ�ݷ�ʽ',
        'link' => 'admin.php?mod=setting&code=modify_shortcut',
        'shortcut' => true,
      ),
    ),
  ),
  4 => 
  array (
    'title' => '��������',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => 'ϵͳ����',
        'link' => 'admin.php?mod=tttuangou&code=varshow',
        'shortcut' => true,
      ),
      7 => 
      array (
        'title' => '֧������',
        'link' => 'admin.php?mod=tttuangou&code=mainpay',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '���й���',
        'link' => 'admin.php?mod=tttuangou&code=city',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '�̼ҹ���',
        'link' => 'admin.php?mod=tttuangou&code=mainseller',
        'shortcut' => false,
      ),
      3 => 
      array (
        'title' => '��Ʒ����',
        'link' => 'admin.php?mod=tttuangou&code=listproduct',
        'shortcut' => true,
      ),
      4 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=tttuangou&code=listorder',
        'shortcut' => true,
      ),
      8 => 
      array (
        'title' => '�Ź�ȯ����',
        'link' => 'admin.php?mod=tttuangou&code=ticket',
        'shortcut' => false,
      ),
      10 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=tttuangou&code=mainfinder',
        'shortcut' => false,
      ),
      5 => 
      array (
        'title' => '�ʼ�����',
        'link' => 'admin.php?mod=tttuangou&code=mail',
        'shortcut' => false,
      ),
      6 => 
      array (
        'title' => '���Ĺ���',
        'link' => 'admin.php?mod=tttuangou&code=email',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '�ʴ����',
        'link' => 'admin.php?mod=tttuangou&code=mainquestion',
        'shortcut' => false,
      ),
      11 => 
      array (
        'title' => '�ƻ�����',
        'link' => 'admin.php?mod=task',
        'shortcut' => false,
      ),
      12 => 
      array (
        'title' => '������Ϣ',
        'link' => 'admin.php?mod=tttuangou&code=usermsg',
        'shortcut' => false,
      ),
    ),
  ),
  5 => 
  array (
    'title' => 'ϵͳ����',
    'link' => '',
    'sub_menu_list' => 
    array (
      1 => 
      array (
        'title' => '���ϵͳ����',
        'link' => 'admin.php?mod=cache',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '֩������ͳ��',
        'link' => 'admin.php?mod=robot',
        'shortcut' => true,
      ),
      6 => 
      array (
        'title' => '�ؼ�������',
        'link' => 'http://keyword.biniu.com',
        'shortcut' => true,
      ),
      7 => 
      array (
        'title' => 'alexa����',
        'link' => 'http://alexa.biniu.com',
        'shortcut' => false,
      ),
      8 => 
      array (
        'title' => '�������Ӽ��',
        'link' => 'http://checklink.biniu.com',
        'shortcut' => true,
      ),
      9 => 
      array (
        'title' => '��¼��ѯ',
        'link' => 'http://shoulu.biniu.com',
        'shortcut' => true,
      ),
      10 => 
      array (
        'title' => 'ͬIP��վ',
        'link' => 'http://sameip.biniu.com',
        'shortcut' => true,
      ),
      11 => 
      array (
        'title' => '�������ӷ���',
        'link' => 'http://backlink.biniu.com',
        'shortcut' => true,
      ),
    ),
  ),
  6 => 
  array (
    'title' => '���ݿ����',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '���ݱ���',
        'link' => 'admin.php?mod=db&code=export',
        'shortcut' => true,
      ),
      1 => 
      array (
        'title' => '���ݻָ�',
        'link' => 'admin.php?mod=db&code=import',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '���ݱ��Ż�',
        'link' => 'admin.php?mod=db&code=optimize',
        'shortcut' => true,
      ),
    ),
  ),
  7 => 
  array (
    'title' => '�û�����',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => 'Ucenter����',
        'link' => 'admin.php?mod=ucenter',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '+�������û�',
        'link' => 'admin.php?mod=member&code=add',
        'shortcut' => false,
      ),
      2 => 
      array (
        'title' => '�༭�û�',
        'link' => 'admin.php?mod=member&code=search',
        'shortcut' => false,
      ),
      3 => 
      array (
        'title' => '��ǰ�����û�',
        'link' => 'admin.php?mod=sessions',
        'shortcut' => false,
      ),
    ),
  ),
  8 => 
  array (
    'title' => '��ɫ����',
    'link' => '?mod=admin&code=home',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '����Ա��ɫ',
        'link' => 'admin.php?mod=role&code=list&type=admin',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '��ͨ�û���ɫ',
        'link' => 'admin.php?mod=role&code=list&type=normal',
        'shortcut' => false,
      ),
      2 => 
      array (
        'title' => '+�����û���ɫ',
        'link' => 'admin.php?mod=role&code=add',
        'shortcut' => false,
      ),
    ),
  ),
); ?>