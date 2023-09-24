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
    'title' => '控制面板首页',
    'link' => '?mod=admin&code=home',
  ),
  2 => 
  array (
    'title' => '系统设置',
    'link' => '?mod=admin&code=home',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '核心设置',
        'link' => 'admin.php?mod=setting&code=modify_normal',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => 'URL地址设置',
        'link' => 'admin.php?mod=setting&code=modify_rewrite',
        'shortcut' => false,
      ),
      4 => 
      array (
        'title' => '内容过滤设置',
        'link' => 'admin.php?mod=setting&code=modify_filter',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '友情链接设置',
        'link' => 'admin.php?mod=link',
        'shortcut' => false,
      ),
      11 => 
      array (
        'title' => 'IP访问控制',
        'link' => 'admin.php?mod=setting&code=modify_access',
        'shortcut' => true,
      ),
      15 => 
      array (
        'title' => '修改管理员密码',
        'link' => 'admin.php?mod=member&code=modify&id=1',
        'shortcut' => true,
      ),
      17 => 
      array (
        'title' => '设置快捷方式',
        'link' => 'admin.php?mod=setting&code=modify_shortcut',
        'shortcut' => true,
      ),
    ),
  ),
  4 => 
  array (
    'title' => '舍内团秒',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '系统定义',
        'link' => 'admin.php?mod=tttuangou&code=varshow',
        'shortcut' => true,
      ),
      7 => 
      array (
        'title' => '支付管理',
        'link' => 'admin.php?mod=tttuangou&code=mainpay',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '城市管理',
        'link' => 'admin.php?mod=tttuangou&code=city',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '商家管理',
        'link' => 'admin.php?mod=tttuangou&code=mainseller',
        'shortcut' => false,
      ),
      3 => 
      array (
        'title' => '产品管理',
        'link' => 'admin.php?mod=tttuangou&code=listproduct',
        'shortcut' => true,
      ),
      4 => 
      array (
        'title' => '订单管理',
        'link' => 'admin.php?mod=tttuangou&code=listorder',
        'shortcut' => true,
      ),
      8 => 
      array (
        'title' => '团购券管理',
        'link' => 'admin.php?mod=tttuangou&code=ticket',
        'shortcut' => false,
      ),
      10 => 
      array (
        'title' => '返利管理',
        'link' => 'admin.php?mod=tttuangou&code=mainfinder',
        'shortcut' => false,
      ),
      5 => 
      array (
        'title' => '邮件管理',
        'link' => 'admin.php?mod=tttuangou&code=mail',
        'shortcut' => false,
      ),
      6 => 
      array (
        'title' => '订阅管理',
        'link' => 'admin.php?mod=tttuangou&code=email',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '问答管理',
        'link' => 'admin.php?mod=tttuangou&code=mainquestion',
        'shortcut' => false,
      ),
      11 => 
      array (
        'title' => '计划任务',
        'link' => 'admin.php?mod=task',
        'shortcut' => false,
      ),
      12 => 
      array (
        'title' => '反馈信息',
        'link' => 'admin.php?mod=tttuangou&code=usermsg',
        'shortcut' => false,
      ),
    ),
  ),
  5 => 
  array (
    'title' => '系统工具',
    'link' => '',
    'sub_menu_list' => 
    array (
      1 => 
      array (
        'title' => '清空系统缓存',
        'link' => 'admin.php?mod=cache',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '蜘蛛爬行统计',
        'link' => 'admin.php?mod=robot',
        'shortcut' => true,
      ),
      6 => 
      array (
        'title' => '关键词排名',
        'link' => 'http://keyword.biniu.com',
        'shortcut' => true,
      ),
      7 => 
      array (
        'title' => 'alexa排名',
        'link' => 'http://alexa.biniu.com',
        'shortcut' => false,
      ),
      8 => 
      array (
        'title' => '友情链接检测',
        'link' => 'http://checklink.biniu.com',
        'shortcut' => true,
      ),
      9 => 
      array (
        'title' => '收录查询',
        'link' => 'http://shoulu.biniu.com',
        'shortcut' => true,
      ),
      10 => 
      array (
        'title' => '同IP网站',
        'link' => 'http://sameip.biniu.com',
        'shortcut' => true,
      ),
      11 => 
      array (
        'title' => '反向链接分析',
        'link' => 'http://backlink.biniu.com',
        'shortcut' => true,
      ),
    ),
  ),
  6 => 
  array (
    'title' => '数据库管理',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '数据备份',
        'link' => 'admin.php?mod=db&code=export',
        'shortcut' => true,
      ),
      1 => 
      array (
        'title' => '数据恢复',
        'link' => 'admin.php?mod=db&code=import',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '数据表优化',
        'link' => 'admin.php?mod=db&code=optimize',
        'shortcut' => true,
      ),
    ),
  ),
  7 => 
  array (
    'title' => '用户管理',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => 'Ucenter整合',
        'link' => 'admin.php?mod=ucenter',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '+添加新用户',
        'link' => 'admin.php?mod=member&code=add',
        'shortcut' => false,
      ),
      2 => 
      array (
        'title' => '编辑用户',
        'link' => 'admin.php?mod=member&code=search',
        'shortcut' => false,
      ),
      3 => 
      array (
        'title' => '当前在线用户',
        'link' => 'admin.php?mod=sessions',
        'shortcut' => false,
      ),
    ),
  ),
  8 => 
  array (
    'title' => '角色管理',
    'link' => '?mod=admin&code=home',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '管理员角色',
        'link' => 'admin.php?mod=role&code=list&type=admin',
        'shortcut' => false,
      ),
      1 => 
      array (
        'title' => '普通用户角色',
        'link' => 'admin.php?mod=role&code=list&type=normal',
        'shortcut' => false,
      ),
      2 => 
      array (
        'title' => '+添加用户角色',
        'link' => 'admin.php?mod=role&code=add',
        'shortcut' => false,
      ),
    ),
  ),
); ?>