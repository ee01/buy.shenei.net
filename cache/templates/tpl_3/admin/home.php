<? include $this->TemplateHandler->template('admin/header'); ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr> <td>����汾��<?=SYS_VERSION?>&nbsp;<?=SYS_BUILD?></b>&nbsp;&nbsp;[<a href="admin.php?mod=upgrade"><b>������</b></a>]
<? if($new_version && $new_version['version']) { ?>
 <br />
��ǰ�İ汾��<b><?=SYS_VERSION?>&nbsp;<?=SYS_BUILD?></b> �������ϵ��°汾��<b><?=$new_version['version']?>&nbsp;<?=$new_version['build']?></b>��<a href="admin.php?mod=upgrade"><span style="color:red;"><u><b>��˽�����������</b></u></span></a> 
<? } ?>
</td> </table> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL ndt">�ٷ����¶�̬</div> </td> </tr> <tr class="altbg1"> <td>
<? if(is_array($recommend_list)) { foreach($recommend_list as $r) { ?>
<li class="liS"><a href=<?=$r['url']?> target=_blank><?=$r['name']?></a></li>
<? } } ?>
</td> </tr> </table> 
<? if($shortcut_list) { ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="2"> <div class="NavaL nkj">��̨������ݷ�ʽ</div> <span class="NavaR"><a href="admin.php?mod=setting&code=modify_shortcut">���ÿ�ݷ�ʽ</a></span> </td> </tr> 
<? if(is_array($shortcut_list)) { foreach($shortcut_list as $cate => $menu_list) { ?>
 <tr> <td class="altbg1" width="12%"><b><?=$cate?></b></td> <td class="altbg2"><div style="padding:5px"> 
<? if(is_array($menu_list)) { foreach($menu_list as $menu) { ?>
 <A HREF="<?=$menu['link']?>" class="abutton"><?=$menu['title']?></A> 
<? } } ?>
 </div></td> </tr> 
<? } } ?>
 </table> 
<? } ?>
<table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL nlj">ϵͳ�ٷ�����</div> </td> </tr> <tr class="altbg1"> <td><A HREF="http://cenwor.com/forum-13-1.html" target="_blank" title="�����Ź����۽���">BBS���۽���</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=2" target=_blank>��������</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=3" target=_blank>Bug����</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=4" target=_blank>ģ����</A></td> <td><A HREF="http://cenwor.com/forumdisplay.php?fid=13&filter=type&typeid=5" target=_blank>��չ����</A></td> </tr> </table>
<? if(0) { ?>
<table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="12"> <div class="NavaL ntj">���ϵͳ�Ƽ�</div> </td> </tr> <tr class="altbg1"> <td><A HREF="http://aijuhe.net/money" target=_blank>���ۺ�ר����׬ϵͳ</A></td> <td><A HREF="http://www.ijuhe.net/usd.html" target=_blank>iJuheӢ����׬ϵͳ</A></td> <td><A HREF="http://www.wangzhuanbao.net/qian.html" target=_blank>��׬�����ܲɼ���αԭ��ϵͳ</A></td> <td><A HREF="http://www.jishigou.net" target=_blank>���¹�΢��ϵͳ</A></td> </tr> 
<? if($check_upgrade) { ?>
 <script language="JavaScript" type="text/javascript" src="admin.php?mod=upgrade&code=check&js=1"></script>
<? } ?>
<? } ?>
<? include $this->TemplateHandler->template('admin/footer'); ?>