<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=gbk"> <link rel="stylesheet" type="text/css" href="./templates/default/styles/admincp.css"> <script>
var is_ie = document.all ? true : false;
var is_ff = window.addEventListener ? true : false;
function refreshmainframe(e) {
e = e ? e : window.event;
actualCode = e.keyCode ? e.keyCode : e.charCode;
if(actualCode == 116) {
parent.main.location.reload();
if(is_ie) {
e.keyCode = 0;
e.returnValue = false;
} else {
e.preventDefault();
}
}
}
</script> </head> <body leftmargin="3" topmargin="3" onkeydown="refreshmainframe(event)"> <br> <table width="146" border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style=" float:left;*margin:0 0 0px 0px;margin:0 0 0 8px; display:inline;"> <tr> <td><a href="index.php" target="_blank"><img src="./templates/default/images/admincp/leftmenu_t.gif" style="border:none;"></a> </td> </tr> </table> <table cellspacing="0" cellpadding="0" border="0" width="100%" align="center" style="table-layout: fixed"> <tr> <td ><table width="100%" border="0" cellspacing="1" cellpadding="0"> <tr> <td ><table width="100%" border="0" cellspacing="1" cellpadding="4" class="smalltxt"> <tr> <td><b> <table width="146" border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist"> <tr class="leftmenutext"> <td><a href="<?=$all_open_link?>" title="չ��ȫ��������"><img src="./templates/default/images/admincp/menu_add.gif" border="0"></a> <A HREF="admin.php?mod=index&code=home" target="main">���������ҳ</A> <a href="<?=$all_close_link?>" title="�۵�ȫ��������"> <img src="./templates/default/images/admincp/menu_reduce.gif" border="0"></a> </td> </tr> </table></td> </tr> 
<? if(is_array($menu_list)) { foreach($menu_list as $menu) { ?>
 <tr> <td><a name="#0"></a> <table width="146" border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist"> <tr class="leftmenutext"> <td><a href="<?=$menu['link']?>"> 
<? if($menu['img']=='minus') { ?>
 <img src="./templates/default/images/admincp/menu_reduce.gif" border="0"> 
<? } else { ?> <img src="./templates/default/images/admincp/menu_add.gif" border="0"> 
<? } ?>
 </a> <a href="<?=$menu['link']?>" <?=$menu['target']?> style="color: #FFFFFF"><?=$menu['title']?></a></td> </tr> 
<? if($menu['sub_menu_list']) { ?>
 <tr class="leftmenutd"> <td><table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo"> 
<? if(is_array($menu['sub_menu_list'])) { foreach($menu['sub_menu_list'] as $sub_menu) { ?>
 
<? if($rewriteHandler)$sub_menu['link']=$rewriteHandler->
formatURL($sub_menu['link']); ?>
 
<? $_target=$sub_menu['target']?$sub_menu['target']:'main'; ?>
 <tr> <td bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#F8F8F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'">&nbsp;&nbsp;<a title="<?=$sub_menu['alt']?>" href="<?=$sub_menu['link']?>" target="<?=$_target?>"><?=$sub_menu['title']?></a></td> </tr> 
<? } } ?>
 </table></td> </tr> 
<? } ?>
 </table></td> </tr> 
<? } } ?>
 <tr> <td><b> <table width="146" border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist"> <tr class="leftmenutext"> <td><A HREF="index.php?mod=login&code=logout" target="main">&nbsp;&nbsp;>>>�˳�ϵͳ>>>&nbsp;</A> </td> </tr> </table></td> </tr> <tr> <td><a href="http://FS.shenei.net" target="_blank"><span style="font-size:12px;margin:15px 0 0 25px; color:orangered">���衤�񡿹�����</span></a> </td> </tr> </table></td> </tr> </table></td> </tr> </table> </body> </html>