<? include $this->TemplateHandler->template('admin/header'); ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr> <td>程序版本：<?=SYS_VERSION?>&nbsp;<?=SYS_BUILD?></b>&nbsp;&nbsp;[<a href="admin.php?mod=upgrade"><b>检查更新</b></a>]
<? if($new_version && $new_version['version']) { ?>
 <br />
当前的版本：<b><?=SYS_VERSION?>&nbsp;<?=SYS_BUILD?></b> 服务器上的新版本：<b><?=$new_version['version']?>&nbsp;<?=$new_version['build']?></b>，<a href="admin.php?mod=upgrade"><span style="color:red;"><u><b>点此进行在线升级</b></u></span></a> 
<? } ?>
</td> </table> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL ndt">官方最新动态</div> </td> </tr> <tr class="altbg1"> <td>
<? if(is_array($recommend_list)) { foreach($recommend_list as $r) { ?>
<li class="liS"><a href=<?=$r['url']?> target=_blank><?=$r['name']?></a></li>
<? } } ?>
</td> </tr> </table> 
<? if($shortcut_list) { ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="2"> <div class="NavaL nkj">后台管理快捷方式</div> <span class="NavaR"><a href="admin.php?mod=setting&code=modify_shortcut">设置快捷方式</a></span> </td> </tr> 
<? if(is_array($shortcut_list)) { foreach($shortcut_list as $cate => $menu_list) { ?>
 <tr> <td class="altbg1" width="12%"><b><?=$cate?></b></td> <td class="altbg2"><div style="padding:5px"> 
<? if(is_array($menu_list)) { foreach($menu_list as $menu) { ?>
 <A HREF="<?=$menu['link']?>" class="abutton"><?=$menu['title']?></A> 
<? } } ?>
 </div></td> </tr> 
<? } } ?>
 </table> 
<? } ?>
<table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL nlj">系统官方链接</div> </td> </tr> <tr class="altbg1"> <td><A HREF="http://cenwor.com/forum-13-1.html" target="_blank" title="天天团购讨论交流">BBS讨论交流</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=2" target=_blank>问题求助</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=3" target=_blank>Bug反馈</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=4" target=_blank>模板风格</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=5" target=_blank>发展建议</A></td> </tr> </table>
<? if(0) { ?>
<table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL ntj">相关系统推荐</div> </td> </tr> <tr class="altbg1"> <td><A HREF="http://aijuhe.net/money" target=_blank>爱聚合专题网赚系统</A></td> <td><A HREF="http://www.ijuhe.net/usd.html" target=_blank>iJuhe英文网赚系统</A></td> <td><A HREF="http://www.wangzhuanbao.net/qian.html" target=_blank>网赚宝智能采集和伪原创系统</A></td> <td><A HREF="http://www.jishigou.net" target=_blank>记事狗微博系统</A></td> </tr> 
<? if($check_upgrade) { ?>
 <script language="JavaScript" type="text/javascript" src="admin.php?mod=upgrade&code=check&js=1"></script>
<? } ?>
<? } ?>
<? include $this->TemplateHandler->template('admin/footer'); ?>